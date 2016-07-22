<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$groupName = urldecode($_REQUEST['groupName']);
$listName = urldecode($_REQUEST['listName']);
$itemName = urldecode($_REQUEST['itemName']);

$groupName = str_replace("amp","&", $groupName);
$itemName = str_replace("amp","&", $itemName);
$listName = str_replace("amp","&", $listName);

$created=date("Y-m-d : H:i:s");

$quantity = $_REQUEST['quantity'];

if($groupName!='')
{
 	$message = "";
    if($message=="")
	{
		//$message = "Success"; 
		
		  $showQuery="select * from itemlisttbl where name = '".addslashes($itemName)."' and listName = '".addslashes($listName)."' and groupName='$groupName'";
		  $execShowQuery=mysql_query($showQuery)or die(mysql_error());
		  $count_data=mysql_num_rows($execShowQuery);
	      if($count_data <  0) 
		  {
		    $message =  "Failure";	  
		  }
		  else
		  {
		    $content=array("quantity"=>$quantity,"date"=>$created);
			$condition=" where name = '".addslashes($itemName)."' and listName = '".addslashes($listName)."' and groupName='$groupName'";
		 	$res = $dbcon->update_query("itemlisttbl",$content,$condition);
			$message =  "Success";
			
			$dbcon->execute_query("select * from itemlisttbl where name = '".addslashes($itemName)."' and listName = '".addslashes($listName)."' and groupName='$groupName'");
			$quan=$dbcon->fetch_one_record();
			$quant = $quan['quantity'];
			$message =  "Success";
		  }
		  
		/*$dbcon->execute_query("select * from itemlisttbl where name = '".addslashes($itemName)."' and listName = '".addslashes($listName)."' and groupName='$groupName'");
		$Records=$dbcon->fetch_one_record();
		if($Records)
		{
		 
			$dbcon->execute_query("select * from itemlisttbl where name = '".addslashes($itemName)."' and listName = '".addslashes($listName)."' and groupName='$groupName'");
			$quan=$dbcon->fetch_one_record();
			$quant = $quan['quantity'];
			$message =  "Success";
		}
		else
		{
			$message =  "Failure";
			
		}*/
   }
	@$xml_output  .= "<login>\n"; 
	$xml_output  .= "\t\t<message>".$message."</message>\n";
	$xml_output  .= "\t\t<rec_quantity>".$quantity."</rec_quantity>\n";
	$xml_output  .= "\t\t<quantity>".$quant."</quantity>\n";
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

//http://localhost/ilist/admin/xmlservice/updateQuantity.php?groupName=a2&listName=My List&itemName=Actifed&quantity=3
//http://www.ilistapp.com/wedding_registry/admin/xmlservice/updateQuantity.php?groupName=Datagroup&listName=Bedding amp Bath&itemName=Shun Classic 10-Piece Knife Block Set&quantity=5

?>