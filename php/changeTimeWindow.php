<?php
include 'functions.php';

$db = db_connect();

function get_timeWindow() {
    $db = db_connect();
    $course = pg_query($db, "SELECT windowframe FROM time_window;") or die(header("Location:Error"));
    echo "<select name='selectWindow' id='selection' value='selection' >";
    echo"<value='ERROR' disabled='disabled' seclected='selected'> Please select the timeframe to change</option>";
    while ($printedWindow = pg_fetch_row($windowframe)) {
        echo "<option value = '".$printedWindow[0]."'>".$printedWindow[0]."</option>";
    }
    echo "<\select>";
}







?>