<?php
DEFINE ( 'DB_USER', 'prices' );
DEFINE ( 'DB_PASSWORD', 'prices' );
DEFINE ( 'DB_HOST', 'localhost' );
DEFINE ( 'DB_NAME', 'prices' );

$connection = mysql_connect ( DB_HOST, DB_USER, DB_PASSWORD ) or die ( 'Could not connect to database' . mysql_error () );

mysql_select_db ( DB_NAME ) or die ( 'Could not select database' );

?>

