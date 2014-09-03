<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']!="rveina2@gmail.com") {
	echo "Invalid rights";
	exit();
}
$comerciant = $_POST['comerciant']; 
$oras = $_POST['oras'];
$adresa = $_POST['adresa'];


require 'db.php';

$query = "insert into store (commerciant_id, city_id, address)
		values(".$comerciant.", ".$oras.", '".$adresa."')";
//echo $query;
if (!mysql_query($query, $connection))
{
	die('Error: ' . mysql_error());
}
echo "1 record added";

mysql_close($connection);
?>

<BR/>
<?php 
require 'admin.php';
?>