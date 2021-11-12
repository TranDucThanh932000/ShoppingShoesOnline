<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailShoppingCart extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $name;
    protected $carts;
    protected $address;

    public function __construct($name,$carts,$address)
    {
        $this->name = $name;
        $this->carts = $carts;
        $this->address = $address;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->name;
        $carts = $this->carts;
        $address = $this->address;
        return $this->view('emails.email_shopping_cart',compact('name','carts','address'));
    }
}
