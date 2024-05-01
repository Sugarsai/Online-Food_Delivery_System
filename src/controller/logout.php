<?php 
session_start();
session_destroy();
header("location:../views/signup_index.php");

exit;