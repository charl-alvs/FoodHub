<?php
include('include/header.php');
include('include/extensions.php');
include('include/connectionDB.php');

    if (isset($_POST['submit_code'])) {

        if (!empty($_POST['cus_code'])) {

            $code = $_POST['cus_code'];

            $query = "SELECT * FROM order_details_tbl WHERE cus_code = $code";
            $codeMatch = $connect -> prepare($query);
            $codeMatch -> execute();
            $codeResult = $codeMatch -> get_result();
            
            if ($codeResult -> num_rows > 0) {

                $codeData = $codeResult -> fetch_assoc();

                ?>
                <link rel="stylesheet" href="stylesheets/confirmed_track.css">
                <body>
                    <!-- Navigation Bar Start -->
                    <nav class="navbar navbar-expand-sm navbar-dark bg-transparent fixed-top px-3 pt-1 py-0">
                    <a class="nav-brand h1 display-4 m-0 text-decoration-none text-light" href="index.php">Food<span>Hub</span></a>
                    <button class="navbar-toggler" type="collapse" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto text-center">
                            <li class="nav-item">
                                <a class="nav-link text-light mx-3 link-danger" href="index.php#aboutUs">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light mx-3 link-danger" href="index.php#services">Services</a>
                            </li>
                        </ul>
                    </div>
                    </nav>
                    <!-- Navigation Bar End -->
                    <div class="container">
                        <div class="card card-body">
                            <div class="mx-4">
                                <div class="row">
                                    <div class="col-md-12 my-5">
                                        <h4 class="m-0 text-md"><label>ORDER:</label> <span><?php echo $codeData['cus_code']; ?></span></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <?php
                                            if ($codeData['cus_status'] == "Order Processed") {
                                                ?><img src="assets/others/check-order.png" style="width: 100px; height: 100px;"><?php
                                            } else {
                                                ?><img src="assets/others/checkBlack.png" style="width: 100px; height: 100px;"><?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-center align-items-center">
                                        <?php
                                            if ($codeData['cus_status'] == "Order Enroute") {
                                                ?><img src="assets/others/check-order.png" style="width: 100px; height: 100px;"><?php
                                            } else {
                                                ?><img src="assets/others/checkBlack.png" style="width: 100px; height: 100px;"><?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-center align-items-center">
                                        <?php
                                            if ($codeData['cus_status'] == "Order Completed") {
                                                ?><img src="assets/others/check-order.png" style="width: 100px; height: 100px;"><?php
                                            } else {
                                                ?><img src="assets/others/checkBlack.png" style="width: 100px; height: 100px;"><?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-4">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <img src="assets/others/orderprocess.png" style="width: 50px; height: 50px;">
                                            <label class="ms-3" ><Strong>Order <br> Processed</Strong></label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <img src="assets/others/orderenroute.png" style="width: 50px; height: 50px;">
                                            <label class="ms-3" ><Strong>Order <br> Enroute</Strong></label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <img src="assets/others/orderarrived.png" style="width: 50px; height: 50px;">
                                            <label class="ms-3" ><Strong>Order <br> Arrived</Strong></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <a href="trackorder.php" class="btn btn-primary" >Track Other Order</a>
                        </div>
                    </div>
                </body>
                </html>
                <?php

            } else {

                ?>
                <script>
                    alert("Order cannot find or doesn't exist!");
                    window.history.go(-1);
                </script>
                <?php

            }
        } else {
            ?>
            <script>
                alert("Please enter a customer code!");
                window.history.go(-1);
            </script>
            <?php
        }

    } else {
        header("Location: trackorder.php");
    }

?>