<?
//error_reporting(0);
require 'conn/Session.php';
require 'conn/MySQL.php';
require_once("includes/paging.inc.php");
require_once("includes/generalFunction.php");
require_once("classes/class.SiteManager.php");
require_once("classes/class.ImageManager.php");


$siteObj =  new SiteManager();
$dbcon =  new MySQL();
require 'conn/checkSession.php';
if(IsInjected($email))
{
echo "Bad email value!";
exit;
} 
if(isset($_POST['submit'])) 
{
$user_name=$_POST['user_name'];
$checkIfExist = "select * from tbl_users where user_name='".$user_name."'";
$chackQry     = mysql_query($checkIfExist);
$dataRows     = mysql_num_rows($chackQry);

if($dataRows>0)
{
$mess1 ="Already Exist.";
}
else
{ 

//***********file Upload End**************** //
$created=date("Y-m-d : H:i:s");
$content=array("user_name"=>$_POST['user_name'],"first_name"=>$_POST['first_name'],"last_name"=>$_POST['last_name'],"email"=>$_POST['email'],"mobile"=>$_POST['mobile'],"telephone"=>$_POST['telephone'],"describe_yourself"=>$_POST['describe_yourself'],"gender"=>$_POST['gender'],"date_of_birth"=>$_POST['date_of_birth'],"country_id"=>$_POST['country_id'],"address"=>$_POST['address'],"address_1"=>$_POST['address_1'],"address_2"=>$_POST['address_2'],"state"=>$_POST['state'],"city"=>$_POST['city'],"zip_code"=>$_POST['zip_code'],"user_type_id"=>$_POST['user_type_id'],"date_of_birth"=>$_POST['date_of_birth'],"status"=>$_POST['status'],"date" =>$_POST['date']);
$dbcon->insert_query("tbl_users",$content);

$last_id = mysql_insert_id();
$user=$_POST['user_type'];
$txt="NO user type ";

for ($i=0;$i<count($user);$i++)
{
if($user[$i]=="")
{
$content=array("user_type_id"=>$last_id,"user_type"=>$txt);
$dbcon->insert_query("tbl_user_type",$content);
}
else
{
$content=array("user_type_id"=>$last_id,"user_type"=>$course[$i]);
$dbcon->insert_query("tbl_user_type",$content);
}
}
$mess="Record created successfully.";
$url="manage_user.php?mess=".base64_encode($mess);
redirectPage($url);
}		


}
function IsInjected($str)
{
$injections = array('(\n+)',
'(\r+)',
'(\t+)',
'(%0A+)',
'(%0D+)',
'(%08+)',
'(%09+)'
);
$inject = join('|', $injections);
$inject = "/$inject/i";
if(preg_match($inject,$str))
{
return true;
}
else
{
return false;
}
}
?>
<?php
$sqlDropDown="select * from tbl_country where 1";
$ExecuteQuery=mysql_query($sqlDropDown) or die(mysql_error());
$countDropDown=mysql_num_rows($ExecuteQuery);
?>
<?php
$sqlDrop="select * from tbl_user_type where 1";
$Executequery=mysql_query($sqlDrop) or die(mysql_error());
$countDrop=mysql_num_rows($Executequery);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SHOTZ7</title>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/ajaxfile.js"></script>
<script type="text/javascript"src="js/zxml.js"></script>


<style>
.ui-timepicker-div .ui-widget-header {
margin-bottom: 8px;
}
.ui-timepicker-div dl {
text-align: left;
}
.ui-timepicker-div dl dt {
height: 25px;
}
.ui-timepicker-div dl dd {
margin: -25px 0 10px 65px;
}
.ui-timepicker-div td {
font-size: 90%;
}
</style>



<script language="javascript" src="js/fixedTextArea.js"></script>

<!-- Reset Stylesheet -->
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
<!-- datepicker script-->
<link rel="stylesheet" href="resources/css/jquery-ui.css" type="text/css" media="screen" />
<!--                       Javascripts end                       -->
<!-- jQuery -->
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>


<script type="text/javascript" src="js/action.js"></script>



