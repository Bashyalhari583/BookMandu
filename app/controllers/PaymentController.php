<?php

namespace App\Controllers;

use Phphelper\Core\Request;
use Phphelper\Core\Response;
use Phphelper\Core\Router;

class PaymentController{

    #[Router(path:'/pay/{id}',middleware:'auth')]
    public function paymentStart(Request $request,Response $response,$params){
        $id = $params->id;

        $db = $request->getDatabase();
        $book = $db->fetchOne('books',['id'=>$id]);
        if(!$book){
            die("Book not found");
        }


        $name = $book['name'];
        $price = $book['price'] * 100;

        // $response->redirect()
        $responseKhalti = Payment::initiatePayment($id,$name,$price );
        if(  ! isset($responseKhalti['payment_url']) ){
            print_R($responseKhalti);
            die("Something went wrong initiating the request.Try again later");
        }

        $paymentUrl = $responseKhalti['payment_url'];
        // $paymentUrl = "https://test-pay.khalti.com/?pidx=LQunWqFXVD7Tb7mVDZgqUA";
        return $response->redirect($paymentUrl);

    }//payment start
}