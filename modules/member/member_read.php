<?php
#### สคริ๊ปนี้ใช้ในการเช็ค ว่าล็อกอินหรือยัง ให้นำสคริ๊ปนี้ไปไว้ที่หน้าที่คุณต้องการให้เช็ค ####

if(!$login_true) {
//  url=index.php คำสั่งนี้จะให้ไปหน้าที่จะต้องกรอก user,pwd ถ้าอยู่โฟล์เดอร์อื่นให้เรียกให้ถูกนะครับ
	echo "<center><font size='3'>"._MEMBER_MOD_CHECK_NOACC."</font>";
	echo "<meta http-equiv='refresh' content='2;url=?name=member'>" ; 
} else {
### จบการเช็ค ###
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net

?>

<!-- จาวา แถบสี -->
<SCRIPT LANGUAGE="javascript"> 
function mOvr(src,clrOver){ 
if (!src.contains(event.fromElement)){ 
src.style.cursor = 'hand'; 
src.bgColor = clrOver; 
} 
} 
function mOut(src,clrIn){ 
if (!src.contains(event.toElement)){ 
src.style.cursor = 'default'; 
src.bgColor = clrIn; 
} 
} 
</SCRIPT> 

<TITLE>สวัสดีครับสมาชิกใหม่ และ สมาชิกเก่าทุกๆท่าน</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-874">
</HEAD>

<BODY LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0">
<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
empty($_GET['id'])?$id="":$id=$_GET['id'];
$result = mysql_query("select * from member where id='$id'") or die ("Err Can not to result") ;
$dbarr = mysql_fetch_array($result) ;


?>
<TABLE WIDTH="750"  border="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="740" vAlign=top ><IMG src="images/topfader.gif" border=0><BR>

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" colspan="4"></TD>
				</TR>
      <TR>
        <TD COLSPAN="5"><STRONG><FONT SIZE="4"><IMG SRC="images/human.gif" > <FONT COLOR="#FF3300"><u><FONT COLOR="#0000FF"><?=_MEMBER_MOD_MEMDETAIL_TITLE;?> <?php echo $dbarr['user'] ; ?>
        </FONT></u></FONT></FONT></STRONG></TD>
      <TR>
        <TD WIDTH="30%" ALIGN="right"><STRONG><? echo _MEMBER_MOD_MEMDETAIL_MEMID;?> : </FONT></STRONG></TD>
        <TD WIDTH="22%">
          <DIV ALIGN="left"><?php echo $dbarr['member_id'] ; ?></FONT></DIV></TD>
        <TD WIDTH="11%" ALIGN="right"><STRONG><? echo _MEMBER_MOD_MEMDETAIL_MEMPIC;?> : </FONT></STRONG></TD>
        <TD WIDTH="37%" ROWSPAN="5" VALIGN="top">
          <DIV ALIGN="left">
		  <?
					//Show Picture
					if($dbarr[member_pic]){
						$postpicupload = @getimagesize ("icon/".$dbarr[member_pic]."");
						if ( $postpicupload[0] > _MEMBER_LIMIT_PICWIDTH ) {
							$PicUpload = "<img src='icon/".$dbarr[member_pic]."' width='"._MEMBER_LIMIT_PICWIDTH."' border=\"1\" ALIGN='absmiddle' class='membericon'>";
							}else{
							$PicUpload = "<img src='icon/".$dbarr[member_pic]."' border=\"1\" ALIGN='absbottom' class='membericon'>";
							}
						echo $PicUpload ;
					}else{ echo "<img src='icon/member_nrr.gif' border='1' ALIGN='absbottom' class='membericon'> "; };
					?>		  
		  </DIV>
          <DIV ALIGN="left"></DIV></TD>
      </TR>
      <TR>
        <TD WIDTH="30%" ALIGN="right"><STRONG>Username : </FONT></STRONG></TD>
        <TD>
          <DIV ALIGN="left"><?php echo $dbarr['user'] ; ?></FONT></DIV></TD>
        <TD WIDTH="11%" ALIGN="right"><STRONG></STRONG></TD>
        </TR>
      <TR>
        <TD WIDTH="30%" ALIGN="right"><STRONG><? echo _MEMBER_MOD_MEMDETAIL_NAME;?> : </FONT></STRONG></TD>
        <TD><?php echo $dbarr['name'] ; ?></FONT></TD>
        <TD WIDTH="11%" ALIGN="right">&nbsp;</TD>
        </TR>
      <TR>
        <TD WIDTH="30%" ALIGN="right"><STRONG><? echo _MEMBER_MOD_MEMDETAIL_SEX;?> :</FONT></STRONG></TD>
        <TD><?php echo $dbarr['sex'] ; ?></FONT></TD>
        <TD WIDTH="11%" ALIGN="right">&nbsp;</TD>
        <TR>
        <TD WIDTH="30%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_PROV;?> : </FONT></STRONG></TD>
        <TD><?php echo $dbarr['province'] ; ?></FONT></TD>
        <TD WIDTH="11%" ALIGN="right">&nbsp;</TD>
        <TR>
        <TD WIDTH="30%" ALIGN="right"><STRONG>email : </FONT></STRONG></FONT></TD>
        <TD><?php echo $dbarr['email'] ;?></FONT></TD>
        <TD WIDTH="11%" ALIGN="right">&nbsp;</TD>
        <TD>&nbsp;</TD>
      <TR>
        <TD WIDTH="30%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_TIMEADD;?> : </STRONG></FONT></TD>
        <TD><?php echo $dbarr['signup'] ; ?></FONT></TD>
        <TD WIDTH="11%" ALIGN="right">&nbsp;</TD>
        <TD>&nbsp;</TD>
      <TR>
        <TD ALIGN="right"><STRONG><? echo _MEMBER_MOD_MEMDETAIL_LASTLOG;?> : </STRONG></FONT></TD>
        <TD><?php echo $dbarr['lastlog'] ; ?></a></font></TD>
        <TD>&nbsp;</TD>
        <TD>&nbsp;</TD>
      <TR>
        <TD ALIGN="right">&nbsp;</TD>
        <TD>&nbsp;</TD>
        <TD>&nbsp;</TD>
        <TD>&nbsp;</TD>
      <TR>
        <TD WIDTH="30%" ALIGN="right">&nbsp;</TD>
        <TD>&nbsp;</TD>
        <TD WIDTH="11%">&nbsp;</TD>
        <TD>&nbsp;</TD>
      </TABLE></TD>
  </TR>
</TABLE>
<TD VALIGN="top"><DIV ALIGN="center">
  </DIV></TD>
</BODY>
</HTML>
<? } ?>