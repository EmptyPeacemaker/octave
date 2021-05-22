<?php

namespace App\Console\Commands;

use App\Models\Photo;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class startProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Полная готовность сайта';

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
     * @return int
     */
    public function handle()
    {
        Artisan::call('migrate:rollback');
        Artisan::call('migrate');

        foreach (File::files(storage_path('app/public/photo')) as $file){
            Photo::create(['url'=>'/storage/photo/'.$file->getFilename(),'user_id'=>12]);
        }
        return 0;
    }
}
