  <?php
session_start();

if (isset($_GET['error'])) {
    echo '<script>alert("Please fill the form");</script>';
}

if (isset($_GET['duplicate'])) {
echo '<script>alert("Your message has been sent already");</script>';
}

$isUserLoggedIn = false;
$userName = "";

if ( isset($_SESSION['user_id']) && $_SESSION['user_id'] == true) {
    $isUserLoggedIn = true;
    $userName = $_SESSION['user_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> contact us </title>
<link rel="stylesheet" href="./assests/styles.css">
<link rel="stylesheet" href="bootstrap.css">
<script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
<style>
    *{
        margin: 0;
        padding: 0;
        font-family: \'poppins\', sans-serif;
        box-sizing: border-box;
        /* color: aliceblue;*/
    }

    .form{
        width: 100%;
        height: 100vh;
    background: linear-gradient(rgba(20, 21, 22, 0.9), rgba(15, 16, 16, 0.9)), url(https://sedu.asu.edu.eg/pic/download_20220313_124543.jpg);
    margin-top: 10px;
background-size:cover ;
background-position: center;
       background-attachment: scroll;
        display: flex;
        align-items: center;
        justify-content: center;
        color: aliceblue;
    }
    .navbar .menu-hamburger{
            width: 35px;
            position: absolute;
            right: 50px;
            top: 50px;
            display: none;
        }
    form{
        width: 90%;
        max-width: 600px;
    }

    .input-group{
        margin-bottom: 30px;
        position: relative;
    }

    input,
    textarea{
        width: 100%;
        padding: 10px;
        outline: 0;
        border: 1px solid #fff;
        border-radius: 15px;
        background: transparent;
        font-size: 15px;
color: #fff;
    }


    label{
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        padding: 10px;
        cursor: text;
        transition: 0.2s;
    }


    button{
        padding: 10px 0;
        outline: none;
        background: transparent;
        border: 1px solid #fff;
        border-radius: 15px;
        cursor: pointer;
        width: 25%;
        color: aliceblue;
   
    }

    .button{
        display: flex;
        align-items: center;
        justify-content: center;
    }

    input:focus~label,
    input:valid~label,
    textarea:focus~label,
    textarea:valid~label{
        top: -35px;
        font-size: 14px;
    }

    .row{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .row .input-group{
        flex-basis: 48%;
    }

    .logout-btn {
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px  #fff;
    border-radius: 15px;
    color: aliceblue;
    background: transparent;
}

</style>
</head>
<body>
<nav class="navbar">
        <a href="https://sedu.asu.edu.eg/ar/" class="logo">    </a>
        <div class="nav-links">
            <ul>
            <li>
                                    </li>
                <hr>
                <!-- <?php if ($isUserLoggedIn) { ?>
                <li>
                <button class="btn" style="  cursor:auto; " ><?php echo $userName; ?></button>
                </li>
                <li>
                <a href="sign up/index.php"  class="logout-btn">Log out</a>
                </li> <?php } else { ?>
                <li>
                <a href="sign up/index.php" id="login" class="logout-btn">Log In</a>
                </li>
            <?php } ?>
            </ul> -->
        </div>
    </nav>
  
    <div class="container">
        <div class="form">

    <form action="process.php" method="post" enctype="multipart/form-data">

            <div class="row">

                <div class="input-group">
                    <input type="text" id="Name" name="Name">
                    <label for="Name"> Name :</label>
                </div>
                <div class="input-group">
                    <input type="text" id="ID" name="ID">
                    <label for="sub"> PhoneNumber:</label>
                </div>
            </div>
            <div class="input-group">
                    <input type="Email" id="Email"  name="Email">
                    <label for="sub">  Email :</label>
                </div>

            <div class="input-group">
                <textarea id="info"  name="msg" width="601px" ,="" height="342px;" style="width: 595px; height: 330px;"></textarea>
                <label for="info"> <i class="fa-sharp fa-solid fa-circle-info"></i> Message :</label>
            </div>
            <div class="button">
                <button type="submit" name="submit" value="add"> SUBMIT <i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </form>
    </div>

    </div>
    <script>
const container = document.getElementById('container');
const registerBtn = document.getElementById('Register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});
</script>
</body>
</html>