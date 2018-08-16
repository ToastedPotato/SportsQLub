<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php

session_start();

include('dbConnect.php');

include('checkCredentials.php');

// Displays detailled booking info
$res = mysqli_query($connect, "SELECT reservations.numero, reservations.login, TIME(reservations.date) as time, usagers.nom, usagers.prenom FROM reservations INNER JOIN usagers ON reservations.login = usagers.login  WHERE DATE(date)=CURRENT_DATE ORDER BY numero, date;");

if(!$res) {
	include('dbClose.php');
	echo '<script type="text/javascript">alert("Échec d\'interrogation de la base de données");</script>';
	include('login.html');
	die();
}

echo '<html><head><link rel="stylesheet" type="text/css" href="sportsQlub.css"></link>' . 
'<title>Administration | Club Sportif</title></head><body>'; 

include('navbar.php');
 
echo "<h1>Liste des terrains r&eacute;serv&eacute;s pour la journ&eacute;e</h1>";
if(mysqli_num_rows($res)==0) {
	echo "<p>Aucun terrain réservé</p>";
} else {
	$terrain = 0;
	while($row = mysqli_fetch_assoc($res)) {
		if($row['numero'] != $terrain) {
			if($terrain != 0) {
				echo "</ul>";
			}
			$terrain = $row['numero'];
			echo "<h2>Terrain #".$row['numero']."</h2><ul>";
		}
		echo "<li> réserv&eacute; &agrave; ".$row['time']." par ".$row['prenom']." ".$row['nom']." (".$row['login'].")</li>";
	}
	echo "</ul>";
}

mysqli_free_result($res);

// Close connection
include('dbClose.php');
	
echo '</body></html>';

?>
