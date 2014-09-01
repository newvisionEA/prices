<?php 
session_start(); 

$name = "noname";
$email = $_POST['email'];
$pass = $_POST['pass'];

require 'db.php';

$query = "insert into user (name, email, password) values('".$name."','".$email."','".$pass."')";

if (!mysql_query($query, $connection))
{
	echo ("ERROR: User already exists!".$query);
} else {
	echo $email;
}

mysql_close($connection);

?>