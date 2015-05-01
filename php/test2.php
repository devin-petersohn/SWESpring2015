<?php
use Zend\Crypt\BlockCipher;
use Zend\Crypt\Symmetric\Mcrypt;

$filter = new Zend\Filter\Encrypt(array('adapter' => 'BlockCipher'));
$filter->setKey('asfd');

$encrypt = $filter->filter('this is a test');
echo $encrypt;

$filter2 = new Zend\Filter\Decrypt();
$filter2->setKey('asfd');
$filter2 = $filter2->filter($filter);
echo $filter2;

?>
