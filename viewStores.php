<?php 
require 'admin.php';

?>


<TABLE class="content" border="1" cellpadding="3">
<?php
	require 'db.php';
	 	
		$query = "select c.name cname, ci.name city, address from store s, commerciant c, city ci where ci.id=s.city_id and s.commerciant_id = c.id"	  ;
	    $result = mysql_query($query) or die ("Could not execute query");
	
    
	    while($row = mysql_fetch_array($result)) {
	        extract($row);
	
	        $rssfeed .= '<tr><td>';
	        $rssfeed .= $cname;
	        $rssfeed .= '</td>';
	        $rssfeed .= '<td>';
	        $rssfeed .= $city;
	        $rssfeed .= '</td>';
	        $rssfeed .= '<td>';
	        $rssfeed .= $address;
	        $rssfeed .= '</td>';
	        $rssfeed .= '</tr>';
	    }
	
	    echo $rssfeed;
?>
</TABLE>
<BR/>
<?php 
require 'admin.php';
?>
