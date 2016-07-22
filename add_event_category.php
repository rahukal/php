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
	$news_category=$_POST['news_category'];
	$checkIfExist = "select * from tbl_event_category where news_category='".$news_category."'";
	$chackQry     = mysql_query($checkIfExist);
	$dataRows     = mysql_num_rows($chackQry);
	
	if($dataRows>0)
	{
		$mess1 ="Already Exist.";
	}
	else
	{ 

	//***********file Upload End**************** 
	$content=array("news_category"=>$_POST['news_category'],"category_id"=>$_POST['category_id'],"status"=>$_POST['status']);
	$dbcon->insert_query("tbl_event_category",$content);

	
	$mess="Record created successfully.";
	$url="event_category.php?mess=".base64_encode($mess);
	redirectPage($url);
	}		
		
		
}
?>
<?php
$sqlDropDown="select * from tbl_category where 1";
$ExecuteQuery=mysql_query($sqlDropDown) or die(mysql_error());
$countDropDown=mysql_num_rows($ExecuteQuery);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SHOTZ7</title>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/ajaxfile.js"></script>
<script type="text/javascript"src="js/zxml.js"></script>
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
         if ((isBlank(news_category,"Please enter news category.") && InitialSpace('news_category') )==false)
          {news_category.focus();return false;}
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
    <!-- Main Content Section with everything -->
    <!-- Page Head -->
    <h2>Welcome
      <?=ucfirst($_SESSION["admin_user_name"]); ?>
    </h2>
    <tr>
      <td><br></td>
    </tr>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody>
        <tr>
          <td class="content-box-header"><b style='font-size:15px;'>Add event category</b></td>
        </tr>
      </tbody>
    </table>
    <form action='#' method='post' name="frm"   onSubmit="return checkall(this)">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="100%"  border="0" cellspacing="7" cellpadding="3" >
              <? if($mess) {
                    
              echo '<tr> 
                      <td width="81%" height="25" valign="top" colspan="2"><font color="red">'.$mess.'</font></td> 
                    </tr> ';
                    } ?>
             <tr>
                <th width="19%" align="right" valign="top">News Category : </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox"  name="news_category" id="news_category" required="required"/></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">Select Category : </th>
                <td width="81%" height="25" valign="top"><select name="category_id" class="selectbox" id="category_id"><option selected="selected" value="0">Select category</option>
                    <?php 
						 if($countDropDown>0)
						  {  $i=0;
              				 while($records=mysql_fetch_array($ExecuteQuery)) 
							 {
						      ?>
                    <option <?php echo $_POST['category_id'] == $records['category_id'] ? 'selected="selected"': '' ; ?> value="<?php echo $records['category_id']; ?>"><?php echo $records['category_type']; ?></option>
                    <?php } } ?>
                  </select></td>
              </tr>
              

              
<tr>
                <th width="19%" align="right" valign="top">Status : </th>
                <td width="81%" height="25" valign="top" ><select name="status" id="status">
                    
								   <option value="active">Active</option>
                                   <option value="inactive">Inactive</option>
								  
                    </select></td>
              </tr>
              <tr>
                <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name="submit" type="submit" class="button" value="Submit">
                  &nbsp;&nbsp;
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='event_category.php'"></td>
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
<script>
function checkall(obj) 
{
	/*name*/
    if(isBlank("listName")==false)
	{
	  alert("Please enter Name.\n");
	  return false; 
	}
	else
	{
		msg = "";  
	    ret = true;
		if(InitialSpace("listName")==false) {  msg +="Please remove Initial Space from Name.\n";   		  ret = false; 	   }
		if(isSpclChar("listName")==false)   {  msg +="Please remove Special Characters from Name.\n";  	  ret = false; 	   }
		if(ret == false) { alert(msg); setFocus("listName"); return false;} else {  return true;}
    }
}
</script>
</body>
</html>
