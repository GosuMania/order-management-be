<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'malia:updateorders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for finished orders every day and sets status=confirmed';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("--------------------------------");
        Log::info("Run Update Finished Orders");
        $expiredOrders = Order::whereDate('date', '<', Carbon::now())->where('status', 'pending');
        Log::info("End Update Status Orders with " . $expiredOrders->count() . " status orders");
        return $expiredOrders->update(['status' => true]);
    }
}
