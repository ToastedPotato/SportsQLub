<?php

session_start();

include('dbConnect.php');

$day = date("Y-m-d", mktime(0, 0, 0, date("m")  , date("d")+1, date("Y")));

$hover = "interact";

$booked_hour = isset($_POST['time']) ? $_POST['time'] : NULL;
$booked_field = isset($_POST['field']) ? $_POST['field'] : NULL;
$username = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

if(!is_null($booked_hour) && !is_null($booked_field)){
    //update reservation        
    if($booked_hour != 0 && $booked_field != 0){
        $res = mysqli_query($connect, "SELECT * FROM reservations WHERE login = '$username' AND date BETWEEN '$day 06:00:00' AND '$day 21:00:00' FOR UPDATE;");
        
        if($res){
            if(mysqli_num_rows($res) != 0){
                //if reservation exists -> update
                $res = mysqli_query($connect, "UPDATE reservations SET numero = $booked_field, date = '$day $booked_hour:00:00' WHERE login = '$username' AND date BETWEEN '$day 06:00:00' and '$day 21:00:00';");
            }else{
                //no existing reservation -> add new one, check success
                $res = mysqli_query($connect, "INSERT INTO reservations VALUES ('$username', '$booked_field', '$day $booked_hour:00:00');");
                if(!$res){
                    echo '<script type="text/javascript">alert("Échec de mise à jour de la réservation");</script>';               
                }
            }
        }else{
            echo '<script type="text/javascript">alert("Échec de mise à jour de la réservation");</script>';
        }
    }else if($booked_hour == 0 && $booked_field == 0){
        //if cancelling reservation
        $res = mysqli_query($connect, "DELETE FROM reservations WHERE login = '$username' AND date BETWEEN '$day 06:00:00' AND '$day 21:00:00';");
        if(!$res){
            echo '<script type="text/javascript">alert("Échec de l\'annulation de la réservation");</script>';               
        }
    }   
    mysqli_free_result($res);
}

echo '<html><head><link rel="stylesheet" type="text/css" href="sportsQlub.css"></link>' . 
    '<script type="text/javascript" src="jquery.js"></script>' . 
    '<script type="text/javascript" src="sportsQlub.js"></script>' . 
    '<title>Réservations | Club Sportif</title></head><body>'; 

echo "<h1>Disponibilité des terrains en date du $day</h1>";

include('fieldBooking.php');

echo '<form method="post" action="reservation.php">' . 
     '<input id="t" class="invisible" type="text" name="time"/>' . 
     '<input id="f" class="invisible" type="text" name="field"/>' . 
     '<input type="submit" value="Confirmer"/></form>';

echo '</body></html>';

?>
