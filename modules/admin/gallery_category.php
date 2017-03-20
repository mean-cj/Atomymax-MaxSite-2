<?
CheckAdmin($admin_user, $admin_pwd);
?>
<?include ("editor.php");?>
	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_gallery.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; GALLERY </B>
					<BR><BR>
					<A HREF="?name=admin&file=gallery"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_GALLERY_MENU_LIST;?> </A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=gallery&op=gallery_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_GALLERY_MENU_ADD_NEW;?> </A>  &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=gallery_category&op=gallerycat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_GALLERY_MENU_ADD_CAT;?></A><BR><BR>
<?
//////////////////////////////////////////// แสดงรายการ
 if($op == "gallerycat_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
		//เช็คว่า id ตอนนี้เป็นอะไร
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['gallerycat'] = $db->select_query("SELECT sort FROM ".TB_GALLERY_CAT." ORDER BY sort DESC ");
		$arr['gallerycat'] = mysql_fetch_array($res['gallerycat']);
		$SORTID = $arr['gallerycat']['sort']+1 ;
		//เพิ่มข้อมูลลงดาต้าเบส

		$db->add_db(TB_GALLERY_CAT,array(
			"category_name"=>"".addslashes(htmlspecialchars($_POST['CATEGORY']))."",
			"category_detail"=>"".$_POST['DETAIL']."",
			"post_date"=>"".TIMESTAMP."",
			"sort"=>"$SORTID"
		));
		$db->closedb ();
		umask(0);
		mkdir("images/gallery/gal_".TIMESTAMP."");
		chmod ("images/gallery/gal_".TIMESTAMP."",0777);
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GALLERY_MESSAGE_ADD_CAT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=gallery\"><B>"._ADMIN_GALLERY_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "gallerycat_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM METHOD=POST ACTION="?name=admin&file=gallery_category&op=gallerycat_add&action=add" enctype="multipart/form-data">
<B><?=_ADMIN_FORM_CAT_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="CATEGORY" size="40">
<BR><BR>
<B><?=_ADMIN_FORM_HEADLINE;?> :</B><BR>
<textarea cols="50" id="editor1" rows="50"  class="ckeditor1" NAME="DETAIL" ></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'AdminBasic'});</script>
<BR><BR>
<INPUT TYPE="submit" value="<?=_ADMIN_GALLERY_BUTTON_ADD_CAT;?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "gallerycat_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database
	if(CheckLevel($admin_user,$op)){
		//แก้ไขข้อมูลลงดาต้าเบส
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_GALLERY_CAT,array(
			"category_name"=>"".addslashes(htmlspecialchars($_POST['CATEGORY']))."",
			"category_detail"=>"".$_POST['DETAIL'].""
		)," id=".$_GET['id']." ");
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GALLERY_MESSAGE_EDIT_CAT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=gallery\"><B>"._ADMIN_GALLERY_MESSAGE_GOBACK." </B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "gallerycat_edit" AND $action == "sort"){
	//////////////////////////////////////////// Set Sort
	if(CheckLevel($admin_user,$op)){
		//กรณีเลื่อนขึ้น
		if($_GET['move'] == "up"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_GALLERY_CAT." SET sort = sort+1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_GALLERY_CAT." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		if($_GET['move'] == "down"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_GALLERY_CAT." SET sort = sort-1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_GALLERY_CAT." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GALLERY_MESSAGE_EDIT_CAT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=gallery\"><B>"._ADMIN_GALLERY_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "gallerycat_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['gallerycat'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT." WHERE id='".$_GET['id']."' ");
		$arr['gallerycat'] = $db->fetch($res['gallerycat']);
		//echo $arr['gallerycat']['icon'];
		$DETAIL = $arr['gallerycat']['category_detail'];
		$DETAIL= stripslashes($DETAIL);

		$db->closedb ();
?>
<FORM METHOD=POST ACTION="?name=admin&file=gallery_category&op=gallerycat_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
<B><?=_ADMIN_FORM_CAT_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="CATEGORY" size="40" value="<?=$arr['gallerycat']['category_name'];?>">
<BR><BR>
<B><?=_ADMIN_FORM_HEADLINE;?> :</B><BR>
<textarea cols="50" id="editor1" rows="50"  NAME="DETAIL" ><?=$DETAIL;?></textarea>
<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'AdminBasic'});</script>
<BR><BR>
<INPUT TYPE="submit" value="<?=_ADMIN_GALLERY_BUTTON_EDIT_CAT;?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}

}

else if($op == "gallerycat_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['gallery'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT." where id='".$_GET['id']."' ") ;
		$arr['gallery'] = $db->fetch($res['gallery']);
		$CAT=$arr['gallery']['post_date'];
		$res['cat'] = $db->select_query("SELECT * FROM ".TB_GALLERY." WHERE category='".$_GET['id']."' ");
		while($arr['cat'] = $db->fetch($res['cat'])){
		$db->del(TB_GALLERY," category='".$arr['gallery']['id']."' ");
		$db->del(TB_GALLERY_COMMENT," gallery_id='".$arr['cat']['id']."' "); 
		}
		$galdir="images/gallery/gal_".$CAT."";
		remove_directory($galdir);
		$db->del(TB_GALLERY_CAT," id='".$_GET['id']."' "); 
		$db->closedb ();

		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_GALLERY_MESSAGE_DEL_CAT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=gallery\"><B>"._ADMIN_GALLERY_MESSAGE_GOBACK."</B></A>";
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
