<?php
$product = $_POST['product']; 
$price = $_POST['price'];
$date = $_POST['date'];
$store = $_POST['store'];

require 'db.php';

$cdate =  date('Y-m-d H:i', strtotime($date));

$query = "
		insert into price_hist (product_id, rdate, value, store_id)
		values(".$product.", '".$cdate."', ".$price.", ".$store.")";

if (!mysql_query($query, $connection))
{
	die('Error: ' . mysql_error());
}

$query = "select count(*) counter from price where product_id=".$product." and store_id=".$store." and rdate < '".$cdate. "' ";
echo $query;
$result = mysql_query ( $query ) or die ( "Could not execute query ".$query );
$row = mysql_fetch_array ( $result );
extract ( $row );
	
if ($counter == 0) {
	$query = "
		insert into price (product_id, rdate, value, store_id)
		values(".$product.", '".$cdate."', ".$price.", ".$store.")";
	
	if (!mysql_query($query, $connection))
	{
		die('Error: ' . mysql_error());
	}	
} else {
	$query = "update price set value = ".$price.", rdate='".$cdate."' where product_id=".$product." and store_id=".$store;
	if (!mysql_query($query, $connection))
	{
		die('Error: ' . mysql_error());
	}
}
echo "OK";

mysql_close($connection);
?>

<BR/>

<?php 
require 'contribuie.php';
?>