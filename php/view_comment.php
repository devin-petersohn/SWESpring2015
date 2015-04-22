<?php
require 'functions.php';
$conn = db_connect();

if($conn) {
    $sso = $_POST['pawprint'];
    $query = 'SELECT comment, instructor_sso
              FROM applicant_comments
              WHERE (sso = '.$sso.')
             ';
    $result = pg_prepare($DBconn, "comment_search", $query);
    $result = pg_execute($DBconn, "comment_search", array());
    //fields for printing:  Author, comment, Date, course || DB values:  instructor_sso, comment
    if($result) {
       while($row =  pg_fetch_array($result, null, PGSQL_ASSOC)) {
           echo $row['instructor_sso'] . $row['comment']; 
       }
    }
}



?>