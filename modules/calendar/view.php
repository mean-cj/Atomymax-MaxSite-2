<link href="templates/<?=WEB_TEMPLATES;?>/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/datepicker.js"></script>
<script type="text/javascript" src="js/java.js"></script>
<TABLE width="100%" align=center cellSpacing=5 cellPadding=0 border=0>
<?
$_GET['id'] = intval($_GET['id']);
//$_GET['dates'] = intval($_GET['dates']);
$datess=$_GET['dates'];
//แสดงปฏิทิน
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['event'] = $db->select_query("SELECT id, date_event, timeout , subject, detail ,post_date, pageview , UNIX_TIMESTAMP(date_event) AS date_event2  FROM ".TB_CALENDAR." WHERE date_event='".$_GET['dates']."' ");
$arr['event'] = $db->fetch($res['event']);

$db->closedb ();
if(!$arr['event']['date_event']){
	echo "<BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>ไม่มีรายการปฏิทินกิจกรรมในวัน $datess </B></CENTER><BR><BR><BR><BR>";
}else{
//	$FileEventTopic = "calendardata/".$arr['event']['date_event'].".txt";
//	$file_open = @fopen($FileEventTopic, "r");
//	$content = @fread ($file_open, @filesize($FileEventTopic));
//	$Detail = stripslashes(FixQuotes($content));
	$Detail = $arr['event']['detail'];
	$ID=$arr['event']['id'];
	//ทำการเพิ่มจำนวนคนเข้าชม
	?>
					<TR>
					<TD>
					<B><IMG SRC="images/icon/calendar.gif" WIDTH="16" HEIGHT="15" BORDER="0" ALIGN="absmiddle"> <FONT COLOR="#990000"><?= ThaiTimeConvert($arr['event']['date_event2'],"1","");?></FONT><BR><BR>
					</TD>
				</TR>
				<?

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['events'] = $db->select_query("SELECT id, date_event, timeout , subject, detail ,post_date, pageview , UNIX_TIMESTAMP(date_event) AS date_event2  FROM ".TB_CALENDAR." WHERE date_event ='".$_GET['dates']."' ");
//$arr['event'] = $db->fetch($res['event']);
while($arr['events'] = $db->fetch($res['events'])){
$Detail = $arr['events']['detail'];
$id=$arr['events']['id'];

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$q['Pageview'] = "UPDATE ".TB_CALENDAR." SET pageview = pageview+1 WHERE id = '".$id."' ";
	$sql['Pageview'] = mysql_query ( $q['Pageview'] ) or sql_error ( "db-query",mysql_error() );


?>
					<TR>
					<TD bgcolor="#F9F9F9">
					<B><IMG SRC="images/admin/tv2.gif" WIDTH="11" HEIGHT="14" BORDER="0" ALIGN="absmiddle" ><?=$arr['events']['subject'];?></B><BR>
					<BR>
					</TD>
				</TR>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD ><b><?=_CAL_ACTIVIT_DETAIL;?> <? if ($arr['events']['timeout']<>'') { echo "<font color=\"#CC0000\">( "._CAL_DATE_START." ".$arr['events']['timeout']." )</font>";}?></b>
					<BR>
					<font color="#006699"><b><?=$arr['events']['detail'];?></font>
					<BR>
					<?=_DETAIL_PRIVIEW;?> <font color="#CC0000"><?=$arr['events']['pageview'];?>&nbsp;&nbsp;<B></font><?=_CAL_POSTED_DATE;?> <font color="#cc0000"></B><?= ThaiTimeConvert($arr['events']['post_date'],"1","");?>
					
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  <a href="?name=admin&file=editevent&id=<? echo $arr['events']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
				  <a href="javascript:Confirm('?name=admin&file=delevent&id=<? echo $arr['events']['id'];?>&op=calendar_del','<?echo _FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
<?
}
?>	
					</TD>
				</TR>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>&nbsp;&nbsp;</TD>
				</TR>
<?
}
?>
<?
}
?>

			</TABLE>