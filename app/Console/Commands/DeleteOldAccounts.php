<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class DeleteOldAccounts extends Command
{
    protected $signature = 'accounts:delete-old';
    protected $description = 'Permanently delete accounts that have been soft-deleted for more than 24 hours';

    public function handle()
    {
        $users = User::onlyTrashed()
            ->where('deleted_at', '<=', Carbon::now()->subHours(24))
            ->get();

        foreach ($users as $user) {
            $user->forceDelete(); // Permanently delete the user
        }

        $this->info('Old accounts deleted successfully.');
    }
}

