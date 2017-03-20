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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_KNOWLEDGE_MENU_INDEX;?> </B>
					<BR><BR>
					<A HREF="?name=admin&file=knowledge"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_KNOWLEDGE_MENU_LISTALL;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=knowledge&op=article_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_KNOWLEDGE_MENU_ADD_NEW;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=knowledge_category"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_MENU_DTAIL_CAT;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=knowledge_category&op=articlecat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"><?=_ADMIN_MENU_ADD_CAT;?></A><BR><BR>
<?
//////////////////////////////////////////// แสดงรายการสาระน่ารู้ 
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_KNOWLEDGE,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=knowledge&op=article_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="44"><CENTER><B>Option</B></CENTER></td>
   <td><CENTER><B><?=_ADMIN_TABLE_TITLE_TOPIC;?></B></CENTER></td>
   <td width="100"><CENTER><B><?=_ADMIN_TABLE_TITLE_POSTED;?></B></CENTER></td>
   <td width="40"><CENTER><B><?=_ADMIN_TABLE_TITLE_CAT;?></B></CENTER></td>
   <td width="40"><CENTER><B>Check</B></CENTER></td>
  </tr>  
<?
$res['knowledge'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['knowledge'] = $db->fetch($res['knowledge'])){
	$res['category'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE_CAT." WHERE id='".$arr['knowledge']['category']."' ");
	$arr['category'] = $db->fetch($res['category']);
	//Comment Icon
	if($arr['knowledge']['enable_comment']){
		$CommentIcon = " <IMG SRC=\"images/icon/comments-icon.jpg\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_ALLOW_COMMENT."\">";
	}else{
		$CommentIcon = "";
	}
	if($arr['knowledge']['pic']==1){
		$PicIcon = " <A HREF=icon/knowledge_".$arr['knowledge']['post_date'].".jpg class=\"highslide\" onclick=\"return hs.expand(this)\"><IMG SRC=\"images/preview.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_PICTURE."\"></a>";
	}else{
		$PicIcon = "";
	}
	if($arr['knowledge']['attach'] !=''){
		$AttIcon = " <a href=attach/knowledge_".$arr['knowledge']['attach']."><IMG SRC=\"images/attach.gif\" WIDTH=\"8\" HEIGHT=\"13\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._ADMIN_LINK_FILE_ATT."\"></a>";
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
      <a href="?name=admin&file=knowledge&op=article_edit&id=<? echo $arr['knowledge']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=knowledge&op=article_del&id=<? echo $arr['knowledge']['id'];?>&pic=<? echo $arr['knowledge']['pic'];?>&prefix=<? echo $arr['knowledge']['post_date'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><A HREF="?name=knowledge&file=readknowledge&id=<?echo $arr['knowledge']['id'];?>" target="_blank"><?echo $arr['knowledge']['topic'];?></A><?=$CommentIcon;?><?=$PicIcon;?><?=$AttIcon;?><?=NewsIcon(TIMESTAMP, $arr['knowledge']['post_date'], "images/icon_new.gif");?></td>
     <td ><CENTER><?echo ThaiTimeConvert($arr['knowledge']['post_date'],'','');?></CENTER></td>
     <td align="center">
	 <?if($arr['category']['category_name']){ //หากมีหมวดแสดงรูป ?>
	 <A HREF="#"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle" alt="<?echo $arr['category']['category_name'];?>" onMouseOver="MM_displayStatusMsg('<?echo $arr['category']['category_name'];?>');return document.MM_returnValue"></A>
	 <? } ?>
	 </td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<? echo $arr['knowledge']['id'];?>"></td>
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
	SplitPage($page,$totalpage,"?name=admin&file=knowledge");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "article_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){

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
			@copy ($FILE['tmp_name'] , "icon/knowledge_".TIMESTAMP.".jpg" );
			$original_image = "icon/knowledge_".TIMESTAMP.".jpg" ;
			$desired_width = _IKNOW_W ;
			$desired_height = _IKNOW_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/knowledge_".TIMESTAMP.".jpg", "JPG");
		}
	$pic='1';
} else {
	$pic='0';
}

if ($FILESS['name']) {
		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_KNOWLEDGE,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$_SESSION['admin_user']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"attach"=>"".TIMESTAMP."_".$FILESS['name']."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT.""
		));
		$db->closedb ();
	@copy ($FILESS['tmp_name'] , "attach/knowledge_".TIMESTAMP."_".$FILESS['name']."");
} else {

		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_KNOWLEDGE,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$_SESSION['admin_user']."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT.""
		));
		$db->closedb ();
}


		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_KNOWLEDGE_MESSAGE_ADD."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=knowledge\"><B>"._ADMIN_KNOWLEDGE_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "article_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=knowledge&op=article_add&action=add" enctype="multipart/form-data">
<B><?=_ADMIN_FORM_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="50">
<BR><BR>
<B><?=_ADMIN_FORM_CAT;?> :</B><BR>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?=_ADMIN_FORM_ICON;?> : </B><BR>
<IMG name="view01" SRC="images/knowledge_blank.gif" <?echo " WIDTH=\""._IKNOW_W."\" HEIGHT=\""._IKNOW_H."\" ";?> BORDER="0" ><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_ADMIN_FORM_ICON_WIDTH;?> <?echo _IKNOW_W." x "._IKNOW_H ;?> <?=_ADMIN_FORM_ICON_WIDTH1;?>
<BR><BR>

<B><?=_ADMIN_FORM_HEADLINE;?> :</B><BR>
<textarea cols="100"  rows="10"  name="HEADLINE" ></textarea>

