<?php
ini_set('error_log','my_file.log');
ini_set('display_errors',1);
error_reporting(E_ALL);

require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");

$dbcon =  new MySQL();
$siteObj =  new SiteManager();
$groupName = $_REQUEST['groupName'];
$deviceId = $_REQUEST['deviceId'];
$groupName = str_replace("amp","&", $groupName);
$current_time=date("Y-m-d : H:i:s");


if($groupName!='')
{
    $lastUpdated = $siteObj->getLastUpdateTime($groupName,$deviceId);
	//getting items 
    $showQuery="select * from wishlisttbl a left join grouptbl b ON b.groupId=a.groupId where groupName = '$groupName' and a.date > '".$lastUpdated."'  order by listId";
    $execShowQuery=mysql_query($showQuery)or die(mysql_error());
	$count_data=mysql_num_rows($execShowQuery);
    if($count_data >0)
	  {
     	  while($line=mysql_fetch_array($execShowQuery))
			{ 
			  @$xml_output  .= "<list>\n"; 
			  $xml_output  .= "\t\t<list_name>".stripslashes($line['listName'])."</list_name>\n";
		  
			 $showItems="select * from itemlisttbl where listName = '".addslashes($line['listName'])."' and groupName='$groupName' and date='".$lastUpdated."' group by 
			 name order by itemListId"; 
			/* echo $showItems;
			 exit();*/
		     $execItemsQuery=mysql_query($showItems)or die(mysql_error());
	         $count_items=mysql_num_rows($execItemsQuery);
			
			 while($items=mysql_fetch_array($execItemsQuery))
			  { 
				  if($items['name']!="")
				   {
						$xml_output  .= "<item>\n"; 
						$xml_output  .= "\t\t<name>".stripslashes($items['name'])."</name>\n";
						$xml_output  .= "\t\t<listName>".stripslashes($items['listName'])."</listName>\n";
						$xml_output  .= "\t\t<quantity>".stripslashes($items['quantity'])."</quantity>\n";
						$xml_output  .= "\t\t<uniKey>".$items['uniKey']."</uniKey>\n";
						$xml_output  .= "\t\t<size>".stripslashes($items['size'])."</size>\n";
						$xml_output  .= "\t\t<unitType>".stripslashes($items['unitType'])."</unitType>\n";
						$xml_output  .= "\t\t<packageType>".$items['packageType']."</packageType>\n";
						
						$xml_output  .= "\t\t<price>".number_format($items['price'],2)."</price>\n";
						$xml_output  .= "\t\t<remarks>".stripslashes($items['remarks'])."</remarks>\n";
						$xml_output  .= "\t\t<coupon>".stripslashes($items['coupon'])."</coupon>\n";
						$xml_output  .= "\t\t<barcode>".stripslashes($items['barcode'])."</barcode>\n";
						$xml_output  .= "\t\t<category>".stripslashes($items['category'])."</category>\n"; 
						$xml_output  .= "\t\t<brand>".stripslashes($items['brand'])."</brand>\n";
						$xml_output  .= "\t\t<store>".stripslashes($items['store'])."</store>\n";
						$xml_output  .= "\t\t<img>".$items['img']."</img>\n";
						$xml_output  .= "\t\t<tax1>".stripslashes($items['tax1'])."</tax1>\n";
						$xml_output  .= "\t\t<tax2>".stripslashes($items['tax2'])."</tax2>\n";
						$xml_output  .= "\t\t<status>".$items['status']."</status>\n";
						$xml_output  .= "</item>";
				   }
			  }
			  $xml_output  .= "</list>\n";
			}
			$xml_output .= "\n\t</document>";
			$xml_output = str_replace('&',"&amp;",$xml_output);
			$xml_output = str_replace('"',"&quot;",$xml_output);
			$xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<document>".$xml_output;
			header ("Content-Type:text/xml"); 
			header("Cache-Control: private, max-age=0, pre-check=0, post-check=0");
			header("Content-Length: ".strlen($xml_output));
			echo $xml_output ;
			
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
			//updating the time at updated table
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
		//echo "0";  
		
	  }
}
else
{
  echo "0";
}

//http://localhost/ilist/admin/xmlservice/getGroupData.php?groupName=McNeilly
//http://www.palmerapplications.com/ilist/admin/xmlservice/getUpdatedData.php?groupName=McNeilly
//http://www.ilistapp.com/baby_registry/admin/xmlservice/getUpdatedData.php?groupName=bug
?>

<?php
//$compressor->finish();
?>
