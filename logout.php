<?php
	session_start();
	if(isset($_SESSION["admin_user_name"]))
	{
		
			unset($_SESSION["admin_user_name"]);
			session_destroy();
			header("location:index.php?msg=".urlencode("You have successfully logged out."));
			exit;
		
	}
?>