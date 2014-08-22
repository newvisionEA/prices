<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>--</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
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
				<table width="687" border="0" align="center" cellpadding="0"
					cellspacing="0">
					<tr>
						<td class="content">
							<TABLE id="prod" border="0" cellpadding="2">
<?php
require 'db.php';

$cid = isset ( $_GET ['cid'] ) ? $_GET ['cid'] : null;
$sid = isset ( $_GET ['sid'] ) ? $_GET ['sid'] : null;

if ($sid != null) {
	$query = "select c.name cname, c.id cid, s.city scity, s.address saddress from commerciant c, store s where c.id=s.commerciant_id and s.id = " . $sid;
	$result = mysql_query ( $query ) or die ( "Could not execute query" );
	$row = mysql_fetch_array ( $result );
	extract ( $row );
	
	$query = "select c.name cname, c.id cid from commerciant c, store s where c.id=s.commerciant_id and s.id = " . $sid;
	$result = mysql_query ( $query ) or die ( "Could not execute query" );
	$row = mysql_fetch_array ( $result );
	extract ( $row );
	
	$comname = $cname;
	$comid = $cid;
	
	$html .= '<TR><TD><B>Preturi ' . $cname . ' ' . $scity . ', ' . $saddress . '</B></td></tr>';
	
	$query = "select c.name maincatname, c.id maincatid from category c where parent_id=0";
	$result = mysql_query ( $query ) or die ( "Could not execute query" );
	
	while ( $row = mysql_fetch_array ( $result ) ) {
		extract ( $row );
		
		$firstCat = false;
		$query2 = "select name catname, id catid from category where parent_id = " . $maincatid;
		// echo $query2;
		$result2 = mysql_query ( $query2 ) or die ( "Could not execute query" );
		// subcategorii
		while ( $row2 = mysql_fetch_array ( $result2 ) ) {
			
			if (! $firstCat) {
				$html .= '<TR><TD>' . $maincatname . '</td></tr>';
				$firstCat = true;
			}
			
			extract ( $row2 );
			
			// $query3 = "select p.id pid, p.name pname, b.name bname, p.qty_um qty, p.um um, pri.value val,
			// (
			// SELECT MIN( value )
			// FROM price
			// WHERE product_id = p.id
			// ) pmin
			// from product p, brand b, price pri where b.id=p.brand_id and pri.product_id=p.id and pri.store_id=".$sid.' and p.category_id = '.$catid;
			
			$query3 = "select p.id pid, p.name pname, b.name bname, p.qty_um qty, p.um um, pri.value val,
			(
			SELECT MIN( value )
			FROM price
			WHERE product_id = p.id
			) pmin
			from product p, brand b, price pri, store s where s.commerciant_id=" . $comid . " and 
			pri.store_id =s.id and b.id=p.brand_id and pri.product_id=p.id and p.category_id=" . $catid . " group by p.id";
			// echo $query3.'<br/>';
			$result3 = mysql_query ( $query3 ) or die ( "Could not execute query " . $query3 );
			
			$firstPrice = false;
			// echo '!1';
			while ( $row3 = mysql_fetch_array ( $result3 ) ) {
				// echo '!2';
				if (! $firstPrice) {
					$html .= '<TR><TD>' . $catname . '</td></tr>';
					$firstPrice = true;
				}
				
				extract ( $row3 );
				
				// echo $pname;
				$html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="detaliiProdus.php?id=' . $pid . '">';
				$html .= $pname . ' ' . $bname . ' ' . $qty . ' ' . $um;
				$html .= '</a></td>';
				$html .= '<td>';
				$html .= number_format ( floor ( $val ), 0, '.', '' );
				$html .= '<SUP>' . substr ( number_format ( $val - floor ( $val ), 2, '', '' ), 1 ) . '</SUP>';
				
				if ($pmin < $val) {
					$html .= '<td>';
					
					$query4 = "select c.name xname from price pri, store s, commerciant c where pri.store_id = s.id and s.commerciant_id = c.id and pri.value = " . $pmin;
					$result4 = mysql_query ( $query4 ) or die ( "Could not execute query " . $query4 );
					$row4 = mysql_fetch_array ( $result4 );
					extract ( $row4 );
					
					$html .= 'mai ieftin cu ' . number_format ( ($val - $pmin) / $pmin * 100, 0, '.', '' ) . '% la ' . $xname . ' (';
					$html .= number_format ( floor ( $pmin ), 0, '.', '' );
					$html .= '<SUP>' . substr ( number_format ( $pmin - floor ( $pmin ), 2, '', '' ), 1 ) . '</SUP>)';
					$html .= '</td>';
				} else {
					$html .= '<td><IMG src="images/lightbulb.png" height = "20" width = "20" title="Cel mai bun pret"/></td>';
				}
				// echo '!3';
				$html .= '</td>';
				$html .= '</tr>';
			}
		}
	}
}

echo $html;

?>
</TABLE>
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

