<?php
/*

//Need to include functions
require 'functions.php';
//Check if pawprint or last name, first name search

//-------------------------------------------Variables--------------------------------------------------------
//track the type of query
$qtype = $_GET['query_type'];
//Start the DB connection
$conn = db_connect();
// This will be the query for the db
$qry = null;
//query results
//Need to edit the assignment of $result in order to make the query work;
//$result = postgresql query;
$result = null;

//---------------------------------------------LOGIC----------------------------------------------------
//Ensure a connection
if($conn) {
    //Check search type
   if($qtype == 'pawprint') {
       $qry = 'pawprint123' ;
   }
   else { // force the variable in the event of an error, assume it is lname search
        $qry = 'lname, fname';       
   }    
   //Query returns: name, ta/pla?, gpa, make_offer button
    //build an array of the results
   while ($row = ($result->pg_fetch_array($result))) {
        $stu_info = $row;
        $all_stu[]= $stu_info;
   }
   //echo the array of arrays as a json object
   echo json_encode($all_stu, JSON_UNESCAPED_SLASHES);
}

*/
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
            pg_prepare($dbconn, "pawprint", "SELECT * FROM applicant WHERE sso LIKE $1");
            $SR = pg_execute($dbconn, "pawprint", array($test));
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
            pg_prepare($dbconn, "fname", "SELECT * FROM applicant WHERE fname LIKE $1");
            $SR = pg_execute($dbconn, "fname", array($test));
            $i = 0;
            while($line = pg_fetch_array($SR, null, PGSQL_ASSOC))
            {
                $returnResults[$i] = $line;
                $returnResults[$i] = json_encode($returnResults[$i]);
                $i++;
            }
            pg_prepare($dbconn, "lname", "SELECT * FROM applicant WHERE lname LIKE $1");
            $SR = pg_execute($dbconn, "lname", array($test));
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
            if($third == true)
            {
                return NULL;
            }
            else
            {
                pg_prepare($dbconn, "fname", "SELECT * FROM applicant WHERE fname LIKE $1 AND lname LIKE $2");
                $SR = pg_execute($dbconn, "fname", array($test, $second));
                $i = 0;
                while($line = pg_fetch_array($SR, null, PGSQL_ASSOC))
                {
                    $returnResults[$i] = $line;
                    $returnResults[$i] = json_encode($returnResults[$i]);
                    $i++;
                }
                pg_prepare($dbconn, "lname", "SELECT * FROM applicant WHERE lname LIKE $1 AND fname LIKE $2");
                $SR = pg_execute($dbconn, "lname", array($test, $second));
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