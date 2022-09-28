<?php
include ('connection.php');

use App\Database\Models\User;
use App\Http\Requests\Validation;

$title = "Login";

//  include "header.php";
// use App\Database\Models\User;

ob_start();
session_start();
// require "vendor/autoload.php";

if(isset($_COOKIE['remember_me']) && empty($_SESSION['user'])){
    $user = new User;
    $user->setEmail($_COOKIE['remember_me']);
    $databaseUser = $user->get()->fetch_object();
    $_SESSION['user'] = $databaseUser;
}


//  include "App/Http/Middlewares/Guest.php";
if(isset($_SESSION['user'])){
    header('location:index.php');die;
}

//  include "layouts/navbar.php";

//  include "layouts/breadcrumb.php";


//  $validation = new Validation;

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST){
    $validation->setValue($_POST['email'])->setValueName('email')->required()
    ->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/',"wrong email or password")
    ->exists('users','email');
    $validation->setValue($_POST['password'])->setValueName('password')
    ->required()->regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/',"wrong email or password");
    if(empty($validation->getErrors())){
      $user = new User;
      $databaseResult = $user->setEmail($_POST['email'])->get();
      if($databaseResult->num_rows == 1){
        $databaseUser = $databaseResult->fetch_object();
        if(password_verify($_POST['password'],$databaseUser->password)){
            if(is_null($databaseUser->email_verified_at)){
              $_SESSION['verication_email'] = $_POST['email'];
              header('location:verification-code.php');die;
            }else{
              if(isset($_POST['remember_me'])){
                setcookie('remember_me',$_POST['email'],time() + 86400 * 365,'/');
              }
              $_SESSION['user'] = $databaseUser;
              header('location:index.php');die;
            }
        }else{
          $error = "<p class='text-danger font-weight-bold'>wrong email or password</p>";
        }
      }else{
        $error = "<p class='text-danger font-weight-bold'>wrong email or password</p>";
      }
    }
}
 
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transparent Login Form</title>

    <style>
        *,
        *::before,
        *::after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            height: 100vh;
            display: grid;
            place-items: center;
            font-family: sans-serif;
            background-image: linear-gradient(to right top, #d16ba5, #c777b9, #ba83ca, #aa8fd8, #9a9ae1, #8aa7ec, #79b3f4, #69bff8, #52cffe, #41dfff, #46eefa, #5ffbf1);
            color: rgb(225, 225, 255);
        }

        .container {
            display: flex;
            flex-direction: column;
            padding: 3rem 5rem;
            border-radius: 2em;
            background-color: rgba(0, 0, 0, 0.75);
            width: 30rem;
        }

        h1 {
            text-align: center;
            margin: 1rem;
            margin-bottom: 5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        label span {
            display: inline-block;
            font-size: 1.25rem;
            letter-spacing: 2px;
            position: relative;
            bottom: 4rem;
            transition: transform 200ms ease-in-out;
        }

        input {
            position: relative;
            margin-bottom: 2rem;
            padding: 0.5rem 0;
            background-color: transparent;
            outline: none;
            border: unset;
            border-bottom: 1.5px solid white;
            font-size: 1.25rem;
            letter-spacing: 1.5px;
            color: white;
            z-index: 1;
        }

        button {
            display: inline-block;
            margin: 1rem 0;
            padding: 0.75rem;
            cursor: pointer;
            outline: none;
            border: none;
            border-radius: 0.25em;
            font-size: 1rem;
            letter-spacing: 1.5px;
            font-weight: 500;
            transition: all 100ms ease-in-out;
            background-color: rgb(225, 225, 255);
        }

        button:hover {
            background-color: rgb(235, 235, 235);
        }

        a {
            color: rgb(235, 235, 235);
        }

        a:hover {
            color: rgb(215, 215, 215);
        }

        p {
            text-align: center;
        }

        input:focus,
        input:valid {
            border-bottom: 2px solid white;
        }

        input:focus+label span,
        input:valid+label span {
            color: white;
            transform: translateY(-2rem);
        }
    </style>


    <script>
        const labels = document.querySelectorAll("label");

        labels.forEach(label => {
            // console.log(label.innerText);
            label.innerHTML = label.innerText
                .split('')
                .map((letter, index) => {
                    return `<span style="transition-delay: ${index*30}ms">${letter}</span>`;
                })
                .join('');
            console.log(label.innerHTML);
        });
    </script>

</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <input type="text" required>
        <label for="text"><span>Email</span></label>
        <input type="password" name="" id="" required>
        <label for="password"><span>Password</span></label>
        <form action="http://localhost/userprofile.php#">
        <button type="submit" >Login</button>
        </form>
        <p>Don't have an account? <a href="http://localhost/register.php">Register</a>.</p>
    </div>

<!-- 
    // include "layouts/footer.php";

<footer class="footer-area pt-75 gray-bg-3">
        <div class="footer-top gray-bg-3 pb-35">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-widget mb-40">
                            <div class="footer-title mb-25">
                                <h4>My Account</h4>
                            </div>
                            <div class="footer-content">
                                <ul>
                                    <li><a href="my-account.php">My Account</a></li>
                                    <li><a href="about-us.php">Order History</a></li>
                                    <li><a href="wishlist.php">WishList</a></li>
                                    <li><a href="#">Newsletter</a></li>
                                    <li><a href="about-us.php">Order History</a></li>
                                    <li><a href="#">International Orders</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-widget mb-40">
                            <div class="footer-title mb-25">
                                <h4>Information</h4>
                            </div>
                            <div class="footer-content">
                                <ul>
                                    <li><a href="about-us.php">About Us</a></li>
                                    <li><a href="#">Delivery Information</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Customer Service</a></li>
                                    <li><a href="#">Return Policy</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-widget mb-40">
                            <div class="footer-title mb-25">
                                <h4>Quick Links</h4>
                            </div>
                            <div class="footer-content">
                                <ul>
                                    <li><a href="#">Support Center</a></li>
                                    <li><a href="#">Term & Conditions</a></li>
                                    <li><a href="#">Shipping</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Help</a></li>
                                    <li><a href="#">FAQS</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-widget footer-widget-red footer-black-color mb-40">
                            <div class="footer-title mb-25">
                                <h4>Contact Us</h4>
                            </div>
                            <div class="footer-about">
                                <p>Your current address goes to here,120 haka, angladesh</p>
                                <div class="footer-contact mt-20">
                                    <ul>
                                        <li>(+008) 254 254 254 25487</li>
                                        <li>(+009) 358 587 657 6985</li>
                                    </ul>
                                </div>
                                <div class="footer-contact mt-20">
                                    <ul>
                                        <li>yourmail@example.com</li>
                                        <li>example@admin.com</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom pb-25 pt-25 gray-bg-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="copyright">
                            <p><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-img f-right">
                            <a href="#">
                                <img alt="" src="assets/img/icon-img/payment.png">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->


    <!-- //  include "layouts/scripts.php";
<script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/ajax-mail.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script> -->

</body>

</html>

<?php 
ob_end_flush();
?>