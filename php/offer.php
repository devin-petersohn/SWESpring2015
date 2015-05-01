<?php

include 'functions.php';

function makeOffer($sso, $courseID){
    $db = db_connect();
    pg_prepare($db, "makeOffer", "INSERT INTO applicant_offer_received (sso, course_id, section) VALUES ($1, $2, 5)");
    pg_execute($db, "makeOffer", array($sso, $courseID));
}


?>