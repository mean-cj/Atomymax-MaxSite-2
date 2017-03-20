										<table width="<?=$widthSUMC;?>" cellpadding='0' cellspacing='0' >
										<tbody>
										<tr>
										<td >
										<table width="100%" cellpadding='5' cellspacing='0' border=0>
										<tr>
										<td >
  													<TABLE width="100%" align=center cellSpacing=0 cellPadding=0 border=0  class="grids">
  <?

empty($_GET['category'])?$category="3":$category=$_GET['category'];
//$_GET['category']=1;
if(!empty($category)){
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " WHERE category='".$category."' ";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 10;


$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." $SQLwhere2 ORDER BY id DESC LIMIT $limit ");
$count=0;

while($arr['news'] = $db->fetch($res['news'])){
//	if ($count==0) { echo "<TR>"; }
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = 'class="odd"';
} else {
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
}
echo "<TR ".$ColorFill.">";
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT category_name FROM ".TB_NEWS_CAT." WHERE id='".$arr['news']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$newsid=$arr['news']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(news_id) as com FROM ".TB_NEWS_COMMENT." WHERE news_id ='".$newsid."' group by news_id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>
												<TD  width="100%" align="left">	
															<IMG SRC="images/icon_folder.gif" BORDER="0" ALIGN="absmiddle">
															<A HREF="?name=news&file=readnews&id=<?=$arr['news']['id'];?>" target="_blank" ><font color="#990066"><B>[ <?= ThaiTimeConvert($arr['news']['post_date'],"","");?> ] </font><font color="#0066FF"><?=$arr['news']['topic'];?></A></font></B>
					<?=NewsIcon(TIMESTAMP, $arr['news']['post_date'], "images/icon_new.gif");?>( <?=$arr['news']['pageview'];?> / <?=$arrs['com']['com'];?> ) <?=_DOWNLOAD_AUTH;?> <?=$arr['news']['posted'];?> 
													</TD></tr>

<?
$count++;

}
$db->closedb ();

?>
</table>
													<td>
													</tr>
													<tr>
													<td align="right"><A HREF="index.php?name=news&category=<?=$category;?>" ><img src="images/admin/2_15.gif"></a></td>
													</tr>
													</table>
</td>
													</tr>
													</table>
