<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = "youssef";
$email = "youssef@gmail.com";
$password = "100100youssef";
$role = 1; // Admin role

// Check if the admin data already exists

$sql = "SELECT * FROM signup WHERE Email = '$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if (!$user) {
    // Insert the admin data
    $insertQuery = "INSERT INTO signup (name1, Email, password1, role1) VALUES ('$name', '$email', '$password', $role)";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Admin data inserted successfully.";
    } else {
        echo "Error inserting admin data: " . $conn->error;
    }
}

$result->free(); // Free the result set
?>