<?php
include('include/header.php');
include('include/extensions.php');
include('include/connectionDB.php');
?>
<link rel="stylesheet" href="stylesheets/order.css">
<body>
    <!-- Navigation Bar Start -->
    <div class="container-fluid px-0">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark px-3">
            <a class="nav-brand h1 display-5 m-0 text-decoration-none text-light"
                href="index.php">Food<span>Hub</span></a>
            <button class="navbar-toggler" type="collapse" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto text-center">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-light mx-3 px-3 link-danger" >Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light mx-3 link-danger" href="trackorder.php">
                            <div class="d-flex">
                                <div class="me-2">
                                <i class="bi bi-truck"></i>
                                </div>
                                <div class="text-center">
                                    Track Order
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light mx-3 link-danger" href="cart.php">
                            <?php
                            $select_row = mysqli_query($connect, "SELECT * FROM cart_tbl");
                            $count_rows = mysqli_num_rows($select_row);
                            ?>
                            <i class="bi bi-cart mx-1"></i> Cart ( <?php echo $count_rows; ?> )
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Navigation Bar End -->

    <div class="container mt-3">
        <div class="card card-body">
            <div class="row">
                <div class="d-flex">
                    <a href="orderSO.php" style="width: 26vw;" class="btn btn-success mx-2">Special Offers Menu</a>
                    <a href="orderSnacks.php" style="width: 26vw;" class="btn btn-success mx-2">Snacks Menu</a>
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" style="width: 26vw;" class="btn btn-success mx-2">Regular Menu</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <a href="order.php" class="btn btn-danger my-2" style="width: 10%;">Back</a>
        <div class="card card-body">
            <div class="row">
                <?php
                $regular = "Regular";
                $query = "SELECT * FROM menu_tbl WHERE menu_category = ?";
                $statement = $connect -> prepare($query);
                $statement -> bind_param("s", $regular);
                $statement -> execute();
                $result = $statement -> get_result();
                if ($result -> num_rows > 0) {
        
                    while ($rows = $result -> fetch_assoc()) {
                        ?>
                        <div class="col-md-3">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <div class="card shadow my-3">
                                    <div class="card-body">
                                        <img src="assets/menu-images/<?php echo $rows['menu_image']; ?>"
                                        style="width: 100%; height: fit-content;">
                                    </div>
                                    <div class="card-body py-0" style="height: fit-content;">
                                        <label class="d-block text-truncate"
                                            style="max-width: 400px; font-size: 100%;"
                                            title="<?php echo $rows['menu_name'] ?>">
                                            <?php echo $rows['menu_name'] ?>
                                        </label>
                                    </div>
                                    <div class="card-body py-0" style="height: fit-content;">
                                        <?php echo "$ " . $rows['menu_price'] ?>
                                    </div>
                                    <div class="card-body" style="height: fit-content;">
                                        <?php
                                        if ($rows['menu_status'] == "Available") {
                                            ?>
                                            <div class="text-center">
                                                <input class="btn btn-success btn-sm" type="submit" name="addCart" value="Add to cart">
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="text-center text-danger">
                                                Not Available
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <input type="hidden" name="menu_image" value="<?php echo $rows['menu_image'] ?>">
                                <input type="hidden" name="menu_name" value="<?php echo $rows['menu_name']; ?>">
                                <input type="hidden" name="menu_price" value="<?php echo $rows['menu_price']; ?>">
                                <input type="hidden" name="menu_qty" value="1">
                            </form>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
        if (isset($_POST['addCart'])) {

            $matchQuery = "SELECT * FROM cart_tbl WHERE menu_name = ?";
            $match = $connect -> prepare($matchQuery);
            $match -> bind_param("s", $_POST['menu_name']);
            $match -> execute();
            $matched = $match -> get_result();

            if ($matched -> num_rows > 0) {

                echo "<script>
                    alert('Menu is already in the cart');
                    window.history.go(-1);
                </script>";

            } else {

                $insertQuery = "INSERT INTO cart_tbl (menu_image, menu_name, menu_price, menu_qty) VALUES (?,?,?,?)";
                $insert = $connect -> prepare($insertQuery);
                $insert -> bind_param("ssss", $_POST['menu_image'], $_POST['menu_name'], $_POST['menu_price'], $_POST['menu_qty']);

                if ($insert -> execute() > 0) {

                    echo "<script>
                        alert('Menu added');
                        window.history.go(-1);
                    </script>";

                }

            }

        }
    ?>
</body>
</html>