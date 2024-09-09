<?php 

namespace   App\Controllers;


class Payment{
    public static function initiatePayment($bookId,$bookName,$amount){

    $curl = curl_init();

    $payload =[
    "return_url"=> "http://localhost",
    "website_url"=> "http://localhost",
    "amount" => $amount,
    "purchase_order_id" => "$bookId",
    "purchase_order_name" => "$bookName",
   
    ];


    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($payload) ,
    CURLOPT_HTTPHEADER => [
        'Authorization: key '.getenv('KHALTI_SECRET_KEY'),
        'Content-Type: application/json',
    ],
    ));

    $response = curl_exec($curl);

    if(!$response){
        die("Something went wrong inititing the payment");
    }
    curl_close($curl);
    return  json_decode($response,true);
    }//
}