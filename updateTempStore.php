<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$groupName = $_REQUEST['groupName'];
$listName = $_REQUEST['listName'];
$itemName = $_REQUEST['itemName'];
$deviceId = $_REQUEST['deviceId'];
//item parameters
//$status = $_REQUEST['status'];

$itemName = str_replace("amp","&", $itemName);
$listName = str_replace("amp","&", $listName);
$groupName = str_replace("amp","&", $groupName);

$created=date("Y-m-d : H:i:s");

if($groupName!='')
{
 	$message = "";
    if($message=="")
	{
	     //$message = "Success"; 
	     $dbcon->execute_query("select * from storetbl where itemName ='tempItem' and listName = '".addslashes($listName)."' and groupName='$groupName' and deviceId = '$deviceId'");
	    //echo "select * from itemlisttbl where listName='$listName' and groupName='$groupName' and status = 'b'";
		$Records=$dbcon->fetch_one_record();
		if($Records)
		{
		    $content=array("itemName"=>$itemName,"created_date"=>$created);
			$condition=" where itemName ='tempItem' and listName = '".addslashes($listName)."' and groupName='$groupName' and deviceId = '$deviceId'";
			$res = $dbcon->update_query("storetbl",$content,$condition);
			$message =  "Success";
		}
		else
		{
			$message =  "Failure";
		}
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

/*http://localhost/ilist/admin/xmlservice/updateTempStore.php?itemName=mmmmm&listName=ghg&groupName=testnew&deviceId=aaaaaa*/
  
/*http://www.palmerapplications.com/ilist/admin/xmlservice/updateTempStore.php?itemName=Cassie Rose - Wolf's Cry CD&listName=Gggg&groupName=Y1&deviceId=982aeb3a4040c7f35051f5774b67b3b29dded1f04584e03808e940420fd93cd1
*/
?>