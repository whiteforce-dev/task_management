<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Taskmaster;
use Carbon\Carbon;

class DeleteExpiredTasks extends Command
{
    protected $signature = 'tasks:delete-expired';
    protected $description = 'Delete tasks with status 6 older than 30 days';

    public function handle()
    {
        $thresholdDate = Carbon::now()->subDays(30);
        Taskmaster::where('status', 6)
            ->where('created_at', '<', $thresholdDate)
            ->delete();
        $this->info('Expired tasks deleted successfully.');
    }
}
