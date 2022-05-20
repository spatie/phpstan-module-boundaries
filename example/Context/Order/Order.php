<?php

namespace App\Context\Order;

use App\Context\Payment\Internal\StripePayment;
use App\Context\Payment\Payment;
use App\Helper;

class Order
{
    public function __construct(
        private int $total
    ) {
    }

    public function applyPayment(Payment $payment): void
    {
        $this->total = Helper::subtract($this->total, $payment->getAmount());
    }

    public function applyStripePayment(StripePayment $stripePayment): void
    {
        $this->total = Helper::subtract($this->total, $stripePayment->amount);
    }
}
