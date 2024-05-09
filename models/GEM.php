<?php

// Include the Shop class file
include 'Shop.php'; // Adjust the path to the location of your Shop class file

class GEM {
    public $id;
    public $order_id;
    // Object from class Shop
    public $GEMDiscount;

    // Constructor to initialize the GEM object
    public function __construct($id, $order_id, Shop $favShop, $GEMDiscount) {
        $this->id = $id;
        $this->order_id = $order_id;
       
        $this->GEMDiscount = $GEMDiscount;
    }

    // Method to display GEM details
    public function displayGEMDetails() {
        echo "GEM ID: " . $this->id . "\n";
        echo "Order ID: " . $this->order_id . "\n";
        echo "GEM Discount: " . $this->GEMDiscount . "%\n";
    }

    // Other methods related to GEM can be added here
}

// Example usage:
// Assuming $shop is a previously created Shop object
$gem = new GEM(1, 101, $shop, 15);
$gem->displayGEMDetails();

?>
