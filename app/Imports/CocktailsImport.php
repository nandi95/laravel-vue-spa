<?php

namespace App\Imports;

use App\Enums\UnitType;
use App\Models\Cocktail;
use App\Models\CocktailIngredient;
use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class CocktailsImport implements ToModel, WithHeadingRow, WithProgressBar
{
    use Importable;
    /**
     * @var array $units ;
     */
    private $units = [];

    public function __construct()
    {
        foreach (UnitType::getKeys() as $key) {
            array_push($this->units, strtolower($key), $key, strtoupper($key));
        }
    }

    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        //1.5 oz No.3 London Dry Gin, .75 oz Luxardo Triplum (Triple Sec), .75 oz Fresh Lemon Juice, .5 oz Egg White
        $row = array_map(function ($column) {
            if ($column === 'N/A') {
                return null;
            }
            return trim($column);
        }, $row);

        $cocktail = null;

        DB::transaction(function () use ($row) {
            $cocktail = Cocktail::query()->create([
                'name'           => $row['cocktail_name'],
                'signature'      => $row['signature'],
                'bartender'      => $row['bartender'],
                'bar_or_company' => $row['barcompany'],
                'location'       => $row['location'],
                'season'         => $row['season'],
                'glassware'      => $row['glassware'],
                'preparation'    => $row['preparation'],
                'notes'          => $row['notes'],
                'legal'          => $row['legal']
            ]);

            if ($row['garnish']) {
                Ingredient::query()->updateOrCreate(['name' => $row['garnish']]);
            }

            foreach (explode(',', $row['ingredients']) as $ingredient) {
                $parsedIngredient = array_diff(
                    explode(' ', trim($ingredient), 3),
                    ['']
                );

                //if first item is unit type then rest of the items should be merged
                if (in_array($parsedIngredient[0], $this->units)) {
                    $unit                = array_shift($parsedIngredient);
                    $parsedIngredient[1] = implode(" ", $parsedIngredient);
                    $parsedIngredient[0] = $unit;
                }
                $parsedIngredient = array_values($parsedIngredient);

                $hasAmount  = floatval($parsedIngredient[0]) !== 0.0;
                $hasUnit    = array_key_exists(1, $parsedIngredient) && in_array($parsedIngredient[1], $this->units);
                $ingredient = Ingredient::query()->firstOrCreate(['name' => Arr::last($parsedIngredient)]);

                CocktailIngredient::query()->create([
                    'ingredient_id' => $ingredient->getKey(),
                    'cocktail_id'   => $cocktail->getKey(),
                    'amount'        => floatval($hasAmount ? $parsedIngredient[0] : 1),
                    'unit'          => $hasUnit ? UnitType::getValue(ucfirst($parsedIngredient[1])) : null
                ]);
            }
        });

        return $cocktail;
    }
}
