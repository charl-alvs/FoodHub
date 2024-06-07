<?php
session_start();

    if (empty($_SESSION['status'])) {
        header("location: login.php");
    } else {
        unset($_SESSION['status']);
        unset($_SESSION['admin_password']);
        unset($_SESSION['admin_fname']);

        header("location: login.php");

    }
?>