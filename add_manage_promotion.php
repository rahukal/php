<?
	require 'conn/Session.php';
	require 'conn/MySQL.php';
	require_once("includes/paging.inc.php");
	require_once("includes/generalFunction.php");
	require_once("classes/class.SiteManager.php");
    $siteObj =  new SiteManager();
	$dbcon =  new MySQL();
    require 'conn/checkSession.php';
	if(isset($_POST['submit'])) 
	{
  $promotion_code=$_POST['promotion_code'];
  $checkIfExist = "select * from tbl_manage_promotion where promotion_code='".$promotion_code."'";
  $chackQry     = mysql_query($checkIfExist);
  $dataRows     = mysql_num_rows($chackQry);
  
  if($dataRows>0)
  {
    $mess1 ="Already Exist.";
  }
  else
  { 
    $created=date("Y-m-d : H:i:s");
	$content=array("promotion_code"=>$_POST['promotion_code'],"total_allowed"=>$_POST['total_allowed'],"uses_per_coupon"=>$_POST['uses_per_coupon'],"uses_per_user"=>$_POST['uses_per_user'],"type"=>$_POST['type'],"description"=>$_POST['description'],"created_date"=>$created,"period"=>$_POST['period'],"date_from"=>$_POST['date_from'],"date_to"=>$_POST['date_to'],"status"=>$_POST['status'],"number_days"=>$_POST['number_days']);
			$dbcon->insert_query("tbl_manage_promotion",$content);
			$mess="Record created successfully.";
			$url="manage_promotion.php?mess=".base64_encode($mess);
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
			$( "#created_date" ).datepicker({
			yearRange: "1980:2015",
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
      $( "#date_from" ).datepicker({
      yearRange: "1980:2015",
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
      yearRange: "1980:2015",
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
      $( "#period" ).datepicker({
      yearRange: "1980:2015",
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
         if ((isBlank(promotion_code,"Please enter promotion_code.") && InitialSpace('promotion_code') )==false)
          {promotion_code.focus();return false;}
        } 
    }
</script>

</head>
<body>
<div id="body-wrapper">
  <? include('left.php'); ?>
  <div id="main-content">
    <tr>
      <td><? //include("includes/selectLanguage.php")?>
        <br></td>
    </tr>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody>
        <tr>
          <td class="content-box-header"><b style='font-size:15px;'>Add Promotion</b></td>
        </tr>
      </tbody>
   </table>
    <form action='#' method='post' onSubmit="" name="frm" enctype="multipart/form-data">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="100%"  border="0" cellspacing="7" cellpadding="3" >
              <? if(isset($mess1)) {
              echo '<tr> 
                      <td width="81%" height="25" valign="top" colspan="2"><font color="red">'.$mess1.'</font></td> 
                    </tr> ';
                    } ?>
			  <tr>
                <th width="19%" align="right" valign="top">promotion code: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="promotion_code" id="promotion_code" class="txtbox" required="required"/></td>
              </tr>
			  
        
              <tr>
                <th width="19%" align="right" valign="top">total allowed: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="total_allowed" id="total_allowed" class="txtbox" required="required"/></td>
              </tr>
                  
                  
                <tr>
                <th width="19%" align="right" valign="top">Type: </th>
                <td width="81%" height="25" valign="top" >
                <select name="type" id="type" class="selectbox"><option selected="selected" value="0">Select Type </option>
          <option value="no.of_movies">No. of Movies</option>
                    <option value="no.of_days">NO. of Days</option>
                </select>
                </td>
              </tr>
                  <tr>
                              <th width="19%" align="right" valign="top">Description : </th>
                              <td width="81%" height="25" valign="top" ><textarea id="description" name="description" class="txtbox" ></textarea></td>
                            </tr>
                   <tr>
                <th width="19%" align="right" valign="top">No. of Days: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="number_days" id="number_days" class="txtbox" /></td>
              </tr>

                 <tr>
                <th width="19%" align="right" valign="top">uses per coupon: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="uses_per_coupon" id="uses_per_coupon" class="txtbox"  required="required" /></td>
              </tr>
             

               <tr>
                <th width="19%" align="right" valign="top">uses per user: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="uses_per_user" id="uses_per_user" class="txtbox" required="required"/></td>
              </tr>

              <tr>
                <th>Validity Period: </th>
                <td>From<input type="date" name="date_from" id="date_from" required="required"/><br>To<input type="date" name="date_to" id="date_to" required="required" style="margin: 14px;"></td>
              </tr>

               <tr>
                <th width="19%" align="right" valign="top">Status : </th>
                <td width="81%" height="25" valign="top" >
                <select name="status" id="status">
					<option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                </td>
              </tr>
			  
              <tr>
	<td colspan="2" class="last" align="left" style="padding-left:210px;"><input name="submit" type="submit" class="button" value="Submit" onclick=""  >
                  &nbsp;&nbsp;
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='manage_promotion.php'"></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </form>
    <? require('footer.php');?>
  </div>
</div>
</div>
</body>
</html>