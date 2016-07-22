<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$storeOldName = $_REQUEST['storeOldName'];
$storeNewName = $_REQUEST['storeNewName'];
$storeAddress= $_REQUEST['storeAddress'];
$groupName = $_REQUEST['groupName'];


$storeOldName = str_replace("amp","&",$storeOldName);
$storeNewName = str_replace("amp","&",$storeNewName);
$storeAddress = str_replace("amp","&",$storeAddress);
$groupName = str_replace("amp","&",$groupName);

$created=date("Y-m-d : H:i:s");

if($groupName!='')
{

 	$message = "";
    $showQuery="select * from storetbl where storeName = '".addslashes($storeOldName)."' and groupName='$groupName'";
	$execShowQuery=mysql_query($showQuery)or die(mysql_error());
	$count_data=mysql_num_rows($execShowQuery);
	
	if($count_data > 0) { $message=""; }else { $message="Failure"; }
	if($message=="")
	{
		$content=array("storeName"=>$storeNewName,"storeAddress"=>$storeAddress,"created_date"=>$created);
		$condition=" where storeName = '".addslashes($storeOldName)."' and groupName='$groupName'";
		$res = $dbcon->update_query("storetbl",$content,$condition);
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

//http://localhost/ilist/admin/xmlservice/updateStore.php?storeOldName=a2&storeNewName=pipu&groupName=a4
//http://www.palmerapplications.com/ilist/admin/xmlservice/updateStore.php?storeOldName=a2&storeNewName=pipu&groupName=a4

?>