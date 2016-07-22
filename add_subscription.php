<?
//error_reporting(0);
	require 'conn/Session.php';
	require 'conn/MySQL.php';
	require_once("includes/paging.inc.php");
	require_once("includes/generalFunction.php");
	require_once("classes/class.SiteManager.php");
	
    $siteObj =  new SiteManager();
	$dbcon =  new MySQL();
    require 'conn/checkSession.php';
	$created_date = date('Y-m-d H:i:s');
if(isset($_POST['submit'])) 
{
	$Package_name=$_POST['package_name'];
	$checkIfExist = "select * from tbl_manage_subscription where package_name='".$package_name."'";
	$chackQry     = mysql_query($checkIfExist);
	$dataRows     = mysql_num_rows($chackQry);
	
	if($dataRows>0)
	{
		$mess1 ="Already Exist.";
	}
	else
	{ 

	//***********file Upload End**************** 
	$content=array("package_name"=>$_POST['package_name'],"subscription_title"=>$_POST['subscription_title'],"currency_code"=>$_POST['currency_code'],"subscription_id"=>$_POST['subscription_id'],"subscription_price"=>$_POST['subscription_price'],"subscription_description"=>$_POST['subscription_description'],"subscription_feature"=>$_POST['subscription_feature'],"status"=>$_POST['status']);
	$dbcon->insert_query("tbl_manage_subscription",$content);

	$last_id = mysql_insert_id();
			$user=$_POST['subscription_type'];
			$txt="NO user type ";
		
			for ($i=0;$i<count($user);$i++)
  			{
				if($user[$i]=="")
				{
				$content=array("subscription_id"=>$last_id,"subscription_type"=>$txt);
				$dbcon->insert_query("tbl_subscription",$content);
				}
				else
				{
				$content=array("subscription_id"=>$last_id,"subscription_type"=>$course[$i]);
				$dbcon->insert_query("tbl_subscription",$content);
				}
			}
	$mess="Record created successfully.";
	$url="manage_subscription.php?mess=".base64_encode($mess);
	redirectPage($url);
	}		
		
		
}
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
<!--                       Javascripts                       -->
<!-- jQuery -->
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script>
 <link type="text/css" href="resources/css/smoothness/jquery-ui-1.8.8.custom.css" rel="stylesheet" />
 <script type="text/javascript" src="js/action.js"></script>



        <script>
	  			$(function() 
			{
			$( "#created_date" ).datepicker({
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
			yearRange: "1980:2020",
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
		
			var val=textfieldValue;
			var InitialSpaceValue = /(^\s)/;
			
				if(!document.getElementById(val).value.match(InitialSpaceValue))
					{
						
						return true;
					}
			   else
					{
						alert("Please remove initial space.");
						document.getElementById(val).focus();
						return false;
					}
	      }

       function isBlank(elem, helperMsg)
			{
				var val=elem.value;
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
				 if ((isBlank(subscription_title,"Please enter subscription title.") && InitialSpace('subscription_title') )==false)
				  {subscription_title.focus();return false;}
				  else if ((isBlank(email,"Please enter user email.") && InitialSpace('email') )==false)
				  {news_description.focus();return false;}									  				 
				  else if ((isBlank(date_of_birth,"Please enter  date.") && InitialSpace('date_of_birth') )==false)
				  {created_date.focus();return false;}									  				 
								 
			  } 
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
          <td class="content-box-header"><b style='font-size:15px;'>Add Subscription</b></td>
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
                <th width="19%" align="right" valign="top">Package Name: </th>
                <td width="81%" height="25" valign="top" ><select name="package_name" id="package_name" required="required" class="selectbox"><option selected="selected" value="0">Select Package </option>
                    
								   <option value="unlimited" id="unlimited">Unlimited</option>
                                   <option value="movie_pack" id="movie_pack">Movie Pack</option>
								  <option value="one_movie_pack" id="one_movie_pack">One Movie Pack</option>
                    </select></td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">Subscription Title</th>
                <td width="81%" height="25" valign="top" ><input type="search" name="subscription_title" id="subscription_title" required="required" style="width:250px;" /></td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">Currency Code </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="currency_code" id="currency_code" style="width:250px;" required="required" /></td>
              </tr>

			   <tr>
                <th width="19%" align="right" valign="top">Subscription Type: </th>
                <td width="81%" height="25" valign="top" ><select name="subscription_id" id="subscription_id" class="selectbox"><option selected="selected" value="0">Select subscription type</option>
				<? $siteObj->get_subscription();?></select></td>              
              </tr>
                 <tr>
                <th width="19%" align="right" valign="top">Subscription Price</th>
                <td width="81%" height="25" valign="top" ><input type="search" name="subscription_price" id="subscription_price" required="required" style="width:250px;" /></td>
              </tr>
			  
              <tr>
        
                <th width="19%" align="right" valign="top">Subscription Description : </th>
                <td width="81%" height="25" valign="top" ><textarea id="subscription_description" name="subscription_description" class="txtbox"></textarea></td>
              </tr>

              <tr>
        
                <th width="19%" align="right" valign="top">Subscription Feature : </th>
                <td width="81%" height="25" valign="top" ><textarea id="subscription_feature" name="subscription_feature" class="txtbox"></textarea></td>
              </tr>
             
			  <tr>
                <th width="19%" align="right" valign="top">Status : </th>
                <td width="81%" height="25" valign="top" ><select name="status" id="status">
              <option selected="selected" value="0">Select Status</option>
								   <option value="enable">Enable</option>
                                   <option value="disable">Disable</option>
								  
                    </select></td>
              </tr>

			  <tr>
               
			    <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name="submit" type="submit" class="button" value="Submit" onclick="return validateForm();"  >
                  &nbsp;&nbsp;
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='manage_subscription.php'"></td>
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
</body>
</html>