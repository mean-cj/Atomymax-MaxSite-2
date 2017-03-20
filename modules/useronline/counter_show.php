<?                          

// กำหนดชื่อเซิร์ฟเวอร์ , ชื่อฐานข้อมูล , ชื่อผู้ใช้งาน  และ รหัสผ่าน สำหรับติดต่อกับฐานข้อมูล
$ServerName = "".DB_HOST."";
$DatabaseName = "".DB_NAME."";
$User = "".DB_USERNAME."";
$Password = "".DB_PASSWORD."";

$startdate = "".WEB_TIMESTART.""; // วันที่เริ่มต้นนับจำนวนสมาชิก
$time_delay = 600; // นับจำนวนเข้าชมขณะนี้ ในช่วงเวลา 10 นาที ( 600 วินาที )
$IPADDRESS=get_real_ip();	

function ip2int($ips) {
   if(preg_match('/^\\D*(\\d+)\\D(\\d+)\\D(\\d+)\\D(\\d+)\\D*$/', $ips, $array)) {
     return (16777216 * $array[1] + 65536 * $array[2] + 256 * $array[3] + 1 * $array[4]);
   } else {
     return (0);
   }
}
$ct_ip = $IPADDRESS;
$ct_yyyy = date("Y") ;
$ct_mm = date("m") ;
$ct_dd = date("d") ;
$ct_time = time();
$timecheck = time()-$time_delay; // นับจำนวนเข้าชมขณะนี้ ในช่วงเวลา 15 นาที

?>

  <table border="0" cellpadding="0" cellspacing="0" width="185">
  
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql = " select * from ".TB_ACTIVEUSER." where ct_dd = '$ct_dd' AND ct_mm = '$ct_mm' AND ct_yyyy = '$ct_yyyy' AND ct_time >= '$timecheck' ";
$result = mysql_query($sql);
//$row = mysql_fetch_array($result);
//$stat_now = $row["ct_count"];	
	while($row = mysql_fetch_array($result)){
		$ipss=$row["ct_ip"];
		$tm=$row["ct_time"];
     list($a, $b, $c, $d) = explode('.', $ipss); 
//$ipxx=ip2int($ipss);
//$sqlx = " select * from ".TB_IP." where ".$ipxx." between IP_FROM and IP_TO ";
//$resultx = mysql_query($sqlx);
//$rowx = mysql_fetch_array($resultx);
//$IPSS=$rowx['COUNTRY_CODE2'];

		?>
<tr>
	<td width="105" height="20" bgcolor="#FBF7E1"><?//echo preg_replace('/([0-9]+\.[0-9]+)\.[0-9]+\.[0-9]+/', '\1<span style="color:red">.xxx.xxx</span>', $ipss); 
//	echo "$IPSS $a.$b.$c<span style=\"color:red\">.xxx";
echo "$a.$b.$c<span style=\"color:red\">.xxx";?></td><td width="95" bgcolor="#FBF7E1"><div align="right"><?=ThaiTimeConvert("$tm",""); ?></div></td>  </tr>
	<?
}
?>

  </table>

