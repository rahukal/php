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
	$checkIfExist = "select * from tbl_manage_events where title='".$title."'";
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
	$content=array("title"=>$_POST['title'],"content"=>$_POST['content'],"category_id"=>$_POST['category_id'],"status"=>$_POST['status'],"image"=>$image,"publish"=>$_POST['publish'],"author"=>$_POST['author'],"source"=>$_POST['source'],"tags"=>$_POST['tags']);
	$dbcon->insert_query("tbl_manage_events",$content);

	
	$mess="Record created successfully.";
	$url="manage_events.php?mess=".base64_encode($mess);
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
      yearRange: "1980:2016",
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
         if ((isBlank(title,"Please enter title.") && InitialSpace('title') )==false)
          {title.focus();return false;}
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
          <td class="content-box-header"><b style='font-size:15px;'>Add Events </b></td>
        </tr>
      </tbody>
    </table>
    <form action='#' method='post' name="frm"  enctype="multipart/form-data" onSubmit="return checkall(this)">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="100%"  border="0" cellspacing="7" cellpadding="3" >
              <? if($mess) {
                    
              echo '<tr> 
                      <td width="81%" height="25" valign="top" colspan="2"><font color="red">'.$mess.'</font></td> 
                    </tr> ';
                    } ?>
              <tr>
                <th width="19%" align="right" valign="top">select event Category : </th>
                <td width="81%" height="25" valign="top"><select name="category_id" class="selectbox" id="category_id"><option selected="selected" value="0">Select event category</option>
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
                <th width="19%" align="right" valign="top"> Name : </th>
         <td width="81%" height="25" valign="top" ><input type="search" class="txtbox"  name="title" id="title" required="required"/></td>
              </tr>

              <tr>
        
                <th width="19%" align="right" valign="top">Content : </th>
                <td width="81%" height="25" valign="top" ><textarea id="content" name="content" class="txtbox" required="required"></textarea></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">Image </th>
                <td width="81%" height="25" valign="top" ><input type="file" name="image" id="image" style="width:250px;" required="required"/></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">Publish : </th>
                <td width="81%" height="25" valign="top" ><select name="publish" id="publish"><option selected="selected" value="0">Select publish</option>
       <option value="yes">Yes</option>
       <option value="no">No</option>
                  
                    </select></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top"> Author: </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="author"  name="author" id="author" /></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top"> Source : </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox"  name="source" id="source" /></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top"> Tags : </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox"  name="tags" id="tags" /></td>
              </tr>

<tr>
                <th width="19%" align="right" valign="top">Status : </th>
                <td width="81%" height="25" valign="top" ><select name="status" id="status">
                    <option selected="selected" value="0">Select Status</option>
								   <option value="active">Active</option>
                                   <option value="inactive">Inactive</option>
								  
                    </select></td>
              </tr>
              <tr>
                <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name="submit" type="submit" class="button" value="Submit">
                  &nbsp;&nbsp;
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='manage_events.php'"></td>
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
