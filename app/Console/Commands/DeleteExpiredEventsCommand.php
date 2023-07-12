<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteExpiredEventsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete-expired-events-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete All Expired Events';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new \App\Jobs\DeleteExpiredEventsJob());
    }
}
