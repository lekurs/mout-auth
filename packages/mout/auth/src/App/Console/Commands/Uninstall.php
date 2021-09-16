<?php


namespace Mout\Auth\App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Uninstall extends Command
{
    /**
     * @var string
     */
    protected $signature = 'laravel-auth:uninstall';

    /**
     * @var string
     */
    protected $description = 'Remove auth files';

    /**
     * @var bool $hidden
     */
    protected $hidden = true;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        File::deleteDirectory(app_path('Http/Controllers/Auth'));
        File::deleteDirectory(app_path('Http/Requests/Auth'));
        File::deleteDirectory(app_path('Notifications/Auth'));
        File::deleteDirectory(resource_path('views/vendor/laravel-auth'));
        File::deleteDirectory(resource_path('lang/vendor/laravel-auth'));
        $this->info('Auth uninstalled successfully');
        return 0;
    }
}
