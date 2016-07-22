<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$storeName = $_REQUEST['storeName'];
$groupName = $_REQUEST['groupName'];

$storeName = str_replace("amp","&", $storeName);
$groupName = str_replace("amp","&", $groupName);

if($groupName!='')
{
 	$message = "";
	$showQuery="select * from storetbl where storeName = '".addslashes($storeName)."'  and groupName='$groupName'";
	$execShowQuery=mysql_query($showQuery)or die(mysql_error());
	$count_data=mysql_num_rows($execShowQuery);
	
	if($count_data > 0) { $message=""; }else { $message="Failure"; }
	if($message=="")
	{
	    // stores
	    $created=date("Y-m-d : H:i:s");
	    $itemData = mysql_fetch_array($execShowQuery);
		$type = "store";
		 
		$content=array("groupName"=>$groupName,"uniKey"=>$itemData['uniKey'],"type"=>$type,"time"=>$created);
  		$dbcon->insert_query("deleted_items",$content);
	
	
		$dbcon->execute_query("delete from storetbl where storeName = '".addslashes($storeName)."' and groupName='$groupName'");
    	$message="Success"; 
     }
	else
	 {
	   $message="Failure"; 
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

//http://localhost/ilist/admin/xmlservice/deleteStore.php?storeName=a2&groupName=a4
//http://www.palmerapplications.com/ilist/admin/xmlservice/deleteStore.php?storeName=a2&groupName=a4

?>