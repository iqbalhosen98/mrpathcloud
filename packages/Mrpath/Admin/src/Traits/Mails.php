<?php

namespace Mrpath\Admin\Traits;

use Illuminate\Support\Facades\Mail;
use Mrpath\Admin\Mail\CancelOrderAdminNotification;
use Mrpath\Admin\Mail\CancelOrderNotification;
use Mrpath\Admin\Mail\DuplicateInvoiceNotification;
use Mrpath\Admin\Mail\NewAdminNotification;
use Mrpath\Admin\Mail\NewInventorySourceNotification;
use Mrpath\Admin\Mail\NewInvoiceNotification;
use Mrpath\Admin\Mail\NewOrderNotification;
use Mrpath\Admin\Mail\NewRefundNotification;
use Mrpath\Admin\Mail\NewShipmentNotification;
use Mrpath\Admin\Mail\OrderCommentNotification;

trait Mails
{
    /**
     * Send new order Mail to the customer and admin.
     *
     * @param  \Mrpath\Sales\Contracts\Order  $order
     * @return void
     */
    public function sendNewOrderMail($order)
    {
        $customerLocale = $this->getLocale($order);

        try {
            /**
             * Email to customer.
             */
            $configKey = 'emails.general.notifications.emails.general.notifications.new-order';

            if (core()->getConfigData($configKey)) {
                $this->prepareMail($customerLocale, new NewOrderNotification($order));
            }

            /**
             * Email to admin.
             */
            $configKey = 'emails.general.notifications.emails.general.notifications.new-admin';

            if (core()->getConfigData($configKey)) {
                $this->prepareMail(config('app.locale'), new NewAdminNotification($order));
            }
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Send new invoice mail to the customer.
     *
     * @param  \Mrpath\Sales\Contracts\Invoice  $invoice
     * @return void
     */
    public function sendNewInvoiceMail($invoice)
    {
        $customerLocale = $this->getLocale($invoice);

        try {
            if ($invoice->email_sent) {
                return;
            }

            /**
             * Email to customer.
             */
            $configKey = 'emails.general.notifications.emails.general.notifications.new-invoice';

            if (core()->getConfigData($configKey)) {
                $this->prepareMail($customerLocale, new NewInvoiceNotification($invoice));
            }
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Send duplicate invoice mail to the customer.
     *
     * @param  \Mrpath\Sales\Contracts\Invoice  $invoice
     * @param  string  $customerEmail
     * @return void
     */
    public function sendDuplicateInvoiceMail($invoice, $customerEmail)
    {
        $customerLocale = $this->getLocale($invoice);

        try {
            /**
             * Email to customer.
             */
            $configKey = 'emails.general.notifications.emails.general.notifications.new-invoice';

            if (core()->getConfigData($configKey)) {
                $this->prepareMail($customerLocale, new DuplicateInvoiceNotification($invoice, $customerEmail));
            }
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Send new refund mail to the customer.
     *
     * @param  \Mrpath\Sales\Contracts\Refund  $refund
     * @return void
     */
    public function sendNewRefundMail($refund)
    {
        $customerLocale = $this->getLocale($refund);

        try {
            /**
             * Email to customer.
             */
            $configKey = 'emails.general.notifications.emails.general.notifications.new-refund';

            if (core()->getConfigData($configKey)) {
                $this->prepareMail($customerLocale, new NewRefundNotification($refund));
            }
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Send new shipment mail to the customer.
     *
     * @param  \Mrpath\Sales\Contracts\Shipment  $shipment
     * @return void
     */
    public function sendNewShipmentMail($shipment)
    {
        $customerLocale = $this->getLocale($shipment);

        try {
            if ($shipment->email_sent) {
                return;
            }

            /**
             * Email to customer.
             */
            $configKey = 'emails.general.notifications.emails.general.notifications.new-shipment';

            if (core()->getConfigData($configKey)) {
                $this->prepareMail($customerLocale, new NewShipmentNotification($shipment));
            }

            /**
             * Email to admin.
             */
            $configKey = 'emails.general.notifications.emails.general.notifications.new-inventory-source';

            if (core()->getConfigData($configKey)) {
                $this->prepareMail(config('app.locale'), new NewInventorySourceNotification($shipment));
            }
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Send cancel order mail.
     *
     * @param  \Mrpath\Sales\Contracts\Order  $order
     * @return void
     */
    public function sendCancelOrderMail($order)
    {
        $customerLocale = $this->getLocale($order);

        try {
            /**
             * Email to customer.
             */
            $configKey = 'emails.general.notifications.emails.general.notifications.cancel-order';

            if (core()->getConfigData($configKey)) {
                $this->prepareMail($customerLocale, new CancelOrderNotification($order));
            }

            /**
             * Email to admin.
             */
            $configKey = 'emails.general.notifications.emails.general.notifications.new-admin';

            if (core()->getConfigData($configKey)) {
                $this->prepareMail(config('app.locale'), new CancelOrderAdminNotification($order));
            }
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Send order comment mail.
     *
     * @param  \Mrpath\Sales\Contracts\OrderComment  $comment
     * @return void
     */
    public function sendOrderCommentMail($comment)
    {
        $customerLocale = $this->getLocale($comment);

        if (! $comment->customer_notified) {
            return;
        }

        try {
            /**
             * Email to customer.
             */
            $this->prepareMail($customerLocale, new OrderCommentNotification($comment));
        } catch (\Exception $e) {
            report($e);
        }
    }

    /**
     * Get the locale of the customer if somehow item name changes then the english locale will pe provided.
     *
     * @param object \Mrpath\Sales\Contracts\Order|\Mrpath\Sales\Contracts\Invoice|\Mrpath\Sales\Contracts\Refund|\Mrpath\Sales\Contracts\Shipment|\Mrpath\Sales\Contracts\OrderComment
     * @return string
     */
    private function getLocale($object)
    {
        if ($object instanceof \Mrpath\Sales\Contracts\OrderComment) {
            $object = $object->order;
        }

        $objectFirstItem = $object->items->first();

        return isset($objectFirstItem->additional['locale']) ? $objectFirstItem->additional['locale'] : 'en';
    }

    /**
     * Prepare mail.
     *
     * @return void
     */
    private function prepareMail($locale, $notification)
    {
        $previousLocale = core()->getCurrentLocale()->code;

        app()->setLocale($locale);

        Mail::queue($notification);

        app()->setLocale($previousLocale);
    }
}
