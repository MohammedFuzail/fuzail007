<?php 
// Script Error Reporting
require 'core.inc.php';
//include("functions.php");
?>
<?php

if(isset($_GET['id'])){
	include "../storescripts/connect_to_mysql.php";
	$id = $_GET['id'];
	$id = preg_replace('#[^0-9]#i', '', $id);
	
	$sql = mysql_query("SELECT * FROM products WHERE id = '$id' LIMIT 1");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $code = $row["code"];
			 $price = $row["price"];
			 $details = $row["details"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
	}
}
else{
	echo "That item does not exist!";
	exit();
}
}
else
{
	echo "Data to render this page is missing";
	exit();
}
	
/*if(isset($_SESSION['user_id']))
{
	
	$query= mysql_query("SELECT * FROM id WHERE `id` = '".$_SESSION['user_id']."' ")or die(mysql_error());
//$arr = mysql_fetch_array($query);
//$num = mysql_num_rows($query);
	if($query_run = mysql_query($query))
		{
			while($row = mysql_fetch_array($query)){ 
             $user_id = $row["id"];
			 //echo $user_id;
		}
		}
}*/

/*if(isset($_SESSION['user_id']))
	{
		$query = "SELECT * FROM users WHERE id = '".$_SESSION['user_id']."'";
		if($query_run = mysql_query($query))
		{
			while($row = mysql_fetch_array($query)){ 
             $user_id = $row["id"];
			 ?>
             <script type = "text/javascript">
			 <!-- 
			 alert("<?php echo $user_id; ?>");
			 //--> 
			  </script>
			<?php
            }
		}
	}

	
	
	
if(isset($_GET['id'])){
	include "../storescripts/connect_to_mysql.php";
	$ip = getIp();
	 
	$p_id = $_GET['id'];
   
	//$chk_usr = "SELECT * FROM users WHERE id = '$user_id'";
	$chk_pro = "SELECT * FROM cart WHERE ip_add = '$ip' AND p_id = '$p_id'";
	//$run_chkusr = mysql_query($query);
	$run_chk = mysql_query($chk_pro);
	//if(mysql_num_rows($run_chk)&&mysql_num_rows($query)>0)
	if(mysql_num_rows($run_chk)>0)
	{
		echo "";
	}
	else{
		$insert_pro = "INSERT INTO cart (p_id,ip_add) values ('$p_id','$ip')";
		$run_pro = mysql_query($insert_pro);
		echo "<script>window.open('index.php','_self')</script>";
		}
}
*/
mysql_close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $product_name; ?></title>
<link rel = "stylesheet" href = "../style/style.css" type = "text/css" media = "screen" />
</head>

<body>
<div align = "center" id = "mainWrapper">
<?php include_once("template_header.php");?>
<div id = "pageContent">
 <?php

if(loggedin())
{
	
	$firstname = getuserfield('firstname');
	$surname = getuserfield('surname');
	echo 'You are Logged In, '.$firstname.' '.$surname. '<br>';
	
	//echo getuserfield('firstname');
}
else
{	
	header("location:userlogin.php");
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width = "20%" valign="top"><img src = "../inventory_images/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $product_name; ?>" /><br/>
   <a href="../inventory_images/<?php echo $id; ?>.jpg">View Full Size Image</a></td>
   <td width="80%" valign="top"><h3><?php echo $product_name; ?></h3>
    <p><?php echo "Code : ".$code; ?><br/>
    <p><?php echo "<img src='../Indian_Rupee.jpg' alt = 'Rupee' width = '15' height = '10' ></img> : ".$price;  ?><br/>
    <br/>
    <?php echo " Categoty : $category " ?><br/><br/>
     <?php echo " SubCategoty : $subcategory" ?><br/>
    <br/>
    <?php echo "Descriptions : ".$details; ?>
    <br/>
    
    <form id="form1" name="form1" method="post" action="cart.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input type="submit" name="button" id="button" value="Add to Shopping Cart" />
      </form>
      
      <!--<a href='cart.php?add_cart=$pid' value="<?php //echo $id; ?>" ><button style = 'float:right'>Add to Cart</a>-->
      
    </td>
  </tr>
</table>

	
</div>

<?php include_once("../template_footer.php");?>
</div> 
</body>
</html>