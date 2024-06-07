<?php
session_start();
include('../include/connectionDB.php');

    if (empty($_SESSION['status']) && empty($_SESSION['admin_fname'])) {
        header("Location: ../login.php");
    } else {

        $id = $_GET['id'];

        $queryDel = "DELETE FROM order_details_tbl WHERE id = $id";
        $delete = $connect -> prepare($queryDel);
        $delete -> execute();

        header("Location: ../all_orders.php");
        mysqli_close($connect);
        exit("Unable to connect");

    }

?>