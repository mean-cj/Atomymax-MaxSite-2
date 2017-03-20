				<TABLE  width="<?=$widthSUM-10;?>" border=0 cellSpacing=0 cellPadding=5 border=0>
				<TR>
				<td>
				<TABLE  width="<?=$widthSUM-10;?>" align=left cellSpacing=0 cellPadding=0 border=0 class="grids">
				<TR class="odd">
					<TD align="center" width="<?=$widthSUM-10;?>" colspan="2"><b><?=_BLOG_STA_TEN;?></font></td>
					</tr>
					<?
					$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$count=0;
					$res['cblog'] = $db->select_query("SELECT *,count(id) as co FROM ".TB_BLOG." group by posted order by co  desc limit 10");
					while ($arr['cblog'] = $db->fetch($res['cblog'])){		
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
//		$bgc = ($bgc==$rowColor1) ? $rowColor2 : $rowColor1; 
echo "<tr ".$ColorFill.">";
					?>
					<TD  align="left" width="75%"><img src="images/go.gif"> <a href="index.php?name=blog&file=blogdetail&user=<?=$arr['cblog']['posted'];?>"><?=$arr['cblog']['posted'];?></a><br> <?BlogLevel($arr['cblog']['co']);?></td><TD align="center" width="25%" valign="top"><?=$arr['cblog']['co'];?></td></tr>
<?
					$count++;
					}
				?>

				</table>
	</td></tr>
	<tr><td>
					<TABLE  width="<?=$widthSUM-10;?>" align=left cellSpacing=0 cellPadding=0 border=0 class="grids">
				<TR class="odd">
					<TD  align="center" width="75%"><b><?=_BLOG_STA_LAST;?></font></td><TD align="center" width="25%"><b><?=_FORM_MOD_POSTED;?></font></td>
					</tr>
					<?
					$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$count=0;
					$res['blog'] = $db->select_query("SELECT *  FROM ".TB_BLOG." order by id desc limit 10");
					while ($arr['blog'] = $db->fetch($res['blog'])){		
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
//		$bgc = ($bgc==$rowColor1) ? $rowColor2 : $rowColor1; 
echo "<tr ".$ColorFill.">";
					?>

				<TD  align="left" width="75%"><img src="images/a.gif"><a href="index.php?name=blog&file=readblog&id=<?=$arr['blog']['id'];?>"><?=$arr['blog']['topic'];?></a><?NewsIcon(TIMESTAMP, $arr['blog']['post_date'], "images/icon_new.gif");?></td><TD align="center" width="25%" valign="top"><a href="index.php?name=blog&file=blogdetail&user=<?=$arr['blog']['posted'];?>"><?=$arr['blog']['posted'];?></a></td></tr>
<?
										$count++;
					}
				?>

				</table>
</td>
</tr>
</table>

