<?php

ini_set('display_errors',1);

error_reporting(E_ALL);

require '../conn/MySQL.php';

require_once("../classes/class.SiteManager.php");

$dbcon =  new MySQL();

$siteObj =  new SiteManager();



$message = "";

$groupName = $_REQUEST['groupName'];

//$wishListData = $_REQUEST['wishListData'];

//$storesData = $_REQUEST['storesData'];

$itemsData = "[{\"id\":\"1\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health / Beauty\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"Aaa Mmmm - Ccccccl\",\"listName\":\"My List\"},{\"id\":\"2\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health / Beauty\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"b\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"Aaaaa Vvvvv Crrrr - Clearasil\",\"listName\":\"My List\"},{\"id\":\"3\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health / Beauty\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"Aaaaa Saaaa\",\"listName\":\"My List\"},{\"id\":\"4\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Sports\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"Admni\",\"listName\":\"My List\"},{\"id\":\"5\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health / Beauty\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"Adddvvvvv\",\"listName\":\"My List\"},{\"id\":\"6\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health / Beauty\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"Aaaaa Tablets\",\"listName\":\"My List\"},{\"id\":\"7\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health / Beauty\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"After Shave - Aqua Velva\",\"listName\":\"My List\"},{\"id\":\"8\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health / Beauty\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"After Shave - Mennen Skin Bracer\",\"listName\":\"My List\"},{\"id\":\"9\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health / Beauty\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"After Shave - Old Spice\",\"listName\":\"My List\"},{\"id\":\"10\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health / Beauty\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"After Shave - Williams Lectric Shave\",\"listName\":\"My List\"},{\"id\":\"11\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Cleaning Supplies\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"Air Freshner\",\"listName\":\"My List\"},{\"id\":\"12\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"TTTTTTTTTTT\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"Headphone\",\"listName\":\"My List\"},{\"id\":\"13\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"TTTTTTTTTTT\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"IPod\",\"listName\":\"My List\"},{\"id\":\"14\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Hospital\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"My Master Item1\",\"listName\":\"My List\"},{\"id\":\"15\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"My Master Item2\",\"listName\":\"My List\"},{\"id\":\"16\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"My Master Item3\",\"listName\":\"My List\"},{\"id\":\"17\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Hospital\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"My Master Item4\",\"listName\":\"My List\"},{\"id\":\"18\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Game\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"My item 5\",\"listName\":\"My List\"},{\"id\":\"19\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Communication\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"Nokia\",\"listName\":\"My List\"},{\"id\":\"20\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Game\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"Playing cards\",\"listName\":\"My List\"},{\"id\":\"21\",\"brand\":\"\",\"remarks\":\"\",\"category\":\"Health / Beauty\",\"quantity\":\"1\",\"coupon\":\"\",\"store\":\"\",\"tax2\":\"\",\"statusType\":\"a\",\"price\":\"1\",\"tax1\":\"\",\"barcode\":\"\",\"name\":\"Acne Vanishing Cream - Clearasil\",\"listName\":\"list\"}]";



if($groupName!='')

{

	//inserting data

	if($message=="")

	{

		$showQuery="select * from grouptbl where groupId='$groupName'";

		$execShowQuery=mysql_query($showQuery)or die(mysql_error());

		$count_data=mysql_num_rows($execShowQuery);

		if($message=="")

		{

		   $groupData = mysql_fetch_array($execShowQuery);	

		   //wish list table	

		  /* $wishListArray = json_decode(stripslashes($wishListData));

		   foreach($wishListArray as $listing=>$wishList)

			{

			   $name = $wishList->name;

			   $created=date("Y-m-d : H:i:s");

			   $contentWishList=array("listName"=>$name,"groupId"=>$groupData['groupId'],"date"=>$created);

			   $dbcon->insert_query("wishlisttbl",$contentWishList);

			 }*/

		   //item list table	

		   $itemsListArray = json_decode(stripslashes($itemsData));

		   foreach($itemsListArray as $listing=>$itemsList)

			{

			   $name = $itemsList->name;

			   $listName =$itemsList->listName;

			   $quantity  = $itemsList->quantity;

			   $price = $itemsList->price;

			   $remarks = $itemsList->remarks;

			   $coupon = $itemsList->coupon;

			   $barcode = $itemsList->barcode;

			   $category  = $itemsList->category;

			   $brand  = $itemsList->brand;

			   $tax1  = $itemsList->tax1;

			   $tax2  = $itemsList->tax2;

			   

			   /*$content=array("listName"=>$listName,"name"=>$name,"quantity"=>$quantity,"price"=>$price,"remarks"=>$remarks, "coupon"=>$coupon,"barcode"=>$barcode,"category"=>		               $category, "brand"=>$brand,"tax1"=>$tax1,"tax1"=>$tax2);

			   $condition=" where listName=$listName";

			   $dbcon->update_query("itemlisttbl",$content,$condition);*/

			    //$message .= "Success";

			}

		    //stores list table	

/*		    $storeListArray = json_decode(stripslashes($storesData));

		    foreach($storeListArray as $listing=>$storeList)

			{

			   $storeName = $storeList->storeName;

			   $itemName = $storeList->itemName;

			   $groupName = $groupName;

			 			 

			   $contentStoreList=array("storeName"=>$storeName,"itemName"=>$itemName,"groupName"=>$groupName);

			   $dbcon->insert_query("storetbl",$contentStoreList);

			}

*/			

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



//http://localhost/bridal_registry/admin/xmlservice/mergeGroupData.php?itemsData=itemsData&groupName=group

//http://www.palmerapplications.com/bridal_registry/admin/xmlservice/mergeGroupData.php?itemsData=itemsData&groupName=group



?>