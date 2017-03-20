<TABLE WIDTH="660" BORDER="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top></TD>
          <TD width="640" vAlign=top colspan="2"><BR>

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
<?php
$forget=$_POST['forget'];
function mosMakePassword($length) {
	$salt = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789";
	$len = strlen($salt);
	$makepass="";
	mt_srand(10000000*(double)microtime());
	for ($i = 0; $i < $length; $i++)
	$makepass .= $salt[mt_rand(0,$len - 1)];
	return $makepass;
}
$Pass=mosMakePassword(8);
if(!empty($forget)) {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net
$emails=$_POST['emails'];
$result = mysql_query("select user from ".TB_MEMBER." where email='$emails' ") or die("Err Database") ;
$numrow = mysql_num_rows($result) ;

if($numrow==0) {
$status = "<center><font size='3' face='MS Sans Serif'><b>No $emails on Web</b></font></center>" ;
} else {

$result = mysql_query("select * from ".TB_MEMBER." where email='$emails' ") ;
$dbarr = mysql_fetch_array($result) ;
$email=$dbarr['email'];
$name=$dbarr['name'];
$user=$dbarr['user'];
$password=$Pass;
if($result) {
resetpassword($email,$name,$user,$password ) ;  // ส่งเมล์หาลูกค้า เรียกฟังค์ชั่นให้ทำงาน
echo "<meta http-equiv=refresh content='3;URL=index.php'>" ;
}

//$resultup = mysql_query("update password from ".TB_MEMBER." where password='".$password."' ") or die("Err Database") ;
//$numup = mysql_fetch_array($resultup) ;
			$db->update_db(TB_MEMBER,array(
				"password"=>"".md5($password).""
			)," email='$emails' ");

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$MemResult = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE email='".$email."' ");
$EditMem= $db->fetch($MemResult);
if ($EditMem){
			$db->update_db(TB_ADMIN,array(
				"password"=>"".md5($password).""
			)," email='".$email."' ");
}

}

} else {
?>
	<FORM ACTION="?name=member&file=forget_pwd" METHOD="post">
              
        <TABLE WIDTH="640" BORDER="0" ALIGN="center" CELLPADDING="3" CELLSPACING="1">
		            <TR VALIGN="top"> 
                  <TD COLSPAN="2" align="center"> 
                    
                     
                      
                       <DIV ALIGN="center"><P><FONT COLOR="#000000" SIZE="2"><STRONG></STRONG></FONT></P>
                      <P><FONT COLOR="#000000" SIZE="2"><STRONG><?=_MEMBER_MOD_RESET_PASS_ADD;?></STRONG></FONT></P>
                    </DIV></TD>
      </TR>
	
      <TR> 
                  
            <TD align="right" BGCOLOR="#FFFFFF" ><FONT SIZE="2"><STRONG>email</STRONG></FONT></TD>
        <TD BGCOLOR="#FFFFFF"><INPUT NAME="emails" TYPE="text" ID="emails" size="20"></TD>
      </TR>
	  <TR> 
                  
            <TD align="center" BGCOLOR="#FFFFFF" >&nbsp;</TD>
				            <TD BGCOLOR="#FFFFFF"> 
            <INPUT TYPE="submit" NAME="Submit" VALUE="send password">
            <INPUT NAME="forget" TYPE="hidden" ID="forget" VALUE="forget">
            &nbsp; </TD>
      </TR>
	        <TR> 
                  <TD COLSPAN="2" BGCOLOR="#FFFFFF"><DIV ALIGN="center">
                    <P><STRONG><FONT COLOR="#FF0000" SIZE="1" FACE="MS Sans Serif, Tahoma, sans-serif"><?=_MEMBER_MOD_RESET_PASS_SEND;?> </FONT></STRONG></P>
                  </DIV></TD>
      </TR>
	  
    </TABLE>
	
</FORM>

<?
	}
?>
	</TD>
  </TR>
</TABLE>