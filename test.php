<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>HTML Treetable - Example 1</title>

<script type="text/javascript" src="js/treetable.js"></script>

</head>

<body>

	<table id="table1">

		<colgroup>

			<col width="400" />

			<col width="0*" />

		</colgroup>

		<tr>

			<th>Produs</th>

			<th>Cel mai bun pret</th>

			<th>La</th>


		</tr>
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
			<td><?php echo $spaces ?><a href="#"
				onclick="treetable_toggleRow('table1<?php echo $prefix?>_<?php echo $index ?>');"><?php print(htmlspecialchars($node['category']['name'])); ?></a></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
<?php
			$query = "select p.id pid, p.name pname, b.name bname, p.qty_um qty, p.um um, pri.value val,
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
			<td><?php echo $spaces.'&nbsp;&nbsp;&nbsp;&nbsp;' ?><a href="detaliiProdus.php?id='<?php echo $pid?>'"><?php print(htmlspecialchars($pname.' '.$bname.' '.$qty.' '.$um)); ?></a></td>
			<td>
				<?php echo number_format(floor($pmin), 0, '.', '') ?><SUP><?php echo substr(number_format($pmin - floor($pmin), 2, '', ''), 1)?></SUP>
			</td>
			<td>
				<?php 
				$query2 = "select c.name xname from price pri, store s, commerciant c where pri.store_id = s.id and s.commerciant_id = c.id and pri.value = ".$pmin;
				$result2 = mysql_query($query2) or die ("Could not execute query ".$query2);
				$row2 = mysql_fetch_array($result2);
				extract($row2);
				?>
				
				<?php echo $xname ?> <IMG src="images/lightbulb.png" height = "20" width = "20" title="Cel mai bun pret"/>
			
			
			</td>
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
</body>