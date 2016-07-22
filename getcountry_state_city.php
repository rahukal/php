<?php

ini_set('display_errors',1);

error_reporting(E_ALL);

require '../conn/MySQL.php';

require_once("../classes/class.SiteManager.php");



$dbcon =  new MySQL();

$siteObj =  new SiteManager();

$country_name = $_REQUEST['country_name'];

//$groupName = "mygroup";

if($country_name!='')

{

    //$showQuery="select * from wishlisttbl where groupId = (select groupId from grouptbl where groupName = '$groupName')  order by listId";

	$showQuery="SELECT country_name, state_name, city_name,country_code, state_code, city_code
FROM tbl_country, tbl_state, tbl_city
WHERE tbl_country.country_id = tbl_state.country_id
AND tbl_state.country_id = tbl_city.country_id";

	// echo $showQuery;

	$execShowQuery=mysql_query($showQuery)or die(mysql_error());

	$count_data=mysql_num_rows($execShowQuery);

	  

	if($count_data >0)

	  {

		  while($line=mysql_fetch_array($execShowQuery))

			{ 

			 
			

			  if($line['country_name']!="")

			   {

				 @$xml_output  .= "<list>\n"; 

				 

				 $xml_output  .= "\t\t<country>".$line['country_name']."</country>\n";
	$xml_output  .= "\t\t<code>".$line['country_code']."</code>\n";
	$xml_output  .= "\t\t<state>".$line['state_name']."</state>\n";

				 
 $xml_output  .= "\t\t<code>".$line['state_code']."</code>\n";
 $xml_output  .= "\t\t<city>".$line['city_name']."</city>\n";
$xml_output  .= "\t\t<code>".$line['city_code']."</code>\n";
				 				 

				 

				 

				 $xml_output  .= "</list>";

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



//http://localhost/bridal_registry/admin/xmlservice/getcountry_state_city.php?country_name=mygroup

//http://www.sandeepbeniwal.com/bridal_registry/admin/xmlservice/getList.php?groupName=Birthday







?>





