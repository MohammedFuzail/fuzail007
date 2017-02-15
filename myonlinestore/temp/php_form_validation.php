<html>
<head>
</head>
<body> 
<?php
// define variables and set to empty values
$name = $email = $gender = $comment = $website = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $name = test_input($_POST["name"]);
   $email = test_input($_POST["email"]);
   $website = test_input($_POST["website"]);
   $comment = test_input($_POST["comment"]);
   $gender = test_input($_POST["gender"]);
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   Name: <input type="text" name="name">
   <br><br>
   E-mail: <input type="text" name="email">
   <br><br>
   Website: <input type="text" name="website">
   <br><br>
   Comment: <textarea name="comment" rows="5" cols="40"></textarea>
   <br><br>
   Gender:
   <input type="radio" name="gender" value="female">Female
   <input type="radio" name="gender" value="male">Male
   <br><br>
   <input type="submit" name="submit" value="Submit"> 
</form>

<?phpecho "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>
</body>
</html>



<?php
$id = $product_name = $price = $details = $category = $subcategory = $date_added = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$id = test_input($_POST["id"]);
	$product_name = test_input($_POST["product_name"]);
	$price = test_input($_POST["price"]);
	$details = test_input($_POST["details"]);
	$category = test_input($_POST["category"]);
	$subcategory = test_input($_POST["subcategory"]);
	$date_added = test_input($_POST["date_added"]);
}
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>


<?php
//Parse the form data into the inventory system
if(isset($_POST['product_name'])){
	
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