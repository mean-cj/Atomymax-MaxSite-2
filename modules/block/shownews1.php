<center><table class='iconframe' cellpadding='0' cellspacing='0' width="<?=$widthCU;?>" border="0">
<tbody>
<tr>
<td class='iconframe' width="<?=$widthCU;?>">
<?OpenTablemod();?>
<img src="templates/<?echo WEB_TEMPLATES;?>/images/menu/<?echo WEB_TEMPLATES;?>_news1.png" border="0"><br>

<TABLE width="<?=$widthCU-20;?>" cellSpacing=0 cellPadding=0 border=0>

  <?
//echo $widthSUMC;
empty($_GET['category'])?$category="1":$category=$_GET['category'];
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
$ColorFill = "#FDEAFB";
} else {
$ColorFill = "#F0F0F0";
}
echo "<TR onmouseover=\"this.style.backgroundColor='#FFF0DF'\" onmouseout=\"this.style.backgroundColor='#FFFFFF'\">"; 



	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT category_name FROM ".TB_NEWS_CAT." WHERE id='".$arr['news']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$newsid=$arr['news']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(news_id) as com FROM ".TB_NEWS_COMMENT." WHERE news_id ='".$newsid."' group by news_id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>

												<TD valign=top height="20" align="left" >
												<div class="">
															<IMG SRC="images/17.png" BORDER="0" ALIGN="absmiddle">
															<A HREF="<? WEB_URL;?>index.php?name=news&file=readnews&id=<?=$arr['news']['id'];?>" target="_blank" name="<?=$arr['news']['topic'];?>" ><font color="#990066"><B>[ <?= ThaiTimeConvert($arr['news']['post_date'],"","");?> ] </font><?=$arr['news']['topic'];?></A></B>
					<?=NewsIcon(TIMESTAMP, $arr['news']['post_date'], "images/icon_new.gif");?>( <?=$arr['news']['pageview'];?> / <?=$arrs['com']['com'];?> ) <?=_DOWNLOAD_AUTH;?> <?=$arr['news']['posted'];?> 
												</div>
													</TD></tr>

<?
$count++;
}
$db->closedb ();

?>
													<tr>
													<td colspan="2" align="right" ><A HREF="index.php?name=news&category=<?=$category;?>" ><img src="images/admin/2_15.gif"></a>
													</td>
													</tr>
</table>
<?CloseTablemod();?>
</td>
</tr>
</table>
