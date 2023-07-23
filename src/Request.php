<?php

namespace MyApp\src;
use Couchbase\ValueRecorder;

class Request{


    public function getPath()
    {
        $path=$_SERVER['REQUEST_URI'] ?? '/';
        $position=strpos($path,'?');
        if($position === false){
            return $path;
        }
        return substr($path,0,$position);
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);

    }

    public function getBody()
    {
        $body = [];
        if($this->getMethod() === 'get'){
            foreach ($_GET as $key => $value) {
                $body[$key]= filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);
            }

        }
        if($this->getMethod() === 'post'){

            foreach ($_POST as $key => $value) {
                $body[$key]= filter_input(INPUT_POST,$key,FILTER_UNSAFE_RAW);
            }
        }
        if(array_key_exists('end_date',$body)) {
            $body['end_date'] = str_replace('T', ' ', $body['end_date']);

        }
        if(array_key_exists('start_date',$body)) {

            $body['start_date'] = str_replace('T', ' ', $body['start_date']);
        }
        return $body;
    }


}