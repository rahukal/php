<?

require 'conn/Session.php';

require 'conn/MySQL.php';

require_once("includes/paging.inc.php");

require_once("includes/generalFunction.php");

require_once("classes/class.SiteManager.php");

require_once("classes/class.ImageManager.php");



$dbcon =  new MySQL();

$siteObj =  new SiteManager();

$imgObj =  new ImageManager();

require 'conn/checkSession.php';

$userId=$_SESSION['userId'];

$itemListId=$_POST['itemListId'];

if($_POST['submit']) 

{

   $errorMessage = "";

   if(move_uploaded_file($_FILES["img"]["tmp_name"],"upload/".$_FILES["img"]["name"]))

	  {

	    $current_image= "upload/".$_FILES['img']['name']; 

		$res = $imgObj->createThumbs("upload/","upload/",100);

		// Read the file 

		$fp   = fopen($current_image, 'r');

		$imgContent = base64_encode(fread($fp, filesize($current_image)));

		fclose($fp);

		unlink($current_image);

	   }

   if($errorMessage=="")

	  {

		if($_POST['name']) 

		{

			$content=array("name"=>$_POST['name'],"quantity"=>$_POST['quantity'],"price"=>$_POST['price'],

		    "remarks"=>$_POST['remarks'],"coupon"=>$_POST['coupon'],"barcode"=>$_POST['barcode'],"category"=>$_POST['category'],

			"brand"=>$_POST['brand'],"tax1"=>$_POST['tax1'],"tax2"=>$_POST['tax2'],"img"=>$imgContent);

			$condition=" where itemListId=$itemListId";

			$dbcon->update_query("masterlisttbl",$content,$condition);

			$mess="Record updated successfully.";

			$url="masterlist.php?mess=".base64_encode($mess)."";

			redirectPage($url);

		}

	}

	else

	{

		$mess  = $errorMessage;

	}

}

$dbcon->execute_query("select * from masterlisttbl where itemListId=$itemListId");

$Records=$dbcon->fetch_one_record();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Bridal Registry Admin</title>

<script type="text/javascript" src="js/general.js"></script>

<script type="text/javascript" src="js/ajaxfile.js"></script>

<script type="text/javascript"src="js/zxml.js"></script>

<script language="javascript" src="js/fixedTextArea.js"></script>

<!--CSS-->

<!-- Reset Stylesheet -->

<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />

<!-- Main Stylesheet -->

<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />

<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->

<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />

<!--Javascripts-->

</head>

<body>

