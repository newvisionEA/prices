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
    $("#cancel").show(0);
    $("#luser").focus();
    $("#luser").select();
});
  $("#signin").click(function(){
	    $("#signindiv").show(100);
	    $("#logindiv").hide(100);
	    $("#cancel").show(0);
	    $("#suser").focus();
	    $("#suser").select();
});
  $("#cancel").click(function(){
	    $("#logindiv").hide(100);
	    $("#signindiv").hide(100);
	    $("#cancel").hide(0);
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
<TD><INPUT type="password" name="pass"></INPUT>
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
<TD><INPUT type="password" name="pass"></INPUT>
</TD>
</TR>
<TR>
<TD>Confirma parola
</TD>
<TD><INPUT type="password" name="passconf"></INPUT>
</TD>
</TR>
</TABLE>
</div>
<button id="login">Login</button>
<button id="signin">Inregistrare</button>
<button id="cancel">Inapoi</button>
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
     <li class=''last><a href='contribuie.php'><span>Contribuie</span></a></li>
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
					
					
					<div id="modal" class="popupContainer" style="display:none;">
	<header class="popupHeader">
		<span class="header_title">Login</span>
		<span class="modal_close"><i class="fa fa-times"></i></span>
	</header>

    <section class="popupBody">
<div class="user_login">
    <form>
        <label>Email / Username</label> <input type="text"><br>
        <label>Password</label> <input type="password"><br>

        <div class="checkbox">
            <input id="remember" type="checkbox"> <label for=
            "remember">Remember me on this computer</label>
        </div>

        <div class="action_btns">
            <div class="one_half">
                <a class="btn back_btn" href="#">Back</a>
            </div>

            <div class="one_half last">
                <a class="btn btn_red" href="#">Login</a>
            </div>
        </div>
    </form>
    
    <a class="forgot_password" href="#">Forgot password?</a>
</div>


<div class="user_register">
    <form>
        <label>Full Name</label> <input type="text"><br>
        <label>Email Address</label> <input type="email"><br>
        <label>Password</label> <input type="password"><br>

        <div class="checkbox">
            <input id="send_updates" type="checkbox"> <label for=
            "send_updates">Send me occasional email updates</label>
        </div>

        <div class="action_btns">
            <div class="one_half">
                <a class="btn back_btn" href="#">Back</a>
            </div>

            <div class="one_half last">
                <a class="btn btn_red" href="#">Register</a>
            </div>
        </div>
    </form>
</div>    
		<div class="social_login" style="display:none;">
		
		    <div class="centeredText">
		        <span>Or use your Email address</span>
		    </div>
		
		    <div class="action_btns">
		        <div class="one_half">
		            <a class="btn" href="#" id="login_form" name="login_form">Login</a>
		        </div>
		
		        <div class="one_half last">
		            <a class="btn" href="#" id="register_form" name=
		            "register_form">Sign up</a>
		        </div>
		    </div>
		</div>
    </section>
</div>





<script>
$("#modal_trigger").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });

$(function () {
    // Calling Login Form
    $("#login_form").click(function () {
        $(".social_login").hide();
        $(".user_login").show();
        return false;
    });

    // Calling Register Form
    $("#register_form").click(function () {
        $(".social_login").hide();
        $(".user_register").show();
        $(".header_title").text('Register');
        return false;
    });

    // Going back to Social Forms
    $(".back_btn").click(function () {
        $(".user_login").hide();
        $(".user_register").hide();
        $(".social_login").show();
        $(".header_title").text('Login');
        return false;
    });

})
</script>