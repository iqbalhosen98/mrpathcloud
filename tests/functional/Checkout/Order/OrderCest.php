<?php

namespace Tests\Functional\Checkout\Order;

use Faker\Factory;
use FunctionalTester;
use Mrpath\Checkout\Models\CartAddress;
use Mrpath\Checkout\Models\CartPayment;
use Mrpath\Core\Models\Channel;
use Mrpath\Customer\Models\Customer;
use Mrpath\Sales\Models\Order;
use Mrpath\Sales\Models\OrderAddress;
use Mrpath\Sales\Models\OrderPayment;

/**
 * OrderCest class.
 *
 * @package Tests\Functional\Checkout\Cart
 */
class OrderCest
{
    /**
     * Test checkout as customer.
     *
     * @param  \FunctionalTester  $I
     * @return void
     */
    public function testCheckoutAsCustomer(FunctionalTester $I)
    {
        $customer = $I->loginAsCustomer();

        $faker = Factory::create();

        $addressData = $this->cleanAllFields([
            'city'         => $faker->city,
            'company_name' => $faker->company,
            'country'      => $faker->countryCode,
            'email'        => $faker->email,
            'first_name'   => $faker->firstName,
            'last_name'    => $faker->lastName,
            'phone'        => $faker->phoneNumber,
            'postcode'     => $faker->postcode,
            'state'        => $faker->state,
        ]);

        $mocks = $I->prepareCart([
            'customer' => $customer,
        ]);

        /**
         * Assert that checkout can be reached and generate csrf token.
         */
        $I->amOnRoute('shop.checkout.onepage.index');

        /**
         * Simulate the entering of the address(es).
         */
        $I->sendAjaxPostRequest(route('shop.checkout.save-address'), [
            '_token'   => csrf_token(),
            'billing'  => array_merge($addressData, [
                'address1'         => ['900 Nobel Parkway'],
                'save_as_address'  => true,
                'use_for_shipping' => true,
            ]),
            'shipping' => array_merge($addressData, [
                'address1'         => ['900 Nobel Parkway'],
                'save_as_address'  => true,
                'use_for_shipping' => true,
            ]),
        ]);

        $I->seeResponseCodeIsSuccessful();

        $I->seeRecord(CartAddress::class, array_merge($addressData, [
            'address_type' => CartAddress::ADDRESS_TYPE_SHIPPING,
            'cart_id'      => $mocks['cart']->id,
            'customer_id'  => $mocks['customer']->id,
        ]));

        $I->seeRecord(CartAddress::class, array_merge($addressData, [
            'address_type' => CartAddress::ADDRESS_TYPE_BILLING,
            'cart_id'      => $mocks['cart']->id,
            'customer_id'  => $mocks['customer']->id,
        ]));

        $I->sendAjaxPostRequest(route('shop.checkout.save-shipping'), [
            '_token'          => csrf_token(),
            'shipping_method' => 'free_free',
        ]);

        $I->seeResponseCodeIsSuccessful();

        $I->sendAjaxPostRequest(route('shop.checkout.save-payment'), [
            '_token'  => csrf_token(),
            'payment' => [
                'method' => 'cashondelivery',
            ],
        ]);

        $I->seeResponseCodeIsSuccessful();

        $I->seeRecord(CartPayment::class, [
            'method'       => 'cashondelivery',
            'method_title' => null,
            'cart_id'      => $mocks['cart']->id,
        ]);

        /**
         * Simulate click on the 'place order' button at the last step.
         */
        $I->sendAjaxPostRequest(
            route('shop.checkout.save-order'),
            ['_token' => csrf_token()]
        );

        $I->seeResponseCodeIsSuccessful();

        $order = $I->grabRecord(Order::class, [
            'status'               => 'pending',
            'channel_name'         => 'Default',
            'is_guest'             => 0,
            'customer_first_name'  => $customer->first_name,
            'customer_last_name'   => $customer->last_name,
            'customer_email'       => $customer->email,
            'shipping_method'      => 'free_free',
            'shipping_title'       => 'Free Shipping - Free Shipping',
            'shipping_description' => 'Free Shipping',
            'customer_type'        => Customer::class,
            'channel_id'           => 1,
            'channel_type'         => Channel::class,
            'cart_id'              => $mocks['cart']->id,
            'customer_id'          => $customer->id,
            'total_item_count'     => count($mocks['cartItems']),
            'total_qty_ordered'    => $mocks['totalQtyOrdered'],
        ]);

        $I->seeRecord(OrderAddress::class, array_merge($addressData, [
            'order_id'     => $order->id,
            'address_type' => OrderAddress::ADDRESS_TYPE_SHIPPING,
            'customer_id'  => $mocks['customer']->id,
        ]));

        $I->seeRecord(OrderAddress::class, array_merge($addressData, [
            'order_id'     => $order->id,
            'address_type' => OrderAddress::ADDRESS_TYPE_BILLING,
            'customer_id'  => $mocks['customer']->id,
        ]));

        $I->seeRecord(OrderPayment::class, [
            'method'       => 'cashondelivery',
            'method_title' => null,
            'order_id'     => $order->id,
        ]);
    }

    /**
     * Clean all fields.
     *
     * @param  array  $fields
     * @return array
     */
    private function cleanAllFields(array $fields)
    {
        return collect($fields)->map(function ($field, $key) {
            return $this->cleanField($field);
        })->toArray();
    }

    /**
     * Clean fields.
     *
     * @param  string $field
     * @return string
     */
    private function cleanField($field)
    {
        return preg_replace('/[^A-Za-z0-9 ]/', '', $field);
    }
}
