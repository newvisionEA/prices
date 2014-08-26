<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>Preturi supermarket</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1"/>
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
							<TABLE id = "prod" border="0" cellpadding="2">
<?php
require 'db.php';

$cid = isset($_GET['cid']) ? $_GET['cid'] : null;
$sid = isset($_GET['sid']) ? $_GET['sid'] : null;

if ($cid == null && $sid == null)
{
	$query = "select c.name cname, c.img img, c.id cid from commerciant c where c.type=1 or c.type = 2 order by c.name";
	$result = mysql_query($query) or die ("Could not execute query");
	
	while($row = mysql_fetch_array($result)) {
		extract($row);
	
		$html .= '<tr><td><a href="preturiSupermarket.php?cid='.$cid.'">Preturi ';
		$html .= '<IMG src="images/'.$img.'" height = "20" title="'.$cname.'"/>';
		$html .= '</a></td>';
		$html .= '</tr>';
	}
}
else if ($cid != null) {
	$query = "select * from commerciant c where id = ".$cid;
	$result = mysql_query($query) or die ("Could not execute query");
	$row = mysql_fetch_array($result);
	extract($row);
		
	$comname = $name;
	
	$query = "select s.city, s.address, s.id sid from store s where commerciant_id = ".$cid;
	$result = mysql_query($query) or die ("Could not execute query");
	while($row = mysql_fetch_array($result)) {
		extract($row);
	
		$html .= '<tr><td><a href="preturiSupermarket2.php?sid='.$sid.'">Preturi ';
		//$html .= '<IMG src="images/'.$img.'" height = "20" title="'.$cname.'"/>';		
		$html .= $comname.' '.$city.' '.$address;
		$html .= '</a></td>';
		$html .= '</tr>';
	}
} else if ($sid != null) {
	$query = "select c.name cname, c.id cid from commerciant c, store s where c.id=s.commerciant_id and s.id = ".$sid;
	$result = mysql_query($query) or die ("Could not execute query");
	$row = mysql_fetch_array($result);
	extract($row);
	
	$comname = $cname;
	$comid = $cid;
	
	$queryCat = "select c.name cname, c.id catid, s.commerciant_id comid from product p, price pri, store s, category c, commerciant com where c.id = p.category_id and com.id = s.commerciant_id and pri.product_id = p.id and s.id = pri.store_id and com.id = ".$comid;
	
	$resultCat = mysql_query($queryCat) or die ("Could not execute query ".$queryCat);
	while($rowCat = mysql_fetch_array($resultCat)) {
		extract($rowCat);
		$html .= '<TR><TD>'.$cname.'</TD></TR>';
	
		$query = "select p.id pid, p.name pname, b.name bname, p.qty_um qty, p.um um, pri.value val, 
			(
			SELECT MIN( value )
			FROM price
			WHERE product_id = p.id
			) pmin 
		from product p, brand b, price pri where b.id=p.brand_id and pri.product_id=p.id and pri.store_id=".$sid.' and p.category_id = '.$catid;
	
		$result = mysql_query($query) or die ("Could not execute query ".$query);
		while($row = mysql_fetch_array($result)) {
			extract($row);
		
			$html .= '<tr><td><a href="detaliiProdus.php?id='.$pid.'">';
			$html .= $pname.' '.$bname.' '.$qty.' '.$um;
			$html .= '</a></td>';
			$html .= '<td>';
			$html .= number_format(floor($val), 0, '.', '');
			$html .= '<SUP>'.substr(number_format($val - floor($val), 2, '', ''), 1).'</SUP>';
			
			if ($pmin < $val) {
				$html .= '<td>';
				
				$query2 = "select c.name xname from price pri, store s, commerciant c where pri.store_id = s.id and s.commerciant_id = c.id and pri.value = ".$pmin;
				$result2 = mysql_query($query2) or die ("Could not execute query ".$query2);
				$row2 = mysql_fetch_array($result2);
				extract($row2);
				
				$html .= 'mai ieftin cu '.number_format(($val-$pmin)/$pmin*100, 0, '.', '').'% la '.$xname.' (';
				$html .= number_format(floor($pmin), 0, '.', '');
				$html .= '<SUP>'.substr(number_format($pmin - floor($pmin), 2, '', ''), 1).'</SUP>)';
				$html .= '</td>';
			} else {
				$html .= '<td>';
				$html .= 'cel mai ieftin aici';
				$html .= '</td>';		
			}
			$html .= '</td>';
			$html .= '</tr>';
		}
		
		$html .= '<TR><TD>Alte magazine '.$comname.'</TD></TR>';
		
		$query = "select p.id pid, p.name pname, b.name bname, p.qty_um qty, p.um um, pri.value val,
			(
			SELECT MIN( value )
			FROM price
			WHERE product_id = p.id
			) pmin
		from product p, brand b, price pri, store s where pri.store_id=s.id and b.id=p.brand_id and pri.product_id=p.id and s.commerciant_id = ".$comid." and s.id != ".$sid.' and p.category_id = '.$catid;

		//echo $query;
		$result = mysql_query($query) or die ("Could not execute query ".$query);
		while($row = mysql_fetch_array($result)) {
			extract($row);
		
			$html .= '<tr><td><a href="detaliiProdus.php?id='.$pid.'">';
			$html .= $pname.' '.$bname.' '.$qty.' '.$um;
			$html .= '</a></td>';
			$html .= '<td>';
			$html .= number_format(floor($val), 0, '.', '');
			$html .= '<SUP>'.substr(number_format($val - floor($val), 2, '', ''), 1).'</SUP>';
				
			if ($pmin < $val) {
				$html .= '<td>';
		
				$query2 = "select c.name xname from price pri, store s, commerciant c where pri.store_id = s.id and s.commerciant_id = c.id and pri.value = ".$pmin;
				$result2 = mysql_query($query2) or die ("Could not execute query ".$query2);
				$row2 = mysql_fetch_array($result2);
				extract($row2);
		
				$html .= 'mai ieftin cu '.number_format(($val-$pmin)/$pmin*100, 0, '.', '').'% la '.$xname.' (';
				$html .= number_format(floor($pmin), 0, '.', '');
				$html .= '<SUP>'.substr(number_format($pmin - floor($pmin), 2, '', ''), 1).'</SUP>)';
				$html .= '</td>';
			} else {
				$html .= '<td>';
				$html .= 'cel mai ieftin aici';
				$html .= '</td>';
			}
			$html .= '</td>';
			$html .= '</tr>';
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

