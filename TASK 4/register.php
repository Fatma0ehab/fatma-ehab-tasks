<?php


use App\Database\Models\User;
use App\Http\Requests\Validation;
use App\Mail\VerificationCodeMail;

$title = "Register";

//  include "header.php";


//  include "App/Http/Middlewares/Guest.php";
if(isset($_SESSION['user'])){
    header('location:index.php');die;
}


//  include "layouts/navbar.php";

//  include "layouts/breadcrumb.php";

// $validation = new Validation;

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST){
  $validation->setOldValues($_POST);
  $validation->setValue($_POST['first_name'] ?? "")->setValueName('first name')
  ->required()->between(2,32);
  $validation->setValue($_POST['last_name'] ?? "")->setValueName('last name')
  ->required()->between(2,32);
  $validation->setValue($_POST['email'] ?? "")->setValueName('email')
  ->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/')->unique('users','email');
  $validation->setValue($_POST['phone'] ?? "")->setValueName('phone')
  ->required()->regex('/^01[0125][0-9]{8}$/')->unique('users','phone');
  $validation->setValue($_POST['password'] ?? "")->setValueName('password')
  ->required()->regex("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/","Minimum 8 and maximum 32 characters, at least one uppercase letter, one lowercase letter, one number and one special character:")->confirmed($_POST['password_confirmation']);
  $validation->setValue($_POST['password_confirmation'] ?? "")->setValueName('password confirmation')
  ->required();
  $validation->setValue($_POST['gender'] ?? "")->setValueName('gender')
  ->required()->in(['m','f']);
  if(empty($validation->getErrors())){
      $verification_code = rand(100000,999999);
      $user = new User;
      $user->setFirst_name($_POST['first_name'])
      ->setLast_name($_POST['last_name'])
      ->setEmail($_POST['email'])
      ->setPhone($_POST['phone'])
      ->setGender($_POST['gender'])
      ->setPassword($_POST['password'])
      ->setVerification_code($verification_code);

      if($user->create()){
          $subject = "Verification Mail";
          $body = "<p> Hello {$_POST['first_name']} {$_POST['last_name']}.</p>
          <p> Your Verification Code:<b style='color:blue;'>{$verification_code}</b></p>
          <p> Thank You</p>";
          $verificationMail = new VerificationCodeMail;
          if($verificationMail->send($_POST['email'],$subject,$body)){
            $_SESSION['verification_email'] = $_POST['email'];
            header('location:verification-code.php?redirect=1');die;
          }else{
            $error = "<div class='alert alert-danger' > Please Try Again Later </div>";
          }
      }else{
          $error = "<div class='alert alert-danger' > Something went wrong </div>";
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
        <h1>Register</h1>
        <input type="text" required>
        <label for="text"><span>First Name</span></label>
        <input type="password" name="" id="" required>
        <label for="password"><span>Last Name</span></label>
        <input type="password" name="" id="" required>
        <label for="password"><span>Gender</span></label>
        <input type="password" name="" id="" required>
        <label for="password"><span>Email</span></label>
        <input type="password" name="" id="" required>
        <label for="password"><span>Phone Number</span></label>

        <form action="http://localhost/home.php#">
        <button type="submit" >Register</button>
        </form>
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
    </footer>


    //  include "layouts/scripts.php";
<script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/ajax-mail.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html> -->