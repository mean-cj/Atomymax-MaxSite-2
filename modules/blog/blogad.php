<?
CheckAdmin($admin_user, $admin_pwd);
?>
<?include ("editor.php");?>
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
					<TD>
				<TABLE width="730" align=center cellSpacing=0 cellPadding=0 border=0 background="images/bread.jpg" height=171>
				<TR >
					<TD width="120" align="center" >
					<?
					$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
					$res['mem'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$admin_user."' ");
					$arr['mem'] = $db->fetch($res['mem']);
					$res['cblog'] = $db->select_query("SELECT *,count(id) as co FROM ".TB_BLOG." WHERE posted='".$admin_user."' group by posted");
					$arr['cblog'] = $db->fetch($res['cblog']);					
					if ($arr['mem']['member_pic']){?><img src="icon/<?=$arr['mem']['member_pic'];?>"> <?} else {?>
					<img src="icon/member_nrr.gif">
					<?}?>
					</TD>
					<td valign="top" width="150">
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_NAME;?> </font></b><br>
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_AUTH;?> </font></b><br>
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_WORK;?> </font></b><br>
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_OFFICE;?> </font></b><br>
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_NUM;?></font></b><br>
					<b><font color="#0033FF" size="2"><?=_BLOG_MOD_LEVEL;?></font></b>
					</td>
					<td valign="top" width="550">
					<b><font color="#CC0000" size="2"><?=$arr['mem']['user'];?></font></b><br>
					<b><font color="#CC0000" size="2"><?=$arr['mem']['name'];?></font></b><br>
					<b><font color="#CC0000" size="2"><?=$arr['mem']['work'];?></font></b><br>
					<b><font color="#CC0000" size="2"><?=$arr['mem']['office'];?></font></b><br>
					<b><font color="#CC0000" size="2">  <?=$arr['cblog']['co'];?> <?=_BLOG_MOD_NUMS;?></font></b><br>
					<b><font color="#CC0000" size="2"><?BlogLevel($arr['cblog']['co']);?></font></b>
					</td>
					</tr>

				</table>
				</td>
				</tr>

