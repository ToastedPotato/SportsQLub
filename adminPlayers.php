<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php

session_start(); 
// Connect to db
include ('dbConnect.php');

include('checkCredentials.php');

//Detailled member info
$res = mysqli_query($connect, "SELECT * FROM usagers;");
if(!$res) {
	include('dbClose.php');
	echo '<script type="text/javascript">alert("Échec d\'interrogation de la base de données");</script>';
	include('login.html');
	die();
}

echo '<html><head><link rel="stylesheet" type="text/css" href="sportsQlub.css"></link>' . 
    '<title>Administration | Club Sportif</title></head><body>'; 

include('navbar.php');

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

mysqli_free_result($res);

// Close connection
include('dbClose.php');

?>
