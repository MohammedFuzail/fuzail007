<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
require '/users/core.inc.php';
/*if(!loggedin())
{
	header('location:/users/userlogin.php');
}*/
?>
<?php

if(isset($_GET['id'])){
	include "storescripts/connect_to_mysql.php";
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
mysql_close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $product_name; ?></title>
<link rel = "stylesheet" href = "style/style.css" type = "text/css" media = "screen" />
</head>

<body>
<div align = "center" id = "mainWrapper">
<?php include_once("template_header.php");?>
<div id = "pageContent">
<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr>
    <td width = "20%" valign="top"><img src = "inventory_images/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $product_name; ?>" /><br/>
   <a href="inventory_images/<?php echo $id; ?>.jpg">View Full Size Image</a></td>
   <td width="80%" valign="top"><h3><?php echo $product_name; ?></h3>
    <p><?php echo "Code : ".$code; ?><br/>
    <p><?php echo "<img src='Indian_Rupee.jpg' alt = 'Rupee' width = '15' height = '10' ></img> : ".$price;  ?><br/>
    <br/>
    <?php echo " Categoty : $category " ?><br/><br/>
     <?php echo " SubCategoty : $subcategory" ?><br/>
    <br/>
    <?php echo "Descriptions : ".$details; ?>
    <br/>
    
   <?php 
   if(loggedin())
   {
   echo'<form id="form1" name="form1" method="post" action="cart.php">
       <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
       <input type="submit" name="button" id="button" value="Add to Shopping Cart" />
   </form>';
   }
   else{
   		echo '<br/> Please Login To Puchase! <a href = "users/userlogin.php">Login</a> <br/><br/> If you are a new user Please Kindly SignUp now To Manage your Account! <a href = "users/register.php">SignUp</a>';
   }
	  ?>
    </td>
  </tr>
</table>

	
</div>
<?php include_once("template_footer.php");?>
</div> 
</body>
</html>