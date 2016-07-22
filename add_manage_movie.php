<?
//error_reporting(0);
  require 'conn/Session.php';
  require 'conn/MySQL.php';
  require_once("includes/paging.inc.php");
  require_once("includes/generalFunction.php");
  require_once("classes/class.SiteManager.php");
  require_once("classes/class.ImageManager.php");

    $siteObj =  new SiteManager();
  $dbcon =  new MySQL();
    require 'conn/checkSession.php';
  $created_date = date('Y-m-d H:i:s');

if(isset($_POST['submit'])) 
{
    //die();
 $time=time();
             $folderPath       = "upload/";
             $name=str_replace(" ","",$_FILES["poster"]["name"]);
             if(move_uploaded_file($_FILES["poster"]["tmp_name"],"$folderPath$time.$name"))
                {
                  $logo= "$time.$name";
                        $poster=$logo; 
                }
                else
                {
                $poster= "";
                }
                //**********file upload trailer*********
                $time=time();
             $folderPath       = "upload/";
             $name=str_replace(" ","",$_FILES["upload_trailer"]["name"]);
             if(move_uploaded_file($_FILES["upload_trailer"]["tmp_name"],"$folderPath$time.$name"))
                {
                  $logo= "$time.$name";
                        $upload_trailer=$logo; 
                }
                else
                {
                $upload_trailer= "";
                }
//**********file upload movie*********
                $time=time();
             $folderPath       = "upload/";
             $name=str_replace(" ","",$_FILES["upload_movie"]["name"]);
             if(move_uploaded_file($_FILES["upload_movie"]["tmp_name"],"$folderPath$time.$name"))
                {
                  $logo= "$time.$name";
                        $upload_movie=$logo; 
                }
                else
                {
                $upload_movie= "";
                }
  //***********file Upload End**************** 
  $content=array("name"=>$_POST['name'],"movie_category_id"=>$_POST['movie_category_id'],"description"=>$_POST['description'],"position"=>$_POST['position'],"url_for_seo"=>$_POST['url_for_seo'],"catchy_content"=>$_POST['catchy_content'],"director"=>$_POST['director'],"producer"=>$_POST['producer'],"cast"=>$_POST['cast'],"amount"=>$_POST['amount'],"language_id"=>$_POST['language_id'],"country_id"=>$_POST['country_id'],"user_id"=>$_POST['user_id'],"status"=>$_POST['status'],"publish"=>$_POST['publish'],"show_movie_button"=>$_POST['show_movie_button'],"upload_movie"=>$upload_movie,"poster"=>$poster,"upload_trailer"=>$upload_trailer,"title"=>$_POST['title'],"meta_description"=>$_POST['meta_description'],"meta_keywords"=>$_POST['meta_keywords'],"shotz_films"=>$_POST['shotz_films'],"shotz_clips"=>$_POST['shotz_clips'],"shotz_of_the_week"=>$_POST['shotz_of_the_week'],"miscellaneous_videos"=>$_POST['miscellaneous_videos'],"recommended"=>$_POST['recommended'],"most_popular_video"=>$_POST['most_popular_video'],"upcoming_movies_trailers"=>$_POST['upcoming_movies_trailers']);
  $dbcon->insert_query("tbl_manage_movies",$content);
  
  $mess="Record created successfully.";
  $url="manage_movie.php?mess=".base64_encode($mess);
  redirectPage($url);
     
    
}

?>
<?php
$sqlDropDown="select * from tbl_country where 1";
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
<script type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script>
 <link type="text/css" href="resources/css/smoothness/jquery-ui-1.8.8.custom.css" rel="stylesheet" />
 <script type="text/javascript" src="js/action.js"></script>
