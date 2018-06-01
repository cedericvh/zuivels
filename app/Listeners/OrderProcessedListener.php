<?php

namespace App\Listeners;

use App\Events\Client\OrderProcessed;

class OrderProcessedListener {
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderProcessed $event
     * @return void
     */
    public function handle(OrderProcessed $event) {
        //
    }
}
