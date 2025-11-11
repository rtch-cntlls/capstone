<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Admin\BookingService;

class AutoUpdateBookingStatus extends Command
{
    protected $signature = 'bookings:auto-update';

    protected $description = 'Automatically update booking statuses based on schedule (complete, fail, etc.)';

    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        parent::__construct();
        $this->bookingService = $bookingService;
    }

    public function handle(): int
    {
        try {
            $count = $this->bookingService->autoUpdateBookingStatuses(); // method we will create in BookingService
            $this->info("Auto-updated {$count} booking(s).");
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error("Error updating bookings: ".$e->getMessage());
            return self::FAILURE;
        }
    }
}
