<?php
include('include/header.php');
include('include/extensions.php');
include('include/connectionDB.php');
session_start();

    if (empty($_SESSION['status'])) {
        header("location: login.php");
    } else {
        if (isset($_POST['btnSubmit'])) {

            // date and time initialized
            $date = date('Y-m-d');
            $time = date('H-i-s');
    
            // returns TRUE if password and confirm password is not Empty
            if (!empty($_POST['admin_password']) && !empty($_POST['confirm_password'])) {
    
                // Check the database if username is already exist
                $queryValidate = "SELECT admin_username FROM admin_account_tbl WHERE admin_username=?";
                $validate = $connect -> prepare($queryValidate);
                $validate -> bind_param("s", $_POST['admin_username']);
                $validate -> execute();
                $valid = $validate -> get_result();
                
                // returns TRUE if username is already exist otherwise FALSE
                if ($valid -> num_rows > 0) {
    
                    echo "<script>
                        alert('Username is already exist! Please try another!');
                    </script>";
    
                } else {
    
                    if (empty($_POST['admin_lname']) || empty($_POST['admin_fname']) || empty($_POST['admin_username']) || empty($_POST['admin_password']) || empty($_POST['confirm_password'])) {
                        ?>
                            <script>
                                alert("Fill up all the fields!");
                            </script>
                        <?php
                    } else {
                        // Insertion of data to database START HERE
                        if (strcmp($_POST['admin_password'], $_POST['confirm_password']) == 0) {
        
                            // hash password
                            $admin_pass = password_hash($_POST['admin_password'], PASSWORD_DEFAULT);

                            $query = "INSERT INTO admin_account_tbl (admin_lname, admin_fname, admin_mname, admin_username,
                            admin_password, date_added, time_added, last_updated, last_time_updated) value (?,?,?,?,?,?,?,?,?)";
                            $statement = $connect -> prepare($query);
                            $statement -> bind_param("sssssssss", $_POST['admin_lname'], $_POST['admin_fname'], $_POST['admin_mname'],
                            $_POST['admin_username'], $admin_pass, $date, $time, $date, $time);
                            
                            if ($statement -> execute() > 0) {
                
                                echo "<script>
                                    alert('Successfully Added!');
                                </script>";
                                mysqli_close($connect);

                            }
                            else {
                
                                echo "<script>
                                    alert('Unsuccessfully Added!');
                                </script>";
                                mysqli_close($connect);

                            }
                        }
                        else {
                
                            echo "<script>
                                    alert('Password did not match!');
                                </script>";
                            mysqli_close($connect);
                            
                        }
                    }
                }
            }
        }
    }
?>
<link rel="stylesheet" href="stylesheets/signupStyle.css">
<body>
    <div class="login bg-light text-dark">
        <h1 class="mb-0">Food<span>Hub</span></h1>

        <form action="signup.php" method="post">
            <div class="form-group">
                <label class="form-label">Lastname</label>
                <input class="form-control" type="text" name="admin_lname" placeholder="Enter your lastname" required>
            </div>

            <div class="form-group">
                <label class="form-label">Firstname</label>
                <input class="form-control" type="text" name="admin_fname" placeholder="Enter your firstname" required>
            </div>

            <div class="form-group">
                <label class="form-label">Middlename</label>
                <input class="form-control" type="text" name="admin_mname" placeholder="Enter your middlename">
            </div>

            <div class="form-group">
                <label class="form-label">Username</label>
                <input class="form-control" type="text" name="admin_username" placeholder="Enter your username" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input class="form-control" type="password" name="admin_password" placeholder="Enter your password" required>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input class="form-control" type="password" name="confirm_password" placeholder="Confirm password" required>
            </div>
            <div class="d-flex">
                <input class="btn btn-success w-50 mt-3 mx-1" type="submit" name="btnSubmit">
                <a href="admin.php" class="btn btn-danger w-50 mt-3 mx-1">Back</a>
            </div>
        </form>
    </div>
</body>
</html>