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

/*$itemsData = $groupName."________".$listName."________".$itemName."________".$quantity;
$contenttest=array("itemsData"=>$itemsData);
$dbcon->insert_query("upload_data",$contenttest);*/
//$message = "Success"; 

$created=date("Y-m-d : H:i:s");

if($groupName!='')
{
 	$message = "";
    if($message=="")
	{
		//$message = "Success"; 
		$dbcon->execute_query("select * from itemlisttbl where listName = '".addslashes($listName)."' and groupName='$groupName' and (status = 'b' or status = 'c')");
		//echo "select * from itemlisttbl where listName='$listName' and groupName='$groupName' and status = 'b'";
		$Records=$dbcon->fetch_one_record();
		if($Records)
		{
			$status = "a";
			$content=array("status"=>$status,"date"=>$created);
			$condition=" where listName = '".addslashes($listName)."' and groupName='$groupName' and (status = 'b' or status = 'c')";
			$res = $dbcon->update_query("itemlisttbl",$content,$condition);
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

//http://localhost/ilist/admin/xmlservice/clearAllCheckbox.php?groupName=a2&listName=My List
//http://www.palmerapplications.com/ilist/admin/xmlservice/clearAllCheckbox.php?groupName=a2&listName=My List

?>