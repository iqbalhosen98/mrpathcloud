<?php

namespace Actions;

use Mrpath\Checkout\Models\Cart;
use Mrpath\Checkout\Models\CartItem;

trait CartAction
{
    /**
     * Generate cart.
     *
     * @param  array  $attributes
     * @return \Mrpath\Checkout\Contracts\Cart
     */
    public function haveCart($attributes = [])
    {
        return Cart::factory($attributes)->adjustCustomer()->create();
    }

    /**
     * Generate cart items.
     *
     * @param  array  $attributes
     * @return \Mrpath\Checkout\Contracts\CartItem
     */
    public function haveCartItems($attributes = [])
    {
        return CartItem::factory($attributes)->adjustProduct()->create();
    }
}
