<?php

namespace App\Controllers;

use Phphelper\Core\Request;



class TestController{

    public function index(Request $request){

        // $conn = $request->getDatabase();
        // $user = $conn->fetch("select * from users where id=? and email=?",[1,'xantosh121@gmail.com']);
        // if($user){
        //     print_r($user['id']);

        // }//
        // else{
        //     echo "NOt found";
        // }

        // $id = $conn->insert('users',['email'=>'xantosh12221@gmail.com','password'=>'123456']);
        // print_r($id);
        // $stm = $conn->query("create table users ( id INT AUTO_INCREMENT PRIMARY KEY, email varchar(30) unique, password varchar(30) )");
        // print_r($stm->id);
    }
}