<?php

namespace vendor\Evd\DataBase;

use PDO;

/**
 * Класс для работы с базой данных
 */
final class DB
{
    private static $link = null;

    /**
     * Подключение к БД.
     * @return PDO
     */
    private static function getLink()
    {
        // Проверка соединения. Если соединение уже было - возвращает link
        if (self:: $link) {
            return self:: $link;
        }

        $ini = $_SERVER['DOCUMENT_ROOT']. "/../config.ini";
        $parse = parse_ini_file($ini, true);
        $driver = $parse["db_driver"];
        $dsn = "$driver:";
        $user = $parse ["db_user"];
        $password = $parse ["db_password"];
        $options = $parse ["db_options"];
        $attributes = $parse ["db_attributes"];

        foreach ($parse ["dsn"] as $k => $v) {
            $dsn .= "$k=$v;";
        }

        self:: $link = new PDO($dsn, $user, $password, $options);

        foreach ($attributes as $k => $v) {
            self:: $link->setAttribute(constant("PDO::{$k}")
                , constant("PDO::{$v}"));
        }

        return self:: $link;
    }

    public static function __callStatic($name, $args)
    {
        $callback = array(self:: getLink(), $name);
        return call_user_func_array($callback, $args);
    }
}