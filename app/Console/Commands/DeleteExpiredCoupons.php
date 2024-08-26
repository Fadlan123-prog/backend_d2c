<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Coupon;
use Carbon\Carbon;

class DeleteExpiredCoupons extends Command
{
    protected $signature = 'coupons:delete-expired';
    protected $description = 'Delete coupons that have expired based on expired_date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        // Find all coupons where the expired_date is less than the current date/time
        $expiredCoupons = Coupon::where('expired_date', '<', $now)->get();

        if ($expiredCoupons->isEmpty()) {
            $this->info('No expired coupons found.');
            return;
        }

        foreach ($expiredCoupons as $coupon) {
            $this->info('Deleting expired coupon: ' . $coupon->name . ' (ID: ' . $coupon->id . ')');
            $coupon->delete();
        }

        $this->info('Expired coupons deleted successfully.');
    }
}
