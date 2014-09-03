<?php
session_start();

$name = "noname";
$email = $_POST['email'];
$pass = $_POST['pass'];

require 'dbi.php';

$dbh = getDBH();
$stmt = $dbh->prepare('select count(*) counter from user where email = ? and password = ?');
$stmt->bind_param('ss', $email, $pass);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
extract ( $row );

if ($counter == 0)
{
	echo ("ERROR: Wrong user or password!");
} else {
	$_SESSION['user']=$email;	
	echo $email;
}

$dbh->close();



?>