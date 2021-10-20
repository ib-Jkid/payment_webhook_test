<?php

namespace App\Services\PaymentServices\Dtos;

use Carbon\Carbon;

class PaymentVerificationResponse {

    public $gatewayFee;
    public $amountPaid;

    /** @var Carbon */
    public $paidOn;
    public function __construct($gatewayFee, $amountPaid, Carbon $paidOn)
    {
        $this->gatewayFee = $gatewayFee;
        $this->amountPaid = $amountPaid;
        $this->paidOn = $paidOn;

        
    }
} 