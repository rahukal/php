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


	$manage_subscription_id	=$_REQUEST['manage_subscription_id'];

	if(isset($_POST['submit'])) 
	{
	
	$content=array("subscription_id"=>$_POST['subscription_id'],
				   "package_name"=>$_POST['package_name'],
				   "subscription_title"=>$_POST['subscription_title'],
				   "currency_code"=>$_POST['currency_code'],
				   "subscription_price"=>$_POST['subscription_price'],
				   "subscription_description"=>$_POST['subscription_description'],
				   "subscription_feature"=>$_POST['subscription_feature'],
				   "telephone"=>$_POST['telephone'],
				   "status"=>$_POST['status']
				  );
			$condition=" where manage_subscription_id='$manage_subscription_id'";
			$dbcon->update_query("tbl_manage_subscription",$content,$condition);
			

			
			
			$mess="Record updated successfully.";
			$url="manage_subscription.php?mess=".base64_encode($mess);
			redirectPage($url);
			
	}


$query	="select * from tbl_manage_subscription where manage_subscription_id='$manage_subscription_id'";
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

  <script type="text/javascript" src="js/action.js"></script>



               <script>
	  			$(function() 
			{
			$( "#date_of_birth" ).datepicker({
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
			$( "#created_date" ).datepicker({
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
          <td class="content-box-header"><b style='font-size:15px;'> Update Subscription</b></td>
        </tr>
      </tbody>
    </table>
    <form action='#' method='post' enctype="multipart/form-data" onSubmit="return check_form(this)" name="frm">
      <input type="hidden" value="<?=$Records['manage_subscription_id']?>" name="manage_subscription_id" />
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
                <th width="19%" align="right" valign="top">Package Name : </th>
 <td width="81%" height="25" valign="top" ><select name="package_name" id="package_name" class="selectbox">
 <option selected="selected" value="0">Select package name</option>
                    <option value="unlimited" <? if($Records['package_name']=='unlimited') { echo "selected";} ?>>unlimited</option>
                    <option value="movie_pack" <? if($Records['package_name']=='movie_pack') { echo "selected";} ?>>Movie Pack</option>
                    <option value="one_movie_pack" <? if($Records['package_name']=='one_movie_pack') { echo "selected";} ?>>Movie Pack</option>
                  </select></td>
                
				</tr>
<tr>
                <th width="19%" align="right" valign="top">Subscription Title: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="subscription_title" id="subscription_title" required="required" value="<?=$Records['subscription_title']?>" class="txtbox" /></td>
              </tr>

<tr>
                <th width="19%" align="right" valign="top">Currency Code: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="currency_code" id="currency_code" required="required" value="<?=$Records['currency_code']?>" class="txtbox" /></td>
              </tr>
<tr>
                <th width="19%" align="right" valign="top">Subscription Type: </th>
                <td width="81%" height="25" valign="top" ><select name="subscription_id" id="subscription_id" value="<?=$Records['subscription_id']?>" class="selectbox"><option selected="selected" value="0">Select subscription type</option>
				<? $siteObj->get_subscription();?></select></td>              
              </tr>
                   
                   <tr>
                <th width="19%" align="right" valign="top">Subscription Price: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="subscription_price" id="subscription_price" required="required" value="<?=$Records['subscription_price']?>" class="txtbox" /></td>
              </tr>
<tr>
                <th width="19%" align="right" valign="top">Subscription Description: </th>
                <td width="81%" height="25" valign="top" ><textarea id="subscription_description" name="subscription_description" class="txtbox" ><?=$Records['subscription_description']?></textarea></td>
              </tr>

<tr>
                <th width="19%" align="right" valign="top">Subscription Feature: </th>
                <td width="81%" height="25" valign="top" ><textarea id="subscription_feature" name="subscription_feature" class="txtbox" ><?=$Records['subscription_feature']?></textarea></td>
              </tr>
			   

				<tr>
                <th width="19%" align="right" valign="top">Status : </th>
     <td width="81%" height="25" valign="top" ><select name="status" id="status"><option selected="selected" value="0">Select Status</option>
                    <option value="enable" <? if($Records['status']=='enable') { echo "selected";} ?>>Enable</option>
                    <option value="disable" <? if($Records['status']=='disable') { echo "selected";} ?>>Disable</option>
                  </select></td>
                
				</tr>
              
                <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name ="submit" type="submit" class="button" value="Submit" onclick="return validateForm();">
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