<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
require("GTranslate.php");

$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$groupName = $_REQUEST['groupName'];
$deviceId = $_REQUEST['deviceId'];
$groupName = str_replace("amp","&", $groupName);
$current_time=date("Y-m-d : H:i:s");

if($groupName!='')
{
      $lastUpdated = $siteObj->getLastUpdateTime($groupName,$deviceId);
	  $date = new DateTime($lastUpdated);
	  $date->modify("-2 min");
	  $lastUpdated = $date->format("Y-m-d H:i:s");
	  
	  //updating the time at updated table
		/*$updateTimeTbl=array("groupName"=>$groupName,"deviceId"=>$deviceId,"updated_time"=>$current_time);
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
		}*/
	  
	  if($lastUpdated)
	  { 
	    
	   $updateTimeTbl=array("groupName"=>$groupName,"deviceId"=>$deviceId,"updated_time"=>$current_time,"last_updated_cache"=>$lastUpdated);	
	   $condition2=" where deviceId = '$deviceId' and groupName='$groupName'";
	   $res2 = $dbcon->update_query("update_data_time_tbl",$updateTimeTbl,$condition2);
	  }
	 
	  $showQuery="select * from deleted_items where  (groupName='$groupName') and ((type='item') or (type='list') or (type='store')) and (time >= '".$lastUpdated."')";
      $execShowQuery=mysql_query($showQuery)or die(mysql_error());
	  $count_data=mysql_num_rows($execShowQuery);
	
	  if($count_data >0)
	  {
	      $showItemQuery="select * from deleted_items where  (groupName='$groupName') and (type='item') and (time >= '".$lastUpdated."')";
      	  $execItemShowQuery=mysql_query($showItemQuery)or die(mysql_error());
	      $count_item_data=mysql_num_rows($execItemShowQuery);
	      if($count_item_data > 0)
		  {
		   @$xml_output  .= "<items>\n"; 
		   while($lineItems=mysql_fetch_array($execItemShowQuery))
			{ 
				@$xml_output  .= "<item>\n"; 
				$xml_output  .= "\t\t<key>".$lineItems['uniKey']."</key>\n";
			   $xml_output  .= "</item>";
			}
			$xml_output  .= "</items>";
		   }	
		  
		  // lists 
		  $showItemQuery="select * from deleted_items where  (groupName='$groupName') and (type='list') and (time >= '".$lastUpdated."')";
      	  $execItemShowQuery=mysql_query($showItemQuery)or die(mysql_error());
	      $count_item_data=mysql_num_rows($execItemShowQuery);
	      if($count_item_data > 0)
		  {
		   @$xml_output  .= "<lists>\n"; 
		   while($lineItems=mysql_fetch_array($execItemShowQuery))
			{ 
				@$xml_output  .= "<list>\n"; 
				$xml_output  .= "\t\t<key>".$lineItems['uniKey']."</key>\n";
			   $xml_output  .= "</list>";
			}
			$xml_output  .= "</lists>";
		   }	
		   // stores 
		  $showItemQuery="select * from deleted_items where  (groupName='$groupName') and (type='store') and (time >= '".$lastUpdated."')";
      	  $execItemShowQuery=mysql_query($showItemQuery)or die(mysql_error());
	      $count_item_data=mysql_num_rows($execItemShowQuery);
	      if($count_item_data > 0)
		  {
		   @$xml_output  .= "<stores>\n"; 
		   while($lineItems=mysql_fetch_array($execItemShowQuery))
			{ 
				@$xml_output  .= "<store>\n"; 
				$xml_output  .= "\t\t<key>".$lineItems['uniKey']."</key>\n";
			   $xml_output  .= "</store>";
			}
			$xml_output  .= "</stores>";
		   }	
		   
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
	     @$xml_output .= "\n\t</document>";
		   $xml_output = str_replace('&',"&amp;",$xml_output);
		   $xml_output = str_replace('"',"&quot;",$xml_output);
		   $xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<document>".$xml_output;
		   header ("Content-Type:text/xml"); 
		   header("Cache-Control: private, max-age=0, pre-check=0, post-check=0");
		   header("Content-Length: ".strlen($xml_output));
		   echo $xml_output ;
	  }
  
}
else
{
  echo "0";
}

//http://localhost/ilist/admin/xmlservice/getMasterList.php?locale=it
//http://www.ilistapp.com/baby_registry/admin/xmlservice/getDeletedItems.php?groupName=Gr&deviceId=9de001a8b88b9ed764e88de9525f3992370014a8


?>


