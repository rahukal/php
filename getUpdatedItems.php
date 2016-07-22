<?php
ini_set('error_log','my_file.log');
ini_set('display_errors',1);
error_reporting(E_ALL);

require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
require_once("../includes/generalFunction.php");

$dbcon =  new MySQL();
$siteObj =  new SiteManager();
$groupName = $_REQUEST['groupName'];
$deviceId = $_REQUEST['deviceId'];
$groupName = str_replace("amp","&", $groupName);
$current_time=date("Y-m-d : H:i:s");


if($groupName!='')
{
    $lastUpdated = $siteObj->getUpdateTimeCache($groupName,$deviceId);
	//getting items 
     $showItems="select * from itemlisttbl where groupName='$groupName' and date >='".$lastUpdated."' ";
	 // echo $showItems;
	 //exit;
	  $execItemsQuery=mysql_query($showItems)or die(mysql_error());
     $count_items=mysql_num_rows($execItemsQuery);
	 if($count_items>0)
		{
			while($items=mysql_fetch_array($execItemsQuery))
			 { 
			 	  if($items['name']!="")
					   {
					       $getListQuery="select * from wishlisttbl where listId='".$items['listId']."'";
         	  			   $execListQuery=mysql_query($getListQuery)or die(mysql_error());
			  			   $count_list=mysql_num_rows($execListQuery);
						   
						   $listData = mysql_fetch_array($execListQuery);
					   				   
							@$xml_output  .= "<item>\n"; 
							$xml_output  .= "\t\t<name>".replaceSpecialStr($items['name'])."</name>\n";
							$xml_output  .= "\t\t<listName>".replaceSpecialStr($items['listName'])."</listName>\n";
							$xml_output  .= "\t\t<quantity>".replaceSpecialStr($items['quantity'])."</quantity>\n";
							$xml_output  .= "\t\t<uniKey>".$items['uniKey']."</uniKey>\n";
							$xml_output  .= "\t\t<listUniKey>".$listData['uniKey']."</listUniKey>\n";
							$xml_output  .= "\t\t<size>".replaceSpecialStr($items['size'])."</size>\n";
							$xml_output  .= "\t\t<unitType>".replaceSpecialStr($items['unitType'])."</unitType>\n";
							$xml_output  .= "\t\t<packageType>".replaceSpecialStr($items['packageType'])."</packageType>\n";
							
							$xml_output  .= "\t\t<price>".replaceSpecialStr($items['price'])."</price>\n";
							$xml_output  .= "\t\t<remarks>".replaceSpecialStr($items['remarks'])."</remarks>\n";
							$xml_output  .= "\t\t<coupon>".replaceSpecialStr($items['coupon'])."</coupon>\n";
							$xml_output  .= "\t\t<barcode>".replaceSpecialStr($items['barcode'])."</barcode>\n";
							$xml_output  .= "\t\t<category>".replaceSpecialStr($items['category'])."</category>\n"; 
							$xml_output  .= "\t\t<brand>".replaceSpecialStr($items['brand'])."</brand>\n";
							$xml_output  .= "\t\t<store>".replaceSpecialStr($items['store'])."</store>\n";
							$xml_output  .= "\t\t<img>".$items['img']."</img>\n";
							$xml_output  .= "\t\t<tax1>".replaceSpecialStr($items['tax1'])."</tax1>\n";
							$xml_output  .= "\t\t<tax2>".replaceSpecialStr($items['tax2'])."</tax2>\n";
							$xml_output  .= "\t\t<status>".$items['status']."</status>\n";
							$xml_output  .= "</item>";
					   }
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

//http://localhost/ilist/admin/xmlservice/getGroupData.php?groupName=McNeilly
//http://www.palmerapplications.com/ilist/admin/xmlservice/getUpdatedData.php?groupName=McNeilly
//http://www.ilistapp.com/baby_registry/admin/xmlservice/getUpdatedItems.php?groupName=final1&deviceId=9de001a8b88b9ed764e88de9525f3992370014a8
?>

<?php
//$compressor->finish();
?>
