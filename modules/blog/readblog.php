<?include ("editor.php");?>
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
<?
//แรียก user online ทั้งหมด
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user2'] = $db->select_query("SELECT * FROM ".TB_useronline." ");			
			$rows['user2'] = $db->rows($res['user2']);
//ดึง user online จกา table TB_user
	//		while($arr['user2'] = $db->fetch($res['user2'])){	
			$arr['user2'] = $db->fetch($res['user2']);		
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$arr['user2']['useronline']."' ");		
			$arr['user'] = $db->fetch($res['user'])	;

			?>

	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="730" vAlign=top>
		  <!-- News -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_blog.gif" BORDER="0"><BR><BR>
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
	echo "<tr><td><BR><BR><BR><BR><CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\" ><BR><BR><B>"._KNOWLEDGE_READ_NULL_ID."</B></CENTER><BR><BR><BR><BR></td></tr></table>";
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
				<td><B><FONT COLOR="#990000">&nbsp;&nbsp;<?=_FORM_CAT;?> <FONT COLOR="#0066FF"><?=$arr['category']['category_name'];?>
				</td>
</tr>
<tr>
<td>
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0 background="images/bread.jpg" height=171>
				<TR>
					<TD valign="top" colspan="2">
					<table>
					<tr>
					<td valign="top">
					<? if($arr['blog']['pic']){ echo "<img src=\"icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg\"></td>";
					} else {
					echo "<img src=\"images/icon/".$arr['category']['icon']."\"></td>";
					}
					?>
					<td>
					<table>
					<tr>
					<td valign="top">
					<B><FONT COLOR="#3333FF"><?=_BLOG_MOD_NUMX;?> </font><FONT COLOR="#990000"><?=$arr['blog']['topic'];?></FONT>	 				<?=NewsIcon(TIMESTAMP, $arr['blog']['post_date'], "images/icon_new.gif");?></td></tr>
					<tr>
					<td>
					<b><FONT COLOR="#3333FF"><?=_BLOG_MOD_NAME;?> </font><FONT COLOR="#FF0000"><?=$arr['blog']['posted'];?></FONT>
					</td>
					</tr>
					<tr>
					<td>
					<b><FONT COLOR="#3333FF"><?=_BLOG_LEVEL;?> </font><FONT COLOR="#FF0000"><?BlogLevel($arr['cblog']['co']);?></FONT>
					</td>
					</tr>
					<tr>
					<td><?=_BLOG_MOD_PRIVIEWX;?> <?=$arr['blog']['pageview'];?>
					</td>
					</tr>
					<tr>
					<td>
					<?= ThaiTimeConvert($arr['blog']['post_date'],"1","");?>
<?if ($login_true==$arr['blog']['posted']){echo "<A HREF=\"?name=blog&file=blog&op=article_edit&id=".$arr['blog']['id']."\">&nbsp;&nbsp;<IMG SRC=\"images/mail1[1].gif\" BORDER=\"0\" ALIGN=\"absmiddle\"></a><a href=\"index.php?name=blog&file=blog&op=article_del&id=".$arr['blog']['id']."\">&nbsp;<IMG SRC=\"images/trash_16[1].gif\" BORDER=\"0\" ALIGN=\"absmiddle\"></a>";}?>

<?
if($admin_user){
	//Admin Login Show Icon
?>
				  <a href="?name=admin&file=blog&op=article_edit&id=<? echo $arr['blog']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
				  <a href="javascript:Confirm('?name=admin&file=blog&op=article_del&id=<? echo $arr['blog']['id'];?>&prefix=<? echo $arr['blog']['post_date'];?>','<?echo _FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
						
<?
}
$headertext = "#ffffff";         // สีตัวอักษรส่วนหัวของหน้าต่าง popup
$headerbackground = "#FFCC00";  // สีพื้นส่วนหัวของหน้าต่าง popup
$bigbtn = True; // True = ปุ่ม(ภาษาไทย)ขนาดใหญ่, False =  ปุ่ม(ภาษาไทย)ขนาดเล็ก
if ($bigbtn) {
	$btn="<img src=\"images/lg-share-en.gif\" alt=\""._FROM_SHARE_PIN."\" height=\"16\" width=\"125\" border=\"0\" />";
} else {
	$btn="<img src=\"images/sm-share-en.gif\" alt=\""._FROM_SHARE_PIN."\" height=\"16\" width=\"83\" border=\"0\" />";
}
?>
<!-- AddThis Bookmark Button BEGIN -->
<script type="text/javascript">
	var addthis_header_color = "$headertext";
	var addthis_header_background = "$headerbackground";
	var addthis_config = {ui_language: "en"};
