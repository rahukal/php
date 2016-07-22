<? header("Content-Type: text/html; charset= UTF-8");?>
<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->

<!-- <h1 id="sidebar-title"><a href="#">---><!-- </a></h1> -->

<!-- Logo (221px wide) -->

<div id="shotz">

<b>Shotz7</b>			

<!-- <img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" /> -->

</div>

<!-- Sidebar Profile links -->

<div id="profile-links">

<span >Hello <?=ucfirst($_SESSION["admin_user_name"]);?></span> 

<!--

, you have <a href="#messages" rel="modal" title="3 Messages">3 Messages</a>

--> <br/>

<br />

<!--<a href="#" title="View the Site">View the Site</a> |--> 

<a href="logout.php" title="Sign Out" >Sign Out</a>

</div>        
<?php

$menu_home= array("welcome.php");
$menu_user= array("manage_user.php","add_user.php","update_user.php");
$Movie_Master= array("movie_category.php","add_movie_category.php","update_movie_category.php","language.php","add_language.php","update_language.php","manage_movie.php","add_manage_movie.php","update_manage_movie.php","archive_movie.php","add_archive_movie.php","update_archive_movie.php");
$Manage_Banners= array("manage_banner.php","add_banner.php","update_banner.php");
$manage_viral_shotz= array("manage_viral_shotz.php","add_viral_shotz.php","update_viral_shotz.php");
$manage_promotion_code= array("manage_promotion.php","add_manage_promotion.php","update_manage_promotion.php","promotion_report.php","update_promotion_report.php","admin_apply_promotion.php");
$Finance_Master= array("manage_payments.php","manage_subscription.php","update_subscription.php","add_subscription.php");
$Country_Master= array("country.php","add_country.php","update_country.php","state.php","add_state.php","update_state.php","city.php","add_city.php","update_city.php");
$CMS= array("cms.php","add_cms.php","update_cms.php");
$News_Letter= array("manage_newsletter.php");
$Events_Industry_Speak= array("event_category.php","add_event_category.php","update_event_category.php","manage_news.php","add_manage_news.php","update_manage_news.php","manage_events.php","add_manage_events.php","update_manage_events.php");
$Team_Management= array("manage_team.php","add_manage_team.php","update_manage_team.php","film_makers_team.php","add_film_makers_team.php","update_film_makers_team.php");
$Manage_Testimonials= array("manage_testimonials.php","update_testimonials.php","add_testimonials.php");
$Manage_Reviews= array("review_from_customer.php","review_comments.php");
$Manage_Site_Content= array("site_category.php","update_site_content.php","add_site_content.php","gossip.php","add_gossip.php","update_gossip.php","shotz_focus.php","add_shotz_focus.php","update_shotz_focus.php","director_focus.php","add_director_focus.php","update_director_focus.php","latest_buzz.php","add_latest_buzz.php","update_latest_buzz.php");
$Manage_Reports= array("user_reports.php","movies_reports.php");
$SEO_Setting= array("sec_management.php");
$Settings= array("profile.php","edit_profile.php","change_password.php");


?>
<ul id="main-nav">  <!-- Accordion Menu -->

<!--

<li>

<a href="../../../www.google.com" class="nav-top-item no-submenu">  Add the class "no-submenu" to menu items with no sub menu 

	Dashboard

</a>       

</li>

-->
<li> <a href="welcome.php" 

<?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $menu_home)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>DashBoard </a></li>


<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $menu_user)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>User Master </a>

<ul>

<li><a href="manage_user.php" class="nav-top-item no-submenu">Manage User</a></li>


</ul>


</li>

<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $Movie_Master)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Movie Master </a>

</a>

<ul>

<li><a href="movie_category.php" class="nav-top-item no-submenu">Manage Category</a></li>
<li><a href="language.php" class="nav-top-item no-submenu">Manage Language</a></li>
<li><a href="manage_movie.php" class="nav-top-item no-submenu">Manage Movie</a></li>
<li><a href="archive_movie.php" class="nav-top-item no-submenu">Archive Movie</a></li>

</ul>


</li>
<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $Manage_Banners)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Manage Banners </a>

<ul>

<li><a href="manage_banner.php" class="nav-top-item no-submenu">Manage Banner</a></li>
<li><a href="add_banner.php" class="nav-top-item no-submenu">Add new banner</a></li>

</ul>


</li>
<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $manage_viral_shotz)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Manage Viral Shotz</a>

<ul>

<li><a href="manage_viral_shotz.php" class="nav-top-item no-submenu">Manage Viral Shotz</a></li>
<li><a href="add_viral_shotz.php" class="nav-top-item no-submenu">Add viral shotz</a></li>

</ul>



</li>
<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $manage_promotion_code)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Manage Promotion Code</a>

<ul>

<li><a href="manage_promotion.php" class="nav-top-item no-submenu">Manage Promotion</a></li>
<li><a href="promotion_report.php" class="nav-top-item no-submenu">Promotion Reports</a></li>
<li><a href="admin_apply_promotion.php" class="nav-top-item no-submenu">Admin Apply Promotion</a></li>
<li><a href="add_manage_promotion.php" class="nav-top-item no-submenu">Add Promotion</a></li>

