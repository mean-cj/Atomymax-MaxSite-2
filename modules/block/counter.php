			<table width="<?php echo $widthSUM;?>" border="0" cellspacing="0" cellpadding="0" height="3" >

			</table><br>
			<table width="<?php echo $widthSUM;?>" border="0" cellspacing="0" cellpadding="0" height="3" >
			<tr>
			<td align="center"><img src="images/ip.gif">&nbsp;<font color="#888888"><b><?php echo _COUNT_START;?> <?php echo ThaiTimeConvert("".WEB_TIMESTART."","",""); ?></b>
			</td>
			</tr>

<script language="javascript"> 
<!-- 
var state = 'none'; 

function showhide(layer_ref) { 

if (state == 'block') { 
state = 'none'; 
} 
else { 
state = 'block'; 
} 
if (document.all) { //IS IE 4 or 5 (or 6 beta) 
eval( "document.all." + layer_ref + ".style.display = state"); 
} 
if (document.layers) { //IS NETSCAPE 4 or below 
document.layers[layer_ref].display = state; 
} 
if (document.getElementById &&!document.all) { 
hza = document.getElementById(layer_ref); 
hza.style.display = state; 
} 
} 
//--> 
</script> 

<?php 
$IPADDRESS=get_real_ip();

//include ("modules/useronline/counter.php");
$ct_ip = $IPADDRESS;
$ct_yyyy = date("Y") ;
$ct_mm = date("m") ;
$ct_dd = date("d") ;
$ct_time = time();
$time_delay = 600;
$timecheck = time()-$time_delay;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sqls = " select COUNT(ct_no) AS ct_count from ".TB_ACTIVEUSER." where ct_dd = '$ct_dd' AND ct_mm = '$ct_mm' AND ct_yyyy = '$ct_yyyy' AND ct_time >= '$timecheck' ";
$results = mysql_query($sqls);
$rows = mysql_fetch_array($results);
$stat_nows = $rows["ct_count"];	

?>
<center><table width="<?php echo $widthSUM;?>" align=center border="0" cellspacing="0" cellpadding="0" >
   <tr>
	<td width="<?php echo $widthSUM;?>" height="20" colspan=2 align=center><b><?php echo _COUNT_USER_ONLINE;?>&nbsp;<b><font color="#CC0000"><?php echo $stat_nows ?></font> IP <font color="#0066CC">
    </td></tr>
	<tr>
	<td>
<?php                          

include("modules/useronline/startconnect.php");

$ct_ip = $IPADDRESS;
$ct_yyyy = date("Y") ;
$ct_mm = date("m") ;
$ct_dd = date("d") ;
$ct_dd1 = date("d")-1 ;
$ct_time = time();
$timecheck = time()-$time_delay; // นับจำนวนเข้าชมขณะนี้ ในช่วงเวลา 15 นาที

$sql = " select COUNT(ct_no) AS ct_count from ".TB_ACTIVEUSER." where ct_dd = '$ct_dd' AND ct_mm = '$ct_mm' AND ct_yyyy = '$ct_yyyy' AND ct_time >= '$timecheck' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$stat_now = $row["ct_count"];		// แสดงสถิติเข้าชมคณะนี้

$sql = " select SUM(ct_count) AS ct_count from ".TB_ACTIVEUSER." where ct_dd = '$ct_dd' AND ct_mm = '$ct_mm' AND ct_yyyy = '$ct_yyyy' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$stat_dd = $row["ct_count"];		// แสดงสถิติวันนี้

$a_date = date("Y-m-d");
//$lastDate=date("Y-m-d", strtotime($a_date."-1 day"));
$lastdd=date("d",strtotime($a_date."-1 day"));
$lastmm=date("m",strtotime($a_date."-1 day"));
$lastyy=date("Y",strtotime($a_date."-1 day"));

$sql = " select SUM(ct_count) AS ct_count from ".TB_ACTIVEUSER." where ct_dd = '$lastdd' AND ct_mm = '$lastmm' AND ct_yyyy = '$lastyy' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$stat_dd1 = $row["ct_count"];		// แสดงสถิติเมื่อวานนี้ี้

$sql = " select SUM(ct_count) AS ct_count from ".TB_ACTIVEUSER." where ct_mm = '$ct_mm' AND ct_yyyy = '$ct_yyyy' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$stat_mm = $row["ct_count"];		// แสดงสถิติเดือนนี้

$sql = " select SUM(ct_count) AS ct_count from ".TB_ACTIVEUSER." where ct_yyyy = '$ct_yyyy' ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$stat_yyyy = $row["ct_count"];		// แสดงสถิติปีนี้

