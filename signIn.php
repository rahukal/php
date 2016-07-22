<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$groupName = $_REQUEST['groupName'];
$password = $_REQUEST['password'];
$deviceId = $_REQUEST['deviceId'];

$groupName = str_replace("amp","&", $groupName);
$password = str_replace("amp","&", $password);

$created=date("Y-m-d : H:i:s");

if($groupName!='')
{
 	$message = "";
	
    $showQuery="select * from grouptbl where groupName='$groupName' and  password='".md5($password)."'";
	$execShowQuery=mysql_query($showQuery)or die(mysql_error());
	$count_data=mysql_num_rows($execShowQuery);
	if($count_data <= 0) { $message .= "Invalid Username/Password.Please login again.\n"; }
    if($message=="")
	{
		$checkDeviceQuery="select * from devicetbl where groupName='$groupName' and  deviceId='$deviceId'";
		$execCheckQuery=mysql_query($checkDeviceQuery)or die(mysql_error());
		$check_data=mysql_num_rows($execCheckQuery);
		if($check_data <= 0)
		{
			$created=date("Y-m-d : H:i:s");
			$content2=array("groupName"=>$groupName,"deviceId"=>$deviceId,"created_date"=>$created);
			$dbcon->insert_query("devicetbl",$content2);
		}
		$message = "Success"; 
   }
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
//http://localhost/ilist/admin/xmlservice/signIn.php?groupName=testing&password=test&deviceId=asdfasdfasdf
//http://www.palmerapplications.com/ilist/admin/xmlservice/signIn.php?groupName=test&password=test&deviceId=vvvvvvvvvvvvvvvvvvvvvvvvvvvv
//http://www.palmerapplications.com/ilist/admin/xmlservice/signIn.php?groupName=testing&password=test

?>