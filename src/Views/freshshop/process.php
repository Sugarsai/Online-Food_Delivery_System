<?php
include ("./database.php");
if (isset($_POST['submit']))
{
   $user_name = $_POST["Name"];
 $user_email = $_POST["Email"];
   $subject = $_POST["Subject"]; 
$message = $_POST["msg"] ;

if(empty($user_name) || empty($Subject)|| empty($user_email)||empty($message)) header('location:contact-us.php?error');

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
       $insertQuery = "INSERT INTO messages (name1, Email,Subjec1, msg) VALUES (?, ?, ?, ?)";
       $insertStmt = $conn->prepare($insertQuery);
       $insertStmt->bind_param("isss"  , $user_name, $user_email, $subject , $message);

       if ($insertStmt->execute()) {
           
header("location:msg-sent.html");
exit;
       } else {
           die($insertStmt->error . " " . $insertStmt->errno);
       }
   }
}
}
$EmailTo = "armanmia7@gmail.com";
$Subject = "New Message Received";


// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);

// redirect to success page
if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}

$stmt->close();
$conn->close();