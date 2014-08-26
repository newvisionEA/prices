<?php 
$search = $_POST['search'];
?>
<HEAD>
<TITLE>Preturi supermarket</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1"/>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menustyles.css" rel="stylesheet" type="text/css">
<script type='text/javascript' src='js/jquery.min.js'></script>
<script type='text/javascript' src='js/menu_jquery.js'></script>
<script type="text/javascript" src="js/treetable.js"></script>

<script type="text/javascript">

    treetable_callbacks['eventRowStateChanged'] = 'treetable_eventRowChanged';

    

    function treetable_eventRowChanged(rowId, state) {

      img = document.getElementById(rowId).getElementsByTagName('td')[0].getElementsByTagName('img')[0];

      if (state == 1) {

        img.src = 'images/folder_green_open.png';

      } else {

        img.src = 'images/folder_green.png';

      }

      return (true);

    }  

  </script>


</HEAD>


<BODY>
	<TABLE WIDTH="1010" BORDER="0" align="center" CELLPADDING="0"
		CELLSPACING="0" ID="Table_01">
		<TR>
			<TD WIDTH="4" ROWSPAN="5" BGCOLOR="#124989"><IMG
				SRC="images/spacer.gif" WIDTH="4" HEIGHT="300" ALT="" /></TD>
			<TD WIDTH="1000" HEIGHT="100" class="companyname2">
				<table BORDER="0">
					<tr><FORM action="search.php" method="POST">					
						<td width="1000" align="right">     <input type="text" class="tftextinput" name="search" size="15" maxlength="120"><input type="submit" value="Cauta" class="tfbutton">
						</td>
						</FORM>
					</tr>
				</table>
			</TD>
			<TD WIDTH="4" ROWSPAN="5" BGCOLOR="#124989"><IMG
				SRC="images/spacer.gif" WIDTH="4" HEIGHT="5" ALT="" /></TD>
		</TR>
		<TR><TD>


  <div id='cssmenu' class="rowMenu">
  <ul>
     <li class=''><a href='index.php'><span>Acasa</span></a></li>
     <li class=''><a href='preturiSupermarket.php'><span>Preturi</span></a></li>
     <li class='last'><a href='produse.php'><span>Produse</span></a></li>
     <!-- li class='last'><a href='contribuie.php'><span>Contribuie</span></a></li-->`
  </ul>
  </div> 
          
		</TD>		 
		</TR>
		<TR>
			<TD WIDTH="1000" HEIGHT="6" colspan="1"><IMG
				src="images/belowMenu.png" /></TD>
		</TR>
		<TR>
			<TD HEIGHT="1307" valign="top" bgcolor="#FFFFFF">
				<table width="900" border="0" align="center" cellpadding="0"
					cellspacing="0">
					<tr>