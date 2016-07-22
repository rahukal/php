<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$groupName = $_REQUEST['groupName'];
$listName = $_REQUEST['listName'];

$itemOldName = $_REQUEST['itemOldName'];
$itemNewName = $_REQUEST['itemNewName'];

//item parameters
$quantity = $_REQUEST['quantity'];

$size = $_REQUEST['size'];
$unitType = $_REQUEST['unitType'];
$packageType = $_REQUEST['packageType'];



$price = $_REQUEST['price'];
$remarks = $_REQUEST['remarks'];
$coupon = $_REQUEST['coupon'];
$barcode = $_REQUEST['barcode'];
$category = $_REQUEST['category'];
$brand = $_REQUEST['brand'];

$img = $_REQUEST['img'];
$tax1 = $_REQUEST['tax1'];
$tax2 = $_REQUEST['tax2'];
//$status = $_REQUEST['status'];
$created=date("Y-m-d : H:i:s");

if($groupName!='')
{
 	$message = "";
    if($message=="")
	{
		//$message = "Success"; 
		$dbcon->execute_query("select * from itemlisttbl where name='".addslashes($itemOldName)."' and listName = '".addslashes($listName)."' and groupName='$groupName'");
		$Records=$dbcon->fetch_one_record();
		if($Records)
		{
		    $content=array("name"=>$itemNewName,"quantity"=>$quantity,
						   "size"=>$size,"unitType"=>$unitType,"packageType"=>$packageType,
						    "price"=>$price,"remarks"=>$remarks,"coupon"=>$coupon,
						 "barcode"=>$barcode,"category"=>$category,"brand"=>$brand,"img"=>$img,"tax1"=>$tax1,"tax2"=>$tax2,"date"=>$created);
			$condition=" where name='".addslashes($itemOldName)."' and  listName = '".addslashes($listName)."' and groupName='$groupName'";
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

/*http://localhost/ilist/admin/xmlservice/replaceItem.php?itemOldName=Actifed Sinus&itemNewName=Actifed_Sinus&listName=My List&groupName=a3&quantity=3&price=26.00&remarks=this_is_about_remarks_and_testing&coupon=couponinfoishere&barcode=121215122444212&category=Health/Beauty
&brand=Luxicap&img=&tax1=2&tax2=1/
 
/*http://www.palmerapplications.com/ilist/admin/xmlservice/replaceItem.php?itemOldName=Actifed Sinus&itemNewName=Actifed_Sinus&listName=My List&groupName=a3&quantity=3&price=26.00&remarks=this_is_about_remarks_and_testing&coupon=couponinfoishere&barcode=121215122444212&category=Health/Beauty
&brand=Luxicap&img=&tax1=2&tax2=1
*/
?>