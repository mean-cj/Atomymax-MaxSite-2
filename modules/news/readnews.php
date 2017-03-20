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
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- News -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_news.gif" BORDER="0"><BR><BR>
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
<td valign="top" align="left" width="730"><B><FONT COLOR="#990000">&nbsp;&nbsp;<?=_FORM_CAT;?> <FONT COLOR="#0066FF"><?=$arr['category']['category_name'];?></td>
</td>
</tr>
<tr>
<td>
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0 background="images/bread.jpg" height=171>
				<TR>
					<TD valign="top" colspan="2">
					<table>
					<tr>
					<td valign="top" >
					<?if ($arr['news']['pic']==1){echo "<img  src=icon/news_".$arr['news']['post_date'].".jpg class=mysborder border=0 align=left>";} else {echo "<img class=mysborder src=images/icon/".$arr['category']['icon']." border=0 align=left>";} ?>
					<td valign="top">
					<table>
					<tr>
					<td valign="top"><B><FONT COLOR="#3333FF"><?=_FORM_MOD_READ_CONT;?> </font><FONT COLOR="#990000"><?=$arr['news']['topic'];?></FONT>
<?=NewsIcon(TIMESTAMP, $arr['news']['post_date'], "images/icon_new.gif");?></td>
					</tr>
					<tr>
					<td>	<?=_FORM_MOD_POSTEDX;?> <?=$arr['news']['posted'];?></B>

					</td>
					</tr>
					<tr>
					<td><?=_DETAIL_PRIVIEW;?>  : <?=$arr['news']['pageview'];?>
					</td>
					</tr>
					<tr>
					<td>
					<?= ThaiTimeConvert($arr['news']['post_date'],"1","");?>
					
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  <a href="?name=admin&file=news&op=news_edit&id=<? echo $arr['news']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
				  <a href="javascript:Confirm('?name=admin&file=news&op=news_del&id=<? echo $arr['news']['id'];?>&prefix=<? echo $arr['news']['post_date'];?>','<?=_FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
<?
}
if($arr['news']['attach']){
?>

<a href="attach/news_<? echo $arr['news']['attach'];?>"><font color="#0066CC"><b>[ <?=_FORM_MOD_DOWLOAD_ATT;?> ]</a>

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
<td valign="top" align="left" id="sizer">
<a class="decrease" href="#" title="Text Size --"><img style="width: 31px; height: 16px;" src="images/smaller_font.gif"/></a><a class="increase" href="#" title="Text Size ++"><img style="width: 31px; height: 16px;" src="images/bigger_font.gif"/></a>&nbsp;<a href="createpdf.php?mo=news&id=<?=$arr['news']['id'];?>" target="_blank"><img src="images/pdf_button.png" border="0"></a>&nbsp;<a href="print.php?name=news&file=readprint&id=<?=$arr['news']['id'];?>" title="พิมพ์" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=770,height=580,directories=no,location=no'); return false;" rel="nofollow"><img src="images/printButton.png" border="0"></a>&nbsp;<A HREF="popup.php?name=sendmail&mo=news&id=<?=$arr['news']['id'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 200} )" class="highslide"><img src="images/emailButton.png" border="0"></a>&nbsp;&nbsp;
</td>
</tr>
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
					<?=breakpage($mod,$page,$id,$thepage);?>
					<BR><BR>
					</TD>
				</TR>
</table>
<table  width="100%">
<tr>
<td colspan=2>
<?
$rater_ids=$_GET['id'];
$rater_item_name='news';
$mod="news";

include("modules/rater/rater.php");
?>
</td>
</tr>
</table>
<?
}
?>
<?CloseTablecom();?>


<table align=center cellSpacing=0 cellPadding=0 border=0 width=740>

				<TR>
					<TD align=left>
					<BR>
					<B><FONT COLOR="#990000"><?=$arr['category']['category_name'];?><?=_FROM_LINK_FIVECONT;?></B></FONT><BR><BR>
