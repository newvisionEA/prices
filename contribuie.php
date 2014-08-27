<HTML>
<?php require 'menu.php'?>
						<td class="content">

<form method="post" name="contact_form"
action="addPriceHandler.php">
 
    
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
    <input type="text" name="date" size="20" value="<?php echo date('Y.m.d')?> 12:00"/>
    
    <BR/>
    <input type="submit" value="Submit">
</form>   
</body></HTML>