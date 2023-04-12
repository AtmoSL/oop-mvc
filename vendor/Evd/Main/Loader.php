<?php

namespace vendor\Evd\Main;

/**
 * Класс загрузчика файлов
 */
class Loader
{

    /**
     * Автоматическое подключение файла, если он существует
     *
     * @param $class
     * @return void
     */
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