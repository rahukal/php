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
	$city_name=$_POST['city_name'];
	 $checkIfExist = "select * from tbl_city where city_name='".$city_name."'";
  
	$chackQry     = mysql_query($checkIfExist);
	$dataRows     = mysql_num_rows($chackQry);
	
	if($dataRows>0)
	{
		$mess1 ="Already Exist.";
	}
	else
	{ 

	//***********file Upload End**************** 
	$content=array("city_name"=>$_POST['city_name'],"city_code"=>$_POST['city_code'],"country_id"=>$_POST['country_id'],"state_id"=>$_POST['state_id'],"status"=>$_POST['status']);
	$dbcon->insert_query("tbl_city",$content);

	
	$mess="Record created successfully.";
	$url="city.php?mess=".base64_encode($mess);
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
         if ((isBlank(city_name,"Please enter city name.") && InitialSpace('city_name') )==false)
          {city_name.focus();return false;}
        } 
    }
</script>
<?php 

$query="SELECT * FROM tbl_country";
$result=mysql_query($query);
?>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
    var xmlhttp=false;  
    try{
      xmlhttp=new XMLHttpRequest();
    }
    catch(e)  {   
      try{      
        xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e){
        try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e1){
          xmlhttp=false;
        }
      }
    }
      
    return xmlhttp;
    }
  
  function getState(countryId) {    
    
    var strURL="findState.php?country_name="+countryId;
    var req = getXMLHTTP();
    
    if (req) {
      
      req.onreadystatechange = function() {
        if (req.readyState == 4) {
          // only if "OK"
          if (req.status == 200) {            
            document.getElementById('statediv').innerHTML=req.responseText;
            document.getElementById('citydiv').innerHTML='<select name="city_id">'+
            '<option>Select City</option>'+
                '</select>';            
          } else {
            alert("Problem while using XMLHTTP:\n" + req.statusText);
          }
        }       
      }     
      req.open("GET", strURL, true);
      req.send(null);
    }   
  }
  function getCity(countryId,stateId) {   
    var strURL="findCity.php?country_name="+countryId+"&state_name="+stateId;
    var req = getXMLHTTP();
    
    if (req) {
      
      req.onreadystatechange = function() {
        if (req.readyState == 4) {
          // only if "OK"
          if (req.status == 200) {            
            document.getElementById('citydiv').innerHTML=req.responseText;            
          } else {
            alert("Problem while using XMLHTTP:\n" + req.statusText);
          }
        }       
      }     
      req.open("GET", strURL, true);
      req.send(null);
    }
        
  }
  function getlocality(stateId,cityId) {   
    var strURL="findlocality.php?state_name="+stateId+"&city_name="+cityId;
    var req = getXMLHTTP();
    
    if (req) {
      
      req.onreadystatechange = function() {
        if (req.readyState == 4) {
          // only if "OK"
          if (req.status == 200) {            
            document.getElementById('citydiv').innerHTML=req.responseText;            
          } else {
            alert("Problem while using XMLHTTP:\n" + req.statusText);
          }
        }       
      }     
      req.open("GET", strURL, true);
      req.send(null);
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
          <td class="content-box-header"><b style='font-size:15px;'>Add City</b></td>
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
                <th width="19%" align="right" valign="top">Choose country : </th>
                <td width="81%" height="25" valign="top"><select name="country_id" class="selectbox" id="country_id" onChange="getState(this.value)"><option selected="selected" value="0">Select country </option>
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
                <th width="19%" align="right" valign="top">Choose state : </th>
                <td width="81%" height="25" valign="top"><div id="statediv"><select name="state_id" id="state_id" class="selectbox">
  <option>Select State</option>
        </select></div></td></tr>
  <tr>
    <th width="19%" align="right" valign="top">Choose City : </th>
    <td ><div id="citydiv"><select name="city_id" id="city_id" value="<?=$Records['city_name']?>" class="selectbox">
  <option>Select city</option>
        </select></div></td>
  </tr>

              <tr>
                <th width="19%" align="right" valign="top">City Code : </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox"  name="city_code" id="city_code" required="required"/></td>
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
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='city.php'"></td>
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
