	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_video.gif" BORDER="0"><BR>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>

				<TR>
					<TD>
					<A HREF="?name=video"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"><b><font color="#0033FF" size="2"> รายการ video หน้าหลัก</A> &nbsp;&nbsp;&nbsp;<? if($admin_user){?><A HREF="?name=admin&file=video&op=video_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> เพิ่ม video จากไฟล์</A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video_youtube"><IMG SRC="images/admin/7_40.gif"  BORDER="0" align="absmiddle"> เพิ่มไฟล์ video ใหม่จาก youtube </A>  &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video_category&op=videocat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> เพิ่มหมวดหมู่</A><?}?></font></td></tr>
									<TR>
					<TD height="1" class="dotline"></TD>
				</TR><td>
<?
//////////////////////////////////////////// แสดงรายการvideo 
if($op == ""){
	$limit = 10 ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$SUMPAGE = $db->num_rows(TB_VIDEO_CAT,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <table width="100%" cellspacing="2" cellpadding="1" >

<?
$count=0;
$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." ORDER BY id DESC LIMIT $goto, $limit ");
while($arr['video'] = $db->fetch($res['video'])){
	if ($count==0) { echo "<TR>"; }
	$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO." WHERE category='".$arr['video']['id']."' order by rand() limit 1");
	$arr['category'] = $db->fetch($res['category']);

?>
     <td width="30%" valign="top">
	 <table>
	 <tr>
	 <td width="<?=(_IVIDEOT_W)+45;?>" valign="top">
<table cellspacing=0 cellpadding=0 border=0 >
<tr>
<td  height=14 border=0 background= "images/border/TL.gif"></td>
<td  height=14 border=0 background="images/border/TT.gif"></td>
<td height=14  border=0 background= "images/border/TR.gif"></td></tr>
<tr><td   width=30 border=0 background= "images/border/LL.gif"></td>
<td  border=0>
<div class="photo">
<a href="?name=video&op=video_detail&id=<? echo $arr['video']['id'];?>"><span></span>
<img width="<?=_IVIDEOT_W;?>" src="<?if($arr['category']['pic']){ echo "video/thumbs/".$arr['category']['pic'].""; } else {  if ($arr['category']['youtube']==1){ echo "http://img.youtube.com/vi/".$arr['category']['video']."/default.jpg";}else{ echo "images/news_blank.gif";}}?>" width="<?=_IVIDEOT_W;?>" height="<?=_IVIDEOT_H;?>" />
</a><div></td>
<td width=14 border=0 background= "images/border/RR.gif"></td></tr>
<tr><td  height=15 border=0 background= images/border/BL.gif></td>
<td  height=15 border=0 background= "images/border/BB.gif"></td>
<td height=15 border=0 background= "images/border/BR.gif"></td></tr></table>
</td>
<td valign="top">
<font color="#990000"><b><a href="?name=video&op=video_detail&id=<? echo $arr['video']['id'];?>"><? echo $arr['video']['category_name'];?></b></font></a><?=NewsIcon(TIMESTAMP, $arr['video']['post_date'], "images/icon_new.gif");?> ( <?echo ThaiTimeConvert($arr['video']['post_date'],'','');?> ) <? if($admin_user){?><a href="?name=admin&file=video_category&op=videocat_edit&id=<? echo $arr['video']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="แก้ไข" ></a> 
      <a href="javascript:Confirm('?name=admin&file=video_category&op=videocat_del&id=<? echo $arr['video']['id'];?>&pic=<? echo $arr['video']['pic'];?>&prefix=<? echo $arr['video']['post_date'];?>','คุณมั่นใจในการลบหัวข้อนี้ ?');"><img src="images/admin/trash.gif"  border="0" alt="ลบ" ></a><?}?><br>&nbsp;&nbsp;&nbsp;&nbsp;<? echo $arr['video']['category_detail'];?>
</td>
</tr>
</table>
</td>

<?
$count++;
//if (($count%_videoCAT_COL) == 0) { echo "</TR><TR><TD colspan=3 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
 //else{
	//echo "</TD>";
//} 
echo "</TR><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>";
}
?>

 </table>
<?
	SplitPage($page,$totalpage,"?name=video");
	echo "$ShowSumPages [จำนวน $SUMPAGE อัลบัม]";
	echo "<BR>";
	echo $ShowPages ;
?><br>
 <table width="100%" cellspacing="0" cellpadding="0" border="0" class="tablex">
 <tr>