<tr>
<td>
<?
//////////////////////////////////////////// แสดงรายการ blog  
if($op == ""){
?>
    <TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width=740 vAlign=top>
				<TABLE width=740 align=center cellSpacing=0 cellPadding=0 border=0>
<?
//แสดงข่าวสาร/ประชาสัมพันธ์ 

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_BLOG,"id"," where  posted='".$admin_user."' ");
$page=$_GET['page'];
if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE  posted='".$admin_user."' ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['blog'] = $db->fetch($res['blog'])){
	if ($count==0) { echo "<TR>"; }
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_BLOG_CAT." WHERE id='".$arr['blog']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$content = $arr['blog']['headline'];
	$Detail = stripslashes(FixQuotes($content));
?>
			<TD width="50%" valign=top align=left>	
				<TABLE width="100%">
				<TR>
					<TD><FONT COLOR="#990000"><B>
					<?= ThaiTimeConvert($arr['blog']['post_date'],"","");?> : <?=$arr['category']['category_name'];?></B></FONT> 
					</TD>
				</TR>
				<TR><TD height="3" ></TD></TR>
				<TR>
					<TD>
					<A HREF="?name=blog&file=readblog&id=<?=$arr['blog']['id'];?>" target="_blank">
					<?if ($arr['blog']['pic']==1){echo "<img  src=icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg class=mysborder border=0 align=left>";} else {echo "<img class=mysborder src=images/icon/".$arr['category']['icon']." border=0 align=left>";} ?><B><?=$arr['blog']['topic'];?></A>  <?if ($admin_user==$arr['blog']['posted']){echo "<A HREF=\"?name=blog&file=blog&op=article_edit&id=".$arr['blog']['id']."\"><IMG SRC=\"images/mail1[1].gif\" BORDER=\"0\" ALIGN=\"absmiddle\"></a>&nbsp;&nbsp;<a href=\"index.php?name=blog&file=blog&op=article_del&id=".$arr['blog']['id']."\"><IMG SRC=\"images/trash_16[1].gif\" BORDER=\"0\" ALIGN=\"absmiddle\"></a>";}?></B>
					<?NewsIcon(TIMESTAMP, $arr['blog']['post_date'], "images/icon_new.gif");?>
				<BR><?=$Detail;?><br><?$rater_ids=$arr['blog']['id'];$rater_item_name="blog";include("modules/rater/raters.php");?>
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
				<table border="0" cellpadding="0" cellspacing="1" width=640 align=center>
					<tr>
						<td>
				<?
				SplitPage($page,$totalpage,"?name=blog&category=".$_GET['category']."");
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

else if($op == "article_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database

		$FILE = $_FILES['FILE'];
		$FILESS=$_FILES['FILESS'];
		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL'] ){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
if ($FILE['name']) {
		require("includes/class.resizepic.php");
		if (($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}else{
			@copy ($FILE['tmp_name'] , "icon/blog_".TIMESTAMP."_".$admin_user.".jpg" );
			$original_image = "icon/blog_".TIMESTAMP."_".$admin_user.".jpg" ;
			$desired_width = _Iblog_W ;
			$desired_height = _Iblog_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/blog_".TIMESTAMP."_".$admin_user.".jpg", "JPG");
		}
	$pic='1';
} else {
	$pic='0';
}

if ($FILESS['name']) {
		//ทำการเพิ่มข้อมูลลงดาต้าเบส
$abstractxx_name =$FILESS['tmp_name'];

     if(strrchr($abstractxx_name,".")==".pdf" || strrchr($abstractxx_name,".")==".doc" ||strrchr($abstractxx_name,".")==".xls" || strrchr($abstractxx_name,".")==".ppt" || strrchr($abstractxx_name,".")==".docx" || strrchr($abstractxx_name,".")==".xlsx" || strrchr($abstractxx_name,".")==".pptx" || strrchr($abstractxx_name,".")==".zip" || strrchr($abstractxx_name,".")==".rar" || strrchr($abstractxx_name,".")==".tar.gz") {	
//		 copy($_FILES['abstractxx']['tmp_name'], "data/download_".TIMESTAMP."_".$FILES['name']."");
		 	@copy ($FILESS['tmp_name'] , "attach/blog_".TIMESTAMP."_".$FILESS['name']."");
}else{
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_MESS_TPYE_FILE_NOACC." .doc , .xls , .ppt , .pdf , .zip , .tar.gz , .rar "._WEBBOARD_MESS_TPYE_FILE_NOACC1."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_BLOG,array(
			"category"=>"".addslashes(htmlspecialchars($_POST['CATEGORY']))."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"attach"=>"".TIMESTAMP."_".$FILESS['name']."",
			"pic"=>"$pic",
			"enable_comment"=>"".$_POST['ENABLE_COMMENT'].""
		));
		$db->closedb ();


} else {

		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_BLOG,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"pic"=>"$pic",
			"enable_comment"=>"".$_POST['ENABLE_COMMENT'].""
		));
		$db->closedb ();
}

		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._BLOG_MOD_ACC."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=blog&file=blog\"><B>"._BLOG_MOD_BACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	echo $ProcessOutput ;
}
else if($op == "article_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form

?>
<FORM NAME="myform" METHOD=POST ACTION="?name=blog&file=blogad&op=article_add&action=add" enctype="multipart/form-data">
<B><?=_FORM_TOPIC;?></B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="80">
<BR><BR>
<B><?=_FORM_CAT;?></B><BR>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_BLOG_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?=_FORM_ICON;?> </B><BR>
<IMG name="view01" SRC="images/news_blank.gif" <?echo " WIDTH=\""._Iblog_W."\" HEIGHT=\""._Iblog_H."\" ";?> BORDER="0" ><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_FORM_ICON_FIX1;?> <?echo ""._Iblog_W." x "._Iblog_H."";?> <?=_FORM_ICON_FIX2;?>
<BR><BR>
<B><?=_FORM_HEADLINE;?></B><BR>
<textarea cols="50" id="editor1" rows="50"  name="HEADLINE" ></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Mini'});</script>
<BR><BR>

<B><?=_FORM_DETAIL;?></B><BR>

<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ></textarea>
		<script type="text/javascript">CKEDITOR.replace( 'DETAIL',{
	toolbar :	[    ['-','Save','NewPage','Preview','-','Templates'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],'/',
    ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',  'HiddenField'],['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
    '/',
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Link','Unlink','Anchor'],
    '/',
    ['Styles','Format','Font','FontSize'],['TextColor','BGColor'],['Maximize','ShowBlocks','-','About'],'/',
	['syntaxhighlight','inserthtml','lrcshow','highslide','youtube']]});</script>
<BR>
<B><?=_FORM_ATT;?> </B><BR>
<input type="file" name="FILESS" onpropertychange="view01.src=FILESS.value;" style="width=250;">
<br>
<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1"> <?=_FORM_COMMENT;?>
<BR>
<input type="submit" value="<?=_BLOG_BUTTON_ADD;?>" name="submit"> <input type="reset" value="<?=_BLOG_BUTTON_CLEAR;?>" name="reset">
<BR><BR>
<?
	}


