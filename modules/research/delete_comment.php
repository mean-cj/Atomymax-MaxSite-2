<?
CheckAdmin($admin_user, $admin_pwd);
?>
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- research -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/research.gif" BORDER="0"><BR><BR>
				<BR><BR>
<?
	$_GET['id'] = intval($_GET['id']);
	$_GET['comment'] = intval($_GET['comment']);
	if(CheckLevel($admin_user,"research_del")){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_RESEARCH_COMMENT," research_id='".$_GET[id]."' AND id='".$_GET[comment]."' "); 
		$db->closedb ();
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._FROM_COMMENT_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=research&file=readresearch&id=".$_GET['id']."\"><B>"._FROM_COMMENT_INDEX."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
?>

				<BR><BR>
			<!-- End research -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>