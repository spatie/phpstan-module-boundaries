<?php

namespace App\Context\Payment;

use App\Context\Payment\Internal\StripePayment;

class Payment
{
    public function __construct(
        private StripePayment $stripeData
    ) {
    }

    public function getAmount(): int
    {
        return $this->stripeData->amount;
    }
}