<?
//แสดงข่าวสาร/ประชาสัมพันธ์ 5 อันดับล่าสุดของหมวดหมู่ 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['cat_news'] = $db->select_query("SELECT * FROM ".TB_NEWS." WHERE category='".$arr['category']['id']."' ORDER BY id DESC LIMIT 5 ");
$rows['cat_news'] = $db->rows($res['cat_news']); 
if(!$rows['cat_news']){
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"._FROM_CAT_NO." ";
}
while($arr['cat_news'] = $db->fetch($res['cat_news'])){
?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<IMG SRC="images/icon/suggest.gif" BORDER="0" ALIGN="absmiddle"> <B><A HREF="?name=news&file=readnews&id=<?=$arr['cat_news']['id'];?>" target="_blank"><?=$arr['cat_news']['topic'];?></A></B> <?= ThaiTimeConvert($arr['cat_news']['post_date'],"","");?><BR>
<?
}
$db->closedb ();
?>
					</TD>
				</TR>

			</TABLE>
			<BR><BR>
			
<?

if($arr['news']['enable_comment']){

	//Check Comment
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$total = $db->num_rows(TB_NEWS_COMMENT,"news_id"," news_id=' ".$arr['news']['id']." ' ");
$e_page=10; 
if(!isset($_GET['s_page'])){   
	$_GET['s_page']=0;  
	$chk_page=$_GET['s_page'];   
}else{   
	$chk_page=$_GET['s_page'];     
	$_GET['s_page']=$_GET['s_page']*$e_page;   
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$qr = $db->select_query("select * from ".TB_NEWS_COMMENT." where news_id=' ".$arr['news']['id']." ' ORDER BY id  LIMIT ".$_GET['s_page'].",$e_page ");
$numr=$db->num_rows($qr);
if($numr >=1){   
	$plus_p=($chk_page*$e_page)+$numr;   
}else{   
	$plus_p=($chk_page*$e_page);       
}   
$total_p=ceil($total/$e_page);   
$before_p=($chk_page*$e_page)+1;  

	$count=1;
	while($arr['comment'] = $db->fetch($qr)){

?>
<center><table width=550 >
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
				<?if($admin_user){echo " <A HREF=\"?name=news&file=delete_comment&id=".$_GET['id']."&comment=".$arr['comment']['id']."\"><IMG SRC=\"images/admin/trash.gif\" height=\"18\"  BORDER=\"0\" ALIGN=\"absmiddle\"></A>";};?>
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
		<td width="100%" alt="" ><hr><FONT COLOR="#990000"><?=_FORM_MOD_POSTEDX;?> </FONT></B> <?=$arr['comment']['name'];?> &nbsp;&nbsp; <FONT COLOR="#990000"><B><?=_FROM_COMMENT_IP;?> </B></FONT><?echo preg_replace('/([0-9]+\.[0-9]+)\.[0-9]+\.[0-9]+/', '\1<span style="color:red">.xxx.xxx</span>', $arr['comment']['ip']);?>
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


<?
			$count  ++;
echo "</td></tr></table>";
	}
	$db->closedb ();
?>
<center><table width=450><tr><td align=center width=100% class="browse_page">
	<?  page_navigator("news","readnews",$id="".$_GET['id']."",$before_p,$plus_p,$total,$total_p,$chk_page); ?>
</td>
</tr>
</table><br>
			<!-- Enable Comment -->
			<TABLE cellSpacing=0 cellPadding=0 width=550 border=0 align="center">
			  <TBODY>
				<TR>
				  <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
				  <TD width="490" vAlign=top align=left><IMG src="images/topfader.gif" border=0><BR>
				  <IMG SRC="images/menu/textmenu_comment.gif" BORDER="0" ><BR>
						<FORM NAME="form2" METHOD=POST ACTION="?name=news&file=comment&id=<?=$_GET['id'];?>">
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
							<TD width="80" align="right" valign=top><B><?=_FROM_COMMENT_NUMX;?> : </B></TD>
							<TD><TEXTAREA NAME="COMMENT" ROWS="10" COLS="100" style="width:400"></TEXTAREA>
		<script type="text/javascript">CKEDITOR.replace ( 'COMMENT',{toolbar: 'Mini'});</script>
						</TD>
						</TR>
						<TR>
							<TD width="80" align="right" valign=top></TD>
							<TD><INPUT TYPE="submit" value="<?=_FROM_COMMENT_BUTTON_ADD;?>"><BR>
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