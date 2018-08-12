<html>
<head>
    <title>Club Sportif</title>
</head>
<body>

<?php 

$username = $_POST['username'];
$mdp = $_POST['mdp'];

if(!$username || !$mdp) {
    displayErrorPage("Formulaire incomplet");
}

// Connect to db
$connect = mysqli_connect("localhost", "root", "", "fieldRes");
if ($connect->connect_errno) {
    displayErrorPage("Failed to connect to DB: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

// Validate login 
$res = mysqli_query($connect, "SELECT * FROM usagers WHERE login='$username';");
if(!$res) {
    displayErrorPage("Echec de query a la database");
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

// TODO Display forms

// Close connection
mysqli_close($connect);

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

</body>
</html>