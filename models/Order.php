<?php

class Order {
    public $order_id;
    public $shop_id;
    public $cus_id;
    public $title;
    public $quantity;
    public $price;
    public $status;
    public $date;
    public $totalprice;

    public function __construct($order_id, $shop_id, $cus_id, $title, $quantity, $price, $status, $date, $totalprice) {
        $this->order_id = $order_id;
        $this->shop_id = $shop_id;
        $this->cus_id = $cus_id;
        $this->title = $title;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->status = $status;
        $this->date = $date;
        $this->totalprice = $totalprice;
    }

    // You can add methods here to handle order operations, like updating status, calculating total price, etc.
}

?>
