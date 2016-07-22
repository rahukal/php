<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<?php
require("GTranslate.php");
/**
* Example using RequestHTTP
*/
//$translate_string = "Das ist wunderschön";
$translate_string = "This is beautiful";
 try{
       $gt = new Gtranslate;
	   $hindi = $gt->english_to_hindi($translate_string);
	  echo "Translating [$translate_string] German to English=> ".$gt->english_to_hindi($translate_string)."";
	 // echo $gt->hindi_to_punjabi($hindi);
} catch (GTranslateException $ge)
 {
       echo $ge->getMessage();
 }

?>
</body>
</html>

