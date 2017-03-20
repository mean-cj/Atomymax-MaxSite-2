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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_DOWNLOAD_MENU_TITLE;?> </B>
					<BR><BR>
					<A HREF="?name=admin&file=download"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_DOWNLOAD_MENU_LISTALL;?> </A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=download&op=download_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_DOWNLOAD_MENU_ADD_NEW;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=download_category"><IMG SRC="images/admin/folders.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_DOWNLOAD_MENU_LISTCAT;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=download_category&op=downloadcat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"><?=_ADMIN_DOWNLOAD_MENU_ADD_NEW_CAT;?></A><BR><BR>
<?
//////////////////////////////////////////// แสดงรายการ download  
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_DOWNLOAD,"id","");
	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=download&op=download_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="55"><CENTER><B><?=_ADMIN_DOWNLOAD_TABLE_HEADER_NUM;?></B></CENTER></td>
   <td align=center><CENTER><B><?=_ADMIN_DOWNLOAD_TABLE_HEADER_TOPIC;?></B></CENTER></td>
   <td width="50"><CENTER><B>size</B></CENTER></td>
      <td width="60"><CENTER><B>download</font></CENTER></td>
   <td width="100"><CENTER><B><?=_ADMIN_TABLE_TITLE_CAT;?></B></CENTER></td>
   <td width="50"><CENTER><B><?=_ADMIN_LINK_FILE_ATT;?></B></CENTER></td>
      <td width="50"><CENTER><B><?=_ADMIN_DOWNLOAD_TABLE_HEADER_STATUS;?></B></CENTER></td>
   <td width="40"><CENTER><B>Check</B></CENTER></td>
  </tr>  
