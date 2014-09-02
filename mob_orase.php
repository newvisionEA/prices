<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<link href="css/mobile.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script type='text/javascript' src='js/jquery.min.js'></script>
<script type='text/javascript' src='js/menu_jquery.js'></script>
<script type="text/javascript" src="js/treetable.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</HEAD>
<BODY>
<?php include_once("analyticstracking.php") ?>
							<table id="table1" border="0">

<?php
require 'db.php';

// read cities
$query = "select * from city order by name";
$result = mysql_query ( $query ) or die ( "Could not execute query ".$query );
$cities = array ();
while ( $city = mysql_fetch_assoc ( $result ) ) {
	$cities [] = $city;
}

$city_index = 0;
foreach ($cities as $city) {
?>
								<tr id="table1_<?php echo $city_index ?>">
									<td>
										<img src="images/folder_green_open.png" class="button" alt="" width="16" height="16" />
										<a href="#" onclick="treetable_toggleRow('table1_<?php echo $city_index ?>');"><B><?php print(htmlspecialchars($city['name'])); ?></B></a>
									</td>
									<td></td>
									<td></td>
								</tr>  
<?php

	// read stores in city 
	$query = "select *, c.name cname, c.img cimg, c.id cid, s.id sid from store s, commerciant c 
		where c.id=s.commerciant_id and city_id=".$city['id']. ' 
		order by commerciant_id';
	$result = mysql_query ( $query ) or die ( "Could not execute query ".$query );
	$stores = array ();
	while ( $store = mysql_fetch_assoc ( $result ) ) {
		$stores[] = $store;
	}

	$store_index = -1;
	$last_com_id = 0;
	foreach ($stores as $store) {
		if ($last_com_id != $store['cid']) {
			$store_index++;
?>
								<tr id="table1_<?php echo $city_index ?>_<?php echo $store_index ?>">
									<td>&nbsp;&nbsp;&nbsp;&nbsp;
										<img src="images/folder_green_open.png" class="button" alt="" width="16" height="16" />
										<a href="#" onclick="treetable_toggleRow('table1_<?php echo $city_index?>_<?php echo $store_index ?>');">
										  <IMG src="images/<?php echo $store['cimg']; ?>" width = "50" title="<?php print(htmlspecialchars($store['cname'])); ?>"/>
										</a>
									</td>
									<td></td>
									<td></td>
								</tr>  
<?php
			$last_com_id = $store['cid'];
			$sub_store_index=0;
		}
?>
								<tr id="table1_<?php echo $city_index ?>_<?php echo $store_index ?>_<?php echo $sub_store_index ?>">
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="mob_preturiSupermarket2.php?sid=<?php echo $store['sid']?>" onclick="treetable_toggleRow('table1_<?php echo $city_index?>_<?php echo $store_index ?>_<?php echo $sub_store_index ?>');">
										  Preturi <?php echo $store['cname'].' '.$store['address']?>
										</a>
									</td>
									<td></td>
									<td></td>
								</tr>  

<?php 
		$sub_store_index++;
	}
		
	$city_index++;
}

?>
<?php 
require 'mob_menu.php';
?>
</BODY>
</HTML>

