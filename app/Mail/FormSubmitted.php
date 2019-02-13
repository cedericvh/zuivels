<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class FormSubmitted extends Mailable {
    use Queueable, SerializesModels;
    public $isCustomer;
    public $formData;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($isCustomer,$formData) {
        $this->isCustomer = $isCustomer;
        $this->formData = $formData;
       
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
      
      
      //var_dump($this->orderData);
        $view = 'emails.form-submitted-owner';
         return $this->markdown($view)->with([
                         'orderData' => $this->formData,
                       
                     ]);
      
        return $this->markdown($view);      
    }
}