<div id="body-wrapper">

  <!-- Wrapper for the radial gradient background -->

  <?  include('left.php'); ?>

  <!--Put content here -->

  <div id="main-content">

    <!-- Main Content Section with everything -->

    <!-- Page Head -->

    <h2>Welcome

      <?=ucfirst($_SESSION["user_name"]); ?>

    </h2>

    <tr>

      <td><br></td>

    </tr>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">

      <tbody>

        <tr>

          <td class="content-box-header"><b style='font-size:15px;'> Update Wish List Item</b></td>

        </tr>

      </tbody>

    </table>

    <form action='#' method='post' enctype="multipart/form-data" onSubmit="return checkall(this)" name="frm">

      <input type="hidden" value="<?=$Records['itemListId']?>" name="itemListId" />

      <table border="0" cellpadding="0" cellspacing="0">

        <? if($_REQUEST['mess']) 

			   {

				  echo '<tr> 

					 <td width="81%" height="25" valign="top" colspan="2"><font color="red">'.base64_decode($_REQUEST['mess']).'</font></td>

					</tr>';

			  } ?>

        <tr>

          <td>

               <table width="100%"  border="0" cellspacing="7" cellpadding="3" >

              <? if($mess) 

			{

				  echo '<tr> 

					 <td width="81%" height="25" valign="top" colspan="2"><font color="red">'.$mess.'</font></td>

					</tr>';

			} ?>

               <tr>

                <th width="19%" align="right" valign="top">Item Name : </th>

                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" value="<?=$Records['name']?>" name="name" id="name" /></td>

              </tr>

              <tr>

                <th width="19%" align="right" valign="top">Quanity : </th>

                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" value="<?=$Records['quantity']?>" name="quantity" id="quantity" /></td>

              </tr>

              <tr>

                <th width="19%" align="right" valign="top">Price : </th>

                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" value="<?=$Records['price']?>" name="price" id="price" /></td>

              </tr>

               <tr>

                <th width="19%" align="right" valign="top"><span class="txtAreaLabel">Remarks : </span> </th>

                <td width="81%" height="25" valign="top" >

                <textarea type="search" name="remarks" id="remarks" class="txtbox"><?=$Records['remarks']?></textarea>

                </td>

              </tr>

              <tr>

                <th width="19%" align="right" valign="top">Coupon : </th>

                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" value="<?=$Records['coupon']?>" name="coupon" id="coupon" /></td>

              </tr>

              <tr>

                <th width="19%" align="right" valign="top">Barcode : </th>

                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" value="<?=$Records['barcode']?>" name="barcode" id="barcode" /></td>

              </tr>

              <tr>

                <th width="19%" align="right" valign="top">Category : </th>

                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" value="<?=$Records['category']?>" name="category" id="category" /></td>

              </tr>

              <tr>

                <th width="19%" align="right" valign="top">Brand : </th>

                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" value="<?=$Records['brand']?>" name="brand" id="brand" /></td>

              </tr>

            <?php /*?>  <tr>

                <th width="19%" align="right" valign="top">Store : </th>

                <td width="81%" height="25" valign="top" ><input type="search" class="txtbox" value="<?=$Records['store']?>" name="store" id="store" /></td>

              </tr><?php */?>

               <tr>

                <th width="19%" align="right" valign="top">Image : </th>

                <td width="81%" height="25" valign="top" >

                           <img src="view_image.php?itemListId=<?php echo $Records['itemListId']; ?>"  /><br />

               </td>

              </tr>

                <tr>

                <th width="19%" align="right" valign="top">Change Image : </th>

                <td width="81%" height="25" valign="top">

                         <input type="file" name="img" id="img" />

                </td>

              </tr>

              <tr>

                <th width="19%" align="right" valign="top">Tax : </th>

                <td width="81%" valign="top">

                <input type="checkbox" <?php echo $Records['tax1'] == "1" ? 'checked="checked"': '' ; ?> value="1" <?=$Records['store']?> name="tax1" id="tax1" />

                  Tax 1

                  <input type="checkbox" <?php echo $Records['tax2'] == "1" ? 'checked="checked"': '' ; ?> value="1" name="tax2" id="tax2" />

                  Tax 2 </td>

              </tr>

            <tr>

                <td colspan="2" class="last" align="left" style="padding-left:210px;"><input name="submit" type="submit" class="button" value="Submit" >

                  &nbsp;&nbsp;

                  <input name="Submit623" type="button" class="button" value="Cancel" onClick="javascript:history.go(-1);"></td>

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

<script type="text/javascript" language="javascript">

function checkall(obj) 

	{

		if(obj.name.value!=="")

		 {

		   msg = "";  

		   ret = true;

		   if(InitialSpace("name")==false)  

		   {

			  msg +="Please remove Initial Space from Item Name.\n";  

			  ret = false;

		   }

		   if(ret == false) { alert(msg); setFocus("name"); return false;}else { }

		 }

		else {alert("Please enter Item Name."); document.getElementById('name').focus(); return false;  }

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

		/*if(obj.store.value!=="")

		 { msg = "";  

		   ret = true;

		   if(InitialSpace("store")==false)  

		   {

			  msg +="Please remove Initial Space from Store.\n";  

			  ret = false;

		   }

		   if(ret == false) { alert(msg); setFocus("store"); return false;}else { }

		}*/

	

    }

</script>	



</body>

</html>

