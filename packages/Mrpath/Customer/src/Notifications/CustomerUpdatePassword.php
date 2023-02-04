<?php

namespace Mrpath\Customer\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerUpdatePassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The customer instance.
     *
     * @var  \Mrpath\Customer\Models\Customer  $customer
     */
    public $customer;

    /**
     * Create a new message instance.
     *
     * @param  \Mrpath\Customer\Models\Customer  $customer
     * @return void
     */
    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(core()->getSenderEmailDetails()['email'], core()->getSenderEmailDetails()['name'])
                    ->to($this->customer->email, $this->customer->name)
                    ->subject(trans('shop::app.mail.update-password.subject'))
                    ->view('shop::emails.customer.update-password', ['user' => $this->customer]);
    }
}