<script>
$(function() 
{
$( "#date" ).datepicker({
yearRange: "1980:2020",
changeMonth: true,
changeYear: true,

showSecond: true,
dateFormat: 'yy-mm-dd',
timeFormat: 'hh:mm:ss'
});
});

</script>
<script>
$(function() 
{
$( "#date_of_birth" ).datepicker({
yearRange: "1991:2020",
changeMonth: true,
changeYear: true,

showSecond: true,
dateFormat: 'yy-mm-dd',
timeFormat: 'hh:mm:ss'
});
});

</script>
<script type="text/javascript">


function InitialSpace(textfieldValue)
{

var val=email.Value;
var InitialSpaceValue = /(^\s)/;

if(!document.getElementById(val).value.match(InitialSpaceValue))
{

return true;
}
else
{
alert("Please remove initial space.");
document.getElementById(email).focus();
return false;
}
}

function isBlank(elem, helperMsg)
{
var val=user_name.value;
if(val=="")
{
alert(helperMsg);

return false;
}
else
{
return true;
}
}

function check_form(thisform)
{
with (thisform)
{
if ((isBlank(user_name,"Please enter user name .") && InitialSpace('user_name') )===false)
{user_name.focus();return false;}
if ((isBlank(last_name,"Please enter last name.") && InitialSpace('last_name') )===false)  
{_last_name.focus();return false;}									  				 
else if ((isBlank(first_name,"Please enter  first name.") && InitialSpace('first_name') )===false)
{
first_name.focus();return false;
}									  				 
		 
} 
}


</script>

<script>
function check_form(obj) 
{
if(obj.mobile.value!=="")
{
msg = "";  
ret = true;
if(InitialSpace("mobile")===false)  
{
msg +="Please remove Initial Space from user mobile.\n";  
ret = false;
}
if(isSpclChar("mobile")===false) 
{
msg +="Please remove Special Characters from user mobile.\n";  
ret = false; 
}
if(ret === false) { alert(msg); setFocus("mobile"); return false;}else { return true;}
}
else {alert("Please enter user mobile."); document.getElementById('mobile').focus(); return false;  }
}
</script>

</head>
<body>
<div id="body-wrapper">
<!-- Wrapper for the radial gradient background -->
<? include('left.php'); ?>
<!--Put content here -->
<div id="main-content">
<tr>
<td><? //include("includes/selectLanguage.php")?>
<br></td>
</tr>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td class="content-box-header"><b style='font-size:15px;'>Add User</b></td>
</tr>
</tbody>
</table>

<form action='#' method='post' onSubmit="return check_form(this)" name="frm" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<td><table width="100%"  border="0" cellspacing="7" cellpadding="3" >
<? if(isset($mess1)) {

echo '<tr> 
<td width="81%" height="25" valign="top" colspan="2"><font color="red">'.$mess1.'</font></td> 
</tr> ';
} ?>

<tr>
<th width="19%" align="right" valign="top">user name </th>
<td width="81%" height="25" valign="top" ><input type="search" name="user_name" id="user_name" style="width:250px;" required="required"/></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">first name </th>
<td width="81%" height="25" valign="top" ><input type="search" name="first_name" id="first_name" style="width:250px;" required="required" /></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">last name </th>
<td width="81%" height="25" valign="top" ><input type="search" name="last_name" id="last_name" style="width:250px;" required="required" /></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">Email </th>
<td width="81%" height="25" valign="top" ><input type="search" name="email" id="email" style="width:250px;" required="required" /></td>
</tr>

<tr>
<th width="19%" align="right" valign="top">password </th>
<td width="81%" height="25" valign="top" ><input type="search" name="password" id="password" style="width:250px;" required="required" /></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">Mobile </th>
<td width="81%" height="25" valign="top" ><input type="search" name="mobile" id="mobile" style="width:250px;" required="required" /></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">Telephone </th>
<td width="81%" height="25" valign="top" ><input type="search" name="telephone" id="telephone" style="width:250px;" /></td>
</tr>

<tr>

<th width="19%" align="right" valign="top">Describe Yourself : </th>
<td width="81%" height="25" valign="top" ><textarea id="describe_yourself" name="describe_yourself" class="txtbox"></textarea></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">Gender: </th>
<td width="81%" height="25" valign="top" ><select name="gender" id="gender">

		   <option value="male">Male</option>
		   <option value="female">Female</option>
		  
