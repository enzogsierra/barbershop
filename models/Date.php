<?php
namespace Model;

class Date extends ActiveRecord
{
    protected static $table = "dates";
    protected static $columns = ["id", "date", "time", "services", "userId"];

    public $id;
    public $date;
    public $time;
    public $services;
    public $userId;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->date = $args["date"] ?? "";
        $this->time = $args["time"] ?? "";
        $this->services = $args["services"] ?? "";
        $this->userId = $args["userId"] ?? "";
    }
}