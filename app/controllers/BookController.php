<?php

namespace App\Controllers;

use Phphelper\Core\Request;
use Phphelper\Core\Response;
use Phphelper\Core\Router;

class BookController{


    #[Router(path:'/search_book', method:'POST')]
    public function searchBook(Request $request,Response $response){

        $text = $request->search_book;
        $category = $request->category;
        $price_range = $request->price_range;

        $conditions = array();

        $sql = "SELECT * from books where state=? and is_available=? and  ";

        // Add conditions based on search input
        if (!empty($text)) {
            $conditions[] = "CONCAT(name, city, author, publication_year, description, quality) LIKE '%$text%' ";
        }
    
        if (!empty($category)) {
            $conditions[] = "category_id = '$category'";
        }
     
        if (!empty($price_range)) {
            // Parse the price range into minimum and maximum values
            
            $price_parts = explode('-', $price_range);
            $min_price = (int)trim($price_parts[0]);
            $max_price = (int)trim($price_parts[1]);
            $conditions[] = "price BETWEEN $min_price AND $max_price";
        }
    
        // Append conditions to the SQL query
        if (!empty($conditions)) {
            $sql .= "  " . implode(' AND ', $conditions);
        } 


        $db = $request->getDatabase();
        // print_r($sql);
        $books = $db->fetchAllSql($sql,['active',true]);

        return $response->json($books);

    }//search book
    public function getAddBook(Request $request,Response $response){
        $categories = $request->getDatabase()->fetchAll('categories',[]);
        $data = [
            'categories'=>$categories
        ];
        return $response->disableLayouts(true)->render('book/addbook',$data);
    } //addbook

    public function getEditBook(Request $request,Response $response,$params){
        $book_id = $params->id;
        $user_id = $request->getUser()->id;

        $db = $request->getDatabase();
        // $books = $db->fetchAllSql('select books.*, categories.name as category_name from books join categories on books.category_id = categories.id where user_id = ?',[$request->getUser()->id]);

        $book = $db->fetchOne('books',['id'=>$book_id,'user_id'=>$user_id]);
        $categories = $db->fetchAll('categories',[]);

        $data = [
            'book'=>$book,
            'categories'=>$categories
        ];
        // print_r($data);
        
        // category_id = 2
        //fetch all categories 

        // $book = $db->fetch('select * from books where id = ? and user_id = ?',[$book_id,$user_id]);
        if(!$book){
            echo "This book is not found";
            return;
        }//

        $response->disableLayouts(true)->render('book/editBook',$data);

    } //editbook

    public function deleteBook(Request $request,Response $response,$params){
        $user_id = $request->getUser()->id;
        $book_id = $params->id;
        
        $db = $request->getDatabase();
        $id = $db->delete('books',['user_id'=>$user_id,'id'=>$book_id]);

        if(!$id){
            echo "Something went wrong deleting the book";
            return;
        }
        $response->redirect("/books");

    }//deletebook

    #[Router(path:'/soldbook/{id}',middleware:'auth')]
    public function soldBook(Request $request,Response $response,$params){
        $user_id = $request->getUser()->id;
        $book_id = $params->id;

    
        $db = $request->getDatabase();

        $book = $db->fetchOne("books",['id'=>$book_id,'user_id'=>$user_id]);
        if(!$book) die("Book not found");

        if($book['is_available']) $id = $db->update('books',['is_available'=>false],['user_id'=>$user_id,'id'=>$book_id]);
        else  $id = $db->update('books',['is_available'=>true],['user_id'=>$user_id,'id'=>$book_id]);

        if(!$id){
            echo "Something went wrong updating the book";
            return;
        }
        $response->redirect("/books");

    }//deletebook


    public function getBooks(Request $request,Response $response){

        $db = $request->getDatabase();
        // $books = $db->fetchAll('books',['user_id'=>$request->getUser()->id]);
        
        $books = $db->fetchAllSql('select books.*, categories.name as category_name from books join categories on books.category_id = categories.id where user_id = ?',[$request->getUser()->id]);
        // print_r($books);
        $data = [ 'books'=>$books ];
        return $response->withHeader('layouts/book_header')->disableLayouts(true)->render('book/viewbook', $data);
    }//


