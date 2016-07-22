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
$paging = new Pager;
$pagesize = $_REQUEST['pagesize'];

if(!empty($_POST)) 
{
if($_POST['changeStatus']=='delete') 
{
$id=implode(",", $_POST['arr_pd_ids']);
$dbcon->execute_query("delete from tbl_admin_apply_promotion where admin_apply_id in($id)");
$mess="Record deleted successfully.";
echo "<SCRIPT language=\"JavaScript\">window.location=\"tbl_admin_apply_promotion.php?mess=".base64_encode($mess)."\";</SCRIPT>";
}

if($_POST['changeStatus']=='active') 
{
$id=implode(",", $_POST['arr_pd_ids']);
$dbcon->execute_query("update tbl_admin_apply_promotion set status='active' where admin_apply_id in($id)");
$mess="Record activated successfully.";
echo "<SCRIPT language=\"JavaScript\">window.location=\"tbl_admin_apply_promotion.php?mess=".base64_encode($mess)."\";</SCRIPT>";
}

if($_POST['changeStatus']=='inactive') 
{
$id=implode(",", $_POST['arr_pd_ids']);
$dbcon->execute_query("update tbl_users set status='inactive' where admin_apply_id in($id)");
$mess="Record deactivated successfully.";
echo "<SCRIPT language=\"JavaScript\">window.location=\"tbl_admin_apply_promotion.php?mess=".base64_encode($mess)."\";</SCRIPT>";
}

}

$sql="select * from tbl_admin_apply_promotion where 1";
$limit=$paging->pageSize($pagesize);
$start = $paging->findStart($limit);
$ExecQuery=mysql_query($sql) or die(mysql_error());
$count=mysql_num_rows($ExecQuery);
$pages =$paging->findPages($count, $limit);
$pagelist = $paging->pageList($_GET['page'], $pages,$pagesize);
$showingR=$paging->showingRecords($start,$limit,$count);

$orderBy=$_REQUEST['order_by'];
$orderBy2=$_REQUEST['order_by2'];
if($orderBy=="") {  $orderBy = "admin_apply_id"; }

if(!empty($orderBy) || !empty($orderBy2))
{
$orders="order by $orderBy $orderBy2 DESC";
}
$Exec=mysql_query("$sql $orders LIMIT  $start , $limit") or die(mysql_error());
$countrecord=mysql_num_rows($Exec);

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
<!--                       CSS                       -->
<!-- Reset Stylesheet -->
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" /> 
<!--Javascripts-->
<!-- jQuery -->
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<!-- Facebox jQuery Plugin -->
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<!-- jQuery WYSIWYG Plugin -->
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
</head>
<body>
<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
<? include('left.php'); ?>
<!--Put content here -->
<div id="main-content"> <!-- Main Content Section with everything -->
<!-- Page Head -->
<tr>
<td>
<br>  

<div align="right">Showing Records: <?=$showingR?></div>
<div class="align-left">Records Per Page:
<select name="pagesize" id="pagesize" onchange="location.href='admin_apply_promotion.php?&pagesize='+this.value">
<option value="10" <? if($pagesize==10){echo "selected";} ?>>10</option>
<option value="25" <? if($pagesize==25){echo "selected";} ?>>25</option>
<option value="50" <? if($pagesize==50){echo "selected";} ?>>50</option>
<option value="100" <? if($pagesize==100){echo "selected";} ?>>100</option>
</select>
</div>

</td></tr>
<br />
<br />
<br />
<br />
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td class="content-box-header">
<b style='font-size:15px;'>Admin Apply Users</b> 

</div>

</td>
</tr>
</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<? if($_REQUEST['mess']) 
{
echo '<tr> 
<td width="81%" height="25" valign="top" colspan="2"><font color="red">'.base64_decode($_REQUEST['mess']).'</font></td>
</tr>';
} ?>
<tr>
<td>
<form method="post" name="frm" id="form1">
<input type="hidden" name="changeStatus" id="changeStatus">
<input type="hidden" name="admin_apply_id" id="admin_apply_id">
<table class="tableList" border="0" cellpadding="0" cellspacing="1" width="100%">
<tbody>
<?
if($countrecord>0) {
?>
<tr>
<th width="2%" bgcolor="#FFFFFF">
<input name="check_all" id="check_all" value="1" onclick="checkall(this.form)" type="checkbox">
</th>
<th align="left" width="30%" bgcolor="#FFFFFF"><strong>ID</strong></th>
<th align="left" width="30%" bgcolor="#FFFFFF"><strong>User</strong></th>
<th align="left" width="40%" bgcolor="#FFFFFF"><strong>Email</strong></th>
      
<th>&nbsp;</th>
</tr>
<?
$i=0;
while($records=mysql_fetch_array($Exec)) {
if($i%2==0){$CL="#DBF3FF";}else{$CL="#FFFFFF";}
?>
<tr>
<td align="center" bgcolor='<?=$CL?>'>
<input name="arr_pd_ids[]" id="arr_pd_ids[]" value="<?=$records['admin_apply_id']?>" type="checkbox">
</td>

<td bgcolor='<?=$CL?>'><? echo $siteObj->get_user_id($records['user_id']);?></td>
<td bgcolor='<?=$CL?>'><? echo $siteObj->get_user_name($records['user_id']);?></td>
<td bgcolor='<?=$CL?>'><? echo $siteObj->get_user_email($records['user_id']);?></td>



<td bgcolor='<?=$CL?>'><? echo $a; ?></td>




</tr>

<?
$i++; }
?>

</tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>

<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>

<td width="90%" align="center">
<?

if($count>$limit){

echo $pagelist; 
}

?>
</td>

</tr>
</table>

</td>
</tr>
<?
}else{

echo '<tr>
<td align="center">
No records

</td>
</tr>';


}
?>
</tbody>
</table>
</form>
</td>
</tr>
</table>  
<!-- End #tab1 -->
<? require('footer.php') ?>
</div> <!-- End #main-content -->
</div>
<!-- End Content here-->
<!-- End #main-content -->
</div></body>

</html>