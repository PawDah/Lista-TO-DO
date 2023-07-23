<?php

namespace MyApp\Controllers;


use MyApp\src\Application;
use MyApp\src\Controller;
use MyApp\src\Database;

class HomePageController extends Controller
{


    function indexAction()
    {
        $params=[
            'name'=>'PAWEŁ DAHLKE'
        ];


       return $this->render('home',$params);
    }

}



