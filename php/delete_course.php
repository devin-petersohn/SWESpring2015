<?php
require'functions.php';

//get the connection
$conn = db_connect();
if($conn){
    $cid = $_POST['course_id'];
    $qry = 'DELETE';
    pg_prepare($conn,"add_course",$qry);
    if(pg_execute($conn,"add_course",array())) {
        echo "success";
    }
    else {
        echo "fail";
    }
    
}

?>