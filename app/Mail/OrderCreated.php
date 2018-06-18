<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreated extends Mailable {
    use Queueable, SerializesModels;

    public $isCustomer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($isCustomer) {
        $this->isCustomer = $isCustomer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $view = $this->isCustomer ? 'emails.order-created-customer' : 'emails.order-created-owner';
        return $this->markdown($view);
    }
}
