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
	$movie_id	= $_REQUEST['movie_id'];
	if(isset($_POST['submit'])) 
	{
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
                //*********uploading finshing********//
	$content=array("name"=>$_POST['name'],"movie_category_id"=>$_POST['movie_category_id'],"description"=>$_POST['description'],"position"=>$_POST['position'],"url_for_seo"=>$_POST['url_for_seo'],"catchy_content"=>$_POST['catchy_content'],"director"=>$_POST['director'],"producer"=>$_POST['producer'],"cast"=>$_POST['cast'],"amount"=>$_POST['amount'],"language_id"=>$_POST['language_id'],"country_id"=>$_POST['country_id'],"user_id"=>$_POST['user_id'],"status"=>$_POST['status'],"publish"=>$_POST['publish'],"show_movie_button"=>$_POST['show_movie_button'],"upload_movie"=>$upload_movie,"poster"=>$poster,"upload_trailer"=>$upload_trailer,"title"=>$_POST['title'],"meta_description"=>$_POST['meta_description'],"meta_keywords"=>$_POST['meta_keywords'],"shotz_films"=>$_POST['shotz_films'],"shotz_clips"=>$_POST['shotz_clips'],"shotz_of_the_week"=>$_POST['shotz_of_the_week'],"miscellaneous_videos"=>$_POST['miscellaneous_videos'],"recommended"=>$_POST['recommended'],"most_popular_video"=>$_POST['most_popular_video'],"upcoming_movies_trailers"=>$_POST['upcoming_movies_trailers']);


		$condition=" where movie_id='$movie_id'";
		$dbcon->update_query("tbl_manage_movies",$content,$condition);
		$mess="Record updated successfully.";
		$url="manage_movie.php?mess=".base64_encode($mess);
		redirectPage($url);
	}


$query	="select * from tbl_manage_movies where movie_id='$movie_id'";
$dbcon->execute_query($query);

$Records=$dbcon->fetch_one_record();

