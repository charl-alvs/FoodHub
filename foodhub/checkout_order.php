<?php
include('include/header.php');
include('include/extensions.php');
include('include/connectionDB.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

    if (!empty($_SESSION['verification_code'])) {
        ?>
        <link rel="stylesheet" href="stylesheets/checkout_order.css">
<body>
    <div class="container" id="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-body m-2" id="card">
                    <div class="text-center">
                        <h3 id=h3>Fill Up Customer Form</h3>
                    </div>
                    <form name="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <div class="form-group">
                            <label class="form-label m-0">Full Name:</label>
                            <input class="form-control" type="text" name="cus_name" placeholder="Enter your fullname" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label m-0">Full Address:</label>
                            <textarea class="form-control" name="cus_address" placeholder="Address" rows="5" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <div class="form-group">
                                    <label class="form-label m-0">Contact #:</label>
                                    <input class="form-control" type="number" name="cus_contact" placeholder="( 09234567854 )" 
                                    onKeyPress="if(this.value.length==11) return false;" required>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label class="form-label m-0">Type of Payment:</label>
                                    <select name="cus_payment_type" class="form-control text-center px-1">
                                        <option selected required>---</option>
                                        <option value="Cash On Delivery">Cash on Delivery</option>
                                        <option value="GCash" disabled>GCash</option>
                                        <option value="Paymaya" disabled>Paymaya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label m-0">Email:</label>
                            <input class="form-control me-2" type="email" name="cus_email" placeholder="sample@sample.com" required>
                        </div>
                        <div class="mt-3 d-flex justify-content-center align-items-center">
                            <input type="submit" name="submit_details" class="btn btn-primary w-50">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-body m-2">
                    <div class="text-center">
                        <h3 id=h3>Order Details</h3>
                        <?php
                        $all_cart = mysqli_query($connect, "SELECT * FROM cart_tbl");
                        $total = 0;
                        if (mysqli_num_rows($all_cart) > 0) {
                            while ($cart_details = mysqli_fetch_assoc($all_cart)) {
                                ?>
                                <div class="row py-1" style="font-family: 'Courier New', Courier, monospace;">
                                    <div class="col-md-3">
                                        <img src="assets/menu-images/<?php echo $cart_details['menu_image']; ?>" style="width: 50px;">
                                    </div>
                                    <div class="col-md-5 d-flex align-items-center justify-content-center">
                                        <label><?php echo $cart_details['menu_name']; ?></label>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <label>qty ( <?php echo $cart_details['menu_qty']; ?> )</label>
                                    </div>
                                </div>
                                <?php
                                $total += ($cart_details['menu_qty'] * $cart_details['menu_price']);
                            }
                        }
                        ?>
                    </div>
                    <div class="float-end">
                        <div class="bg-dark mt-4 rounded d-flex align-items-center justify-content-center p-3 float-end" style="width: fit-content;">
                            <p class="text-light h5 m-0">Total : <?php echo $total; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php               
        if (isset($_POST['submit_details'])) {
            
            $cus_name = $_POST['cus_name'];
            $cus_address = $_POST['cus_address'];
            $cus_contact = $_POST['cus_contact'];
            $cus_payment_type = $_POST['cus_payment_type'];
            $cus_email = $_POST['cus_email'];
            $product_data[] = "";
            $cart_data = mysqli_query($connect, "SELECT * FROM cart_tbl");
            if (mysqli_num_rows($cart_data) > 0) {
                while ($inserting_cart = mysqli_fetch_assoc($cart_data)) {
                    $product_data[] = $inserting_cart['menu_name'] . ' ('. $inserting_cart['menu_qty'] .') ';
                }
            }

            $total_product = implode(" ", $product_data);
            
            if (empty($total_product)) {
                ?>
                <script>
                    alert("Cart is Empty!");
                </script>
                <?php
            } else {

                $cus_code = random_int(1, 999999);
                $status = "Order Processed";

                $queryMatch = "SELECT * FROM order_details_tbl WHERE cus_code = $cus_code";
                $matchCode = $connect -> prepare($queryMatch);
                $matchCode -> execute();
                $match = $matchCode -> get_result();

                if ($match -> num_rows > 0) {

                    ?>
                    <script>
                        window.history.go(-1);
                    </script>
                    <?php

                } else {
                    if (empty($cus_name) || empty($cus_address) || empty($cus_contact) || $cus_payment_type == "---" || empty($cus_email)) {
                        ?>
                        <script>
                            alert("Please fill up all the fields!");
                        </script>
                        <?php
                    } else {

                        $insertQuery = "INSERT INTO order_details_tbl (cus_code, cus_name, cus_address, cus_contact, cus_payment_type, cus_email, cus_order, cus_total_pay, cus_status)
                        VALUES (?,?,?,?,?,?,?,?,?)";
                        $insert = $connect -> prepare($insertQuery);
                        $insert -> bind_param("sssssssss", $cus_code, $cus_name, $cus_address, $cus_contact, $cus_payment_type, $cus_email, $total_product, $total, $status);

                        if ($insert -> execute() > 0) {

                        echo "
                            <script>
                                window.location.href = 'confirmed_order.php?code=$cus_code';
                            </script>
                        ";

                        try {
            
                            $mail = new PHPMailer(true);
            
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'foodhub042@gmail.com';
                            $mail->Password = 'yvdsbzqqrmfknyhi';
                            $mail->SMTPSecure = 'ssl';
                            $mail->Port = 465;
            
                            $mail->setFrom('foodhub042@gmail.com');
                            $mail->addAddress($cus_email);
                            $mail->isHTML(true);
            
                            $mail->Subject = "Verification Code";
                            $mail->Body = "Your Order code is " . $cus_code;
                            $mail->send();
                            
                        } catch (Exception $e) {
                            ?>
                            <script>
                                alert("Unable to send! Check your internet connection!");
                            </script>
                            <?php
                        }

                        unset($_SESSION['verification_code']);
                        mysqli_query($connect, "DELETE FROM cart_tbl");
                        mysqli_close($connect);
                        
                        }
                    }
                }
            }
        }
    ?>
</body>
</html>
        <?php
    } else {
        ?>
        <script>
            window.history.go(-1);
        </script>
        <?php
    }
?>
