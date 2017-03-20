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
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0>
<?

$_GET['id'] = intval($_GET['id']);

//แสดงสาระน่ารู้ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE id='".$_GET['id']."' ");
$arr['blog'] = $db->fetch($res['blog']);
$db->closedb ();
if(!$arr['blog']['id']){
	echo "<tr><td><BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>"._BLOG_MOD_NOID."</B></CENTER><BR><BR><BR><BR></td></tr></table>";
}else{
		$TextContent = $arr['blog']['detail'];
		$TextContent = stripslashes($TextContent);
		$HEADLINE = $arr['blog']['headline'];
		$HEADLINE= stripslashes($HEADLINE);
	//ทำการเพิ่มจำนวนคนเข้าชม
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$q['Pageview'] = "UPDATE ".TB_BLOG." SET pageview = pageview+1 WHERE id = '".$_GET['id']."' ";
	$sql['Pageview'] = mysql_query ( $q['Pageview'] ) or sql_error ( "db-query",mysql_error() );
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_BLOG_CAT." WHERE id='".$arr['blog']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$res['cblog'] = $db->select_query("SELECT *,count(id) as co FROM ".TB_BLOG." WHERE posted='".$login_true."' group by posted");
	$arr['cblog'] = $db->fetch($res['cblog']);	
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
					<TD valign="top">
					<? if($arr['blog']['pic']){ echo "<img src=\"icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg\"></td>";
					} else {
					echo "<img src=\"images/icon/".$arr['category']['icon']."\"></td>";
					}
					?>
					</td>

					<td valign="top">
					<table cellSpacing=0 cellPadding=0 border=0>
					<tr>
					<td valign="top" width="100%">
					<B><FONT COLOR="#3333FF"><?=_BLOG_MOD_NUMX;?> </font><FONT COLOR="#990000"><?=$arr['blog']['topic'];?></FONT><?=NewsIcon(TIMESTAMP, $arr['blog']['post_date'], "images/icon_new.gif");?></td></tr>
					<tr>
					<td>
					<b><FONT COLOR="#3333FF"><?=_BLOG_NAME;?> </font><FONT COLOR="#FF0000"><?=$arr['blog']['posted'];?></FONT>
					</td>
					</tr>
					<tr>
					<td>
					<b><FONT COLOR="#3333FF"><?=_BLOG_LEVEL;?> </font><FONT COLOR="#FF0000"><?BlogLevel($arr['cblog']['co']);?></FONT>
					</td>
					</tr>
					<tr>
					<td><?=_FORM_MOD_READ;?> <?=$arr['blog']['pageview'];?>
					</td>
					</tr>
					<tr>
					<td>
					<?= ThaiTimeConvert($arr['blog']['post_date'],"1","");?>
					</td>
					</tr>
					</table>
			</td>
				<td valign="top" align="right"><a href="#" onclick="window.print();return false;"><img src="images/printButton.png" alt="<?=_FORM_BUTTON_PRINT;?>"  /></a>&nbsp;&nbsp;
				</td>
			</tr>
		</table>
</td>
</tr>
				<TR>
					<TD>
					<BR>
					<?=$TextContent;?>
					<BR><BR>
					</TD>
				</TR>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD ><b><font color="#CC0099" size="2"><?=_BLOG_MOD_DETAIL_AUTH;?></b></font>
									<TABLE width="730" align=center cellSpacing=1 cellPadding=1 border=0>
				<TR>
					<TD width="80">
					<?
					$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['mem'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$arr['blog']['posted']."' ");
					$arr['mem'] = $db->fetch($res['mem']);
					$res['cblog'] = $db->select_query("SELECT *,count(id) as co FROM ".TB_BLOG." WHERE posted='".$arr['blog']['posted']."' group by posted");
					$arr['cblog'] = $db->fetch($res['cblog']);					
					?>
					<? if ($arr['mem']['member_pic']){ echo "<img src=\"icon/".$arr['mem']['member_pic']."\">";
					} else {
						echo "<img src=\"icon/member_nrr.gif\">";
					}
					?>
					</TD>
					<td valign="top" width="150">
					<b><font  size="2"><?=_BLOG_MOD_NAME;?> </font><br>
					<b><font  size="2"><?=_BLOG_MOD_AUTH;?> </font><br>
					<b><font  size="2"><?=_MEMBER_MOD_FORM_USER_BIRTH;?> : </font><br>
					<b><font  size="2"><?=_MEMBER_MOD_FORM_WORK;?> : </font><br>
					<b><font  size="2"><?=_BLOG_MOD_NUM;?></font><br>
					<b><font  size="2"><?=_BLOG_MOD_LEVEL;?></font>
					</td>
					<td valign="top" >
					<b><font color="#CC0000" size="2"><?=$arr['mem']['user'];?></font><br>
					<b><font color="#CC0000" size="2"><?=$arr['mem']['name'];?></font><br>
					<b><font color="#CC0000" size="2"><?echo "".$arr['mem']['date']."/".$arr['mem']['month']."/".$arr['mem']['year']."";?></font><br>
					<b><font color="#CC0000" size="2">  <?=$arr['mem']['office'];?></font><br>
					<b><font color="#CC0000" size="2">  <?=$arr['cblog']['co'];?> <?=_BLOG_MOD_NUMS;?> </font><br>
					<b><font color="#CC0000" size="2"><?BlogLevel($arr['cblog']['co']);?></font>
					</tr>

				</table>
					
					</TD>
				</TR>
</table>
<?
}
?>
<?CloseTablecom();?>

