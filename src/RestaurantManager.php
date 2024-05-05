<?php 
declare(strict_types= 1);

namespace MyApp;
use MyApp\Database;

class RestaurantManager{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance();
    }
}