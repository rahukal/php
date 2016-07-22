<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");

$dbcon =  new MySQL();
$siteObj =  new SiteManager();
$listName = $_REQUEST['listName'];
$groupName = $_REQUEST['groupName'];
//$groupName = "mygroup";
if($listName!='')
{
   // $showQuery="select * from wishlisttbl a left join grouptbl b ON b.groupId=a.groupId where groupName = '$groupName' order by listId";
	 $showQuery="select * from itemlisttbl a left join wishlisttbl b ON b.listId=a.listId left join grouptbl c ON c.groupId=b.groupId  where listName = '".addslashes($listName)."' and  groupName = '$groupName' order by itemListId";
	 $execShowQuery=mysql_query($showQuery)or die(mysql_error());
	 $count_data=mysql_num_rows($execShowQuery);
	  if($count_data >0)
	  {
		  while($line=mysql_fetch_array($execShowQuery))
			{ 
			  
			  if($line['name']!="")
			   {
				   
				@$xml_output  .= "<item>\n"; 
				$xml_output  .= "\t\t<name>".$line['name']."</name>\n";
				$xml_output  .= "\t\t<quantity>".number_format($line['quantity'],2)."</quantity>\n";
				$xml_output  .= "\t\t<uniKey>".$items['uniKey']."</uniKey>\n";
				$xml_output  .= "\t\t<size>".$items['size']."</size>\n";
				$xml_output  .= "\t\t<unitType>".$items['unitType']."</unitType>\n";
				$xml_output  .= "\t\t<packageType>".$items['packageType']."</packageType>\n";
				
				$xml_output  .= "\t\t<price>".number_format($line['price'],2)."</price>\n";
				$xml_output  .= "\t\t<remarks>".$line['remarks']."</remarks>\n";
				$xml_output  .= "\t\t<coupon>".$line['coupon']."</coupon>\n";
				$xml_output  .= "\t\t<barcode>".$line['barcode']."</barcode>\n";
				$xml_output  .= "\t\t<category>".$line['category']."</category>\n"; 
				
				$xml_output  .= "\t\t<brand>".$line['brand']."</brand>\n";
				$xml_output  .= "\t\t<store>".$line['store']."</store>\n";
				$xml_output  .= "\t\t<img>".$line['img']."</img>\n";
				$xml_output  .= "\t\t<tax1>".$line['tax1']."</tax1>\n";
				$xml_output  .= "\t\t<tax2>".$line['tax2']."</tax2>\n";
				$xml_output  .= "\t\t<status>".$line['status']."</status>\n";
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
		echo "0";  
	  }
}
else
{
  echo "0";
}

//http://localhost/ilist/admin/xmlservice/getListItems.php?listName=testing&groupName=mygroup
//http://www.sandeepbeniwal.com/ilist/admin/xmlservice/getListItems.php?listName=cake&groupName=birthday



?>


