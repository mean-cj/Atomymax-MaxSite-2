<?
CheckAdmin($admin_user, $_SESSION['admin_pwd']);
?>
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- News -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_news.gif" BORDER="0"><BR><BR>
				<BR><BR>
<?
	$_GET['id'] = intval($_GET['id']);
	$_GET['comment'] = intval($_GET['comment']);
	if(CheckLevel($admin_user,"news_del")){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_NEWS_COMMENT," news_id='".$_GET['id']."' AND id='".$_GET['comment']."' "); 
		$db->closedb ();
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._FROM_COMMENT_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=news&file=readnews&id=".$_GET['id']."\"><B>"._FROM_COMMENT_INDEX."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
?>

				<BR><BR>
			<!-- End News -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>