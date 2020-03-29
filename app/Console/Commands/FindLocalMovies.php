<?php

namespace App\Console\Commands;

use App\Models\Movie;
use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FindLocalMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'find:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find local movies at the configured path.';

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
        $getID3 = new \getID3;
        Movie::truncate();

        foreach (File::allFiles(Setting::first()->media_path) as $file) {
            if (!in_array($file->getExtension(), ['webm', 'mov', 'mp4', 'ogg'])) {
                continue;
            }

            $report = $getID3->analyze($file->getPathname());

            Movie::create([
                'title'              => $file->getFilenameWithoutExtension(),
                'extension'          => $file->getExtension(),
                'last_discovered_at' => now(),
                'path'               => $file->getPathname(),
                'duration'           => $report['playtime_string']
            ]);
        }
    }
}
