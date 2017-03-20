<?
CheckAdmin($admin_user, $admin_pwd);
include ("editor.php");
empty($_POST['ENABLE_COMMENT'])?$ENABLE_COMMENT="":$ENABLE_COMMENT=$_POST['ENABLE_COMMENT'];
?>

	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=5 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp;  blog  </B>
					<BR><BR>
					<A HREF="?name=admin&file=blog"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_BLOG_MENU_ALL_BLOG;?> </A>  &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=blog_editlevel"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_BLOG_MENU_EDIT_LEVEL;?></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=blog_category"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_MENU_DTAIL_CAT;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=blog_category&op=articlecat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_MENU_ADD_CAT;?></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=blog&op=edit_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_BLOG_MENU_ADD_MEM;?></A><BR><BR>
<?
//////////////////////////////////////////// แสดงรายการ blog  
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_BLOG,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=blog&op=article_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="44"><CENTER><B>Option</B></CENTER></td>
   <td><CENTER><B><?=_ADMIN_TABLE_TITLE_TOPIC;?></B></CENTER></td>
   <td width="100"><CENTER><B><?=_ADMIN_TABLE_TITLE_POSTED;?></B></CENTER></td>
   <td width="40"><CENTER><B><?=_ADMIN_TABLE_TITLE_CAT;?></B></CENTER></td>
   <td width="40"><CENTER><B>Check</B></CENTER></td>
  </tr>  
<?
$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['blog'] = $db->fetch($res['blog'])){
	$res['category'] = $db->select_query("SELECT * FROM ".TB_BLOG_CAT." WHERE id='".$arr['blog']['category']."' ");
	$arr['category'] = $db->fetch($res['category']);
	//Comment Icon
	if($arr['blog']['enable_comment']){
		$CommentIcon = " <IMG SRC=\"images/icon/comments-icon.jpg\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_ALLOW_COMMENT."\">";
	}else{
		$CommentIcon = "";
	}
	if($arr['blog']['pic']==1){
		$PicIcon = " <A HREF=icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg class=\"highslide\" onclick=\"return hs.expand(this)\"><IMG SRC=\"images/preview.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_PICTURE."\"></a>";
	}else{
		$PicIcon = "";
	}
	if($arr['blog']['attach'] !=''){
		$AttIcon = " <a href=attach/blog_".$arr['blog']['attach']."><IMG SRC=\"images/attach.gif\" WIDTH=\"8\" HEIGHT=\"13\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_FILE_ATT."\"></a>";
	}else{
		$AttIcon = "";
	}
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=blog&op=article_edit&id=<? echo $arr['blog']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=blog&op=article_del&id=<? echo $arr['blog']['id'];?>&prefix=<? echo $arr['blog']['post_date'];?>','<? echo _ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><A HREF="?name=blog&file=readblog&id=<?echo $arr['blog']['id'];?>" target="_blank"><?echo $arr['blog']['topic'];?></A><?=$CommentIcon;?><?=$PicIcon;?><?=$AttIcon;?><?=NewsIcon(TIMESTAMP, $arr['blog']['post_date'], "images/icon_new.gif");?></td>
     <td ><CENTER><?echo ThaiTimeConvert($arr['blog']['post_date'],'','');?></CENTER></td>
     <td align="center">
	 <?if($arr['category']['category_name']){ //หากมีหมวดแสดงรูป ?>
	 <A HREF="#"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle" alt="<?echo $arr['category']['category_name'];?>" onMouseOver="MM_displayStatusMsg('<?echo $arr['category']['category_name'];?>');return document.MM_returnValue"></A>
	 <? } ?>
	 </td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<? echo $arr['blog']['id'];?>"></td>
    </tr>

<?
	$count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="article_del" >
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=admin&file=blog");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}

else if($op == "article_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE id='".$_GET['id']."' ");
		$arr['blog'] = $db->fetch($res['blog']);
		$db->closedb ();

		$FILE = $_FILES['FILE'];
		$FILESS=$_FILES['FILESS'];
		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_CAPTCHA_NOACC."')" ;
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
	if($arr['blog']['pic'] ==1){
	$pic='1';} else {
	$pic='0';
	}
}
if ($FILESS['name']) {
		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_BLOG,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"post_date"=>"".$arr['blog']['post_date']."",
			"update_date"=>"".$arr['blog']['post_date']."",
			"attach"=>"".$arr['blog']['post_date']."_".$FILESS['name']."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT.""
		)," id='".$_GET['id']."' ");
		$db->closedb ();
	@copy ($FILESS['tmp_name'] , "attach/blog_".$arr['blog']['post_date']."_".$FILESS['name']."");
} else {

		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_BLOG,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"update_date"=>"".$arr['blog']['post_date']."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT.""
		)," id='".$_GET['id']."' ");
		$db->closedb ();
}

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOG_MESSAGE_SUCCESS."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=blog\"><B>"._ADMIN_BLOG_MESSAGE_GOBACK." </B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}

