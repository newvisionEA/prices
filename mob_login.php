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
	?>
<HTML>
<HEAD>
<link href="css/mobile.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script type='text/javascript' src='js/jquery.min.js'></script>
<script type='text/javascript' src='js/menu_jquery.js'></script>
<script type="text/javascript" src="js/treetable.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</HEAD>
<body>

<table id="table1" border="0">
<TR>
<TD>	
	ERROR: Wrong user or password
	</TD>
	</TR>
	</table>
	<?php 
	require 'mob_menu.php';
} else {
	$_SESSION['user']=$email;	
	require 'mob_membri.php';
}

mysql_close($connection);



?>