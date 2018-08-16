<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php

echo '<div class="navigation">';

if($_SESSION['is_admin']){
    echo '<div class="admin' . $administration . '"><p id="adminTag">Administration</p><div id="adminMenu"><a href="adminPlayers.php">Liste des Membres</a>' . 
        '<a href="adminBooked.php">Terrains Réservés</a>' . 
        '<a href="adminAvailable.php">Terrains Libres</a></div></div>';
}
echo "<a $schedule" . ' href="fieldInfo.php">Horaire des Terrains</a><a ' . 
    $book . ' href="reservation.php">Réserver</a><a ' . $history . 
    ' href="history.php">Liste des Réservations</a>' . 
    '<a id="logout" href="logout.php">Déconnexion</a>';
    
echo '</div>';
?>
