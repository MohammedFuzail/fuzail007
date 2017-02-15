<?php
//connect to the file above here
require "connect_to_mysql.php";

$sqlCommand = "CREATE TABLE `e-store`.`admin` ( `id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(40) NOT NULL , `password` VARCHAR(40) NOT NULL , `last_log_date` DATE NOT NULL , PRIMARY KEY (`id`), UNIQUE (`username`)) ENGINE = InnoDB";

if(mysql_query($sqlCommand)){
	echo "Your admin table has been ceated Successfully!";
}
else{
	echo "CRITICAL ERROR admin table has not been created.";
}
?>