<?php


?>
<HR/>
	<TABLE width="100%" cellspacing="0" id="tablemenu"> 

		<TR>
			<TD><A href="mob_topuri.php">Topuri</A></TD>
		</TR>
		<TR>
			<TD><A href="mob_orase.php">Orase</A></TD>
		</TR>
		<TR>
			<TD><A href="mob_supermarketuri.php">Supermarketuri</A></TD>
		</TR>
		<TR>
			<TD><A href="mob_produse.php">Preturi</A></TD>
		</TR>
		<TR>
			<TD><A href="mob_contribuie.php">Contribuie</A></TD>
		</TR>
		<TR>
			<TD><A href="mob_membri.php">Membri</A></TD>
		</TR>
     <?php 
		if (isset($_SESSION['user']) && $_SESSION['user']=="rveina2@gmail.com") {
	?>
	<TR>
			<TD><A href="admin.php">Admin</A></TD>
		</TR>
	<?php } ?>	
		</TABLE>		