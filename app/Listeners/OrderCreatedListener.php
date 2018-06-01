<?php

namespace App\Listeners;

use App\Events\Client\OrderCreated;

class OrderCreatedListener {
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
     * @param  OrderCreated $event
     * @return void
     */
    public function handle(OrderCreated $event) {
        //
    }
}
