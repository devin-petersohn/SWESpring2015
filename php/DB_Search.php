<?php
function search($dbconn, $string, $type)
{
    $returnResults = array();

    if(strcmp($type, "pawprint") == 0)
    {
        $test = strtok($string, " \n");
        if(strcmp($test, $string) != 0)
        {
            return NULL;
        }
        else
        {
            pg_prepare($dbconn, "pawprint", "SELECT * FROM applicant WHERE sso ILIKE $1") or die(header("Location:Error"));
            $SR = pg_execute($dbconn, "pawprint", array($test)) or die(header("Location:Error"));
            $line = pg_fetch_array($SR, null, PGSQL_ASSOC);
            
            $returnResults[0] = $line;
            $returnResults[0] = json_encode($returnResults[0]);

        }
    }
    else
    {
        $test = strtok($string, " ,\n");
        if(strcmp($test, $string) == 0)
        {
            pg_prepare($dbconn, "fname", "SELECT * FROM applicant WHERE fname ILIKE $1") or die(header("Location:Error"));
            $SR = pg_execute($dbconn, "fname", array($test)) or die(header("Location:Error"));
            $i = 0;
            while($line = pg_fetch_array($SR, null, PGSQL_ASSOC))
            {
                $returnResults[$i] = $line;
                $returnResults[$i] = json_encode($returnResults[$i]);
                $i++;
            }
            pg_prepare($dbconn, "lname", "SELECT * FROM applicant WHERE lname ILIKE $1") or die(header("Location:Error"));
            $SR = pg_execute($dbconn, "lname", array($test)) or die(header("Location:Error"));
            $i = 0;
            while($line = pg_fetch_array($SR, null, PGSQL_ASSOC))
            {
                $returnResults[$i++] = $line;
                $returnResults[$i] = json_encode($returnResults[$i]);
                $i++;
            }
        }
        else
        {
            $second = strtok(" \n");
            $third = strtok(" ");
            if($third != false)
            {
                return NULL;
            }
            else
            {
                pg_prepare($dbconn, "fname", "SELECT * FROM applicant WHERE fname ILIKE $1 AND lname ILIKE $2") or die(header("Location:Error"));
                $SR = pg_execute($dbconn, "fname", array($test, $second)) or die(header("Location:Error"));
                $i = 0;
                while($line = pg_fetch_array($SR, null, PGSQL_ASSOC))
                {
                    $returnResults[$i] = $line;
                    $returnResults[$i] = json_encode($returnResults[$i]);
                    $i++;
                }
                pg_prepare($dbconn, "lname", "SELECT * FROM applicant WHERE lname ILIKE $1 AND fname ILIKE $2") or die(header("Location:Error"));
                $SR = pg_execute($dbconn, "lname", array($test, $second)) or die(header("Location:Error"));
                $i = 0;
                while($line = pg_fetch_array($SR, null, PGSQL_ASSOC))
                {
                    $returnResults[$i] = $line;
                    $returnResults[$i] = json_encode($returnResults[$i]);
                    $i++;
                }
            }
        }
    }
    return $returnResults;
}




?>
