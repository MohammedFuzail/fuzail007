<?php
session_start();
if(isset($_SESSION["manager"])){
	header("location:index.php");
	exit();
}
?>
<?php
//Parse the login form if the user has filled it out and pressed "Log In"
if(isset($_POST["usrename"])&&isset($_POST["password"])){
	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]);//filter everything but number and letter
	$password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]);//filter everything but number and letter
	include ("../storescripts/connect_to_mysql.php");
	/*$sql = mysql_query("SELECT id FROM admin WHERE username = '$manager' AND password = '$password' LIMIT 1");
$existCount = mysql_num_rows($sql);
if($existCount == 1){
	while($row = mysql_fetch_array($sql)){
		$id = $row['id'];
	}	
	$_SESSION['id']=$id;
	$_SESSION['manager']=$manager;
	$_SESSION['password']=$password;
	header("location:index.php");
	exit();
}else{
	echo 'That info is incorrect, Try again<a href = "index.php">Click Here</a>';
	exit();
}
}*/

	$sql = mysql_query("SELECT id FROM admin WHERE username = '$manager' AND password = '$password' LIMIT 1"); /*to protect user frm sql injection using dis in "NOTE: username = '' OR ''=' :ETON"  in dis line*/
	    if($query_run = mysql_query($sql))
		{
			$query_num_rows = mysql_num_rows($query_run);
		}
		if($query_num_rows==0)
		{
			echo 'Invalid Username and password';
		}
		else if($query_num_rows==1)
		{
			$manager = mysql_result($query_run, 0, 'id');
			$_SESSION['managerID']=$managerID;
			header('Location:index.php');
		}
	
	else
	{
		echo 'Please fill all fields';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin LogIn</title>
<link rel = "stylesheet" href = "../style/style.css" type = "text/css" media = "screen" />
</head>

<body>
<div align = "center" id = "mainWrapper">
<?php include_once("../template_header.php");?>
<div id = "pageContent"><br/>
<div align = "left" style="margin-left:24px;">
  <h2>Please LogIn To Manage the Store</h2>
  <form id = "form1" name = "form1" method = "post" action = "admin_login.php">
  User Name:<br/>
  <input type = "text" name = "username" id = "username" size = "40"/>
  <br/><br/>
  Password:<br/>
  <input type = "password" name = "password" id = "password" size = "40"/>
  <br/>
  <br/>
  <br/>
  <label>
  <input type = "submit" name = "button" value = "LogIn" />
  </label>
  </form>
  <p>&nbsp;</p>
</div>

<br/>
<br/>
<br/>
</div>
<?php include_once("../template_footer.php");?>
</div> 
</body>
</html>