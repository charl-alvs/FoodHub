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
                <div class="row">
                    <div class="d-flex">
                        <a href="formSO.php" id="btn" class="btn btn-success mx-2">Special Offers Menu</a>
                        <a href="formSnacks.php" id="btn" class="btn btn-success mx-2">Snacks Menu</a>
                        <a href="formRegular.php" id="btn" class="btn btn-success mx-2">Regular Menu</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
                    <div class="card card-body">
                        <form action="products.php" method="post" enctype="multipart/form-data">
                            <div class="container">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="form-group mb-0">
                                            <label class="form-label mb-0"><strong>Menu Name:</strong></label>
                                            <input class="px-1" style="width: 82%;" type="text" name="menu_name" required>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group mb-0">
                                            <label class="form-label mb-0"><strong>Menu Price:</strong></label>
                                            <input class="px-1" style="width: 70%;" type="number" placeholder="$ 0.00" name="menu_price" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-4">
                                        <div class="form-group mb-0">
                                            <label class="form-label mb-0 px-1"><strong>Category:</strong></label>
                                            <select name="menu_category" class="text-center px-1" required>
                                                <option selected required>-</option>
                                                <option value="Special Offer">Special Offer</option>
                                                <option value="Snacks">Snacks</option>
                                                <option value="Regular">Regular</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group mb-0">
                                            <label class="form-label mb-0 px-1"><strong>Status:</strong></label>
                                            <select name="menu_status" class="text-center px-1" required>
                                                <option selected required>-</option>
                                                <option value="Available">Available</option>
                                                <option value="Not Available">Not Available</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="form-group">
                                        <label class="form-label mb-0 px-1"><strong>Menu Image:</strong></label>
                                        <input type="file" name="menu_images">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                <div class="d-flex justify-content-end align-items-end">
                                    <input style="width: 15%;" class="btn btn-success h-100" type="submit" name="btnAdd" value="Add">
                                </div>
                            </div>
                            </div>
                        </form>
                        <?php
                            if (isset($_POST['btnAdd'])) {
                                
                                $query = "SELECT * FROM menu_tbl WHERE menu_name = ?";
                                $validate = $connect -> prepare($query);
                                $validate -> bind_param("s", $_POST['menu_name']);
                                $validate -> execute();
                                $valid = $validate -> get_result();

                                if ($valid -> num_rows > 0) {

                                    echo "
                                        <div class='text-center text-danger mt-2'>
                                            Menu is already added!
                                        </div>
                                    ";
                                    mysqli_close($connect);

                                } else {

                                    if (empty($_POST['menu_name']) || empty($_POST['menu_price']) || $_POST['menu_category'] === '-' || $_POST['menu_status'] === '-') {

                                        ?>
                                        <script>
                                            alert("Input all the fields! Please Try Again!");
                                        </script>
                                        <?php

                                    } else {
                                        
                                        $image_name = $_FILES['menu_images']['name'];
                                        $image_temp = $_FILES['menu_images']['tmp_name'];
                                        $folder = "./assets/menu-images/" . $image_name;
                                        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

                                        // allowed image types
                                        $allowed_ext = array("jpg", "jpeg", "png", "gif");

                                        if (in_array($image_ext, $allowed_ext)) {
                                            
                                            $insertQuery = "INSERT INTO menu_tbl (menu_name, menu_price, menu_category, menu_status, menu_image) VALUES (?,?,?,?,?)";
                                            $insert = $connect -> prepare($insertQuery);
                                            $insert -> bind_param("sssss", $_POST['menu_name'], $_POST['menu_price'], $_POST['menu_category'], $_POST['menu_status'], $image_name);

                                            if ($insert -> execute() > 0) {
                                                
                                                if (move_uploaded_file($image_temp, $folder)) {
                                                    echo "<div class='text-center text-success mt-2'>
                                                        Successfully added!
                                                    </div>
                                                    ";
                                                    mysqli_close($connect);
                                                }

                                            } else {

                                                echo "
                                                <div class='text-center text-success mt-2'>
                                                    Unsuccessful process!
                                                </div>
                                                ";
                                                mysqli_close($connect);

                                            }

                                        } else {

                                            echo "
                                                <script>
                                                    alert('Only JPG, JPEG, PNG and GIF files are allowed!');
                                                </script>
                                            ";
                                            mysqli_close($connect);

                                        }

                                    }

                                }

                            }
                        ?>
                    </div>
                </div>

        <!-- Display All Products START HERE -->
        <div class="container mt-3">
            <div class="card">
                <div class="row p-4">
                    <?php
                    include('database/all_result.php');
                    all();
                    ?>
                </div>
            </div>
        </div>
        <!-- Display All Products END HERE -->
        <?php include('include/footer.php'); ?>
</body>
</html>
        <?php
    }
?>