<BR><BR>

<B><?=_ADMIN_FORM_DETAIL;?> :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ></textarea>
<BR>
<B><?=_ADMIN_FORM_FILE_ATT;?> : </B><BR>
<input type="file" name="FILESS" onpropertychange="view01.src=FILESS.value;" style="width=250;">
<br>
<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1"> <?=_ADMIN_FORM_ALLOW_COMMENT;?>
<BR>
<input type="submit" value="<?=_ADMIN_KNOWLEDGE_BUTTON_ADD;?>" name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "article_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['knowledge'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE." WHERE id='".$_GET['id']."' ");
		$arr['knowledge'] = $db->fetch($res['knowledge']);
		$db->closedb ();

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
			@copy ($FILE['tmp_name'] , "icon/knowledge_".$arr['knowledge']['post_date'].".jpg" );
			$original_image = "icon/knowledge_".$arr['knowledge']['post_date'].".jpg" ;
			$desired_width = _IKNOW_W ;
			$desired_height = _IKNOW_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/knowledge_".$arr['knowledge']['post_date'].".jpg", "JPG");
	$pic='1';
} else {
	if($arr['knowledge']['pic'] ==1){
	$pic='1';} else {
	$pic='0';
	}
}

if ($FILESS['name']) {
		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_KNOWLEDGE,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$_SESSION['admin_user']."",
			"post_date"=>"".$arr['knowledge']['post_date']."",
			"update_date"=>"".$arr['knowledge']['post_date']."",
			"attach"=>"".$arr['knowledge']['post_date']."_".$FILESS['name']."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT.""
		)," id=".$_GET['id']."");
		$db->closedb ();
	@copy ($FILESS['tmp_name'] , "attach/knowledge_".$arr['knowledge']['post_date']."_".$FILESS['name']."");
} else {

		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_KNOWLEDGE,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".$_POST['HEADLINE']."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$_SESSION['admin_user']."",
			"update_date"=>"".$arr['knowledge']['post_date']."",
			"pic"=>"".$pic."",
			"enable_comment"=>"".$ENABLE_COMMENT.""
		)," id=".$_GET['id']."");
		$db->closedb ();
}

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_KNOWLEDGE_MESSAGE_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=knowledge\"><B>"._ADMIN_KNOWLEDGE_MESSAGE_GOBACK."</B></A>";
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
		$res['knowledge'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE." WHERE id='".$_GET['id']."' ");
		$arr['knowledge'] = $db->fetch($res['knowledge']);
		$TextContent = $arr['knowledge']['detail'];
		$TextContent = stripslashes($TextContent);
		$HEADLINE = $arr['knowledge']['headline'];
		$HEADLINE= stripslashes($HEADLINE);
		$db->closedb ();
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=knowledge&op=article_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
<B><?=_ADMIN_FORM_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="50" value="<?=$arr['knowledge']['topic'];?>">
<BR><BR>
<B><?=_ADMIN_FORM_CAT;?> :</B><BR>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   if($arr['category']['id'] == $arr['knowledge']['category']){echo " Selected";}
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?=_ADMIN_FORM_ICON;?> : </B><BR>
<?
	if ($arr['knowledge']['pic'] !=0){?>
<IMG name="view01" SRC="icon/knowledge_<?=$arr['knowledge']['post_date'];?>.jpg" <?echo " WIDTH=\""._IKNOW_W."\" HEIGHT=\""._IKNOW_H."\" ";?> BORDER="0" >
<?} else {?>
<IMG name="view01" SRC="images/news_blank.gif" <?echo " WIDTH=\""._IKNOW_W."\" HEIGHT=\""._IKNOW_H."\" ";?> BORDER="0" >
<?
	}
?>
<BR>

<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_ADMIN_FORM_ICON_WIDTH;?> <?echo _IKNOW_W." x "._IKNOW_H ;?> <?=_ADMIN_FORM_ICON_WIDTH1;?>
<BR><BR>
<B><?=_ADMIN_FORM_HEADLINE;?> :</B><BR>
<textarea cols="100"  rows="10"  name="HEADLINE" ><?=$HEADLINE;?></textarea>
<BR><BR>
<B><?=_ADMIN_FORM_DETAIL;?> :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ><?=$TextContent;?></textarea>
<BR>
<B><?=_ADMIN_FORM_FILE_ATT;?> : </B><BR>
<input type="file" name="FILESS" onpropertychange="view01.src=FILESS.value;" style="width=250;"><br>
<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1" <?if($arr['knowledge']['enable_comment']){echo " Checked";};?>> <?=_ADMIN_FORM_ALLOW_COMMENT;?>
<BR>
<input type="submit" value="<?=_ADMIN_KNOWLEDGE_BUTTON_EDIT;?>" name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
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
			$res['knowledge'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE." WHERE id='".$value."' ");
			$arr['knowledge'] = $db->fetch($res['knowledge']);
			$db->del(TB_KNOWLEDGE," id='".$value."' "); 
			$db->closedb ();
			@unlink("icon/knowledge_".$arr['knowledge']['post_date'].".jpg");
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_KNOWLEDGE_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=knowledge\"><B>"._ADMIN_KNOWLEDGE_MESSAGE_GOBACK."</B></A>";
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
		$db->del(TB_KNOWLEDGE," id='".$_GET['id']."' "); 
		$db->closedb ();
		if($_GET['pic'] !='0') {
		@unlink("icon/knowledge_".$arr['knowledge']['post_date'].".jpg");
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_KNOWLEDGE_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=knowledge\"><B>"._ADMIN_KNOWLEDGE_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
