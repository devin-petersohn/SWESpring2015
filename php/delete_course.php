<?php

include 'functions.php';

$db = db_connect();

pg_prepare($db, "q1", "DELETE FROM Course WHERE course_id = $1");
pg_execute($db, "q1", array($_POST['cid']));



?>