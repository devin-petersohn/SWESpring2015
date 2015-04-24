<?php

function searchForWindow($dbconn)
{
    $SR = pg_query($dbconn, "SELECT * FROM Time_window");
    $line = pg_fetch_array($SR, null, PGSQL_ASSOC);
    while($line)
    {
        if(time() - strtotime($line['startTime']) > 0 && time() - strtotime($line['endTime']) < 0)
        {
            return $line['windowname'];
        }
        $line = pg_fetch_array($SR, null, PGSQL_ASSOC);
    }
}
    


?>