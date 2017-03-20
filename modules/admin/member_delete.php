<?
CheckAdmin($admin_user, $admin_pwd);

	if(CheckLevel($admin_user,"member_del")){

?>

	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0 align="center">
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<img src="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<tr>
				<td align="center">
				
            <?
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$MemResult = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE member_id='".$_GET['member_id']."' ");
		$DelMem= $db->fetch($MemResult);

		$MemResult2 = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$DelMem['user']."' ");
		$DelMem2= $db->fetch($MemResult2);
		if ($DelMem2){
		$db->del(TB_ADMIN," username='".$DelMem['user']."' "); 
		}
		@unlink("icon/".$DelMem['member_pic']."");
		$db->del(TB_MEMBER," member_id='".$_GET['member_id']."' "); 
		$db->closedb ();
		$ProcessOutput = "<TABLE width=600 align=center cellSpacing=0 cellPadding=0 border=0><TR><TD><BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_MEMBER_MESSAGE_DEL_MEM_OK." $member_id "._ADMIN_MEMBER_MESSAGE_DEL_MEM_OK1."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=member\"><B>"._ADMIN_MEMBER_MESSAGE_DELETE_MEM_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR></td></tr></table>";

		}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}

	echo $ProcessOutput ;
	?>
					<BR>
				
	        <!-- End News -->		  </TD>
        </TR>
    </TABLE>
		        <!-- End News -->		  </TD>
        </TR>
      </TBODY>
    </TABLE>

