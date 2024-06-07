<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "foodhub_db";
$port = 3308;

// Create connection
$connect = mysqli_connect($servername, $username, $password, $database, $port);

// Check connection
    if (!$connect) {
        die("Connection failed! " . mysqli_connect_error());
    }
?>