$sql = " select SUM(ct_count) AS ct_count from ".TB_ACTIVEUSER." ";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
$stat_all = $row["ct_count"];		// แสดงสถิติทั้งหมด




?>


  <table width="<?php echo $widthSUM;?>" cellpadding="0" cellspacing="0"  bgcolor="#F2F2F2">

<tr>
  <td>
  <div align="center">
  <table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
	<td  height="20"><img src="images/human.gif" border="0"> <?php echo _COUNT_ONLINE_NOW;?></td>
	<td ><div align="right"><?php echo $stat_now ?> <?php echo _COUNT_ONLINE_KON;?></div></td>
  </tr>
  <tr>
	<td height="20"><img src="images/group2.gif" border="0"> <?php echo _COUNT_ONLINE_DAY;?></td>
	<td><div align="right"><?php echo $stat_dd ?> <?php echo _COUNT_ONLINE_KON;?></div></td>
  </tr>
    <tr>
	<td height="20"><img src="images/group2.gif" border="0"> <?php echo _COUNT_ONLINE_YES;?></td>
	<td><div align="right"><?php echo $stat_dd1 ?> <?php echo _COUNT_ONLINE_KON;?></div></td>
  </tr>
  <tr>
	<td height="20"><img src="images/see.gif" border="0"> <?php echo _COUNT_ONLINE_MONTH;?></td>
	<td><div align="right"><?php echo $stat_mm ?> <?php echo _COUNT_ONLINE_KON;?></div></td>
  </tr>
  <tr>
	<td height="20"><img src="images/member2.gif" border="0"> <?php echo _COUNT_ONLINE_YEAR;?></td>
	<td><div align="right"><?php echo $stat_yyyy ?> <?php echo _COUNT_ONLINE_KON;?></div></td>
  </tr>
  <tr>
	<td height="20"><img src="images/group.gif" border="0"> <?php echo _COUNT_ONLINE_ALL;?></td>
	<td><div align="right"><?php echo $stat_all ?> <?php echo _COUNT_ONLINE_KON;?></div></td>
  </tr>
    <tr>
	<td width="<?php echo $widthSUM;?>" height="20" colspan=2 align=center colspan="2"><b><?php echo _COUNT_ONLINE_IP;?> <b><font color="#0066FF"><?php echo $IPADDRESS ?></font>
    </td></tr>
  </table>

  </div>
  </td>
 </tr>
</table>
<?php 
include("modules/useronline/endconnect.php");
?>

	</td>
	</tr>
	<tr>
	<td width="<?php echo $widthSUM;?>" height="20" colspan=2 align=center>
			<?php 
// URL of the folder where script is installed. INCLUDE a trailing "/" !!!
$base_url = ''.WEB_URL.'';
// Default image style (font)
$default_style = '57chevy';
// Default counter image extension
$default_ext = 'gif';
// Count UNIQUE visitors ONLY? 1 = YES, 0 = NO
$count_unique = 0;
// Number of hours a visitor is considered as "unique"
$unique_hours = 24;
// Minimum number of digits shown (zero-padding). Set to 0 to disable.
$min_digits =0;

#############################
#     DO NOT EDIT BELOW     #
#############################

/* Turn error notices off */
/* Get style and extension information */
$style      = $default_style;
$style_dir  = 'modules/useronline/styles/' . $style . '/';
$ext        = $default_ext;

		$pcount = "000000".$stat_all;
		$pcount = substr($pcount, -7);


    /* Is zero-padding enabled? */
    if ($min_digits > 0) {
        $pcount = sprintf('%0'.$min_digits.'s',$pcount);
    }

    /* Print out Javascript code and exit */
    $len = strlen($pcount);


    for ($i=0;$i<$len;$i++) {

 //       echo '<img src="'.$base_url . $style_dir . substr($pcount,$i,1) . '.' . $ext .'" border="0">';
 echo '<img src="'. $style_dir . substr($pcount,$i,1) . '.' . $ext .'" border="0">';
    }
//    exit();



/* This functin handles input parameters making sure nothing dangerous is passed in */
function input($in) {
    $out = htmlentities(stripslashes($in));
    $out = str_replace(array('/','\\'), '', $out);
    return $out;
}
?>
</td>
</tr>
	<tr>
	<td width="<?php echo $widthSUM;?>" height="20" colspan=2 align=center>
	<a href="#div2" onclick="showhide('div2');"><font color="#3366FF">(Show/hide IP)</font></a></td>
  </tr>
  </table>
<div id="div2" style="display: none;">
<table border="0" cellspacing="0" cellpadding="0" >
			<tr>
			<td align="center"><font color="#888888"><b><?php 

				include('modules/useronline/counter_show.php');?></b>
			</td>
			</tr>
			</table>

</div>



