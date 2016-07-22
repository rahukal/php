<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$message = "";
$groupName = $_REQUEST['groupName'];
$wishListData = $_REQUEST['wishListData'];
$storesData = $_REQUEST['storesData'];
$itemsData = $_REQUEST['itemsData'];


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
		   //wish list table	
		   $wishListArray = json_decode(stripslashes($wishListData));
		   if(!empty($wishListArray))
		    {
			   foreach($wishListArray as $listing=>$wishList)
				{
				   $name = addslashes($wishList->name);
				  
				 //  $name  = "{".$name."}";
				   $getListQ="select * from wishlisttbl where listName='".addslashes($name)."' and groupId = '".$groupDataId."'";
				   $execListQ=mysql_query($getListQ)or die(mysql_error());
				   $c_list=mysql_num_rows($execListQ);
				   if($c_list <= 0)
					{   
					   $created=date("Y-m-d : H:i:s");
					   $listUniKey = addslashes($wishList->uniKey);
			
					   
					   $contentWishList=array("uniKey"=>$listUniKey,"listName"=>$name,"groupId"=>$groupData['groupId'],"date"=>$created);
					   $dbcon->insert_query("wishlisttbl",$contentWishList);
				    }
				}
			}	
		   //item list table	
		   $itemsListArray = json_decode(stripslashes($itemsData));
		   if(!empty($itemsListArray))
		    {
			   foreach($itemsListArray as $listing=>$itemsList)
				{
				   $name = addslashes($itemsList->name);
				   $listName = addslashes($itemsList->listName);
										   
				   $getListQuery="select * from wishlisttbl where listName='".addslashes($listName)."' and groupId = '".$groupDataId."'";
				   $execListQuery=mysql_query($getListQuery)or die(mysql_error());
				   $count_list=mysql_num_rows($execListQuery);
				   if($count_list > 0)
				   {
					   $groupName = $groupName;
					   $quantity  = $itemsList->quantity;
					   
					   $size  = $itemsList->size;
					   $unitType  = $itemsList->unitType;
					   $packageType  = $itemsList->packageType;
					   
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
					   
							
					   $getItemQuery="select * from itemlisttbl where name='".addslashes($name)."' and listName='".addslashes($listName)."' and groupName = '".$groupName."'";
					   $execItemQuery=mysql_query($getItemQuery)or die(mysql_error());
					   $count_item=mysql_num_rows($execItemQuery);
					   
					   if($count_item <= 0)
					   {
						   $listData = mysql_fetch_array($execListQuery);
						   $listId = $listData['listId'];
						
						   $itemUniKey = addslashes($itemsList->uniKey);
							 
							$content=array("listId"=>$listId,"uniKey"=>$itemUniKey,"listName"=>$listName,"groupName"=>$groupName,"name"=>$name,"quantity"=>$quantity,
							"size"=>$size,"unitType"=>$unitType,"packageType"=>$packageType,
							"price"=>$price,"remarks"=>$remarks, 
							"coupon"=>$coupon,"img"=>$img, "barcode"=>$barcode,"category"=>$category,"brand"=>$brand,"tax1"=>$tax1,"status"=>$statusType,"date"=>$created);
							$dbcon->insert_query("itemlisttbl",$content);
					   }
				 
				   }
				}
			}
		    //stores list table	
		    $storeListArray = json_decode(stripslashes($storesData));
			if(!empty($storeListArray))
		    {
				foreach($storeListArray as $listing=>$storeList)
				{
				   $storeName = $storeList->storeName;
				   $storeAddress = $storeList->storeAddress;
				   $itemName =  $storeList->itemName;
				   $listName =   addslashes($storeList->listName);
				   $groupName = $groupName;
				   $checkValue = $storeList->checkValue;
					$storeUniKey = addslashes($storeList->uniKey);	
								 
				   $contentStoreList=array("uniKey"=>$storeUniKey,"storeName"=>$storeName,"itemName"=>$itemName,"listName"=>$listName,"groupName"=>$groupName,"checkValue"=>$checkValue,"created_date"=>$created);
				   $dbcon->insert_query("storetbl",$contentStoreList);
				   //$message .= "StoreListSuccess";
				}
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

//http://localhost/ilist/admin/xmlservice/uploadGroupData.php?itemsData=itemsData&groupName=group
//http://www.ilistapp.com/wedding_registry/admin/xmlservice/uploadGroupData.php?itemsData=itemsData&groupName=ss&wishListData=data&storesData=data

?>