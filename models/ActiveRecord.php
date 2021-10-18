<?php
namespace Model;

class ActiveRecord
{
    protected static $db;
    protected static $table = "";
    protected static $columns = [];
    
    // Metodos para la db
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function save() // Insertar datos
    {
        // Sanitizar datos
        $input = [];
        foreach(static::$columns as $column)
        {
            if($column === "id") continue;
            $input[$column] = self::$db->escape_string($this->$column);
        }

        // Insertar en la db
        return (self::$db->query("INSERT INTO " . static::$table . " (" . join(", ", array_keys($input)) . ") VALUES ('" . join("', '", array_values($input)) . "')"));
    }

    public function update() // Actualizar una fila
    {
        $input = [];
        $str = [];
        foreach(static::$columns as $column) 
        {
            if($column === "id") continue;
            $input[$column] = self::$db->escape_string($this->$column);
        }
        foreach($input as $key => $value)
        {
            $str[] = "{$key} = '{$value}'";
        }

        return self::$db->query("UPDATE " . (static::$table) . " SET " . (join(", ", $str)) . " WHERE id = " . ($this->id) . " LIMIT 1");
    }

    public function delete() // Eliminar fila
    {
        return self::$db->query("DELETE FROM " . (static::$table) . " WHERE id = " . ($this->id) . " LIMIT 1");
    }


    // query
    public static function query($query) // Extrar datos iterando
    {
        $array = [];
        $result = self::$db->query($query); // Consultar a la db
        while($row = $result->fetch_assoc()) 
        {
            $array[$row["id"]] = $row; // Asociar el id al array
        }

        $result->free(); // Liberar memoria
        return $array; // Retornar resultados
    }

    public static function queryEx($columns, $extra = "") // Consulta personalizada
    {
        return self::query("SELECT id, ${columns} FROM " . static::$table . " ${extra}"); 
    }

    public static function customQuery($query)
    {
        $array = [];
        $result = self::$db->query($query);
        while($array[] = $result->fetch_assoc()) { }

        $result->free();
        return $array; 
    }

    public static function all() // Consultar todos los datos
    {
        return self::query("SELECT * FROM " . static::$table);
    }

    public static function findById($id) // Consultar un dato por su id
    {
        return self::query("SELECT * FROM " . (static::$table) . " WHERE id = ${id}");
    }

    public static function findByColumn($column, $value, $limit = 1) // Consultar por un valor
    {
        return self::query("SELECT * FROM " . (static::$table) . " WHERE ${column} = '${value}' LIMIT ${limit}");
    }

    public static function limit($limit) // Consultar un número limitado de datos
    {
        return self::query("SELECT * FROM " . (static::$table) . " LIMIT ${limit}");
    }


    // Globales
    public static function createObject($registro) // Crear objeto
    {
        $object = new static;
        foreach($registro as $key => $value)
        {
            if(property_exists($object, $key)) $object->$key = $value;
        }
        return $object;
    }

    public function sync($args = []) // Sicronizar el objeto en la memoria con los valores editados
    {
        foreach($args as $key => $value)
        {
            if(property_exists($this, $key) && !is_null($value)) $this->$key = $value;
        }
    }
}