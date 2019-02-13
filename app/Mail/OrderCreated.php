<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class OrderCreated extends Mailable {
    use Queueable, SerializesModels;
    public $isCustomer;
    public $orderData;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($isCustomer,$orderData) {
        $this->isCustomer = $isCustomer;
        $this->orderData = $orderData;
       
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
      
      
        //var_dump($this->orderData);
        $view = $this->isCustomer ? 'emails.order-created-customer' : 'emails.order-created-owner';
        $subject = $this->isCustomer ? 'Bedankt voor uw order' : 'Bestelling  '.$this->orderData["shippinground"].' '.$this->orderData["address2"].' '.$this->orderData["address1"].' '.$this->orderData["city"];
         
        return $this->subject($subject)->markdown($view)->with([
                         'orderData' => $this->orderData,
                       
                     ]);
      
        return $this->markdown($view);      
    }
}