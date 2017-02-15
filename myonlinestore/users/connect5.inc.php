<?php


$conn_err = 'Could not connect';
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_password = '';

$mysql_db = 'e-store';

if(!@mysql_connect($mysql_host, $mysql_user, $mysql_password) || !@mysql_select_db($mysql_db))
{
	die($conn_err);
}
?>

