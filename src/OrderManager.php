<?php 
declare(strict_types=1);

namespace MyApp;
use MyApp\Database;

class OrderManager{
    private static ?OrderManager $instance = null;
    private Database $db;

    private $order_id;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public static function getInstance(): OrderManager {
        if (self::$instance === null) {
            self::$instance = new OrderManager();
        }
        return self::$instance;
    }

    public function getorder_id() {
        return $this->order_id;
    }
    public function addOrder(string $product, string $quantity, string $price, string $total, string $date): bool|string {
        if (empty($product) || 
            empty($quantity) || 
            empty($price) ||  
            empty($total) ||
            empty($date)) {
            return "All fields must be Required!";
        } else {
            $mql = "INSERT INTO orders(product, quantity, price, total, date) 
                    VALUES('$product', '$quantity', '$price', '$total', '$date')";
            $this->db->query($mql);
            return true;
        }
    }
    
    public function getUserOrders(int $user_id) {
        $query = "SELECT * FROM users_orders WHERE u_id = $user_id";
        $result = $this->db->query($query);
        return $result;
        
    }
    
    public function getOrders(): array {
        $query = "SELECT * FROM orders";
        $result = $this->db->query($query);
        $orders = [];
        while ($row = mysqli_fetch_array($result)) {
            $orders[] = $row;
        }
        return $orders;
    }


    public function updateOrder(int $id, string $product, string $quantity, string $price, string $total, string $date): bool|string {
        if (empty($product) || 
            empty($quantity) || 
            empty($price) ||  
            empty($total) ||
            empty($date)) {
            return "All fields must be Required!";
        } else {
            $mql = "UPDATE orders SET product = '$product', quantity = '$quantity', price = '$price', total = '$total', date = '$date' WHERE id = $id";
            $this->db->query($mql);
            return true;
        }
    }

    public function displayOrders(): void
    {
        $sql = "SELECT users.*, users_orders.* FROM users, users_orders WHERE users.u_id=users_orders.u_id ORDER BY users_orders.o_id DESC";
        $query = $this->db->query($sql);

        if ($this->db->countRows($query) > 0) {
            while ($rows = $this->db->fetchArray($query)) {
                $this->renderOrderRow($rows);
            }
        } else {
            echo '<td colspan="8"><center>No Orders</center></td>';
        }
    }

    private function renderOrderRow(array $order): void
    {
        echo '<tr>';
        echo '<td>' . $order['username'] . '</td>';
        echo '<td>' . $order['title'] . '</td>';
        echo '<td>' . $order['quantity'] . '</td>';
        echo '<td>$' . $order['price'] . '</td>';
        echo '<td>' . $order['address'] . '</td>';

        $status = $order['status'];
        if (empty($status) || $status === "NULL") {
            echo '<td><button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Dispatch</button></td>';
        } elseif ($status === "in process") {
            echo '<td><button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> On The Way!</button></td>';
        } elseif ($status === "closed") {
            echo '<td><button type="button" class="btn btn-primary"><span class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button></td>';
        } elseif ($status === "rejected") {
            echo '<td><button type="button" class="btn btn-danger"><i class="fa fa-close"></i> Cancelled</button></td>';
        }

        echo '<td>' . $order['date'] . '</td>';
        echo '<td>';
        echo '<a href="delete_orders.php?order_del=' . $order['o_id'] . '" onclick="return confirm(\'Are you sure?\');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>';
        echo '<a href="view_order.php?user_upd=' . $order['o_id'] . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>';
        echo '</td>';
        echo '</tr>';
    }

    public function deleteOrder($orderid) {
        $mql = "DELETE FROM users_orders WHERE o_id = '$orderid'";
        $this->db->query($mql);
        header("location:your_orders.php"); 
    }
}