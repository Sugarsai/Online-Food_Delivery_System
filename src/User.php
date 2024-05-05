<?php
declare(strict_types=1);

namespace MyApp;

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function registerUser(string $username, string $firstname, string $lastname, string $email, string $phone, string $password, string $address): bool|string {
        if (empty($firstname) || 
            empty($lastname) || 
            empty($email) ||  
            empty($phone) ||
            empty($password) ||
            empty($address) ||
            empty($username)) {
            return "All fields must be Required!";
        } else {
            $check_username = $this->db->query("SELECT username FROM users where username = '$username'");
            $check_email = $this->db->query("SELECT email FROM users where email = '$email'");

            if ($password != $_POST['cpassword']) {  
                return "Password not match";
            } elseif (strlen($password) < 6) {
                return "Password Must be >=6";
            } elseif (strlen($phone) < 10) {
                return "Invalid phone number!";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Invalid email address please type a valid email!";
            } elseif(mysqli_num_rows($check_username) > 0) {
                return "Username Already exists!";
            } elseif(mysqli_num_rows($check_email) > 0) {
                return "Email Already exists!";
            } else {
                $mql = "INSERT INTO users(username, f_name, l_name, email, phone, password, address) 
                        VALUES('$username', '$firstname', '$lastname', '$email', '$phone', '$password', '$address')";
                $this->db->query($mql);
                return true;
            }
        }
    }

    public function loginUser(string $username, string $password): bool|string {
        if (empty($username) || empty($password)) {
            return "Username and password are required!";
        } else {
            $loginquery = "SELECT * FROM users WHERE username='$username' && password='$password'";
            $result = $this->db->query($loginquery);
            $row = mysqli_fetch_array($result);

            if (is_array($row)) {
                $_SESSION["user_id"] = $row['u_id'];
                return true;
            } else {
                return "Invalid Username or Password!";
            }
        }
    }
}
