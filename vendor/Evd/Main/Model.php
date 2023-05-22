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
    private static $order = ""; // Сортировка
    private static $limit = ""; // Лимитирование
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
     * Сортировка по убыванию
     * @param $field
     * @return $this
     */
    public function orderDesc($field)
    {
        self::$order = "ORDER BY $field DESC";
        return $this;
    }

    /**
     * Сортировка по возрастанию
     * @param $field
     * @return $this
     */
    public function orderAsc($field)
    {
        self::$order = "ORDER BY $field ASC";
        return $this;
    }

    /**
     * Лимит
     * @param $limit
     * @return $this
     */
    public function limit($limit)
    {
        self::$limit = "LIMIT $limit";
        return $this;
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
                    $tableSTR .= " " . $tableName . "." . $tableField . (($tableField != "*" && $tableField != end($tableFields)) ? "," : "");
                }
            }
        }

        $withTablesSTR = "";
        $join = "";

        if (count(self::$withTables) > 0) {
            foreach (self::$withTables as $selfTable) {
                $join .= " INNER JOIN ";
                foreach ($selfTable as $tableName => $tableFields) {

                    $joinTableName = (str_ends_with($tableName, "es") && substr($tableName, -3, 1) == "s") ? substr($tableName, 0, -2) : substr($tableName, 0, -1);

                    $join .= $tableName . " ON " . $joinTableName . "_id=" . $tableName . ".id";
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

                $whereValueItem = match ($whereValue) {
                    "min" => "(SELECT MIN($whereField) FROM " . static::$table . ")",
                    "max" => "(SELECT MAX($whereField) FROM " . static::$table . ")",
                    default => "'$whereValue'",
                };

                $whereStr .= static::$table . "." . $whereField . "=" . $whereValueItem . (($whereValue != end(self::$where)) ? " AND " : "");

            }
        }

        self::$sql = self::$operator . $tableSTR . $withTablesSTR . " FROM " . static::$table . $join . " WHERE " . $whereStr . " " . self::$order . " " . self::$limit;

        $stmt = DB:: query(self::$sql);
        $result = $stmt->fetchAll(\PDO::FETCH_CLASS);

        if (self::$takeOne && count($result) > 0) {
            $this->setPropsDefaultValues();
            return $result[0];
        }
        $this->setPropsDefaultValues();
        return $result;
    }

    /**
     * Сбррос запроса
     * @return void
     */
    private function setPropsDefaultValues()
    {

        self::$where = []; // Условие

        self::$sql = ""; //Запрос
        self::$withTables = []; // Связанные таблицы

        self::$operator = ""; // Оператор запроса

        self::$tables = []; // таблицы
        self::$order = ""; // Сортировка
        self::$limit = ""; // Лимитирование
        self::$takeOne = false;
    }

    /**
     * Создание записи в БД
     * @param $data
     * @return bool
     */
    public static function create($data)
    {
        $table = static::$table;

        $fields = "";
        $values = "";

        $countElements = count($data);
        $counter = 0;

        foreach ($data as $field => $value) {
            $counter++;
            $fields .= "`" . $field . "`" . (($counter != $countElements) ? ", " : "");
            $values .= "'" . $value . "'" . (($counter != $countElements) ? ", " : "");
        }

        self::$sql = "INSERT INTO `$table` ($fields) VALUES ($values)";

        $stmt = DB::query(self::$sql);

        return true;
    }

    public function set($fields)
    {
        $table = static::$table;
        $setStr = "";

        foreach ($fields as $field=>$value){

            $setStr .= "`$field` = '$value' ";
        }

        $whereStr = "1";
        if (count(self::$where) > 0) {
            $whereStr = "";
            foreach (self::$where as $whereField => $whereValue) {

                $whereValueItem = match ($whereValue) {
                    "min" => "(SELECT MIN($whereField) FROM " . static::$table . ")",
                    "max" => "(SELECT MAX($whereField) FROM " . static::$table . ")",
                    default => "'$whereValue'",
                };

                $whereStr .= static::$table . "." . $whereField . "=" . $whereValueItem . (($whereValue != end(self::$where)) ? " AND " : "");

            }
        }

        self::$sql = "UPDATE $table SET $setStr WHERE $whereStr";

        $stmt = DB::query(self::$sql);
        $this->setPropsDefaultValues();
        return true;
    }

}