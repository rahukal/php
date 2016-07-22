<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
require_once("../includes/generalFunction.php");

$dbcon =  new MySQL();
$siteObj =  new SiteManager();
$groupName = $_REQUEST['groupName'];
$deviceId = $_REQUEST['deviceId'];
$current_time=date("Y-m-d : H:i:s");
//$groupName = "mygroup";
if($groupName!='')
{
     $message = "";
	 $ifExistsName = $siteObj->checkIfExists("grouptbl","groupName",trim($groupName));
	 if($ifExistsName) {  }
	 else{ $message .= "This group does not exist.";  }
 
     if($message=="")
	  {
	        $lastUpdated = $siteObj->getUpdateTimeCache($groupName,$deviceId);
			
			//updating the time at updated table
			
			$updateTimeTbl=array("groupName"=>$groupName,"deviceId"=>$deviceId,"updated_time"=>$current_time);
			$upQuery="select * from update_data_time_tbl where groupName='$groupName' and deviceId='$deviceId'";
			$execUpQuery=mysql_query($upQuery)or die(mysql_error());
			$checkIfExists=mysql_num_rows($execUpQuery);
			if($checkIfExists >0)
			{
			 $condition2=" where deviceId = '$deviceId' and groupName='$groupName'";
			 $res2 = $dbcon->update_query("update_data_time_tbl",$updateTimeTbl,$condition2);
			}
			else
			{
			  $dbcon->insert_query("update_data_time_tbl",$updateTimeTbl);
			}
			
			
     	    @$xml_output  .= "<stores>\n"; 
		    $showItems="select * from storetbl where groupName = '$groupName' and created_date >= '".$lastUpdated."' order by storeId"; 
		    $execItemsQuery=mysql_query($showItems)or die(mysql_error());
	        $count_items=mysql_num_rows($execItemsQuery);
			 
			while($items=mysql_fetch_array($execItemsQuery))
			  { 
				  if($items['storeName']!="")
				   {
				    
					$groupName = $items['groupName'];
					
					/*$showQuery="select * from grouptbl where groupName='$groupName'";
					$execShowQuery=mysql_query($showQuery)or die(mysql_error());
					$groupData = mysql_fetch_array($execShowQuery);
										
				    $getListQuery="select * from wishlisttbl where listName='".addslashes($items['listName'])."' and groupId='".$groupData['groupId']."'";
         	  		$execListQuery=mysql_query($getListQuery)or die(mysql_error());
					$listData = mysql_fetch_array($execListQuery);
					
					$getItemQuery="select * from itemlisttbl where listName='".addslashes($items['listName'])."' and groupName='$groupName'";
         	  		$execItemQuery=mysql_query($getItemQuery)or die(mysql_error());
			 		$itemData = mysql_fetch_array($execItemQuery);*/
					
				   			   
					$xml_output  .= "<store_items>\n"; 
					$xml_output  .= "\t\t<storeId>".$items['storeId']."</storeId>\n";
					$xml_output  .= "\t\t<uniKey>".$items['uniKey']."</uniKey>\n";
					/*$xml_output  .= "\t\t<listUniKey>".$listData['uniKey']."</listUniKey>\n";
					$xml_output  .= "\t\t<itemUniKey>".$itemData['uniKey']."</itemUniKey>\n";*/
					$xml_output  .= "\t\t<storeName>".replaceSpecialStr($items['storeName'])."</storeName>\n";
					$xml_output  .= "\t\t<storeAddress>".replaceSpecialStr($items['storeAddress'])."</storeAddress>\n";
					$xml_output  .= "\t\t<itemName>".replaceSpecialStr($items['itemName'])."</itemName>\n";
					$xml_output  .= "\t\t<listName>".replaceSpecialStr($items['listName'])."</listName>\n";
					$xml_output  .= "\t\t<groupName>".replaceSpecialStr($items['groupName'])."</groupName>\n";
					$xml_output  .= "\t\t<checkValue>".$items['checkValue']."</checkValue>\n";
					$xml_output  .= "</store_items>\n"; 
				   }
			  }
			  
			@$xml_output  .= "</stores>\n";
			  
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
}
else
{
  echo "0";
}

//http://localhost/ilist/admin/xmlservice/getGroupStores.php?groupName=name_testing
//http://www.ilistapp.com/baby_registry/admin/xmlservice/getUpdatedStores.php?groupName=bug



?>