</ul>

</li>
<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $Finance_Master)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Finance Master</a>

<ul>

<li><a href="manage_payments.php" class="nav-top-item no-submenu">Manage Payments</a></li>
<li><a href="manage_subscription.php" class="nav-top-item no-submenu">Manage Subscription</a></li>

</ul>



</li>
<li>
<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $Country_Master)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Country Master</a>


<ul>

<li><a href="country.php" class="nav-top-item no-submenu">Manage Countries</a></li>
<li><a href="state.php" class="nav-top-item no-submenu">Manage States</a></li>
<li><a href="city.php" class="nav-top-item no-submenu">Manage Cities</a></li>

</ul>



</li>
<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $CMS)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>CMS Management</a>

<ul>

<li><a href="cms.php" class="nav-top-item no-submenu">Manage CMS</a></li>

</ul>



</li>
<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $News_Letter)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>News Letter</a>

<ul>

<li><a href="manage_newsletter.php" class="nav-top-item no-submenu">Manage Newsletter</a></li>

</ul>



</li>
<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $Events_Industry_Speak)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Events & Industry Speak</a>

<ul>

<li><a href="event_category.php" class="nav-top-item no-submenu">Manage Categories</a></li>
<li><a href="manage_news.php" class="nav-top-item no-submenu">Manage news</a></li>
<li><a href="manage_events.php" class="nav-top-item no-submenu">Manage events</a></li>

</ul>



</li>
<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']), $Team_Management)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Team Management</a>

<ul>

<li><a href="manage_team.php" class="nav-top-item no-submenu">Manage Teams</a></li>
<li><a href="film_makers_team.php" class="nav-top-item no-submenu">Manage Film Makers Teams</a></li>

</ul>



</li>
<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']),$Manage_Testimonials)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Manage Testimonials</a>


<ul>

<li><a href="manage_testimonials.php" class="nav-top-item no-submenu">Testimonials</a></li>

</ul>



</li>

<!--  <li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']),$Manage_Reviews)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Manage Reviews</a>


<ul>

<li><a href="review_from_customer.php" class="nav-top-item no-submenu">Assign Review From Customer</a></li>
<li><a href="review_comments.php" class="nav-top-item no-submenu">Review Comments</a></li>

</ul>



</li> -->

<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']),$Manage_Site_Content)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Manage Site Content</a>


<ul>

<li><a href="site_category.php" class="nav-top-item no-submenu">Manage Category</a></li>
<li><a href="gossip.php" class="nav-top-item no-submenu">Gossip</a></li>
<li><a href="shotz_focus.php" class="nav-top-item no-submenu">Shotz In Focus</a></li>
<li><a href="director_focus.php" class="nav-top-item no-submenu">Director In Focus</a></li>
<li><a href="latest_buzz.php" class="nav-top-item no-submenu">Latest Buzz</a></li>

</ul>



</li>
<!--     <li>
<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']),$Manage_Reports)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Manage Reports</a>

<ul>

<li><a href="user_reports.php" class="nav-top-item no-submenu">Users Reports</a></li>
<li><a href="movies_reports.php" class="nav-top-item no-submenu">Movies Reports</a></li>

</ul>



</li> 
<li>
<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']),$SEO_Setting)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>SEO Setting Management</a>


<ul>

<li><a href="sec_management.php" class="nav-top-item no-submenu">Manage SEO Content</a></li>

</ul>



</li> -->
<li>

<a href="#" <?php if (in_array(basename($_SERVER['SCRIPT_FILENAME']),$Settings)) { echo 'class="nav-top-item active no-submenu"';  } else { echo 'class="nav-top-item  no-submenu"'; }?>>Settings</a>

<ul>

	<li><a href="profile.php" class="nav-top-item no-submenu">Admin Profile</a></li>

	<li><a href="change_password.php" class="nav-top-item no-submenu">Change Password</a></li>

</ul>

</li>     

<!--

<li>

<a href="#" class="nav-top-item">

	Pages

</a>

<ul>

	<li><a href="#">Create a new Page</a></li>

	<li><a href="#">Manage Pages</a></li>

</ul>

</li>



<li>

<a href="#" class="nav-top-item">

	Image Gallery

</a>

<ul>

	<li><a href="#">Upload Images</a></li>

	<li><a href="#">Manage Galleries</a></li>

	<li><a href="#">Manage Albums</a></li>

	<li><a href="#">Gallery Settings</a></li>

</ul>

</li>



<li>

<a href="#" class="nav-top-item">

	Events Calendar

</a>

<ul>

	<li><a href="#">Calendar Overview</a></li>

	<li><a href="#">Add a new Event</a></li>

	<li><a href="#">Calendar Settings</a></li>

</ul>

</li>



<li>

<a href="#" class="nav-top-item">

	Settings

</a>

<ul>

	<li><a href="#">General</a></li>

	<li><a href="#">Design</a></li>

	<li><a href="#">Your Profile</a></li>

	<li><a href="#">Users and Permissions</a></li>

</ul>

</li>     

-->



</ul> <!-- End #main-nav -->







</div></div> <!-- End #sidebar -->





