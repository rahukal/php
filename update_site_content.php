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
	
	require 'conn/checkSession.php';
	$site_content_category_id	= $_REQUEST['site_content_category_id'];
	if(isset($_POST['submit'])) 
	{
	$content=array("name"=>$_POST['name'],"gossip_type_id"=>$_POST['gossip_type_id'],"status"=>$_POST['status']);
		$condition=" where site_content_category_id='$site_content_category_id'";
		$dbcon->update_query("tbl_site_content_category",$content,$condition);
		$mess="Record updated successfully.";
		$url="site_category.php?mess=".base64_encode($mess);
		redirectPage($url);
	}


$query	="select * from tbl_site_content_category where site_content_category_id='$site_content_category_id'";
$dbcon->execute_query($query);

$Records=$dbcon->fetch_one_record();

?>
<?php
$sqlDropDown="select * from tbl_gossip_type where 1";
$ExecuteQuery=mysql_query($sqlDropDown) or die(mysql_error());
$countDropDown=mysql_num_rows($ExecuteQuery);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"

"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
<!--CSS-->
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
				 if ((isBlank(name,"Please enter state name.") && InitialSpace('name') )==false)
				  {name.focus();return false;}
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
          <td class="content-box-header"><b style='font-size:15px;'>Update site category</b></td>
        </tr>
      </tbody>
    </table>
    <form action='#' method='post' enctype="multipart/form-data" onSubmit="return check_form(this)" name="frm">
      <input type="hidden" value="<?=$Records['site_content_category_id']?>" name="site_content_category_id" />
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
                <th width="19%" align="right" valign="top">Name : </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" style="width:250px;" name="name" required="required" value="<?=$Records['name']?>" id="name" /></td>
              </tr>


              <tr>
                <th width="19%" align="right" valign="top">Gossip type : </th>
                <td width="81%" height="25" valign="top"><select name="gossip_type_id" class="selectbox" id="gossip_type_id"><option selected="selected" value="0">Select gossip type</option>
                    <?php 
						 if($countDropDown>0)
						  {  $i=0;
              				 while($records=mysql_fetch_array($ExecuteQuery)) 
							 {
						      ?>
                    <option <?php echo $_POST['gossip_type_id'] == $records['gossip_type_id'] ? 'selected="selected"': '' ; ?> value="<?php echo $records['gossip_type_id']; ?>"><?php echo $records['gossip_type']; ?></option>
                    <?php } } ?>
                  </select></td>
              </tr>

             
               
			 
				<tr>
                <th width="19%" align="right" valign="top">Status : </th>
                <td width="81%" height="25" valign="top" ><select name="status" id="status">
                    <option value="active" <? if($Records['status']=='active') { echo "selected";} ?>>Active</option>
                    <option value="inactive" <? if($Records['status']=='inactive') { echo "selected";} ?>>Inactive</option>
                  </select></td>
                
				</tr>
              
                <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name ="submit" type="submit" class="button" value="Submit" onclick="">
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='site_category.php'"></td>
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
