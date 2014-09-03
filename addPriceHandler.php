<?php
session_start();

if (!isset($_SESSION['user'])) {
	echo "Invalid rights";
	exit();
}

$product = $_POST['product']; 
$price = $_POST['price'];
$date = $_POST['date'];
$store = $_POST['store'];

require 'dbi.php';

$cdate =  date('Y-m-d H:i', strtotime($date));

$dbh = getDBH();
$stmt = $dbh->prepare('insert into price_hist (product_id, rdate, value, store_id)
		values(?, ?, ?, ?)');
$stmt->bind_param('isdi', $product, $cdate, $price, $store);
$stmt->execute();
$stmt->close();

$stmt = $dbh->prepare('select count(*) counter from price where product_id=? and store_id=? and rdate < ?');
$stmt->bind_param('iis', $product, $store, $cdate);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
extract ( $row );
$stmt->close();

if ($counter == 0) {
	$stmt = $dbh->prepare('insert into price (product_id, rdate, value, store_id)
			values(?, ?, ?, ?)');
	$stmt->bind_param('iis', $product, $store, $cdate);
	$stmt->execute();
} else {
	$stmt = $dbh->prepare("update price set value = ?, rdate=? where product_id=? and store_id=?");
	$stmt->bind_param('dsii', $price, $cdate, $product, $store);
	$stmt->execute();
}
//echo "OK";

$dbh->close();
?>
<?php 
require 'contribuie.php';
?>