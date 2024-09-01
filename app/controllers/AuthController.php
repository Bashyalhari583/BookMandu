<?php

namespace App\Controllers;

use Phphelper\Core\Request;
use Phphelper\Core\Response;
use Phphelper\Core\Router;

class AuthController{

    public function getLogin(Request $req,Response $res){
       
         return  $res->disableLayouts(true)->render("auth/login");
    }//

    public function login(Request $request,Response $response){
        $email = $request->email;
        $password = $request->password;
        
        if( !$email || !$password  || strlen($email)<6 || strlen($password)<6){
            return $response->disableLayouts(true)->render('auth/login',['error'=>'Please provide proper details']);
        }
        

        $db = $request->getDatabase();
        $hashedPassword = hash('sha256',$password);
        // echo $email.$password;
        $user = $db->fetchOne('users',['email'=>$email,'password'=>$hashedPassword]);
        // print_r($user);
        if($user){
            $request->setUser($user);
            return $response->redirect('/');
        }
        //if not found this show this error below

        return $response->disableLayouts(true)->render('auth/login',['error'=>'Invalid Credentials']);


    }//login

    public function getRegister(Request $req,Response $res){
       
        return $res->disableLayouts(true)->render('auth/register');
    }



// Router::post('/register',[AuthController::class,'register']);


    #[Router(path:'/register',method:'POST')]
    public function register(Request $req,Response $res){

        $email = $req->email;
        $password = $req->password;
        $confirm_password = $req->confirm_password;
        $name = $req->name;
        $phone = $req->phone;

        $db = $req->getDatabase();

        // $profile_pic = $req->profile_pic;
        // $cover_pic = $req->cover_pic;

        //1. validation, 2. email already , 3. uplaod images, 4. insert data. 5. if erro insert, 6. delete the image

        $errors = [];

        if(! $req->hasFile('profile_pic')){
            $errors['profile_pic_e'] = "Profile Picture must be selected";
        }
        else if( ! $req->isImageSupported('profile_pic')){
            $errors['profile_pic_e'] = "The image is not supported";
        }



        if( $req->hasFile('cover_pic') && !$req->isImageSupported('cover_pic')){
            // die("Hello");
            $errors['cover_pic_e'] = "The image is not supported";
        }
     
        if(!$email || strlen($email)<6 ){
            $errors['email_e'] = 'Email must be greater than 6 chars';
        }//email
        else{

            $user = $db->fetchOne('users',['email'=>$email]);
            if($user){
            $errors['email_e'] = 'Email already exists';

            }

        }
      
        if(!$password || strlen($password)<8 ){
            $errors['password_e'] = 'Password must be greater than 8 chars';
        }//password
        if(!$confirm_password==$password ){
            $errors['confirm_password_e'] = 'Confirm Password not matched';
        }//confirm_password
        if(!$name || strlen($name)<3 ){
            $errors['name_e'] = 'Name must be greater than 6 chars';
        }//name
        if(!$phone || strlen($phone)<10 ){
            $errors['phone_e'] = 'Phone must be greater than or equal to  10 chars';
        }//phone

        if( count($errors) > 0){
            $errors['email'] = $email;
            $errors['password'] = $password;
            $errors['name'] = $name;
            $errors['confirm_password'] = $confirm_password;
            $errors['phone'] = $phone;
            return $res->redirect(null,$errors);
        }

    
       


        //starting uploadig images
        $profile_path = $req->uploadImage('profile_pic');
        if(!$profile_path){
            die("Something went wrong uplaoding profile image");
        }

        

        $cover_path = null;
        if($req->hasFile('cover_pic')){
            $cover_path = $req->uploadImage('cover_pic');
            if(!$cover_path){
                die("Something went wrong uplaoding cover image");
            }//
        }//if cover

        $hashedPassword = hash('sha256', $password);

        // if($cover_path)
       
        $id = $db->insert('users',['email'=>$email,'password'=>$hashedPassword,'name'=>$name,'phone'=>$phone,'cover_pic'=>$cover_path,'profile_pic'=>$profile_path]);
        if(!$id){
            die("Something went wrong inserting the user");
            // return $res->disableLayouts(true)->render("auth/register",['error'=>'Something went wrong']);
        }
        return $res->redirect('/login');

    }//regisetr

    public function logout(Request $req){
        $req->logout();
    }


}