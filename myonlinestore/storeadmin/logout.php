<?php
require 'core.inc.php';

session_destroy();
header('Location:../index.php' ); //echo $http_referer;
?>
