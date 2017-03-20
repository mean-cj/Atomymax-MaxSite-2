<?
CheckAdmin($admin_user, $admin_pwd);
?>
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0 bgcolor=#FFFFFF>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="740" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- News -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_webboard.gif" BORDER="0"><BR><BR>
				<BR><BR>
<?
	$_GET['id'] = intval($_GET['id']);
	if(CheckLevel($admin_user,"webboard_del")){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$BoardResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id='".$_GET['id']."' ");
		$WebBoard = $db->fetch($BoardResult);
			$usercom=$WebBoard['post_name'];
			$CommentResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE topic_id='".$WebBoard['id']."' ORDER BY id ");
			while($Comment = $db->fetch($CommentResult)){
				@unlink("webboard_upload/".$Comment['picture']."");


			$db->del(TB_WEBBOARD_COMMENT," topic_id='".$WebBoard['id']."' "); 

		}
		$rows['sum'] = $db->fetch($db->select_query("select * from ".TB_MEMBER." where user='".$usercom."' "));
		if ($rows['sum']){
		if($rows['sum']['topic'] !='0'){$topic_down=$row['sum']['topic']-1;} else {$topic_down=0;}
		$db->update_db(TB_MEMBER,array(
			"topic" =>"".$topic_down.""
		)," user='".$usercom."' ");
		}
		@unlink("webboard_upload/".$WebBoard['picture']."");
		$db->del(TB_WEBBOARD," id='".$_GET['id']."' "); 
		$row['sum'] = $db->fetch($db->select_query("select * from ".TB_MEMBER." where user='".$usercom."' "));
		if ($row['sum']){
		$row=$row['sum']['post']-1;
			$db->update_db(TB_MEMBER,array(
			"post" =>"".$row.""
		)," user='".$usercom."' ");
		}
		$db->closedb ();
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._WEBBOARD_TOPIC_DELET_SUCCESS."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=webboard\"><B>"._WEBBOARD_COMMENT_DELET_BACKIN."</B></A>";
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