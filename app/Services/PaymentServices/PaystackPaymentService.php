<?php

namespace App\Services\PaymentServices;

use App\Models\PaystackLog;
use App\Services\PaymentServices\Dtos\PaymentInitiator;
use App\Services\PaymentServices\Dtos\PaymentInitiatorResponse;
use App\Services\PaymentServices\Dtos\PaymentVerificationResponse;
use App\Services\PaymentServices\Exceptions\PaymentException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Nette\NotImplementedException;

class PaystackPaymentService implements IPaymentService {
    public function toString() : string {
        return "paystack";
    }

    public function initiatePayment(PaymentInitiator $initiator) : PaymentInitiatorResponse {
        throw new NotImplementedException();
    }       


    public function verifyPayment(string $reference) : PaymentVerificationResponse {

        $curl = curl_init();
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/{$reference}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer ".env("PAYSTACK_SECRET_KEY"),
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
        if ($err) {

            PaystackLog::create([
                "reference" => $reference,
                "status" => false,
                "payload" => $response,
                "error" => $err
            ]);
            throw new PaymentException($err);
        } 

        $response = json_decode($response);

        PaystackLog::create([
            "reference" => $reference,
            "status" => $response->status,
            "payload" => json_encode($response),
            "error" => null
        ]);

        if(!$response->status) {
            throw new PaymentException("Failed to verify payment");
        }

        return new PaymentVerificationResponse($response->data->fees / 100, $response->data->amount / 100,Carbon::parse($response->data->paid_at));
    }


    public function calcualteCharges(float $amount , string $currency = "NGN") : float {
        switch($currency) {
            case "NGN": 
                $rate  = 1.5; //% gateway fee

                $charge = ($amount * $rate) / (100 - $rate);

                return ceil($charge);

            break;
            default: 
                throw new PaymentException("No Support for currency: {$currency}");
            break;
        }
    }
} 