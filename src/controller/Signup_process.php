<?php 
include('db_login.php');

if (isset($_POST['sign-up'])) {
    $user_name = $_POST["Name"];
    $user_email = $_POST["Email"];
    $password = $_POST["password"];

    if (empty($user_name) || empty($user_email) || empty($password)) {
        header('location:../views/signup_index.php');
    
    } else {
        // Check if the record already exists
        $checkQuery = "SELECT * FROM signup WHERE Email = ?";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bind_param("s", $user_email);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            header('location:../views/signup_index.php?duplicate');
        } else {
            // Insert the record
            $insertQuery = "INSERT INTO signup (name1, Email, password1, role1) VALUES (?, ?, ?,2)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("sss", $user_name, $user_email, $password);

            if ($insertStmt->execute()) {
                header("location:../views/signup-success.html");
                exit;
            } else {
                die($insertStmt->error . " " . $insertStmt->errno);
            }
        }
    }
}

$checkStmt->close();
$insertStmt->close();
$conn->close();
?>