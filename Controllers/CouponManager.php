<?php 
declare(strict_types= 1);
namespace MyApp;
use MyApp\Database;

class CouponManager{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance();
    }


    public function addCoupon($code, $amount, $shopId)
    {
        if (empty($code) || empty($amount) || empty($shopId)) {
            return "All fields must be required!";
        } else {
            $sql = "UPDATE shop SET coupon='$code', c_amount='$amount' WHERE rs_id=$shopId";
            $this->db->query($sql);
            return true;
        }
    }

    public function applyCoupon($couponCode, $totalPrice) {
        $discountAmount = 0;

        $couponQuery = "SELECT * FROM shop WHERE coupon = '$couponCode'";
        $couponResult = $this->db->query($couponQuery);

        if(mysqli_num_rows($couponResult) > 0) {
            $couponData = mysqli_fetch_assoc($couponResult);
            $discountAmount = $couponData['c_amount'];
        }

        $totalPrice -= $discountAmount;

        return $totalPrice;
    }
}