<?php
namespace Test\Form;

use Zend\Form\Form;

class ProfileForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Profile');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype','multipart/form-data');
         
        $this->add(array(
            'id' => 'profilename',
            'name' => 'profilename',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Profile Name',
            ),
        ));
 
         
        $this->add(array(
            'id' => 'fileupload',
            
            'name' => 'fileupload',
            'attributes' => array(
                'type'  => 'file',
            ),
            'options' => array(
                'label' => 'File Upload',
            ),
        )); 
         
         
        $this->add(array(
            'id' => 'submit',
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Upload Now'
            ),
        )); 
    }
}
?>