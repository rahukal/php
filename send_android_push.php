<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$message = "";
$groupName = $_REQUEST['groupName'];
$deviceId = $_REQUEST['deviceId'];

$groupName = str_replace("amp","&", $groupName);

/*$deviceToken = "5fa4157eb22d62e7b2bcbf92dffb759622ef5a29d187ae5aed806c380203fbc8";
$contentData=array("username_to"=>$username_to,"username_from"=>$username_from,"deviceid"=>$deviceToken);
$dbcon->insert_query("testnoti",$contentData);*/
$status_message = "";
$showQuery="select * from devicetbl where deviceId<>'$deviceId' and deviceId<>''  and groupName='$groupName'";
//echo $showQuery;
$execShowQuery=mysql_query($showQuery)or die(mysql_error());
$count_data=mysql_num_rows($execShowQuery);

if($count_data > 0) { /*$message="Success";*/ }else { $status_message="Failure"; }

if($status_message=="")
  {
	   while($line=mysql_fetch_array($execShowQuery))
			{ 
			    $deviceToken = $line['deviceId'];
				
				
				$username = "babyregistry.ilist@gmail.com";
				$password = "impigerindia";
				/*$deviceRegistrationId =
				"APA91bGKXmJ7R2EX4TgohYvHmCCN1av2J-hYDlH8SucoiwWqgWKUuuMu6BmtPZ0gmGzKDLQuY79MNRk0BkkOCkv7ARZmPi2SGqG4bbiHfZloMj_d1WOLjaOB_19XYsILnR_3atYze4OXdpCDvhZSXG3F-bXmr88lag"									                 ;*/
				
				$deviceRegistrationId = $line['deviceId'];
				
				$authCode = $siteObj->googleAuthenticate($username, $password, $source="com.ilist.baby", $service="ac2dm");
				
				$msgType = "0";
				$messageText = 'You Recieved a new Notifcation from '.$groupName;
				$res =  $siteObj->sendMessageToPhone($authCode, $deviceRegistrationId, $msgType, $messageText,$groupName);
				if($res)
				{
				   //$status_message="Failure"; 
				}
			    else
				{
				   $status_message="Failure"; 
				}	
				
			}
   }
else
   {
	  $status_message="Failure"; 
   }
   
   if(empty($status_message)) { $status_message = "Success";  }
   
   
   @$xml_output  .= "<status>\n"; 
   $xml_output  .= "\t\t<message>".$status_message."</message>\n";
   $xml_output  .= "</status>";
   $xml_output .= "\n\t</document>";
	
	$xml_output = str_replace('&',"&amp;",$xml_output);
	$xml_output = str_replace('"',"&quot;",$xml_output);
	$xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<document>".$xml_output;
		
	header ("Content-Type:text/xml"); 
	header("Cache-Control: private, max-age=0, pre-check=0, post-check=0");
	header("Content-Length: ".strlen($xml_output));
	echo $xml_output ;   
   
//http://localhost/baby_shower/admin/xmlservice/send_notification.php?groupName=testing&deviceId=mydeviceid
//http://www.palmerapplications.com/baby_shower/admin/xmlservice/send_notification.php?groupName=testing&deviceId=mydeviceid
//http://www.sandeepbeniwal.com/apns/send_notification.php?username_to=test@test.com&username_from=test
?>
