<?
$msg="";
if(isset($_GET['msg']))
{
$msg=$_GET['msg'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript">
function chackform()
{	
if(document.loginForm.admin_user_name.value=="")
{
alert("Please Enter User Name.");
document.loginForm.admin_user_name.focus();
return false;
}
if(document.loginForm.password.value=="")
{
alert("Please Enter Password.");
document.loginForm.password.focus();
return false;
}
return true;
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Shotz7 </title>
<!--CSS-->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
<!-- Colour Schemes
Default colour scheme is green. Uncomment prefered stylesheet to use it.
<link rel="stylesheet" href="resources/css/blue.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/red.css" type="text/css" media="screen" />  
-->
<!-- Internet Explorer Fixes Stylesheet -->
<!--[if lte IE 7]>
<link rel="stylesheet" href="resources/css/ie.css" type="text/css" media="screen" />
<![endif]-->
<!--Javascripts-->
<!-- jQuery -->
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<!-- Internet Explorer .png-fix -->
<!--[if IE 6]>
<script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
<script type="text/javascript">
	DD_belatedPNG.fix('.png_bg, img, li');
</script>
<![endif]-->
</head>
<body id="login">
<div id="login-wrapper" class="png_bg">
<div id="login-top">
<h1>Admin panel</h1>
<!-- Logo (221px width) -->
<!--
	<img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" />
	-->
<b style='font-size:25px;'> Administration Panel </b> </div>
<!-- End #logn-top -->
<div id="login-content">
<form name="loginForm" method="post" action="varifyUser.php">
<?php if(isset($_REQUEST['msg'])) { ?>
<div style="width:350px; margin-left:-15px;" align="center"> <font color="#FF0000"><b> <? echo $_REQUEST['msg'];?> </b><br />
<br />
</font> </div>
<?php } ?>
<p>
	<label>Username</label>
	<input class="text-input" type="text" value="<?php echo $_COOKIE['usernamecookie'];?>" name="admin_user_name"/>
</p>
<div class="clear"></div>
<p>
	<label>Password</label>
	<input class="text-input" type="password" value="<?php echo $_COOKIE['userpasswordcookie'];?>" name="password"/>
</p>
<div class="clear"></div>
<p id="remember-password">
	<input name="remember" id="remember" type="checkbox" />
	Remember me </p>
<div class="clear"></div>
<p>
	<input class="button" type="submit" value="Sign In" onClick='return chackform()'/>
</p>
</form>
</div>
<!-- End #login-content -->
</div>
<!-- End #login-wrapper -->
</body>
</html>
