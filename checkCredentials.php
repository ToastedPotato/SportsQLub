<?php

//si quelqu'un tente d'accéder aux foncitons du site sans s'authentifier
if(!isset($_SESSION['username']) || !isset($_SESSION['last_name']) || 
    !isset($_SESSION['first_name'])){
    
    header("Location: login.html");    
}

?>