<?
$res['download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['download'] = $db->fetch($res['download'])){
	$res['category'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD_CAT." WHERE id='".$arr['download']['category']."' ");
	$arr['category'] = $db->fetch($res['category']);
	//Comment Icon
	if($arr['download']['enable_comment']){
		$CommentIcon = " <IMG SRC=\"images/icon/suggest.gif\" WIDTH=\"13\" HEIGHT=\"9\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{
		$CommentIcon = "";
	}
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44" >
      <a href="?name=admin&file=download&op=download_edit&id=<? echo $arr['download']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=download&op=download_del&id=<? echo $arr['download']['id'];?>&prefix=<? echo $arr['download']['post_date'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td  valign="top"><A HREF="?name=download&file=readdownload&id=<?echo $arr['download']['id'];?>" target="_blank"><?echo $arr['download']['topic'];?></A><?=$CommentIcon;?><?=NewsIcon(TIMESTAMP, $arr['download']['post_date'], "images/icon_new.gif");?><font color="#CC3300">(<?echo ThaiTimeConvert($arr['download']['post_date'],'','');?> || <?=_FORM_MOD_READX;?> : <?=$arr['download']['pageview'];?>  ) <?=_FORM_MOD_POSTED;?> <?=$arr['download']['posted'];?></font></td>
	      <td align="center"  valign="top">
<?	
	$bytes=$arr['download']['size'];
	echo getfilesize($bytes) ;?> 
		  </td>
		  	      <td align="center"  valign="top">
				  <?=$arr['download']['rate'];?>
				  </td>
     <td align="center"  valign="top">
	 <?if($arr['category']['category_name']){ //หากมีหมวดแสดงรูป ?>
	 <A HREF="#"><?echo $arr['category']['category_name'];?></A>
	 <? } ?>
	 </td>
     <td align="center"  valign="top">
		  <A HREF="popup.php?name=download&file=rate&id=<?=$arr['download']['id']; ?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )" class="highslide">
		  <? 
	 if ($arr['download']['type']=="application/pdf") {
		 ?>
		  <img src="modules/download/images/pdf.gif" border="0" >
		  <?
	 } else if ($arr['download']['type']=="application/msword") {
		 ?>
		  <img src="modules/download/images/word.gif" border="0" >
		  <?
		 } else if ($arr['download']['type']=="application/vnd.ms-excel") {
		 ?>
		  <img src="modules/download/images/excel.gif" border="0" >
		  <?
		 }else if ($arr['download']['type']=="application/vnd.ms-powerpoint") {
		 ?>
		  <img src="modules/download/images/powerpoint.gif" border="0" >
		  <?
		 }else if ($arr['download']['type']=="image/gif" || $arr['download']['type']=="image/jpg"|| $arr['download']['type']=="image/jpeg"|| $arr['download']['type']=="image/x-png" ) {
		 ?>
		  <img src="modules/download/images/pics.gif" border="0" >
		  <?
		 }else if ($arr['download']['type']=="application/x-zip-compressed" ) {
		 ?>
		  <img src="modules/download/images/zip.gif" border="0" >
		  <?
		 }else {
		 ?>
		  <img src="modules/download/images/stuff3.gif" border="0" >
		  <?
		 }

		 ?>

		  </a>
	 </td>
		  	      <td align="center"  valign="top">
				  <? if($arr['download']['status']=='0') { echo "<a HREF=?name=admin&file=download&op=download_update&action=update&id=".$arr['download']['id']."&status=1><img src=images/publish_x.png alt='"._ADMIN_BLOCK_ORDER_PUBLISH_OFF."'></a>"; } else { echo "<a HREF=?name=admin&file=download&op=download_update&action=update&id=".$arr['download']['id']."&status=0><img src=images/tick.png alt='่"._ADMIN_BLOCK_ORDER_PUBLISH_ON."'></a>"; };?>
				  </td>
	     <td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<? echo $arr['download']['id'];?>"></td>
    </tr>

<?
			  $count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="download_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=admin&file=download");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "download_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){

		require("includes/class.resizepic.php");
		$FILE = $_FILES['FILE'];
		$FILES = $_FILES['filesw'];
		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL'] OR !$FILE['type']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
		if (($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}else{
			@copy ($FILE['tmp_name'] , "icon/download_".TIMESTAMP.".jpg" );
			$original_image = "icon/download_".TIMESTAMP.".jpg" ;
			$desired_width = _Idownload_W ;
			$desired_height = _Idownload_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/download_".TIMESTAMP.".jpg", "JPG");
		}
//echo $filesw_name;
		if ($FILES['tmp_name'])
{
//			print ("Local File : $FILES['name'] <br> \n");
//print ("Name : $FILES['name'] \n");
//print ("Size : $FILES['size'] byte \n");
//print ("Type : $FILES['type']  \n");

               if ( $upload=copy( $FILES['tmp_name'], "data/download_".TIMESTAMP."_".$FILES['name']."")) {
                }else{
                        print "<center><font color='red'>"._DOWNLOAD_MOD_ERROR1."".$FILES['name']." "._DOWNLOAD_MOD_ERROR2."</font></center><br>";
                }
//              unlink($filesw);
			  		//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_DOWNLOAD,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".addslashes(htmlspecialchars($_POST['HEADLINE']))."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"full_text"=>"".TIMESTAMP."_".$FILES['name']."",
			"type"=>"".$FILES['type']."",
			"size"=>"".$FILES['size'].""
		));
		$db->closedb ();
} else {
			//ทำการเพิ่มข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_DOWNLOAD,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".addslashes(htmlspecialchars($_POST['HEADLINE']))."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"post_date"=>"".TIMESTAMP."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT.""));
		$db->closedb ();
}

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_DOWNLOAD_MESSAGE_ADD."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=download\"><B>"._ADMIN_DOWNLOAD_MESSAGE_GOBACK."  </B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "download_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=download&op=download_add&action=add" enctype="multipart/form-data" id="myform">
<B><?=_ADMIN_FORM_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="50">
<BR><BR>
<B><?=_ADMIN_FORM_CAT;?> :</B><BR>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?=_ADMIN_DOWNLOAD_FORM_SAMPLE_PIC;?> : </B><BR>
<IMG name="view01" SRC="images/news_blank.gif" <?echo " WIDTH=\""._Idownload_W."\" HEIGHT=\""._Idownload_H."\" ";?> BORDER="0" ><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_ADMIN_FORM_ICON_WIDTH;?> <?echo _Idownload_W." x "._Idownload_H ;?> <?=_ADMIN_FORM_CAT_ICON_WIDTH;?>
<BR><BR>
<B><?=_ADMIN_FORM_HEADLINE;?> :</B><BR>
<textarea cols="100"  rows="10"  name="HEADLINE" ></textarea>

