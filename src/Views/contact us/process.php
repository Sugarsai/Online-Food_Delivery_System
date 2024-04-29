<?php
include ("./database.php");
if (isset($_POST['submit']))
{
   $user_name = $_POST["Name"];  
   $user_id = $_POST["ID"]; 
$user_email = $_POST["Email"];
$message = $_POST["msg"] ;

if(empty($user_name) || empty($user_id)|| empty($user_email)||empty($message)) header('location:contact-us.php?error');

else {
   // Check if the record already exists
   $checkQuery = "SELECT * FROM messages WHERE id = ?";
   $checkStmt = $conn->prepare($checkQuery);
   $checkStmt->bind_param("i", $user_id);
   $checkStmt->execute();
   $result = $checkStmt->get_result();

   if ($result->num_rows > 0) {
       header('location:contact-us.php?duplicate');
   } else {
       // Insert the record
       $insertQuery = "INSERT INTO messages (id,name1, Email, msg) VALUES (?, ?, ?, ?)";
       $insertStmt = $conn->prepare($insertQuery);
       $insertStmt->bind_param("isss",$user_id  , $user_name, $user_email, $message);

       if ($insertStmt->execute()) {
           
header("location:msg-sent.html");
exit;
       } else {
           die($insertStmt->error . " " . $insertStmt->errno);
       }
   }
}
}

$stmt->close();
$conn->close();