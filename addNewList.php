
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$groupName = $_REQUEST['groupName'];
$listName = $_REQUEST['listName'];

$groupName = str_replace("amp","&", $groupName);
$listName = str_replace("amp","&", $listName);

$uniKey = $_REQUEST['uniKey'];

//$password = $_REQUEST['password'];
//$deviceId = $_REQUEST['deviceId'];

$created=date("Y-m-d : H:i:s");

if($groupName!='')
{
 	$message = "";
	$showQuery="select * from grouptbl where groupName='$groupName'";
	$execShowQuery=mysql_query($showQuery)or die(mysql_error());
	$count_data=mysql_num_rows($execShowQuery);
	
    if($count_data > 0) { $message=""; } else { $message="Failure"; }
	if($message=="")
	{
	  $groupData = mysql_fetch_array($execShowQuery);	
	  $groupDataId = $groupData['groupId'];
	  
	  
	  //wishlisttbl
	  //$itemQuery="select * from itemtbl where groupId='$groupDataId' and itemName = '".addslashes($itemName)."'";
	  
	  $listQuery="select * from wishlisttbl where groupId='$groupDataId' and listName = '".addslashes($listName)."'";
	  $execListQuery=mysql_query($listQuery)or die(mysql_error());
	  $count_list=mysql_num_rows($execListQuery);
	  
	  if($count_list <= 0) { $message=""; } else { $message="Failure"; }
    }
	
	if($message=="")
	{
	  	$created=date("Y-m-d : H:i:s");
		$content=array("uniKey"=>$uniKey,"listName"=>$listName,"groupId"=>$groupDataId,"date"=>$created);
		$dbcon->insert_query("wishlisttbl",$content);
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

//http://localhost/ilist/admin/xmlservice/addNewList.php?groupName=a2&listName=mynewlist
//http://www.ilistapp.com/baby_registry/admin/xmlservice/addNewList.php?groupName=testtest&listName=mylisting

?>