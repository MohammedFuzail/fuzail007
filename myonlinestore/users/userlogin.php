<?php

require 'core.inc.php';
require '../storescripts/connect_to_mysql.php';
require 'connect5.inc.php';
if(isset($_SESSION["user_id"])){
	$username = $_SESSION['user_id'];
	header("location: index.php"); 
    exit();
}
else{
	$username = "";
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store Home Page</title>
<link rel = "stylesheet" href = "../style/style.css" type = "text/css" media = "screen" />
</head>

<body>
<div align = "center" id = "mainWrapper">
<?php include_once("../template_header.php");?>
<div id = "pageContent">


<div>



<br/><br/>
    
<div>

</div>
<?php
if(loggedin())
{
	//header("location: index.php");
	$firstname = getuserfield('firstname');
	$surname = getuserfield('surname');
	echo 'You are Logged In, '.$firstname.' '.$surname. ' <a href="logout.php"> Log out</a><br>';
	
	//echo getuserfield('firstname');
}
else
{
	//header("location:../index.php");
    include 'loginform.inc.php';	
}
?>
<div>
<?php include_once("../template_footer.php");?>
</div>
</div> 

</body>
</html>