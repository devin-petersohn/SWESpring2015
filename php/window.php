<?php

function searchForWindow($dbconn)
{
    $SR = pg_query($dbconn, "SELECT * FROM Time_window");
    $line = pg_fetch_array($SR, null, PGSQL_ASSOC);
    while($line)
    {
        $date = date("Y-m-d");
        if(/*$line['startTime'] < $date && $line['endTime'] > $date */true)
        {
            return $line['windowname'];
        }
        $line = pg_fetch_array($SR, null, PGSQL_ASSOC);
    }
}
    


?>