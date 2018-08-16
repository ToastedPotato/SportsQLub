<?php

session_start();
include('dbConnect.php');

include('checkCredentials.php');

if (isset($_POST['searchDate'])) {

$date = $_POST['searchDate'];

$res = mysqli_query($connect, "SELECT login, numero, TIME(reservations.date) as time FROM reservations WHERE date BETWEEN '$date 06:00:00' AND '$date 21:00:00';");

if(!$res) {
	include('dbClose.php');
	echo '<script type="text/javascript">alert("Échec d\'interrogation de la base de données");</script>';
	include('login.html');
	die();
}

echo '<html><head><link rel="stylesheet" type="text/css" href="sportsQlub.css"></link>' . 
        '<title>Liste de Réservations | Club Sportif</title></head><body>'; 

include('navbar.php');
 
echo "<h1>Liste des réservations pour la date du $date";
if(mysqli_num_rows($res)==0) {
	echo "<p>Aucune réservation pour cette date</p>";
} else {
	while($row = mysqli_fetch_assoc($res)) {
	    echo "</ul>";
		echo "<li> Terrain #" . $row['numero'] . "réservé par " . $row['login'] . " pour " . $row['date'] . "</li>";
	}
	echo "</ul>";
}
    
    //reprinting the form in cae the user wants to search using another date
    echo '<form method="post" action="history.php">';
    echo '<fieldset><legend>Nouvelle recherche</legend>';
    echo '<input type="date" name="searchDate" required="required">';
    echo '<input type="submit" value="Envoyer"/>';
    echo '</fieldset></form>';
    

}else{

    //the form to select time period to view reservations for
    echo '<html><head><link rel="stylesheet" type="text/css" href="sportsQlub.css"></link>' . 
        '<title>Liste de Réservations | Club Sportif</title></head><body>'; 

    include('navbar.php');

    echo '<form method="post" action="history.php">';
    echo '<fieldset><legend>Recherche de réservations par date</legend>';
    echo '<input type="date" name="searchDate" required="required">';
    echo '<input type="submit" value="Envoyer"/>';
    echo '</fieldset></form>';
    
}
// Close connection
include('dbClose.php');
	
echo '</body></html>';

?>
