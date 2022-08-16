<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    //

    public function index()
    {
        
        return view('index');
    }

    public function pay_two(Request $request)
    {       
        $clientIP = $request->ip(); 
        $appUrl = env('APP_URL');
        $data = $request->expire_date;
        $date = explode('/', $data);
        $month = intval($date[0]);
        $year = intval($date[1]);
        $params = [
            "amount" => 100.00,
            "currency" => "NGN",
            "action" => "Authorize",
            "customer" => [
                "firstName" => "Anochie",
                "lastName" => "Nwabueze",
                "email" => "anochienwabueze@gmail.com",
                "phone" => "08161155633",
                "accountReference" => "acc0002",
                "address" => [
                    "streetAddress" => "Phase 3 Road",
                    "city" => "Gwagwalada",
                    "postcode" => "902101",
                    "country" => "NG"
                ]
            ],
            "source"=>[
                "paymentMethod"=>$request->card_type,
                "holder"=>$request->name,
                "cardNumber"=>$request->card_number,
                "expiryMonth"=>$month,
                "expiryYear"=>$year,
                "cvc"=>$request->cvc,
                "billingAddress" => [
                    "streetAddress"=>"3 Malpas Road",
                    "city"=>"Great Sutton",
                    "postcode"=>"+234",
                    "country"=>"NG"
                ]
            ],
            "statementDescriptor" => "Purchase my-shop.com",
            "Description" => "T-Shirt XXL",
            "Reference" => "ORD24234",
            "ipAddress" =>   $clientIP,
            "successUrl" =>  $appUrl ."/payment/success",
            "cancelUrl" =>  $appUrl ."/payment/cancel",
            "failureUrl" =>  $appUrl."/payment/failed"
        ];

        $url = 'https://api.quadropay.co.uk/v1/transactions';
        $username = env('QUADROPAY_KEY');
        $password = env('QUADROPAY_SECRET');
        
        $response = Http::withBasicAuth($username,  $password)
                        ->post($url,$params);
        $response = $response->json();
        $paymentFormUrl = $response['links'][0]['href'];

        return redirect()->away($paymentFormUrl);
    }

    public function pay()
    {       
        $clientIP = request()->ip(); 
        $params = [
            "amount" => 50.00,
            "currency" => "NGN",
            "action" => "Authorize",
            "customer" => [
                "firstName" => "Anochie",
                "lastName" => "Nwabueze",
                "email" => "anochienwabueze@gmail.com",
                "phone" => "08161155633",
                "accountReference" => "acc0002",
                "address" => [
                    "streetAddress" => "Phase 3 Road",
                    "city" => "Gwagwalada",
                    "postcode" => "902101",
                    "country" => "NG"
                ]
            ],
            "statementDescriptor" => "Purchase my-shop.com",
            "Description" => "T-Shirt XXL",
            "Reference" => "ORD24234",
            "ipAddress" =>  '102.91.5.30',
            "successUrl" => "http://localhost/todo/public/payment/success",
            "cancelUrl" => "http://localhost/todo/public/payment/cancel",
            "failureUrl" => "http://localhost/todo/public/payment/failed"
        ];

        $url = 'https://api.quadropay.co.uk/v1/transactions';
        $username = 'live_z7s9563wyrfw';
        $password = 'k768aja8mixtjmgziezevz318r27ml';
        
        $response = Http::withBasicAuth($username,  $password)
                        ->post($url,$params);
        $response = $response->json();
        $paymentFormUrl = $response['links'][0]['href'];

        return redirect()->away($paymentFormUrl);
    }

    public function transaction()
    {
        $url = 'https://api.quadropay.co.uk/v1/transactions';
        $username = 'test_tiwqej6416dw';
        $password = 'gm3d1n5mfed0rwp1msy4u17qzbg1mt';
        
        $response = Http::withBasicAuth($username,  $password)
                        ->get($url);
        $data = $response->json();
        dd($data);
    }

    public function success()
    {
        return view('success');
    }
    
    public function cancel()
    {
        return view('cancel');
    }

    public function failed()
    {
        return view('failed');
    }
}
