<?php
require 'conn/Session.php';
	require 'conn/MySQL.php';
	require_once("includes/paging.inc.php");
	require_once("includes/generalFunction.php");
	require_once("classes/class.SiteManager.php");

	    function GetImageExtension($imagetype)

	     {

	       if(empty($imagetype)) return false;

	       switch($imagetype)

	       {

	           case 'image/bmp': return '.bmp';

	           case 'image/gif': return '.gif';

	           case 'image/jpeg': return '.jpg';
	           case 'image/png': return '.png';

	           default: return false;

	       }

	     }

	      

	      

	      

	if (!empty($_FILES["poster"]["name"])) {

	 

	    $file_name=$_FILES["poster"]["name"];

	    $temp_name=$_FILES["poster"]["tmp_name"];

	    $imgtype=$_FILES["poster"]["type"];

	    $ext= GetImageExtension($imgtype);

	    $imagename=date("d-m-Y")."-".time().$ext;

	    $target_path = "upload/".$imagename;

	     

	 

	if(move_uploaded_file($temp_name, $target_path)) {

	 

	    $query_upload="INSERT into 'tbl_manage_movies' ('poster') VALUES

 

	('".$target_path."')";
   mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error()); 

	     

	}else{

	 

	   exit("Error While uploading image on the server");

	}

	 

	}

	 

	?>