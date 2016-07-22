<!-- ==============================================
//  Created by PHP Dev Zone           			 ||
//	http://php-dev-zone.com                      ||
//  Contact for any Web Development Stuff        ||
//  Email: ketan32.patel@gmail.com     			 ||
//=============================================-->

<?php $countryId=intval($_GET['country_name']);
$stateId=intval($_GET['state_name']);
$con = mysql_connect('localhost', 'root', 'admin'); 
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('db_shotz7');
$query="SELECT city_id,city_name FROM tbl_city WHERE country_id='$countryId' AND state_id='$stateId'";
$result=mysql_query($query);

?><td width="81%" height="25" valign="top">
<select name="city_name" class="selectbox">
<option >Select City</option>
<?php while($row=mysql_fetch_array($result)) { ?>
<option value=<?php echo $row['city_id']?>><?php echo $row['city_name']?></option>
<?php } ?>
</select><td>