</script><a href="<?=WEB_URL;?>" onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><?=$btn;?><script type="text/javascript" src="http://s7.addthis.com/js/200/addthis_widget.js"></script>
<!-- AddThis Bookmark Button END -->				
</td>
</tr>
				<tr>
				<td valign="top" align="left"><a href="createpdf.php?mo=blog&id=<?=$arr['blog']['id'];?>" target="_blank"><img src="images/pdf_button.png" border="0"></a>&nbsp;<a href="print.php?name=blog&file=readprint&id=<?=$arr['blog']['id'];?>" title="พิมพ์" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=770,height=580,directories=no,location=no'); return false;" rel="nofollow"><img src="images/printButton.png" border="0"></a>&nbsp;<A HREF="popup.php?name=sendmail&mo=blog&id=<?=$arr['blog']['id'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 200} )" class="highslide"><img src="images/emailButton.png" border="0"></a>&nbsp;&nbsp;
				</td>
				</tr>
</td>
<tr>
					</table></td></tr>
</table>

</td>
</tr>
					
					</table>
					</TD>
				</TR>
				<TR>
					<TD>
					<BR>
					<?=$TextContent;?>
					<BR><BR>
					</TD>
				</TR>
<?
if($arr['blog']['attach']){?>
<tr><td width=100% bgcolor=#F7F7F7 align=center colspan=2><font size=2><b><a href="attach/blog_<? echo $arr['blog']['attach'];?>">	[ <?=_FROM_DOWNLOAD_ATT;?> ]</a></font></td></tr>
<tr><td width=100% bgcolor=#ffffff align=center colspan=2>&nbsp;&nbsp;</td></tr>
<?} 
?>
<tr>
<td>
<table  width="100%">
<tr>
<td colspan=2>
<?
$rater_ids=$_GET['id'];
$rater_item_name='blog';
include("modules/rater/rater.php");
?>
</td>
</tr>
</table>
</td>
</tr>
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
					<b><font size="2"><?=_BLOG_MOD_AUTH;?> </font><br>
					<b><font size="2"><?=_BLOG_MOD_WORK;?> </font><br>
					<b><font size="2"><?=_BLOG_MOD_OFFICE;?> </font><br>
					<b><font size="2"><?=_BLOG_MOD_NUM;?></font><br>
					<b><font  size="2"><?=_BLOG_MOD_LEVEL;?></font>
					</td>
					<td valign="top" >
					<b><font color="#CC0000" size="2"><?=$arr['mem']['user'];?></font><br>
					<b><font color="#CC0000" size="2"><?=$arr['mem']['name'];?></font><br>
					<b><font color="#CC0000" size="2"><?echo "".$arr['mem']['work']."";?></font><br>
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
<table align=center cellSpacing=0 cellPadding=0 border=0 width=730>

				<TR>
					<TD align=left>
					<BR>
					<B><FONT COLOR="#990000"><?=$arr['category']['category_name'];?> <?=_FROM_LINK_FIVECONT;?></B></FONT><BR><BR>
<?
//แสดงข่าวสาร/ประชาสัมพันธ์ 5 อันดับล่าสุดของหมวดหมู่ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['blg_news'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE category='".$arr['category']['id']."' ORDER BY id DESC LIMIT 5 ");
$rows['blg_news'] = $db->rows($res['blg_news']); 
if(!$rows['blg_news']){
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"._FROM_CAT_NO."";
}
while($arr['blg_news'] = $db->fetch($res['blg_news'])){
?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<IMG SRC="images/icon/suggest.gif" BORDER="0" ALIGN="absmiddle"> <B><A HREF="?name=blog&file=readblog&id=<?=$arr['blg_news']['id'];?>" target="_blank"><?=$arr['blg_news']['topic'];?></A></B> <?= ThaiTimeConvert($arr['blg_news']['post_date'],"","");?><BR>
<?
}
$db->closedb ();
?>
					</TD>
				</TR>
			</TABLE>
			<BR><BR>
			
