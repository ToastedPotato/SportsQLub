<html>
<head>
    <title>Club Sportif</title>
</head>
<body>
<?php 
// Connect to db
include ('dbConnect.php');

// Handle request
if(isset($_POST['players'])) {
	// Affichage des joueurs inscrits
    $res = mysqli_query($connect, "SELECT * FROM usagers;");
    if(!$res) {
		include('dbClose.php');
		echo '<script type="text/javascript">alert("Échec d\'interrogation de la base de données");</script>';
		include('login.html');
		die();
    }
    echo "<h1>Liste des joueurs inscrits</h1>";
	if(mysqli_num_rows($res)==0) {
		echo "<p>Aucun joueur inscrit</p>";
	} else {
		echo "<ul>";
		while($row = mysqli_fetch_assoc($res)) {
			echo "<li>".$row['prenom']." ".$row['nom']." (".$row['login'].")</li>";
		}
		echo "</ul>";
	}
} elseif (isset($_POST['booked'])) {
	// Affichage des terrains reserves
    $res = mysqli_query($connect, "SELECT reservations.numero, reservations.login, TIME(reservations.date) as time, usagers.nom, usagers.prenom FROM reservations INNER JOIN usagers ON reservations.login = usagers.login  WHERE DATE(date)=CURRENT_DATE ORDER BY numero, date;");
    if(!$res) {
		include('dbClose.php');
		echo '<script type="text/javascript">alert("Échec d\'interrogation de la base de données");</script>';
		include('login.html');
		die();
    } 
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
} elseif (isset($_POST['available'])) {
	// Affichage des terrains disponibles
	$starttime = $_POST['start'];
	$endtime = $_POST['end'];
	if(!isset($starttime) || !isset($endtime)) {
		include('dbClose.php');
		echo '<script type="text/javascript">alert("Formulaire incomplet");</script>';
		include('login.html');
		die();
	}
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
}
mysqli_free_result($res);

// Close connection
include('dbClose.php');

?>
</body>
</html>