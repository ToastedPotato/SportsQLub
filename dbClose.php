<?php if (isset($_GET['source'])) die(highlight_file(__FILE__, 1)); ?>
<?php

if(isset($connect)){
    mysqli_close($connect);
}

?>
