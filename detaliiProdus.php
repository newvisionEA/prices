<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>--</TITLE>
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
				<table width="987" border="0" align="center" cellpadding="0"
					cellspacing="0">
					<tr>
						<td class="content">
							<TABLE id="prod" border="0" cellpadding="2">


<?php
$id = $_GET['id'];
require 'db.php';

		$query = "SELECT p.pack_id packid, p.id pid, p.name pname, b.name bname, qty_um, um, c.name cname, c.img cimg, s.city city, pri.value pval, p.month_stock pms, 
		(
SELECT MIN( value ) 
FROM price
WHERE product_id =".$id."
) pmin, conv.factor factor, refum
		
FROM product p, brand b, price pri, store s, commerciant c, conversions conv
WHERE p.brand_id = b.id
AND pri.product_id = p.id
AND pri.store_id = s.id
and c.id = s.commerciant_id
and lower(conv.from_um) = lower(p.um)
and lower(conv.to_um) = lower(p.refum) 
AND p.id=".$id." order by pval";
		
	    $result = mysql_query($query) or die ("Could not execute query ".$query);
	
    
	    while($row = mysql_fetch_array($result)) {
	        extract($row);
	
	        $output .= '<tr>';
	        $output .= '<td><A href="detaliiProdus.php?id='.$pid.'"> '.$pname.' '.$bname.' '.$qty_um.' '.$um.'</A></td>';
	        $output .= '<td>';
	        $output .= number_format(floor($pval), 0, '.', '');
	        $output .= '<SUP>'.substr(number_format($pval - floor($pval), 2, '', ''), 1).'</SUP>';
	        $output .= 'Lei</td>';
	        if ($packid == 0){
				$xval = $pval/($qty_um/$factor);
		        $output .= '<td>';
		        $output .= number_format(floor($xval), 0, '.', '');
		        $output .= '<SUP>'.substr(number_format($xval - floor($xval), 2, '', ''), 1).'</SUP>';
		        $output .= 'Lei/'.$refum.'</td>';
			} else {
	        	$queryPack = "select conv.factor factor2, qty_um qty_um_pack, um umpack, refum from product p, conversions conv where id=".$packid.'
	        		and conv.from_um = p.um
					and conv.to_um = p.refum';
	        	echo $queryPack;
	        	$resultPack = mysql_query($queryPack) or die ("Could not execute query");
	        	$rowPack = mysql_fetch_array($resultPack);
	        	extract($rowPack);
	        	$output .= '<td>'.number_format($pval/($qty_um_pack * $qty_um / $factor2), 2, '.', '').'RON/'.$refum.'</td>';
	        		        }
	        $output .= '<td><IMG src="images/'.$cimg.'" height = "22" title="'. $cname.'"/></td>';
	        $output .= '<td>'.$city.'</td>';
	        if ($pval > $pmin) {
	          $output .= '<td>cu '.number_format(($pval/$pmin*100-100), 2, '.', '').'% mai scump</td>';
	          $output .= '<td>platesti cu '.number_format(($pval-$pmin)*$pms, 2, '.', '').' Lei mai mult pe luna</td>';
	        } else {
			  $output .= '<td><IMG src="images/lightbulb.png" height = "20" width = "20" title="Cel mai bun pret"/></td>';
			}
	        $output .= '</tr>';
	    }
	
	    echo $output;
?>
</TABLE>

