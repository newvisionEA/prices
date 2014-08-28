<?php
session_start();

$name = "noname";
$email = $_POST['email'];
$pass = $_POST['pass'];

require 'db.php';

$query = "select count(*) counter from user where email = '".$email."' and password = '".$pass."'";
$result = mysql_query ( $query ) or die ( "Could not execute query ".$query );
$row = mysql_fetch_array ( $result );
extract ( $row );

if ($counter == 0)
{
	echo ("ERROR: Wrong user or password!");
} else {
	$_SESSION['user']=$email;	
	echo $email;
}

mysql_close($connection);



?>