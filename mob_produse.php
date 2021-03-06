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
<?php include_once("analyticstracking.php") ?>

<table id="table1" border="0">

<?php
require 'db.php';

// Fetch all the roles
$result = mysql_query ( "select * from category" );
$roles = array ();
while ( $role = mysql_fetch_assoc ( $result ) ) {
	$roles [] = $role;
}

// Function that builds a tree
function build_tree($roles, $parent_id = 0) {
	$tree = array ();
	foreach ( $roles as $role ) {
		
		if ($role ['parent_id'] == $parent_id) {
			$tree [] = array (
					'category' => $role,
					'children' => build_tree ( $roles, $role ['id'] ) 
			);
		}
	}
	
	return $tree;
}

// Function that walks and outputs the tree
function print_tree2($tree, $prefix, $spaces) {
	if (count ( $tree ) > 0) {
		$index = 0;
		foreach ( $tree as $node ) {
			?>
		<tr id="table1<?php echo $prefix?>_<?php echo $index ?>">
			<td><?php echo $spaces ?><img src="images/folder_green_open.png" class="button" alt="" width="16" height="16" /><B><a href="#"
				onclick="treetable_toggleRow('table1<?php echo $prefix?>_<?php echo $index ?>');"><?php print(htmlspecialchars($node['category']['name'])); ?></a></B></td>
			<td></td>
			<td></td>
		</tr>
<?php
			$query = "select p.id pid, p.name pname, b.name bname, p.qty_um qty, p.um um, pri.value val, pri.rdate rdate, 
			(
			SELECT MIN( value )
			FROM price
			WHERE product_id = p.id
			) pmin
		from product p, brand b, price pri
		where b.id=p.brand_id and pri.product_id=p.id and p.category_id = " . $node ['category'] ['id'] . " group by p.id";
			
			$result = mysql_query ( $query ) or die ( "Could not execute query" );
			$indexCat = 0;
			while ( $row = mysql_fetch_array ( $result ) ) {
				extract ( $row );
				?>
		<tr
			id="table1<?php echo $prefix?>_<?php echo $index ?>_<?php echo $indexCat ?>">
			<td><?php echo $spaces.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?><a href="detaliiProdus.php?id=<?php echo $pid?>"><?php print(htmlspecialchars($pname.' '.$bname.' '.$qty.' '.$um)); ?></a></td>
			<td><B>
				<?php echo number_format(floor($pmin), 0, '.', '') ?></B><SUP><?php echo substr(number_format($pmin - floor($pmin), 2, '', ''), 1)?></SUP>
			</td>
			<td>
				<?php 
				$query2 = "select c.name xname, c.img img, s.id sid from price pri, store s, commerciant c where pri.store_id = s.id and s.commerciant_id = c.id and pri.value = ".$pmin;
				$result2 = mysql_query($query2) or die ("Could not execute query ".$query2);
				$row2 = mysql_fetch_array($result2);
				extract($row2);
				?>
				
				<A href="preturiSupermarket2.php?sid=<?php echo $sid?>"><IMG src="images/<?php echo $img; ?>" width = "50" title="<?php echo $xname ?>"/></A> Cel mai bun pret la
				<A href="preturiSupermarket2.php?sid=<?php echo $sid?>"><?php echo $xname ?></A>				 
			
			
			</td>
			<td class='greytext'>(la <?php echo date('d.m.Y H:i', strtotime($rdate)) ?>)</td>
			</tr>
	<?php
				$indexCat++;
			}
			
			// the recursive thing
			print_tree2 ( $node ['children'], '_' . $index, $spaces . '&nbsp;&nbsp;&nbsp;&nbsp;' );
			$index ++;
		}
	}
}
$tree = build_tree ( $roles );
print_tree2 ( $tree, '', '' );
?>

</table>
<?php
require 'mob_menu.php'; 
?>							
</BODY>
</HTML>

