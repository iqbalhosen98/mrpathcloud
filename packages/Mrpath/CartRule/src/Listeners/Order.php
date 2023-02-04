<?php

namespace Mrpath\CartRule\Listeners;

use Mrpath\CartRule\Repositories\CartRuleRepository;
use Mrpath\CartRule\Repositories\CartRuleCustomerRepository;
use Mrpath\CartRule\Repositories\CartRuleCouponRepository;
use Mrpath\CartRule\Repositories\CartRuleCouponUsageRepository;

class Order
{
    /**
     * CartRuleRepository object
     *
     * @var \Mrpath\CartRule\Repositories\CartRuleRepository
     */
    protected $cartRuleRepository;

    /**
     * CartRuleCustomerRepository object
     *
     * @var \Mrpath\CartRule\Repositories\CartRuleCustomerRepository
     */
    protected $cartRuleCustomerRepository;

    /**
     * CartRuleCouponRepository object
     *
     * @var \Mrpath\CartRule\Repositories\CartRuleCouponRepository
     */
    protected $cartRuleCouponRepository;

    /**
     * CartRuleCouponUsageRepository object
     *
     * @var \Mrpath\CartRule\Repositories\CartRuleCouponUsageRepository
     */
    protected $cartRuleCouponUsageRepository;

    /**
     * Create a new listener instance.
     *
     * @param  \Mrpath\CartRule\Repositories\CartRuleRepository  $cartRuleRepository
     * @param  \Mrpath\CartRule\Repositories\CartRuleCustomerRepository  $cartRuleCustomerRepository
     * @param  \Mrpath\CartRule\Repositories\CartRuleCouponRepository  $cartRuleCouponRepository
     * @param  \Mrpath\CartRule\Repositories\CartRuleCouponUsageRepository  $cartRuleCouponUsageRepository
     * @return void
     */
    public function __construct(
        CartRuleRepository $cartRuleRepository,
        CartRuleCustomerRepository $cartRuleCustomerRepository,
        CartRuleCouponRepository $cartRuleCouponRepository,
        CartRuleCouponUsageRepository $cartRuleCouponUsageRepository
    )
    {
        $this->cartRuleRepository = $cartRuleRepository;

        $this->cartRuleCustomerRepository = $cartRuleCustomerRepository;

        $this->cartRuleCouponRepository = $cartRuleCouponRepository;

        $this->cartRuleCouponUsageRepository = $cartRuleCouponUsageRepository;
    }

    /**
     * Save cart rule and cart rule coupon properties after place order
     *
     * @param  \Mrpath\Sales\Contracts\Order  $order
     * @return void
     */
    public function manageCartRule($order)
    {
        if (! $order->discount_amount) {
            return;
        }

        $cartRuleIds = explode(',', $order->applied_cart_rule_ids);

        $cartRuleIds = array_unique($cartRuleIds);

        foreach ($cartRuleIds as $ruleId) {
            $rule = $this->cartRuleRepository->find($ruleId);

            if (! $rule) {
                continue;
            }

            $rule->update(['times_used' => $rule->times_used + 1]);

            if (! $order->customer_id) {
                continue;
            }

            $ruleCustomer = $this->cartRuleCustomerRepository->findOneWhere([
                'customer_id'  => $order->customer_id,
                'cart_rule_id' => $ruleId,
            ]);

            if ($ruleCustomer) {
                $this->cartRuleCustomerRepository->update(['times_used' => $ruleCustomer->times_used + 1], $ruleCustomer->id);
            } else {
                $this->cartRuleCustomerRepository->create([
                    'customer_id'  => $order->customer_id,
                    'cart_rule_id' => $ruleId,
                    'times_used'   => 1,
                ]);
            }
        }

        if (! $order->coupon_code) {
            return;
        }

        $coupon = $this->cartRuleCouponRepository->findOneByField('code', $order->coupon_code);

        if ($coupon) {
            $this->cartRuleCouponRepository->update(['times_used' => $coupon->times_used + 1], $coupon->id);

            if ($order->customer_id) {
                $couponUsage = $this->cartRuleCouponUsageRepository->findOneWhere([
                    'customer_id'         => $order->customer_id,
                    'cart_rule_coupon_id' => $coupon->id,
                ]);

                if ($couponUsage) {
                    $this->cartRuleCouponUsageRepository->update(['times_used' => $couponUsage->times_used + 1], $couponUsage->id);
                } else {
                    $this->cartRuleCouponUsageRepository->create([
                        'customer_id'         => $order->customer_id,
                        'cart_rule_coupon_id' => $coupon->id,
                        'times_used'          => 1,
                    ]);
                }
            }
        }
    }
}