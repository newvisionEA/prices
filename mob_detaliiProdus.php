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
<BODY>
<?php include_once("analyticstracking.php") ?>
    <TABLE id="table1"  border="0" cellpadding="3">

<?php
$id = $_GET ['id'];

require 'db.php';

$query = "
		SELECT 
			p.pack_id packid, p.id pid, p.name pname, b.name bname, qty_um, um, c.name cname, 
			c.img cimg, ci.name city, s.address adr, pri.value pval, p.month_stock pms, pri.rdate rdate, 
			( 
				SELECT MIN( value ) 
				FROM price 
				WHERE product_id =".$id." ) pmin, 
			conv.factor factor, refum	
		FROM 
			product p, brand b, price pri, store s, commerciant c, conversions conv, city ci
		WHERE p.brand_id = b.id 
			AND pri.product_id = p.id 
			AND pri.store_id = s.id 
			AND ci.id = s.city_id
			AND c.id = s.commerciant_id 
			AND lower(conv.from_um) = lower(p.um) 
			AND lower(conv.to_um) = lower(p.refum) 
			AND p.id=".$id." order by pval
";

$result = mysql_query ( $query ) or die ( "Could not execute query ".$query );

$rowindex = 0;

while ( $row = mysql_fetch_array ( $result ) ) {
	extract ( $row );
	
	if ($rowindex == 0) {
		$output .= '<tr><td colspan="5"><B><A href="mob_detaliiProdus.php?id='.$pid.'"> '.$pname.' '.$bname.' '.$qty_um.' '.$um.'</A></B></td></tr>';
		$rowindex ++;
	}
	
	$output .= '<tr>';
	$output .= '<td><B>';
	$output .= number_format ( floor ( $pval ), 0, '.', '' );
	$output .= '</B><SUP>'.substr ( number_format ( $pval - floor ( $pval ), 2, '', '' ), 1 ).'</SUP>';
	$output .= 'Lei</td>';
	
	if ($packid == 0) {
		$xval = $pval / ($qty_um / $factor);
		$output .= '<td><B>';
		$output .= number_format ( floor ( $xval ), 0, '.', '' );
		$output .= '</B><SUP>'.substr ( number_format ( $xval - floor ( $xval ), 2, '', '' ), 1 ).'</SUP>';
		$output .= 'Lei/'.$refum.'</td>';
	} else {
		$queryPack = "
				select conv.factor factor2, qty_um qty_um_pack, um umpack, refum 
				FROM product p, conversions conv 
				WHERE id=".$packid.'
				AND conv.from_um = p.um
				AND conv.to_um = p.refum';
		
		$resultPack = mysql_query ( $queryPack ) or die ( "Could not execute query" );
		$rowPack = mysql_fetch_array ( $resultPack );
		extract ( $rowPack );
		$output .= '<td>'.number_format ( $pval / ($qty_um_pack * $qty_um / $factor2), 2, '.', '' ).'RON/'.$refum.'</td>';
	}
	
	$output .= '<td><IMG src="images/'.$cimg.'" width = "50" title="'.$cname.'"/> '.$city.', '.$adr.'</td>';
	
	if ($pval > $pmin) {
		$temp = ($pval - $pmin) * $pms;
		$output .= '<td>cu '.number_format ( ($pval / $pmin * 100 - 100), 2, '.', '' ).'% mai scump</td>';
		//$output .= '<td>platesti cu '.number_format ( floor ( $temp ), 0, '.', '' ).'</B><SUP>'.substr ( number_format ( $temp - floor ( $temp ), 2, '', '' ), 1 ).'</SUP>'.' Lei mai mult pe luna</td>';
	} else {
		$output .= '<td><IMG src="images/lightbulb.png" height = "20" width = "20" title="Cel mai bun pret"/>Cel mai bun pret !</td>';
	}
	$output .= "<td class='greytext'>(la ".date('d.m.Y H:i', strtotime($rdate)).")</td>";
	$output .= '</tr>';
}

echo $output;
?>
							</TABLE>
						<BR/>	
    <TABLE id="table1"  border="0" cellpadding="3">
    <TR>
    <TD><B>
    Istoric preturi</B>
    </TD>
    </TR>
<?php 

$query = "select *,  ci.name ciname from price_hist p, store s, commerciant c, city ci 
where c.id=s.commerciant_id and p.store_id  = s.id and ci.id = s.city_id
and product_id=".$pid."
order by rdate desc";

$result = mysql_query ( $query ) or die ( "Could not execute query ".$query );

while ( $row = mysql_fetch_array ( $result ) ) {
	extract ( $row );
	?>
	<TR>
	<TD>
	<A href="mob_preturiSupermarket2.php?sid=<?php echo $store_id ?>" ><IMG src="images/<?php echo $img ?>" width="50"/></A> 
	<A href="mob_preturiSupermarket2.php?sid=<?php echo $store_id ?>" ><?php echo $ciname ?> <?php echo $address ?></A>
	</TD>
	<TD>
	<B><?php echo number_format(floor($value), 0, '.', '') ?></B><SUP><?php echo substr(number_format($value - floor($value), 2, '', ''), 1)?></SUP>
	</TD>
	<TD>
	<?php echo date('d.m.Y H:i', strtotime($rdate)) ?> 
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

