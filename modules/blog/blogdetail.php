<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options['selObj.selectedIndex'].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_blog.gif" BORDER="0"><BR>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
									<TABLE width="740" align=center cellSpacing=1 cellPadding=1 border=0>
				<TR>
					<TD bgcolor="#F7F7F7" width="80">
					<?
					$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['mem'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$_GET['user']."' ");
					$arr['mem'] = $db->fetch($res['mem']);
					$res['cblog'] = $db->select_query("SELECT *,count(id) as co FROM ".TB_BLOG." WHERE posted='".$_GET['user']."' group by posted");
					$arr['cblog'] = $db->fetch($res['cblog']);					
					?>
					<?if ($arr['mem']['member_pic']){echo "<img  src=icon/".$arr['mem']['member_pic']." class=mysborder border=0 align=left>";} else {echo "<img class=mysborder src=icon/member_nrr.gif  border=0 align=left>";} ?>
					</TD>
					<td bgcolor="#F7F7F7" valign="top" width="150">
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_NAME;?> </font><br>
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_AUTH;?> </font><br>
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_WORK;?> </font><br>
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_OFFICE;?> </font><br>
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_NUM;?></font><br>
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_LEVEL;?></font>
					</td>
					<td bgcolor="#F7F7F7" valign="top" >
					<b><font color="#CC0000" size="2"><?=$arr['mem']['user'];?></font><br>
					<b><font color="#CC0000" size="2"><?=$arr['mem']['name'];?></font><br>
						<b><font color="#CC0000" size="2"><?=$arr['mem']['work'];?></font><br>
					<b><font color="#CC0000" size="2"><?=$arr['mem']['office'];?></font><br>
					<b><font color="#CC0000" size="2">  <?=$arr['cblog']['co'];?> <?=_BLOG_MOD_NUMS;?></font><br>
					<b><font color="#CC0000" size="2"><?BlogLevel($arr['cblog']['co']);?></font>
					</tr>

				</table>
				</td>
				</tr>
					<tr>
					<TD height="1" class="dotline" colspan="3"></TD>

					</tr>
<tr>
<td>
<?
//////////////////////////////////////////// แสดงรายการ blog  
empty($_GET['page'])?$page="":$page=$_GET['page'];
empty($_GET['op'])?$op="":$op=$_GET['op'];

if($op == ""){
?>
    <TABLE cellSpacing=0 cellPadding=0 width=660 border=0>
      <TBODY>
        <TR>
          <TD width=640 vAlign=top>
				<TABLE width=640 align=center cellSpacing=0 cellPadding=0 border=0>
<?
//แสดงข่าวสาร/ประชาสัมพันธ์ 

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_BLOG,"id"," where  posted='".$_GET['user']."' ");

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE  posted='".$_GET['user']."' ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['blog'] = $db->fetch($res['blog'])){
	if ($count==0) { echo "<TR>"; }
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_BLOG_CAT." WHERE id='".$arr['blog']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$content = $arr['blog']['headline'];
	$Detail = stripslashes(FixQuotes($content));
				$ress['com'] = $db->select_query("SELECT *,count(news_id) as com FROM ".TB_BLOG_COMMENT." WHERE blog_id ='".$arr['blog']['id']."' group by blog_id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>
			<TD width="50%" valign=top align=left>	
				<TABLE width="100%">
				<TR>
					<TD><FONT COLOR="#990000"><B>
					<?= ThaiTimeConvert($arr['blog']['post_date'],"","");?> : </font><FONT COLOR="#3333FF"><?=$arr['category']['category_name'];?></B></FONT> 
					</TD>
				</TR>
				<TR><TD height="3" ></TD></TR>
				<TR>
					<TD valign="top" align="center">
					<A HREF="?name=blog&file=readblog&id=<?=$arr['blog']['id'];?>" target="_blank">
					<?if ($arr['blog']['pic']==1){echo "<img  src=icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg class=mysborder border=0 align=center>";} else {echo "<img class=mysborder src=images/icon/".$arr['category']['icon']." border=0 align=center>";} ?></a>
					</td>
					</tr>
					<tr>
					<td colspan="2" ><img src="images/a.gif"><A HREF="?name=blog&file=readblog&id=<?=$arr['blog']['id'];?>" target="_blank">
					<B><?=$arr['blog']['topic'];?></A>  <?if ($login_true==$arr['blog']['posted']){echo "<A HREF=\"?name=blog&file=blog&op=article_edit&id=".$arr['blog']['id']."\">&nbsp;<IMG SRC=\"images/mail1[1].gif\" BORDER=\"0\" ALIGN=\"absmiddle\"></a>&nbsp;&nbsp;<a href=\"index.php?name=blog&file=blog&op=article_del&id=".$arr['blog']['id']."\">&nbsp;<IMG SRC=\"images/trash_16[1].gif\" BORDER=\"0\" ALIGN=\"absmiddle\"></a>";}?>
					</B>
					<?NewsIcon(TIMESTAMP, $arr['blog']['post_date'], "images/icon_new.gif");?>( <?=$arr['blog']['pageview'];?> / <?=$arrs['com']['com'];?> )
				<BR>&nbsp;&nbsp;&nbsp;&nbsp;<?=$Detail;?><br><?$rater_ids=$arr['blog']['id'];$rater_item_name="blog";include("modules/rater/raters.php");?>
					</TD>
				</TR>
				<TR><TD height="3" ></TD></TR>
				</TABLE>
			</TD>
<?
$count++;
if (($count%_BLOG_COL) == 0) { echo "</TR><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
}
$db->closedb ();
//จบการแสดงข่าวสาร
?>
				</TABLE>
				<BR>
				<table border="0" cellpadding="0" cellspacing="1" width=740 align=center>
					<tr>
						<td>
				<?
				SplitPage($page,$totalpage,"?name=blogdetail");
				echo $ShowSumPages ;
				echo "<BR>";
				echo $ShowPages ;
				?>
						</td>
					</tr>
				</table>
				<BR><BR>

			<!-- End blog -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
<?

}

?>
						<BR>
					</TD>
				</TR>
			</TABLE>
					</TD>
				</TR>
			</TABLE>