?>
<?php
$sqlDropDown="select * from tbl_country where 1";
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
				 if ((isBlank(category_type,"Please select event category name.") && InitialSpace('name') )==false)
				  {category_type.focus();return false;}
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
      <input type="hidden" value="<?=$Records['movie_id']?>" name="movie_id" />
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
                <th width="19%" align="right" valign="top">Category: </th>
                <td width="81%" height="25" valign="top" ><select name="movie_category_id" id="movie_category_id" class="selectbox"><option selected="selected" value="0">Select category...</option>
        <? $siteObj->get_movie_category();?></select></td>              
              </tr>
                  
              <tr>
                <th width="19%" align="right" valign="top">Position: </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" style="width:250px;" name="position" value="<?=$Records['position']?>" id="position" /></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">URL For SEO : </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" style="width:250px;" name="url_for_seo" value="<?=$Records['url_for_seo']?>" id="url_for_seo" /></td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">Name : </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" style="width:250px;" name="name" required="required" value="<?=$Records['name']?>" id="name" /></td>
              </tr>
               
			<tr>
                <th width="19%" align="right" valign="top">Catchy Content : </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" style="width:250px;" name="catchy_content" value="<?=$Records['catchy_content']?>" id="catchy_content" /></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">Description : </th>
                <td width="81%" height="25" valign="top" ><textarea id="description" name="description" class="txtbox" ><?=$Records['description']?></textarea></td>
              </tr>	

                <tr>
                <th width="19%" align="right" valign="top">Director : </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" style="width:250px;" name="director" value="<?=$Records['director']?>" id="director" /></td>
              </tr> 

              <tr>
                <th width="19%" align="right" valign="top">Producer : </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" style="width:250px;" name="producer" required="required" value="<?=$Records['producer']?>" id="producer" /></td>
              </tr> 
              <tr>
                <th width="19%" align="right" valign="top">Cast : </th>
                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" style="width:250px;" name="cast" value="<?=$Records['cast']?>" id="cast" /></td>
              </tr> 

              <tr>
                <th width="19%" align="right" valign="top">Amount : </th>
                <td width="81%" height="25" valign="top" ><select name="amount" id="amount">                    <option value="free" <? if($Records['amount']=='free') { echo "selected";} ?>>Free</option>
                    <option value="paid" <? if($Records['amount']=='paid') { echo "selected";} ?>>Paid</option>
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
                <td width="81%" height="25" valign="top" ><select name="user_id" id="user_id"><option selected="selected" value="0">Select user </option>
        <? $siteObj->get_user();?></select></td>              
              </tr>

             	<tr>
                <th width="19%" align="right" valign="top">Status : </th>
                <td width="81%" height="25" valign="top" ><select name="status" id="status">
                    <option value="active" <? if($Records['status']=='active') { echo "selected";} ?>>Active</option>
                    <option value="inactive" <? if($Records['status']=='inactive') { echo "selected";} ?>>Inactive</option>
                  </select></td>
                
				</tr>
				<tr>
                <th width="19%" align="right" valign="top">Publish : </th>
                <td width="81%" height="25" valign="top" ><select name="publish" id="publish">
                    <option value="public" <? if($Records['publish']=='public') { echo "selected";} ?>>Public</option>
                    <option value="private" <? if($Records['publish']=='private') { echo "selected";} ?>>Private</option>
                    <option value="unlisted" <? if($Records['publish']=='unlisted') { echo "selected";} ?>>Unlisted</option>
                  </select></td>
                
				</tr>
				<tr>
                <th width="19%" align="right" valign="top">show watch movie button: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="show_movie_button" id="show_movie_button "value="yes" 
                   <? if($Records['show_movie_button']=='yes') { echo "selected";} ?>>yes</option>
                    <input type="radio" name="show_movie_button" id="show_movie_button" value="no"<? if($Records['show_movie_button']=='no') { echo "selected";} ?>>No</option>
                  
                    </td>
              </tr>
              <tr>
       <th></th>
        
        <td width="81%" valign="top"><input type="hidden" value="<?=$Records['upload_movie']?>" name="upload_movie"  /></td>
             </tr>

        <tr>
                <th width="19%" align="right" valign="top">Upload New Movie : </th>
                <td width="81%" height="25" valign="top" ><input type="file" style="width:250px;" name="upload_movie" id="upload_movie" required="required"/></td>
              </tr>

              <tr>
       <th></th>
        
        <td width="81%" valign="top"><input type="hidden" value="<?=$Records['poster']?>" name="poster"  /></td>
             </tr>

        <tr>
                <th width="19%" align="right" valign="top">Upload New Poster : </th>
                <td width="81%" height="25" valign="top" ><input type="file" style="width:250px;" name="poster" id="poster" required="required"/></td>
              </tr>

              <tr>
       <th></th>
        
        <td width="81%" valign="top"><input type="hidden" value="<?=$Records['upload_trailer']?>" name="upload_trailer"  /></td>
             </tr>

        <tr>
                <th width="19%" align="right" valign="top">Upload New Trailer : </th>
                <td width="81%" height="25" valign="top" ><input type="file" style="width:250px;" name="upload_trailer" id="upload_trailer" required="required"/></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">Title</th>
                <td width="81%" height="25" valign="top" ><input type="search" name="title" id="title" style="width:250px;" required="required" value="<?=$Records['title']?>"/></td>
              </tr>

              <tr>
        
                <th width="19%" align="right" valign="top">Meta Description : </th>
                <td width="81%" height="25" valign="top" ><textarea id="meta_description" name="meta_description" class="txtbox" value="<?=$Records['meta_description']?>"></textarea></td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">shotz films: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="shotz_film" id="shotz_film "value="yes" 
                   <? if($Records['shotz_film']=='yes') { echo "selected";} ?>>yes</option>
                    <input type="radio" name="shotz_film" id="shotz_film" value="no"<? if($Records['shotz_film']=='no') { echo "selected";} ?>>No</option>
                  
                    </td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">shotz Clips: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="shotz_clips" id="shotz_clips "value="yes" 
                   <? if($Records['shotz_clips']=='yes') { echo "selected";} ?>>yes</option>
                    <input type="radio" name="shotz_clips" id="shotz_clips" value="no"<? if($Records['shotz_clips']=='no') { echo "selected";} ?>>No</option>
                  
                    </td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">shotz Of The Week: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="shotz_of_the_week" id="shotz_of_the_week "value="yes" 
                   <? if($Records['shotz_of_the_week']=='yes') { echo "selected";} ?>>yes</option>
                    <input type="radio" name="shotz_of_the_week" id="shotz_of_the_week" value="no"<? if($Records['shotz_of_the_week']=='no') { echo "selected";} ?>>No</option>
                  
                    </td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">Miscellaneous Videos: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="miscellaneous_videos" id="miscellaneous_videos "value="yes" 
                   <? if($Records['miscellaneous_videos']=='yes') { echo "selected";} ?>>yes</option>
                    <input type="radio" name="miscellaneous_videos" id="miscellaneous_videos" value="no"<? if($Records['miscellaneous_videos']=='no') { echo "selected";} ?>>No</option>
                  
                    </td>
              </tr>
              <tr>
                <th width="19%" align="right" valign="top">Recommended: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="recommended" id="recommended "value="yes" 
                   <? if($Records['recommended']=='yes') { echo "selected";} ?>>yes</option>
                    <input type="radio" name="recommended" id="recommended" value="no"<? if($Records['recommended']=='no') { echo "selected";} ?>>No</option>
                  
                    </td>
              </tr>

              <tr>
                <th width="19%" align="right" valign="top">Most Popular Video: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="most_popular_video" id="most_popular_video "value="yes" 
                   <? if($Records['most_popular_video']=='yes') { echo "selected";} ?>>yes</option>
                    <input type="radio" name="most_popular_video" id="most_popular_video" value="no"<? if($Records['most_popular_video']=='no') { echo "selected";} ?>>No</option>
                  
                    </td>
              </tr>

               <tr>
                <th width="19%" align="right" valign="top">Upcoming Movies Trailers: </th>
                <td width="81%" height="25" valign="top" >
                   <input type="radio" name="upcoming_movies_trailers" id="upcoming_movies_trailers "value="yes" 
                   <? if($Records['upcoming_movies_trailers']=='yes') { echo "selected";} ?>>yes</option>
                    <input type="radio" name="upcoming_movies_trailers" id="upcoming_movies_trailers" value="no"<? if($Records['upcoming_movies_trailers']=='no') { echo "selected";} ?>>No</option>
                  
                    </td>
              </tr>

                <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name ="submit" type="submit" class="button" value="Submit" onclick="">
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
<!-- End Content here-->
<!-- End #main-content -->
</div>
<script>
function checkall(obj) 
{
  /*name*/
    if(isBlank("name")==false)
  {
    alert("Please enter Name.\n");
    return false; 
  }
  else
  {
    msg = "";  
      ret = true;
    if(InitialSpace("name")==false) {  msg +="Please remove Initial Space from Name.\n";        ret = false;     }
    if(isSpclChar("name")==false)   {  msg +="Please remove Special Characters from Name.\n";     ret = false;     }
    if(ret == false) { alert(msg); setFocus("name"); return false;} else {  return true;}
    }
}
</script>
</body></html>