else if($op == "article_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit

		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE id='".$_GET['id']."' ");
		$arr['blog'] = $db->fetch($res['blog']);
		$db->closedb ();
if ($admin_user==$arr['blog']['posted']){

		$FILE = $_FILES['FILE'];
		$FILESS=$_FILES['FILESS'];
		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}

if ($FILE['name']) {
		require("includes/class.resizepic.php");
		if ((($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")) AND $FILE['size']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
			@copy ($FILE['tmp_name'] , "icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg" );
			$original_image = "icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg" ;
			$desired_width = _Iblog_W ;
			$desired_height = _Iblog_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg", "JPG");
	$pic='1';
} else {
	$pic='1';
}
if ($FILESS['name']) {
$abstractxx_name =$FILESS['tmp_name'];

     if(strrchr($abstractxx_name,".")==".pdf" || strrchr($abstractxx_name,".")==".doc" ||strrchr($abstractxx_name,".")==".xls" || strrchr($abstractxx_name,".")==".ppt" || strrchr($abstractxx_name,".")==".docx" || strrchr($abstractxx_name,".")==".xlsx" || strrchr($abstractxx_name,".")==".pptx" || strrchr($abstractxx_name,".")==".zip" || strrchr($abstractxx_name,".")==".rar" || strrchr($abstractxx_name,".")==".tar.gz") {	
//		 copy($_FILES['abstractxx']['tmp_name'], "data/download_".TIMESTAMP."_".$FILES['name']."");
		 	@copy ($FILESS['tmp_name'] , "attach/blog_".TIMESTAMP."_".$FILESS['name']."");
}else{
		echo "<script language='javascript'>" ;
		echo "alert('"._WEBBOARD_MESS_TPYE_FILE_NOACC." .doc , .xls , .ppt , .pdf , .zip , .tar.gz , .rar "._WEBBOARD_MESS_TPYE_FILE_NOACC1."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_BLOG,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$arr['blog']['posted']."",
			"post_date"=>"".$arr['blog']['post_date']."",
			"update_date"=>"".$arr['blog']['post_date']."",
			"attach"=>"".$arr['blog']['post_date']."_".$FILESS['name']."",
			"pic"=>"$pic",
			"enable_comment"=>"".$_POST['ENABLE_COMMENT'].""
		)," id=".$_GET['id']."");
		$db->closedb ();
//	@copy ($FILESS['tmp_name'] , "attach/blog_".$arr['blog']['post_date']."_".$FILESS['name']."");
} else {

		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_BLOG,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$arr['blog']['posted']."",
			"update_date"=>"".$arr['blog']['post_date']."",
			"pic"=>"$pic",
			"enable_comment"=>"".$_POST['ENABLE_COMMENT'].""
		)," id=".$_GET['id']."");
		$db->closedb ();
}

		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._BLOG_MOD_ACC."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=blog&file=blog\"><B>"._BLOG_MOD_BACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
} else {
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._BLOG_MOD_NOACC."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=blog&file=index\"><B>"._BLOG_MOD_BACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}

}

