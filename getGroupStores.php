<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
require_once("../includes/generalFunction.php");

$dbcon =  new MySQL();
$siteObj =  new SiteManager();
$groupName = $_REQUEST['groupName'];
//$groupName = "mygroup";
if($groupName!='')
{
     $message = "";
	 $ifExistsName = $siteObj->checkIfExists("grouptbl","groupName",trim($groupName));
	 if($ifExistsName) {  }
	 else{ $message .= "This group does not exist.";  }
 
     if($message=="")
	  {
     	    @$xml_output  .= "<stores>\n"; 
		    $showItems="select * from storetbl where groupName = '$groupName' order by storeId "; 
		     $execItemsQuery=mysql_query($showItems)or die(mysql_error());
	         $count_items=mysql_num_rows($execItemsQuery);
			 
			while($items=mysql_fetch_array($execItemsQuery))
			  { 
				  if($items['storeName']!="")
				   {
					$xml_output  .= "<store_items>\n"; 
					$xml_output  .= "\t\t<storeId>".$items['storeId']."</storeId>\n";
					$xml_output  .= "\t\t<uniKey>".$items['uniKey']."</uniKey>\n";
					$xml_output  .= "\t\t<storeName>".replaceSpecialStr($items['storeName'])."</storeName>\n";
					$xml_output  .= "\t\t<storeAddress>".replaceSpecialStr($items['storeAddress'])."</storeAddress>\n";
					$xml_output  .= "\t\t<itemName>".replaceSpecialStr($items['itemName'])."</itemName>\n";
					$xml_output  .= "\t\t<listName>".replaceSpecialStr($items['listName'])."</listName>\n";
					$xml_output  .= "\t\t<groupName>".replaceSpecialStr($items['groupName'])."</groupName>\n";
					$xml_output  .= "\t\t<checkValue>".$items['checkValue']."</checkValue>\n";
					$xml_output  .= "</store_items>\n"; 
				   }
			  }
			  
			$xml_output  .= "</stores>\n";
			  
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
//http://www.ilistapp.com/baby_registry/admin/xmlservice/getGroupStores.php?groupName=ui



?>


