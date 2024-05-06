<?php
declare(strict_types=1);

namespace MyApp;
use MyApp\Database;
class RestaurantManager
{

    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    private $restaurant_id;

    public function getRestaurantId()
    {
        return $this->restaurant_id;
    }

    public function addRestaurant($title, $email, $phone, $url, $openHour, $closeHour, $workingDays, $image, $address, $categoryName)
    {
        #$categoryId = $this->getCategoryId($categoryName);
        #echo $categoryId;
        if (
            empty($categoryName)||empty($title)||$email==''||$phone ==''||$url==''||$openHour==''||$closeHour==''||$workingDays==''||$address==''
        ) {
            return "All fields must be Required!";
        } else {
            $type = 1;


            $mql = "INSERT INTO shop (c_id, title, email, phone, url, o_hr, c_hr, o_days, address, image, type) 
                    VALUES ('$categoryName', '$title', '$email', '$phone', '$url', '$openHour', '$closeHour', '$workingDays', '$address', '$image', '1')";
            $this->db->query($mql);
            return true;
        }
    }
public function getCategoryId(string $categoryName)
{
    $sql = "SELECT c_id FROM res_category WHERE c_name = '$categoryName'";
    $result = $this->db->query($sql);
    $categoryId = null;

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $categoryId = $row['c_id'];
    } 

    return $categoryId;
}

    public function getAllRestaurants()
    {
        // Initialize an empty array to store restaurant data
        $restaurants = [];

        // Perform database query
        $sql = "SELECT * FROM shop ORDER BY rs_id DESC";
        $query = $this->db->query($sql);
        if ($query && $query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                
                $categoryName = $this->getCategoryNameById($row['c_id']);

                $restaurant = [
                    'rs_id' => $row['rs_id'], 
                    'categoryName' => $categoryName,
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
                $restaurants[] = $restaurant;
            }
        }
        return $restaurants;
    }

    private function getCategoryNameById($categoryId)
    {
        // Perform database query to get category name
        $sql = "SELECT c_name FROM res_category WHERE c_id = '$categoryId'";
        $result = $this->db->query($sql);

        // Check if the query was successful and if there is a result
        if ($result && $result->num_rows > 0) {
            // Fetch the category name from the result
            $row = $result->fetch_assoc();
            return $row['c_name'];
        } else {
            // Return a default value if category name is not found
            return "Unknown Category";
        }
    }
    // public function getCategory()
    // {
    //     $sql = "SELECT * FROM res_category";
    //     $result = $this->db->query($sql);
    //     return $result;
    // }

    public function getCategoryList()
    {
        $sql = "SELECT * FROM res_category ORDER BY c_id DESC";
        $query = $this->db->query($sql);
        $categoryList = "";

        if (!mysqli_num_rows($query) > 0) {
            $categoryList = '<td colspan="7"><center>No Categories-Data!</center></td>';
        } else {
            while ($rows = $this->db->fetchArray($query)) {
                $categoryList .= '<tr><td>' . $rows['c_id'] . '</td>
                                    <td>' . $rows['c_name'] . '</td>
                                    <td>' . $rows['date'] . '</td>
                                    <td><a href="delete_category.php?cat_del=' . $rows['c_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                                    <a href="update_category.php?cat_upd=' . $rows['c_id'] . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
                                    </td></tr>';
            }
        }

        return $categoryList;
    }


    public function handleCategoryFormSubmission()
    {
        if (isset($_POST['submit'])) {
            if (empty($_POST['c_name'])) {
                return '<div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Field Required!</strong>
                        </div>';
            } else {
                $categoryName = $_POST['c_name'];
                return $this->addCategory($categoryName);
            }
        }
    }

    public function addCategory($categoryName)
    {
        $check_cat = $this->db->query("SELECT c_name FROM res_category WHERE c_name = '$categoryName'");

        if ($check_cat && $check_cat->num_rows > 0) {
            return '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Category already exists!</strong>
                    </div>';
        } else {
            $sql = "INSERT INTO res_category (c_name) VALUES ('$categoryName')";
            if ($this->db->query($sql)) {
                return '<div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            New Category Added Successfully.
                        </div>';
            } else {
                return '<div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Error adding category!</strong>
                        </div>';
            }
        }
    }
}
