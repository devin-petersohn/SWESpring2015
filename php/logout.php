<?php
use Login;
$_SESSION["username"]="";
$_SESSION["status"]="";
session_destroy();
header('Location:swespring2015/login');
exit;


?>