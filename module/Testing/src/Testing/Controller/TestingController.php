<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Testing for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Testing\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Validator\File\Size;
use Testing\UploadForm;

class TestingController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }
    public function uploadFormAction()
    {
//         $form     = $this->getServiceLocator()->get('UploadForm');
//         $request = $this->getRequest();
//         if ($request->isPost()) {
             
//             $profile = new UploadForm();
//             $form->setInputFilter($profile->getInputFilter());
             
//             $nonFile = $request->getPost()->toArray();
//             $File    = $this->params()->fromFiles('fileupload');
//             $data = array_merge(
//                 $nonFile,
//                 array('fileupload'=> $File['name'])
//             );
//             //set data post and file ...
//             $form->setData($data);
//             if ($form->isValid()) {
//                 echo "is vaild!";
//                 $size = new Size(array('min'=>2000000)); //minimum bytes filesize
                 
//                 $adapter = new \Zend\File\Transfer\Adapter\Http();
//                 $adapter->setValidators(array($size), $File['name']);
//                 if (!$adapter->isValid()){
//                     $dataError = $adapter->getMessages();
//                     $error = array();
//                     foreach($dataError as $key=>$row)
//                     {
//                         $error[] = $row;
//                     }
//                     $form->setMessages(array('fileupload'=>$error ));
//                 } else {
//                     $adapter->setDestination(dirname(__DIR__).'/data/tmpuploads');
//                     if ($adapter->receive($File['name'])) {
//                         $profile->exchangeArray($form->getData());
//                         echo 'Profile Name '.$profile->profilename.' upload '.$profile->fileupload;
//                     }
//                 }
//             }
//             else{
//                 echo "not valid!";
//             }
//         }
        
//         return array('form' => $form);
        
        $form     = $this->getServiceLocator()->get('UploadForm');
        $tempFile = null;
        
        $prg = $this->fileprg($form);
        if ($prg instanceof \Zend\Http\PhpEnvironment\Response) {
            return $prg; // Return PRG redirect response
        } elseif (is_array($prg)) {
            if ($form->isValid()) {
                $data = $form->getData();
                var_dump($form->getData());
    //            Form is valid, save the form!
                return $this->redirect()->toRoute('testing');
            } else {
                // Form not valid, but file uploads might be valid...
                // Get the temporary file information to show the user in the view
                $fileErrors = $form->get('pdf-file')->getMessages();
                if (empty($fileErrors)) {
                    $tempFile = $form->get('pdf-file')->getValue();
                }
            }
        }
        
        return array(
            'form'     => $form,
            'tempFile' => $tempFile,
        );

    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /testing/testing/foo
        return array();
    }
}
