<?php

namespace App\Controllers;

use Phphelper\Core\Request;
use Phphelper\Core\Response;
use Phphelper\Core\Router;

class AuthController{

    public function getLogin(Request $req,Response $res){
       
         return  $res->disableLayouts(true)->render("auth/login");
    }//getlogin

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
            if ($user['email_verified_at'] == null) {
                return $response->redirect("/verify_email/" . $user['id']);
            }
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
            $errors['email_e'] = 'Invalid Email';
        }//email
        else{

            $user = $db->fetchOne('users',['email'=>$email]);
            if($user){
            $errors['email_e'] = 'Email already exists';

            }

        }
      
        if(!$password || strlen($password)<8 ){
            $errors['password_e'] = 'Password must be greater than 8 chars';
        }else if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/', $password)) {
            $errors['password_e'] = 'Password must include at least one uppercase letter, one lowercase letter, one digit, and one special character';
        }//password
        if(!$confirm_password==$password ){
            $errors['confirm_password_e'] = 'Confirm Password not matched';
        }//confirm_password
        if(!$name || strlen($name)<3 ){
            $errors['name_e'] = 'Invalid Name';
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
        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $subject = 'Email verification';
        $body = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';


    



        $is_development_mode = getenv('IS_DEVELOPMENT_MODE');
        if($is_development_mode=="no"){
            
            $isMailSent = MailSender::send( $email, $name, $subject, $body );

            if(!$isMailSent) {
                echo "Email cannot be send";
                die();
                // $errors['email'] = 'Email server is not working to send otp. So registration is cancelled for now';
                // return $res->redirect(null,['errors'=>$errors,'email'=>$email ] );
            }


        }//if development mode is no, then send the actual email

        else{
            $verification_code = getenv('DUMMY_DEFAULT_OTP');
        }//dont send the actual email.. Default verification code from .env
       
    
        $id = $db->insert('users',['verification_code'=>$verification_code,'email'=>$email,'password'=>$hashedPassword,'name'=>$name,'phone'=>$phone,'cover_pic'=>$cover_path,'profile_pic'=>$profile_path]);
        if(!$id){
            die("Something went wrong inserting the user");

            // return $res->disableLayouts(true)->render("auth/register",['error'=>'Something went wrong']);
        }
            // return $res->redirect('/login');

        

        //using php mailer.sending the email in the validate email id because authorize the user are login.
        
          //email sending process
    
  
          return $res->redirect("/verify_email/$id");

        }//register of


        
    #[Router(path:'/verify_email/{id}', method:'GET')]
    public function getVerifyEmail(Request $request,Response $response,$params){
        $id = $params->id;
        $expiryMinutes = getenv('OTP_EXPIRY_DURATION_MINUTES');
        $response->disableLayouts(true);
        $response->withHeader('layouts/header');
        return $response->render('auth/email_verify',['id'=>$id,'expire'=>$expiryMinutes]);

    }//getverifyemail

    #[Router(path:'/verify_email', method:'POST')]
    public function verifyEmail(Request $request,Response $response){
        $id = $request->id;
        $verification_code = $request->verification_code;

        $date = date("Y-m-d H:i:s");
        // $sql = "UPDATE tenant SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "' AND otp_created_at > NOW() - INTERVAL 2 MINUTE";
        
        $db = $request->getDatabase();

        $user = $db->fetchOne('users',['id'=>$id]);
        if(!$user){
            return $response->redirect(null,['id'=>$id,'error'=>"This user is not found"]);
        }
        if($user['email_verified_at'] != null){
            return $response->redirect(null,['id'=>$id,'error'=>"User is already verified. You may proceed to login"]);
        }

        $otp = $user['verification_code'];

        if($otp != $verification_code){
            return $response->redirect(null,['id'=>$id,'error'=>"OTP is wrong"]);
        }

        $expiryMinutes = getenv('OTP_EXPIRY_DURATION_MINUTES');
        $result = $db->query("UPDATE users set email_verified_at = NOW() where id = ? and verification_code = ?  and otp_created_at > NOW() - INTERVAL $expiryMinutes MINUTE",[$id,$verification_code]);
        
        print_r($result);
        if($result->affected_rows>0){
            return $response->redirect('/login'.$user['role']);
        }
        else{
            return $response->redirect(null,['id'=>$id,'error'=>"OTP is expired"]);
        }



    }//verify email

    #[Router(path:'/resend_otp', method:'POST')]
    public function resendOtp(Request $request,Response $response){
        $user_id = $request->id;
        $db = $request->getDatabase();

        $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
        $subject = 'Email verification';
        $body = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';


        $is_development_mode = getenv('IS_DEVELOPMENT_MODE');
        if($is_development_mode=="no"){

            $user = $db->fetchOne('users',['id'=>$user_id]);

            
            $isMailSent = MailSender::send( $user['email'], $user['full_name'], $subject, $body );

            if(!$isMailSent) {
                return $response->redirect(null,['id'=>$user_id,'error'=>"OTP cannot be sent due to some errors"]);
                
            }

        }//if development mode is no, then send the actual email
        else{
            $verification_code = (int)(getenv('DUMMY_DEFAULT_RESEND_OTP'));
        }//dont send the actual email.. Default verification code from .env
       

        $isUpdate = $db->query('UPDATE users set verification_code = ? , otp_created_at = NOW() where id = ?',[$verification_code,$user_id]);
        if($isUpdate->affected_rows==0){
            return $response->redirect(null,['id'=>$user_id,'error'=>"OTP cannot be sent due to some errors"]);
        }

        return $response->redirect(null,['msg'=>"Otp is sent successfully"]);
        
 
     }//resend otp

    //}//regiset

    public function logout(Request $req){
        $req->logout();
    }


}