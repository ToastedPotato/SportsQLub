<?php

$host = "localhost";
$user = "lacombam";
$password = "bamp108L";
$db_name = "fieldRes";

$connect = mysqli_connect($host, $user, $password, $db_name);
if (!$connect) {
    echo '<script type="text/javascript">alert("Failed to connect to DB: ' . mysqli_connect_errno() . mysqli_connect_error() . '");</script>';
}

?>
