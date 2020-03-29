<?php

namespace App\Console\Commands;

use App\Imports\CocktailsImport;
use App\Models\Cocktail;
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
     * @return mixed
     */
    public function handle()
    {
        Cocktail::truncate();
        Cocktail::unguard();
        Excel::import(new CocktailsImport, public_path('Cocktails.xls'));
    }
}
