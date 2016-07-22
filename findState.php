<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.com                      ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->


<?php $country=intval($_GET['country_name']);
$con = mysql_connect('localhost', 'root', 'admin'); 
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('db_shotz7');
$query="SELECT state_id,state_name FROM tbl_state WHERE country_id='$country'";
$result=mysql_query($query);

?><td width="81%" height="25" valign="top">
<select name="state_id" id="state_id" onchange="getCity(<?php echo $country?>,this.value)" class="selectbox">
<option>Select State</option>
<?php while ($row=mysql_fetch_array($result)) { ?>
<option value=<?php echo $row['state_id']?>><?php echo $row['state_name']?></option>
<?php } ?>
</select></td>
