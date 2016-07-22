<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$groupName = $_REQUEST['groupName'];
//$password = $_REQUEST['password'];
$deviceId = $_REQUEST['deviceId'];
$udId = $_REQUEST['udId'];

$groupName = str_replace("amp","&", $groupName);


if($groupName!='')
{
 	$message = "";
	 // deleting from device tbl
    $showQuery="select * from devicetbl where groupName='$groupName' and  deviceId='$deviceId'";
	$execShowQuery=mysql_query($showQuery)or die(mysql_error());
	$count_data=mysql_num_rows($execShowQuery);
	if($count_data <= 0) { $message .= "Invalid Group.\n"; }
    if($message=="")
	{
		$dbcon->execute_query("delete from devicetbl where groupName='$groupName' and  deviceId='$deviceId'");
		$message=""; 
	 }
     // deleting from updaet data time tbl
	$upQuery="select * from update_data_time_tbl where groupName='$groupName' and  deviceId='$udId'";
	$execUpQuery=mysql_query($upQuery)or die(mysql_error());
	$count_up=mysql_num_rows($execUpQuery);
	$message - "";
	if($count_up  >  0) { $message = ""; }
	else{ $message .= "Invalid Group.\n"; }
	
    if($message=="")
	{
		$dbcon->execute_query("delete from update_data_time_tbl where groupName='$groupName' and  deviceId='$udId'");
		$message="Success"; 
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
//http://localhost/ilist/admin/xmlservice/leaveGroup.php?groupName=testing&deviceId=asdfasdfasdf
//http://www.palmerapplications.com/ilist/admin/xmlservice/leaveGroup.php?groupName=test&deviceId=vvvvvvvvvvvvvvvvvvvvvvvvvvvv


?>