<?php 

$pageTitle = 'Profile';
include 'includes/head-vars.php';
include 'includes/navbar.php';


$user_id = $_SESSION['user_id'];



var_dump($_SESSION);

error_reporting(E_ALL);
ini_set('display_errors', 1);

// phpinfo();
?>
    <div class="offcanvas-overlay"></div>

    <!-- Page Title/Header Start -->
    <div class="page-title-section section" data-bg-image="https://htmldemo.net/learts/learts/assets/images/bg/page-title-1.webp">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page-title">
                        <h1 class="title">My Account</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">My Account</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page Title/Header End -->

    <!-- My Account Section Start -->
    <div class="section section-padding">
        <div class="container">
            <div class="row learts-mb-n30">

                <!-- My Account Tab List Start -->
                <div class="col-lg-4 col-12 learts-mb-30">
                    <div class="myaccount-tab-list nav">
                        <a href="#orders" data-bs-toggle="tab">Orders <i class="far fa-file-alt"></i></a>
                        <a href="#address" data-bs-toggle="tab">address <i class="far fa-map-marker-alt"></i></a>
                        <a href="#account-info" data-bs-toggle="tab">Account Details <i class="far fa-user"></i></a>
                        <a href="admin/logout.php">Logout <i class="far fa-sign-out-alt"></i></a>
                    </div>
                </div>
                <!-- My Account Tab List End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-8 col-12 learts-mb-30">
                    <div class="tab-content">


                        <?php
                       
// WHERE user_id = $user_id
                        // $user = mysqli_query($conn,"SELECT * FROM users");

                        $sqlUser = "SELECT * FROM users WHERE user_id = '$user_id'";
                        $userResult = mysqli_query($conn, $sqlUser);
                        ?>
                        
                        <!-- Single Tab Content End -->

                        <?php
     
                    $orderResult = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '$user_id'");
                        ?>


                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="orders">
                            <div class="myaccount-content order">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                                $i = 0;
                                            while ($row = mysqli_fetch_array($orderResult)){
                                            ?> 
                                            <tr>
                                                <td><?php echo $row["order_id"];?></td>
                                                <td><?php echo $row["order_date"];?></td>
                                                <td><?php echo $row["order_status"];?></td>
                                                <td><?php echo $row["order_total_amount"];?></td>
                                                <td><a href="shopping-cart.php">View</a></td>
                                            </tr>

                                            <?php
                                                $i++;
                                                }
                                                ?>
                                                <!-- how to connect the user with his/her order -->

                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                       

                        

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="address">
                            <div class="myaccount-content address">
                                <p>The following addresses will be used on the checkout page by default.</p>
                                    <div class="row learts-mb-n30">

                                    <?php

                            $sql = "SELECT o.*, u.user_phone
                            FROM orders o
                            JOIN users u ON o.user_id = u.user_id
                            WHERE o.user_id = '$user_id'";
                            $orderResult = mysqli_query($conn, $sql);
                        ?>
                        <?php
                                while ($row = mysqli_fetch_array($orderResult)) {
                         ?>
                                <div class="col-md-6 col-12 learts-mb-30">
                                    <h4 class="title">Shipping Address <a href="#" class="edit-link">edit</a></h4>
                                        <address>
                                            <p><?php echo $row["order_address"]; ?></p>
                                            <p><?php echo $row["user_phone"]; ?></p> 
                                        </address>
                                </div>
                        <?php
                            }
                        ?>
                                </div>
                            </div>
                        </div>
                        <!-- Single Tab Content End -->

                                 
                                           
                        
                        
                        

                          <!-- WHERE user_id='".$_GET['user_id']."' -->

                                  

                            <?php
                            $userResult = mysqli_query($conn,"SELECT * FROM users");
                                                        $row = mysqli_fetch_array($userResult);


                            if (count($_POST)>0){
                                mysqli_query($conn,"UPDATE users SET username='".$_POST['username']."',user_email='". $_POST['user_email']."' ,username='" . $_POST['username']. "',user_password='".$_POST['user_password']. "' WHERE user_id='".$_POST['user_id']."'");
                            $alert = "Data successfully updated";
                            // header("Location: my-account.php");
                            exit();
                            }
                            

                            ?>
                            <?php
                            while ($row = mysqli_fetch_array($userResult)){
                            ?>

                        <!-- Single Tab Content Start -->
                        <div class="tab-pane fade" id="account-info">
                            <div class="myaccount-content account-details">
                                <div class="account-details-form">
                                <?php if(isset($alert)) {echo $alert;}?>
                                    <form action="" method="post">
                                        <div class="row learts-mb-n30">
                                            <div class="col-md-6 col-12 learts-mb-30">
                                                <div class="single-input-item">
                                                    <label for="first-name">First Name <abbr class="required">*</abbr></label>
                                                    <input type="hidden" id="user_id"name = "user_id"value="<?php echo $row['user_id']?>">
                            
                                                    <input type="text" id="first-name"name = "username"value="<?php echo $row['username']?>">
                                                </div>
                                            </div>
                                           
                                            <div class="col-12 learts-mb-30">
                                                <label for="email">Email Addres <abbr class="required">*</abbr></label>
                                                <input type="email" id="email" name = "user_email"value="<?php echo $row['user_email']?>">
                                            </div>
                                            <div class="col-12 learts-mb-30 learts-mt-30">
                                                <fieldset>
                                                    <legend>Password change</legend>
                                                    <div class="row learts-mb-n30">
                                                       
                                                        <div class="col-12 learts-mb-30">
                                                            <label for="new-pwd">New password (leave blank to leave unchanged)</label>
                                                            <input type="password" id="new-pwd"name = "user_password"value="<?php echo $row['user_password']?>">
                                                        </div>
                                                        <div class="col-12 learts-mb-30">
                                                            <label for="confirm-pwd">Confirm new password</label>
                                                            <input type="password" id="confirm-pwd"name = "user_password"value="<?php echo $row['user_password']?>">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 learts-mb-30">
                                                <button class="btn btn-dark btn-outline-hover-dark">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- Single Tab Content End -->
                        <?php
                            }
                        ?>
                    </div>
                </div> <!-- My Account Tab Content End -->
            </div>
        </div>
    </div>
    <!-- My Account Section End -->
<?php
include 'includes/footer.php';
include 'includes/scripts.php';

?>