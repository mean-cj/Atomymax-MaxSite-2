<?
//แรียก user online ทั้งหมด
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user2'] = $db->select_query("SELECT * FROM ".TB_useronline." ");			
			$rows['user2'] = $db->rows($res['user2']);
//ดึง user online จกา table TB_user
	//		while($arr['user2'] = $db->fetch($res['user2'])){	
			$arr['user2'] = $db->fetch($res['user2']);		
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$arr['user2']['useronline']."' ");		
			$arr['user'] = $db->fetch($res['user'])	;
			if ($admin_user<>"" || $login_true<>"" ){
			?>
<html>
<head>

<script language="Javascript" type="text/javascript">
var counter=10
function countdown() {
  if (counter==0) {
    document.getElementById("download").value="Download Now"
    document.getElementById("download").disabled=""
  } else {
    document.getElementById("download").value="<?echo _DOWNLOAD_MOD_RATE_WAIT;?>"+counter
    document.getElementById("download").disabled="disabled"
    counter--
    setTimeout("countdown()", 1000)
  }
}
countdown()
</script>
<script> 
var statusmsg=""

function hidestatus(){
window.status=statusmsg
return true
}

</script>
</head>
<body onLoad="countdown('10')">
<link href="templates/<?=WEB_TEMPLATES;?>/css/style.css" rel="stylesheet" type="text/css">
	<TABLE cellSpacing=0 cellPadding=0 width=500 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="490" vAlign=top>
		  <!-- download -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_user.gif" BORDER="0"><BR><BR>
				<TABLE width="490" align=center cellSpacing=0 cellPadding=0 border=0>
<?
$_GET['id'] = intval($_GET['id']);
//แสดงข่าวสาร/ประชาสัมพันธ์ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." WHERE id='".$_GET['id']."' ");
$arr['download'] = $db->fetch($res['download']);
$db->closedb ();
if(!$arr['download']['id']){
	echo "<BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>ไม่มีรายการ download </B></CENTER><BR><BR><BR><BR>";
}
?>
				<TR>
					<TD height="1" class="dotline" ></TD>
				</TR>
				<TR>
					<TD align=center width="80%" ><br>
					<?
					 if($arr['download']['full_text']){ 	  
?>
<h5><img src="images/header.gif"><br><?=_DOWNLOAD_MOD_RATE_ATT;?></h5>
<? }

  
  $file=$arr['download']['full_text'];
  $wb_picture="data/download_".$file.""; //ไฟล์ที่ต้องการดาวน์โหลด
  //จบ อ่านไฟล์ที่ต้องการดาวน์โหลด
  

?>

<table id=maintable border=0 cellpadding=0 cellspacing=0 align=center width=100% height=100%><tr><td align=center>
<?
//  echo "คอยสักครู่ ถ้าการดาวน์โหลดไม่เริ่มต้นคลิก <a href=$wb_picture>ที่นี่</a> ";
  echo ""._DOWNLOAD_MOD_RATE_THANK." ".WEB_EMAIL."";
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$q['Pageview'] = "UPDATE ".TB_DOWNLOAD." SET rate = rate+1 WHERE id = '".$_GET['id']."' ";
	$sql['Pageview'] = mysql_query ( $q['Pageview'] ) or sql_error ( "db-query",mysql_error() );
		$db->closedb ();

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." WHERE id='".$_GET['id']."' ");
$arr['download'] = $db->fetch($res['download']);
$db->closedb ();
$rate=$arr['download']['rate'];
  //บันทึกจำนวนการดาวน์โหลดลงไฟล์
  $count=$rate;
  $downloads=file("download.dat"); //อ่านข้อมูลจากไฟล์ลงบน array (เป็นบรรทัด)
  $f=fopen ("download.dat", "w"); //เปิดไฟล์เพื่อเขียน
  for ($i=0; $i<count($downloads); $i++) {
    $data=explode("|", trim($downloads[$i]));
    if ($data[0]==$file) {
      $count=$data[1];
      $count++;
    } else fwrite($f, "".$data[0]."|".$data[1]." ");
  }
  fwrite($f, "$file|$count ");
  fclose($f);
  //จบ บันทึกจำนวนการดาวน์โหลดลงไฟล์

  
  //แสดงผล จำนวนการดาวน์โหลด
  echo "<table border=0 cellspacing=2 cellpadding=2 align=center> ";
  echo "<tr> ";
  echo "<td align=center bgcolor=#5083F9><font color=white size=1>"._DOWNLOAD_MOD_RATE_NUM."</font></td> ";
  echo "<td align=center bgcolor=#D5D8F9><font size=1>".substr("0000$count", -4)."</font></td> ";
  echo "</tr> ";
  echo "</table> ";
  
 // echo "<br /><br /><br />[ <a href=\"javascript:window.close();\"> ปิดหน้านี้</a> ]";

?>
<!--<center><input type="button" onclick="window.open('<?=WEB_URL."/".$wb_picture;?>')" id="download" onMouseover="return hidestatus()"></center>-->
<center><input type="button" onclick="window.open('<?=WEB_URL."/".$wb_picture;?>')" id="download" ></center>
<!--ดาวน์โหลด ภายใน 2 วินาที-->

<!--<META HTTP-EQUIV=refresh CONTENT="10; URL=<?=$wb_picture?>">-->

<!--ปิดหน้านี้ ภายใน 10 วินาที-->
<script language=JavaScript>
setTimeout('CloseThisWindow()', 10000)
function CloseThisWindow() {
  window.close()
}
</script>
</td></tr></table>


					</TD>
									<TR>
					<TD height="1" class="dotline" ></TD>
				</TR>
				</table>

				</td>
				</tr>
				</table>
</body>
</html>
<?
} else {
include 'modules/user/danger.php';
}
?>