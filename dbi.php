<?php
DEFINE ( 'DB_USER', 'prices' );
DEFINE ( 'DB_PASSWORD', 'prices' );
DEFINE ( 'DB_HOST', 'localhost' );
DEFINE ( 'DB_NAME', 'prices' );

//$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//mysql_select_db ( DB_NAME ) or die ( 'Could not select database' );
function getDBH() {
	static $DBH = null;
	if (is_null($DBH)) {
		$DBH = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	}
	return $DBH;
}
?>

