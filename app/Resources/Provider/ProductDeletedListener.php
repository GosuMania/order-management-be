<?php

namespace App\Providers;

use App\Models\ProductVariant;
use App\Providers\ProductDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductDeletedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\ProductDeleted  $event
     * @return void
     */
    public function handle(ProductDeleted $event)
    {
        $products = ProductVariant::where('id_product', $event->product_id)->get();

        if (!$products) {
            return;
        }
        foreach ($products as $product) {
            $product->delete();
        }
        return null;
    }
}
