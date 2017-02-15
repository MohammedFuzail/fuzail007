<?php
//Created By Mohammed Fuzail @ www.hackranet.wordpress.com -12/5/2015
/*
1."die()" will exit the script and show an error statement if something goes wrong with the "connect" or "select" functons
2.A "mysql_connect()" error usually means your username / password are wrong
3.A "mysql_select_db()" error usually means the database does not exist
*/
//Place db host name Some "localhost" but 
//Sometimes looks like this >> ???mysql?? someserver.net

$db_host = 'localhost';

$db_user = 'root';

$db_password = '';

$db_name  = 'E-STORE';

$conn_err = 'Could not connect';

if(!@mysql_connect($db_host, $db_user, $db_password) || !@mysql_select_db($db_name))
{
	die($conn_err);
}
?>

