<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$groupName = $_REQUEST['groupName'];
$groupName = str_replace("amp","&", $groupName);

if($groupName!='')
{
 	$message = "";
	$showQuery="select * from group_invitation where groupName='$groupName'";
	$execShowQuery=mysql_query($showQuery)or die(mysql_error());
	$count_data=mysql_num_rows($execShowQuery);
	
	//echo "count data".$count_data;
	if($count_data > 0) { $message=""; } else { $message="Failure"; }
	if($message=="")
	{
	  	$dbcon->execute_query("delete from group_invitation where groupName='$groupName'");
		$message="Success"; 
    }
	
	echo $message;
	/*@$xml_output  .= "<login>\n"; 
	$xml_output  .= "\t\t<message>".$message."</message>\n";
	$xml_output  .= "</login>";
	$xml_output .= "\n\t</document>";
	
	$xml_output = str_replace('&',"&amp;",$xml_output);
	$xml_output = str_replace('"',"&quot;",$xml_output);
	$xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<document>".$xml_output;
		
	header ("Content-Type:text/xml"); 
	header("Cache-Control: private, max-age=0, pre-check=0, post-check=0");
	header("Content-Length: ".strlen($xml_output));
	echo $xml_output ;*/

}
else
{
	 echo "0";
}

//http://localhost/ilist/admin/xmlservice/deleteItem.php?groupName=grocerygroup&listName=My List&itemName=BBQ Sauce Honey
//http://www.ilistapp.com/ilist/admin/xmlservice/deleteGroupInvitation.php?groupName=grceryGroup

?>