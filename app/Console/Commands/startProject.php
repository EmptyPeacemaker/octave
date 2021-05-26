<?php

namespace App\Console\Commands;

use App\Models\Photo;
use App\Models\Spectacle;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
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
        File::copy('.env.example','.env');
        if (Schema::hasTable('migrations'))Artisan::call('migrate:reset');
        Artisan::call('migrate');
        Artisan::call('storage:link');
        User::create([
            'login'=>'admin',
            'password'=>'admin'
        ]);

        $i=1;

        foreach (File::files(storage_path('app/public/photo')) as $file){
            Photo::create(['url'=>'/storage/photo/'.$file->getFilename(),'user_id'=>1]);
            Spectacle::create([
                'url'=>'/storage/photo/'.$file->getFilename(),
                'title'=>'text_'.$i,
                'description'=>'text_'.$i,
                'text'=>'text_'.$i
            ]);
            $i++;
        }

        return 0;
    }
}
