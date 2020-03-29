<?php

namespace App\Imports;

use App\Models\Cocktail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CocktailsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $row = array_map(function ($column) {
            if ($column === 'N/A') {
                return null;
            }
            return trim($column);
        }, $row);
        return new Cocktail([
            "name" => $row['cocktail_name'],
            "signature" => $row['signature'],
            "bartender" => $row['bartender'],
            "bar_or_company" => $row['barcompany'],
            "location" => $row['location'],
            "season" => $row['season'],
            "ingredients" => $row['ingredients'],
            "garnish" => $row['garnish'],
            "glassware" => $row['glassware'],
            "preparation" => $row['preparation'],
            "notes" => $row['notes'],
            "legal" => $row['legal']
        ]);
    }
}
