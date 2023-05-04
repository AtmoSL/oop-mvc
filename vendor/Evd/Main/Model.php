<?php

namespace vendor\Evd\Main;


use vendor\Evd\DataBase\DB;

/**
 * Класс модели, от которого должны наследоваться все модели.
 */
abstract class Model
{


    private static array $where = []; // Условие

    private static $sql; //Запрос
    private static $withTables = []; // Связанные таблицы

    private static $takeOne = false;
    private static $operator; // Оператор запроса

    private static $tables = []; // таблицы

    /**
     * Создание запроса для вывода всех записей
     * @param $fields
     * @return static
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
    /**
     * Создание запроса для вывода всех записей
     * @param $fields
     * @return static
     */
    public static function one($where, $fields = ["*"])
    {
        $table = static::$table;
        self::$tables[] = [
            $table => $fields,
        ];
        self::$where = $where;
        self::$operator = "SELECT";

        self::$takeOne = true;

        return new static();
    }

    public static function where($where, $fields = ["*"])
    {
        $table = static::$table;
        self::$tables[] = [
            $table => $fields,
        ];
        self::$where = $where;
        self::$operator = "SELECT";

        return new static();
    }

    /**
     * Тобавление информации из связанных таблиц
     * @param $relatedTable
     * @param $fields
     * @return $this
     */
    public function with($relatedTable, $fields = ["*"])
    {
        $table = static::$table;

        self::$withTables[] = [
            $relatedTable => $fields
        ];
        return $this;
    }

    /**
     * Получение данных их БД
     * @return mixed
     */
    public function find()
    {
        $tableSTR = "";

        foreach (self::$tables as $selfTable) {
            foreach ($selfTable as $tableName => $tableFields) {
                foreach ($tableFields as $tableField) {
                        $tableSTR .= " " . $tableName . "." . $tableField . (($tableField!="*" && $tableField!=end($tableFields)) ? "," : "");
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

        $whereStr = "1";
        if (count(self::$where) > 0) {
            $whereStr = "";
            foreach (self::$where as $whereField => $whereValue) {
                $whereStr .= static::$table. "." .$whereField. "=" . "'" . $whereValue . "'";

            }
        }

        self::$sql = self::$operator . $tableSTR . $withTablesSTR . " FROM " . static::$table . $join . " WHERE " .$whereStr;

        $stmt = DB:: query(self::$sql);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);

        if(self::$takeOne && count($result)>0){
            $this->setPropsDefaultValues();
            return $result[0];
        }
        $this->setPropsDefaultValues();
        return $result;
    }

    private function setPropsDefaultValues()
    {

        self::$where = []; // Условие

        self::$sql = ""; //Запрос
        self::$withTables = []; // Связанные таблицы

        self::$operator = ""; // Оператор запроса

        self::$tables = []; // таблицы
        self::$takeOne = false;
    }


}