<?php

include 'functions.php';

function deleteInstructor($sso){
	$db = db_connect();
	pg_prepare($db, "q5", "DELETE FROM Faculty WHERE sso = $1");
	pg_execute($db, "q5", array($sso));
}

?>