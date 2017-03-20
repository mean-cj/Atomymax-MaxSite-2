<?header("content-type: application/x-javascript; charset=tis-620");?>

	<TABLE cellSpacing=0 cellPadding=0  border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD  vAlign=top>
				<TABLE  align=center cellSpacing=0 width="400" cellPadding=0 border=0>
<?
$_GET['id'] = intval($_GET['id']);
//แสดงข่าวสาร/ประชาสัมพันธ์ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE id='".$_GET['id']."' ");
$arr['news'] = $db->fetch($res['news']);

if(!$arr['news']['id']){
	echo "<BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>ไม่มีรายการข่าวสาร/ประชาสัมพันธ์นี้</B></CENTER><BR><BR><BR><BR>";
}else{

	$content = $arr['news']['detail'];
	$Detail = stripslashes(FixQuotes($content));
	//ทำการเพิ่มจำนวนคนเข้าชม
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." WHERE id='".$arr['news']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);

?>

				<tr>
				<td><B><FONT COLOR="#990000"><h5><?=_FORM_CAT;?> <FONT COLOR="#0066FF"><?=$arr['category']['category_name'];?></h>
				</td>
				</tr>
				<TR>
					<TD valign="top">

					<table>
					<tr>
					<td valign="top" >
					<?if ($arr['news']['pic']==1){echo "<img  src=icon/news_".$arr['news']['post_date'].".jpg class=mysborder border=0 align=left>";} else {echo "<img class=mysborder src=images/icon/".$arr['category']['icon']." border=0 align=left>";} ?>
					</td>
					<td>

					<table>
					<tr>
					<td valign="top" bgcolor="#F5F5F5"><B><FONT COLOR="#3333FF"><h5><?=_FORM_TOPIC;?> </font><FONT COLOR="#990000"><?=$arr['news']['topic'];?></FONT>
					</td>
					</tr>
					<tr>
					<td bgcolor="#F5F5F5">	<?=_FORM_MOD_POSTEDX;?> <?=$arr['news']['posted'];?></B>
					</td>
					</tr>
					<tr>
					<td bgcolor="#F5F5F5"><?=_FORM_MOD_READ;?> <?=$arr['news']['pageview'];?>
					</td>
					</tr>
					<tr>
					<td bgcolor="#F5F5F5">
					<?= ThaiTimeConvert($arr['news']['post_date'],"1","");?>
										
</td>
					</tr>
					</table></td></tr>
</table>

					</TD>
				</TR>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR>
					<?=$arr['news']['headline'];?>
					<BR><BR>
					</TD>
				</TR>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>


<?
			$count  ++;
	}


?>
</table>
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
	