<?php

namespace App\Controllers;

use Phphelper\Core\Request;
use Phphelper\Core\Response;

class ProductController{
    public function getGenreProducts(Request $request,Response $response,$params){
        $genre = $params->genre;
        $db = $request->getDatabase();
        $category = $db->fetchOne('categories',['name'=>$genre]);
        if(!$category){
            return $response->render('error/error',['error'=>$genre.' genre is not found']);
        }
        $category_id = $category['id'];
    
        $books = $db->fetchAll('books',['category_id'=>$category_id,'state'=>'active']);
        
        return $response->render('genre/list_genre_books',['genre'=>$genre,'books'=>$books]);
    }//getGenreProduct

    public function getproduct(Request $request,Response $response,$params){
        $book_id = $params->id;
        $db = $request->getDatabase();
        

    
        $book = $db->fetchOne('books',['id'=>$book_id,'state'=>'active']);
        if(!$book){
            return $response->render('error/error',['error'=>'This book is not found']);
        }

        //recommendation process

        $recommendedBook = [];
        if($request->isLogin()){
            $user_id = $request->getUser()->id;
            $book_view = $db->fetchOne('book_views',['post_id'=>$book_id,'user_id'=>$user_id]);
            if(!$book_view){
                $db->insert('book_views',['post_id'=>$book_id,'user_id'=>$user_id]);
            }



            $ids = RequestSender::send($user_id);
            if(count($ids)!=0 ){
                $idsStr = implode(' , ',$ids);
                print($idsStr);
                
                $recommendedBook = $db->fetchAllSql("select * from books where id in ($idsStr) and id != $book_id  ORDER BY FIELD(id, $idsStr)");    
             
    
            }
          


        }//if login








        //end here
        //here
        //


        $category_id = $book['category_id'];
        $category = $db->fetchOne('categories',['id'=>$category_id]);
        if(!$category){
            return $response->render('error/error',['error'=>'Category is not found']);
        }


        $user_id = $book['user_id'];
        
        $user = $db->fetchOne('users',['id'=>$user_id]);
       
        if(!$user){
            return $response->render('error/error',['error'=>'User is not found.']);
        }
        
        return $response->render('product/product_display',['book'=>$book,'seller'=>$user,'category'=>$category['name'],'recommends'=>$recommendedBook  ]);
    }//getGenreProduct





}