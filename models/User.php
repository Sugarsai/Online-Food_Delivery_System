 <?php 
  class User {
    public $u_id ; 
    public $username;
    public $email;
    public $password;

    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

   public function get_user_id() {
    return $this->u_id;
   }
   


}
?>