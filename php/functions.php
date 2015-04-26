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



function addRank($dbconn, $applicant, $rank)
{
    pg_prepare($dbconn, "addition", "UPDATE applicant SET ranking = $1 WHERE sso LIKE $applicant");
    pg_execute($dbconn, "addition", array(htmlspecialchars($rank)));
}

function offerPosition($dbconn, $applicant, $course, $section)
{
    pg_prepare($dbconn, "position", "INSERT INTO applicant_offer_received VALUES($1, $2, $3, FALSE, FALSE)");
    pg_execute($dbconn, "position", array($applicant, $course, $section));
}

function updateOfferStatus($dbconn, $applicant, $course, $section)
{
    pg_prepare($dbconn, "position", "UPDATE applicant_offer_received SET offer_accepted = TRUE WHERE sso LIKE $1"
                . " AND course_id LIKE $2 AND section LIKE $3");
    pg_execute($dbconn, "position", array($applicant, $course, $section));
}

function confirmOfferStatus($dbconn, $applicant, $course, $section)
{
    pg_prepare($dbconn, "position", "UPDATE applicant_offer_received SET assigned_to_course = TRUE WHERE sso LIKE $1"
        . " AND course_id LIKE $2 AND section LIKE $3");
        pg_execute($dbconn, "position", array($applicant, $course, $section));
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

//During the application process, use a session var to track page #, then use a switch for the various number to control the insert / update
//use an onpageload() to grab the pages info if it is there


//Queries needed: search, add/delete/view comment, delete faculty, insert/delete course, select student who received offer, update student offer
// Insert student offer, 

//Page 1: ugrad/grad, fname, lname, gpa || Grab pawprint from session var
//Page 2: Student ID, BS/BA, IT/CS, Jr/Sr
//Page 3:  
//Page 4: 
//Page 5: 
//Page 6: 
//Page 7: 
//Page 8: 
//Page 9: 





?>