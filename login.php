<?php 

$username = $_POST['username'];
$mdp = $_POST['mdp'];

if(!$username || !$mdp) {
    displayErrorPage("Formulaire incomplet");
}

// Connect to db
include ('dbConnect.php');

// Validate login 
$res = mysqli_query($connect, "SELECT * FROM usagers WHERE login='$username';");
if(!$res) {
    displayErrorPage("Echec d'interrogation de la base de données");
}
elseif(mysqli_num_rows($res) == 0) {
    displayErrorPage("Usager non-existant");
}

$user = mysqli_fetch_assoc($res);
if ($user['motdepasse'] != $mdp) {
    displayErrorPage("Mauvais mot de passe");
}
mysqli_free_result($res);

$nom = $user['nom'];
$prenom = $user['prenom'];
echo "<h1>Bienvenue $prenom $nom</h1>";

// Check if admin
$res = mysqli_query($connect, "SELECT login FROM admin WHERE login='$username';");
if(!$res) {
    displayErrorPage("Echec de query a la database");
}
elseif(mysqli_num_rows($res) > 0) {
    displayAdminModule();
}


// TODO Display forms

// Close connection
mysqli_close($connect);

function displayAdminModule() {
    echo '<form method="post" action="admin.php">';
    echo '<fieldset><legend>Module administratif</legend>';
    echo '<p><input type="submit" name="players" value="Afficher la liste des joueurs"/></p>';
    echo '<p><input type="submit" name="booked" value="Afficher les terrains r&eacute;serv&eacute;s pour la journ&eacute;e"/></p>';
    echo '<p><input type="submit" name="available" value="Afficher les terrains disponibles"/></p>';
    echo '</fieldset></form>';
}
function displayErrorPage($message) {
    echo "<h2>Erreur de connexion</h2>";
    echo "<p>$message</p>";
    echo "</body></html>";
    if(isset($connect)){
        mysqli_close($connect);
    }
    die();
}
?>
