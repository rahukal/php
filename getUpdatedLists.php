<?php
ini_set('error_log','my_file.log');
ini_set('display_errors',1);
error_reporting(E_ALL);

require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
require_once("../includes/generalFunction.php");

$dbcon =  new MySQL();
$siteObj =  new SiteManager();
$groupName = $_REQUEST['groupName'];
$deviceId = $_REQUEST['deviceId'];
$groupName = str_replace("amp","&", $groupName);
$current_time=date("Y-m-d : H:i:s");


if($groupName!='')
{
    $lastUpdated = $siteObj->getUpdateTimeCache($groupName,$deviceId);
	/*$date = new DateTime($lastUpdated);
	$date->modify("-2 min");
	$lastUpdated = $date->format("Y-m-d H:i:s");*/
	
	
	//getting items 
    $showQuery="select * from wishlisttbl a left join grouptbl b ON b.groupId=a.groupId where groupName = '$groupName' and a.date >= '".$lastUpdated."'  order by listId";
    $execShowQuery=mysql_query($showQuery)or die(mysql_error());
	$count_data=mysql_num_rows($execShowQuery);
    if($count_data >0)
	  {
     	  while($line=mysql_fetch_array($execShowQuery))
			{ 
			  @$xml_output  .= "<list>\n"; 
			  $xml_output  .= "\t\t<list_name>".replaceSpecialStr($line['listName'])."</list_name>\n";
			  $xml_output  .= "\t\t<uniKey>".replaceSpecialStr($line['uniKey'])."</uniKey>\n";
			  $xml_output  .= "</list>\n";
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
		//echo "0";  
		
	  }
}
else
{
  echo "0";
}

//http://localhost/ilist/admin/xmlservice/getGroupData.php?groupName=McNeilly
//http://www.palmerapplications.com/ilist/admin/xmlservice/getUpdatedData.php?groupName=McNeilly
//http://www.ilistapp.com/baby_registry/admin/xmlservice/getUpdatedLists.php?groupName=testtest
?>

<?php
//$compressor->finish();
?>
