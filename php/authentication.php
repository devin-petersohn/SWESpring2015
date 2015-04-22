<?php
//TODO: figure out conflicts with returning the array as is

//The following 2 functions are for testing purposes only
function connect()
{
	//Insert the server information into their respective fields to connect to the db.  
	$dbconn = pg_connect("host= dbname= user= password=")
		or die("Could not connect: " . pg_last_error());

	echo "Connected.<br>";
	return $dbconn;
}

function test($dbconn)
{
	$result = array();
	//This call is used to verify that the user 'asdf' can login.
	$result[1] = authenticate("mcs526", "test", $dbconn);
	//TODO: can $dbconn be global?

	//test the array that comes from authenticate()
	print_r($result);
}


function authenticate($username, $password, $dbconn)
{ 
	$returnResults = array();

	$queries = array($auth0, $auth1, $auth2, $auth3, $auth4);
	$domains = array("mailumkcedu", "missouriedu", "mizzouedu", "umkcedu", "mailmissouriedu");
	$facultyType = array("instructor", "admin", "sysAdmin");
	$results = array();
	$success = array();

	//all calls to the tables. Will be collapsed. 
	$auth0 = pg_prepare($dbconn, "0", "SELECT * FROM mailumkcedu WHERE username = $1") or die(pg_last_error());
	$auth1 = pg_prepare($dbconn, "1", "SELECT * FROM missouriedu WHERE username = $1") or die(pg_last_error());
	$auth2 = pg_prepare($dbconn, "2", "SELECT * FROM mizzouedu WHERE username = $1") or die(pg_last_error());
	$auth3 = pg_prepare($dbconn, "3", "SELECT * FROM umkcedu WHERE username = $1") or die(pg_last_error());
	$auth4 = pg_prepare($dbconn, "4", "SELECT * FROM mailmissouriedu WHERE username = $1") or die(pg_last_error());


	//TODO: implement this
	//
	//To double check later and ensure validity of above queries. 
	//$verify0 = pg_prepare($dbconn, "domain0", "SELECT * FROM tig WHERE username = $1") or die(pg_last_error());
	//$verify0 = pg_prepare($dbconn, "domain1", "SELECT * FROM col WHERE username = $1") or die(pg_last_error());

	for($queryNum = 0; $queryNum < 5; $queryNum++)
	{
		$queries[$queryNum] = pg_execute($dbconn, $queryNum, array(htmlspecialchars($username)));
		$line = pg_fetch_array($queries[$queryNum], null, PGSQL_ASSOC);
		if($line)
		{
			$results[$queryNum]['domain'] = $domains[$queryNum];
			$results[$queryNum]['password'] = $line['password'];
			$success[$queryNum] = true;
		}
		else
		{
			$success[$queryNum] = false;
		}
	}

	//flags to be checked later
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
	$results['error'] = 0;
	//successful login
	if($valid)
	{
	    $results['error'] = 0;
		//If successful login, check to see if they are a student
		//This is classified by being in the mail.missouri.edu domain
		for($domainCount = 0; $domainCount < 5; $domainCount++)
		{
			if($results[$domainCount]['domain'])
			{
				if(strcmp($results[$domainCount]['domain'], 'mailmissouriedu') == 0)
				{
					$isStudent = true;
				}
			}	
		}
		if($isStudent)
		{
			if(isInSystem($username, "applicant", $dbconn))
			{
				$returnResults['type'] = 'applicant';
			}
			else
			{
				$returnResults['type'] = 'new';
			}
			$returnResults['error'] = 0;
		}
		else
		{
			$flag = false;
			for($Ftypes = 0; $Ftypes < 3; $Ftypes++)
			{
				if(isInSystem($username, $facultyType[$Ftypes], $dbconn))
				{
					$returnResults['type'] = $facultyType[$Ftypes];
					$flag = true;
				}
			}
			if(!$flag)
			{
				$returnResults['type'] = 'fail';
				$returnResults['error'] = 2;
			}
			else
			{
				$returnResults['error'] = 0;
			}
		}
	}
	//not successful login
	else
	{
		//Invalid username or password; could not login.
		$returnResults['error'] = 1;
		$returnResults['type'] = 'fail';
	}
	return $returnResults;
}

function isInSystem($user, $domain_intended, $dbconn)
{
    if(strcmp($domain_intended, "instructor") == 0
        | strcmp($domain_intended, "admin") == 0
        | strcmp($domain_intended, "sysAdmin") == 0)
    {
        pg_prepare($dbconn, "userQ",
        "SELECT * FROM users WHERE domain LIKE 'missouri.edu'"
			. "AND sso LIKE $1");

        $SR = pg_execute($dbconn, "userQ",
            array(htmlspecialchars($user)));

        if(pg_num_rows($SR) == 0)
        {
            return false;
        }
        else
        {
            pg_prepare($dbconn, "instructorQ",
            "SELECT * FROM instructor WHERE sso LIKE $1");
            $SR = pg_execute($dbconn, "instructorQ",
                array(htmlspecialchars($user)));
            	
            if(pg_num_rows($SR) == 0)
            {
                pg_prepare($dbconn, "adminQ",
                "SELECT * FROM admin WHERE sso LIKE $1");
                $SR = pg_execute($dbconn, "instructorQ",
                    array(htmlspecialchars($user)));
                	
                if(pg_num_rows($SR) == 0)
                {
                    pg_prepare($dbconn, "sysAdminQ",
                    "SELECT * FROM sys_admin WHERE sso LIKE $1");
                    	
                    $SR = pg_execute($dbconn, "sysAdminQ",
                        array(htmlspecialchars($user)));
                    	
                    if(pg_num_rows($SR) == 0)
                    {
                        return false;
                    }
                    else
                    {
                        if(strcmp($domain_intended, "sysAdmin") == 0)
                        {
                            return true;
                        }
                        else
                        {
                            return false;
                        }
                    }
                }
                else
                {
                    if(strcmp($domain_intended, "admin") == 0)
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
            }
            else
            {
                if(strcmp($domain_intended, "instructor") == 0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    }
    else if(strcmp($domain_intended, "applicant") == 0)
    {
        pg_prepare($dbconn, "applicantQ",
        "SELECT sso FROM users WHERE sso LIKE $1 AND domain LIKE 'mail.missouri.edu'");
        	
        $SR = pg_execute($dbconn, "applicantQ",
            array(htmlspecialchars($user)));
        	
        if(pg_num_rows($SR) == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}



?>
