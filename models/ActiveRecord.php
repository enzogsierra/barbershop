<?php

namespace Model;

class ActiveRecord
{
    protected static $db;
    protected static $table = "";
    protected static $columns = [];
    
    
    // main
    public static function setDB($database)
    {
        self::$db = $database;
    }

    public static function query($query)
    {
        $data = [];
        $result = self::$db->query($query); 
        while($row = $result->fetch_assoc()) 
        {
            $data[] = static::createObject($row);
        }

        $result->free();
        return $data; 
    }

    public function save()
    {
        // Sanitizar datos
        $input = [];
        foreach(static::$columns as $column) 
        {
            if($column === "id") continue;
            $input[$column] = self::$db->escape_string($this->$column);
        }

        // Insertar en la db
        $table = static::$table;
        $columns = join(", ", array_keys($input));
        $values = join("', '", array_values($input));
        return self::$db->query("INSERT INTO $table ($columns) VALUES ('$values')");
    }

    public function update()
    {
        $input = "";
        foreach(static::$columns as $column)
        {
            if($column === "id") continue;

            $s = self::$db->escape_string($this->$column);
            $input .= ", $column = '$s'";
        }
        $input = substr($input, 2); // Eliminar el ', ' al comienzo del string
        
        $table = static::$table;
        return self::$db->query("UPDATE $table SET $input WHERE id = $this->id LIMIT 1");
    }

    public function delete()
    {
        return self::$db->query("DELETE FROM " . static::$table . " WHERE id = $this->id LIMIT 1");
    }

    public function sync($args = [])
    {
        foreach($args as $key => $value)
        {
            if(property_exists($this, $key) && !is_null($value)) $this->$key = $value;
        }
    }


    // query
    public static function all()
    {
        return self::query("SELECT * FROM " . static::$table);
    }

    public static function findById($id)
    {
        return self::query("SELECT * FROM " . static::$table . " WHERE id = '$id'");
    }

    public static function where($column, $value, $limit = 1)
    {
        return self::query("SELECT * FROM " . static::$table . " WHERE $column = '$value' LIMIT $limit");
    }

    public static function limit($limit)
    {
        return self::query("SELECT * FROM " . static::$table . " LIMIT $limit");
    }

    //
    public static function createObject($registro)
    {
        $object = new static;
        foreach($registro as $key => $value)
        {
            if(property_exists($object, $key)) $object->$key = $value;
        }
        return $object;
    }
}