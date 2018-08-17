<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php

$booking_query = "SELECT * FROM reservations WHERE date BETWEEN '$day 06:00:00' AND '$day 21:00:00' ORDER BY date, numero;";

$table_head = '<table><tbody><tr><th></th><th id="f1">Terrain 1</th>' . 
    '<th id="f2">Terrain 2</th><th id="f3">Terrain 3</th>' . 
    '<th id="f4">Terrain 4</th><th id="f5">Terrain 5</th></tr>';

$table_rows = "";

$empty_rows = "<tr><th>6:00-6:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>7:00-7:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>8:00-8:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>9:00-9:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>10:00-10:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>11:00-11:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>12:00-12:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>13:00-13:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>14:00-14:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>15:00-15:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>16:00-16:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>17:00-17:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>18:00-18:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>19:00-19:59</th><td></td><td></td><td></td><td></td><td></td></tr>" . 
    "<tr><th>20:00-20:59</th><td></td><td></td><td></td><td></td><td></td></tr>";
    
$table_tail = "</tbody></table>";


$res = mysqli_query($connect, $booking_query);

if(!$res){
    $table_rows = $empty_rows;
    echo '<script type="text/javascript">alert("Failed to retrieve booking information");</script>';
}else{
    $booking_table = mysqli_fetch_all($res, MYSQLI_BOTH);
    $length = count($booking_table);
        
    $index = 0;        
    $hour = 6;
     
    for($i = 0; $i < 15; $i++){
        $table_rows .= '<tr><th id="t' . ($i+6) . '">' . $hour . ":00-" . $hour . ":59</th>";
        
        for($j = 1; $j <= 5; $j++){
            if($length > 0){
                $current = $booking_table[$index];
                
                if($current['numero'] ==  $j && strcmp("" . $hour, date("G", strtotime($current['date']))) == 0){
                    $class = "reserved";
                    if(strcmp($current['login'], $_SESSION['username']) == 0){
                        $class = "userRes";
                    }
                    $table_rows .= "<td class=\"$hover $class\"></td>";
                    if($index < $length-1){$index++;}
                }else{
                    $table_rows .= "<td class=\"$hover\"></td>";
                }
            }else{
                $table_rows .= "<td class=\"$hover\"></td>";
            }
            
            if($j == 5){
                $table_rows .= '</tr>';
            }
        }            
        $hour++;        
    }
    mysqli_free_result($res);    
}

include('dbClose.php');

echo '<html><head></head><body>' . $table_head . $table_rows . $table_tail . '</body></html>';

?>
