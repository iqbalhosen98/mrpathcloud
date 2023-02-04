<?php

namespace Mrpath\Paypal\Http\Controllers;

use Mrpath\Paypal\Helpers\Ipn;
use Mrpath\Checkout\Facades\Cart;
use Mrpath\Sales\Repositories\OrderRepository;

class StandardController extends Controller
{
    /**
     * OrderRepository $orderRepository
     *
     * @var \Mrpath\Sales\Repositories\OrderRepository
     */
    protected $orderRepository;

    /**
     * IPN $ipnHelper
     *
     * @var \Mrpath\Paypal\Helpers\Ipn
     */
    protected $ipnHelper;

    /**
     * Create a new controller instance.
     *
     * @param  \Mrpath\Attribute\Repositories\OrderRepository  $orderRepository
     * @param  \Mrpath\Paypal\Helpers\Ipn  $ipnHelper
     * @return void
     */
    public function __construct(
        OrderRepository $orderRepository,
        Ipn $ipnHelper
    )
    {
        $this->orderRepository = $orderRepository;

        $this->ipnHelper = $ipnHelper;
    }

    /**
     * Redirects to the paypal.
     *
     * @return \Illuminate\View\View
     */
    public function redirect()
    {
        return view('paypal::standard-redirect');
    }

    /**
     * Cancel payment from paypal.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        session()->flash('error', 'Paypal payment has been canceled.');

        return redirect()->route('shop.checkout.cart.index');
    }

    /**
     * Success payment.
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        $order = $this->orderRepository->create(Cart::prepareDataForOrder());

        Cart::deActivateCart();

        session()->flash('order', $order);

        return redirect()->route('shop.checkout.success');
    }

    /**
     * Paypal IPN listener.
     *
     * @return \Illuminate\Http\Response
     */
    public function ipn()
    {
        $this->ipnHelper->processIpn(request()->all());
    }
}