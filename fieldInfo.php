<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
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

echo '<div class="instruction"><div class="reserved ninja"></div><p>Terrain réservé (non disponible)</p></div>' . 
    '<div class="instruction"><div class="userRes ninja"></div><p>Votre réservation</p></div>';

echo '</body></html>';

?>
