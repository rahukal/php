<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
require("GTranslate.php");

$dbcon =  new MySQL();
$siteObj =  new SiteManager();
//$gt = new Gtranslate;
$locale = $_REQUEST['locale'];

if($locale!='')
{
	  // for evaluating the transliteration data start
	 /* $dbcon->execute_query("select * from langtbl where locale='$locale'");
	  $Records=$dbcon->fetch_one_record();
	  $translate_to = $Records['name'];
	  $translate_to = "english";*/
	  
	  /*if($Records['name']!="")
	  {
		$translate_to = $Records['name'];
	  }*/
	  
	/*  $translate_string = "This is beautiful";
	  $fname = "english_to_".$translate_to;*/
	  // for evaluating the transliteration data end
	  
	  $showQuery="select * from masterlisttbl a left join masterlist_category b ON b.cat_id=a.cat_id where 1 group by a.name order by itemListId ";
	 
	  $execShowQuery=mysql_query($showQuery)or die(mysql_error());
	  $count_data=mysql_num_rows($execShowQuery);
	  
	  if($count_data >0)
	  {
		  while($line=mysql_fetch_array($execShowQuery))
			{ 
			  if($line['name']!="")
			   {
					@$xml_output  .= "<item>\n"; 
					$xml_output  .= "\t\t<name>".stripslashes(ucfirst(trim($line['name'])))."</name>\n";
					$xml_output  .= "\t\t<category>".stripslashes(ucfirst(trim($line['category_name'])))."</category>\n";
					
					$xml_output  .= "\t\t<price>".$line['price']."</price>\n";
					$xml_output  .= "\t\t<remarks>".stripslashes(ucfirst(trim($line['remarks'])))."</remarks>\n";
					
					$xml_output  .= "\t\t<coupon>".stripslashes($line['coupon'])."</coupon>\n";
					$xml_output  .= "\t\t<barcode>".$line['barcode']."</barcode>\n";
					$xml_output  .= "\t\t<brand>".stripslashes($line['brand'])."</brand>\n";
					$xml_output  .= "\t\t<store>".stripslashes($line['store'])."</store>\n";
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
  
  
}
else
{
  echo "0";
}

//http://localhost/ilist/admin/xmlservice/getMasterList.php?locale=it
//http://www.palmerapplications.com/ilist/admin/xmlservice/getMasterList.php?locale=it



?>


