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

if($groupName!='')
{
 	$message = "";
	$showQuery="select * from grouptbl where groupName='$groupName'";
	$execShowQuery=mysql_query($showQuery)or die(mysql_error());
	$count_data=mysql_num_rows($execShowQuery);
	
	if($count_data >= 0) { $message=""; } else { $message="Failure"; }
	if($message=="")
	{
		$groupData = mysql_fetch_array($execShowQuery);	
		$groupDataId = $groupData['groupId'];
		
		$getListQuery="select * from wishlisttbl where listName = '".addslashes($listName)."' and groupId='$groupDataId'";
		$execListQuery=mysql_query($getListQuery)or die(mysql_error());
		$countListData=mysql_num_rows($execListQuery);
		//echo $countListData; 
		if($countListData > 0)
		{
		   $created=date("Y-m-d : H:i:s");
		   
		   // list
		   $listDelData = mysql_fetch_array($execListQuery);
		   $typelist = "list";
			 
		   $contentDelList=array("groupName"=>$groupName,"uniKey"=>$listDelData['uniKey'],"type"=>$typelist,"time"=>$created);
		   $dbcon->insert_query("deleted_items",$contentDelList);
	   
		   //wishlisttbl
		   $dbcon->execute_query("delete from wishlisttbl where listName = '".addslashes($listName)."' and groupId='$groupDataId'");
		   $message="Success"; 
		   //itemListtbl
		   $getItemQuery="select * from itemlisttbl where listName='$listName' and groupName='$groupName'";
		   $execItemQuery=mysql_query($getItemQuery)or die(mysql_error());
		   $countItemData=mysql_num_rows($execItemQuery);
		   if($countItemData >=0 ) 
		   {
		   	   // items
			   while($itemDelData = mysql_fetch_array($execItemQuery))
			   {
			  	 $typeitem = "item";
				 $contentDelList=array("groupName"=>$groupName,"uniKey"=>$itemDelData['uniKey'],"type"=>$typeitem,"time"=>$created);
			   	 $dbcon->insert_query("deleted_items",$contentDelList);
			   }
					   
			   // stores
			   $getStoreQuery="select * from storetbl where listName='$listName' and groupName='$groupName'";
		       $execStoreQuery=mysql_query($getStoreQuery)or die(mysql_error());
		       $countStoreData=mysql_num_rows($execStoreQuery);
			   
			   while($storeDelData = mysql_fetch_array($execItemQuery))
			   {
			  	 $typestore = "store";
				 $contentDelList=array("groupName"=>$groupName,"uniKey"=>$storeDelData['uniKey'],"type"=>$typestore,"time"=>$created);
			   	 $dbcon->insert_query("deleted_items",$contentDelList);
			   }
			   
			   $dbcon->execute_query("delete from itemlisttbl where listName='$listName' and groupName='$groupName'");
			   $dbcon->execute_query("delete from storetbl where listName='$listName' and groupName='$groupName'");
			   $message="Success"; 
		   }
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

//http://localhost/ilist/admin/xmlservice/deleteList.php?groupName=a2&listName=listingnew
//http://www.palmerapplications.com/ilist/admin/xmlservice/deleteList.php?groupName=a2&listName=listingnew

?>