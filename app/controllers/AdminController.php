<?php


namespace App\Controllers;
use Phphelper\Core\Request;
use Phphelper\Core\Response;
use Phphelper\Core\Router;

class AdminController{

    #[Router(path:'/admin',method:'GET',middleware:'admin')]

    public function home(Request $request, Response $response){
        // $db = $request->getDatabase();

        // $book = $db->fetchAllSql('SELECT * FROM books ORDER BY created_at DESC');
        // $categories = $request->getDatabase()->fetchAll('categories',[]);
        return $response->withHeader('layouts/admin_header')->disableLayouts(true)->render("admin/admin");
    }//admin

   
    // #[Router(path:'/viewbook_admin',method:'POST')]
    // public function Admin(Request $request,Response $response){
    //     $db = $request->getDatabase();

    //     $book = $db->fetchAllSql('select books.*, categories.name as category_name from books join categories on books.category_id = categories.id where user_id = ?',[$request->getUser()->id]);
    //     $data = ['books'=>$book ];
    //     return $response->render('admin/viewbook_admin',$data);
    // }

}//adminController