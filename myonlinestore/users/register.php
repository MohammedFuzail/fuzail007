<?php
require 'core.inc.php';
require 'connect5.inc.php';
if(!loggedin())
{
	if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['confirm_password'])&&isset($_POST['firstname'])&&isset($_POST['surname']))
	{
		$username = $_POST['username'];
		
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];
		$password_hash = md5($password);
		
		$firstname = $_POST['firstname'];
		$surname = $_POST['surname'];
		
		if(!empty($username)&&!empty($password)&&!empty($confirm_password)&&!empty($firstname)&&!empty($surname))
		{
			/*if(strlen($username)>30||strlen($firstname)>20||strlen($surname)>40)
			{
				echo 'Please ahear to Maxlength of fields.';
			}*/
			if($password!=$confirm_password)
			{
				echo 'Password do not Match';
			}
			else
			{
				//Here we are starting registeration process
			$query = "SELECT username FROM users WHERE username = '$username'";
			$query_run = mysql_query($query);
			
			if(mysql_num_rows($query_run)==1)
			{
				echo 'The username '.$username. ' already exists.'; 
			}
			else
			{
				$query = "INSERT INTO users VALUES('','".mysql_real_escape_string($username)."','".mysql_real_escape_string($password_hash)."','".mysql_real_escape_string($firstname)."','".mysql_real_escape_string($surname)."')";
				if($query_run = mysql_query($query))
				{
					header('Location:  register_success.php');
				}
				else{
					echo 'Sorry WE Unable to Register @ this Time';
				}
			}
			}
			
		}
		else
		{
			echo 'Plaese Fill All Fields!';
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
  <h2>Please SignUp To Login</h2>
  <form id = "form1" action = "<?php echo $current_file;?>" method = "POST" > 
	Username:<br> <input type="text" name = "username" maxlength = "30" value = "<?php if(isset($username)){ echo $username;} ?>" ><br><br>
	Password:<br> <input type="password" name = "password"><br><br>
	Confirm_Password:<br> <input type="password" name = "confirm_password"><br><br>
	firstname:<br> <input type = "text"  name = "firstname"maxlength = "20" value = "<?php if(isset($firstname)){ echo $firstname;} ?>" ><br><br>
	surname:<br> <input type = "text" name = "surname" maxlength = "20" "value = "<?php if(isset($surname)){ echo $surname;} ?>" ><br><br> 
	<input type = "submit" value = "Register">
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
    
	
<?php
	
}
else if(loggedin())
{
	echo 'You are already registerd and logged in.';
}


?>