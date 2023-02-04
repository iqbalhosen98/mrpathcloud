<?php

namespace Mrpath\CartRule\Listeners;

use Mrpath\CartRule\Helpers\CartRule;

class Cart
{
    /**
     * CartRule object
     *
     * @var \Mrpath\CartRule\Helpers\CartRule
     */
    protected $cartRuleHepler;

    /**
     * Create a new listener instance.
     *
     * @param  \Mrpath\CartRule\Repositories\CartRule  $cartRuleHepler
     * @return void
     */
    public function __construct(CartRule $cartRuleHepler)
    {
        $this->cartRuleHepler = $cartRuleHepler;
    }

    /**
     * Aplly valid cart rules to cart
     * 
     * @param  \Mrpath\Checkout\Contracts\Cart  $cart
     * @return void
     */
    public function applyCartRules($cart)
    {
        $this->cartRuleHepler->collect();
    }
}