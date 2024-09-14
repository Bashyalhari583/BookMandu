<?php 

namespace   App\Controllers;


class RequestSender{
    public static function send($user_id,$book_id=""){

    $curl = curl_init();


    curl_setopt_array($curl, [
    CURLOPT_URL => 'http://localhost:3000/show/similar?user_id='.$user_id."&book_id=".$book_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
 ]);

    $response = curl_exec($curl);

    if(!$response){
        die("Something went wrong recommending error");
    }
    curl_close($curl);
    return  json_decode($response,true);
    }//
}