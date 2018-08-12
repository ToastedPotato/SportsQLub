<html>
<head>
    <title>Club Sportif</title>
</head>
<body>
<?php 

$username = $_POST['username'];
$mdp = $_POST['mdp'];
$name = $_POST['name'];
$firstname = $_POST['firstname'];

if(!$username || !$mdp || !$name || !$firstname) {
    displayErrorPage("Formulaire incomplet");
}

// Connect to db
$connect = mysqli_connect("localhost", "root", "", "fieldRes");
if ($connect->connect_errno) {
    displayErrorPage("Failed to connect to DB: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

// Check if login exist in database 
$res = mysqli_query($connect, "SELECT * FROM usagers WHERE login='$username';");
if(!$res) {
    displayErrorPage("Echec de query a la database");
}
elseif(mysqli_num_rows($res) != 0) {
    displayErrorPage("Usager d&eacute;j&agrave;  existant");
}
mysqli_free_result($res);

// Insert in database
$res = mysqli_query($connect, "INSERT INTO usagers VALUES ('$username', '$name', '$firstname', '$mdp');");
if(!$res) {
    displayErrorPage("Echec de la requete");
}

echo "<h1>Inscription compl&eacute;t&eacute;e</h1>";
echo "<p>Usager $username inscrit avec succ&egrave;s</p>";
echo "<a href=login.html>Retour &agrave; la page d'accueil</a>";
echo "</body></html>";
    
// Close connection
mysqli_close($connect);

function displayErrorPage($message) {
    echo "<h2>Erreur d'inscription</h2>";
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