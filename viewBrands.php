<?php 
require 'menu.php';

?>


<TABLE class="content" border="1" cellpadding="3">
<?php
	require 'db.php';
	 	
		$query = "select * from brand";
	    $result = mysql_query($query) or die ("Could not execute query");
	
    
	    while($row = mysql_fetch_array($result)) {
	        extract($row);
	
	        $rssfeed .= '<tr><td>';
	        $rssfeed .= $name;
	        $rssfeed .= '</td>';
	        $rssfeed .= '</tr>';
	    }
	
	    echo $rssfeed;
?>
</TABLE>
<BR/>
<?php 
require 'menu.php';
?>
