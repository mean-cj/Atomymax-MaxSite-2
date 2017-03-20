<?
CheckAdmin($admin_user, $admin_pwd);
?>
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0 bgcolor=#FFFFFF>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="740" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Pin  -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_webboard.gif" BORDER="0"><BR><BR>
				<BR><BR>
<?
	if(CheckLevel($admin_user,"webboard_edit")){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		if($_GET['action'] == "addpin"){
			$db->update(TB_WEBBOARD," pin_date='".TIMESTAMP."' "," id='".$_GET['id']."' ");
			$Title = ""._WEBBOARD_PIC_TOPIC_TITLE_ADD."";
		}else if($_GET['action'] == "removepin"){
			$db->update(TB_WEBBOARD," pin_date='' "," id='".$_GET['id']."' ");
			$Title = ""._WEBBOARD_PIC_TOPIC_TITLE_CANCLE."";
		}
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._WEBBOARD_PIC_TOPIC_SUCCESS_1." ".$Title." "._WEBBOARD_PIC_TOPIC_SUCCESS_2."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=webboard&file=read&id=".$_GET['id']."\"><B>"._WEBBOARD_COMMENT_DELET_BACKIN."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
?>

				<BR><BR>
			<!-- End Pin -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>