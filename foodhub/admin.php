<?php
include('include/header.php');
include('include/extensions.php');
include('include/connectionDB.php');
session_start();

    if (empty($_SESSION['status']) && empty($_SESSION['admin_fname'])) {
        header("location: login.php");
    } else {
        ?>
<link rel="stylesheet" href="stylesheets/admin_Style.css">
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
        
        <div class="container mt-5">
            <h1 class="text-center text-light display-4" style="font-weight: 600; cursor: default;">Admin <span>Accounts</span></h1>
            <div class="card card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Middle Name</th>
                            <th class="text-center">Username</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT * FROM admin_account_tbl ORDER BY id";
                    $statementQ = $connect -> prepare($query);
                    $statementQ -> execute();
                    $result = $statementQ -> get_result();
                    if ($result -> num_rows > 0) {
                        while ($rows = $result -> fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $rows['admin_lname']; ?></td>
                            <td class="text-center"><?php echo $rows['admin_fname']; ?></td>
                            <td class="text-center"><?php echo $rows['admin_mname']; ?></td>
                            <td class="text-center"><?php echo $rows['admin_username']; ?></td>
                        </tr>
                        <?php
                        } 
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <!-- ADMIN PAGE END -->
</body>
</html>
        <?php
    }
?>