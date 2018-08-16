<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php

$host = "localhost";
$user = "lacombam";
$password = "bamp108L";
$db_name = "lacombam_fieldRes";

$connect = mysqli_connect($host, $user, $password, $db_name);
if (!$connect) {
    echo '<script type="text/javascript">alert("Failed to connect to DB: ' . mysqli_connect_errno() . mysqli_connect_error() . '");</script>';
    die();
}

?>
