<?php
ini_set('display_errors','ON');
ini_set('display_errors',1);

$username_from = "vikas";
//$deviceToken = "5fa4157eb22d62e7b2bcbf92dffb759622ef5a29d187ae5aed806c380203fbc8";

$deviceToken   = "a207dcb48c849cc02c778329a8f2e682f60002bae54d5def0ef7b89f0bdfb6e1";

//$deviceToken   = "a207dcb48c849cc02c778329a8f2e682f60002bae54d5def0ef7b89f0bdfb6e1";	


$userExist=1;
$message = 'You are added by  '.$username_from.' in his job';
$badge = (int)1;
$sound = 'cow.caf';

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
}

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns-dev.pem');
stream_context_set_option($ctx, 'ssl', 'verify_peer',false);
$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

if (!$fp) 
{
  print "Failed to connect $err $errstr\n";
  return;
}
else 
{
   print "Connection OK\n";
}
$payload = json_encode($body);
$msg = chr(0).pack("n",32).pack('H*', str_replace(' ', '', $deviceToken)).pack("n",strlen($payload)).$payload;
//print "sending message :" . $payload . "\n";
fwrite($fp, $msg);
fclose($fp);
echo "success";
//http://sandeepbeniwal.com/push_notification/send_notifcation.php?username_to=test@test.com&username_from=test
//http://ec2-184-73-70-133.compute-1.amazonaws.com/push_notification/send_notifcation.php?username_to=test@test.com&username_from=test

?>
