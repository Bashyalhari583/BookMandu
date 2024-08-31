<?php

namespace App\Controllers;
use Phphelper\Core\Request;
use Phphelper\Core\Response;

class RatingController{
    public function getreview(Request $request ,Response $response){
         return $response -> render("Rating/review");

    }
}
