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
	$title=$_POST['title'];
	$checkIfExist = "select * from tbl_banners where title='".$title."'";
	$chackQry     = mysql_query($checkIfExist);
	$dataRows     = mysql_num_rows($chackQry);
	
	if($dataRows>0)
	{
		$mess1 ="Already Exist.";
	}
	else
	{ 
//**********file upload trailer*********
                $time=time();
             $folderPath       = "upload/";
             $name=str_replace(" ","",$_FILES["image"]["name"]);
             if(move_uploaded_file($_FILES["image"]["tmp_name"],"$folderPath$time.$name"))
                {
                  $logo= "$time.$name";
                        $image=$logo; 
                }
                else
                {
                $image= "";
                }
	//***********file Upload End**************** //
	$content=array("title"=>$_POST['title'],"content"=>$_POST['content'],"position_type"=>$_POST['position_type'],"banner_position"=>$_POST['banner_position'],"image"=>$image,"date_from"=>$_POST['date_from'],"date_to"=>$_POST['date_to'],"url"=>$_POST['url'],"status"=>$_POST['status']);
	$dbcon->insert_query("tbl_banners",$content);

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
				$dbcon->insert_query("tbl_course_periods",$content);
				}
			}
	$mess="Record created successfully.";
	$url="manage_banner.php?mess=".base64_encode($mess);
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
<link rel="stylesheet" href="resources/css/jquery-ui.css" type="text/css" media="screen" />
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
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
 <script type="text/javascript" src="js/action.js"></script>
		<script>
	  			$(function() 
			{
			$( "#date_from" ).datepicker({
			yearRange: "1950:2020",
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
			$( "#date_to" ).datepicker({
			yearRange: "1950:2020",
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
				 if ((isBlank(title,"Please enter Title.") && InitialSpace('title') )==false)
				  {title.focus();return false;}
				  else if ((isBlank(content,"Please enter content") && InitialSpace('content') )==false)
				  {content.focus();return false;}									  				 
				  else if ((isBlank(url,"Please enter  url.") && InitialSpace('url') )==false)
				  {url.focus();return false;}									  				 
								 
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
          <td class="content-box-header"><b style='font-size:15px;'>Add banner</b></td>
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
                <th width="19%" align="right" valign="top">Positon Type : </th>
                <td width="81%" height="25" valign="top" ><select name="position_type" id="position_type" class="selectbox"><option selected="selected" value="0">Select position Type</option>
                    
								   <option value="top">Top</option>
                                   <option value="middle">Middle</option>
								  <option value="bottom">Bottom</option>
								  
                    </select></td>
              </tr>
               <tr>
                <th width="19%" align="right" valign="top">Banner Positon  : </th>
                <td width="81%" height="25" valign="top" ><select name="banner_position" id="banner_position" required="required" class="selectbox"><option selected="selected" value="0">Select Banner position</option>
                    
								   <option value="left">Left</option>
                                   <option value="right">Right</option>
								  
                    </select></td>
              </tr>


				<tr>
                <th width="19%" align="right" valign="top">Title </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="title" id="title" style="width:250px;" required="required" /></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">Content </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="content" id="content" style="width:250px;" required="required"/></td>
              </tr>

			  <tr>
                <th width="19%" align="right" valign="top">Image </th>
                <td width="81%" height="25" valign="top" ><input type="file" name="image" id="image" style="width:250px;" required="required"/></td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">From </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="date_from" id="date_from" style="width:250px;" /></td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">To </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="date_to" id="date_to" style="width:250px;" /></td>
              </tr>

			  
              <tr>
                <th width="19%" align="right" valign="top">URL</th>
                <td width="81%" height="25" valign="top" ><input type="search" name="url" id="url" style="width:250px;" /></td>
              </tr>




			  <tr>
                <th width="19%" align="right" valign="top">Status : </th>
                <td width="81%" height="25" valign="top" ><select name="status" id="status">
                    
								   <option value="active">Active</option>
                                   <option value="inactive">Inative</option>
								  
                    </select></td>
              </tr>

			  <tr>
               
			    <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name="submit" type="submit" class="button" value="Submit" onclick="return validateForm();"  >
                  &nbsp;&nbsp;
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='manage_banner.php'"></td>
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