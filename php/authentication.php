<?php
//TODO: figure out conflicts with returning the array as is

//The following is for testing purposes.
//insertion($dbconn);

/*
//manually inserted the tuple [username = asdf, password = password_hash(asdf, bcrypt, testSalt), salt = testSalt]
//This call is used to verify that the user 'asdf' can login.
$result = authenticate("asdf", "asdf", $dbconn);
//TODO: check with other files for db connection?

//test the array that comes from authenticate()
print_r($result);
*/
//This function inserts random tuples into the database. For testing purposes only.
function insertion($dbconn)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	$randomUser = '';
	$salt = '';

	$add0 = pg_prepare($dbconn, "0", "INSERT INTO mailmissouriedu VALUES ($1, $2, $3)") or die(pg_last_error());
	$add1 = pg_prepare($dbconn, "1", "INSERT INTO missouriedu VALUES ($1, $2, $3)") or die(pg_last_error());
	$add2 = pg_prepare($dbconn, "2", "INSERT INTO mizzouedu VALUES ($1, $2, $3)") or die(pg_last_error());
	$add3 = pg_prepare($dbconn, "3", "INSERT INTO umkcedu VALUES ($1, $2, $3)") or die(pg_last_error());
	$add4 = pg_prepare($dbconn, "4", "INSERT INTO mailumkcedu VALUES ($1, $2, $3)") or die(pg_last_error());

	for($j = 0; $j < 5; $j++)
	{
		$randomUser = '';
		$randomString = '';
		for ($i = 0; $i < 20; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
			$salt .= $characters[rand(0, $charactersLength - 1)];
		}

		for($k = 0; $k < 8; $k++)
		{
			$randomUser .= $characters[rand(0, $charactersLength - 1)];
		}
		$salt = password_hash($salt, PASSWORD_BCRYPT);
		$pw = password_hash($randomString, PASSWORD_BCRYPT, ["salt" => $salt]);
		$add = pg_execute($dbconn, $j, array($randomUser, $pw, $salt));
	}
}

