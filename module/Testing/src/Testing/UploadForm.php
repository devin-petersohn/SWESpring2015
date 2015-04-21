<?php
namespace Testing;

use Zend\Form\Element;
use Zend\Form\Form;

class UploadForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->addElements();
        $this->addInputFilter();
    }

    public function addElements()
    {
        // File Input
        $file = new Element\File('pdf-file');
        $file->setLabel('Avatar pdf Upload')
             ->setAttribute('id', 'pdf-file');
        $this->add($file);
    }
    public function addInputFilter()
    {
        $inputFilter = new \Zend\InputFilter\InputFilter();
    
        // File Input
        $fileInput = new \Zend\InputFilter\FileInput('pdf-file');
        $fileInput->setRequired(true);
        $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            array(
                'target'    => './data/tmpuploads/avatar.pdf',
                'randomize' => true,
            )
        );
        $inputFilter->add($fileInput);
    
        $this->setInputFilter($inputFilter);
    }
    
    
    
//     public function exchangeArray($data)
//     {
//         $this->profilename  = (isset($data['profilename']))  ? $data['profilename']     : null;
//         $this->fileupload  = (isset($data['fileupload']))  ? $data['fileupload']     : null;
//     }
     
//     public function setInputFilter(InputFilterInterface $inputFilter)
//     {
//         throw new \Exception("Not used");
//     }
     
//     public function getInputFilter()
//     {
//         if (!$this->inputFilter) {
//             $inputFilter = new InputFilter();
//             $factory     = new Factory();
    
//             $inputFilter->add(
//                 $factory->createInput(array(
//                     'name'     => 'profilename',
//                     'required' => true,
//                     'filters'  => array(
//                         array('name' => 'StripTags'),
//                         array('name' => 'StringTrim'),
//                     ),
//                     'validators' => array(
//                         array(
//                             'name'    => 'StringLength',
//                             'options' => array(
//                                 'encoding' => 'UTF-8',
//                                 'min'      => 1,
//                                 'max'      => 100,
//                             ),
//                         ),
//                     ),
//                 ))
//             );
             
//             $inputFilter->add(
//                 $factory->createInput(array(
//                     'name'     => 'fileupload',
//                     'required' => true,
//                 ))
//             );
             
//             $this->inputFilter = $inputFilter;
//         }
         
 //       return $this->inputFilter;
//    }
}

?>