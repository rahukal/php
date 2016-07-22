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
$storeName = $_REQUEST['storeName'];

$checkValue = $_REQUEST['checkValue'];
//item parameters
//$status = $_REQUEST['status'];

$itemName = str_replace("amp","&", $itemName);
$listName = str_replace("amp","&", $listName);
$groupName = str_replace("amp","&", $groupName);
$storeName = str_replace("amp","&", $storeName);

$created=date("Y-m-d : H:i:s");

if($groupName!='')
{
 	$message = "";
    if($message=="")
	{
	     //$message = "Success"; 
	     $dbcon->execute_query("select * from storetbl where itemName = '".addslashes($itemName)."' and listName = '".addslashes($listName)."' and
		  groupName='$groupName' and storeName = '".addslashes($storeName)."'");
	    //echo "select * from itemlisttbl where listName='$listName' and groupName='$groupName' and status = 'b'";
		$Records=$dbcon->fetch_one_record();
		if($Records)
		{
		    $content=array("checkValue"=>$checkValue,"created_date"=>$created);
			$condition=" where itemName = '".addslashes($itemName)."' and listName = '".addslashes($listName)."' and groupName='$groupName' and 
			storeName = '".addslashes($storeName)."'";
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

/*http://localhost/ilist/admin/xmlservice/updateStoreCheck.php?itemName=my_item&listName=testing&groupName=a4&storeName=pipu&checkValue=1*/
  
/*http://www.palmerapplications.com/ilist/admin/xmlservice/updateStoreCheck.php?itemName=my_item&listName=testing&groupName=a4&storeName=pipu&checkValue=1
*/
?>