</select></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">Date of birth </th>
<td width="81%" height="25" valign="top" ><input type="search" name="date_of_birth" id="date_of_birth" style="width:250px;" /></td>
</tr>


<tr>
<th width="19%" align="right" valign="top">Choose country : </th>
<td width="81%" height="25" valign="top"><select name="country_id" class="selectbox" id="country_id"><option selected="selected" value="0">Select country name</option>
<?php 
 if($countDropDown>0)
  {  $i=0;
	 while($records=mysql_fetch_array($ExecuteQuery)) 
	 {
	  ?>
<option <?php echo $_POST['country_id'] == $records['country_id'] ? 'selected="selected"': '' ; ?> value="<?php echo $records['country_id']; ?>"><?php echo $records['country_name']; ?></option>
<?php } } ?>
</select></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">Address</th>
<td width="81%" height="25" valign="top" ><input type="search" name="address" id="address" style="width:250px;" /></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">Address 1</th>
<td width="81%" height="25" valign="top" ><input type="search" name="address_1" id="address_1" style="width:250px;" /></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">Address 2 </th>
<td width="81%" height="25" valign="top" ><input type="search" name="address_2" id="address_2" style="width:250px;" /></td>
</tr>

<tr>
<th width="19%" align="right" valign="top">State</th>
<td width="81%" height="25" valign="top" ><input type="search" name="state" id="state" style="width:250px;" /></td>
</tr>

<tr>
<th width="19%" align="right" valign="top">City </th>
<td width="81%" height="25" valign="top" ><input type="search" name="city" id="city" style="width:250px;" /></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">Zip/postal code</th>
<td width="81%" height="25" valign="top" ><input type="search" name="zip_code" id="zip_code" style="width:250px;" required="required" /></td>
</tr>
<tr>
<th width="19%" align="right" valign="top">Created Date  </th>
<td width="81%" height="25" valign="top" ><input type="search" name="date" id="date" style="width:250px;" /></td>
</tr>

<tr>
<th width="19%" align="right" valign="top">Select User Type : </th>
<td width="81%" height="25" valign="top"><select name="user_type_id" class="selectbox" id="user_type_id" required="required"><option selected="selected" value="0">Select user type</option>
<?php 
 if($countDrop>0)
  {  $i=0;
	 while($records=mysql_fetch_array($Executequery)) 
	 {
	  ?>
<option <?php echo $_POST['user_type_id'] == $records['user_type_id'] ? 'selected="selected"': '' ; ?> value="<?php echo $records['user_type_id']; ?>"><?php echo $records['user_type']; ?></option>
<?php } } ?>
</select></td>
</tr>



<tr>
<th width="19%" align="right" valign="top">Status : </th>
<td width="81%" height="25" valign="top" ><select name="status" id="status">

		   <option value="Active">Active</option>
		   <option value="Inactive">Inactive</option>
		  
</select></td>
</tr>

<tr>

