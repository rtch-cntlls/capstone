<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Admin\OrderService;

class AutoCompleteShippedOrders extends Command
{
    protected $signature = 'orders:auto-complete-shipped';
    protected $description = 'Automatically complete shipped orders whose expected delivery date has passed';

    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        parent::__construct();
        $this->orderService = $orderService;
    }

    public function handle(): int
    {
        $count = $this->orderService->autoCompleteShippedOrders();
        $this->info("Auto-completed {$count} shipped orders.");
        return self::SUCCESS;
    }
}
