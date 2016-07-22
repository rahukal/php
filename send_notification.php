<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
require '../conn/MySQL.php';
require_once("../classes/class.SiteManager.php");
$dbcon =  new MySQL();
$siteObj =  new SiteManager();

$message = "";
$groupName = $_REQUEST['groupName'];
$deviceId = $_REQUEST['deviceId'];

$groupName = str_replace("amp","&", $groupName);

/*$deviceToken = "5fa4157eb22d62e7b2bcbf92dffb759622ef5a29d187ae5aed806c380203fbc8";
$contentData=array("username_to"=>$username_to,"username_from"=>$username_from,"deviceid"=>$deviceToken);
$dbcon->insert_query("testnoti",$contentData);*/
$status_message = "";
$showQuery="select * from devicetbl where deviceId<>'$deviceId' and deviceId<>''  and groupName='$groupName'";
//echo $showQuery;
$execShowQuery=mysql_query($showQuery)or die(mysql_error());
$count_data=mysql_num_rows($execShowQuery);

if($count_data > 0) { /*$message="Success";*/ }else { $status_message="Failure"; }

if($status_message=="")
  {
	   while($line=mysql_fetch_array($execShowQuery))
			{ 
			    $deviceToken = $line['deviceId'];
				$userExist=1;
				$message = 'You Recieved a new Notifcation from '.$groupName;
				$badge = (int)1;
				$sound = 'cow.caf';
				//$datetime=date("Y-m-d : H:i:s");
				// Construct the notification payload
				$body = array();
				if($userExist==1) 
				{
				   $body['aps'] = array('alert' => $message);
				   $body['aps']['sound'] = $sound;
				   if(isset($badge)) 
					{
					  $body['aps']['badge'] = $badge;
					}
				 else
					{
						$body['aps']['message'] = $message;
					}
					//$body['aps']['date'] =  $datetime;
				}
			
				$ctx = stream_context_create();
				stream_context_set_option($ctx,'ssl','local_cert','apns-dev.pem');
				stream_context_set_option($ctx,'ssl','verify_peer',false);
				//$fp = @stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
				$fp = @stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
				
				if (!$fp) 
				{
				 // print "Failed to connect $err $errstr\n";
				  return;
				}
				else 
				{
				   //print "Connection OK\n";
				}
				$payload = json_encode($body);
				$msg = chr(0).pack("n",32).pack('H*', str_replace(' ', '', $deviceToken)).pack("n",strlen($payload)).$payload;
				//print "sending message :" . $payload . "\n";
				//echo "<br />";
				fwrite($fp, $msg);
				fclose($fp);
				//echo "success"; 
			}
   }
else
   {
	  $status_message="Failure"; 
   }
   
   if(empty($status_message)) { $status_message = "Success";  }
   
   
   @$xml_output  .= "<status>\n"; 
   $xml_output  .= "\t\t<message>".$status_message."</message>\n";
   $xml_output  .= "</status>";
   $xml_output .= "\n\t</document>";
	
	$xml_output = str_replace('&',"&amp;",$xml_output);
	$xml_output = str_replace('"',"&quot;",$xml_output);
	$xml_output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<document>".$xml_output;
		
	header ("Content-Type:text/xml"); 
	header("Cache-Control: private, max-age=0, pre-check=0, post-check=0");
	header("Content-Length: ".strlen($xml_output));
	echo $xml_output ;   
   
//http://localhost/baby_shower/admin/xmlservice/send_notification.php?groupName=testing&deviceId=mydeviceid
//http://www.palmerapplications.com/baby_shower/admin/xmlservice/send_notification.php?groupName=testing&deviceId=mydeviceid
//http://www.sandeepbeniwal.com/apns/send_notification.php?username_to=test@test.com&username_from=test
?>
