<?
	require 'conn/Session.php';
	require 'conn/MySQL.php';
	require_once("includes/paging.inc.php");
	require_once("includes/generalFunction.php");
	require 'includes/imageTransform.php';
	require_once("classes/class.SiteManager.php");
    $siteObj =  new SiteManager();
	$dbcon =  new MySQL();
    require 'conn/checkSession.php';
    if(isset($_POST['submit'])) 
    {
   
   						 $time=time();
						 $folderPath       = "upload/";
						 $name=str_replace(" ","",$_FILES["poster"]["name"]);
						 if(move_uploaded_file($_FILES["poster"]["tmp_name"],"$folderPath$time.$name"))
							 	{
									$logo= "$time.$name";
						            $d=$logo;	
							 	}
								else
								{
								$d= "";
								}
								
			
   
   
            $created_date = date('Y-m-d H:i:s');
	     
			$content=array("poster"=>$d,"status"=>$_POST['status']);
			$dbcon->insert_query("tbl_manage_movies",$content);
			$mess="Record created successfully.";
		
			$url="add_course_catalog.php?mess=".base64_encode($mess);
			redirectPage($url);
	 		
     }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GOLD SRD</title>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/ajaxfile.js"></script>
<script type="text/javascript"src="js/zxml.js"></script>
<script language="javascript" src="js/fixedTextArea.js"></script>
<!-- Ck Editor -->
<script src="js/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
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
<script type="text/javascript">
    function check_form(thisform)
		{
			with (thisform)
			  {
				 if ((isBlank(video_title,"Please enter video title.") && InitialSpace('video_title') )==false)
				  {video_title.focus();return false;}
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
          <td class="content-box-header"><b style='font-size:15px;'>Add Course Catalog</b></td>
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
                <th width="19%" align="right" valign="top">poster: </th>
                <td width="81%" height="25" valign="top" ><input type="file" style="width:250px;" name="poster" id="poster" /></td>
              </tr>
              
              <tr>
                <th width="19%" align="right" valign="top">Status : </th>
                <td width="81%" height="25" valign="top" >
                <select name="status" id="status">
					<option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                </td>
              </tr>
			  <tr>
			    <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name="submit" type="submit" class="button" value="Submit" onclick=""  >
                  &nbsp;&nbsp;
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='add_course_catalog.php'"></td>
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
