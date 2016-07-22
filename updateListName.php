<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$groupName = $_REQUEST['groupName'];
$listNewName = $_REQUEST['listNewName'];
$listOldName = $_REQUEST['listOldName'];

$groupName = str_replace("amp","&",$groupName);
$listNewName = str_replace("amp","&",$listNewName);
$listOldName = str_replace("amp","&",$listOldName);

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
		
		$getListQuery="select * from wishlisttbl where listName = '".addslashes($listOldName)."' and groupId='$groupDataId'";
		//echo $getListQuery;
		$execListQuery=mysql_query($getListQuery)or die(mysql_error());
		$countListData=mysql_num_rows($execListQuery);
		
		if($countListData >= 0)
		{
		   $created=date("Y-m-d : H:i:s");
		   //wishlisttbl
		   $content=array("listName"=>$listNewName,"date"=>$created);
		   $condition1=" where listName = '".addslashes($listOldName)."' and groupId='$groupDataId' ";
		   $res1 = $dbcon->update_query("wishlisttbl",$content,$condition1);
		    //itemlisttbl
		   $condition2=" where listName = '".addslashes($listOldName)."' and groupName='$groupName'";
		   $res2 = $dbcon->update_query("itemlisttbl",$content,$condition2);
		   $message = "Success"; 
		}
		else
		{
		   $message="Failure"; 
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

//http://localhost/ilist/admin/xmlservice/updateListName.php?groupName=a2&listNewName=listnew&listOldName=My List
//http://www.palmerapplications.com/ilist/admin/xmlservice/updateListName.php?groupName=a2&listNewName=listnew&listOldName=My List

?>