<?php

echo '<div class="navigation">';

if($_SESSION['is_admin']){
    echo '<a href="adminPlayers.php">Liste des Membres</a>' . 
        '<a href="adminBooked.php">Terrains Réservés</a>' . 
        '<a href="adminAvailable.php">Terrains Libres</a>';
}
echo '<a href="fieldInfo.php">Horaire</a><a href="reservation.php">Réserver</a><a href="history.php">Liste des Réservations</a><a href="logout.php">Déconnexion</a>';
echo '</div>';
?>