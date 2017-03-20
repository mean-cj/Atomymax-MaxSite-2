<?php

if(!$login_true){
echo "<meta http-equiv='refresh' content='0; url =?name=member&file=index'>" ;
exit() ;
}
$ok=$_POST['ok'];
if(isset($ok) and session_is_registered("status")){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net
$old_pwd=$_POST['old_pwd'];
$new_pwd1=$_POST['new_pwd1'];
$new_pwd2=$_POST['new_pwd2'];
// Sanitise current password input
$pass_curr = stripslashes( $old_pwd );
$pass_curr = mysql_real_escape_string( $old_pwd );
$pass_curr = md5( $old_pwd );
$pass_new = mysql_real_escape_string($new_pwd1);
$pass_conf = mysql_real_escape_string($new_pwd2);

$sql = "select * from ".TB_MEMBER." where user='$login_true' and password='$pass_curr'" ;
$result = mysql_query($sql) ;
$row = mysql_num_rows($result) ;
if($row<=0){
$status = "<center><font face='MS Sans Serif' size='3' color='red'><b>"._MEMBER_MOD_PASSWORD_NOACC."</b></font></center>" ;
echo "<meta http-equiv='refresh' content='2'>" ;
session_unregister("status") ;

}
else {
if($pass_new==$pass_conf){
$sql = "update ".TB_MEMBER." set  password='".md5($pass_new)."' where user = '$login_true'" ;
$result = mysql_query($sql) or die("ERR PROGRAME") ;
if($result){
$status = "<center><font face='MS Sans Serif' size='3' color='red'><b>"._MEMBER_MOD_CHPASSWORD_ACC."</b></font></center>";
echo "<meta http-equiv='refresh' content='2; url =?name=member&file=member_detail'>" ;
}

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$MemResult = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$login_true."' ");
$EditMem= $db->fetch($MemResult);
if ($EditMem){
			$db->update_db(TB_ADMIN,array(
				"password"=>"".md5($pass_new).""
			)," username='".$login_true."' ");
}

}
else{
$status = "<center><font face='MS Sans Serif' size='3' color='red'><b>"._MEMBER_MOD_CHPASSWORD_CONF."</b></font></center>";
echo "<meta http-equiv='refresh' content='2'>" ;

}
}
}
else {
$status = NULL ;
session_register("status") ;
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//$login_true=$_SESSION['login_true'];
$result = mysql_query("select * from ".TB_MEMBER." where user='".$login_true."' ") or die ("Err Can not to result") ;
$dbarr = mysql_fetch_array($result) ;

?>

<TABLE WIDTH="750" BORDER="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top >

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" colspan="4"></TD>
				</TR>
								<tr><td  colspan="4">&nbsp;&nbsp;<?php include "member_header.php" ; ?>
    </p>
      <P ALIGN="center"><STRONG><u><BR>
        <?=_MEMBER_MOD_CHPASSWORD_TITLE;?></u></STRONG></FONT></P>
      <P ALIGN="center"><?php echo $status ; ?></P>
        <FORM ACTION="" METHOD="post" NAME="checkForm" onSubmit="return check()">
          <TABLE WIDTH="100%" BORDER="0" ALIGN="center" CELLPADDING="2" CELLSPACING="1">
              <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_CHPASSWORD_OLD_PASS;?></FONT></STRONG></TD>
              <TD>
                <INPUT TYPE="text" NAME="old_pwd" >
              </TD>
            </TR>
            <TR>
              <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_CHPASSWORD_NEW_PASS;?></FONT></STRONG></TD>
              <TD>
                <INPUT TYPE="password" NAME="new_pwd1">
              </TD>
            </TR>
            <TR>
              <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_CHPASSWORD_NEW_PASS_CONF;?></FONT></STRONG></TD>
              <TD>
                <INPUT TYPE="password" NAME="new_pwd2">
              </TD>
            </TR>
            <TR>
              <TD ALIGN="right">&nbsp;</TD>
              <TD>
                <INPUT TYPE="submit" NAME="Submit" VALUE="<?=_FORM_BUTTON_CONF;?>">
&nbsp;
              <INPUT TYPE="reset" NAME="Submit2" VALUE="<?=_FORM_BUTTON_RESET;?>">
              <INPUT NAME="ok" TYPE="hidden" ID="ok" VALUE="ok">
              </TD>
            </TR>
            <TR>
              <TD COLSPAN="2">&nbsp; </TD>
            </TR>
          </TABLE>
          <SCRIPT language = "javascript">
function check(){
var v1 = document.checkForm.old_pwd.value;
var v2 = document.checkForm.new_pwd1.value;
var v3 = document.checkForm.new_pwd2.value;

if(v1.length==0){
alert("<?echo _JAVA_FORM_CONF_OLDPASS;?>");
document.checkForm.old_pwd.focus();
return false ;
}
else if(v2.length==0){
alert("<?echo _JAVA_FORM_CONF_NEWPASS;?>");
document.checkForm.new_pwd1.focus();
return false ;
}
else if(v3.length==0){
alert("<?echo _JAVA_FORM_CONF_NEWPASS;?>");
document.checkForm.new_pwd2.focus();
return false ;
}

else 
return true ;
}
  </SCRIPT>
      </FORM></TD>
  </TR>
  <TR>
    <TD><BR><BR><BR></TD>
  </TR>
  <TR>
    <TD CLASS="dotline"></TD>
    <TD HEIGHT="1" CLASS="dotline"></TD>
  </TR>
</TABLE>

    <TD >
  </TR>
</TABLE>
