<?php

namespace vendor\Evd\Main;


use vendor\Evd\DataBase\DB;

/**
 * Класс модели, от которого должны наследоваться все модели.
 */
abstract class Model
{
//    abstract static $table; //Название таблицы
    protected $fields; //поля таблицы

    private $fieldsSql = "*"; // Поля для запроса

    protected $where = "1";

    /**
     * Вернуть все записи в виде массива
     * @return void
     */
    public static function all($fields = "*")
    {
        $table = static::$table;

        $sql = "SELECT $fields FROM $table WHERE 1";

        $stmt = DB:: query($sql);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        return $result;
    }


}