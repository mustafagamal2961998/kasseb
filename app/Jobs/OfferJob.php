<?php

namespace App\Jobs;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OfferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $getAllOffers = Offer::with('product') // نحمل المنتج مع العرض لتقليل الاستعلامات
            ->where('end_offer_date', '<', Carbon::now())
            ->get();

        foreach ($getAllOffers as $offer) {
            // نتأكد إن العرض له منتج قبل التحديث
            if ($offer->product) {
                $offer->product->update([
                    'user_price' => $offer->base_user_price,
                    'trader_price' => $offer->base_trader_price,
                ]);
            }

            // ممكن كمان تحدث حالة العرض لو حبيت (مثلاً نوقفه)
            $offer->update(['status' => 'archived']);
        }
        
    }
}
