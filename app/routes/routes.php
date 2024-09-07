<?php

use App\Controllers\AuthController;
use App\Controllers\BookController;
use App\Controllers\HomeController;
use App\Controllers\MessageController;
use App\Controllers\ProductController;
use App\Controllers\RatingController;
use App\Controllers\TestController;
use Phphelper\Core\Request;
use Phphelper\Core\Response;
use Phphelper\Core\Router;


$not_admin = function (Request $request,Response $response){
    $user = $request->getUser();

    $is_admin = $user->is_admin;

    if($is_admin) return $response->redirect('/admin');

};//not_admin middleware

$auth = function (Request $request,Response $response){
    
    if(! $request->isLogin()) return $response->redirect('/login');
};//auth middleware

$guest = function (Request $request,Response $response){
    $user = $request->getUser();
    if($request->isLogin()){
        if($user->is_admin) return $response->redirect('/admin'); 
        else  return $response->redirect('/');
    }

   
};//guest middleware

$user = function (Request $request,Response $response){
    if(! $request->isLogin()) return $response->redirect('/login');

    $user = $request->getUser();

    $is_admin = $user->is_admin;

    if($is_admin) return die("You don't have permission to access this resource");

};//user middleware


$admin = function (Request $request,Response $response){
    if(! $request->isLogin()) return $response->redirect('/login');

    $user = $request->getUser();

    $is_admin = $user->is_admin;

    if(!$is_admin) return die("You don't have permission to access this resource");

    $response->disableLayouts(true);

};//admin middleware


Router::addMiddleWare('guest', $guest);

Router::addMiddleWare('auth', $auth);
Router::addMiddleWare('admin', $admin);
Router::addMiddleWare('user', $user);
Router::addMiddleWare('!admin',$not_admin);









Router::get('/',[HomeController::class,'getHome'],'!admin'); //for home
// Router::get('/home',[HomeController::class,'getHome'],'!admin');
Router::get('/contact',[HomeController::class,'getContact']);


Router::get('/login',[AuthController::class,'getLogin'],'guest'); 
Router::post('/login',[AuthController::class,'login'],'guest');
//for login routing

Router::get('/register',[AuthController::class,'getRegister'],'guest');
// Router::post('/register',[AuthController::class,'register']);

Router::get('/logout',[AuthController::class,'logout'],'auth');


// Router::get('/test',[TestController::class,'index']);

//for register routing


//for book routing

Router::get('/addbook',[BookController::class,'getAddBook'],'user');
Router::get('/books',[BookController::class,'getBooks'],'user');
Router::post('/addbook',[BookController::class,'addBook'],'user');

Router::get('/viewbook',[BookController::class,'getBooks'],'user');
// Router::post('/viewbook',[BookController::class,'viewbook']);

Router::get('/editbook/{id}',[BookController::class,'getEditBook'],'user');
Router::post('/editbook',[BookController::class,'updateBook'],'user');
Router::get('/deletebook/{id}',[BookController::class,'deleteBook'],'user');

 
//genre

Router::get('/genre/{genre}',[ProductController::class,'getGenreProducts']);
Router::get('/product/{id}',[ProductController::class,'getProduct']);
// Router::get('/latest_prodcut',[ProductController::class,'getLatestproducts']);


// message 
Router::post('/message/send',[MessageController::class,'sendMessage'],'user');

Router::get('/messages',[MessageController::class,'profiles'],'user');

Router::get('/message/{user_id}',[MessageController::class,'getMessage'],'user');
Router::post('mesage',[MessageController::class,'message'],'user');

// review
Router::get('/review',[RatingController::class,'getreview'],'user');

//update_profile
// Router::get('/{user_id}',[HomeController::class,'getUpdateProfile']);
// Router::post('/',[HomeController::class,'updateProfile']);