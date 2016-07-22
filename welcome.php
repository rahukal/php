<?
require 'conn/Session.php';
require 'conn/MySQL.php';
$db =  new MySQL();
require 'conn/checkSession.php';
require_once('classes/section.class.php');
$sectionObj=new Section();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Shotz</title>
<!--CSS-->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
<!-- jQuery -->
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
<!-- jQuery Datepicker Plugin -->
<script type="text/javascript" src="resources/scripts/jquery.datePicker.js"></script>
<script type="text/javascript" src="resources/scripts/jquery.date.js"></script>
<!--[if IE]><script type="text/javascript" src="resources/scripts/jquery.bgiframe.js"></script><![endif]-->
<!-- Internet Explorer .png-fix -->
<!--[if IE 6]>
			<script type="text/javascript" src="resources/scripts/DD_belatedPNG_0.0.7a.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('.png_bg, img, li');
			</script>
		<![endif]-->
</head>
<body>
<div id="body-wrapper">
  <!-- Wrapper for the radial gradient background -->
  <!-- sidebar show start here-->
  <? require('left.php') ?>
  <!-- sidebar end here-->
  <!-- Middle content show here-->
  <div id="main-content">
    <noscript>
    <div class="notification error png_bg">
      <div> Javascript is disabled or is not supported by your browser. 
        Please <a href="../../../browsehappy.com/index.htm" title="Upgrade to a better browser">upgrade</a> your browser or <a href="../../../www.google.com/support/bin/answer_2EEFB1D5.py" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly. </div>
    </div>
    </noscript>
    <!-- Page Head -->
    <h2>Welcome
      <?=ucfirst($_SESSION['admin_user_name'])?>
      !</h2>
    <p id="page-intro">What Would You Like To Do?</p>
    <ul class="shortcut-buttons-set">
      <li><a class="shortcut-button" href="change_password.php"><span> <img src="resources/images/icons/Gnome-Dialog-Password-48.png" alt="icon" /><br />
        Settings<br />
        </span></a></li>
      <!--		<li><a class="shortcut-button" href="good_venues_category.php"><span>
					<img src="resources/images/icons/Arch-of-Triumph-Ok-48.png" alt="icon" /><br />
					Good for Venues
				</span></a></li>-->
    </ul>
    <!-- End .shortcut-buttons-set -->
    <div class="clear"></div>
    <!-- End .clear -->
    <div class="clear" style="height:230px;"></div>
    <!-- Start #footer -->
    <? require('footer.php');?>
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
  <!-- Middle content end here-->
  <!-- Middle content end here-->
</div>
</body>
</html>