function authenticate($username, $password, $dbconn)
{ 

	//all calls to the tables. Will be collapsed. 
	$auth0 = pg_prepare($dbconn, "5", "SELECT * FROM mailumkcedu WHERE username = $1") or die(pg_last_error());
	$auth1 = pg_prepare($dbconn, "6", "SELECT * FROM missouriedu WHERE username = $1") or die(pg_last_error());
	$auth2 = pg_prepare($dbconn, "7", "SELECT * FROM mizzouedu WHERE username = $1") or die(pg_last_error());
	$auth3 = pg_prepare($dbconn, "8", "SELECT * FROM umkcedu WHERE username = $1") or die(pg_last_error());
	$auth4 = pg_prepare($dbconn, "9", "SELECT * FROM mailmissouriedu WHERE username = $1") or die(pg_last_error());

	//TODO: implement this
	//
	//To double check later and ensure validity of above queries. 
	//$verify0 = pg_prepare($dbconn, "domain0", "SELECT * FROM tig WHERE username = $1") or die(pg_last_error());
	//$verify0 = pg_prepare($dbconn, "domain1", "SELECT * FROM col WHERE username = $1") or die(pg_last_error());

	$res0 = pg_execute($dbconn, "5", array(htmlspecialchars($username))) or die(pg_last_error());
	$res1 = pg_execute($dbconn, "6", array(htmlspecialchars($username))) or die(pg_last_error());
	$res2 = pg_execute($dbconn, "7", array(htmlspecialchars($username))) or die(pg_last_error());
	$res3 = pg_execute($dbconn, "8", array(htmlspecialchars($username))) or die(pg_last_error());
	$res4 = pg_execute($dbconn, "9", array(htmlspecialchars($username))) or die(pg_last_error());

	//variables to store values
	//the domains variable is for looping purposes
	$domains = array("mailumkcedu", "missouriedu", "mizzouedu", "umkcedu", "mailmissouriedu");
	$results = array();
	$success = array();


	//TODO: loop this
	//
	//Checks all domains for a result returned from the query.
	$line = pg_fetch_array($res0, null, PGSQL_ASSOC);
	$i = 0;
	if($line)
	{
		$results[$i]['domain'] = $domains[$i];
		$results[$i]['password'] = $line['password'];
		$success[$i] = true;
	}
	else
	{
		$success[$i] = false;
	}
	$i++;
	$line = pg_fetch_array($res1, null, PGSQL_ASSOC);
	if($line)
	{
		$results[$i]['domain'] = $domains[$i];
		$results[$i]['password'] = $line['password'];
		$success[$i] = true;
	}
	else
	{
		$success[$i] = false;
	}

	$i++;
	$line = pg_fetch_array($res2, null, PGSQL_ASSOC);
	if($line)
	{
		$results[$i]['domain'] = $domains[$i];
		$results[$i]['password'] = $line['password'];
		$success[$i] = true;
	}
	else
	{
		$success[$i] = false;
	}

	$i++;
	$line = pg_fetch_array($res3, null, PGSQL_ASSOC);
	if($line)
	{
		$results[$i]['domain'] = $domains[$i];
		$results[$i]['password'] = $line['password'];
		$success[$i] = true;
	}
	else
	{
		$success[$i] = false;
	}

	$i++;
	$line = pg_fetch_array($res4, null, PGSQL_ASSOC);
	if($line)
	{
		$results[$i]['domain'] = $domains[$i];
		$results[$i]['password'] = $line['password'];
		$success[$i] = true;
	}
	else
	{
		$success[$i] = false;
	}

	//flags to be checked first later
	$valid = false;
	$isStudent = false;

	//For each username found in each of the domains, check the password
	for($resultCount = 0; $resultCount < 5; $resultCount++)
	{
		if($success[$resultCount])
		{
			if(strcmp($password, $results[$resultCount]['password']) == 0)
			{
				$valid = true;
			}
		}
	}
	//successful login
	if($valid)
	{
		//If successful login, check to see if they are a student
		//This is classified by being in the mail.missouri.edu domain
		for($domainCount = 0; $domainCount < 5; $domainCount++)
		{
			if(strcmp($results[$i]['domain'], 'mailmissouriedu') == 0)
			{
				$isStudent = true;
			}
		}
	}
	//not successful login
	else
	{
		//Invalid username or password; could not login.
		$results['error'] = 1;
		return $results;
	}

	//Loads and prepares all data to send to renderer
	if($isStudent)
	{
		/*
		$applicant = pg_prepare($dbconn, "applicant", "SELECT * FROM applications WHERE username = $1");
		$applicant = pg_execute($dbconn, "applicant", array($username));
		$line = pg_fetch_array($applicant, null, PGSQL_ASSOC);
		if($line)
		
{			//Applicant with saved application
			$results['type'] = "saved";
			//load all data into $results
			return $results;
		}
		*/
		//TODO: implement above

		//else
		{
			//New applicant
			$results['type'] = "new";
			return $results;
		}
	}
/*
	TODO: implement below

	//Not a student; is a faculty member
	else
	{	
		$test = pg_prepare($dbconn, "test", "SELECT * FROM instructors WHERE username = $1");
		$test = pg_execute($dbconn, "applicant", array($username));
		$line = pg_fetch_array($test, null, PGSQL_ASSOC);
		
		if($line)
		{
			//is an instructor
			$results['type'] = "instructor";
			//load instructor info
			return $results;
		}
		else
		{
			$test = pg_prepare($dbconn, "test", "SELECT * FROM admins WHERE username = $1");
			$test = pg_execute($dbconn, "applicant", array($username));
			$line = pg_fetch_array($test, null, PGSQL_ASSOC);
			if($line)
			{
				//is an admin or sysAdmin
				//the status field in the DB classifies them
				$results['type'] = $line['status'];
				//load admin info
				return $results;
			}
			else
			{
				//faculty member, but not authorized to be a part of the system
				$results['error'] = 2;
				return $results;
			}
		}
	}
*/
}



/*
	TODO: implement after all above has been implemented

function saveData($appData)
{

	//look at ERD again to see if there is a username spot
	if($appData['newApp'])
	{
		$saving = pg_prepare($dbconn, "save", "INSERT INTO applicants VALUES($1)");
		$saving = pg_execute($dbconn, "save", array($appData['username']));
	}
	
	$update = pg_prepare($dbconn, "update", "UPDATE applicants SET $1 = $2 WHERE username = $3"); 

	foreach($appData as $element ==> $value)
	{
		pg_execute($dbconn, "update", array($element, $value, $appData['username']));
	}

}

function deleteApp($username)
{
	//what if no record in table?
	$drop = pg_prepare($dbconn, "drop", "DELETE FROM applicants WHERE username = $1");
	$drop = pg_execute($dbconn, "drop", array($username));
	return;
}


*/
?>

