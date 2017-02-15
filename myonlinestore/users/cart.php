<?php
//session_start();
require 'core.inc.php';
?>
<?php 
// Script Error Reporting
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
//require 'storescripts/connect_to_mysql.php';
include "../storescripts/connect_to_mysql.php";
?>
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 1 (if user attempts to add something to the cart from the product page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
	$wasFound = false;
	$i = 0;
	// If the cart session variable is not set or cart array is empty
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) { 
	    // RUN IF THE CART IS EMPTY OR NOT SET
		$_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => 1));
	} else {
		// RUN IF THE CART HAS AT LEAST ONE ITEM IN IT
		foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $pid) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + 1)));
					  $wasFound = true;
				  } // close if condition
		      } // close while loop
	       } // close foreach loop
		if ($wasFound == false) {
			   array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => 1));
		   }
	}
	header("location: cart.php"); 
    exit();
}	 
?>

<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 2 (if user chooses to empty their shopping cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
    unset($_SESSION["cart_array"]);
}
?>
<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 3 (if user chooses to adjust item quantity)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "") {
    // execute some code
	$item_to_adjust = $_POST['item_to_adjust'];
	$quantity = $_POST['quantity'];
	$quantity = preg_replace('#[^0-9]#i', '', $quantity); // filter everything but numbers
	if ($quantity >= 100) { $quantity = 99; }
	if ($quantity < 1) { $quantity = 1; }
	if ($quantity == "") { $quantity = 1; }
	$i = 0;
	foreach ($_SESSION["cart_array"] as $each_item) { 
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $item_to_adjust) {
					  // That item is in cart already so let's adjust its quantity using array_splice()
					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $quantity)));
				  } // close if condition
		      } // close while loop
	} // close foreach loop
}
?>

<?php 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 4 (if user wants to remove an item from cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
    // Access the array and run code to remove that array index
 	$key_to_remove = $_POST['index_to_remove'];
	if (count($_SESSION["cart_array"]) <= 1) {
		unset($_SESSION["cart_array"]);
	} else {
		unset($_SESSION["cart_array"]["$key_to_remove"]);
		sort($_SESSION["cart_array"]);
		//echo count($_SESSION["cart_array"]);
	}
}
?>


