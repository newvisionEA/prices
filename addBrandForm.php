<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']!="rveina2@gmail.com") {
	echo "Invalid rights";
	exit();
} 
?>
<HTML><body>
<form method="post" name="contact_form"
action="addBrandHandler.php">
 
    <BR/>Brand:
    
    
    <input type="text" name="brand" size="20"/>
     
     <BR/>
    <input type="submit" value="Submit">
</form>   
<A href="index.php">Main menu</A>
</body></HTML>