<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Discount;

class AutoActivatePromos extends Command
{
    protected $signature = 'promos:auto-activate';
    protected $description = 'Activate promos whose start date is today or earlier';

    public function handle(): int
    {
        $today = now()->toDateString();

        $count = Discount::where('status', 'Upcoming')
            ->where('start_date', '<=', $today)
            ->update(['status' => 'Active']);

        $this->info("Activated {$count} promo(s).");
        return self::SUCCESS;
    }
}