    public function addBook(Request $request,Response $response){

        $name = $request->name;
        $author = $request->author;
        $publication_year = $request->publication_year;
        $description = $request->description;
        $user_id = $request->getUser()->id;
        $category_id = $request->category;
        $quality = $request->quality;
        $city = $request->city;
        $price = $request->price;

        // print_r($image);



        // echo $hashedName;
        // print_r($_POST);

        // print_r(count($image));

        $errors =[];

        $db = $request->getDatabase();
        $category = $db->fetchOne('categories',['id'=>$category_id]);

        if(!$category) $errors['category'] = "Category is invalid";

        // $category_id = $category["id"];

        if(!$name || !$author || !$publication_year || !$description || !$quality || !$city || !$price ){
            $errors["error"] = "Error occured in the data";
        }

        // if(!$name || strlen($name)<3){
        //     $errors["name"] = "Error occured in the name data";
        // }//name
        // if(!$author || strlen($author)<3){
        //     $errors["author"] = "Error occured in the author data";
        // }//author
        // if(!$publication_year){
        //     $errors["publication_year"] = "Error occured in publication year";
        // }//publication year
        // if(!$description || strlen($description)<500){
        //     $errors["description"] = "Error occured in description";
        // }//description
        // if(!$quality){
        //     $errors["quality"] = "Error occured in quality";
        // }//quality
        // if(!$city){
        //     $errors["city"] = "Error occured in city";
        // }//city
        // if(!$price ){
        //     $errors["price"] = "Error occured in price";

        // }//price

       // print_r($_POST);
        if(count($errors)>0  ){
            echo "Something went wrong"; //render the same page and pass the errors
            return;
        }

        
        if(!$request->hasFile('image')){
            echo "Please upload Image";
            return;
        }

        $isImage = $request->isImageSupported('image');
        if(!$isImage){
            echo "Image is not supported or corrupted";
            return;
        }

       $imgPath =  $request->uploadImage('image'); //image is uploading
       if(!$imgPath){
        echo "Something went wrong uploading image";
        return;
       }


        $id = $db->insert('books',['name'=>$name,'author'=>$author,'publication_year'=>$publication_year,'description'=>$description,'user_id'=>$user_id,'category_id'=>$category_id,'quality'=>$quality,'city'=>$city,'price'=>$price,'image_url'=>$imgPath]);
        if(!$id){
            echo "Something went wrong";
            return;
        }

        $response->redirect('/books');


        
    }//


    public function updateBook(Request $request,Response $response){
        $id = $request->id;
        $name = $request->name;
        $author = $request->author;
        $publication_year = $request->publication_year;
        $description = $request->description;
        $user_id = $request->getUser()->id;
        $category_id = $request->category;
        $quality = $request->quality;
        $city = $request->city;
        $price = $request->price;
        $image = $request->image;

        $errors =[];

        $db = $request->getDatabase();
        $category = $db->fetchOne('categories',['id'=>$category_id]);

        if(!$category) $errors['category'] = "Category is invalid";

        // $category_id = $category["id"];
        // print_r($request);
        if( !$id || !$name || !$author || !$publication_year || !$description || !$quality  || !$city || ((int)$price)<10 ){
            $errors["error"] = "Error occured in the data";
        }

        // if(count($errors)>0  ){
        //     echo "Something went wrong"; //render the same page and pass the errors
        //     print_r($errors);
        //     return;
        // }
        $imgPath =  $request->uploadImage('image'); //image is uploading
       if(!$imgPath){
        echo "Something went wrong uploading image";
        return;
       }

        $id = $db->update('books',['name'=>$name,'author'=>$author,'publication_year'=>$publication_year,'description'=>$description,'category_id'=>$category_id,'quality'=>$quality,'city'=>$city,'price'=>$price,'image_url'=>$imgPath],['id'=>$id,'user_id'=>$user_id]);
        
        // print_r($id);
        if(!$id){
            echo "Something went wrong";
            return;
        }

        $response->redirect('/books');


        
    }//
}