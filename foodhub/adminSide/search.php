<?php
include('../include/header.php');
include('../include/extensions.php');
include('../include/connectionDB.php');
session_start();

    if (empty($_SESSION['status']) && empty($_SESSION['admin_fname'])) {
        header("location: ../login.php");
    } else {
        ?>
<link rel="stylesheet" href="../stylesheets/all_Orders.css">
<body>
        <!-- ADMIN PAGE START -->
<div class="container-fluid px-0" style="width:100%">
    <!-- Navigation Bar Start -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark px-3 py-0">
           <div class="nav-brand h1 display-4 m-0 text-light">Food<span>Hub</span></div>
           <button class="navbar-toggler" type="collapse" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
           aria-controls="navbarSupportedContent" aria-expanded="false">
           <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <div class="nav-item">
                        <a class="nav-link text-light mx-4 link-danger" href="../admin.php">Home</a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link text-light mx-4 link-danger" href="../all_orders.php">All Orders</a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link text-light mx-4 link-danger" href="../products.php">Products</a>
                    </div>
           </div>
                <div class="dropdown p-2">
                    <div class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- Admin Default Image -->
                        <img src="https://i.pinimg.com/474x/76/4d/59/764d59d32f61f0f91dec8c442ab052c5.jpg" 
                        alt="Admin"
                        width=30 height=30 class="rounded-circle">
                        <!-- Admin Default Image End -->
                        <div class="cur mx-4">
                            <?php
                            echo $_SESSION['admin_fname'];
                            ?>
                        </div>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-dark shadow">
                        <li>
                            <a class="dropdown-item" href="../signup.php">Add account</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="../logout.php">Sign out</a>
                        </li>
                    </ul>
                </div>
        </nav>
    <!-- Navigation Bar End -->
</div>
        <div class="container-fluid">
            <div class="my-3">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?" method="GET">
                    <div class="d-flex justify-content-center align-items-center">
                        <input class="form-control" type="text" name="searchData" placeholder="Search" style="width: 50%;">
                        <button class="btn btn-secondary ms-2" type="submit" name="search"><i class="bi bi-search"></i> Search</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-bordered bg-light">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">Order Code</th>
                            <th class="text-center align-middle">Customer Name</th>
                            <th class="text-center align-middle">Customer Address</th>
                            <th class="text-center align-middle">Customer Contact</th>
                            <th class="text-center align-middle">Payment Type</th>
                            <th class="text-center align-middle">Customer Email</th>
                            <th class="text-center align-middle">Customer Order</th>
                            <th class="text-center align-middle">Total Pay</th>
                            <th class="text-center align-middle">Status</th>
                            <th class="text-center align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (empty($_GET['searchData'])) {
                                ?>
                                <script>
                                    window.location.href = "../all_orders.php";
                                </script>
                                <?php
                            } else {

                                $searchKeyword = $_GET['searchData'];

                                $allQuery = "SELECT * FROM order_details_tbl WHERE LOWER(cus_code) LIKE LOWER('%$searchKeyword%') OR
                                LOWER(cus_name) LIKE LOWER('%$searchKeyword%') OR LOWER(cus_address) LIKE LOWER('%$searchKeyword%') OR
                                LOWER(cus_contact) LIKE LOWER('%$searchKeyword%') OR LOWER(cus_email) LIKE LOWER('%$searchKeyword%')";
                                $statement = $connect -> prepare($allQuery);
                                $statement -> execute();
                                $resultData = $statement -> get_result();
                                if ($resultData -> num_rows > 0) {
                                    while ($rowsData = $resultData -> fetch_assoc()) {
                                        ?>
                                            <form action="database/updateStatus.php?id=<?php echo $rowsData['id']; ?>" method="POST">
                                                <tr>
                                                    <td class="text-center align-middle"><?php echo $rowsData['cus_code']; ?></td>
                                                    <td class="text-center align-middle"><?php echo $rowsData['cus_name']; ?></td>
                                                    <td class="text-center align-middle"><?php echo $rowsData['cus_address']; ?></td>
                                                    <td class="text-center align-middle"><?php echo $rowsData['cus_contact']; ?></td>
                                                    <td class="text-center align-middle"><?php echo $rowsData['cus_payment_type']; ?></td>
                                                    <td class="text-center align-middle"><?php echo $rowsData['cus_email']; ?></td>
                                                    <td class="text-center align-middle"><?php echo $rowsData['cus_order']; ?></td>
                                                    <td class="text-center align-middle"><?php echo $rowsData['cus_total_pay']; ?></td>
                                                    <td class="text-center align-middle">
                                                        <?php
                                                            if ($rowsData['cus_status'] == "Order Processed") {
                                                                ?>
                                                                <div class="bg-warning rounded p-2"><?php echo $rowsData['cus_status']; ?></div>
                                                                <?php
                                                            } else if ($rowsData['cus_status'] == "Order Enroute") {
                                                                ?>
                                                                <div class="bg-primary text-light rounded p-2"><?php echo $rowsData['cus_status']; ?></div>
                                                                <?php
                                                            } else if ($rowsData['cus_status'] == "Order Completed") {
                                                                ?>
                                                                <div class="bg-success text-light rounded p-2"><?php echo $rowsData['cus_status']; ?></div>
                                                                <?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="text-center align-middle">
                                                        <select class="mb-1" name="selected_status" required>
                                                            <option selected required class="text-center">...</option>
                                                            <option class="text-center" value="Order Processed">Order Processed</option>
                                                            <option class="text-center" value="Order Enroute">Order Enroute</option>
                                                            <option class="text-center" value="Order Completed">Order Completed</option>
                                                        </select>
                                                        <div class="d-flex">
                                                            <input class="btn btn-success me-1" type="submit" name="update_status" value="Update">
                                                            <a href="database/deleteRecord.php?id=<?php echo $rowsData['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record ?')">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </form>
                                        <?php
                                    } 
                                } else {
                                    ?>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="alert alert-danger text-center" role="alert" style="width: 30%;">
                                            Record Not Found!
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                        ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
</body>
</html>
        <?php
    }
?>