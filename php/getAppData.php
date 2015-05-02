

<?php

function getAppData($dbconn, $sso)
{

	$formatResults = array();

	pg_prepare($dbconn, "applicant", "SELECT * FROM applicant WHERE sso = $1");
	$SR = pg_execute($dbconn, "applicant", array($sso));
	$formatResults['appinfo'] = pg_fetch_array($SR, null, PGSQL_ASSOC);


	//international check
	pg_prepare($dbconn, "international", "SELECT * FROM applicant_is_international WHERE sso = $1");
	$SR = pg_execute($dbconn, "international", array($sso));
	$line = pg_fetch_array($SR, null, PGSQL_ASSOC);
	if($line)
	{
		$formatResults['international'] = $line;
	}
	else
	{
		$formatResults['international'] = false;
	}

	//graduate student check
	pg_prepare($dbconn, "grad", "SELECT * FROM applicant_is_a_grad WHERE sso = $1");
	$SR = pg_execute($dbconn, "grad", array($sso));
	$line = pg_fetch_array($SR, null, PGSQL_ASSOC);
	if($line)
	{
		$formatResults['grad'] = $line;
	}
	else
	{
		$formatResults['grad'] = false;
	}

	//undergrad student check
	pg_prepare($dbconn, "ugrad", "SELECT * FROM applicant_is_a_ugrad WHERE sso = $1");
	$SR = pg_execute($dbconn, "ugrad", array($sso));
	$line = pg_fetch_array($SR, null, PGSQL_ASSOC);
	if($line)
	{
		$formatResults['ugrad'] = $line;
	}
	else
	{
		$formatResults['ugrad'] = false;
	}

	pg_prepare($dbconn, "applicant", "SELECT * FROM applicant WHERE sso = $1");
	$SR = pg_execute($dbconn, "applicant", array($sso));
	$formatResults['appinfo'] = pg_fetch_array($SR, null, PGSQL_ASSOC);


	//currently taught courses
	pg_prepare($dbconn, "curr", "SELECT * FROM applicant_curr_taught_courses WHERE sso = $1");
	$SR = pg_execute($dbconn, "curr", array($sso));

	$i = 0;
	while($line = pg_fetch_array($SR, null, PGSQL_ASSOC))
	{
		$formatResults['curr'][$i] = $line['course'];
		$i++;
	}

	//other worksplaces
	pg_prepare($dbconn, "other", "SELECT * FROM applicant_other_workplaces WHERE sso = $1");
	$SR = pg_execute($dbconn, "other", array($sso));

	$i = 0;
	while($line = pg_fetch_array($SR, null, PGSQL_ASSOC))
	{
		$formatResults['other'][$i] = $line['course'];
		$i++;
	}

	//prev taught courses
	pg_prepare($dbconn, "prev", "SELECT * FROM applicant_prev_taught_courses WHERE sso = $1");
	$SR = pg_execute($dbconn, "prev", array($sso));

	$i = 0;
	while($line = pg_fetch_array($SR, null, PGSQL_ASSOC))
	{
		$formatResults['prev'][$i] = $line['course'];
		$i++;
	}


	//wished courses
	pg_prepare($dbconn, "wish", "SELECT * FROM applicant_wish_courses WHERE sso = $1");
	$SR = pg_execute($dbconn, "wish", array($sso));

	$i = 0;
	while($line = pg_fetch_array($SR, null, PGSQL_ASSOC))
	{
		$formatResults['wish'][$i] = $line['course'];
		$i++;
	}


	return $formatResults;
}
	?>
