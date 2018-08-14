<?php

session_start();

include('dbConnect.php');

$day = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));

$hover = "interact";

$booked_hour = isset($_POST['time']) ? $_POST['time'] : NULL;
$booked_field = isset($_POST['field']) ? $_POST['field'] : NULL;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

echo '<html><head><link rel="stylesheet" type="text/css" href="sportsQlub.css"></link>' . 
    '<script type="text/javascript" src="jquery.js"></script>' . 
    '<script type="text/javascript" src="sportsQlub.js"></script>' . 
    '<title>Réservations | Club Sportif</title></head><body>'; 

echo "<h1>Disponibilité des terrains en date du $day</h1>";

include('fieldBooking.php');

echo '<form method="post" action="reservation.php">' . 
     '<input class="invisible" type="text" name="time" value="0"/>' . 
     '<input class="invisible" type="text" name="field" value="0"/>' . 
     '<input type="submit" value="Confirmer"/></form>';

echo '</body></html>';

?>
