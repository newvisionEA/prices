<HTML><body>
<form method="post" name="contact_form"
action="addProductHandler.php">
 
    <BR/>Categorie:
    
    <?php
require 'db.php';

$query = "select * from category order by name";

$result = mysql_query($query) or die ("Could not execute query");


	$rssfeed = '<select name="category">';

	while($row = mysql_fetch_array($result)) {
	extract($row);

	$rssfeed .= '<option value="'.$id.'">'.$name;
	$rssfeed .= '</option>';
}
$rssfeed .= '</select>';

mysql_close($connection);
echo $rssfeed;
?>

	     <BR/>Brand:
    
    <?php
require 'db.php';

$query = "select * from brand order by name";

$result = mysql_query($query) or die ("Could not execute query");


	$rssfeed = '<select name="brand">';

	while($row = mysql_fetch_array($result)) {
	extract($row);

	$rssfeed .= '<option value="'.$id.'">'.$name;
	$rssfeed .= '</option>';
}
$rssfeed .= '</select>';

mysql_close($connection);
echo $rssfeed;
?>

    <BR/>Name:
    <input type="text" name="name" size="20"/>
        
    <BR/>UM:
    <input type="text" name="um" size="20"/>

    <BR/>Ref UM:
    <input type="text" name="refum" size="20"/>
    
    <BR/>Qty UM:
    <input type="text" name="qtyum" size="20"/>
    
	     <BR/>Pack id:
    
    <?php
require 'db.php';

$query = "select * from product";

$result = mysql_query($query) or die ("Could not execute query");


	$rssfeed = '<select name="packid">';
	$rssfeed .= '<option value="0">';
	$rssfeed .= '</option>';
	while($row = mysql_fetch_array($result)) {
	extract($row);

	$rssfeed .= '<option value="'.$id.'">'.$name;
	$rssfeed .= '</option>';
}
$rssfeed .= '</select>';

mysql_close($connection);
echo $rssfeed;
?>
   
    <BR/>
    <input type="submit" value="Submit">
</form>   
<A href="index.php">Main menu</A>
</body></HTML>