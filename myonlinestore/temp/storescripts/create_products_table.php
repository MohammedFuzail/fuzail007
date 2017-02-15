<?php
//connect to the file above here
require "connect_to_mysql.php";

$sqlCommand = "CREATE TABLE `e-store`.`products` ( `id` INT NULL AUTO_INCREMENT , `product_name` VARCHAR(40) NOT NULL , `price` VARCHAR(16) NOT NULL , `details` TEXT NOT NULL , `category` VARCHAR(16) NOT NULL , `subcategory` VARCHAR(16) NOT NULL , `date_added` DATE NOT NULL , PRIMARY KEY (`id`), UNIQUE (`product_name`)) ENGINE = InnoDB";

if(mysql_query($sqlCommand)){
	echo "Your products table has been created Successfully!";
}
else{
	echo "CRITICAL ERROR product table has not been created.";
}
?>