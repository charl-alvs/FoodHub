<?php
include('include/header.php');
include('include/extensions.php');
include('include/connectionDB.php');
session_start();

    if (empty($_SESSION['status']) && empty($_SESSION['admin_fname'])) {
        header("location: login.php");
    } else {
        ?>
                <!-- ADMIN PAGE START -->
        <link rel="stylesheet" href="stylesheets/productStyle.css">
        <body>
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
                                <a class="nav-link text-light mx-4 link-danger" href="admin.php">Home</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link text-light mx-4 link-danger" href="all_orders.php">All Orders</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link text-light mx-4 link-danger" href="products.php">Products</a>
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
                                    <a class="dropdown-item" href="signup.php">Add account</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="logout.php">Sign out</a>
                                </li>
                            </ul>
                        </div>
                </nav>
            <!-- Navigation Bar End -->
        </div>
                <div class="container my-3">
                    <div class="card card-body">
                        <div class="d-flex">
                            <a href="formSO.php" id="btn" class="btn btn-success mx-2">Special Offers</a>
                            <a href="formSnacks.php" id="btn" class="btn btn-success mx-2">Snacks Menu</a>
                            <a href="formRegular.php" id="btn" class="btn btn-success mx-2">Regular Menu</a>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <a href="products.php" class="btn btn-danger" style="width: 10%;">Back</a>
                </div>

                <!-- Display All Products START HERE -->
                <div class="container mt-3">
                    <div class="card">
                        <div class="text-center m-5 mb-0">
                            <label><h1>Regular Menu</h1></label>
                        </div>
                        <div class="row p-4">
                            <?php
                            $regular = "Regular";
                            include('database/show_result.php');
                            showR($regular);
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Display All Products END HERE -->
        </body>
        </html>
        <?php
    }
?>