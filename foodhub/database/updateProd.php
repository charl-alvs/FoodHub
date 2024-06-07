<?php
session_start();

    if (empty($_SESSION['status']) && empty($_SESSION['admin_fname'])) {
        header("Location: ../login.php");
    } else {
        include('../include/connectionDB.php');
        $id = $_GET['id'];
        $on = "Available";
        $off = "Not Available";

        $query = "SELECT menu_status FROM menu_tbl WHERE id=$id";
        $statement = $connect -> prepare($query);
        $statement -> execute();
        $result = $statement -> get_result();
        if ($result -> num_rows > 0) {
            $rows = $result -> fetch_assoc();

            if ($rows['menu_status'] == $on) {

                $updateQ = "UPDATE menu_tbl SET menu_status=? WHERE id=?";
                $update = $connect -> prepare($updateQ);
                $update -> bind_param("ss", $off, $id);

                if ($update -> execute() > 0) {
                    echo "<script>
                        alert('Update Succesfully'); 
                        window.history.go(-1);
                    </script>";
                    mysqli_close($connect);
                    exit();
                }

            } else if ($rows['menu_status'] == $off) {
                
                $updateQ = "UPDATE menu_tbl SET menu_status=? WHERE id=?";
                $update = $connect -> prepare($updateQ);
                $update -> bind_param("ss", $on, $id);

                if ($update -> execute() > 0) {
                    echo "<script>
                        alert('Update Succesfully'); 
                        window.history.go(-1);
                    </script>";
                    mysqli_close($connect);
                    exit();
                }

            }
        }
    }
?>