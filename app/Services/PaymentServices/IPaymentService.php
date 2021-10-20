<?php

namespace App\Services\PaymentServices;

use App\Services\PaymentServices\Dtos\PaymentInitiator;
use App\Services\PaymentServices\Dtos\PaymentInitiatorResponse;
use App\Services\PaymentServices\Dtos\PaymentVerificationResponse;

interface IPaymentService {
    public function toString() : string;

    public function initiatePayment(PaymentInitiator $initiator) : PaymentInitiatorResponse;


    public function verifyPayment(string $reference) : PaymentVerificationResponse;


    public function calcualteCharges(float $amount, string $currency) : float; 
} 