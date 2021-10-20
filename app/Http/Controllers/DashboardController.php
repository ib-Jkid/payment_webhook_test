<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\PaymentServices\Dtos\PaymentVerificationResponse;
use App\Services\PaymentServices\IPaymentService;
use App\Services\PaymentServices\Exceptions\PaymentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /** @var IpaymentService */
    private $_paymentService;

    public function __construct(IPaymentService $paymentService)
    {
        $this->_paymentService = $paymentService;
    }


    public function index() {
        $user = Auth::user();

        return view("dashboard.home",compact("user"));
    }


    public function transactions() {
        $user = Auth::user();


        $transactions = $user->transactions()->paginate(5);


        return view("dashboard.transactions",compact("transactions"));
    }


    public function payment() {
        return view("dashboard.payment");
    }


    public function initiate_payment(Request $request) {
        
        $this->validate($request, [
            "amount" => "required|numeric|min:100",
            "currency" => "required"
        ]);

        $user = Auth::user();


        //Generate Reference
        do {
            $reference = Str::random(8);
        }while(Transaction::where("reference",$reference)->first());
        

        $transaction = Transaction::create([
            "user_id" => $user->id,
            "reference" => $reference ,
            "payment_gateway" => $this->_paymentService->toString(),
            "total_amount" => $request->amount,
            "gateway_charges" => $this->_paymentService->calcualteCharges($request->amount, $request->currency),
            "status" => "pending",
            "currency" => $request->currency
        ]);

        return view("dashboard.complete_payment",compact("transaction", "user"));
    }


    public function verify_payment($reference) {


        $transaction = Transaction::where("reference", $reference)->first();

        if(!$transaction) {
            abort(404);
        }

        if($transaction->status != "pending") {
            return view("dashboard.payment_reciept",compact("transaction"));
        }
        
        /** @var PaymentVerificationResponse */
        $verificationResponse = null;

        try {
            $verificationResponse = $this->_paymentService->verifyPayment($transaction->reference);
        }catch(PaymentException $e) {
        

            request()->session()->flash("danger",$e->getMessage());

            return redirect()->back();
        }


        $transaction->actual_gateway_charges = $verificationResponse->gatewayFee;
        $transaction->actual_amount_paid = $verificationResponse->amountPaid;
        $transaction->paid_on = $verificationResponse->paidOn->toDateTimeString();

        if($transaction->total_amount < $verificationResponse->amountPaid) {
            //Incomplete payment
            $transaction->status = "incomplete";
            $transaction->save();
        }

        $transaction->status = "paid";
        $transaction->save();



        return view("dashboard.payment_reciept",compact("transaction"));



      


    }
}
