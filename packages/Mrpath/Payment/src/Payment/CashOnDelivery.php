<?php

namespace Mrpath\Payment\Payment;

class CashOnDelivery extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'cashondelivery';

    public function getRedirectUrl()
    {
        
    }
}