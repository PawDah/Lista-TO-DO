<?php

namespace MyApp\src;

class View
{
    function view($template,$variables){
        extract($variables);
        include 'views/layout/default.php';
    }
}