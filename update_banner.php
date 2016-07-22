<?
	require 'conn/Session.php';
	require 'conn/MySQL.php';
	require_once("includes/paging.inc.php");
	require_once("includes/generalFunction.php");
	require_once("classes/class.SiteManager.php");
    $siteObj =  new SiteManager();
	$dbcon =  new MySQL();
    require 'conn/checkSession.php';

	mysql_query("SET CHARACTER SET 'utf8'"); 
	mysql_query("SET collation_connection = 'utf8_general_ci'");
	$created_date=date("Y-m-d");
	require 'conn/checkSession.php';


	$banner_id	=$_REQUEST['banner_id'];

	if(isset($_POST['submit'])) 
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
	//********uploading finishing*********//
	$content=array("title"=>$_POST['title'],"content"=>$_POST['content'],"position_type"=>$_POST['position_type'],"banner_position"=>$_POST['banner_position'],"image"=>$image,"date_from"=>$_POST['date_from'],"date_to"=>$_POST['date_to'],"url"=>$_POST['url'],"status"=>$_POST['status']);
			$condition=" where banner_id='$banner_id'";
			$dbcon->update_query("tbl_banners",$content,$condition);
			
					
			$mess="Record updated successfully.";
			$url="manage_banner.php?mess=".base64_encode($mess);
			redirectPage($url);
			
	}


$query	="select * from tbl_banners where banner_id='$banner_id'";
$dbcon->execute_query($query);

$Records=$dbcon->fetch_one_record();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"

"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SHOTZ7</title>
<!--CSS-->
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/ajaxfile.js"></script>
<script type="text/javascript"src="js/zxml.js"></script>
<script language="javascript" src="js/fixedTextArea.js"></script>
<!-- Ck Editor -->
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/jquery-ui.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />
<!-- jQuery -->
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<script type="text/javascript" src="js/general.js"></script>
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
			yearRange: "1990:2013",
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
			yearRange: "1990:2013",
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

<div id="body-wrapper">
  <!-- Wrapper for the radial gradient background -->
  <?  include('left.php'); ?>
  <!--Put content here -->
  <div id="main-content">
    <!-- Main Content Section with everything -->
    <!-- Page Head -->
    <!--<h2>Welcome
      <?=ucfirst( 'Admin'); ?>
    </h2>-->
    <tr>
      <td><br></td>
    </tr>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody>
        <tr>
          <td class="content-box-header"><b style='font-size:15px;'> Update banner</b></td>
        </tr>
      </tbody>
    </table>
    <form action='#' method='post' enctype="multipart/form-data" onSubmit="return check_form(this)" name="frm">
      <input type="hidden" value="<?=$Records['banner_id']?>" name="banner_id" />
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="100%"  border="0" cellspacing="7" cellpadding="3" >
              <? if(isset($mess))

			{

				  echo '<tr> 

					 <td width="81%" height="25" valign="top" colspan="2"><font color="red">'.$mess1.'</font></td>

					</tr>';

			} ?>
              
 			 <tr>
                <th width="19%" align="right" valign="top">Position Type : </th>
                <td width="81%" height="25" valign="top" ><select name="position_type" id="position_type" class="selectbox">
                    <option value="top" <? if($Records['position_type']=='top') { echo "selected";} ?>>Top</option>
                    <option value="middle" <? if($Records['position_type']=='middle') { echo "selected";} ?>>Middle</option>

                    <option value="bottom" <? if($Records['position_type']=='bottom') { echo "selected";} ?>>Middle</option>
                  </select></td>
                
				</tr>
                  
                  <tr>
                <th width="19%" align="right" valign="top">Banner Position : </th>
                <td width="81%" height="25" valign="top" ><select name="banner_position" id="banner_position" class="selectbox">
                    <option value="left" <? if($Records['banner_position']=='left') { echo "selected";} ?>>Left</option>
                    <option value="right" <? if($Records['banner_position']=='right') { echo "selected";} ?>>Right</option>
                  </select></td>
                
				</tr>

 <tr>
                <th width="19%" align="right" valign="top">Title </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="title" id="title" style="width:250px;" required="required" value="<?=$Records['title']?>"/></td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">Content </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="content" id="content" style="width:250px;" required="required" value="<?=$Records['content']?>"/></td>
              </tr>
              <tr>
       <th></th>
        
        <td width="81%" valign="top"><input type="hidden" value="<?=$Records['image']?>" name="image"  /></td>
             </tr>

        <tr>
                <th width="19%" align="right" valign="top">Upload New Image : </th>
                <td width="81%" height="25" valign="top" ><input type="file" style="width:250px;" name="image" id="image" required="required" /></td>
              </tr>


                <tr>
                <th width="19%" align="right" valign="top">From </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="date_form" id="date_from" style="width:250px;" value="<?=$Records['date_from']?>"/></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">To </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="date_to" id="date_to" style="width:250px;" value="<?=$Records['date_to']?>"/></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">URL </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="url" id="url" style="width:250px;" value="<?=$Records['url']?>"/></td>
              </tr>

<tr>
                <th width="19%" align="right" valign="top">Status : </th>
                <td width="81%" height="25" valign="top" ><select name="status" id="status">
                    <option value="Active" <? if($Records['status']=='active') { echo "selected";} ?>>Active</option>
                    <option value="Inactive" <? if($Records['status']=='inactive') { echo "selected";} ?>>Inactive</option>
                  </select></td>
                
				</tr>

				              
                <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name ="submit" type="submit" class="button" value="Submit" onclick="return validateForm();">
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
<!-- End Content here-->
<!-- End #main-content -->
</div>
</body></html>
<script type="text/javascript">
                //<![CDATA[
                    // Replace the <textarea id="editor"> with an CKEditor
                    // instance, using default configurations.
                    CKEDITOR.replace( 'description',
                        {
                            extraPlugins : 'uicolor',
        width:"800",
                            uiColor: '#e0e0e0',
       toolbar :
       [

          ['Source','-','Templates'],
		   ['Undo','Redo','-','SelectAll','RemoveFormat'],
		    ['Cut','Copy','Paste','PasteText','PasteFromWord',],
		   ['Styles','Format','FontSize'],['Maximize','-','About'],

        ['Table','Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'Image', 'HiddenField'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            ['Anchor'],

        [ 'Bold', 'Italic', 'Underline','-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ], ['TextColor','BGColor'],

        [ 'UIColor' ],
       ],

       filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

       filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

       filebrowserUploadUrl      : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

       filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'

          });

                  //]]>

</script>
<?php //$compressor->finish(); ?>