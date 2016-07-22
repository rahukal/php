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
	$promotion_code_id	= $_REQUEST['promotion_code_id'];
	$created=date("Y-m-d : H:i:s");
	if(isset($_POST['submit'])) 
	{
	$content=array("promotion_code"=>$_POST['promotion_code'],"total_allowed"=>$_POST['total_allowed'],"uses_per_coupon"=>$_POST['uses_per_coupon'],"uses_per_user"=>$_POST['uses_per_user'],"type"=>$_POST['type'],"description"=>$_POST['description'],"created_date"=>$created,"date_from"=>$_POST['date_from'],"date_to"=>$_POST['date_to'],"status"=>$_POST['status'],"number_days"=>$_POST['number_days']);

		$condition=" where promotion_code_id='$promotion_code_id'";
		$dbcon->update_query("tbl_manage_promotion",$content,$condition);
		$mess="Record updated successfully.";
		$url="manage_promotion.php?mess=".base64_encode($mess);
		redirectPage($url);
	}


$query	="select * from tbl_manage_promotion where promotion_code_id='$promotion_code_id'";
$dbcon->execute_query($query);

$Records=$dbcon->fetch_one_record();

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
			$( "#date_to" ).datepicker({
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
				 if ((isBlank(promotion_code,"Please enter promotion code.") && InitialSpace('promotion_code') )==false)
				  {promotion_code.focus();return false;}
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
          <td class="content-box-header"><b style='font-size:15px;'>Update Movie</b></td>
        </tr>
      </tbody>
    </table>
    <form action='#' method='post' enctype="multipart/form-data" onSubmit="return check_form(this)" name="frm">
      <input type="hidden" value="<?=$Records['promotion_code_id']?>" name="promotion_code_id" />
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
                <th width="19%" align="right" valign="top">promotion code: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="promotion_code" id="promotion_code" class="txtbox" required="required" value="<?=$Records['promotion_code']?>" /></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">total allowed: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="total_allowed" id="total_allowed" class="txtbox" required="required" value="<?=$Records['total_allowed']?>"/></td>
              </tr>
              

              <tr>
                <th width="19%" align="right" valign="top">Type : </th>
                <td width="81%" height="25" valign="top" ><select name="type" id="type" class="selectbox">                    <option value="no.of_movies" <? if($Records['type']=='no.of_movies') { echo "selected";} ?>>No. of Movies</option>
                    <option value="no.of_days" <? if($Records['type']=='no.of_days') { echo "selected";} ?>>No. of Days</option>
                  </select></td>
                
				</tr>

              <tr>
                <th width="19%" align="right" valign="top">Description : </th>
                <td width="81%" height="25" valign="top" ><textarea id="description" name="description" class="txtbox" ><?=$Records['description']?></textarea></td>
              </tr> 

                <tr>
                <th width="19%" align="right" valign="top">No. of Days: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="number_days" id="number_days" class="txtbox" value="<?=$Records['number_days']?>"/></td>
              </tr>

				<tr>
                <th width="19%" align="right" valign="top">uses per coupon: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="uses_per_coupon" id="uses_per_coupon" class="txtbox" required="required" value="<?=$Records['uses_per_coupon']?>"/></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">uses per user: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="uses_per_user" id="uses_per_user" class="txtbox" required="required" value="<?=$Records['uses_per_user']?>"/></td>
              </tr>

              <tr>
                <th>Validity Period: </th>
                <td>From<input type="date" name="date_from" id="date_from" required="required" value="<?=$Records['date_from']?>"/><br>To<input type="date" name="date_to" id="date_to" value="<?=$Records['date_to']?>" required="required" style="margin: 14px;"></td>
              </tr>

             	<tr>
                <th width="19%" align="right" valign="top">Status : </th>
                <td width="81%" height="25" valign="top" ><select name="status" id="status">
                    <option value="active" <? if($Records['status']=='active') { echo "selected";} ?>>Active</option>
                    <option value="inactive" <? if($Records['status']=='inactive') { echo "selected";} ?>>Inactive</option>
                  </select></td>
                
				</tr>
				

                <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name ="submit" type="submit" class="button" value="Submit" onclick="">
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='manage_promotion.php'"></td>
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
