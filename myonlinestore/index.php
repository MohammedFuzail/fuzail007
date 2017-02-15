<?php 
// Run select query to get my latest updates... 
require 'storescripts/connect_to_mysql.php';


$dynamicList = "";
$sql = mysql_query("SELECT * FROM products ORDER BY date_added DESC LIMIT 6");
$productCount = mysql_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysql_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $code = $row["code"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			 $dynamicList .= '<table width="100%" border="0" cellspacing="0" cellpadding=6">
      <tr>
        <td width="17%" valign="top"><a href="product.php?id =' . $id . '"><img style = "border:#666 1px solid;" src="inventory_images/' . $id . '.jpg"  alt="' . $product_name . '" width="140" height="139" border = "1" /></a></td>
        <td width="83%" valign="top">' . $product_name . '<br/><br/>
          <img src="Indian_Rupee.jpg" alt = "Rupee" width = "15" height = "10" ></img> :' . $price . '<br/><br/>
          <a href="product.php?id=' . $id . '">View Product Details</a>
		  </td>
      </tr>
    </table>';
    }
} else {
	$dynamicList = "Sorry! We have no Products!!!";
}
mysql_close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Store Home Page</title>
<link rel = "stylesheet" href = "style/style.css" type = "text/css" media = "screen" />
</head>

<body>
<div align = "center" id = "mainWrapper">
<?php include_once("template_header.php");?>
<div id = "pageContent">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="30%" valign = "top"><p>some scrap </p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="35%" valign="top"><p>Newest Item Added to the Store</p>
    <p><?php echo $dynamicList; ?></p>
   <!-- <table width="100%" border="1" cellspacing="0" cellpadding=6">
      <tr>
        <td width="23%"><a href="product.php?"><img style = "border:#666 1px solid;" src="inventory_images/4.jpg" width="140" height="139" alt="$dynamicTitle" /></a></td>
        <td width="77%" valign="top"><p>Product Title</p>
          <p>Product Price</p>
          <p><a href="product.php?">View Product</a></p></td>
      </tr>
    </table>-->
    <p>&nbsp;</p>
    </td>
    <td width="30%"><p>More Crap</p>
      </td>
  </tr>
</table>

</div>
<?php include_once("template_footer.php");?>
</div> 
</body>
</html>