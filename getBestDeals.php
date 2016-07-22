<?php
  require '../conn/Session.php';
  require '../conn/MySQL.php';
  $db =  new MySQL();
  
  $created=date("Y-m-d  H:i:s", time()) ;
  $query="select * from business where isBestDeal = '1' order by name";
  //echo $query;
  $execShowQuery=mysql_query($query) or die(mysql_error());
  
  while($line=mysql_fetch_array($execShowQuery))
  {
	  
     $getCat="select * from category where cat_id = '".$line['cat_id']."' order by cat_id";
     $execCatQuery=mysql_query($getCat) or die(mysql_error());	  
	 $catData=mysql_fetch_array($execCatQuery); 
	  
	$xml_output1  .= "<subCategory>\n"; 
	$xml_output1  .= "\t\t<fldid>".$line['fldid']."</fldid>\n";
	$xml_output1  .= "\t\t<cat_id>".$line['cat_id']."</cat_id>\n";
	$xml_output1  .= "\t\t<category_name>".trim($catData['category_name'])."</category_name>\n";
	$xml_output1  .= "\t\t<subcatName>".$line['name']."</subcatName>\n";
	$xml_output1  .= "\t\t<phoneNumber>".$line['phoneNumber']."</phoneNumber>\n";
	$xml_output1  .= "\t\t<openTime>".$line['openingTime']."</openTime>\n";
	
	$xml_output1  .= "\t\t<location>".$line['location']."</location>\n";
	$xml_output1  .= "\t\t<latitude>".$line['latitude']."</latitude>\n";
	$xml_output1  .= "\t\t<longitude>".$line['longitude']."</longitude>\n";
	$xml_output1  .= "\t\t<url>".$line['url']."</url>\n";
	$xml_output1  .= "\t\t<email>".$line['name']."</email>\n";
	
	$xml_output1  .= "\t\t<description>".$line['description']."</description>\n";
	$xml_output1  .= "\t\t<price>".$line['price']."</price>\n";
	$xml_output1  .= "\t\t<logo>http://sandeepbeniwal.com/santafe/admin/upload/logo/".$line['logo_path']."</logo>\n";
	$xml_output1  .= "\t\t<main_photo>http://sandeepbeniwal.com/santafe/admin/upload/main_photo/".$line['main_photo_path']."</main_photo>\n";
	$xml_output1  .= "\t\t<coupon_text>".$line['coupon_text']."</coupon_text>\n";
	$xml_output1  .= "\t\t<mapImg>http://sandeepbeniwal.com/santafe/admin/upload/map_photo/".$line['mapImagePath']."</mapImg>\n";
	$xml_output1  .= "\t\t<photo_description>".$line['photo_description']."</photo_description>\n";
	$xml_output1  .= "</subCategory>";
  }


$xml_output1 .= "\n\t</document>";
$xml_output1 = str_replace('&',"&amp;",$xml_output1);
$xml_output1 = str_replace('"',"&quot;",$xml_output1);
$xml_output1  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<document>".$xml_output1;

header ("Content-Type:text/xml"); 
header("Cache-Control: private, max-age=0, pre-check=0, post-check=0");
header("Content-Length: ".strlen($xml_output1));
echo $xml_output1 ;

foreach ($_POST as $key => $value){
  $strcomp.= "Key: $key; Value: $value\n";
 }

 $logQuery="insert into logtable(log_id,requst,response)values('','".$strcomp."','')";
$execLogQuery=mysql_query($logQuery)or die(mysql_error());


//http://localhost/santafe/admin/xmlwebservice/getBestDeals.php
//http://www.sandeepbeniwal.com/santafe/admin/xmlwebservice/getBestDeals.php

?>