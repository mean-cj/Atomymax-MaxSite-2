<?
CheckAdmin($admin_user, $admin_pwd);
include ("editor.php");
if(ISO =='utf-8'){
		$Filename = "editortalk_utf8.html";
		$txt_name = "modules/editortalk/".$Filename."";
		$FileNewsTopic = "modules/editortalk/editortalk_utf8.html";
} else {
		$Filename = "editortalk.html";
		$txt_name = "modules/editortalk/".$Filename."";
		$FileNewsTopic = "modules/editortalk/editortalk.html";
}
if($op == "editortalk_edit"){
	if(CheckLevel($admin_user,$op)){
		//ทำการแก้ไขไฟล์ text ของ Editor Talk
		$txt_open = @fopen("$txt_name", "w");
		@fwrite($txt_open, "".$_POST[EDITORTALK]."");
		@fclose($txt_open);
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_EDITOR_TALK_SUCCESS_MESS."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=main\"><B>"._ADMIN_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		$ProcessOutput = $PermissionFalse ;
	}
}

//อ่านค่าจากไฟล์ Text เพื่อแก้ไข

$file_open = @fopen($FileNewsTopic, "r");
$TextContent = @fread ($file_open, @filesize($FileNewsTopic));
@fclose ($file_open);
$TextContent = stripslashes($TextContent);

?>

	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; Editor's Talk</B>
					<BR><BR>
<?
if(empty($ProcessOutput)){
?>
						<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=editortalk&op=editortalk_edit">
						<BR>
						<B><?=_ADMIN_EDITOR_TALK_DETAIL;?> :</B><BR>
<textarea cols="100" id="EDITORTALK" rows="50" class="ckeditor"  name="EDITORTALK" ><?=$TextContent;?></textarea>
						<input type="submit" value="<?=_ADMIN_EDITOR_TALK_BUTTON_EDIT;?>" name="submit"> <input type="reset" value="<?=_ADMIN_BUTTON_CLEAR;?>" name="reset">
						</FORM>
<?
}else{
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
