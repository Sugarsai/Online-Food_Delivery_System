<?php

declare(strict_types=1);

include("../connection/connect.php");
include("Database.php");

class RestaurantManager
{

    private $db;

    private $restaurant_id;

    public function getRestaurantId()
    {
        return $this->restaurant_id;
    }

    public function addRestaurant($title, $email, $phone, $url, $openHour, $closeHour, $workingDays, $image, $address, $categoryName)
    {
        if (
            empty($title) ||
            empty($email) ||
            empty($phone) ||
            empty($url) ||
            empty($openHour) ||
            empty($closeHour) ||
            empty($workingDays) ||
            empty($image) ||
            empty($categoryId)
        ) {
            return "All fields must be Required!";
        } else {
            $type = 1;

            $categoryId = $this->getCategoryId($categoryName);

            $mql = "INSERT INTO shops (c_id, title, email, phone, url, o_hr, c_hr, o_days, address, image, type) 
                    VALUES ('$categoryId', '$title', '$email', '$phone', '$url', '$openHour', '$closeHour', '$workingDays', '$address', '$image', '1')";
            $this->db->query($mql);
            return true;
        }
    }
    public function getCategoryId($categoryName)
    {
        $sql = "SELECT c_id from res_category WHERE c_name = '$categoryName'";;

        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $categoryId = $row['c_id'];
        } else {
            $categoryId = 0;
        }
        $result->free();
        return $categoryId;
    }
    public function addCategory($categoryName)
    {
        if (empty($categoryName)) {
            return "Category name is required!";
        }

        $categoryId = $this->getCategoryId($categoryName);
        if ($categoryId !== 0) {
            return "Category already exists!";
        }

        $mql = "INSERT INTO res_category VALUES ('$categoryName')";
        $this->db->query($mql);
        return true;
    }
}