<td colspan="2" class="last" align="left" style="padding-left:210px;"><input name="submit" type="submit" class="button" value="Submit" onclick="return validateForm();"  >
&nbsp;&nbsp;
<input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='manage_user.php'"></td>
</tr>
</table></td>
</tr>
</table>
</form>
<!-- End #tab1 -->
<? 
require('footer.php')
?>
</div>
<!-- End #main-content -->
</div>
</div>
<script type="text/javascript" language="javascript">
function check_form(obj) 
{
if(obj.user_name.value!=="")
{
msg = "";  
ret = true;
if(InitialSpace("user_name")==false)  
{
msg +="Please remove Initial Space from user Name.\n";  
ret = false;
}
if(ret == false) { alert(msg); setFocus("user_name"); return false;}else { }
}
else {alert("Please enter user Name."); document.getElementById('user_name').focus(); return false;  }
/*description*/
if(obj.first_name.value!=="")
{
msg = "";  
ret = true;
if(InitialSpace("first_name")==false)  
{
msg +="Please remove Initial Space from  first name.\n";  
ret = false;
}
if(ret == false) { alert(msg); setFocus("first_name"); return false;}else { }
}
else {alert("Please enter  first name."); document.getElementById('first_name').focus(); return false;  }
/*email validation*/
/*description*/
if(obj.email.value!=="")
{
msg = "";  
ret = true;
if(InitialSpace("email")==false)  
{
msg +="Please remove Initial Space from  email.\n";  
ret = false;
}
if(ret == false) { alert(msg); setFocus("email"); return false;}else { }
}
else {alert("Please enter email."); document.getElementById('email').focus(); return false;  }
/*email validation*/
if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
echo "<center>Invalid email</center>";
}else{
echo "<center>Valid Email</center>";
} 
//*****movile validation*****//
if(obj.mobile.value!=="")
{ msg = "";  
ret = true;
if(InitialSpace("mobile")==false)  
{
msg +="Please remove Initial Space from mobile.\n";  
ret = false;
}
if(isNaN(obj.mobile.value))
{
msg +="mobile number must be numberic.\n";  
ret = false;  
}
if(ret == false) { alert(msg); setFocus("mobile"); return false;}else { }
}
else {alert("Please enter mobile."); document.getElementById('mobile').focus(); return false;  }
/*price validation*/
if(obj.telephone.value!=="")
{ msg = "";  
ret = true;
if(InitialSpace("telephone")==false)  
{
msg +="Please remove Initial Space from telephone.\n";  
ret = false;
}
if(isNaN(obj.telephone.value))
{
msg +="telephone must be numberic.\n";  
ret = false;  
}
if(ret == false) { alert(msg); setFocus("telephone"); return false;}else { }
}
else {alert("Please enter telephone."); document.getElementById('telephone').focus(); return false;  }
/*zip code*/
if(obj.zip_code.value!=="")
{ msg = "";  
ret = true;
if(InitialSpace("zip_code")==false)  
{
msg +="Please remove Initial Space from zip code.\n";  
ret = false;
}
if(isNaN(obj.zip_code.value))
{
msg +="zip code must be numberic.\n";  
ret = false;  
}
if(ret == false) { alert(msg); setFocus("zip_code"); return false;}else { }
}
else {alert("Please enter zip code."); document.getElementById('zip_code').focus(); return false;  }
/*coupon validation*/
if(obj.coupon.value!=="")
{ msg = "";  
ret = true;
if(InitialSpace("coupon")==false)  
{
msg +="Please remove Initial Space from Coupon.\n";  
ret = false;
}
if(ret == false) { alert(msg); setFocus("coupon"); return false;}else { }
}
/*barcode validation*/
if(obj.barcode.value!=="")
{ msg = "";  
ret = true;
if(InitialSpace("barcode")==false)  
{
msg +="Please remove Initial Space from Barcode.\n";  
ret = false;
}
if(ret == false) { alert(msg); setFocus("barcode"); return false;}else { }
}
/*category validation*/
if(obj.category.value!=="")
{ msg = "";  
ret = true;
if(InitialSpace("category")==false)  
{
msg +="Please remove Initial Space from Category.\n";  
ret = false;
}
if(ret == false) { alert(msg); setFocus("category"); return false;}else { }
}
/*brand validation*/
if(obj.brand.value!=="")
{ msg = "";  
ret = true;
if(InitialSpace("brand")==false)  
{
msg +="Please remove Initial Space from Brand.\n";  
ret = false;
}
if(ret == false) { alert(msg); setFocus("brand"); return false;}else { }
}
/*brand validation*/
if(obj.store.value!=="")
{ msg = "";  
ret = true;
if(InitialSpace("store")==false)  
{
msg +="Please remove Initial Space from Store.\n";  
ret = false;
}
if(ret == false) { alert(msg); setFocus("store"); return false;}else { }
}

}

</script>
<!-- email validation-->
<script language="JavaScript1.2">

//Advanced Email Check credit-
//By JavaScript Kit (http://www.javascriptkit.com)
//Over 200+ free scripts here!

var testresults
function checkemail(){
var str=document.frm.email.value
var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
if (filter.test(str))
testresults=true
else{
alert("Please input a valid email address!")
testresults=false
}
return (testresults)
}
</script>

<script>
function check_form(){
if (document.layers||document.getElementById||document.all)
return checkemail()
else
return true
}
</script> 

</body>
</html>