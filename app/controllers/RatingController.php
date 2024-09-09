<?php

namespace App\Controllers;
use Phphelper\Core\Request;
use Phphelper\Core\Response;
use Phphelper\Core\Router;

class RatingController{

    #[Router(path:"/rating",method:'POST',middleware:'auth')]
    public function rating(Request $request,Response $response){
        
        $other_id = $request->id;
        $user_id = $request->getUser()->id;
        $rating = (int) $request->rating;

        if($other_id == $user_id)  die("Same user can't rate yourself");
        if($rating <=0 || $rating >5){
            die("Rating must be between 1 to 5");
        }//rating chekc
        $db = $request->getDatabase();

        $ratingTable = $db->fetchOne("ratings",['user_id'=>$user_id,'other_id'=>$other_id]);
        if($ratingTable){
            $db->update('ratings',['rating'=>$rating],['user_id'=>$user_id,'other_id'=>$other_id]);
            return $response->redirect();
        }

        $ratingNew = $db->insert('ratings',['user_id'=>$user_id,'other_id'=>$other_id,'rating'=>$rating]);
        if(!$ratingNew){
            die("Something went wrong");
        }

        return $response->redirect();
    }//rating


    
}
