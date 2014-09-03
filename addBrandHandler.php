<?php
$brand = $_POST['brand']; 
if (!isset($_SESSION['user']) || $_SESSION['user']!="rveina2@gmail.com") {
	echo "Invalid rights";
	exit();
}

require 'db.php';

$query = "insert into brand (name)
		values('".$brand."')";
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