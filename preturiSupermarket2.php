<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
		<?php require 'menu.php'?>		 
						<td class="content">
	<table id="table1"  border="0">
		<colgroup>
			<col width="300" />
			<col width="100" />
			<col width="0*" />
		</colgroup>

<?php
require 'db.php';

$sid = isset ( $_GET ['sid'] ) ? $_GET ['sid'] : null;

if ($sid != null) {
	$query = "select c.name cname, c.id cid, ci.name scity, s.address saddress from commerciant c, store s, city ci where ci.id=s.city_id and c.id=s.commerciant_id and s.id = " . $sid;
	$result = mysql_query ( $query ) or die ( "Could not execute query".$query );
	$row = mysql_fetch_array ( $result );
	extract ( $row );

	$query = "select c.img, c.name cname, c.id cid from commerciant c, store s where c.id=s.commerciant_id and s.id = " . $sid;
	$result = mysql_query ( $query ) or die ( "Could not execute query".$query );
	$row = mysql_fetch_array ( $result );
	extract ( $row );

	$comname = $cname;
	$comid = $cid;
	$comimg = $img;
	
	$html .= '<TR><TD colspan="3"><IMG src="images/'.$img.'" width = "50" title="'.$cname.'"/> <B>Preturi ';
	$html .= $comname;
	$html .= ' ' . $scity . ', ' . $saddress . '</B></td></tr>';
	
	echo $html;
}	

?>



<?php 
// Fetch all categories
$query = "select * from category";
$result = mysql_query ( $query ) or die ( "Could not execute query ".$query );
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
function print_tree2($tree, $prefix, $spaces, $sid, $comimg) {
	if (count ( $tree ) > 0) {
		$index = 0;
		foreach ( $tree as $node ) {
			?>
		<tr id="table1<?php echo $prefix?>_<?php echo $index ?>">
			<td><?php echo $spaces ?><img src="images/folder_green_open.png" class="button" alt="" width="16" height="16" /><a href="#"
				onclick="treetable_toggleRow('table1<?php echo $prefix?>_<?php echo $index ?>');"><?php print(htmlspecialchars($node['category']['name'])); ?></a></td>
			<td></td>
			<td></td>
		</tr>
<?php

$query = "
select *, p.id pid, p.name pname, b.name bname, p.qty_um qty, p.um um, pri.value price, lmp.value minprice, s2.id minstore_id, c2.img minstore_img, c2.name minstore_name
from vw_lastprices pri, store s, product p, brand b, vw_lastminprices2 lmp, store s2, commerciant c2
where s.id=".$sid." 
and pri.store_id = s.id 
and p.id=pri.product_id 
and p.category_id=". $node ['category'] ['id'] .
" and b.id = p.brand_id
and lmp.product_id = pri.product_id
and lmp.store_id = s2.id
and s2.commerciant_id = c2.id
						";
			//echo $query;
			$result = mysql_query ( $query ) or die ( "Could not execute query ".$query );
			$indexCat = 0;
			while ( $row = mysql_fetch_array ( $result ) ) {
				extract ( $row );
				?>
		<tr
			id="table1<?php echo $prefix?>_<?php echo $index ?>_<?php echo $indexCat ?>">
			<td><?php echo $spaces.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' ?><a href="detaliiProdus.php?id=<?php echo $pid?>"><?php print(htmlspecialchars($pname.' '.$bname.' '.$qty.' '.$um)); ?></a></td>
			<td>
				<B><?php echo number_format(floor($price), 0, '.', '') ?></B><SUP><?php echo substr(number_format($price - floor($price), 2, '', ''), 1)?></SUP>
			</td>
			<td>
				<?php
				  if ($price == $minprice)
				  { 
				?>				
				<IMG src="images/<?php echo $comimg; ?>" width = "50" title="Cel mai bun pret aici"/> Cel mai bun pret aici !
				<?php
				  } else {
					$diff = 100.0*(($price-$minprice)/$minprice);
				?>	
				<A href="preturiSupermarket2.php?sid=<?php echo $minstore_id?>"><IMG src="images/<?php echo $minstore_img; ?>" width = "50" title="<?php echo $minstore_name ?>"/></A> 
				<B><?php echo number_format(floor($minprice), 0, '.', '') ?></B><SUP><?php echo substr(number_format($minprice - floor($minprice), 2, '', ''), 1)?></SUP>
				(Cu <?php echo number_format($diff, 2) ?>% mai ieftin la <?php echo $minstore_name ?>)			
				<?php
				  } 
				?>				
				</td>
			</tr>
	<?php
				$indexCat++;
			}
			
			// the recursive thing
			print_tree2 ( $node ['children'], '_' . $index, $spaces . '&nbsp;&nbsp;&nbsp;&nbsp;', $sid, $comimg);
			$index ++;
		}
	}
}

$tree = build_tree ( $roles );
print_tree2 ( $tree, '', '', $sid, $comimg );
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

