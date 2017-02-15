<?php
//session for admin only is there or not ?
require 'core.inc.php';
require '../storescripts/connect_to_mysql.php';
?>
<?php
//Error Reporting
error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<?php
//Parse the form data into the inventory system
if(isset($_POST['product_name'])){
	include('../storescripts/connect_to_mysql.php');
	$product_name = mysql_real_escape_string($_POST['product_name']);
	$price = mysql_real_escape_string($_POST['price']);
	$category = mysql_real_escape_string($_POST['category']);
	$subcategory = mysql_real_escape_string($_POST['subcategory']);
	$details = mysql_real_escape_string($_POST['details']);
	//see if that prod name is an identical match to another prod in the system.
	$sql = mysql_query("SELECT id FROM products WHERE product_name = '$product_name' LIMIT 1");
	$productMatch = mysql_num_rows($sql);
	if($productMatch>0){
		echo 'Sorry you tried to place a duplicate "Product Name" into the system, <a href="inventory_list.php">Click_here</a>';
		exit();
	}
	//Add this prod into the db now
	$sql = mysql_query("INSERT INTO products(product_name,price,details,category,subcategory,date_added)VALUES('$product_name','$price','$details','$category','$subcategory',now())") or die(mysql_error());
	$pid = mysql_insert_id();
	//place image in the folder
	$newname = "$pid.jpg";
	move_uploaded_file($_FILES['fileField']['tmp_name'],"../inventory_images/$newname");
}
?>
<?php
//whole list can be viewed here!!
$product_list = "";
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC");
$product_count = (mysql_num_rows($sql));
if($product_count > 0)
{
	while($row = mysql_fetch_array($sql))
	$id = $row["id"];
	$product_name = $row["product_name"];
	$date_added = $row["date_added"];
	//$date_added = strftime("%b %d, %y",strtotime($row["date_added"]));
	$product_list = "  $product_name - $date_added&nbsp;&nbsp; <a href='#'>edit</a> &bull; <a href='#'>delete</a> <br/>";
}
else
{
	$product_list = "There's no any product available in the product_list";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv = "Content-Type" content="text/html; charset=utf-8" />
<title>Invetory List</title>
<link rel = "stylesheet" href = "../style/style.css" type = "text/css" media = "screen" />
</head>

<body>
<?php
if(isset($_POST["id"])&&isset($_POST["product_name"])&&isset($_POST["price"])&&isset($_POST["details"])&&isset($_POST["category"])&&isset($_POST["subcategory"])&&isset($_POST["date_added"]))
{
	$id = test_input($_POST["id"]);
	$product_name = test_input($_POST["product_name"]);
	$price = test_input($_POST["price"]);
	$details = test_input($_POST["details"]);
	$category = test_input($_POST["category"]);
	$subcategory = test_input($_POST["subcategory"]);
	$date_added = test_input($_POST["date_added"]);
	
	if(!empty($id)&&!empty($product_name)&&!empty($price)&&!empty($details)&&!empty($category)&&!empty($subcategory)&&!empty($date_added))
	{
		$query = "SELECT product_name FROM products WHERE product_name = '$product_name'";
			$query_run = mysql_query($query);
			
			if(mysql_num_rows($query_run)==1)
			{
				echo 'The product_name '.$product_name. ' already exists.'; 
			}
			else
			{
				$query = "INSERT INTO products VALUES('','".mysql_real_escape_string($product_name)."','".mysql_real_escape_string($price)."','".mysql_real_escape_string($details)."','".mysql_real_escape_string($category)."','".mysql_real_escape_string($subcategory)."','".mysql_real_escape_string($date_added)."')";
				if($query_run = mysql_query($query))
				{
					header('Location:  ');
				}
				else
				{
					echo 'Sorry WE Unable to Add items @ this Time';
				}
			}
	}
	else 
	{
	echo 'Plaese Fill All Fields!';
	}
}
?>

<div align = "center" id = "mainWrapper">
<?php include_once("../template_header.php");?>
<div id = "pageContent"><br/>
<div align="right" style="margin-right:32px"><a href="inventory_list.php  #inventoryForm">+Add New Inventory Item</a></div>
<div align = "left" style="margin-left:24px;">
  <h2>Inventory List</h2>
  <?php echo $product_list;?>
</div>
<a name = "inventoryForm" id = "inventoryForm"></a>
<h3>&darr;Add New Inventory Item Form&darr;</h3>
<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" name="myForm" id = "myForm" method="POST">
<table width="90%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td width="20%">Product Name</td>
    <td width="80%"><label>
    <input type = "text" name = "product_name" id = "product_name" size="64">
    </label></td>
  </tr>
  <tr>
    <td width="20%">Product Price</td>
    <td width="80%"><label>
    <input type="text" name = "textfield"  id = "textfield" size = "12"/>
    </label></td>
  </tr>
  <tr>
    <td width="20%">Category</td>
    <td width="80%"><label><select name="category" id = "category">
    <option value=""></option>
    
    <option value="Clothing">Clothing</option>
    <option value="Eletronics">Eletronics</option>
    <option value="Educations">Educations</option>
    </select></label></td>
  </tr>
  <tr>
    <td width="20%">Subcategory;</td>
    <td width="80%"><label><select name="subcategory" id = "subcategory">
    <option value=""></option>
    <option value="Stationary">Stationary</option>
    <option value="Hats">Hats</option>
    <option value="Pants">Pants</option>
    <option value="Shirt">Shirt</option>
    </select></label></td>
  </tr>
  <tr>
    <td width="20%">Product Details</td>
    <td width="80%"><label><textarea cols = "64" rows="5" name = "textarea" id = "textarea"></textarea></label></td>
  </tr>
  <tr>
    <td width="20%">Product Image</td>
    <td width="80%"><label><input type = "file" name = "fileField" id = "fileField"></label></td>
  </tr>
  <tr>
    <td width="20%">&nbsp;</td>
    <td width="80%"><label><input type="submit" name="button" value="Add This item Now"/></label></td>
  </tr>
  <tr>
    <td width="20%">&nbsp;</td>
    <td width="80%">&nbsp;</td>
  </tr>
</table>
</form>
<h4><br/>
  <br/>
</h4>
<div>
  <?php

if(loggedin())
{
	$username = getuserfield('username');
	echo '. ' .$username. ' You can LogOut here...,  <a href="logout.php"> LogOut</a><br>';
}
else
{	
	header("location:admin_login.php");
}
?>
</div>
</div>
<?php include_once("../template_footer.php");?>
</div> 
</body>
</html>