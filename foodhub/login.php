<?php
include('include/header.php'); // HTML Header
include('include/extensions.php'); // CDN and other extension link including BS5
include('include/connectionDB.php'); // open database
session_start();

    if (empty($_SESSION['status'])) {

        if (isset($_POST['btnLogin'])) {

            $admin_username = trim($_POST['admin_username']);
            $admin_password = trim($_POST['admin_password']);
    
            if (empty($admin_username) || empty($admin_password)) {
                echo "<script>
                    alert('Please fill up the field!');
                </script>";
            }
            else {
                
                $queryValidate = "SELECT * FROM admin_account_tbl WHERE admin_username=?";
                $validate = $connect -> prepare($queryValidate);
                $validate -> bind_param("s", $admin_username);
                $validate -> execute();
                $valid = $validate -> get_result();
    
                if ($valid -> num_rows > 0) {
    
                    $rows = $valid -> fetch_assoc();
    
                    if (password_verify($admin_password, $rows['admin_password'])) {
    
                        $_SESSION['status'] = bin2hex(random_bytes(32));
                        $_SESSION['admin_fname'] = $rows['admin_fname'];
    
                        header("location: admin.php");
                        mysqli_close($connect);
    
                    } else {
    
                        echo "<script>
                                alert('Incorrect Password! Please try again!');
                        </script>";
    
                    }

                } else {
                    ?>
                    <script>
                        alert("Account doesn't exist!");
                    </script>
                    <?php
                }
            }
        }

    } else {

        header("location: admin.php");

    }

?>
<link rel="stylesheet" href="stylesheets/loginStyle.css">
<body>
    <h1 class="text-light"><a href="index.php" class="text-decoration-none text-light">Food<span>Hub</span></a></h1>
    <div class="login shadow-lg text-dark">
        <h1>Login</h1>
        
        <form action="login.php" method="post">
            <div class="form-group">
                <label class="form-label mb-0">Username</label>
                <input class="form-control" type="username" name="admin_username" required>
            </div>

            <div class="form-group">
                <label class="form-label mb-0">Password</label>
                <input class="form-control" type="password" name="admin_password" required>
            </div>

            <input class="btn btn-success w-100 mt-4" type="submit" name="btnLogin">
        </form>
    </div>
</body>
</html>