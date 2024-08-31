<?php

namespace App\Controllers;

use Phphelper\Core\Request;
use Phphelper\Core\Response;

class HomeController{
    public function getHome(Request $request,Response $response){
       
        $db = $request->getDatabase();
       
    
        $books = $db->fetchAllSql('SELECT * FROM books ORDER BY created_at DESC');
        $categories = $request->getDatabase()->fetchAll('categories',[]);
        

        return $response->render("home/home",['books'=>$books,'categories'=>$categories]);
    }//index

    public function getContact(Request $request,Response $response){
        return $response->render("home/contact");
    }

    public function getProductDisplay(Request $request,Response $response){
        return $response->render("home/productdisplay");
    }

   public function getAbout(Request $request, Response $response){
    $response->render("home/about");
   }

  
}//update_profile