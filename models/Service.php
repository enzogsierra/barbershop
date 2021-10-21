<?php
namespace Model;

class Service extends ActiveRecord
{
    protected static $table = "services";
    protected static $columns = ["id", "text", "price"];

    public $id;
    public $text;
    public $price;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? "";
        $this->text = $args["text"] ?? "";
        $this->price = $args["price"] ?? "";
    }
}