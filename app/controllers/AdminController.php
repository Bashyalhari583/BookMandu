<?php


namespace App\Controllers;
use Phphelper\Core\Database;
use Phphelper\Core\Request;
use Phphelper\Core\Response;
use Phphelper\Core\Router;

class AdminController{

    #[Router(path:'/admin/user/delete',method:'POST',middleware:'admin')]
    public function deleteUser(Request $request, Response $response){
    
        $user_id = $request->id;
        if(!$user_id) return die("Please provide user id");
        $db = $request->getDatabase();

        $delete_user = $db->delete('users',['id'=>$user_id]);
        return $response->redirect();
        // return $response->render("admin/admin_users",['users'=>$users]);
    }//user-books

    #[Router(path:'/admin/book/delete',method:'POST',middleware:'admin')]
    public function deleteBook(Request $request, Response $response){
    
        $book_id = $request->id;
        if(!$book_id) return die("Please provide book id");
        $db = $request->getDatabase();

        $delete_user = $db->delete('books',['id'=>$book_id]);
        return $response->redirect();
        // return $response->render("admin/admin_users",['users'=>$users]);
    }//delete-books

    #[Router(path:'/admin/book/review',method:'POST',middleware:'admin')]
    public function reviewBook(Request $request, Response $response){
    
        $book_id = $request->id;
        $state = $request->state;
        if(!$book_id || !$state) return die("Please provide book id or state correctly");
        $db = $request->getDatabase();

        $isUPdated = $db->update('books',['state'=>$state],['id'=>$book_id]);
        return $response->redirect();
        // return $response->render("admin/admin_users",['users'=>$users]);
    }//delete-books

    #[Router(path:'/admin',method:'GET',middleware:'admin')]

    public function home(Request $request, Response $response){
        $db = $request->getDatabase();
        $total_users = $db->fetchOneSql("SELECT count(*) AS total_users from users")['total_users'];
       $total_books = $db->fetchOneSql("SELECT count(*) AS total_books from books")['total_books'];

       $books = $db->fetchAllSql("SELECT * from books ORDER BY created_at DESC LIMIT 15");
       
    

       $data = [
            'user_count'=>$total_users,
            'book_count'=>$total_books,
            'books'=>$books
       ];

        return $response->disableLayouts(true)->render("admin/admin_home",$data);
    }//admin


    

    #[Router(path:'/admin/users',method:'GET',middleware:'admin')]

    public function users(Request $request, Response $response){
    
        $db = $request->getDatabase();
        
        $users = $db->fetchAllSql('SELECT * FROM users  where is_admin=0 order by id desc');

        return $response->render("admin/admin_users",['users'=>$users]);
    }//admin

    #[Router(path:'/admin/books',method:'GET',middleware:'admin')]

    public function books(Request $request, Response $response){
    
        $db = $request->getDatabase();
        
        $users = $db->fetchAllSql('SELECT * FROM books   order by created_at desc');

        return $response->render("admin/admin_books",['books'=>$users]);
    }//admin
    
    #[Router(path:'/admin/reviews',method:'GET',middleware:'admin')]

    public function reviewBooks(Request $request, Response $response){
    
        $db = $request->getDatabase();
        
        $users = $db->fetchAllSql('SELECT * FROM books where state=?  order by created_at desc',['pending']);

        return $response->render("admin/admin_review",['books'=>$users]);
    }//admin

}//adminController