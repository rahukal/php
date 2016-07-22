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


	$user_id	=$_REQUEST['user_id'];

	if(isset($_POST['submit'])) 
	{
	
	$content=array("user_type_id"=>$_POST['user_type_id'],
				   "user_name"=>$_POST['user_name'],
				   "first_name"=>$_POST['first_name'],
				   "last_name"=>$_POST['last_name'],
				   "email"=>$_POST['email'],
				   "password"=>$_POST['password'],
				   "mobile"=>$_POST['mobile'],
				   "telephone"=>$_POST['telephone'],
				   "describe_yourself"=>$_POST['describe_yourself'],
				   "gender"=>$_POST['gender'],
				   "date_of_birth"=>$_POST['date_of_birth'],
				   "country_id"=>$_POST['country_id'],
				   "address"=>$_POST['address'],
				   "address_1"=>$_POST['address_1'],
				   "address_2"=>$_POST['address_2'],
				   "state"=>$_POST['state'],
				   "city"=>$_POST['city'],
				   "zip_code"=>$_POST['zip_code'],
				   "date"=>$_POST['date'],
				   "status"=>$_POST['status']
				  );
			$condition=" where user_id='$user_id'";
			$dbcon->update_query("tbl_users",$content,$condition);
			
			$user=$_POST['user_type'];
			
			if($user!="")
			{
				$dbcon->execute_query("delete from tbl_user_type where user_type_id in($user_type_id)");
				for ($i=0;$i< count($user);$i++)
  				{
					$content1=array("user_id"=>$user_id,"user_type"=>$user[$i]);
					$dbcon->insert_query("tbl_user_type",$content1);
				}
			}
			else
			{
			
			}

			
			
			$mess="Record updated successfully.";
			$url="manage_user.php?mess=".base64_encode($mess);
			redirectPage($url);
			
	}


$query	="select * from tbl_users where user_id='$user_id'";
$dbcon->execute_query($query);

$Records=$dbcon->fetch_one_record();

