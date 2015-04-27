<?php

include 'functions.php';

$db = db_connect();

pg_prepare($db, "q1", "DELETE FROM Instructor WHERE sso = $1");
pg_execute($db, "q1", array($_POST['instructor_sso']));

?>