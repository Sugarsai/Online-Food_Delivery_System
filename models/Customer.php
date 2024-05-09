<?php
require_once("User.php");

class Customer extends User {
    public $f_name;
    public $l_name;
    public $phone;

    // Constructor to initialize the Customer attributes
    public function __construct($f_name, $l_name, $phone) {
        $this->f_name = $f_name;
        $this->l_name = $l_name;
        $this->phone = $phone;
    }

}


?>
