 <?php
include ("db_contact.php");
if (isset($_POST['submit']))
{
 $user_name = $_POST["Name"];
$user_email = $_POST["Email"];
$subject = $_POST["subject1"];
$message = $_POST["msg"];

   // Check if the record already exists
   $checkQuery = "SELECT * FROM messages WHERE Email = ?";
   $checkStmt = $conn->prepare($checkQuery);
   $checkStmt->bind_param("s", $user_email);
   $checkStmt->execute();
   $result = $checkStmt->get_result();

   if ($result->num_rows > 0) {
       header('location:./contact-us.php?duplicate');
   } else {
       // Insert the record
       $insertQuery = "INSERT INTO messages (name1, Email, Subject1, msg) VALUES (?, ?, ?, ?)";
       $insertStmt = $conn->prepare($insertQuery);
       $insertStmt->bind_param("ssss"  , $user_name, $user_email, $subject , $message);

       if ($insertStmt->execute()) {
           
header("location:../views/msg-sent.html");
exit;
       } else {
           die($insertStmt->error . " " . $insertStmt->errno);
       }
   }
}


$conn->close();