<?php

session_start();
include('dbConnect.php');

include('checkCredentials.php');

$day = date("Y-m-d");

$hover = "";

echo '<html><head><link rel="stylesheet" type="text/css" href="sportsQlub.css"></link>' . 
    '<title>Terrains | Club Sportif</title></head><body>'; 

include('navbar.php');

echo "<h1>Disponibilité des terrains en date du $day</h1>";

include('fieldBooking.php');

echo '</body></html>';

?>
