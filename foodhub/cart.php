<?php
include('include/header.php');
include('include/extensions.php');
include('include/connectionDB.php');

$grand_total = 0;

if (isset($_POST['updateQ'])) {
    $id = $_POST['id_Q'];
    $updateQ = $_POST['update_quantity'];
    $resultQ = mysqli_query($connect, "UPDATE cart_tbl SET menu_qty = $updateQ WHERE id = $id");
    if ($resultQ) {
        header("Location: cart.php");
    }
}

if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($connect, "DELETE FROM cart_tbl WHERE id = '$remove_id'");
    header("Location: cart.php");
 };

 if(isset($_GET['remove_all'])){
    mysqli_query($connect, "DELETE FROM cart_tbl");
    header("Location: cart.php");
 }

?>
<link rel="stylesheet" href="stylesheets/cart.css">
<body>
    <div class="container">
        <a href="order.php" class="btn btn-danger mb-2" style="width: 10%;">Back</a>
        <div class="card card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center"></th>
                        <th>Name</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $allQuery = "SELECT * FROM cart_tbl ORDER BY id";
                    $all = $connect -> prepare($allQuery);
                    $all -> execute();
                    $result = $all -> get_result();
                    if ($result -> num_rows > 0) {
                        while ($rows = $result -> fetch_assoc()) {
                            ?>
                            <tr>
                                <td style="width: 10%;">
                                    <p class="text-center m-0">
                                        <img src="assets/menu-images/<?php echo $rows['menu_image']; ?>"
                                        style="width: 60%;">
                                    </p>
                                </td>
                                <td style="width: 20%;" class="align-middle">    
                                    <?php echo $rows['menu_name']; ?>    
                                </td>
                                <td class="text-center align-middle">
                                    <?php echo $rows['menu_price']; ?>
                                </td>
                                <td class="text-center align-middle" style="width: 35%;">  
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                        <input type="hidden" name="id_Q"  value="<?php echo $rows['id']; ?>" >
                                        <input class="text-center" style="width: 30%;" type="number" name="update_quantity" min="1"  value="<?php echo $rows['menu_qty']; ?>" >
                                        <input class="btn btn-success" type="submit" value="Update Quantity" name="updateQ">
                                    </form>   
                                </td>
                                <td class="text-center align-middle">
                                    <?php 
                                    $total = $rows['menu_price'] * $rows['menu_qty'];
                                    echo $total;
                                    ?>
                                </td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-danger" href="cart.php?remove=<?php echo $rows['id']; ?>" 
                                    onclick="return confirm('Remove menu from cart ?')">Remove Menu</a>
                                </td>
                            </tr>
                            <?php
                            $grand_total += $total;
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="container">
                <h2 class="m-0">Grand Total : <?php echo $grand_total; ?></h2>
            </div>
        </div>
        <a href="cart.php?remove_all" class="btn btn-danger float-end mt-2" onclick="return confirm('Are you sure you want to remove all ?')">
            <i class="bi bi-trash"></i> Remove All
        </a>
        <a href="verification.php" class="btn btn-primary mt-2 float-end mx-2">
            <i class="bi bi-bag-check-fill"></i> Proceed Checkout
        </a>
    </div>
</body>
</html>