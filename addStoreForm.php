<HTML><body>
<form method="post" name="contact_form"
action="addStoreHandler.php">
 
    <BR/>Comerciant:
    
    <?php
$id = $_POST['id']; 
$link = $_POST['link']; 
$description = $_POST['description'];
$title = $_POST['title'];

require 'db.php';

$query = "select * from commerciant";

$result = mysql_query($query) or die ("Could not execute query");


	$rssfeed = '<select name="comerciant">';
while($row = mysql_fetch_array($result)) {
	extract($row);

	$rssfeed .= '<option value="'.$id.'">'.$name;
	$rssfeed .= '</option>';
}
$rssfeed .= '</select>';


echo $rssfeed;
?>

	 
    <BR/>Oras:
    <?php 
    $query = "select * from city";
    $result = mysql_query($query) or die ("Could not execute query");
    $rssfeed = '<select name="oras">';
    while($row = mysql_fetch_array($result)) {
    	extract($row);
    
    	$rssfeed .= '<option value="'.$id.'">'.$name;
    	$rssfeed .= '</option>';
    }
    $rssfeed .= '</select>';
    
    
    echo $rssfeed;
    mysql_close($connection);
    ?>
    <BR/>Adresa: 
    <input type="text" name="adresa" size="20"/>
     
     <BR/>
    <input type="submit" value="Submit">
</form>   
<A href="index.php">Main menu</A>
</body></HTML>