<?php

namespace   App\Controllers;
use Phphelper\Core\Request;
use Phphelper\Core\Response;

class MessageController{
    public function getMessage(Request $request,Response $response,$params){
        $user_id = $params->user_id;
        $logined_user = $request->getUser()->id;
    
    
        $db = $request->getDatabase();
        // $userInfo = $db->get
    
        $user = $db->fetchOne('users',['id'=>$user_id]);
    
        if(!$user) die("No user exists for this id");

        $messages = $db->fetchAllSql('select * from messages where (sender_id= ? and receiver_id = ? ) or (sender_id = ? and receiver_id = ?)',[$user_id,$logined_user,$logined_user,$user_id]);
    
    
        return $response->render('messages/view_messages',['messages'=>$messages,'user_id'=>$logined_user,'other_id'=>$user_id,'dest_user'=>$user]);
    }

    public function profiles(Request $request,Response $response){
        $db = $request->getDatabase();
        $id = $request->getUser()->id;

        
        $users = $db->fetchAllSql("
        
        SELECT DISTINCT u.*
        FROM users u
        JOIN 

       ( SELECT DISTINCT 
                IF(sender_id = $id, receiver_id, sender_id) AS user_id

                FROM messages
                WHERE sender_id = $id OR receiver_id = $id 
                ) as p on p.user_id = u.id

                ");

                // print_r($users);
               

        return $response->render('messages/view_profiles',['users'=>$users]);




    }//
    public function sendMessage(Request $request,Response $response){
        $rec_id = $request->receiver_id;
        $content = $request->content;
        

        if(!$content &&  !$request->hasFile('image')){
            die("Empty messages are not allowed");
        }

        if(!$rec_id) die("User not  found.");

        $path = null;

        if( $request->hasFile('image') ){
            $path = $request->uploadImage('image');
            if(!$path) die("Something went wrong uploading image");
        }



        // if($request)

        $sender_id = $request->getUser()->id;
    
    
        $db = $request->getDatabase();

        $isMessageInserted = $db->insert('messages',['content'=>$content,'sender_id'=>$sender_id,'receiver_id'=>$rec_id,'image'=>$path]);
        if(!$isMessageInserted) die("Message is not sent. Somehting went wrong");

        return $response->redirect("/message/$rec_id");
    }




}