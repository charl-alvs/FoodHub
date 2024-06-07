<?php
include('include/header.php');
include('include/extensions.php');
include('include/connectionDB.php');

?>
<link rel="stylesheet" href="stylesheets/confirmed_order.css">
<body>
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <div class="w-50">
                <div class="card card-body" id="card">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="assets/others/check.png" alt="check" style="width: 150px; height: 150px;">
                    </div>
                    <div class="text-center">
                        <h3>Order Successfully</h3>
                        <div class="d-flex justify-content-center">
                            <div class="bg-white shadow-lg w-50 p-3 mt-4 rounded">
                                <h3>Your Code</h4>
                                <h4 class="text-success"><strong><u><?php if (!empty($_GET['code'])) { echo $_GET['code']; } else { echo $_GET['code'] = null; } ?></strong></u></h5>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mt-">
                        <label class="lead text-center">We send you a copy of your Order Code to your email. Thank you</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-3">
            <a href="order.php" class="btn btn-warning">Order Again</a>
            <a href="trackorder.php?code=<?php if (!empty($_GET['code'])) { echo $_GET['code']; } else { echo $_GET['code'] = null; } ?>" class="btn btn-primary ms-2">Track Order</a>
        </div>
    </div>
</body>
</html>