<?php
namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\User;
//use App\Http\Requests\OrdersRequest;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreatedListener implements ShouldQueue{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
      
        //$this->OrdersRequest = $request;
        
        //
    }
    /**
     * Handle the event.
     *
     * @param  OrderCreated $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $this->sendEmail($event->order);
    }

    /**
     * Send email to submitter
     *
     * @param Order $order
     */
    protected function sendEmail(Order $order)
    {
        
      /**mail naar klant bevestiging **/
      
      //var_dump($order);
      

        
      
    }
}
