<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php 

$username = $_POST['username'];
$mdp = $_POST['mdp'];
$name = $_POST['name'];
$firstname = $_POST['firstname'];

// Connect to db
include ('dbConnect.php');

// Check if login exist in database 
$res = mysqli_query($connect, "SELECT * FROM usagers WHERE login='$username';");
if(!$res) {
    include('dbClose.php');
    echo '<script type="text/javascript">alert("Échec de l\'interrogation de la base de données");</script>';
    include('login.html');
    die();
}
elseif(mysqli_num_rows($res) != 0) {
    //user already signed up
    mysqli_free_result($res);
    include('dbClose.php');
    echo '<script type="text/javascript">alert("Usager déjà existant");</script>';
    include('login.html');
    die();
}
mysqli_free_result($res);

// Insert in database
$res = mysqli_query($connect, "INSERT INTO usagers VALUES ('$username', '$name', '$firstname', '$mdp');");
if(!$res) {
    include('dbClose.php');
    echo '<script type="text/javascript">alert("Échec de l\'inscription");</script>';
    include('login.html');
    die();
}

echo "<html><head><title>Inscription | Club Sportif</title></head><body>";
echo "<h1>Inscription compl&eacute;t&eacute;e</h1>";
echo "<p>Usager $username inscrit avec succ&egrave;s</p>";
echo "<a href=login.html>Retour &agrave; la page d'accueil</a>";
echo "</body></html>";
    
// Close connection
mysqli_close($connect);

?>
