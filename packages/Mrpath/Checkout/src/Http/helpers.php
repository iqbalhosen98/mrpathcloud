<?php

if (! function_exists('cart')) {
    /**
     * Cart helper.
     *
     * @return \Mrpath\Checkout\Cart
     */
    function cart()
    {
        return app()->make('cart');
    }
}
