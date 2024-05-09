<?php
class Item {
    public $dish_id;
    public $shop_id;
    public $title;
    public $price;
    public $slogan;
    public $image;

    public function __construct($dish_id, $shop_id, $title, $price, $slogan, $image) {
        $this->dish_id = $dish_id;
        $this->shop_id = $shop_id;
        $this->title = $title;
        $this->price = $price;
        $this->slogan = $slogan;
        $this->image = $image;
    }

    // Add any additional methods you need below
}
?>
