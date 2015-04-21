<?php
/*  I will get these filled in asap */

/*This function will establish a connection to the DB and return that connection */
function db_connect() {
    $connectionString = "user=admin1xtduwt password=zVd4BSi4JdIJ host=127.13.165.130 dbname=ta_application";
    $DBconn = pg_connect($connectionString);
    if (!$DBconn) {
        echo "Error.\n" . pg_last_error() . "\n";
        die; // kill the app if no connection
    }
    return $DBconn;
}

/*This function will take in what we want to search for ($find), what type of search ($type) it is (pawprint or ???) and the connection to the DB */
function db_search($find, $type, $DBconn) {
    switch ($type) { /*The type will be expanded based on what our search parameters are based on */
        case '1':
            $query = "
			SELECT 
			FROM 
			WHERE name = ''
			";
            
            break;
        case '2':
            $query = "
			SELECT
			FROM
			WHERE name = ''
			";
            
            break;
    }
   return $result = query_table($DBconn,$query); // call our query function
    
    
}

/*This function will allow a comment to be added to an applicant. Takes in the pawprint, the comment, and the connection */
function add_comment($paw,$comment,$DBconn) {
    
}

/*This function will delete a comment from an applicant.  Takes in the pawprint and DB connection */
function delete_comment($paw, $DBconn) {
    
}

/*This function queries a table based on the query ($q) that is provided and uses the current connection */
function query_table($DBconn,$q) {
    $result = pg_query($DBconn,$q);  //format the query
    return $result;
      
}

/*End of list for now */


?>