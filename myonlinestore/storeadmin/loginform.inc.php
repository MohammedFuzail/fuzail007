<?php

if(isset($_POST['username'])&&isset($_POST['password']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password_hash = md5($password);
	
	if(!empty($username)&&!empty($password))
	{
	$query = "SELECT id FROM admin WHERE username = '".mysql_real_escape_string($username)."' AND password = '".mysql_real_escape_string($password_hash)."' "; /*to protect user frm sql injection using dis in "NOTE: username = '' OR ''=' :ETON"  in dis line*/
	    if($query_run = mysql_query($query))
		{
			$query_num_rows = mysql_num_rows($query_run);
		}
		if($query_num_rows==0)
		{
			echo 'Invalid Username and password';
		}
		else if($query_num_rows==1)
		{
			$user_id = mysql_result($query_run, 0, 'id');
			$_SESSION['user_id']=$user_id;
			header('Location: admin_login.php');
		}
	}
	else
	{
		echo 'Please fill all fields';
	}
}
//8c43424b8a988b9f2df84b7e162b51 == getmein is d pswd
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
  <form id = "form1" action = "<?php echo $current_file;?>" method = "POST" > 
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