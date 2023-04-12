<?php

namespace vendor\Evd\Main;

class Loader
{
    public function load($class)
    {
        $arr = explode("\\", $class);
        $prefix = array_shift($arr);
        $prefixFile = "";

        if($prefix == "app"){
            $prefixFile = "../app/Controllers";
        }elseif ($prefix == "vendor"){
            $prefixFile = "../vendor";
        }

        $file = $prefixFile  . "/" . implode("/", $arr) . ".php";

        if(is_file($file)){
            require_once $file;
        }

    }
}