<?php
declare(strict_types= 1);
namespace MyApp;
use MyApp\Database;
class GemCtrl {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function displayTopDishes($customer_id) {
        $sql = "SELECT dishes.*, COUNT(users_orders.title) AS order_count FROM dishes LEFT JOIN users_orders ON dishes.title = users_orders.title AND users_orders.u_id = '$customer_id' GROUP BY dishes.title HAVING COUNT(users_orders.title) > 1 ORDER BY order_count DESC LIMIT 6;";
            // Select dishes that the customer has ordered more than 3 times
            $query_res = $this->db->query($sql);
    
            // Check if any dishes meet the criteria
            if(mysqli_num_rows($query_res) > 0) {
                echo'    <div class="title text-xs-center m-b-30">
                <p style="font-size: 40px;" >Your Fav Dishes of the Month 😉</p>
                <p class="lead">Easiest way to order your favourite food that u have ordered more than 3 times 😋</p>
            </div>';
                while($r=mysqli_fetch_array($query_res)) {
                    echo '  <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                            <div class="food-item-wrap">
                                <div class="figure-wrap bg-image" data-image-src="../public/Admin-assests/Res_img/dishes/'.$r['img'].'"></div>
                                <div class="content">
                                    <h5><a href="dishes.php?res_id='.$r['rs_id'].'">'.$r['title'].'</a></h5>
                                    <div class="product-name">'.$r['slogan'].'</div>
                                    <div class="price-btn-block"> <span class="price">$'.$r['price'].'</span> <a href="dishes.php?res_id='.$r['rs_id'].'" class="btn theme-btn-dash pull-right">Order Now</a> </div>
                                </div>
                            </div>
                    </div>';
                }
            }
            else{
                $this->displayDefaultDishes();
            }
          
    }

    public function displayDefaultDishes() {
        $sql = "SELECT * FROM dishes LIMIT 6";
        $query_res = $this->db->query($sql);   
        echo'    <div class="title text-xs-center m-b-30">
        <p style="font-size: 40px;" >Popular Dishes of the Month 🤩</p>
        <p class="lead">Easiest way to order your favourite food among these top 6 dishes 🥰</p>
    </div>';
        while ($r = mysqli_fetch_array($query_res)) {
            echo' 
             <div class="col-xs-12 col-sm-6 col-md-4 food-item">
            <div class="food-item-wrap">
                <div class="figure-wrap bg-image" data-image-src="../public/Admin-assests/Res_img/dishes/' . $r['img'] . '"></div>
                <div class="content">
                    <h5><a href="dishes.php?res_id=' . $r['rs_id'] . '">' . $r['title'] . '</a></h5>
                    <div class="product-name">' . $r['slogan'] . '</div>
                    <div class="price-btn-block"> <span class="price">$' . $r['price'] . '</span> <a href="dishes.php?res_id=' . $r['rs_id'] . '" class="btn theme-btn-dash pull-right">Order Now</a> </div>
                </div>
            </div>
        </div>';
        }
    }

    public function GEMrecommendation($customer_id) {
        // Prepare the SQL query with a placeholder for the customer ID
        $sql = "SELECT r.*, c.c_name
        FROM restaurant r 
        JOIN res_category c ON r.c_id = c.c_id
        WHERE r.c_id IN (
            SELECT rc.c_id 
            FROM restaurant rc
            JOIN dishes d ON rc.rs_id = d.rs_id
            JOIN users_orders uo ON d.title = uo.title
            WHERE uo.u_id = ?
            GROUP BY rc.c_id, rc.rs_id
            HAVING COUNT(uo.title) >= 3
        )
        GROUP BY r.rs_id, r.c_id";
        $stmt = $this->db->prepare($sql);
    
        // Check for successful preparation
        if ($stmt === false) {
            // Handle error
            die('Prepare failed: ' . htmlspecialchars(mysqli_error($this->db->geterror())));
        }
    
        // Bind the parameter
        if (!mysqli_stmt_bind_param($stmt, 'i', $customer_id)) {
            // Handle error
            die('Bind param failed: ' . htmlspecialchars(mysqli_stmt_error($stmt)));
        }
    
        // Execute the query
        if (!mysqli_stmt_execute($stmt)) {
            // Handle error
            die('Execute failed: ' . htmlspecialchars(mysqli_stmt_error($stmt)));
        }

                // Bind the result variables
        $result = mysqli_stmt_get_result($stmt);


        if (mysqli_fetch_assoc($result)==0) {
            // Handle error
            require_once("../controller/ViewController.php");
            $ViewCtrl = new RestaurantManager();
            $ViewCtrl->getAllRestaurants();
        }
        else {

            echo'    <div class="title text-xs-center m-b-30">
            <p style="font-size: 40px;" > U Got a GEM-Recommendation 😮!! </p>
            <p class="lead"> Easiest way to order your favourite food among these Recommendation of Restaurants u have ordered before and try new restaurants that serve ur fav food 😋 </p>
        </div>';

        }
    

    
        // Fetch the results
        while ($rows = mysqli_fetch_assoc($result)) {
            // Your echo statement here
            echo '<div class="col-xs-12 col-sm-12 col-md-6 single-restaurant all ' . $rows['c_name'] . '">
            <div class="restaurant-wrap">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-12 col-lg-3 text-xs-center">
                        <a class="restaurant-logo" href="dishes.php?res_id=' . $rows['rs_id'] . '">
                            <img src="../public/Admin-assests/Res_img/' . $rows['image'] . '" alt="Restaurant logo">
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-9 col-md-12 col-lg-9">
                        <h5><a href="dishes.php?res_id=' . $rows['rs_id'] . '">' . $rows['title'] . '</a></h5>
                        <span>' . $rows['address'] . '</span>
                    </div>
                </div>
            </div>
        </div>';
        }
    
        // Close the statement
        mysqli_stmt_close($stmt);
    }
}
    
?>