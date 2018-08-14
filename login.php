<?php

session_start();
$username = $_POST['username'];
$mdp = $_POST['mdp'];

if(!$username || !$mdp) {
    echo '<script type="text/javascript">alert("Formulaire incomplet");</script>';
    include('login.html');
    die();
}

// Connect to db
include ('dbConnect.php');

// Validate login 
$res = mysqli_query($connect, "SELECT * FROM usagers WHERE login='$username';");
if(!$res) {
    include('dbClose.php');
    echo '<script type="text/javascript">alert("Échec d\'interrogation de la base de données");</script>';
    include('login.html');
    die();
}
elseif(mysqli_num_rows($res) == 0) {
    include('dbClose.php');
    echo '<script type="text/javascript">alert("Usager inexistant");</script>';
    include('login.html');
    die();
}

$user = mysqli_fetch_assoc($res);
if ($user['motdepasse'] != $mdp) {
    include('dbClose.php');
    echo '<script type="text/javascript">alert("Mot de passe incorrect");</script>';
    include('login.html');
    die();
}

$_SESSION['username'] = $username;
$_SESSION['last_name'] = $user['nom'];
$_SESSION['first_name'] = $user['prenom'];
$_SESSION['is_admin'] = false;

mysqli_free_result($res);

// Check if admin
$res = mysqli_query($connect, "SELECT login FROM admin WHERE login='$username';");
if(!$res) {
    include('dbClose.php');
    echo '<script type="text/javascript">alert("Échec d\'interrogation de la base de données");</script>';
    include('login.html');
    die();
}
elseif(mysqli_num_rows($res) > 0) {
    $_SESSION['is_admin'] = true;
}

mysqli_free_result($res);

header("Location: fieldInfo.php");

// TODO Display forms

// Close connection
include('dbClose.php');

function displayAdminModule() {
    echo '<form method="post" action="admin.php">';
    echo '<fieldset><legend>Module administratif</legend>';
    echo '<p><input type="submit" name="players" value="Afficher la liste des joueurs"/></p>';
    echo '<p><input type="submit" name="booked" value="Afficher les terrains r&eacute;serv&eacute;s pour la journ&eacute;e"/></p>';
    echo '<p>Afficher les terrains disponibles entre <input type="number" name="start" min="6" max="21"> heure et <input type="number" name="end" min="6" max="21"> heure pour la journée ';
	echo '<input type="submit" name="available" value="Envoyer"/>';
	echo ' (Veuillez entrer un invervalle d\'heures entre 6 et 21 heure.)</p>';
    echo '</fieldset></form>';
}

?>
