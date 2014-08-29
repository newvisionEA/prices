<?php session_start(); ?>

<HTML>
<HEAD>
<TITLE>Preturi supermarket - Contribuie si tu</TITLE>

<?php require 'menu.php'?>
						<td class="table1">

							<form method="post" name="contact_form" action="addPriceHandler.php">
	<?php			
			if (isset($_SESSION['user'])) {
	?>
 							     <BR/>Produs

<?php
require 'db.php';

$query = "select p.id id, p.name pname, b.name bname, p.qty_um qty, p.um um from product p, brand b where p.brand_id = b.id order by p.name";

$result = mysql_query($query) or die ("Could not execute query");

$rssfeed = '<select name="product">';

while($row = mysql_fetch_array($result)) {
	extract($row);

	$rssfeed .= '<option value="'.$id.'">'.$pname.' '.$bname.' '.$qty.$um;
	$rssfeed .= '</option>';
}
$rssfeed .= '</select>';

mysql_close($connection);
echo $rssfeed;
?>

	     						<BR/>Magazin    
<?php
require 'db.php';
$query = "select s.id sid, c.name cname, ci.name city, address 
		from store s, commerciant c, city ci  
		where ci.id = s.city_id 
		and s.commerciant_id = c.id";

$result = mysql_query($query) or die ("Could not execute query " .$query);

	$rssfeed = '<select name="store">';

	while($row = mysql_fetch_array($result)) {
	extract($row);

	$rssfeed .= '<option value="'.$sid.'">'.$cname.' '.$city.' '.$address;
	$rssfeed .= '</option>';
}
$rssfeed .= '</select>';

mysql_close($connection);
echo $rssfeed;
?>

       						<BR/>Pret
    						<input type="text" name="price" size="20"/>
    
           					<BR/>Data (yyyy.mm.dd hh:mm)
    						<input type="text" name="date" size="20" value="<?php echo date('d.m.Y H:i')?>"/>
    
						    <BR/>
						    <input type="submit" value="Submit">
	<?php 
			} else {
	?>
	<BR/>    							
	<div>Trebuie sa te autentifici pentru a contribui cu informatii la acest site. <BR/>
	Daca nu ai deja cont dureaza doar 10 secunde sa-ti faci unul.</div>
	<?php 
			} 
	?>    							
	
</form>   
</body>
</HTML>