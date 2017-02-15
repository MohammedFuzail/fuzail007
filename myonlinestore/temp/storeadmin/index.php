<?php
session_start();
if(!isset($_SESSION["manager"])){
	header("location:admin_login.php");
	exit();
}
//Be sure to check that this manager SESSion values is in fact in the database
        $managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]);//filter everything but number and letter
		$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]);//filter everything but number and letter
		$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]);//filter everything but number and letter
include"../storescripts/connect_to_mysql.php";
$sql = mysql_query("SELECT * FROM admin WHERE id = '$managerID' AND username='$manager' AND password = '$password' LIMIT 1");
$existCount = mysql_num_rows($sql);
if($existCount == 0){
	header("location:../index.php");
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store Admin Area</title>
<link rel = "stylesheet" href = "../style/style.css" type = "text/css" media = "screen" />
</head>

<body>
<div align = "center" id = "mainWrapper">
<?php include_once("../template_header.php");?>
<div id = "pageContent"><br/>
<div align = "left" style="margin-left:24px;">
  <h2>Hello Store Manager, what would you like to do changes todya ?</h2>
  <p><a href="inventory_list.php">Manage Inventory</a></p><br/>
  <p><a href="#">Manage </a></p>
</div>
<br/>
<br/>
</div>
<?php include_once("../template_footer.php");?>
</div> 
</body>
</html>