<TD width="100%" >
<B><FONT COLOR="#CC0000" >10 video ล่าสุด</B></FONT>
</td>
<tr>
<TD width="100%"><FONT COLOR="#990099" >
<hr>
<?
//แสดง video  10 อันดับล่าสุดของหมวดหมู่ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['cat_video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." ORDER BY id DESC LIMIT 10 ");
$rows['cat_video'] = $db->rows($res['cat_video']); 
if(!$rows['cat_video']){
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ไม่มีรายการ video  ";
}
while($arr['cat_video'] = $db->fetch($res['cat_video'])){
?>
					<IMG SRC="images/icon/suggest.gif" BORDER="0" ALIGN="absmiddle"> <B><A HREF="?name=video&file=readvideo&id=<?=$arr['cat_video']['id'];?>" target="_blank"><?=$arr['cat_video']['topic'];?></A></B> <?= ThaiTimeConvert($arr['cat_video']['post_date'],"","");?><BR>
<?
}
$db->closedb ();
?>

					</TD>
				</TR>
				</table>
<?

}

else if($_GET['op'] == "video_detail"){
	//////////////////////////////////////////// ดูรายละเีอียดใน video
if($_GET['id']){
	$SQLwhere = " where id='".$_GET['id']."' ";
	$SQLwhere2 = " WHERE category='".$_GET['id']."' ";
}

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 15 ;
	$SUMPAGE = $db->num_rows(TB_VIDEO,"id"," category=".$_GET['id']."");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
	$res['cat'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT."  WHERE id='".$_GET['id']."' ");
$arr['cat'] = $db->fetch($res['cat']);
$CAT=$arr['cat']['post_date'];

?>
 <table width="100%" cellspacing="2" cellpadding="1" >
<tr>
<td bgcolor="#F7F7F7" colspan="<?=_VIDEO_COL;?>"><font color="#990000" size="4"><b> >> <? echo $arr['cat']['category_name'];?></b></font></a>  <?=NewsIcon(TIMESTAMP, $arr['cat']['post_date'], "images/icon_new.gif");?> ( <?echo ThaiTimeConvert($arr['cat']['post_date'],'','');?> )  <br></font><font size="2"><? echo $arr['cat']['category_detail'];?>
</font></td>
</tr>
<tr>
<td colspan="<?=_VIDEO_COL;?>">&nbsp;&nbsp;<td>
</tr>

<?

$count=0;
$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." WHERE category='".$arr['cat']['id']."' ORDER BY id DESC LIMIT $goto, $limit");
while($arr['video'] = $db->fetch($res['video'])){
	if ($count==0) { echo "<TR>"; }
?>
     <td valign="top" align="center">
	 <table cellpadding="0" cellspacing="0" border="0" id="Table_01" >
	 <tr>
	 <td width="<?=_IVIDEOT_W;?>" colspan="2" >
	 			<table cellspacing=0 cellpadding=0 border=0 class='iconframe'>
				<tr>
				<td  border=0  align="center" >
				<div class="photo">
				<a HREF="index.php?name=video&file=readvideo&id=<?=$arr['video']['id'];?>" ><span></span><img src="<?if ($arr['video']['pic']){echo "video/thumbs/".$arr['video']['pic'].""; } else { if ($arr['video']['youtube']==1){ echo "http://img.youtube.com/vi/".$arr['video']['video']."/default.jpg";}else{ echo "images/news_blank.gif";}}?>" width="<?=_IVIDEOT_W;?>" height="<?=_IVIDEOT_H;?>"></a>
				</div>
				</td>
				<td class='shadow_right'><div class='shadow_top_right'></div></td>
</tr>
<tr>
  <td class='shadow_bottom'><div class='shadow_bottom_left'></div></td>
  <td class='shadow_bottom_right'></td>
  </tr>
<tr>
<td align="right">
<a HREF="index.php?name=video&file=readvideo&id=<?=$arr['video']['id'];?>" ><img src="images/icon-view.gif" border="0"></a> <? if($admin_user){?><a href="javascript:Confirm('?name=admin&file=video&op=video_del&cat=<? echo $CAT;?>&id=<? echo $arr['video']['id'];?>&pic=<? echo $arr['video']['pic'];?>&cats=<? echo $arr['cat']['id'];?>&prefix=<? echo $arr['video']['post_date'];?>','คุณมั่นใจในการลบหัวข้อนี้ ?');"><img src="images/admin/trash.gif"  border="0" alt="ลบ" ></a><?}?>
</td>
</tr>
<tr>
<td align="left">โดย <?=$arr['video']['posted'];?> (VIEW : <?=$arr['video']['pageview'];?>)<?=NewsIcon(TIMESTAMP, $arr['video']['post_date'], "images/icon_new.gif");?>
</td>
</tr>
  </table>

</td>
</tr>

</table>
</td>
<?
$count++;
if (($count%_VIDEO_COL) == 0) { echo "</TR><TR><TD colspan=5 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
 
}
echo "</table>";
?>

<?
	SplitPage($page,$totalpage,"?name=video&op=video_detail&id=".$_GET['id']."");
	echo "$ShowSumPages [จำนวน $SUMPAGE video]";
	echo "<BR>";
	echo $ShowPages ;


}
?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
