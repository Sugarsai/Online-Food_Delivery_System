<?php 
declare(strict_types= 1);
namespace MyApp;
use MyApp\Database;

class FeedbackController{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function processFeedback($customer) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $restaurant = $_POST['q26_restaurant'];
            $foodQuality = $_POST['q7_foodQuality7'];
            $clean = $_POST['q10_cleanliness10'];
            $value = $_POST['q13_value13'];
            $Overall = $_POST['q14_overallExperience14'];
            $comments = $_POST['q9_anyComments'];
            $name = $_POST['q2_name'];
            $phoneNumber = $_POST['q28_phoneNumber'];
            $email = $_POST['q24_email']; // Assuming you have this value from somewhere
        
            // Prepare an insert statement
            $sql = "INSERT INTO `r-feedbacks` (`u_id`, `restaurants`, `f_quality`, `Cleanliness`, `Value`, `Overall Experience`, `comments`, `Name`, `phone`, `Email`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        
            if ($stmt = $this->db->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("isssssssss", $customer, $restaurant, $foodQuality, $clean, $value, $Overall, $comments, $name, $phoneNumber, $email);
        
                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    echo  "<script type='text/javascript'>alert('Ur Feedback has been sent Successfully !');</script>" ;
                } else {
                    echo "Error: " . $stmt->error;
                }
        
                // Close statement
                $stmt->close();
            } else {
                echo "Prepare failed: " . $this->db->geterror();
            }
        }
        
    }
}