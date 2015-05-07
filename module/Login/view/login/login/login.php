    <?php 
    session_start();
//     if(isset($_POST['login']))
//     {
        Login();
//     }
    
    function Login()
    {
        echo "Login here!";
        if(empty($_POST['pawprint']))
        {
            echo "<br><p style='text-align:center; color:red;'>Please enter your PawPrint</p>";
            return false;
        }
         
        if(empty($_POST['password']))
        {
            echo "<br><p style='text-align:center; color:red;'>Please enter a password</p>";
            return false;
        }
         
        $pawprint = trim($_POST['pawprint']);
        $password = trim($_POST['password']);
        //$_SESSION['username'] = $pawprint;
         
        if(!CheckLoginInDB($pawprint,$password))
        {
            
        }
       
        
    }
    
    function CheckLoginInDB($pawprint,$password)
    {
        
        
        require "functions.php";
        $DBconn = db_connect();
        require "authentication.php";
        $results = authenticate($pawprint, $password, $DBconn);
        if($results['error'] == 1)
        {
            echo "<p style='color:red; text-align:center;'>Incorrect username or password</p>";
            return false;
        }
        else if($results['error'] == 2)
        {
            echo "<p>Unauthorized Access</p>";
        }
        else if($results['error'] == 0){
           echo $results['type'];
           if(strcmp($results['type'], "instructor") == 0){
               $_SESSION['username'] = $pawprint;
               $_SESSION['status']= "instructor";
               echo "instructor";
//                header('Location:professorpage');
               exit;
            }
            
            else if(strcmp($results['type'], "applicant") == 0){
                $_SESSION['username'] = $pawprint;
                $_SESSION['status']= "applicant";
                echo "applicant";
//                 header('Location:studentpage');
                exit;
            }
            else if(strcmp($results['type'], "admin") == 0){
                $_SESSION['username'] = $pawprint;
                $_SESSION['status']= "admin";
                echo "admin";
//                 header('Location:admin');
                exit;
            }
            else if(strcmp($results['type'], "new") == 0){
                $_SESSION['username'] = $pawprint;
                $_SESSION['status']= "new";
                echo "new";
//                 header('Location:studentpage');
                exit;
            }
        }
    }
    ?>