<?
if($arr['blog']['enable_comment']){
empty($_GET['page'])?$page="":$page=$_GET['page'];

	//Check Comment
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 10 ;
	$SUMPAGE = $db->num_rows(TB_BLOG_COMMENT,"blog_id"," blog_id=' ".$arr['blog']['id']." ' ");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;

	$res['comment'] = $db->select_query("SELECT * FROM ".TB_BLOG_COMMENT." WHERE blog_id='".$arr['blog']['id']."' ORDER BY id  LIMIT $goto, $limit ");
	$count=1;
	while($arr['comment'] = $db->fetch($res['comment'])){

?>
<center><table width=550>
<tr>
<td width=100 valign="top">
<table>
<tr>
          <td bgcolor="#FFFFFF" valign="top" align="center" width="100"> 
<br>
<?
	$Name=$arr['comment']['name'];
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." ");
$arr['admin'] = $db->fetch($res['admin']);

if ($arr['admin']['username']==$Name) {
 ?>
<A HREF="?name=admin&file=user&id=<?=$arr['admin']['id']; ?>">
	<? if($arr['admin']['picture']==""){ ?>
	<IMG SRC="icon/member_nrr.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }else{  ?>
	<IMG SRC="icon/<?=$arr['admin']['picture']; ?>" width='80' BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? } 
 ?> </a><?
}else {

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['member'] = $db->select_query("SELECT * FROM ".TB_MEMBER." where user='".$Name."' ");
$arr['member'] = $db->fetch($res['member']);

?>
	<? if($arr['member']['id']==""){ ?>
		<IMG SRC="icon/guest_nrr.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }else{  ?>
<A HREF="?name=member&file=member_Message&id=<?=$arr['member']['id']; ?>">
	<? if($arr['member']['member_pic']==""){ ?>
	<IMG SRC="icon/member_nrr.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }else{  ?>
	<IMG SRC="icon/<?=$arr['member']['member_pic']; ?>" width='80' BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? };?></a>
<?  }; 

	};
?>
</td>
</tr>
</table>

</td>
<td>
<center>
				<table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td >
			<img src="images/com/b_01.jpg" width="23" height="13" alt=""></td>
		<td background="images/com/b_02.jpg" height="13" width="100%"></td>
		<td>
			<img src="images/com/b_03.jpg" width="10" height="13" alt=""></td>
	</tr>
	<tr>
		<td >
			<img src="images/com/b_04.jpg" width="23" alt=""></td>
		<td bgcolor="#F5F5F5"  width="100%" alt=""><B><FONT COLOR="#990000"><?=_FROM_COMMENT_NUM;?> <?=$count;?></FONT></B>
				<?if($admin_user){echo " <A HREF=\"?name=blog&file=delete_comment&id=".$_GET['id']."&comment=".$arr['comment']['id']."\"><IMG SRC=\"images/admin/trash.gif\" height=\"18\"  BORDER=\"0\" ALIGN=\"absmiddle\"></A>";};?>
				<?= ThaiTimeConvert($arr['comment']['post_date'],"1","1");?>
		</td>
		<td background="images/com/b_05.jpg" width="10" alt="" height="100%"></td>
	</tr>
	<tr>
		<td background="images/com/b_06.jpg" width="23" height="100%" alt=""></td>
		<td alt="">
			&nbsp;&nbsp;<b><?=_FROM_COMMENT_DETAIL;?> </b><br><br>
			&nbsp;&nbsp;&nbsp;&nbsp;<font color="#003366" ><b>
			<?=(stripslashes($arr['comment']['comment']));?></b><br>
			<br>
			</td>
		<td background="images/com/b_05.jpg" width="10" height="100%" alt=""></td>
	</tr>
		<tr>
		<td background="images/com/b_06.jpg" width="23" height="100%" alt=""></td>
		<td width="100%" alt="" ><hr><FONT COLOR="#990000"><?=_BLOG_AUTH;?> </FONT></B> <?=$arr['comment']['name'];?> &nbsp;&nbsp; <FONT COLOR="#990000"><B><?=_FROM_COMMENT_IP;?> </B></FONT><?echo preg_replace('/([0-9]+\.[0-9]+)\.[0-9]+\.[0-9]+/', '\1<span style="color:red">.xxx.xxx</span>', $arr['comment']['ip']);?>
			</td>
		<td background="images/com/b_05.jpg" width="10" height="100%" alt=""></td>
	</tr>
	<tr>
		<td >
			<img src="images/com/b_07.jpg" width="23" height="11" alt=""></td>
		<td background="images/com/b_08.jpg" height="11" width="100%" alt=""></td>
		<td>
			<img src="images/com/b_09.jpg" width="10" height="11" alt=""></td>
	</tr>
</table><br>
</td>
</tr>
</table>
<?
			$count  ++;
	}
	echo "<center>";
	SplitPage($page,$totalpage,"?name=blog&file=readblog&id=".$_GET['id']."");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
	echo "<BR>";
	echo "<BR>";
	$db->closedb ();
