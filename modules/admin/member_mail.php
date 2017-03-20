<?php
CheckAdmin($admin_user, $admin_pwd);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$sql = "select * from ".TB_MAIL."" ;
$result = mysql_query($sql) ;
$row = mysql_num_rows($result) ;
$dbarr = mysql_fetch_array($result) ;

?>
<table width="820"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top colspan=4><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<img src="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=5 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
      <TR>
        <TD><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <a href="?name=admin&file=member"><?=_ADMIN_MEMBER_MENU_TITLE;?></a> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <a href="?name=admin&file=member_mail"><?=_ADMIN_MEMBER_MENU_MAILTO_MEM;?></a></B> <BR>
            <BR>
            <table width="Ø80%" border="0" align="center" cellpadding="0" cellspacing="0" class="grids">
              <tr class="odd">
                <td colspan="2">
                  <div align="center"><strong><?=_ADMIN_MEMBER_MAIL_FORM_TITLE;?></strong></font></div></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF"><?=_ADMIN_MEMBER_FUNCTION_MAIL_TOPIC;?></font></td>
                <td bgcolor="#FFFFFF"> 
                  <?php
if($row==0) {
echo "<center>"._ADMIN_MEMBER_MAIL_MESSAGE_NULL."</center>" ;
}

else {
echo $dbarr['subject'] ;
}
?>
                </font></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF" valign="top"><?=_ADMIN_MEMBER_FUNCTION_MAIL_MESSAGE;?></font></td>
                <td bgcolor="#FFFFFF" valign="top"> 
                  <?php
if($row==0) {
echo "<center>"._ADMIN_MEMBER_MAIL_MESSAGE_NULL."</center>" ;
}
else {
echo $dbarr['detail'] ;
}


?>
                </font></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF"><?=_RATER_MOD_VOTE_TOTAL;?></font></td>
                <td bgcolor="#FFFFFF"> 
                  <?php
if($row==0) {
echo "<center>"._ADMIN_MEMBER_MAIL_MESSAGE_NULL."</center>" ;
}
else {
echo $dbarr['form_mail'] ;
}


?>
                </font></td>
              </tr>
              <tr>
                <form name="form1" method="post" action="?name=admin&file=member_program_mail">
                  <td colspan="2" bgcolor="#FFFFFF"><div align="center">
                      <input name="sendmail" type="submit" id="sendmail" value="<?=_ADMIN_MEMBER_MAIL_BUTTON_SEND;?>">
&nbsp;
                <input name="edit" type="submit" id="edit" value="<?=_ADMIN_MEMBER_MAIL_BUTTON_EDIT;?>">
                <input name="click" type="hidden" id="click" value="click">
                  </div></td>
                </form>
              </tr>
            </table>
            <br>
            <form action="?name=admin&file=member_program_mail" method="post" name="checkForm2" onsubmit="return check()">
            <table width="Ø80%" border="0" align="center" cellpadding="0" cellspacing="0" class="grids">
              <tr class="odd">
                  <td colspan="2">
                    <div align="center"><strong>&nbsp;<?=_ADMIN_MEMBER_MAIL_FORM_TITLE1;?> <font color="#000000" size="2"><?=_ADMIN_MEMBER_MAIL_MAIL_MESSAGE;?></font></strong></font></div></td>
                </tr>
                <tr >
                  <td valign="middle"><?=_ADMIN_MEMBER_FUNCTION_MAIL_TOPIC;?> </font></td>
                  <td>
                    <input name="subject_total" type="text" id="subject_total" size="50" maxlength="120">
                  </td>
                </tr>
                <tr >
                  <td><?=_ADMIN_MEMBER_FUNCTION_MAIL_MESSAGE;?></font></td>
                  <td> 
                    <textarea name="message_total" cols="55" rows="10" id="message_total"></textarea>
                  </font></td>
                </tr>
                <tr>
                  <td colspan="2" ><div align="center">
                      <input type="submit" name="Submit" value="<?=_ADMIN_MEMBER_MAIL_BUTTON_SEND;?>">
                      <input type="hidden" name="tt" value="tt">
&nbsp;
                <input type="reset" name="Submit2" value="<?=_ADMIN_BUTTON_CLEAR;?>">
                <input name="click" type="hidden" id="click" value="click">
                  </div></td>
                </tr>
              </table>
              <script language="javascript">
function check() {
var v1 = document.checkForm2.subject_total.value ;
var v2 = document.checkForm2.message_total.value ;
if(v1.length == 0) {
alert("<? echo _MEMBER_MOD_CHECK_EMAIL_MESS_NULL;?>") ;
document.checkForm2.subject_total.focus();
return false ;
}
else if(v2.length==0) {
alert("<? echo _GBOOK_JAVA_MESSAGE;?>") ;
document.checkForm2.message_total.focus() ;
return false ;
}
else 
return true ;
}

                    </script>
          </form></TD>
      </TR>
    </TABLE>
	</td>
  </tr>
</table>

