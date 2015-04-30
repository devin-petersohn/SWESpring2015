<?php

include "functions.php";


//addRank($dbconn, $_POST['sso'], $_POST['rank']);

function addRank($sso, $rank) {
    $dbconn = db_connect();
    pg_prepare($dbconn, "rank", "UPDATE applicant SET ranking = $1 WHERE sso = '$sso'");
    pg_execute($dbconn, "rank", array(htmlspecialchars($rank)));
}

//this might not be the url
//header('Location: swespring2015-grouph.rhcloud.com/swespring2015/admin');


?>
