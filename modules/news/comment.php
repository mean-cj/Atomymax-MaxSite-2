<?
if(!$_POST['NAME'] OR !$_POST['COMMENT']){
	echo "<script language='javascript'>" ;
	echo "alert('"._JAVA_DATA_NULL."')" ;
	echo "</script>" ;
	echo "<script language='javascript'>javascript:history.go(-1)</script>";
	exit() ;
}
 if($login_true || $admin_user){
} else {
if(USE_CAPCHA){
check_captcha($_POST['security_code']);
}
}
checkban($_POST['NAME']);
checkban($_POST['COMMENT']);

$_GET['id'] = intval($_GET['id']);
//ทำการเพิ่มข้อมูลลงดาต้าเบส
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->add_db(TB_NEWS_COMMENT,array(
	"news_id"=>"".$_GET['id']."",
	"name"=>"".htmlspecialchars($_POST['NAME'])."",
	"comment"=>"".$_POST['COMMENT']."",
	"ip"=>"".$IPADDRESS."",
	"post_date"=>"".TIMESTAMP.""
));
$db->closedb ();
?>
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- News -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_news.gif" BORDER="0"><BR><BR>
				<BR><BR><BR><BR>
				<CENTER><IMG SRC="images/icon/download.gif" BORDER="0"><BR><BR>
				<FONT SIZE="3" COLOR="#336600"><B><?=_FROM_COMMENT_ACC;?></B></FONT><BR><BR>
				<A HREF="?name=news&file=readnews&id=<?=$_GET['id'];?>"><?=_FROM_COMMENT_INDEX;?></A>
				</CENTER>

				<BR><BR><BR><BR>
			<!-- End News -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>