<?php
//TODO: figure out conflicts with returning the array as is
include "asserts.php";

function authenticate($username, $password, $dbconn)
{ 
	$returnResults = array();
    
	
	$domains = array("mailumkcedu", "missouriedu", "mizzouedu", "umkcedu", "mailmissouriedu");
	$facultyType = array("instructor", "admin", "sysAdmin");
	$results = array();
	$success = array();

	//all calls to the tables. Will be collapsed. 
	$auth0 = pg_prepare($dbconn, "0", "SELECT * FROM mailumkcedu WHERE username = $1") or die(header("Location:Error"));
	$auth1 = pg_prepare($dbconn, "1", "SELECT * FROM missouriedu WHERE username = $1") or die(header("Location:Error"));
	$auth2 = pg_prepare($dbconn, "2", "SELECT * FROM mizzouedu WHERE username = $1") or die(header("Location:Error"));
	$auth3 = pg_prepare($dbconn, "3", "SELECT * FROM umkcedu WHERE username = $1") or die(header("Location:Error"));
	$auth4 = pg_prepare($dbconn, "4", "SELECT * FROM mailmissouriedu WHERE username = $1") or die(header("Location:Error"));

    $queries = array($auth0, $auth1, $auth2, $auth3, $auth4);
	//TODO: implement this
	//
	//To double check later and ensure validity of above queries. 
	//$verify0 = pg_prepare($dbconn, "domain0", "SELECT * FROM tig WHERE username = $1") or die(header("Location:Error"));
	//$verify0 = pg_prepare($dbconn, "domain1", "SELECT * FROM col WHERE username = $1") or die(header("Location:Error"));

	for($queryNum = 0; $queryNum < 5; $queryNum++)
	{
		$queries[$queryNum] = pg_execute($dbconn, $queryNum, array(htmlspecialchars($username))) or die(header("Location:Error"));
		$line = pg_fetch_array($queries[$queryNum], null, PGSQL_ASSOC) or die(header("Location:Error"));
		if($line)
		{
			$results[$queryNum]['domain'] = $domains[$queryNum];
			$results[$queryNum]['password'] = $line['password'];
			$results[$queryNum]['salt'] = $line['salt'];
			$results[$queryNum]['key'] = $line['key'];
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
	$badflag = 0;
	//For each username found in each of the domains, check the password
	for($resultCount = 0; $resultCount < 5; $resultCount++)
	{
		if($success[$resultCount])
		{
		    $hash = hash("sha512", $password . $results[$resultCount]['salt'], FALSE);
		    $hash = substr($hash, $results[$resultCount]['key'], 60);
			if(strcmp($results[$resultCount]['password'], $hash) == 0)
			{
				$results[$resultCount]['loggedin'] = true;
				$valid = true;
				if($badflag == 0) $badflag = 1;
				else if($badflag == 1) $badflag = 2;
			}
			else
			{
			    $results[$resultCount]['loggedin'] = false;
			}
		}
		else
		{
		    $results[$resultCount]['loggedin'] = false;
		}
	}
	$results['error'] = 0;
	//assert($badflag != 2);
	//successful login
	if($valid)
	{
	    $results['error'] = 0;
		//If successful login, check to see if they are a student
		//This is classified by being in the mail.missouri.edu domain
		for($domainCount = 0; $domainCount < 5; $domainCount++)
		{
			if($results[$domainCount]['loggedin'])
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
		    pg_prepare($dbconn, "userQ",
		    "SELECT * FROM users WHERE domain LIKE 'missouri.edu'"
		          . "AND sso LIKE $1") or die(header("Location:Error"));
		    pg_prepare($dbconn, "instructorQ",
		    "SELECT * FROM instructor WHERE sso LIKE $1") or die(header("Location:Error"));
		    pg_prepare($dbconn, "adminQ",
		    "SELECT * FROM admin WHERE sso LIKE $1") or die(pg_last_error());
		    pg_prepare($dbconn, "sysAdminQ",
		    "SELECT * FROM sys_admin WHERE sso LIKE $1") or die(pg_last_error());
		    pg_prepare($dbconn, "applicantQ",
	       	    "SELECT sso FROM users WHERE sso LIKE $1 AND domain LIKE 'mail.missouri.edu'")
	       	    or die(pg_last_error());
		    
		    $queries = array("userQ", "instructorQ", "adminQ", "sysAdminQ", "applicantQ");
			$flag = false;
			for($Ftypes = 0; $Ftypes < 3; $Ftypes++)
			{
				if(isInSystem($username, $facultyType[$Ftypes], $dbconn, $queries))
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

function isInSystem($user, $domain_intended, $dbconn, $queries)
{
    if(strcmp($domain_intended, "instructor") == 0
        | strcmp($domain_intended, "admin") == 0
        | strcmp($domain_intended, "sysAdmin") == 0)
    {
      
        $SR = pg_execute($dbconn, $queries[0],
            array(htmlspecialchars($user)));

        if(pg_num_rows($SR) == 0)
        {
            return false;
        }
        else
        {   
            $SR = pg_execute($dbconn, $queries[1],
                array(htmlspecialchars($user)));
            	
            if(pg_num_rows($SR) == 0)
            {
                $SR = pg_execute($dbconn, $queries[2],
                    array(htmlspecialchars($user)));
                	
                if(pg_num_rows($SR) == 0)
                {
                    $SR = pg_execute($dbconn, $queries[3],
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
        $SR = pg_execute($dbconn, $queries[4],
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