?>
<?php
$sqlDropDown="select * from tbl_country where 1";
$ExecuteQuery=mysql_query($sqlDropDown) or die(mysql_error());
$countDropDown=mysql_num_rows($ExecuteQuery);
?>
<?php
$sqlDrop="select * from tbl_user_type where 1";
$Executequery=mysql_query($sqlDrop) or die(mysql_error());
$countDrop=mysql_num_rows($Executequery);
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
			$( "#date" ).datepicker({
			yearRange: "1990:2020",
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
				 if ((isBlank(user_name,"Please enter user name .") && InitialSpace('user_name') )==false)
				  {user_name.focus();return false;}
				   if ((isBlank(first_name,"Please enter first name.") && InitialSpace('first_name') )==false)  
				  {_first_name.focus();return false;}									  				 
				  else if ((isBlank(last_name,"Please enter  last name.") && InitialSpace('last_name') )==false)
				  {last_name.focus();return false;}									  				 
								 
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
          <td class="content-box-header"><b style='font-size:15px;'> Update user</b></td>
        </tr>
      </tbody>
    </table>
    <form action='#' method='post' enctype="multipart/form-data" onSubmit="return check_form(this)" name="frm">
      <input type="hidden" value="<?=$Records['user_id']?>" name="user_id" />
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
                <th width="19%" align="right" valign="top">user name: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="user_name" id="user_name" required="required" value="<?=$Records['user_name']?>" class="txtbox" /></td>
              </tr>
<tr>
                <th width="19%" align="right" valign="top">first name: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="first_name" id="first_name" required="required" value="<?=$Records['first_name']?>" class="txtbox" /></td>
              </tr>
<tr>
                <th width="19%" align="right" valign="top">last name: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="last_name" id="last_name" required="required" value="<?=$Records['last_name']?>" class="txtbox" /></td>
              </tr>
<tr>
                <th width="19%" align="right" valign="top">email: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="email" id="email" required="required" value="<?=$Records['email']?>" class="txtbox" /></td>
              </tr>

<tr>
                <th width="19%" align="right" valign="top">password: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="password" id="password" value="<?=$Records['password']?>" class="txtbox" /></td>
              </tr>
<tr>
                <th width="19%" align="right" valign="top">mobile: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="mobile" id="mobile" required="required" value="<?=$Records['mobile']?>" class="txtbox" /></td>
              </tr>

 			 <tr>
                <th width="19%" align="right" valign="top">telephone: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="telephone" id="telephone" value="<?=$Records['telephone']?>" class="txtbox" /></td>
              </tr>

<tr>
                <th width="19%" align="right" valign="top">Describe yourself : </th>
                <td width="81%" height="25" valign="top" ><textarea id="describe_yourself" name="describe_yourself" class="txtbox" ><?=$Records['describe_yourself']?></textarea></td>
              </tr>
<tr>
                <th width="19%" align="right" valign="top">Gender : </th>
                <td width="81%" height="25" valign="top" ><select name="gender" id="gender">
                    <option value="male" <? if($Records['gender']=='male') { echo "selected";} ?>>Male</option>
                    <option value="female" <? if($Records['gender']=='female') { echo "selected";} ?>>Female</option>
                  </select></td>
                
				</tr>

				<tr>
                <th width="19%" align="right" valign="top">date of birth: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="date_of_birth" id="date_of_birth" value="<?=$Records['date_of_birth']?>" class="txtbox" /></td>
              </tr>

 			 <tr>
                <th width="19%" align="right" valign="top">Choose country : </th>
                <td width="81%" height="25" valign="top"><select name="country_id" class="selectbox" id="country_id"><option selected="selected" value="0">Select country name</option>
                    <?php 
						 if($countDropDown>0)
						  {  $i=0;
              				 while($records=mysql_fetch_array($ExecuteQuery)) 
							 {
						      ?>
                    <option <?php echo $_POST['country_id'] == $records['country_id'] ? 'selected="selected"': '' ; ?> value="<?php echo $records['country_id']; ?>"><?php echo $records['country_name']; ?></option>
                    <?php } } ?>
                  </select></td>
              </tr>

			  <tr>
                <th width="19%" align="right" valign="top">Address: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="address" id="address" value="<?=$Records['address']?>" class="txtbox" /></td>
              </tr>
		
			  
<tr>
                <th width="19%" align="right" valign="top">Address 1 </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="address_1" id="address_1" value="<?=$Records['address_1']?>" class="txtbox" /></td>
              </tr>

		
			  <tr>
                <th width="19%" align="right" valign="top">Address 2: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="address_2" id="address_2" value="<?=$Records['address_2']?>" class="txtbox" /></td>
              </tr>

			  <tr>
                <th width="19%" align="right" valign="top">State: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="state" id="state" value="<?=$Records['state']?>" class="txtbox" /></td>
              </tr>

			   <tr>
                <th width="19%" align="right" valign="top">city: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="city" id="city" value="<?=$Records['city']?>" class="txtbox" /></td>
              </tr>

				<?php 
				$querys	="select * from tbl_user_type where user_type_id='$user_type_id'";
				$qry4 = mysql_query($querys);
				while($records4 = mysql_fetch_array($qry4))
				{
					$z[]=$records4['user_type'];
				}
				?>
				<tr>
                <th width="19%" align="right" valign="top">zip/postal code: </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="zip_code" id="zip_code" required="required" value="<?=$Records['zip_code']?>" class="txtbox" /></td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top"> Date: </th>
                <td width="81%" height="25" valign="top" ><input type="date" name="date" id="date" value="<?=$Records['date']?>" class="txtbox" /></td>
              </tr>
              
<tr>
                <th width="19%" align="right" valign="top">Select User Type : </th>
                <td width="81%" height="25" valign="top"><select name="user_type_id" class="selectbox" id="user_type_id"><option selected="selected" value="0">Select user type</option>
                    <?php 
						 if($countDrop>0)
						  {  $i=0;
              				 while($records=mysql_fetch_array($Executequery)) 
							 {
						      ?>
                    <option <?php echo $_POST['user_type_id'] == $records['user_type_id'] ? 'selected="selected"': '' ; ?> value="<?php echo $records['user_type_id']; ?>"><?php echo $records['user_type']; ?></option>
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
              
                <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name ="submit" type="submit" class="button" value="Submit" onclick="return validateForm();">
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='manage_user.php'"></td>
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
<script language="JavaScript1.2">

//Advanced Email Check credit-
//By JavaScript Kit (http://www.javascriptkit.com)
//Over 200+ free scripts here!

var testresults
function checkemail(){
var str=document.frm.email.value
var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
if (filter.test(str))
testresults=true
else{
alert("Please input a valid email address!")
testresults=false
}
return (testresults)
}
</script>

<script>
function check_form(){
if (document.layers||document.getElementById||document.all)
return checkemail()
else
return true
}
</script> 
<!-- End Content here-->
<!-- End #main-content -->
</div>
</body></html>