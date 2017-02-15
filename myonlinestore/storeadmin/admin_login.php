<?php

require 'core.inc.php';

require '../storescripts/connect_to_mysql.php';

if(loggedin())
{
	header("location:index.php");
	//$username = getuserfield('username');
	//echo 'You are Logged In, '.$username.' <a href="logout.php"> Log out</a><br>';
	
	//echo getuserfield('firstname');
}
else
{
    include 'loginform.inc.php';	
}
?>

<?php
//if(isset($_SESSION["user_id"])){
	//header("location:index.php");
	//exit();
//}
?>