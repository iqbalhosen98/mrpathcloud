<?php

namespace Mrpath\Admin\Listeners;

use Illuminate\Support\Facades\Mail;
use Mrpath\User\Notifications\AdminUpdatePassword;
use Mrpath\Customer\Notifications\CustomerUpdatePassword;

class PasswordChange
{
    /**
     * Send mail on updating password.
     *
     * @param  \Mrpath\Customer\Models\Customer|\Mrpath\User\Models\Admin  $adminOrCustomer
     * @return void
     */
    public function sendUpdatePasswordMail($adminOrCustomer)
    {
        try {
            if ($adminOrCustomer instanceof \Mrpath\Customer\Models\Customer) {
                Mail::queue(new CustomerUpdatePassword($adminOrCustomer));
            }

            if ($adminOrCustomer instanceof \Mrpath\User\Models\Admin) {
                Mail::queue(new AdminUpdatePassword($adminOrCustomer));
            }
        } catch (\Exception $e) {
            report($e);
        }
    }
}