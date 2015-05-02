<?php

function searchForWindow($dbconn)
{
    $SR = pg_query($dbconn, "SELECT * FROM time_window");
    $line = pg_fetch_array($SR, null, PGSQL_ASSOC);
    while($line)
    {
        if(time() - strtotime($line['starttime']) > 0 && time() - strtotime($line['endtime']) < 0)
        {
            return $line['windowname'];
        }
        $line = pg_fetch_array($SR, null, PGSQL_ASSOC);
    }
    return NULL;
}
    


?>