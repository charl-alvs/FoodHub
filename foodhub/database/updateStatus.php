<?php
session_start();

    if (empty($_SESSION['status']) && empty($_SESSION['admin_fname'])) {
        header("Location: ../login.php");
    } else {
        
        if (isset($_POST['update_status'])) {
            include('../include/connectionDB.php');
            $id = $_GET['id'];
            $statusChange = $_POST['selected_status'];

            $selectQuery = "SELECT cus_status FROM order_details_tbl WHERE id=$id";
            $select = $connect -> prepare($selectQuery);
            $select -> execute();
            $selectResult = $select -> get_result();
            if ($selectResult -> num_rows > 0) {
                $selectData = $selectResult -> fetch_assoc();

                $updateQuery = "UPDATE order_details_tbl SET cus_status = ? WHERE id = ?";
                $update = $connect -> prepare($updateQuery);
                $update -> bind_param("ss", $statusChange, $id);
                
                if ($update -> execute() > 0) {
                    echo "
                        <script>
                            alert('Update Successfully');
                            window.history.go(-1);
                        </script>
                    ";
                }

            }
        }

    }
?>