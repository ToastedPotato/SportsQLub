<html>
<head>
    <title>Club Sportif</title>
</head>
<body>
<?php 
// Connect to db
$connect = mysqli_connect("localhost", "root", "", "fieldRes");
if ($connect->connect_errno) {
    displayErrorPage("Failed to connect to DB: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

// Handle request
if(isset($_POST['players'])) {
    $res = mysqli_query($connect, "SELECT * FROM usagers;");
    if(!$res) {
        displayErrorPage("Echec de query a la database");
    }
    echo "<h1>Liste des joueurs inscrits</h1>";
    echo "<ul>";
    while($row = mysqli_fetch_assoc($res)) {
        echo "<li>".$row['prenom']." ".$row['nom']." (".$row['login'].")</li>";
    }
    echo "</ul>";
} elseif (isset($_POST['booked'])) {
    $res = mysqli_query($connect, "SELECT * FROM reservations INNER JOIN usagers ON reservations.login = usagers.login  WHERE DATE(date)=CURRENT_DATE;");
    if(!$res) {
        displayErrorPage("Echec de query a la database");
    } 
    echo "<h1>Liste des terrains r&eacute;serv&eacute;s pour la journ&eacute;e</h1>";
    echo "<ul>";
    while($row = mysqli_fetch_assoc($res)) {
        echo "<li>Terrain #".$row['numero']." r&eacute;serv&eacute; &agrave; ".$row['date']." par ".$row['prenom']." ".$row['nom']." (".$row['login'].")</li>";
    }
    echo "<ul>";
} elseif (isset($_POST['available'])) {
    //TODO
}
mysqli_free_result($res);

// Close connection
mysqli_close($connect);

function displayErrorPage($message) {
    echo "<h2>Erreur</h2>";
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