?>
			<!-- Enable Comment -->
			<TABLE cellSpacing=0 cellPadding=0 width=550 border=0 align="center">
			  <TBODY>
				<TR>
				  <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
				  <TD width="490" vAlign=top align=left><IMG src="images/topfader.gif" border=0><BR>
				  <IMG SRC="images/menu/textmenu_comment.gif" BORDER="0" ><BR>
						<FORM NAME="form2" METHOD=POST ACTION="?name=blog&file=comment&id=<?=$_GET['id'];?>">
						<TABLE cellSpacing=5 cellPadding=0 width=550 border=0 align="center">
						<TR>
							<TD width="80" align="right"><B><?=_FROM_COMMENT_AUTH;?> </B></TD>
							<TD><INPUT TYPE="text" NAME="NAME" style="width:300" <?if($login_true){echo "value=\"".$login_true."\" readonly style=\"color: #FF0000\" ";};?><?if($admin_user){echo "value=\"".$admin_user."\" readonly style=\"color: #FF0000\" ";};?>></TD>
						</TR>
<?
 if($login_true || $admin_user){
} else {
if(USE_CAPCHA){
?>
						<TR>
							<TD width="80" align="right">
							<?if(CAPCHA_TYPE == 1){ 
								echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							}else if(CAPCHA_TYPE == 2){ 
								echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							};?>
							</TD>
							<TD><input name="security_code" type="text" id="security_code" size="20" maxlength="6" style="width:80" > <?=_JAVA_CAPTCHA_ADD;?> </TD>
						</TR>
<?
}
}
?>
						<TR>
							<TD width="80" align="right" valign=top><B><?=_FROM_COMMENT_NUMX;?> </B></TD>
							<TD><TEXTAREA NAME="COMMENT" ROWS="10" COLS="100" style="width:400"></TEXTAREA>
		<script type="text/javascript">CKEDITOR.replace ( 'COMMENT',{toolbar: 'Basic'});</script>
	</TD>
						</TR>
						<TR>
							<TD width="80" align="right" valign=top></TD>
							<TD><INPUT TYPE="submit" value=" <?=_FROM_BUTTON_COMMENT;?> "><BR>
							<BR><?=_FROM_COMMENT_WORNING;?>
							</TD>
						</TR>
						</TABLE>
						</FORM>
				  </TD>
				</TR>
			  </TBODY>
			</TABLE>
			<BR><BR>
			<?=_FROM_COMMENT_AGREE;?> <A HREF="mailto:<?=WEB_EMAIL;?>"><?=WEB_EMAIL;?></A> <?=_FROM_COMMENT_AGREE2;?>
			<BR><BR>
			<!-- End Enable Comment -->
<?
}
?>

			<!-- End News -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