<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 5  (render the cart for the user to view on the page)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$cartOutput = "";
$cartTotal = "";
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
} else {
	
	// Start the For Each loop
	$i = 0; 
    foreach ($_SESSION["cart_array"] as $each_item) { 
	
	$item_id = $each_item['item_id'];
	$sql = mysql_query("SELECT * FROM products WHERE id = '$item_id' LIMIT 1");
	while($row = mysql_fetch_array($sql)){ 
			 $product_name = $row["product_name"];
			 $code = $row["code"];
			 $price = $row["price"];
			 $details = $row["details"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
	}
	$totalprice = $price * $each_item['quantity'];
	$cartTotal = $totalprice + $cartTotal;
	//$userstotalcart = $each_item['quantity'];
	
	//setlocale(LC_MONETARY, "en_US");
	//$totalprice = money_format("%10.2n",$totalprice);
	//Dynamic table assembly
	
	$cartOutput .= "<tr>";
	$cartOutput .= "<td><a href = \"../product.php?id= $item_id\"> $product_name </a><br/><img src = \"../inventory_images/$item_id.jpg\" alt = \" $product_name \" width = \"90\" height = \"52\" border = \"1\" /></td>";
	$cartOutput .= "<td>". $code ."</td>";
	$cartOutput .= "<td>". $details ."</td>";
	$cartOutput .= "<td><img src='../Indian_Rupee.jpg' alt = 'Rupee' width = '15' height = '10' ></img> :". $price ."</td>";
	$cartOutput .= '<td><form action="cart.php" method="post">
	<input name="quantity" type="text" value="'.$each_item['quantity'].'" size="1" maxlength="4" />
	<input name="adjustBtn'.$item_id.'" type="submit" value="Modify" /><input name="item_to_adjust" type="hidden" value="'. $item_id .'" /></form></td>';
	//$cartOutput .= "<td>". $each_item['quantity'] ."</td>";
	$cartOutput .= "<td><img src='../Indian_Rupee.jpg' alt = 'Rupee' width = '15' height = '10' ></img> :". $totalprice ."</td>";
	$cartOutput .= '<td><form action="cart.php" method="post"><input name="DeleteBtn'.$item_id.'" type="submit" value="Delete" /><input name="index_to_remove" type="hidden" value="'. $i .'" /></form></td>';
	//$cartOutput .= '<td>'.$i.'<form action="cart.php" method="post"><input name="DeleteBtn'.$item_id.'" type="submit" value="Delete" /><input name="index_to_remove" type="hidden" value="'. $i .'" /></form></td>';
	$cartOutput .= "</tr>";
	$i++;
	
	
	//$cartOutput .= "<h2>Cart item $i</h2>";
	//$cartOutput .= "Item ID: " .$each_item['item_id']. "<br/>";
	//$cartOutput .= "Item Quantity: " .$each_item['quantity']. "<br/>";
    //$cartOutput .= "Item Name: " .$product_name. "<br/>";
	//$cartOutput .= "item Code: " .$code. "<br/>";
	//$cartOutput .= "Item Price: " .$price. "<br/>";	
	//while(list($key,$value) = each($each_item))
	//{
		//$cartOutput .= "$key: $value<br/>";
	//}
	}
	//Remember that when you make work to money_format funtion of en_indian rupee remove rupee image
	//setlocale(LC_MONETARY, "en_US");
	//$totalprice = money_format("%10.2n",$totalprice);
	$cartTotal = "<div align='right'><strong>Cart Total</strong> = <img src='../Indian_Rupee.jpg' alt = 'Rupee' width = '15' height = '10' ></img> :". $cartTotal . " Rupees </div>";
	
}
?>

<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       Section 6  (Inserting cart details into the users database and displaying it into the cart)
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*if(isset($_POST['product_name'])&&isset($_POST['price'])&&isset($_POST['quantity'])&&isset($_POST['total_price']))
	{
		$username = $_POST['username'];
		
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];
		$password_hash = md5($password);
		
		$firstname = $_POST['firstname'];
		$surname = $_POST['surname'];


function getIp(){
	
	$ip = $_SERVER['REMOTE_ADDR'];
	
	if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	
	return $ip;
}

if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
	$ip = getIp();
	$chk_pro = "SELECT * FROM cart WHERE ip_add = '$ip' AND p_id = '$item_id'";
	$run_chk = mysql_query($chk_pro);
	if(mysql_num_rows($run_chk)>0){
		echo "";
	}
	else{
		$insert_pro = "INSERT INTO cart (p_id,ip_add) values ('$item_id','$ip')";
		$run_pro = mysql_query($insert_pro);
		echo "<script>window.open('users/index.php','_self')</script>";
	}
}
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Your Cart</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("template_header.php");?>
  <div id="pageContent">
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
    <div style="margin:24px; text-align:left;">
	
    <br />
    <table width="100%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <td width="15%" bgcolor="#C5DFFA"><strong>Product</strong></td>
        <td width="10%" bgcolor="#C5DFFA"><strong>Code</strong></td>
        <td width="40%" bgcolor="#C5DFFA"><strong>Product Description</strong></td>
        <td width="10%" bgcolor="#C5DFFA"><strong>Unit Price</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Quantity</strong></td>
        <td width="9%" bgcolor="#C5DFFA"><strong>Total</strong></td>
        <td width="7%" bgcolor="#C5DFFA"><strong>Remove</strong></td>
      </tr>
     <?php echo $cartOutput; ?>
     <!-- <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr> -->
    </table>
    <?php echo $cartTotal; ?>
    <br />
<?php //echo $pp_checkout_btn; ?>
    <br />
    <br />
    <a href="cart.php?cmd=emptycart">Click Here to Empty Your Shopping Cart</a>
    </div> 
    <br/>
   
  </div>
  <?php include_once("../template_footer.php");?>
</div>
</body>
</html>