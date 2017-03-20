<?php

if(isset($_POST['delete'])) {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$_SESSION['admin_user']."' AND password='".$_SESSION['admin_pwd']."'  "); 
$rows['admin'] = $db->rows($res['admin']); 
if($rows['admin']){

mysql_select_db($db) ;
$member_id=$_POST['member_id'];

$sql = "delete from ".TB_MEMBER." where member_id='$member_id'" ;
$result = mysql_query($sql) ;
?>

<table width="720"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="images/menu/topic_admin.gif" width="200" height="30" align="absmiddle"><br>
    <br></td>
  </tr>
  <tr>
    <td><TABLE width="100%" align=center cellSpacing=0 cellPadding=0 border=0>
      <TR>
            <TD> <B>&nbsp;&nbsp;<IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <a href="?name=admin&file=member"><?=_ADMIN_MEMBER_MENU_TITLE;?></a> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <a href="?name=admin&file=member_mail"><?=_ADMIN_MEMBER_MENU_MAILTO_MEM;?></a></B> <BR>
            <?php
if($result) {

echo "<center><font size='3' face='MS Sans Serif'>"._ADMIN_MEMBER_MESSAGE_DEL_MEM_OK." $member_id "._ADMIN_MEMBER_MESSAGE_DEL_MEM_OK1."" ;
echo "<br><br>"._ADMIN_MEMBER_MESSAGE_DEL_MEM_WAIT."</font></center>" ;
echo "<meta http-equiv='refresh' content='2;url=?name=admin&file=member'>" ;
//exit() ;
}
else {
$showmsg="<br><br><center><font size='3' face='MS Sans Serif'><b>"._ADMIN_MEMBER_MESSAGE_NO_DEL."</b></font><br><br>
<input type='button' value='"._ADMIN_MEMBER_MESSAGE_NO_DEL_GOBACK."' onclick='history.back();'></center>" ;
	showerror($showmsg);
}

?>        </TD>
      </TR>
    </TABLE></td>
  </tr>
</table>
				</TD>
				</TR>
			</TABLE>
<?php } ?>
<?php } ?>