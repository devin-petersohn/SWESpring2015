<?php
require 'functions.php';

$conn = db_connect();
if($conn) {
    $action = $_POST['choice'];
    //Action is to DELETE a comment
    switch($action) {
        //Viewing the comments for a SPECIFIC user
        case "view":
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
            break;
        //Adding a comment, grab the needed vars and insert them into the table    
        case "add":
            $sso = $_POST['sso'];
            $course_id = $_POST['course_id'];
            $dates_taught = $_POST['dates-taught'];
            $instructor_sso = $_POST['instructor_sso'];
            
            $qry = 'INSERT INTO applicant_comments (sso, course_id, dates_taught, instructor_sso, comment)
            VALUES ('.$sso.','. $course_id.','. $dates_taught.','. $instructor_sso.','. $comment.')
           ';
            pg_prepare($conn, "add_comment", $qry);
            if(pg_execute($conn, "add_comment", array())) {
                echo "Comment added.\n";
                echo"<br> Return to <a href = 'index.php'>comment page</a>\n";
            }
            else {
                echo "Delete Failed <br />";
                echo"<br> Return to <a href = 'index.php'>comment page</a>\n";
            }
            break;
        case "delete":
            $rm_cid = $_POST('comment_id');
            $qry = 'DELETE FROM applicant_comments
                    WHERE (comment_id = \''.$rm_cid.'\');';
            pg_prepare($conn,"delete",$qry);
            if(pg_execute($conn,"delete",array())) {
                echo "Comment deleted.\n";
                echo"<br> Return to <a href = 'index.php'>comment page</a>\n";
            }
            else {
                echo "Delete Failed <br />";
                echo"<br> Return to <a href = 'index.php'>comment page</a>\n";
            }
            break;
        
    }
    /*
    if($action == 'delete') {
        $rm_cid = $_GET('comment_id');
        
        $qry = 'DELETE FROM applicant_comments
                WHERE (comment_id = \''.$rm_cid.'\');';
        
        pg_prepare($conn,"delete",$qry);
        if(pg_execute($conn,"delete",array())) {
            echo "Comment deleted.\n";
            echo"<br> Return to <a href = 'index.php'>comment page</a>\n";
        }
        else {
            echo "Delete Failed <br />";
            echo"<br> Return to <a href = 'index.php'>comment page</a>\n";
        }
        
        
    }
    //Action is to ADD a comment
    else if ($action == 'add') {
        $sso = $_GET['sso'];
        $course_id = $_GET['course_id'];
        $dates_taught = $_GET['dates-taught'];
        $instructor_sso = $_GET['instructor_sso'];
        
        $qry = 'INSERT INTO applicant_comments (sso, course_id, dates_taught, instructor_sso, comment)
            VALUES ('.$sso.','. $course_id.','. $dates_taught.','. $instructor_sso.','. $comment.')
           ';
        pg_prepare($conn, "add_comment", $qry);
        if(pg_execute($conn, "add_comment", array())) {
            echo "Comment added.\n";
            echo"<br> Return to <a href = 'index.php'>comment page</a>\n";
        }
        else {
            echo "Delete Failed <br />";
            echo"<br> Return to <a href = 'index.php'>comment page</a>\n";
        }      
    
    }
    //Action is to VIEW comments
    else if ($action == 'view') {
        
    }
    //Action is unspecified, throw an error
    else {
        echo "error. \n \n";
    }
    */
}
?>