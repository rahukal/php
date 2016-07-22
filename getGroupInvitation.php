<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");

$dbcon =  new MySQL();
$siteObj =  new SiteManager();
$groupName = $_REQUEST['groupName'];
$groupName = str_replace("amp","&", $groupName);

//$groupName = "mygroup";
if($groupName!='')
{
	$showQuery="select * from group_invitation where groupName='$groupName'";
	$execShowQuery=mysql_query($showQuery)or die(mysql_error());
	$count_data=mysql_num_rows($execShowQuery);
	if($count_data >0)
	  {
		  while($line=mysql_fetch_array($execShowQuery))
			{ 
		    	 @$xml_output  .= "<invitation>\n"; 
				 $xml_output  .= "\t\t<greeting_text>".$line['greeting_text']."</greeting_text>\n";
				 $xml_output  .= "\t\t<names>".$line['names']."</names>\n";
				 
				  $xml_output  .= "\t\t<timings>".$line['timings']."</timings>\n";
				 $xml_output  .= "\t\t<address>".$line['address']."</address>\n";
				 
				 $xml_output  .= "</invitation>";
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
		    @$xml_output .= "\n\t</document>";
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

//http://localhost/ilist/admin/xmlservice/getGroupInvitation.php?groupName=grceryGroup
//http://www.ilistapp.com/ilist/admin/xmlservice/getGroupInvitation.php?groupName=Birthday



?>
