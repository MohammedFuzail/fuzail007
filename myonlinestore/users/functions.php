<?php
/*include "../storescripts/connect_to_mysql.php";
$con = mysql_connect("localhost","root","");
function getIp(){
	
	$ip = $_SERVER['REMOTE_ADDR'];
	
	if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	
	return $ip;
}

//*/  /*Displaying the total items have been added to the users cart
	function usr_tot_items()
	{
	if(isset($_GET['id'])){
	//include "../storescripts/connect_to_mysql.php";
	//$con;
	$id = $_GET['id'];
	$ip = getIp();
	//$get_items = "SELECT * FROM cart WHERE ip_add = '$ip' AND id = '$user_id'";
	$get_items = "SELECT * FROM cart WHERE ip_add = '$ip'";
	//$get_items = "SELECT * FROM cart WHERE id = '$user_id'";
	$run_items = mysql_query($get_items);
	$count_items = mysql_num_rows($run_items);
	}
	else
	{
	//include "../storescripts/connect_to_mysql.php";	
	//$con;
	$ip = getIp();
	//$get_items = "SELECT * FROM cart WHERE id = '$user_id'";
	$get_items = "SELECT * FROM cart WHERE ip_add = '$ip'";
	$run_items = mysql_query($get_items);
	$count_items = mysql_num_rows($run_items);
	}
	echo $count_items;
	}

*/
?>