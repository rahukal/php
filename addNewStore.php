<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$storeName = $_REQUEST['storeName'];
$storeAddress = $_REQUEST['storeAddress'];

$itemName = $_REQUEST['itemName'];
$listName = $_REQUEST['listName'];
$groupName = $_REQUEST['groupName'];
$deviceId = $_REQUEST['deviceId'];
$checkValue = $_REQUEST['checkValue'];
$uniKey = $_REQUEST['uniKey'];

$storeName = str_replace("amp","&",$storeName);
$storeAddress = str_replace("amp","&",$storeAddress);
$itemName = str_replace("amp","&",$itemName);
$listName = str_replace("amp","&",$listName);
$groupName = str_replace("amp","&",$groupName);

$created=date("Y-m-d : H:i:s");

if($groupName!='')
{
	$message = "";
 	if($message=="")
	{
	 	$created=date("Y-m-d : H:i:s");
		//$uniKey = $siteObj->getUniKey();
		
		$content=array("uniKey"=>$uniKey,"storeName"=>$storeName,"storeAddress"=>$storeAddress,"itemName"=>$itemName,"listName"=>$listName,"groupName"=>$groupName,"checkValue"=>$checkValue,"deviceId"=>$deviceId,"created_date"=>$created);
		$dbcon->insert_query("storetbl",$content);
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
//http://localhost/ilist/admin/xmlservice/addNewStore.php?storeName=a2&storeAddress=address&itemName=mynewlist&listName=testing&groupName=a4&checkValue=1&deviceId=aaaaaa
//http://www.palmerapplications.com/ilist/admin/xmlservice/addNewStore.php?storeName=a2&storeAddress=address&&itemName=mynewlist&listName=testing&groupName=a4&checkValue=1&deviceId=aaaaaa

?>