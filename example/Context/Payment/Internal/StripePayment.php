<?php

namespace App\Context\Payment\Internal;

class StripePayment
{
    public function __construct(
        public readonly int $amount
    ) {
    }
}
