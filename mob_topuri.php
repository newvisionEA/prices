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
						<table id="table1" border="0">
							<TR>
							<TD colspan="2">
							<H1>Top cele mai mici preturi</H1>
							</TD>
							</TR>
							<?php
require 'db.php';

$query='select s.id store_id, ci.name ciname, c.name cname, c.img cimg, s.address sadr, sum(counter) counter from vw_topstoresbyminprice t, store s, commerciant c, city ci
where t.store_id = s.id and c.id = s.commerciant_id and ci.id=s.city_id
group by s.id, ci.name, c.name, s.address, c.img
order by counter desc';
$result = mysql_query($query) or die ("Could not execute query".$query);

$line = 1;
while($row = mysql_fetch_array($result)) {
	extract($row);
	?>
	<TR>
		<TD>
		<?php echo $line++ ?>. <A href="preturiSupermarket2.php?sid=<?php echo $store_id ?>"><IMG src="images/<?php echo $cimg ?>" width = "50" title="<?php echo $cname ?>"/></A>&nbsp;
		 <A href="preturiSupermarket2.php?sid=<?php echo $store_id ?>"><?php echo $cname ?> <?php echo $ciname ?> <?php echo $sadr ?></A>
		</TD>
		<TD>
		<?php echo $counter ?> preturi minime.
		</TD>
		</TR>
	<?php 
}

?>
							
						</TABLE>
						<?php 
require 'mob_menu.php';
?>
</BODY>
</HTML>

