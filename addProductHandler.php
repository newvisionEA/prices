<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']!="rveina2@gmail.com") {
	echo "Invalid rights";
	exit();
}
$brand = $_POST['brand']; 
$category = $_POST['category'];
$name = $_POST['name'];
$um = $_POST['um'];
$refum = $_POST['refum'];
$qtyum = $_POST['qtyum'];
$packid = $_POST['packid'];


require 'db.php';

$query = "insert into product (brand_id, category_id, name, um, refum, qty_um, pack_id)
		values(".$brand.", ".$category.", '".$name."','".$um."','".$refum."',".$qtyum.", ".$packid.")";
echo $query;
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