<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Test for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Test\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Test\Model\Profile;
use Zend\Validator\File\Size;
use Test\Form\ProfileForm;
session_start();

class TestController extends AbstractActionController
{
    public function indexAction()
    {
    
        $form = new ProfileForm();
        $request = $this->getRequest();  
        if ($request->isPost()) {
             
            $profile = new Profile();
            $form->setInputFilter($profile->getInputFilter());
             
            $nonFile = $request->getPost()->toArray();
            $File    = $this->params()->fromFiles('fileupload');
            $data = array_merge(
                 $nonFile,
                 array('fileupload'=> $File['name'])
             );
            //set data post and file ...    
            $form->setData($data);
              
            if ($form->isValid()) {
                 
                $size = new Size(array('max'=>1000000)); //minimum bytes filesize
                 
                $adapter = new \Zend\File\Transfer\Adapter\Http(); 
                $adapter->setValidators(array($size), $File['name']);
                if (!$adapter->isValid()){
                    $dataError = $adapter->getMessages();
                    $error = array();
                    foreach($dataError as $key=>$row)
                    {
                        $error[] = $row;
                    }
                    $form->setMessages(array('fileupload'=>$error ));
                } else {
                    $env_var = getenv('OPENSHIFT_DATA_DIR');
                    $filename=(string)$File['name'];
                    $uploadfilter=explode(".", $filename);
                    if(!isset($_SESSION['username'])){
                        echo "You have to login before started!".'<br>';
                        
                    }
                    else {
                        echo $_SESSION["username"];
                        if(strcmp($uploadfilter[1],"pdf")==0)
                        {
                            if (file_exists($env_var.$_SESSION["username"])) {
                                echo "The file $filename exists";
                            }
                            else
                            {
                                mkdir($env_var.$_SESSION["username"]);
                            }
                            $adapter->setDestination($env_var.$_SESSION["username"]);
                            if ($adapter->receive($File['name'])) {
                                $profile->exchangeArray($form->getData());
                                $filename=(string)$profile->fileupload;
                                include 'functions.php';
                                $db = db_connect();
                                pg_query($db, "DELETE FROM Users WHERE sso = '".$_SESSION["username"]."';");
                                pg_prepare($db, "q1", 'INSERT INTO Applicant (sso, resume_filepath) VALUES ($1,$2)');
                                pg_execute($db, "q1", array($_SESSION["username"], $env_var.$_SESSION["username"]."/".$filename));
                                echo 'Profile Name '.$profile->profilename.' upload '.$profile->fileupload;
                            }
                            
                        }
                        else{
                            echo "You should upload pdf!";
                        }
                    }
                    
                    
                }  
            } 
        }
          
        return array('form' => $form);
    
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /test/test/foo
        return array();
    }
}
