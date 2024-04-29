<?php 
session_start();
session_destroy();
header("location: ../contact-us.php");

exit;