<?php
require 'functions.php';
$conn = db_connect();

if($conn) {
    $sso = $_POST['pawprint'];
    $qry = 'SELECT comment, instructor_sso
              FROM applicant_comments
              WHERE (sso = '.$sso.')
             ';
    $result = pg_prepare($conn, "comment_search", $qry);
    $result = pg_execute($conn, "comment_search", array());
    //fields for printing:  Author, comment, Date, course || DB values:  instructor_sso, comment
    if($result) {
       while($row =  pg_fetch_array($result, null, PGSQL_ASSOC)) {
           echo $row['instructor_sso'] . $row['comment']; 
       }
    }
}



?>