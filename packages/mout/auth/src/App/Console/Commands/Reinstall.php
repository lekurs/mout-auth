<?php


namespace Mout\Auth\App\Console\Commands;

use Illuminate\Console\Command;

class Reinstall extends Command
{
    /**
     * @var string
     */
    protected $signature = 'laravel-auth:reinstall';

    /**
     * @var string
     */
    protected $description = 'Reinstall auth files';

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
        $this->call(Uninstall::class);
        $this->call(Install::class);
        return 0;
    }
}
