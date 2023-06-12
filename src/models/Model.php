<?php

class Model {
    protected static $tableName = '';
    protected static $columns = [];
    protected $values = [];

    function __construct($arr) {
        $this->loadFromArray($arr);
    }

    public function loadFromArray($arr) {
        if($arr) {
            foreach($arr as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function get($key) {
        return $this->$values[$key];
    }

    public function set($key, $value) {
        $this->$values[$key] = $value;
    }

    public static function getAll($filter = [], $columns = '*') {
        $objects = [];
        $result = static::getResultSetFromSelect($filters = [], $columns);
        if($result) {
            //vai dizer ual a classe que chamou a função get
            $class = get_called_class(); 
            while($row = $result->fetch_assoc()) {
                array_push($objects, new $class($row));
            }
        }
        return $objects;
    }

    public static function getResultSetFromSelect($filters = [], $columns = '*'){
        $sql = "SELECT ${columns} FROM "
            . static::$tableName
            . static::getFilters($filters);
        $result = Database::getResultFromQuery($sql);
        if($result->num_rows === 0) {
            return null;
        }else {
            return $result;
        }
    }

    private static function getFilters($filters) {
        $sql = '';
        if(count($filters) > 0) {
            $sql .= " WHERE 1 = 1";
            foreach($filters as $column => $value) {
                $sql .= " AND ${column} = " . static::getFormatedValue($value);
            }
        }
        return $sql;
    }

    private static function getFormatedValue($value) {
        if(is_null($value)){
            return "null";
        }elseif(gettype($value) === 'string') {
            return "'${value}'";
        }else {
            return $value;
        }
    }


}
