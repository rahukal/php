<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$groupName = $_REQUEST['groupName'];
$groupName = str_replace("amp","&", $groupName);
/*$email = $_REQUEST['email'];
$password = $_REQUEST['password'];*/
if($groupName!='')
{
 	$message = "";
	$ifExistsName = $siteObj->checkIfExists("grouptbl","groupName",trim($groupName));
	if($ifExistsName) {  $message .= "This group name already exist. \n"; }
	if(strchr($groupName,"'")) { $message .= "Please enter valid group name. \n";  }
	
    if($message=="")
	{
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

//http://localhost/ilist/admin/xmlservice/checkGroup.php?groupName=test
//http://www.sandeepbeniwal.com/ilist/admin/xmlservice/checkGroup.php?groupName=test

?>