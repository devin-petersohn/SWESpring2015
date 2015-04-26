<?php

include "functions.php";
$dbconn = db_connect();

addRank($dbconn, $_POST['sso'], $_POST['rank']);

function addRank($dbconn, $sso, $rank)
{
    pg_prepare($dbconn, "addition", "UPDATE applicant SET ranking = $1 WHERE sso LIKE $applicant");
    pg_execute($dbconn, "addition", array(htmlspecialchars($rank)));
}

//this might not be the url
header('Location: swespring2015-grouph.rhcloud.com/swespring2015/admin');


?>