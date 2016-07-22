<?php
  include 'conn/Session.php';
 ?>
<?php
/*---------------
*User Management
* Developed By : XXXXXXXX
-------------------*/
// Include the MySQL class
?>
<?php
include 'conn/MySQL.php';
$db =  new MySQL();
?>
<HTML>
<?php
     $sql = "SELECT * FROM tbl_admin WHERE email='" . $_POST['admin_user_name'] . "' AND  password='".$_POST['password'] . "'
	  and is_admin=1";
      $result = mysql_query($sql) or die(mysql_error());
	  if (mysql_num_rows($result) > 0)
	  {	
		   if(isset($_POST['remember']))
		   {
		  setcookie("usernamecookie", $_POST['admin_user_name'], time()+60*60*24*100, "/");
		  setcookie("userpasswordcookie", $_POST['password'], time()+60*60*24*100, "/");
		   }
	  
	  
	    $Records=mysql_fetch_array($result);
		echo $Records['id'];
		$_SESSION["userdata"]=$Records;
		$_SESSION["userdata"];
		$admin_user_name=$_POST['admin_user_name'];
        $_SESSION["admin_user_name"]=$admin_user_name;
		header("Location:welcome.php");
      }
      else
	  {
         header("Location:index.php?msg=".urlencode("Login Invalid ! Please enter correct UserName and Password."));
       }
?>
