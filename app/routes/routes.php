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




$auth = function (Request $request,Response $response){
    
    if(! $request->isLogin()) return $response->redirect('/login');
};//auth middleware

$guest = function (Request $request,Response $response){
   
    if( $request->isLogin()) return $response->redirect('/');
};//guest middleware



$admin = function (Request $request,Response $response){
    if(! $request->isLogin()) return $response->redirect('/login');

    $user = $request->getUser();

    $is_admin = $user->is_admin;

    if(!$is_admin) return die("You don't have permission to access this resource");

};//admin middleware


Router::addMiddleWare('guest', $guest);

Router::addMiddleWare('auth', $auth);
Router::addMiddleWare('admin', $admin);









Router::get('/',[HomeController::class,'getHome']); //for home
Router::get('/home',[HomeController::class,'getHome']);
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

Router::get('/addbook',[BookController::class,'getAddBook'],'auth');
Router::get('/books',[BookController::class,'getBooks'],'auth');
Router::post('/addbook',[BookController::class,'addBook'],'auth');

Router::get('/viewbook',[BookController::class,'getBooks'],'auth');
// Router::post('/viewbook',[BookController::class,'viewbook']);

Router::get('/editbook/{id}',[BookController::class,'getEditBook'],'auth');
Router::post('/editbook',[BookController::class,'updateBook'],'auth');
Router::get('/deletebook/{id}',[BookController::class,'deleteBook'],'auth');

 
//genre

Router::get('/genre/{genre}',[ProductController::class,'getGenreProducts']);
Router::get('/product/{id}',[ProductController::class,'getProduct']);
// Router::get('/latest_prodcut',[ProductController::class,'getLatestproducts']);


// message 
Router::post('/message/send',[MessageController::class,'sendMessage'],'auth');

Router::get('/messages',[MessageController::class,'profiles'],'auth');

Router::get('/message/{user_id}',[MessageController::class,'getMessage'],'auth');
Router::post('mesage',[MessageController::class,'message'],'auth');

// review
// Router::get('/review',[RatingController::class,'getreview'],'auth');

//update_profile
// Router::get('/{user_id}',[HomeController::class,'getUpdateProfile']);
// Router::post('/',[HomeController::class,'updateProfile']);