else if($op == "article_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form

		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE id='".$_GET['id']."' ");
		$arr['blog'] = $db->fetch($res['blog']);
		$db->closedb ();
		if ($admin_user==$arr['blog']['posted']){
		$TextContent = $arr['blog']['detail'];
		$TextContent = stripslashes($TextContent);
		$HEADLINE = $arr['blog']['headline'];
		$HEADLINE= stripslashes($HEADLINE);

?>
<FORM NAME="myform" METHOD=POST ACTION="?name=blog&file=blogad&op=article_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
<B><?=_FORM_TOPIC;?> </B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="80" value="<?=$arr['blog']['topic'];?>">
<BR><BR>
<B><?=_FORM_CAT;?> </B><BR>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_BLOG_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   if($arr['category']['id'] == $arr['blog']['category']){echo " Selected";}
	   echo ">".$arr['category']['category_name']."</option>";
	   $icons=$arr['category']['icon'];
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?=_FORM_ICON;?> </B><BR>
<?
	if ($arr['blog']['pic'] !=0){?>
<IMG name="view01" SRC="icon/blog_<?=$arr['blog']['post_date'];?>_<?=$arr['blog']['posted'];?>.jpg" <?echo " WIDTH=\""._Iblog_W."\" HEIGHT=\""._Iblog_H."\" ";?> BORDER="0" >
<?} else {?>
<IMG name="view01" SRC="images/news_blank.gif" <?echo " WIDTH=\""._Iblog_W."\" HEIGHT=\""._Iblog_H."\" ";?> BORDER="0" >
<?
	}
?>
<BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_FORM_ICON_FIX1;?> <?echo _Iblog_W." x "._Iblog_H ;?> <?=_FORM_ICON_FIX2;?>
<BR><BR>
<B><?=_FORM_HEADLINE;?> </B><BR>
<textarea cols="50" id="editor1" rows="50"  name="HEADLINE" ><?=$HEADLINE;?></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Mini'});</script>
<BR><BR>


<B><?=_FORM_DETAIL;?></B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ><?=$TextContent;?></textarea>
		<script type="text/javascript">CKEDITOR.replace( 'DETAIL',{
	toolbar :	[    ['-','Save','NewPage','Preview','-','Templates'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],'/',
    ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton',  'HiddenField'],['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
    '/',
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['Link','Unlink','Anchor'],
    '/',
    ['Styles','Format','Font','FontSize'],['TextColor','BGColor'],['Maximize','ShowBlocks','-','About'],'/',
	['syntaxhighlight','inserthtml','lrcshow','highslide','youtube']]});</script>
<br>
<B><?=_FORM_ATT;?> </B><BR>
<input type="file" name="FILESS" onpropertychange="view01.src=FILESS.value;" style="width=250;"><br>
<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1" <?if($arr['blog']['enable_comment']){echo " Checked";};?>> <?=_FORM_COMMENT;?>
<BR>
<input type="submit" value="<?=_BLOG_BUTTON_EDIT;?>" name="submit"> <input type="reset" value="<?=_BLOG_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
} else {
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._BLOG_MOD_NOACC."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=blog&file=index\"><B>"._BLOG_MOD_BACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}
}
else if($op == "article_del"){
	//////////////////////////////////////////// กรณีลบ Form
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE id='".$_GET['id']."' ");
		$arr['blog'] = $db->fetch($res['blog']);
		$db->closedb ();

if ($admin_user==$arr['blog']['posted']){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_BLOG," id='".$_GET['id']."' "); 
		$db->closedb ();
		if($_GET['pic'] !='0') {
		@unlink("icon/blog_".$_GET['prefix'].".jpg");
		}
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._BLOG_MOD_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=blog&file=blog\"><B>"._BLOG_MOD_BLOG."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
} else {
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._BLOG_MOD_NODEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=blog&file=index\"><B>"._BLOG_MOD_INDEX."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}
}
?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
					</TD>
				</TR>
			</TABLE>
