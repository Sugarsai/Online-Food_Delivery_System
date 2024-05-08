<?php 
declare(strict_types=1); 
namespace MyApp;
use MyApp\Database;
class DishesManager extends RestaurantManager
{
    private $db;
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    private $dish_id;
    public function getDishId()
    {
        return $this->dish_id;
    }
    
   
    public function getAllDishes()
    {
        // Initialize an empty array to store dish data
        $dishes = [];
        // Perform database query
        $sql = "SELECT * FROM dishes where rs_id = shop.rs_id ORDER BY dish_id DESC";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dishes[] = $row;
            }
        }
        return $dishes;
    }
    public function getDishById(int $dish_id)
    {
        $sql = "SELECT * FROM dishes WHERE dish_id = '$dish_id'";
        $result = $this->db->query($sql);
        $dish = null;
        if ($result && $result->num_rows > 0) {
            $dish = $result->fetch_assoc();
        }
        return $dish;
    }
    public function updateDish(int $dish_id, $title, $price, $description, $image, $categoryName){

    }
}