<?php 
$search = $_POST['search'];
?>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1"/>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/menustyles.css" rel="stylesheet" type="text/css">
<script type='text/javascript' src='js/jquery.min.js'></script>
<script type='text/javascript' src='js/menu_jquery.js'></script>
<script type="text/javascript" src="js/treetable.js"></script>
<script type="text/javascript" src="js/script.js"></script>

<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="css/popupstyle.css" />

<script type="text/javascript">
	treetable_callbacks['eventRowStateChanged'] = 'treetable_eventRowChanged';
</script>

<script>
	$(document).ready(function(){
	  $("#login").click(function(){
	    $("#logindiv").show(100);
	    $("#signindiv").hide(100);
	    $("#oklogin").show(0);
	    $("#signin").hide(0);
	    $("#login").hide(0);
	    $("#cancel").show(0);
	    $("#luser").focus();
	    $("#luser").select();
	});
		
  $("#signin").click(function(){
	    $("#logindiv").hide(100);
	    $("#signindiv").show(100);
	    $("#oksignin").show(0);
	    $("#signin").hide(0);
	    $("#login").hide(0);
	    $("#cancel").show(0);
	    $("#suser").focus();
	    $("#suser").select();
});
  $("#cancel").click(function(){
	    $("#logindiv").hide(100);
	    $("#signindiv").hide(100);
	    $("#oklogin").hide(0);
	    $("#oksignin").hide(0);
	    $("#cancel").hide(0);
	    $("#signin").show(0);
	    $("#login").show(0);
});

	  $("#oksignin").click(function(){
		  $.post( "signin.php", { email: $( "#suser" ).val(), pass: $( "#spass" ).val() })
		  .done(function( data ) {
			    $("#logindiv").hide(100);
			    $("#signindiv").hide(100);
			    $("#oksignin").hide(0);
			    $("#cancel").hide(0);
			    $("#userdiv").text(data);
			    $("#userdiv").show(0);
			    
			    if (data.indexOf("ERROR") == 1) {
				    $("#signin").show(0);
				    $("#login").show(0);
				    setTimeout( function(){
					        $('#userdiv').fadeOut();			    	        
					    }, 2000);
				    }		    			    
			});
		});

	  $("#oklogin").click(function(){
		  $.post( "login.php", { email: $( "#luser" ).val(), pass: $( "#lpass" ).val() })
		  .done(function( data ) {
			    $("#logindiv").hide(100);
			    $("#signindiv").hide(100);
			    $("#oklogin").hide(0);
			    $("#cancel").hide(0);
			    
			    if (data.indexOf("ERROR") == 1) {
				    $("#userdiv").text(data);
				    $("#userdiv").show(0);
			        $("#signin").show(0);
				    $("#login").show(0);
				    setTimeout( function(){
					        $('#userdiv').fadeOut();			    	        
					    }, 2000);
				    }	else {
				    	$('#autdiv').html('Esti autentificat ca <B>'+data+'</B>. <A href="logout.php">Iesire</A>');
				    }	    			    
			});
		});		
  });
</script>

</HEAD>

<BODY>
	<TABLE WIDTH="1010" BORDER="0" align="center" CELLPADDING="0"
		CELLSPACING="0" ID="Table_01">
		<TR>
			<TD WIDTH="4" ROWSPAN="5" BGCOLOR="#124989"><IMG
				SRC="images/spacer.gif" WIDTH="4" HEIGHT="200" ALT="" /></TD>
			<TD WIDTH="1000" HEIGHT="10" class="companyname2">
				<table BORDER="0">
					<tr>		
						<td width="200" align="left">
				<div id="autdiv">
						<?php			
			if (isset($_SESSION['user'])) {
			?>
				Esti autentificat ca <B><?php echo $_SESSION['user'] ?></B>. <A href="logout.php">Iesire</A>
				<?php 
			} else {
		?>
</div>
<div id="userdiv">
</div>						
<div id="logindiv" >
<TABLE>
<TR>
<TD>Email
</TD>
<TD><INPUT type="text" name="user" id="luser"></INPUT>
</TD>
</TR>
<TR>
<TD>Parola
</TD>
<TD><INPUT type="password" id="lpass"></INPUT>
</TD>
</TR>
</TABLE>
</div>
<div id="signindiv" >
<TABLE>
<TR>
<TD>Email
</TD>
<TD><INPUT type="text" name="user" id="suser"></INPUT>
</TD>
</TR>
<TR>
<TD>Parola
</TD>
<TD><INPUT type="password" id="spass"></INPUT>
</TD>
</TR>
<TR>
<TD>Confirma parola
</TD>
<TD><INPUT type="password" id="spassconf"></INPUT>
</TD>
</TR>
</TABLE>
</div>
<button id="oklogin">OK</button>
<button id="oksignin">OK</button>
<button id="login">Login</button>
<button id="signin">Inregistrare</button>
<button id="cancel">Inapoi</button>
<?php  } ?>
</td>
<FORM action="search.php" method="POST">			
					<td width="800" align="right">     <input type="text" class="tftextinput" name="search" size="15" maxlength="120"><input type="submit" value="Cauta" class="tfbutton">
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
     <li class=''><a href='orase.php'><span>Orase</span></a></li>
     <li class=''><a href='supermarketuri.php'><span>Supermarketuri</span></a></li>
     <li class=''><a href='produse.php'><span>Preturi</span></a></li>
	<?php			
			if (isset($_SESSION['user'])) {
	?>
     <li class=''last><a href='contribuie.php'><span>Contribuie</span></a></li>
	<?php 
			}
	?>    
     
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
					
					
