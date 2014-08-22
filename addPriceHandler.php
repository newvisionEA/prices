<?php
$product = $_POST['product']; 
$price = $_POST['price'];
$date = $_POST['date'];
$store = $_POST['store'];



require 'db.php';

$query = "insert into price (product_id, rdate, value, store_id)
		values(".$product.", '".$date."', ".$price.", ".$store.")";
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
require 'menu.php';
?>