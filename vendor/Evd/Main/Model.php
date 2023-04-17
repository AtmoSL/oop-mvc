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

    protected static $sql;
    protected static $withTables = [];

    private static $operator;

    private static $tables = [];

    /**
     * Вернуть все записи в виде массива
     * @return void
     */
    public static function all($fields = ["*"])
    {
        $table = static::$table;
        self::$tables[] = [
            $table => $fields,
        ];
        self::$operator = "SELECT";

        return new static();
    }

    public function with($relatedTable, $fields = ["*"])
    {
        $table = static::$table;

        self::$withTables[] = [
            $relatedTable => $fields
        ];
        return $this;
//        self::$sql = "SELECT $table.*, genres.title as genre_title FROM $table INNER JOIN genres ON $table.genre_id=genres.id";
    }

    public function find()
    {
        $tableSTR = "";

        foreach (self::$tables as $selfTable) {
            foreach ($selfTable as $tableName => $tableFields) {
                foreach ($tableFields as $tableField) {
                    $tableSTR .= " " . $tableName . "." . $tableField . " ";
                }
            }
        }

        $withTablesSTR = "";
        $join = "";

        if (count(self::$withTables) > 0) {

            foreach (self::$withTables as $selfTable) {
                $join .= " INNER JOIN ";
                foreach ($selfTable as $tableName => $tableFields) {
                    $join .= $tableName . " ON " . substr($tableName, 0, -1) . "_id=" . $tableName . ".id";
                    foreach ($tableFields as $tableField) {
                        $withTablesSTR .= ", " . $tableName . "." . $tableField . " ";
                    }
                }
            }

        }

        self::$sql = self::$operator . $tableSTR . $withTablesSTR . " FROM " . static::$table . $join;

//        var_dump(self::$sql);
//        die();

        $stmt = DB:: query(self::$sql);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);
        self::$sql = "";
        return $result;
    }


}