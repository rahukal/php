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
	$name=$_POST['name'];
	$checkIfExist = "select * from tbl_film_makers where name='".$name."'";
	$chackQry     = mysql_query($checkIfExist);
	$dataRows     = mysql_num_rows($chackQry);
	
	if($dataRows>0)
	{
		$mess1 ="Already Exist.";
	}
	else
	{ 
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
	//***********file Upload End**************** 
	$content=array("name"=>$_POST['name'],"content"=>$_POST['content'],"team_type"=>$_POST['team_type'],"status"=>$_POST['status'],"image"=>$image);
	$dbcon->insert_query("tbl_film_makers",$content);

	
	$mess="Record created successfully.";
	$url="film_makers_team.php?mess=".base64_encode($mess);
	redirectPage($url);
	}		
		
		
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<name>SHOTZ7</name>
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
          <td class="content-box-header"><b style='font-size:15px;'>Add Film Makers Team </b></td>
        </tr>
      </tbody>
    </table>
    <form action='#' method='post' name="frm" enctype="multipart/form-data"  onSubmit="return checkall(this)">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="100%"  border="0" cellspacing="7" cellpadding="3" >
              <? if($mess) {
                    
              echo '<tr> 
                      <td width="81%" height="25" valign="top" colspan="2"><font color="red">'.$mess.'</font></td> 
                    </tr> ';
                    } ?>
               <tr>
                <th width="19%" align="right" valign="top">Team Type: </th>
                <td width="81%" height="25" valign="top" ><select name="team_type" id="team_type">
                    
                   <option value="our_teams">Our Team</option>
                                   <option value="film_makers_teams">Film Makers Team</option>
                  
                    </select></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top"> Name : </th>
         <td width="81%" height="25" valign="top" ><input type="search" class="txtbox"  name="name" id="name" required="required"/></td>
              </tr>

              <tr>
        
                <th width="19%" align="right" valign="top">Content : </th>
                <td width="81%" height="25" valign="top" ><textarea id="content" name="content" class="txtbox" required="required"></textarea></td>
              </tr>

               <tr>
                <th width="19%" align="right" valign="top"> Image: </th>
                <td width="81%" height="25" valign="top" ><input type="file" class="txtbox"  name="image" id="image" required="required"/></td>
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
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='film_makers_team.php'"></td>
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
