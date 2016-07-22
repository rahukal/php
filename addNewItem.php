<?php

ini_set('display_errors',1);

error_reporting(0);

require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$message = "";
$groupName = $_REQUEST['groupName'];
$listName = stripslashes($_REQUEST['listName']);
$itemsData = $_REQUEST['itemsData'];


//$itemsData = $_REQUEST['itemsData'];

$created=date("Y-m-d : H:i:s");

if($groupName!='')
{
    //inserting data
	if($message=="")
	{
   	   $showQuery="select * from grouptbl where groupName='$groupName'";
	   $execShowQuery=mysql_query($showQuery)or die(mysql_error());
   	   $count_data=mysql_num_rows($execShowQuery);
       if($message=="")
		{
    	   $groupData = mysql_fetch_array($execShowQuery);	
		   $groupDataId = $groupData['groupId'];
		   
		    //item list table	
		   $itemsListArray = json_decode(stripslashes($itemsData));
		   $listName = addslashes($listName);
		   foreach($itemsListArray as $listing=>$itemsList)
			{
			   $name     = $itemsList->name;
			  // $name = $name;
			   $name = addslashes($name);
			   
			   $groupName = $groupName;
			   
	           $getListQuery="select * from wishlisttbl where listName='".addslashes($listName)."' and groupId = '".$groupDataId."'";
         	   $execListQuery=mysql_query($getListQuery)or die(mysql_error());
			   $count_list=mysql_num_rows($execListQuery);
			   if($count_list > 0)
			   {
			     $listData = mysql_fetch_array($execListQuery);
				 $listId = $listData['listId'];
			   }
			   $quantity  = $itemsList->quantity;
			   $size  = $itemsList->size;
			   $unitType  = $itemsList->unitType;
			   $packageType  = $itemsList->packageType;
			   
			   if($unitType=="Not Set")   {     $unitType="";    }	
			   if($packageType=="Not Set")   {     $packageType="";    }
			   
			   $price = $itemsList->price;
			   $remarks = $itemsList->remarks;
			   $coupon = $itemsList->coupon;
			   $img = $itemsList->img;
			   $barcode = $itemsList->barcode;
			   $category  = $itemsList->category;
			   $brand  = $itemsList->brand;
			   $tax1  = $itemsList->tax1;
			   $tax2  = $itemsList->tax2;
			   $statusType  = $itemsList->statusType;
			   $uniKey = $itemsList->uniKey;
			   
               if($tax1==""){$tax1 = "NO";}
			   if($tax2==""){$tax2 = "NO";}
			   
			   $getItemQuery="select * from itemlisttbl where name='".addslashes($name)."' and  listName='".addslashes($listName)."' and groupName='$groupName'";
         	   $execItemQuery=mysql_query($getItemQuery)or die(mysql_error());
			   $count_item=mysql_num_rows($execItemQuery);
			   if($count_item > 0)
			     {
				    
				 }
			   else
			     {
				     
				    $content=array("uniKey"=>$uniKey,"listId"=>$listId,"listName"=>$listName,"groupName"=>$groupName,"name"=>$name,
						  "quantity"=>$quantity,"size"=>$size,"unitType"=>$unitType,"packageType"=>$packageType, "price"=>$price,"remarks"=>$remarks, 
						  "coupon"=>$coupon,"img"=>$img, "barcode"=>$barcode,"category"=>$category,"brand"=>$brand,"tax1"=>$tax1,"status"=>$statusType,"date"=>$created);
  		                   $dbcon->insert_query("itemlisttbl",$content);
				 }	  
					  //$message .= "Success";
			}

	    }

    }

    @$xml_output  .= "<login>\n"; 
	$xml_output  .= "\t\t<message>Success</message>\n";
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



//http://localhost/ilist/admin/xmlservice/addNewItem.php?itemsData=itemsData&groupName=group&listName=list_name

//http://www.palmerapplications.com/ilist/admin/xmlservice/addNewItem.php?itemsData=itemsData&groupName=group&listName=list_name


?>
