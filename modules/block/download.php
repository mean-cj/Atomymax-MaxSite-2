<TABLE width="<?=$widthSUMC;?>" align=center cellSpacing=0 cellPadding=0 border=0 >
<tr>
<td>
 <table width="100%" cellspacing="0" cellpadding="5" >
  <tr >
	<td>
	 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
		
  <?

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 10;

$res['download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." where status='1' ORDER BY id DESC LIMIT $limit ");
$count=0;

while($arr['download'] = $db->fetch($res['download'])){
//	if ($count==0) { echo "<TR>"; }
 
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = 'class="odd"';
} else {
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
}
echo "<TR ".$ColorFill.">";
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT category_name FROM ".TB_DOWNLOAD_CAT." WHERE id='".$arr['download']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$downloadid=$arr['download']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(id) as com FROM ".TB_DOWNLOAD_COMMENT." WHERE id ='".$downloadid."' group by id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>
												<TD width="100%"  align="left">	
															<IMG SRC="images/admin/open.gif" BORDER="0" ALIGN="absmiddle"><A HREF="?name=download&file=readdownload&id=<?=$arr['download']['id'];?>" ><font color="#990066"><B>[ <?= ThaiTimeConvert($arr['download']['post_date'],"","");?> ] </font><font color="#0066FF"><?=$arr['download']['topic'];?></A></font></B>
					<?=NewsIcon(TIMESTAMP, $arr['download']['post_date'], "images/icon_new.gif");?>(<?=_FORM_MOD_READX;?> : <?=$arr['download']['pageview'];?> / <?=_DOWNLOAD_NUM;?> <?=$arr['download']['rate'];?> ) <?=_DOWNLOAD_AUTH;?> <?=$arr['download']['posted'];?> 
													</TD>

<?
$count++;

echo "</TR>";
}
?>
</table>
													<td>
													</tr>
													<tr>
													<td align="right"><A HREF="index.php?name=download" ><img src="images/admin/2_15.gif"></a></td>
													</tr>
													</table>
													</td>
													</tr>
													</table>



