<?php

session_start();

include('dbConnect.php');

include('checkCredentials.php');

if (isset($_POST['start']) && isset($_POST['end'])) {
	//If form is filled
	$starttime = $_POST['start'];
	$endtime = $_POST['end'];
	
	if($endtime <= $starttime || $starttime < 6 || $endtime < 6 || $starttime > 21 || $endtime > 21) {
		include('dbClose.php');
		echo '<script type="text/javascript">alert("Valeurs non-valides");</script>';
		include('login.html');
		die();
	}
	
	$res = mysqli_query($connect, "SELECT DISTINCT * FROM terrains  WHERE NOT EXISTS (SELECT * FROM reservations WHERE numero = terrains.numero AND DATE(date)=CURRENT_DATE AND TIME(date) BETWEEN SEC_TO_TIME(". ($starttime*60*60). ") AND SEC_TO_TIME(". (($endtime-1)*60*60). ")) ORDER BY numero;");
    if(!$res) {
		include('dbClose.php');
		echo '<script type="text/javascript">alert("Échec d\'interrogation de la base de données");</script>';
		include('login.html');
		die();
    }
    
    //print page with query results in a list
    echo '<html><head><link rel="stylesheet" type="text/css" href="sportsQlub.css"></link>' . 
        '<title>Administration | Club Sportif</title></head><body>'; 

    include('navbar.php');
     
    echo "<h1>Liste des terrains disponibles entre ".$starttime." et ".$endtime." heure pour la journée</h1>";
	if(mysqli_num_rows($res)==0) {
		echo "<p>Aucun terrain disponible</p>";
	} else {
		echo "<ul>";
		while($row = mysqli_fetch_assoc($res)) {
			echo "<li>Terrain #".$row['numero']."</li>";
		}
		echo "</ul>";
	}
	mysqli_free_result($res);
	
	echo '<form method="post" action="adminAvailable.php">';
    echo '<fieldset><legend>Nouvelle recherche</legend>';
    echo '<p>Afficher les terrains disponibles entre <input type="number" name="start" min="6" max="21" required="required"> heure et <input type="number" name="end" min="6" max="21" required="required"> heure pour la journée ';
	echo '<input type="submit" value="Envoyer"/>';
	echo ' (Veuillez entrer un invervalle d\'heures entre 6 et 21 heure.)</p>';
    echo '</fieldset></form>';
	
} else {
    
    //the form to allow the user to select which time period to view availability for
    echo '<html><head><link rel="stylesheet" type="text/css" href="sportsQlub.css"></link>' . 
        '<title>Administration | Club Sportif</title></head><body>'; 

    include('navbar.php');
    
    echo '<form method="post" action="adminAvailable.php">';
    echo '<fieldset><legend>Module administratif</legend>';
    echo '<p>Afficher les terrains disponibles entre <input type="number" name="start" min="6" max="21" required="required"> heure et <input type="number" name="end" min="6" max="21" required="required"> heure pour la journée ';
	echo '<input type="submit" name="available" value="Envoyer"/>';
	echo ' (Veuillez entrer un invervalle d\'heures entre 6 et 21 heure.)</p>';
    echo '</fieldset></form>';

}

// Close connection
include('dbClose.php');
	
echo '</body></html>';

?>
