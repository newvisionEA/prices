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
				<table width="687" border="0" align="center" cellpadding="0"
					cellspacing="0">
					<tr>
						<td class="content">
							

<?php 
$search = $_POST['search'];

?>
<form method="post" name="contact_form"
action="search.php">

<input autofocus="autofocus" type="text" name="search" value="<?php echo $search;?>"/>

</form>

<TABLE id="prod" class="content" border="0" cellpadding="3">
<?php
	require 'db.php';

	if ($search != null) {	
		$query = "SELECT p.pack_id packid, p.id pid, p.name pname, b.name bname, qty_um, um, c.name cname, s.city city, pri.value pval
FROM product p, brand b, price pri, store s, commerciant c
WHERE p.brand_id = b.id
AND pri.product_id = p.id
AND pri.store_id = s.id
and c.id = s.commerciant_id
AND 
		(lower(b.name) like ('%".strtolower($search)."%')
		or lower(p.name) like ('%".strtolower($search)."%')			
		or lower(c.name) like ('%".strtolower($search)."%')			
		)
GROUP BY p.id";
	    $result = mysql_query($query) or die ("Could not execute query");
	
    
	    while($row = mysql_fetch_array($result)) {
	        extract($row);
	
				$queryMin = "select c.name minstore, a.pmin pmin from price p, store s, commerciant c, 
				(SELECT MIN( value ) pmin
				FROM price pri 
				where pri.product_id = ".$pid."
				) a
				where p.product_id = ".$pid." and p.value = a.pmin and p.store_id = s.id and s.commerciant_id = c.id";
				
			
				$resultMin = mysql_query($queryMin) or die ("Could not execute query ".$queryMin);
			$rowMin = mysql_fetch_array($resultMin);
			extract($rowMin);
	        
			$output .= '<tr>';
	        $output .= '<td><A href="detaliiProdus.php?id='.$pid.'"> '.$pname.' '.$bname.' '.$qty_um.' '.$um.'</A></td>';
			$output .= '<td>'.number_format(floor($pmin), 0, '.', '');
			$output .= '<SUP>'.substr(number_format($pmin - floor($pmin), 2, '', ''), 1).'</SUP>'.'</td>';
			

			
			if ($packid == 0){
				$queryPack = "select conv.factor factor2, qty_um qty_um_pack, um umpack, refum from product p, conversions conv where id=".$pid.'
								        		and conv.from_um = p.um
												and conv.to_um = p.refum';
				//			echo $queryPack;
				$resultPack = mysql_query($queryPack) or die ("Could not execute query ".$queryPack);
				$rowPack = mysql_fetch_array($resultPack);
				extract($rowPack);

				
				
				$xval = $pmin/($qty_um/$factor2);
				$output .= '<td>'.number_format(floor($xval), 0, '.', '');
				$output .= '<SUP>'.substr(number_format($xval - floor($xval), 2, '', ''), 1).'</SUP>';
				$output .= 'RON/'.$refum.'</td>'; 
				//$output .= '<td>'.number_format($pval/($qty_um/$factor2), 2, '.', '').'RON/'.$refum.'</td>';
	        } else {
				$queryPack = "select conv.factor factor2, qty_um qty_um_pack, um umpack, refum from product p, conversions conv where id=".$packid.'
								        		and conv.from_um = p.um
												and conv.to_um = p.refum';
				//			echo $queryPack;
				$resultPack = mysql_query($queryPack) or die ("Could not execute query");
				$rowPack = mysql_fetch_array($resultPack);
				extract($rowPack);
				$xval = $pmin/($qty_um_pack * $qty_um / $factor2);
				$output .= '<td>'.number_format(floor($xval), 0, '.', '');
				$output .= '<SUP>'.substr(number_format($xval - floor($xval), 2, '', ''), 1).'</SUP>';
				$output .= 'RON/'.$refum.'</td>'; 
	        }	        
	        
	        $output .= '<td>'.$minstore.'<IMG src="images/lightbulb.png" height = "20" width = "20" title="Cel mai bun pret"/></td>';
	        //$output .= '<td>'.$city.'</td>';
	        $output .= '</tr>';
	    }
	
	    echo $output;
	}
?>
</TABLE>
<BR/>
