<?php 
session_start(); 
?>

<HTML>
<HEAD>
<link href="css/mobile.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<script type='text/javascript' src='js/jquery.min.js'></script>
<script type='text/javascript' src='js/menu_jquery.js'></script>
<script type="text/javascript" src="js/treetable.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</HEAD>
<BODY>
<?php include_once("analyticstracking.php") ?>
<table>
<tr>
<td id="table1">

	<?php			
			if (isset($_SESSION['user'])) {
	?>
	  Esti autentificat ca <?php echo ($_SESSION['user'])?>.
	  <FORM method="POST" action="mob_logout.php">
	  <INPUT type="submit" value="Logout"/>
	  </FORM>
	<?php 
			} else {
	?>
	<FORM method="POST" action="mob_login.php">
	
	<TABLE id="table1">
	<TR>
	<TD>Email</TD>
	</TR>
	<TR>
	<TD><INPUT type="text" name="email"/></TD>
	</TR>
	<TR>
	<TD>Password</TD>
	</TR>
	<TR>
	<TD><INPUT type="password" name="pass"/></TD>
	</TR>
	<TR>
	<TD><INPUT type="submit" value="Login"/></TD>
	</TR>
	</TABLE>
	
	</FORM>
	<HR/>
	
	<FORM method="POST" action="mob_signin.php">
	
	<TABLE id="table1">
	<TR>
	<TD>Email</TD>
	</TR>
	<TR>
	<TD><INPUT type="text" name="email"/></TD>
	</TR>
	<TR>
	<TD>Password</TD>
	</TR>
	<TR>
	<TD><INPUT type="password" name="pass"/></TD>
	</TR>
	<TR>
	<TD>Confirm password</TD>
	</TR>
	<TR>
	<TD><INPUT type="password" name="cpass"/></TD>
	</TR>
	<TR>
	<TD><INPUT type="submit" value="Signin"/></TD>
	</TR>
	</TABLE>
	
	</FORM>
	
<?php 
			} 			
?>    							
	
</form> 
<?php
require 'mob_menu.php'; 
?>  
</td></tr></table>
</body>
</HTML>