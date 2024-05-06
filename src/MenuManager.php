<?php
declare(strict_types= 1);
namespace MyApp;
use MyApp\Database;

class MenuManager{
    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getMenus(){
        $query = "SELECT * FROM dishes";
        $result = $this->db->query($query);
        return $result;
    }

    public function addMenu(string $name, string $price, string $description, string $image, string $rs_id): bool|string {
        $error = "";
        $message = "";
        if (empty($name) || 
            empty($price) || 
            empty($description) ||  
            empty($image) ||
            empty($rs_id)) {
           $error =  	'<div class="alert alert-danger alert-dismissible fade show">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <strong>All fields Must be Fillup!</strong></div>';
              return $error;
        } else {
            $sql = "INSERT INTO dishes (rs_id, title, slogan, price, img) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $this->db->bindParams($stmt, "issss", $rs_id, $name, $description, $price, $image);
            $stmt->execute();
            return true;
        }
    }
}