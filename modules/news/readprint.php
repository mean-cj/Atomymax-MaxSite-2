<script type="text/javascript">
function showemotion() {
	emotion1.style.display = 'none';
	emotion2.style.display = '';
}
function closeemotion() {
	emotion1.style.display = '';
	emotion2.style.display = 'none';
}

function emoticon(theSmilie) {

	document.form2.COMMENT.value += ' ' + theSmilie + ' ';
	document.form2.COMMENT.focus();
}
</script>
<? OpenTablecom();?>
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0 >
<?
$_GET['id'] = intval($_GET['id']);
//แสดงข่าวสาร/ประชาสัมพันธ์ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE id='".$_GET['id']."' ");
$arr['news'] = $db->fetch($res['news']);
$db->closedb ();
if(!$arr['news']['id']){
	echo "<tr><td><BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>"._NEWS_MOD_NOID."</B></CENTER><BR><BR></td></tr></table><BR><BR>";
}else{

	$thepage = $arr['news']['detail'];
	$Detail = stripslashes(FixQuotes($thepage));
	//ทำการเพิ่มจำนวนคนเข้าชม
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$q['Pageview'] = "UPDATE ".TB_NEWS." SET pageview = pageview+1 WHERE id = '".$_GET['id']."' ";
	$sql['Pageview'] = mysql_query ( $q['Pageview'] ) or sql_error ( "db-query",mysql_error() );
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." WHERE id='".$arr['news']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$db->closedb ();
?>
<tr>
<td>
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0 background="images/bread.jpg" height=171>
				<tr>
				<td colspan="3"><B><FONT COLOR="#990000">&nbsp;&nbsp;<?=_FORM_CAT;?> <FONT COLOR="#0066FF"><?=$arr['category']['category_name'];?>
				</td>
				</tr>
				<TR>
					<TD valign="top" >
					<?if ($arr['news']['pic']==1){echo "<img  src=icon/news_".$arr['news']['post_date'].".jpg class=mysborder border=0 align=left>";} else {echo "<img class=mysborder src=images/icon/".$arr['category']['icon']." border=0 align=left>";} ?>
					</td>
					<td valign="top">

					<table cellSpacing=0 cellPadding=0 border=0>
					<tr>
					<td valign="top" width="100%">
					<B><FONT COLOR="#3333FF"><?=_FORM_TOPIC;?> </font><FONT COLOR="#990000"><?=$arr['news']['topic'];?></FONT>
<?=NewsIcon(TIMESTAMP, $arr['news']['post_date'], "images/icon_new.gif");?></td>
					</tr>
					<tr>
					<td><?=_FORM_MOD_POSTEDX;?> <?=$arr['news']['posted'];?></B>

					</td>
					</tr>
					<tr>
					<td><?=_FORM_MOD_READ;?> <?=$arr['news']['pageview'];?>
					</td>
					</tr>
					<tr>
					<td>
					<?= ThaiTimeConvert($arr['news']['post_date'],"1","");?>
					
					<?
					if($arr['news']['attach']){
					?>
					<a href="attach/news_<? echo $arr['news']['attach'];?>"><font color="#0066CC"><b>[ <?=_FORM_MOD_DOWLOAD_ATT;?> ]</a>
					<?}?>
					</td>
					</tr>
					</table>
				</td>
				<td valign="top" align="right" width="20"><a href="#" onclick="window.print();return false;"><img src="images/printButton.png" alt="<?=_FORM_BUTTON_PRINT;?>"  /></a>&nbsp;
				</td>
			</tr>
			</table>


					</TD>
				</TR>
				<TR>
					<TD colspan="3">
					<BR>
					<?=breakpage($mod,$page,$id,$thepage);?>
					<BR><BR>
					</TD>
				</TR>
</table>
<?
}
?>
<?CloseTablecom();?>
