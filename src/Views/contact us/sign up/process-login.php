<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $mysqli = new mysqli("localhost", "root", "", "login");

    if ($mysqli->connect_errno) {
        die("Failed to connect to MySQL: " . $mysqli->connect_error);
    }

    $email = $mysqli->real_escape_string($_POST["Email"]);
    $pass = $mysqli->real_escape_string($_POST["password"]);
    $sql = "SELECT * FROM signup WHERE Email = '$email'";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();

    if ($user && isset($user["password1"])) {
        if ($_POST["password"] == $user["password1"]) {
            echo '<script>alert("Log in successful");</script>';
        session_start();
$_SESSION["user_id"] = $user["id"];
$_SESSION["user_name"] = $user["name1"];
if ($user["role1"] == 1) {
    header('Location:/SE-Project/Admin/index.php');
} else {
    header('Location: /SE-Project/freshshop/index.php');
}
exit;
        } else {
            echo '<script>alert("Incorrect password");</script>';
        }
    } else if(empty($email)&&empty($pass)) {
        echo '<script>alert("Invalid Login");</script>';
    }
     else  {
        echo '<script>alert("User not found");</script>';
    }
}
?>