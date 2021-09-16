<?php


namespace Mout\Auth\App\Console\Commands;

use Mout\Auth\AuthServiceProvider;
use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * @var string
     */
    protected $signature = 'laravel-auth:install';

    /**
     * @var string
     */
    protected $description = 'Create auth files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->call('vendor:publish', [
            '--provider' => AuthServiceProvider::class
        ]);

        $this->info('Recipes installed successfully');
        return 0;
    }
}
