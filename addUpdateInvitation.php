<?php

ini_set('display_errors',1);

error_reporting(E_ALL);

require '../conn/MySQL.php';

require_once("../classes/class.SiteManager.php");

$dbcon =  new MySQL();

$siteObj =  new SiteManager();



$greeting_text = $_REQUEST['greeting_text'];

$names = $_REQUEST['names'];

$timings = $_REQUEST['timings'];

$address = $_REQUEST['address'];

$groupName = $_REQUEST['groupName'];

$gender = $_REQUEST['gender'];

   $created=date("Y-m-d : H:i:s");

if($groupName!='')

{

	$message = "";

	

    $showQuery="select * from group_invitation where groupName='$groupName'";

	$execShowQuery=mysql_query($showQuery)or die(mysql_error());

	$count_data=mysql_num_rows($execShowQuery);

	if($count_data > 0) 

	{

	  

     	$content=array("greeting_text"=>$greeting_text,"names"=>$names,"timings"=>$timings,"address"=>$address,"gender"=>$gender,"created_date"=>$created);

		$condition=" where groupName='$groupName'";

		$res = $dbcon->update_query("group_invitation",$content,$condition);

		$message =  "Success"; 

	    

	} 

	else 

	{

     	
		$content=array("greeting_text"=>$greeting_text,"names"=>$names,"timings"=>$timings,"address"=>$address,"gender"=>$gender,"groupName"=>$groupName,"created_date"=>$created);

		$dbcon->insert_query("group_invitation",$content);

		$message = "Success";   

	 }

	

   if($message==""){ $message = "Failure";  }

	@$xml_output  .= "<login>\n"; 

	$xml_output  .= "\t\t<message>".$message."</message>\n";

	$xml_output  .= "</login>";

	$xml_output .= "\n\t</document>";

	

	$xml_output = str_replace('&',"&amp;",$xml_output);

	$xml_output = str_replace('"',"&quot;",$xml_output);

	$xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<document>".$xml_output;

		

	header ("Content-Type:text/xml"); 

	header("Cache-Control: private, max-age=0, pre-check=0, post-check=0");

	header("Content-Length: ".strlen($xml_output));

	echo $xml_output ;

}

else

{

	 echo "0";

}

//http://localhost/wedding_registry/admin/xmlservice/addUpdateInvitation.php?greeting_text=a2&names=address&timings=mynewlist&address=testing&gender=male&groupName=groceryo

//http://www.palmerapplications.com/wedding_registry/admin/xmlservice/addUpdateInvitation.php?greeting_text=a2&names=address&timings=mynewlist&address=testing&gender=male&groupName=groceryo



?>