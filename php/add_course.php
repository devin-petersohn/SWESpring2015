<?php
require 'functions.php';

//grab variables/ input from user
$cid = $_POST['cid'];
$inst_sso = $_POST['insutructor_sso'];
$slots_open = $_POST['slots'];
//not sure what else needs to be grabbed

$conn = db_connect();
if($conn){
    $qry = null;
    pg_prepare($conn,"add_course",$qry);
    if(pg_execute($conn,"add_course",array())) {
        echo "success";
    }
    else {
        echo "fail";
    }
}
?>