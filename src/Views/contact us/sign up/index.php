<?php

include('E:\HTML\contact us\sign up\connection.php');


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
  <?php
if(isset($_GET['error']))
{
echo '
<script>alert("pls fill all the blanks");</script>;';
}

else if(isset($_GET['error1']))
{
echo '
<script>alert("Password must be at least 8 characters and contains at least one letter ");</script>;';
}

else if(isset($_GET['duplicate']))
{echo '
<script>alert(" This email is already used  ");</script>;';}

else if(isset($_GET['success']))
{echo '
<script>alert("Your account has been created successfully");</script>;';}



    ?>
<!-- login & register -->
    <div class="container" id="container">
      <div class="form-container sign-up">
<form action="./process.php" method="POST">
          <h1>Create Account</h1>
          <input type="text" placeholder="Name" name="Name" >
          <input type="email" placeholder="Email" name="Email" >
          <input type="password" placeholder="password" name="password" >
          <button name="sign-up">Sign Up</button>
        </form>
      </div> 
      <!-- sign in -->

      <div class="form-container sign-in">
        <form method="post" action="./process-login.php" >
          <h1>Log In</h1>
      <input type="email" placeholder="Email" name="Email">
          <input type="password" placeholder="password" name="password">
          <a href="#">Forget Your Password?</a>
          <button name="log-in">LogIn</button>
        </form>
      </div>
      <div class="toggle-container">
        <div class="toggle">
          <!-- toggle left  -->
          <div class="toggle-panel toggle-left">
            <h1>Welcome Back ! </h1>
            <p>Enter your personal details to use all of site features</p>
            <button class="hidden" id="login">Sign In</button>
          </div>
            <!-- toggle right -->
            <div class="toggle-panel toggle-right">
              <h1>Hello, Friend ! </h1>
              <p>Register with your personal details to use all of site features</p>
              <button class="hidden" id="Register">Sign Up</button>
            </div>
        </div>
      </div>
    </div>
    <script src="script.js"></script>
    
  </body>
  <script>
    const menuhamburger = document.querySelector(".menu-hamburger")
        const navlinks = document.querySelector(".nav-links")

        menuhamburger.addEventListener('click',()=>        
     {navlinks.classList.toggle('mobile-menu')})
</script>
</html>
