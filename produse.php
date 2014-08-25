<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>--</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1"/>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/treetable.js"></script>

</HEAD>


<BODY>
	<TABLE WIDTH="1010" BORDER="0" align="center" CELLPADDING="0"
		CELLSPACING="0" ID="Table_01">
		<TR>
			<TD WIDTH="4" ROWSPAN="5" BGCOLOR="#124989"><IMG
				SRC="images/spacer.gif" WIDTH="4" HEIGHT="300" ALT="" /></TD>
			<TD WIDTH="1000" HEIGHT="100" class="companyname2">
				<table BORDER="0">
					<tr>
						<td width="1000"><IMG src="images/belowMenu.png" /></td>
					</tr>
				</table>
			</TD>
			<TD WIDTH="4" ROWSPAN="5" BGCOLOR="#124989"><IMG
				SRC="images/spacer.gif" WIDTH="4" HEIGHT="5" ALT="" /></TD>
		</TR>
		<TR>
		<?php require 'menu.php'?>		 
		</TR>
		<TR>
			<TD WIDTH="1000" HEIGHT="6" colspan="1"><IMG
				src="images/belowMenu.png" /></TD>
		</TR>
		<TR>
			<TD HEIGHT="1307" valign="top" bgcolor="#FFFFFF">
				<table width="800" border="0" align="center" cellpadding="0"
					cellspacing="0">
					<tr>
						<td class="content">
	<table id="table1" border="0">

		<colgroup>

			<col width="400" />

			<col width="0*" />

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
				$query2 = "select c.name xname, c.img img from price pri, store s, commerciant c where pri.store_id = s.id and s.commerciant_id = c.id and pri.value = ".$pmin;
				$result2 = mysql_query($query2) or die ("Could not execute query ".$query2);
				$row2 = mysql_fetch_array($result2);
				extract($row2);
				?>
				
				<IMG src="images/<?php echo $img; ?>" height = "22" title="<?php echo $xname ?>"/> <IMG src="images/lightbulb.png" height = "20" width = "20" title="Cel mai bun pret"/>
			
			
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
						</td>
					</tr>
				</table>
			</TD>
			<TD WIDTH="1" HEIGHT="92"><IMG SRC="images/spacer.gif" WIDTH="1"
				HEIGHT="92" ALT="" /></TD>
		</TR>
	</TABLE>
</BODY>
</HTML>