else if($op == "article_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE id='".$_GET['id']."' ");
		$arr['blog'] = $db->fetch($res['blog']);
		$db->closedb ();

		$TextContent = $arr['blog']['detail'];
		$TextContent = stripslashes($TextContent);
		$HEADLINE = $arr['blog']['headline'];
		$HEADLINE= stripslashes($HEADLINE);
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=blog&op=article_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
<B><?=_ADMIN_FORM_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="80" value="<?=$arr['blog']['topic'];?>">
<BR><BR>
<B><?=_ADMIN_FORM_CAT;?> :</B><BR>
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
<B><?=_ADMIN_FORM_ICON;?> : </B><BR>
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
<?=_ADMIN_FORM_ICON_WIDTH;?> <?echo _Iblog_W." x "._Iblog_H ;?> <?=_ADMIN_FORM_ICON_WIDTH1;?>
<BR><BR>
<B><?=_ADMIN_FORM_HEADLINE;?> :</B><BR>
<textarea cols="100"  rows="10"  name="HEADLINE" ><?=$HEADLINE;?></textarea>
<BR><BR>

<B><?=_ADMIN_FORM_DETAIL;?> :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ><?=$TextContent;?></textarea>
<br>
<B><?=_ADMIN_FORM_FILE_ATT;?> : </B><BR>
<input type="file" name="FILESS" onpropertychange="view01.src=FILESS.value;" style="width=250;"><br>
<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1" <?if($arr['blog']['enable_comment']){echo " Checked";};?>> <?=_ADMIN_FORM_ALLOW_COMMENT;?>
<BR>
<input type="submit" value="<?=_ADMIN_BUTTON_EDIT;?>" name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}

}
else if($op == "article_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE id='".$value."' ");
			$arr['blog'] = $db->fetch($res['blog']);
			if($arr['blog']['pic'] =='0') {
			$db->del(TB_BLOG," id='".$value."' "); 
			$db->closedb ();
			} else {
			$db->del(TB_BLOG," id='".$value."' "); 
			$db->closedb ();
			@unlink("icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg");
			}
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOG_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=blog\"><B>"._ADMIN_BLOG_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "article_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." WHERE id='".$_GET['id']."' ");
		$arr['blog'] = $db->fetch($res['blog']);
		if($arr['blog']['pic'] !='0') {
		@unlink("icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg");
		}
		$db->del(TB_BLOG," id='".$_GET['id']."' "); 
		$db->closedb ();

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOG_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=blog\"><B>"._ADMIN_BLOG_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "edit_add" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไขสิทธิ์ของผู้เขียน blog

		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_MEMBER,array(
			"blog"=>"".$_GET['status'].""
		)," member_id='".$_GET['id']."' ");
		$db->closedb ();

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOG_MESSAGE_ADD_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=blog\"><B>"._ADMIN_BLOG_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	echo $ProcessOutput ;
}
else if($op == "edit_add" ){
	//////////////////////////////////////////// กรณีแก้ไขสิทธิ์ของผู้เขียน blog

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 30 ;
	$SUMPAGE= $db->num_rows(TB_MEMBER,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=blog&op=edit_add&action=edit" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr  class="odd">
   <td width="44"><CENTER><B>Option</B></CENTER></td>
      <td ><CENTER><B><?=_MEMBER_MOD_FORM_USER_NAME;?></B></CENTER></td>
   <td width="60"><CENTER><B>Email</B></td>
     <td width="160"><CENTER><B><?=_MEMBER_MOD_FORM_USER_WORK;?></B></CENTER></td>
      <td width="80"><CENTER><B><?=_MEMBER_MOD_MEMDETAIL_PHONE;?></B></CENTER></td>
   <td width="40"><CENTER><B>Blog</B></CENTER></td>
  </tr>  
<?
$count=0;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." ORDER BY id DESC LIMIT $goto, $limit ");
while($arr['user'] = $db->fetch($res['user'])){

if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
 <a href="?name=admin&file=member_edit&member_id=<?=$arr['user']['member_id'];?>"><img src="images/admin/edit.gif" border="0" alt="<? echo _ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=member_delete&member_id=<?=$arr['user']['member_id'];?>&prefix=<? echo $arr['block']['post_date'];?>','<? echo _ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?echo _ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
	<td><?php echo $arr['user']['name'] ; ?></td>
	<td><?php echo $arr['user']['email'] ; ?></td>
	<td><?php echo $arr['user']['work'] ; ?></td>
	<td><?php echo $arr['user']['phone'] ; ?></td>
	<td align="center">
				  <? if($arr['user']['blog']=='0') { echo "<a HREF=?name=admin&file=blog&op=edit_add&action=edit&id=".$arr['user']['member_id']."&status=1><img src=images/publish_x.png alt='"._ADMIN_BLOCK_ORDER_PUBLISH_OFF."'></a>"; } else { echo "<a HREF=?name=admin&file=blog&op=edit_add&action=edit&id=".$arr['user']['member_id']."&status=0><img src=images/tick.png alt='่"._ADMIN_BLOCK_ORDER_PUBLISH_ON."'></a>"; };?>
</td>
    </tr>

<?
		 $count++;
 } 
?>
 </table>
 </form>
<?

}

?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
