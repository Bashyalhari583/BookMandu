<?php

namespace App\Controllers;

use Phphelper\Core\Request;
use Phphelper\Core\Response;
use Phphelper\Core\Router;

class ProfileController{

    #[Router(path:'/profile/{id?}',method:'GET')]
    public function getProfile(Request $request,Response $response,$params){
        $id = $params->id;
        $viewer_id = $request->getUser()->id;
        if(!$id){
            $id = $request->getUser()->id;
        }

        $db = $request->getDatabase();

        $is_rating_allow = true;


        if($viewer_id == $id) $is_rating_allow = false;

        // $ratingByViewer = $db->fetchOne('ratings',['other_id'=>$id,'user_id'=>$viewer_id]);
        // if($ratingByViewer) $is_rating_allow = false;

       

        $user = $db->fetchOne('users',['id'=>$id]);
        if(!$user) die("User with id `$id` is not exist");

        $rating = $db->fetchOneSql("SELECT AVG(rating) as rcount from ratings where other_id = ? ",[$id])['rcount'];
        // print_r($rating);
        if(!$rating) $rating = 0;

        $rating = round($rating,1);
        return $response->render('profile/profile',['profile'=>$user,'rating'=>$rating,'is_rating'=>$is_rating_allow]);
 
    }//get PRofile


    #[Router(path:'/update_profile',method:'POST')]
    public function updateProfile(Request $request,Response $response){
        $name = $request->name;
        $phone = $request->phone;

        $id = $request->getUser()->id;

        if(!$name || strlen($name)<6){
            die("Name must be greater than 5 chars");
        }

        if(!$phone || strlen($phone)!=10){
            die("Phone must be 10 chars long");
        }

        $isUpdated = $request->getDatabase()->update('users',['name'=>$name,'phone'=>$phone],['id'=>$id]);
        return $response->redirect();

    }//updateProfile


    #[Router(path:'/update_profile_image',method:'POST')]
    public function updateProfileImages(Request $request,Response $response){

        
        $id = $request->getUser()->id;
        $db = $request->getDatabase();

        if( $request->hasFile('profile_pic')  ){
            if(!$request->isImageSupported('profile_pic')) die("Profile pic uploaded is not supported");


            $user = $db->fetchOne('users',['id'=>$id]);

            $db_profile_pic_path = "/public/uploads/". $user['profile_pic'];

            if( file_exists($db_profile_pic_path) ){
                unlink($db_profile_pic_path);
            }

            $path = $request->uploadImage('profile_pic');
            if(!$path) die("Something went wrong uploading the profile picture image");

            $isUpdated = $db->update('users',['profile_pic'=>$path],['id'=>$id]);
            if(!$isUpdated) die("Something went wrong updating the profile picture");

        

        }//if profile

        if( $request->hasFile('cover_pic')  ){
            if(!$request->isImageSupported('cover_pic')) die("Cover pic uploaded is not supported");


            $user = $db->fetchOne('users',['id'=>$id]);

            $db_profile_pic_path = "/public/uploads/". $user['cover_pic'];

            if( file_exists($db_profile_pic_path) ){
                unlink($db_profile_pic_path);
            }

            $path = $request->uploadImage('cover_pic');
            if(!$path) die("Something went wrong uploading the Cover picture image");


            $isUpdated = $db->update('users',['cover_pic'=>$path],['id'=>$id]);
            if(!$isUpdated) die("Something went wrong updating the Cover picture");

        }//if cover

        return $response->redirect();


    }//updateProifle


}