<script type="text/javascript">
  function check_form(thisform)
    {
      with (thisform)
        {
         if ((isBlank(name,"Please enter  name .") && InitialSpace('zip_code') )==false)
          {name.focus();return false;}
           if ((isBlank(last_name,"Please enter last name.") && InitialSpace('last_name') )==false)  
          {_last_name.focus();return false;}                             
          else if ((isBlank(date_of_birth,"Please enter  date of birth.") && InitialSpace('date_of_birth') )==false)
          {date_of_birth.focus();return false;}                            
                 
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
          <td class="content-box-header"><b style='font-size:15px;'>Add Movies </b></td>
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
                <th width="19%" align="right" valign="top">Category: </th>
                <td width="81%" height="25" valign="top" ><select name="movie_category_id" id="movie_category_id" class="selectbox"><option selected="selected" value="0">Select category...</option>
        <? $siteObj->get_movie_category();?></select></td>              
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">Position </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="position" id="position" style="width:250px;" /></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">URL for SEO </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="url_for_seo" id="url_for_seo" style="width:250px;" /></td>
              </tr>

               <tr>
                <th width="19%" align="right" valign="top">Name </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="name" id="name" style="width:250px;" required="required"/></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">Catchy Content </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="catchy_content" id="catchy_content" style="width:250px;" /></td>
              </tr>

              <tr>
        
                <th width="19%" align="right" valign="top">Description : </th>
                <td width="81%" height="25" valign="top" ><textarea id="description" name="description" class="txtbox"></textarea></td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">Director </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="director" id="director" style="width:250px;" /></td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">Producer </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="producer" id="producer" style="width:250px;" /></td>
              </tr>

        <tr>
                <th width="19%" align="right" valign="top">Cast </th>
                <td width="81%" height="25" valign="top" ><input type="search" name="cast" id="cast" style="width:250px;" /></td>
              </tr>
              
              <tr>
                <th width="19%" align="right" valign="top">Amount : </th>
                <td width="81%" height="25" valign="top" ><select name="amount" id="amount" required="required" class="selectbox">
                    
                   <option value="free">Free</option>
                                   <option value="paid">Paid</option>
                  
                    </select></td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">language: </th>
                <td width="81%" height="25" valign="top" ><select name="language_id" id="language_id" value="select language" class="selectbox"><option selected="selected" value="0">Select language</option>
        <? $siteObj->get_language();?></select></td>              
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
                <th width="19%" align="right" valign="top">User : </th>
                <td width="81%" height="25" valign="top" ><select name="user_id" id="user_id" class="selectbox"><option selected="selected" value="0">Select user </option>
        <? $siteObj->get_user();?></select></td>              
              </tr>

               <tr>
                <th width="19%" align="right" valign="top">Status : </th>
                <td width="81%" height="25" valign="top" ><select name="status" id="status">
                    
                   <option value="active">Active</option>
                                   <option value="inactive">Inactive</option>
                  
                    </select></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">Publish : </th>
                <td width="81%" height="25" valign="top" ><select name="publish" id="publish">
                    <option selected="selected" value="0">Select Publish</option>
                   <option value="public">Public</option>
                                   <option value="private">Private</option>
                  <option value="unlisted">Unlisted</option>
                    </select></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">show watch movie button: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="show_movie_button" id="show_movie_button "value="yes">yes</option>
                    <input type="radio" name="show_movie_button" id="show_movie_button" value="no">No</option>
                  
                    </td>
              </tr>

<tr>
                <th width="19%" align="right" valign="top">upload movie</th>
                <td width="81%" height="25" valign="top" ><input type="file" name="upload_movie" id="upload_movie" style="width:250px;" required="required"/></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">upload poster</th>
                <td width="81%" height="25" valign="top" required="required"><input type="file" name="poster" id="poster" style="width:250px;"required="required"/></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">upload Trailer</th>
                <td width="81%" height="25" valign="top" ><input type="file" name="upload_trailer" id="upload_trailer" style="width:250px;" required="required"/></td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">Title</th>
                <td width="81%" height="25" valign="top" required="required"><input type="search" name="title" id="title" style="width:250px;" /></td>
              </tr>
<tr>
        
                <th width="19%" align="right" valign="top">Meta Description : </th>
                <td width="81%" height="25" valign="top" ><textarea id="meta_description" name="meta_description" class="txtbox"></textarea></td>
              </tr>
               

               <tr>
        
                <th width="19%" align="right" valign="top">Meta keywords : </th>
                <td width="81%" height="25" valign="top" ><textarea id="meta_keywords" name="meta_keywords" class="txtbox"></textarea></td>
              </tr>



              <tr>
                <th width="19%" align="right" valign="top">shotz films: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="shotz_films" id="shotz_films "value="yes">Yes</option>
                    <input type="radio" name="shotz_films" id="shotz_films" value="no">No</option>
                  
                    </td>
              </tr>
                 


                 <tr>
                <th width="19%" align="right" valign="top">shotz clips: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="shotz_clips" id="shotz_clips "value="yes">Yes</option>
                    <input type="radio" name="shotz_clips" id="shotz_clips" value="no">No</option>
                  
                    </td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">shotz of the week: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="shotz_of_the_week" id="shotz_of_the_week "value="yes">Yes</option>
                    <input type="radio" name="shotz_of_the_week" id="shotz_of_the_week" value="no">No</option>
                  
                    </td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">miscellaneous videos: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="miscellaneous_videos" id="miscellaneous_videos "value="yes">Yes</option>
                    <input type="radio" name="miscellaneous_videos" id="miscellaneous_videos" value="no">No</option>
                  
                    </td>
              </tr>


              <tr>
                <th width="19%" align="right" valign="top">recommended: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="recommended" id="recommended "value="yes">Yes</option>
                    <input type="radio" name="recommended" id="recommended" value="no">No</option>
                  
                    </td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">most popular  video: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="most_popular_video" id="most_popular_video "value="yes">Yes</option>
                    <input type="radio" name="most_popular_video" id="most_popular_video" value="no">No</option>
                  
                    </td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">upcoming movies trailers: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="upcoming_movies_trailers" id="upcoming_movies_trailers "value="yes">Yes</option>
                    <input type="radio" name="upcoming_movies_trailers" id="upcoming_movies_trailers" value="no">No</option>
                  
                    </td>
              </tr>
              <tr>
                <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name="submit" type="submit" class="button" value="Submit">
                  &nbsp;&nbsp;
                  <input name="Submit623" type="button" class="button" value="Cancel" onclick="javascript:window.location='manage_movie.php'"></td>
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
<script type="text/javascript" language="javascript">
function checkall(obj) 
  {
    if(obj.name.value!=="")
     {
       msg = "";  
       ret = true;
       if(InitialSpace("name")==false)  
       {
        msg +="Please remove Initial Space from  Name.\n";  
        ret = false;
       }
       if(ret == false) { alert(msg); setFocus("name"); return false;}else { }
     }
    else {alert("Please enter  Name."); document.getElementById('name').focus(); return false;  }
    /*description*/
    if(obj.description.value!=="")
     {
       msg = "";  
       ret = true;
       if(InitialSpace("name")==false)  
       {
        msg +="Please remove Initial Space from  description.\n";  
        ret = false;
       }
       if(ret == false) { alert(msg); setFocus("description"); return false;}else { }
     }
    else {alert("Please enter  description."); document.getElementById('description').focus(); return false;  }
    /*email validation*/
    /*description*/
    if(obj.producer.value!=="")
     {
       msg = "";  
       ret = true;
       if(InitialSpace("producer")==false)  
       {
        msg +="Please remove Initial Space from  producer.\n";  
        ret = false;
       }
       if(ret == false) { alert(msg); setFocus("producer"); return false;}else { }
     }
    else {alert("Please enter producer."); document.getElementById('producer').focus(); return false;  }
    /*email validation*/
    if(obj.quantity.value!=="")
     { msg = "";  
       ret = true;
       if(InitialSpace("quantity")==false)  
       {
        msg +="Please remove Initial Space from Quantity.\n";  
        ret = false;
       }
       if(isNaN(obj.quantity.value))
       {
        msg +="Quantity must be numberic.\n";  
        ret = false;  
       }
       if(ret == false) { alert(msg); setFocus("quantity"); return false;}else { }
    }
    else {alert("Please enter Quantity."); document.getElementById('quantity').focus(); return false;  }
    /*price validation*/
    if(obj.price.value!=="")
     { msg = "";  
       ret = true;
       if(InitialSpace("price")==false)  
       {
        msg +="Please remove Initial Space from Price.\n";  
        ret = false;
       }
       if(isNaN(obj.price.value))
       {
        msg +="Price must be numberic.\n";  
        ret = false;  
       }
       if(ret == false) { alert(msg); setFocus("price"); return false;}else { }
    }
    else {alert("Please enter Price."); document.getElementById('price').focus(); return false;  }
    /*coupon validation*/
    if(obj.coupon.value!=="")
     { msg = "";  
       ret = true;
       if(InitialSpace("coupon")==false)  
       {
        msg +="Please remove Initial Space from Coupon.\n";  
        ret = false;
       }
       if(ret == false) { alert(msg); setFocus("coupon"); return false;}else { }
    }
    /*barcode validation*/
    if(obj.barcode.value!=="")
     { msg = "";  
       ret = true;
       if(InitialSpace("barcode")==false)  
       {
        msg +="Please remove Initial Space from Barcode.\n";  
        ret = false;
       }
       if(ret == false) { alert(msg); setFocus("barcode"); return false;}else { }
    }
    /*category validation*/
    if(obj.category.value!=="")
     { msg = "";  
       ret = true;
       if(InitialSpace("category")==false)  
       {
        msg +="Please remove Initial Space from Category.\n";  
        ret = false;
       }
       if(ret == false) { alert(msg); setFocus("category"); return false;}else { }
    }
    /*brand validation*/
    if(obj.brand.value!=="")
     { msg = "";  
       ret = true;
       if(InitialSpace("brand")==false)  
       {
        msg +="Please remove Initial Space from Brand.\n";  
        ret = false;
       }
       if(ret == false) { alert(msg); setFocus("brand"); return false;}else { }
    }
    /*brand validation*/
    if(obj.store.value!=="")
     { msg = "";  
       ret = true;
       if(InitialSpace("store")==false)  
       {
        msg +="Please remove Initial Space from Store.\n";  
        ret = false;
       }
       if(ret == false) { alert(msg); setFocus("store"); return false;}else { }
    }
  
    }
</script> 
</body>
</html>
