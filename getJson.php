<?php

ini_set('display_errors',1);

error_reporting(E_ALL);

require '../conn/MySQL.php';

require_once("../classes/class.SiteManager.php");

$dbcon =  new MySQL();

$siteObj =  new SiteManager();



$json_data = $_REQUEST['json_data'];

if($json_data!='')

{

	$message = ""; 

	$created=date("Y-m-d : H:i:s");

	$content=array( "json_data"	=>$json_data);

	$res = $dbcon->insert_query("test",$content);

 	if($res)

	{

		$message = "Success";

	}

	else

	{

		$message = "Failure"; 

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



//http://localhost/bridal_registry/admin/xmlservice/getJson.php?json_data=test

//http://www.palmerapplications.com/bridal_registry/admin/xmlservice/getJson.php?json_data=test



?>