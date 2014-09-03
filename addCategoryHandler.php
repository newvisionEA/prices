<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']!="rveina2@gmail.com") {
	echo "Invalid rights";
	exit();
}
$category = $_POST['category']; 
$name = $_POST['name'];

require 'db.php';



  $query = "insert into category (parent_id, name)
		values(".$category.", '".$name."')";

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