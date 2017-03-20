<TABLE WIDTH="750"  border="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top</TD>
          <TD width="740" vAlign=top colspan="2">

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" ></TD>
				</TR>
      <TR><td>
<?

$user_login = stripslashes( $_POST['user_login'] );
$user_login = mysql_real_escape_string($_POST['user_login']);
$pwd_login = stripslashes( $_POST['pwd_login'] );
$pwd_login = mysql_real_escape_string( $_POST['pwd_login'] );

if (is_valid($user_login) == true && is_valid($pwd_login) == true)
{
$Username = preg_replace ( '/"/i', '\"' , $user_login); 
$Password= preg_replace ( "/'/i", "\'" , $pwd_login); 
anti_injection($Username,$Password,$IPADDRESS);
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net
	if(USE_CAPCHA){
		if($_SESSION['security_code'] != $_POST['security_code'] OR empty($_POST['security_code'])) {
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_CAPTCHA_NOACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.go(-1)</script>";
//		echo "		if(".$_SESSION['security_code']." != ".$_POST['security_code']." OR empty(".$_POST['security_code'].")) {";
			exit();
		}
	}

if(isset($Username) and isset($Password)) {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$Username."' AND password='".md5($Password)."'  "); 
$rows['admin'] = $db->rows($res['admin']); 
if($rows['admin']){
	$arr['admin'] = $db->fetch($res['admin']);
}
if ($arr['admin']['username']){
session_unset($login_true);
	//Login ผ่าน
	ob_start();
	$_SESSION['admin_user'] = $Username ;
	$_SESSION['admin_pwd'] = md5($Password) ;
	$_SESSION['CKFinder_UserRole'] ='admin';
	$_SESSION['ua'] = $_SESSION['admin_user'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
	session_write_close();
	ob_end_flush();
			$timeoutseconds=20*60;
			$_SESSION['timestamp2']=time();
			$timeout=$_SESSION['timestamp2'] + $timeoutseconds;
	//////////////////////		 เพิ่ม  สมาชิกออนไลน์   ////////////////////////////

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user2'] = $db->select_query("SELECT * FROM ".TB_useronline." WHERE useronline='".$_SESSION['admin_user']."' ");
			$rows['user2'] = $db->rows($res['user2']); 
			$db->closedb ();
			
			if($rows['user2']){

				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
				$db->update_db(TB_useronline,array(
					"post_date"=>"".$_SESSION['timestamp2']."",
					"timeout"=>"".$timeout."",
					"ip"=>"".$IPADDRESS.""
				)," useronline='".$_SESSION['admin_user']."' ");
				$db->closedb ();
			
			}else{
				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);	
				$db->add_db(TB_useronline,array(
					"post_date"=>"".$_SESSION['timestamp2']."",
					"useronline"=>"".$_SESSION['admin_user']."",
					"timeout"=>"".$timeout."",
					"ip"=>"".$IPADDRESS.""
			));
			
			}


?>
				<TABLE width="700" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD>
<BR><BR>
<CENTER><A HREF="?name=admin&file=main"><IMG SRC="images/icon/login-welcome.gif" BORDER="0"></A><BR><BR>
<FONT COLOR="#336600"><B><?=_FORM_MAIN_WELCOME;?></B></FONT><BR><BR>
<A HREF="?name=admin&file=main"><B><?=_MENU_MAIN_INDEX;?></B></A>
</CENTER>
</td>
</tr>
</table>
<? echo "<meta http-equiv='refresh' content='1; url=?name=admin&file=main'>" ; ?>
<BR><BR>
<?
} else {
//	echo md5($Password);
$result = mysql_query("select user,password from ".TB_MEMBER." where user='".$Username."' and password='".md5($Password)."'") ;
$num = mysql_num_rows($result) ;
if($num<=0) {
	$showmsg=""._MEMBER_MOD_FORM_LOGIN_NOACC."";
	showerror($showmsg);
	echo"<meta http-equiv=\"refresh\" content=\"3;URL=?name=member\" />";
}
else {
$dbarr = mysql_fetch_array($result) ;
if($Username!=$dbarr['user'] and md5($Password)!=$dbarr['password']) {
	$showmsg=""._MEMBER_MOD_FORM_LOGIN_NOUSER."";
	showerror($showmsg);
	echo"<meta http-equiv=\"refresh\" content=\"3;URL=?name=member\" />";
}
else {
//session_start() ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	mysql_query("UPDATE ".TB_MEMBER." SET lastlog=dtnow WHERE user='".$Username."'");
	mysql_query("UPDATE ".TB_MEMBER." SET dtnow='$now' WHERE user='".md5($Password)."'");

	$showmsg=""._MEMBER_MOD_FORM_LOGIN_PASS."";
	showerror($showmsg);
//session_start();
ob_start();
//session_start();
$_SESSION['login_true']=$Username;
$_SESSION['pwd_login']=md5($Password);
$_SESSION['uax'] = $_SESSION['login_true'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
session_write_close();
ob_end_flush();

			$timeoutseconds=20*60;
			$_SESSION['timestamp2']=time();
			$timeout=$_SESSION['timestamp2'] + $timeoutseconds;
//////////////////////		 เพิ่ม  สมาชิกออนไลน์   ////////////////////////////
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user2'] = $db->select_query("SELECT * FROM ".TB_useronline." WHERE useronline='".$_SESSION['login_true']."' ");
			$rows['user2'] = $db->rows($res['user2']); 
			$db->closedb ();
			
			if($rows['user2']){

				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
				$db->update_db(TB_useronline,array(
					"post_date"=>"".$_SESSION['timestamp2']."",
					"timeout"=>"".$timeout."",
					"ip"=>"".$IPADDRESS.""
				)," useronline='".$_SESSION['login_true']."' ");
				$db->closedb ();
			
			}else{
				$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);	
				$db->add_db(TB_useronline,array(
					"post_date"=>"".$_SESSION['timestamp2']."",
					"useronline"=>"".$_SESSION['login_true']."",
					"timeout"=>"".$timeout."",
					"ip"=>"".$IPADDRESS.""
			));
			
			}

echo "<meta http-equiv=refresh content='3;URL=?name=member&file=member_detail'>" ;
//exit() ;
				}
				}
				}
}
?>
</td>
</tr>
</table>
<?
//login now
} else {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_IPBLOCK,array(
			"ip"=>"".$IPADDRESS."",
			"post_date"=>"".time().""
		));
		$db->closedb ();
?>
<BR><BR>
<CENTER><A HREF="?name=index"><IMG SRC="images/dangerous.png" BORDER="0"></A><BR><BR>
<FONT COLOR="#336600"><B><?=_ADMIN_IPBLOCK_MESSAGE_HACK;?> <?=WEB_EMAIL;?></B></FONT><BR><BR>
<A HREF="?name=index"><B><?=_ADMIN_IPBLOCK_MESSAGE_HACK1;?></B></A>
</CENTER>
<? echo "<meta http-equiv='refresh' content='10; url=?name=index'>" ; ?>
<BR><BR>
<?
}
?>
</td>
</tr>
</table>