<BR><BR>
<B><?=_ADMIN_FORM_DETAIL;?> :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ></textarea>
<BR>
<br><font face="MS Sans serif" ><b><?=_ADMIN_LINK_FILE_ATT;?>  : <input type="file" name="filesw" maxlength ="50" size="50"><font face="MS Sans serif"><br>

<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1"> <?=_ADMIN_FORM_ALLOW_COMMENT;?>
<BR>
<input type="submit" value=" <?=_ADMIN_DOWNLOAD_FORM_BUTTON_ADD;?>  " name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "download_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." WHERE id='".$_GET['id']."' ");
		$arr['download'] = $db->fetch($res['download']);
		$db->closedb ();

		$FILE = $_FILES['FILE'];
		$FILES = $_FILES['filesw'];
		if (!$_POST['CATEGORY'] OR !$_POST['TOPIC'] OR !$_POST['HEADLINE'] OR !$_POST['DETAIL']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_DATA_NULL."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}
		if ($FILE['tmp_name'] !=''){
		if ((($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")) AND $FILE['size']){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.back()</script>";
			exit();
		}else{
		require("includes/class.resizepic.php");
			@copy ($FILE['tmp_name'] , "icon/download_".$arr['download']['post_date'].".jpg" );
			$original_image = "icon/download_".$arr['download']['post_date'].".jpg" ;
			$desired_width = _Idownload_W ;
			$desired_height = _Idownload_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/download_".$arr['download']['post_date'].".jpg", "JPG");
			}
		}

		if ($FILES['tmp_name'] != '' )
{

@unlink("data/download_".$arr['download']['full_text']);
               if ( $upload=copy( $FILES['tmp_name'], "data/download_".TIMESTAMP."_".$FILES['name']."")) {
                }else{
                        print "<center><font color='red'>"._ADMIN_DOWNLOAD_FORM_ERROR_UPLOAD." ".$FILES['name']." "._ADMIN_DOWNLOAD_FORM_ERROR_UPLOAD1."</font></center><br>";
                }

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_DOWNLOAD,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".addslashes(htmlspecialchars($_POST['HEADLINE']))."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT."",
			"full_text"=>"".TIMESTAMP."_".$FILES['name']."",
			"type"=>"".$FILES['type']."",
			"size"=>"".$FILES['size'].""
		)," id='".$_GET['id']."' ");
		$db->closedb ();

} else {
		//ทำการแก้ไขข้อมูลลงดาต้าเบส
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_DOWNLOAD,array(
			"category"=>"".$_POST['CATEGORY']."",
			"topic"=>"".addslashes(htmlspecialchars($_POST['TOPIC']))."",
			"headline"=>"".addslashes(htmlspecialchars($_POST['HEADLINE']))."",
			"detail"=>"".$_POST['DETAIL']."",
			"posted"=>"".$admin_user."",
			"update_date"=>"".TIMESTAMP."",
			"enable_comment"=>"".$ENABLE_COMMENT.""
		)," id='".$_GET['id']."' ");
		$db->closedb ();
}

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_DOWNLOAD_MESSAGE_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=download\"><B>"._ADMIN_DOWNLOAD_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
		echo $ProcessOutput ;
}
else if($op == "download_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." WHERE id='".$_GET['id']."' ");
		$arr['download'] = $db->fetch($res['download']);
		$TextContent = $arr['download']['detail'];
		$TextContent = stripslashes($TextContent);
		$HEADLINE = $arr['download']['headline'];
		$HEADLINE= stripslashes($HEADLINE);
		$db->closedb ();
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=download&op=download_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
<B><?=_ADMIN_FORM_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="TOPIC" size="100" value="<?=$arr['download']['topic'];?>">
<BR><BR>
<B><?=_ADMIN_FORM_CAT;?> :</B><BR>
<SELECT NAME="CATEGORY">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD_CAT." ORDER BY sort ");
while ($arr['category'] = $db->fetch($res['category'])){
	   echo "<option value=\"".$arr['category']['id']."\"";
	   if($arr['category']['id'] == $arr['download']['category']){echo " Selected";}
	   echo ">".$arr['category']['category_name']."</option>";
}
$db->closedb ();
?>
</SELECT>
<BR><BR>
<B><?=_ADMIN_DOWNLOAD_FORM_SAMPLE_PIC;?> :</B><BR>
<IMG name="view01" SRC="icon/download_<?=$arr['download']['post_date'];?>.jpg" <?echo " WIDTH=\""._Idownload_W."\" HEIGHT=\""._Idownload_H."\" ";?> BORDER="0" ><BR>
<input type="file" name="FILE" onpropertychange="view01.src=FILE.value;" style="width=250;"><BR>
<?=_ADMIN_FORM_ICON_WIDTH;?> <?echo _Idownload_W." x "._Idownload_H ;?> <?=_ADMIN_FORM_CAT_ICON_WIDTH;?>
<BR><BR>
<B><?=_ADMIN_FORM_HEADLINE;?> :</B><BR>
<textarea cols="100"  rows="10"  name="HEADLINE" ><?=$HEADLINE;?></textarea>
<BR><BR>
<B><?=_ADMIN_FORM_DETAIL;?> :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ><?=$TextContent;?></textarea>
<BR>
<br><font face="MS Sans serif" ><b><?=_ADMIN_LINK_FILE_ATT;?>  : <input type="file" name="filesw" maxlength ="50" size="50"><font face="MS Sans serif"><br>
<INPUT TYPE="checkbox" NAME="ENABLE_COMMENT" VALUE="1" <?if($arr['download']['enable_comment']==1){echo 'checked="Checked"';};?>> <?=_ADMIN_FORM_ALLOW_COMMENT;?>
<BR>
<input type="submit" value=" <?=_ADMIN_DOWNLOAD_FORM_BUTTON_EDIT;?> " name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
}
else if($op == "download_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." WHERE id='".$value."' ");
			$arr['download'] = $db->fetch($res['download']);
			$db->del(TB_DOWNLOAD," id='".$value."' "); 

			@unlink("icon/download_".$arr['download']['post_date'].".jpg");
			@unlink("data/download_".$arr['download']['full_text']);
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_DOWNLOAD_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=download\"><B>"._ADMIN_DOWNLOAD_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "download_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//		$db->del(TB_DOWNLOAD," id='".$_GET['id']."' ");
			$res['download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." WHERE id='".$_GET['id']."' ");
			$arr['download'] = $db->fetch($res['download']);
			$db->del(TB_DOWNLOAD," id='".$_GET['id']."' "); 
		    $db->closedb ();
			@unlink("icon/download_".$arr['download']['post_date'].".jpg");
			@unlink("data/download_".$arr['download']['full_text']);

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_DOWNLOAD_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=download\"><B>"._ADMIN_DOWNLOAD_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "download_update" AND $action == "update"){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_DOWNLOAD,array(
			"status"=>"".$_GET['status'].""
		)," id='".$_GET['id']."'");
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_DOWNLOAD_MESSAGE_UPDATE."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=download\"><B>"._ADMIN_DOWNLOAD_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=download'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

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
