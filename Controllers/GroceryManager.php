<?php

declare(strict_types=1);

namespace MyApp;

use MyApp\Database;

class GroceryManager
{

    private $db;
    private $grocery_id;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getGroceryId()
    {
        $sql = "SELECT rs_id from shop";
        $result = $this->db->query($sql);
        return $result;
    }

    public function addGrocery($title, $email, $phone, $url, $openHour, $closeHour, $workingDays, $image, $address)
    {
        if (
            empty($title) || $email == '' || $phone == '' || $url == '' || $openHour == '' || $closeHour == '' || $workingDays == '' || $address == ''
        ) {
            return "All fields must be Required!";
        } else {
            $type = 2;

            $sql = "INSERT INTO shop (c_id, title, email, phone, url, o_hr, c_hr, o_days, address, image, type) 
                    VALUES (NULL, '$title', '$email', '$phone', '$url', '$openHour', '$closeHour', '$workingDays', '$address', '$image', '$type')";

            $this->db->query($sql);
            return true;
        }
    }

    public function getAllGroceries()
    {
        $groceries = [];

        $sql = "SELECT * FROM shop WHERE type = 2 ORDER BY rs_id DESC";
        $query = $this->db->query($sql);

        if ($query && $query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $grocery = [
                    'rs_id' => $row['rs_id'],
                    'title' => $row['title'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'url' => $row['url'],
                    'openHour' => $row['o_hr'],
                    'closeHour' => $row['c_hr'],
                    'workingDays' => $row['o_days'],
                    'address' => $row['address'],
                    'image' => $row['image'],
                    'date' => $row['date']
                ];
                $groceries[] = $grocery;
            }
        }
        return $groceries;
    }

    public function handleGroceryFormSubmission()
    {
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $url = $_POST['url'];
            $openHour = $_POST['openHour'];
            $closeHour = $_POST['closeHour'];
            $workingDays = $_POST['workingDays'];
            $address = $_POST['address'];
            $image = ""; // Add code to handle image upload if necessary

            return $this->addGrocery($title, $email, $phone, $url, $openHour, $closeHour, $workingDays, $image, $address);
        }
    }
    public function deleteGrocery($G_ID)
    {
        $mql = "DELETE FROM shop WHERE rs_id = '$G_ID'";
        $this->db->query($mql);
        header("location:all_groceries.php");
    }
   
}
