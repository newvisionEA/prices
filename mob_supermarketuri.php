<?php session_start(); ?>

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
<body>
							<table id="table1" border="0">
								<colgroup>
									<col width="300" />
									<col width="100" />
									<col width="0*" />
								</colgroup>
<?php
require 'db.php';

// read cities
$query = "select * from commerciant order by name";
$result = mysql_query ( $query ) or die ( "Could not execute query ".$query );
$commerciants = array ();
while ( $commerciant = mysql_fetch_assoc ( $result ) ) {
	$commerciants [] = $commerciant;
}

$commerciant_index = 0;
foreach ($commerciants as $commerciant) {
?>
								<tr id="table1_<?php echo $commerciant_index ?>">
									<td>
										<img src="images/folder_green_open.png" class="button" alt="" width="16" height="16" />
										<B><a href="#" onclick="treetable_toggleRow('table1_<?php echo $commerciant_index ?>');"></B>
										<IMG src="images/<?php echo $commerciant['img']; ?>" width = "50" title="<?php print(htmlspecialchars($commerciant['name'])); ?>"/>
										</a>
									</td>
									<td></td>
									<td></td>
								</tr>  
<?php

	// read cities with commerciant 
	$query = "select *, ci.id ciid, ci.name ciname, c.name cname, s.id sid  from city ci, store s, commerciant c 
		where c.id=s.commerciant_id and s.city_id=ci.id and c.id=".$commerciant['id']." order by ci.name";
	$result = mysql_query ( $query ) or die ( "Could not execute query ".$query );
	$cities = array ();
	while ( $city = mysql_fetch_assoc ( $result ) ) {
		$cities[] = $city;
	}

	$city_index = -1;
	$last_city_id = 0;
	foreach ($cities as $city) {
		if ($last_city_id != $city['ciid']) {
			$city_index++;
?>
								<tr id="table1_<?php echo $commerciant_index ?>_<?php echo $city_index ?>">
									<td>&nbsp;&nbsp;&nbsp;&nbsp;
										<img src="images/folder_green_open.png" class="button" alt="" width="16" height="16" />
										<B><a href="#" onclick="treetable_toggleRow('table1_<?php echo $commerciant_index?>_<?php echo $city_index ?>');">
										<?php echo $city['ciname'] ?>
										</a></B>
									</td>
									<td></td>
									<td></td>
								</tr>  
<?php
			$last_city_id = $city['ciid'];
			$sub_city_index=0;
		}
?>
								<tr id="table1_<?php echo $commerciant_index ?>_<?php echo $city_index ?>_<?php echo $sub_city_index ?>">
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="mob_preturiSupermarket2.php?sid=<?php echo $city['sid']?>" onclick="treetable_toggleRow('table1_<?php echo $commerciant_index?>_<?php echo $city_index ?>_<?php echo $sub_city_index ?>');">
										 Preturi <?php echo $city['cname'].' '.$city['address']?>
										 </a>
									</td>
									<td></td>
									<td></td>
								</tr>  

<?php 
		$sub_city_index++;
	}
		
	$commerciant_index++;
}

?>
							</TABLE>
							<?php require 'mob_menu.php' ?>
</BODY>
</HTML>

