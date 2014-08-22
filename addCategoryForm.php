<HTML><body>
<form method="post" name="contact_form"
action="addCategoryHandler.php">
 
    <BR/>Categorie parinte:
    
    <?php
require 'db.php';

$query = "select * from category where parent_id = 0";

$result = mysql_query($query) or die ("Could not execute query");


	$rssfeed = '<select name="category">';
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

	 
    <BR/>Nume:
    <input type="text" name="name" size="20"/>
        
     <BR/>
    <input type="submit" value="Submit">
</form>   
<A href="index.php">Main menu</A>
</body></HTML>