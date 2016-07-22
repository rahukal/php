<?php
require 'conn/Session.php';
require 'conn/MySQL.php';

$dbcon =  new MySQL();
 require 'conn/checkSession.php';

$movie_id = $_REQUEST['movie_id'];
$dbcon->execute_query("select * from tbl_manage_movies where movie_id=$movie_id");
$Records=$dbcon->fetch_one_record();
if($Records['upload_movie']!="")
{
	$type = "jpg";
	$db_img = base64_decode($Records['upload_movie']); //print_r($db_img );
	$db_img = imagecreatefromstring($db_img);
	if ($db_img !== false) 
	{
		switch ($type) 
		{
			case "jpg":
			header("Content-Type: image/jpeg");
			imagejpeg($db_img);
			break;
			
			case "gif":
			header("Content-Type: image/gif");
			imagegif($db_img);
			break;
			
			case "png":
			header("Content-Type: image/png");
			imagepng($db_img);
			break;
		}
	}
	imagedestroy($db_img);
}

?> 