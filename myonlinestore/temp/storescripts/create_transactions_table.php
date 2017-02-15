<?php
//connect to the file above here
require "connect_to_mysql.php";

$sqlCommand = "CREATE TABLE `e-store`.`transactions` ( `id` INT NULL AUTO_INCREMENT , `product_id` VARCHAR(50) NOT NULL , `payer_email` VARCHAR(50) NOT NULL , `first_name` VARCHAR(50) NOT NULL , `last_name` VARCHAR(50) NOT NULL , `payment_date` DATE NOT NULL , `mc_gross` VARCHAR(50) NOT NULL , `payment_currency` VARCHAR(50) NOT NULL , `txn_id` VARCHAR(50) NOT NULL , `receiver_email` VARCHAR(50) NOT NULL , `payment_type` VARCHAR(50) NOT NULL , `payment_status` VARCHAR(50) NOT NULL , `txn_type` VARCHAR(50) NOT NULL , `payer_status` VARCHAR(50) NOT NULL , `address_street` VARCHAR(80) NOT NULL , `address_city` VARCHAR(50) NOT NULL , `address_state` VARCHAR(50) NOT NULL , `address_zip` VARCHAR(20) NOT NULL , `address_country` VARCHAR(40) NOT NULL , `address_status` VARCHAR(50) NOT NULL , `notify_version` VARCHAR(50) NOT NULL , `verify_sign` VARCHAR(50) NOT NULL , `payer_id` VARCHAR(50) NOT NULL , `mc_currency` VARCHAR(50) NOT NULL , `mc_fee` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`), UNIQUE (`txn_id`)) ENGINE = InnoDB";

if(mysql_query($sqlCommand)){
	echo "Your transactions table has been created Successfully!";
}
else{
	echo "CRITICAL ERROR product table has not been created.";
}
?>