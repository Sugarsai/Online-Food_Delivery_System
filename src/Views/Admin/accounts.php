<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <!-- https://fonts.google.com/specimen/Roboto -->
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- https://fontawesome.com/ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- https://getbootstrap.com/ -->
    <link rel="stylesheet" href="css/templatemo-style.css">
    <!--
    Product Admin CSS Template
    https://templatemo.com/tm-524-product-admin
    -->
</head>

<body id="reportsPage">
    <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
            <div class="container h-100">
                <a class="navbar-brand" href="./index.php">
                <?php
    session_start();
    if (isset($_SESSION['user_name'])) {
        $user_name = $_SESSION['user_name'];
        echo " {$user_name}</h1>";}
    ?>
                </a>
                <button class="navbar-toggler ml-auto mr-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-tachometer-alt"></i>
                               Orders
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-file-alt"></i>
                                <span>   Feedbacks   </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./products.php">
                                <i class="fas fa-shopping-cart"></i>
                                Products
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="accounts.php">
                                <i class="far fa-user"></i>
                                Account
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <?php
    if (isset($_SESSION['user_name'])) {
        $user_name = $_SESSION['user_name'];
        echo '<a href="../contact us/sign up/index.php">Log Out</a>';
    } else {
        echo '<a href="../contact us/sign up/index.php">Sign In</a>';
    }
    ?>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
        <div class="container mt-5">
    
    <!-- row -->
    <div class="row tm-content-row">
      <div class="tm-block-col tm-col-avatar">
        <div class="tm-bg-primary-dark tm-block tm-block-avatar">
          <h2 class="tm-block-title">Change Avatar</h2>
          <div class="tm-avatar-container">
            <img
              src="img/avatar.png"
              alt="Avatar"
              class="tm-avatar img-fluid mb-4"
            />
            <a href="#" class="tm-avatar-delete-link">
              <i class="far fa-trash-alt tm-product-delete-icon"></i>
            </a>
          </div>
          <button class="btn btn-primary btn-block text-uppercase">
            Upload New Photo
          </button>
        </div>
      </div>
      <div class="tm-block-col tm-col-account-settings">
        <div class="tm-bg-primary-dark tm-block tm-block-settings">
          <h2 class="tm-block-title">Account Settings</h2>
          <form action="" class="tm-signup-form row">
            <div class="form-group col-lg-6">
              <label for="name">Account Name</label>
              <input
                id="name"
                name="name"
                type="text"
                class="form-control validate"
              />
            </div>
            <div class="form-group col-lg-6">
              <label for="email">Account Email</label>
              <input
                id="email"
                name="email"
                type="email"
                class="form-control validate"
              />
            </div>
            <div class="form-group col-lg-6">
              <label for="password">Password</label>
              <input
                id="password"
                name="password"
                type="password"
                class="form-control validate"
              />
            </div>
            <div class="form-group col-lg-6">
              <label for="password2">Re-enter Password</label>
              <input
                id="password2"
                name="password2"
                type="password"
                class="form-control validate"
              />
            </div>
            <div class="form-group col-lg-6">
              <label for="phone">Phone</label>
              <input
                id="phone"
                name="phone"
                type="tel"
                class="form-control validate"
              />
            </div>
            <div class="form-group col-lg-6">
              <label class="tm-hide-sm">&nbsp;</label>
              <button
                type="submit"
                class="btn btn-primary btn-block text-uppercase"
              >
                Update Your Profile
              </button>
            </div>
            <div class="col-12">
              <button
                type="submit"
                class="btn btn-primary btn-block text-uppercase"
              >
                Delete Your Account
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <footer class="tm-footer row tm-mt-small">
    <div class="col-12 font-weight-light">
      <p class="text-center text-white mb-0 px-4 small">
        Copyright &copy; <b>2024</b> All rights reserved. 
      </p>
    </div>
  </footer>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<!-- https://jquery.com/download/ -->
<script src="js/bootstrap.min.js"></script>
<!-- https://getbootstrap.com/ -->
</body>
</html><?php
// PHP code goes here (if needed)
?>

