<?php
include_once 'test.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $registerEmail = $_POST["registerEmail"];
    $registerUserName = $_POST["registerUserName"];
    $registerPassword = $_POST["registerPassword"]; 
    $registerConfrimPassword = $_POST["registerConfrimPassword"]; 

    // Check if the email is a Gmail address using regular expression
    if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $registerEmail)) {
        $emailError = "Please use a Gmail address for registration.";
    } else {
        // Check if the password starts with an uppercase letter
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]{8,}$/', $registerPassword))  {
            $passwordError = "Password should contain one uppercase letter, lowercase letters, digit, and special character";
        } else {
            // Check if passwords match
            if ($registerPassword !== $registerConfirmPassword) {
                $confirmPasswordError = "Passwords do not match.";
            } else {
                // Hash the password
                $hashedPassword = password_hash($registerPassword, PASSWORD_DEFAULT);

                // Check if email already exists in the database
                $emailCheckQuery = "SELECT * FROM users WHERE user_email = '$registerEmail'";
                $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

                if (mysqli_num_rows($emailCheckResult) > 0) {
                    $emailError = "Email address is already registered.";
                } else {
                    // Insert the new user record
                    $sql = "INSERT INTO users (username, user_email, user_password) VALUES ('$registerUserName', '$registerEmail', '$hashedPassword')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: login.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
}}

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<?php include_once 'head-vars.php';?>
<body>

    <?php include_once 'test.php'?>
    <?php include_once 'navbar.php'?>


    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="https://htmldemo.net/learts/learts/assets/images/bg/page-title-1.webp">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">Register</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Register</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

            <div class="col-lg-6 offset-lg-3">
                    <div class="user-login-register">
                        <div class="login-register-title" >
                            <h2 class="title">Register</h2>
                            <p class="desc">If you don’t have an account, register now!</p>
                        </div>
                        <div class="login-register-form">
                   

<form  method="post" id="sign-up-form">
    <!-- Your form fields here -->

    <div class="col-12 learts-mb-20">
        <label for="registerEmail">Email address <abbr class="required" required>*</abbr></label>
        <input type="text" id="registerEmail" name="registerEmail">
        <?php if (!empty($emailError)) echo "<span style='color: red;'>$emailError</span>"; ?>

    </div>

    <div class="col-12 learts-mb-20">
        <label for="registerUserName">User name <abbr class="required" required>*</abbr></label>
        <input type="text" id="registerUserName" name="registerUserName">
        <?php if (!empty($usernameError)) echo "<span style='color: red;'>$usernameError</span>"; ?>

    </div>

    <div class="col-12 learts-mb-20">
        <label for="registerPassword">Enter Password <abbr class="required" required>*</abbr></label>
        <input type="password" id="registerPassword" name="registerPassword">
        <?php if (!empty($passwordError)) echo "<span style='color: red;'>$passwordError</span>"; ?>

    </div>

    <div class="col-12 learts-mb-20">
        <label for="registerConfirmPassword">Confirm Password <abbr class="required" required>*</abbr></label>
        <input type="password" id="registerConfrimPassword" name="registerConfrimPassword">
        <?php if (!empty($confirmPasswordError)) echo "<span style='color: red;'>$confirmPasswordError</span>"; ?>


    </div>


    <div class="col-12 text-center learts-mb-50">
        <button class="btn btn-dark btn-outline-hover-dark" type="submit" id="sign-up" name="signup" >Register</button>
    </div>
</form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Login & Register Section End -->

    <div class="footer2-section section section-padding">
        <div class="container">
            <div class="row learts-mb-n40">

                <div class="col-lg-6 learts-mb-40">
                    <div class="widget-about">
                        <img src="assets/images/logo/logo-2.webp" alt="">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod itaque recusandae commodi mollitia facere iure nisi, laudantium quis quas perferendis a minus dolores.</p>
                    </div>
                </div>

                <div class="col-lg-4 learts-mb-40">
                    <div class="row">
                        <div class="col">
                            <ul class="widget-list">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Store location</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Orders</a></li>
                            </ul>
                        </div>
                        <div class="col">
                            <ul class="widget-list">
                                <li><a href="#">Returns</a></li>
                                <li><a href="#">Support Policy</a></li>
                                <li><a href="#">Size Guide</a></li>
                                <li><a href="#">FAQs</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 learts-mb-40">
                    <ul class="widget-list">
                        <li> <i class="fab fa-twitter"></i> <a href="https://www.twitter.com/">Twitter</a></li>
                        <li> <i class="fab fa-facebook-f"></i> <a href="https://www.facebook.com/">Facebook</a></li>
                        <li> <i class="fab fa-instagram"></i> <a href="https://www.instagram.com/">Instagram</a></li>
                        <li> <i class="fab fa-youtube"></i> <a href="https://www.youtube.com/">Youtube</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="footer2-copyright section">
        <div class="container">
            <p class="copyright text-center">&copy; 2023 learts. All Rights Reserved</p>
        </div>
    </div>



    <!-- JS
============================================ -->

    <!-- Vendors JS -->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.4.1.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.1.0.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>

    <!-- Plugins JS -->
    <script src="assets/js/plugins/select2.min.js"></script>
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/swiper.min.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/mo.min.js"></script>
    <script src="assets/js/plugins/jquery.ajaxchimp.min.js"></script>
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="assets/js/plugins/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/plugins/isotope.pkgd.min.js"></script>
    <script src="assets/js/plugins/jquery.matchHeight-min.js"></script>
    <script src="assets/js/plugins/ion.rangeSlider.min.js"></script>
    <script src="assets/js/plugins/photoswipe.min.js"></script>
    <script src="assets/js/plugins/photoswipe-ui-default.min.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/ResizeSensor.js"></script>
    <script src="assets/js/plugins/jquery.sticky-sidebar.min.js"></script>
    <script src="assets/js/plugins/product360.js"></script>
    <script src="assets/js/plugins/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/jquery.scrollUp.min.js"></script>
    <script src="assets/js/plugins/scrollax.min.js"></script>



    <!-- Main Activation JS -->
    <script src="assets/js/main.js"></script>

</body>

</html>