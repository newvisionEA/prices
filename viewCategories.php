<?php 
require 'admin.php';

?>


<TABLE class="content" border="1" cellpadding="3">
<?php
	require 'db.php';
	 	
		$query = "select * from category where parent_id=0";
	    $result = mysql_query($query) or die ("Could not execute query");
	    
	    while($row = mysql_fetch_array($result)) {
	        extract($row);
	
	        $rssfeed .= '<tr><td><B>';
	        $rssfeed .= $name;
	        $rssfeed .= '</B></td>';
	        $rssfeed .= '</tr>';
	        
	        $query2 = "select name name2 from category where parent_id = ".$id;
	        $result2 = mysql_query($query2) or die ("Could not execute query");
	        while($row2 = mysql_fetch_array($result2)) {
	        	extract($row2);
	        	
	        	$rssfeed .= '<tr><td>';
	        	$rssfeed .= $name2;
	        	$rssfeed .= '</td>';
	        	$rssfeed .= '</tr>';
	        }
	    }
	
	    echo $rssfeed;
?>
</TABLE>
<BR/>
<?php 
require 'admin.php';
?>
