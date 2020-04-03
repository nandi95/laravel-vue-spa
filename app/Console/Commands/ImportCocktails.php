<?php

namespace App\Console\Commands;

use App\Imports\CocktailsImport;
use App\Models\Cocktail;
use App\Models\CocktailIngredient;
use App\Models\Ingredient;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportCocktails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Ingredient::truncate();
        Ingredient::unguard();
        Cocktail::truncate();
        Cocktail::unguard();
        (new CocktailsImport)->withOutput($this->output)->import(public_path('Cocktails.xlsx'));
    }
}
