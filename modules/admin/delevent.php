<?
CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);

if($_GET[op] == "calendar_del"){
	if(CheckLevel($_SESSION['admin_user'],$_GET[op])){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_CALENDAR," id='".$_GET['id']."' "); 
		$db->closedb ();
//		@unlink("calendardata/".$_GET[refer].".txt");
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_CALENDAR_FORM_MESSAGE_CON."</B></FONT><BR><BR>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}
}else{
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res[event] = $db->select_query("SELECT * FROM ".TB_CALENDAR." WHERE id='".$_GET['id']."' ");
	$arr[event] = $db->fetch($res[event]);
	$db->closedb ();
	if (!$arr[event][id]){
		echo "<script language='javascript'>" ;
		echo "alert('"._ADMIN_CALENDAR_FORM_JAVA_MESSAGE_NO."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.back()</script>";
		exit();
	}
}
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
					<BR><B>&nbsp;&nbsp;<IMG SRC="images/icon/calendar.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_CALENDAR_FORM_TITLE_FORM;?></B>
					<BR><BR>
<?
if(!$ProcessOutput){
?>
<CENTER><IMG SRC="images/icon/dangerous.png" BORDER="0"><BR><BR><B><?=_ADMIN_CALENDAR_FORM_CON_MESSAGE;?></B>
<FORM METHOD=POST ACTION="?name=admin&file=delevent&op=calendar_del&id=<?=$_GET['id'];?>&refer=<?=$arr['event']['date_event'];?>">
<BR><BR>
<INPUT TYPE="submit" VALUE=" <?=_ADMIN_CALENDAR_FORM_BUTTON_DEL;?> ">
</FORM>
</CENTER>
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
