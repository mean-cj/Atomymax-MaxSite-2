
	<TABLE cellSpacing=0 cellPadding=0 width=720 border=0>
      <TBODY>

<?
require_once("mainfile.php");
		$classtext = array("", "");
		$classbox = array("noborder2", "noborder2");
		$username = "";
		$password = "";
//////////////////////		 เพิ่ม  สมาชิกออนไลน์   ////////////////////////////
//			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//			$db->add(TB_useronline," useronline='".$_SESSION['admin_user']."' "); 
//			$db->closedb ();
//echo "$_POST[username]<br>";
//echo "$_POST[password]<br>";
//echo "".md5($_POST[password])."<br>";
//Check Admin
$user_login = stripslashes( $_POST['username'] );
$user_login = mysql_real_escape_string($_POST['username']);
$pwd_login = stripslashes( $_POST['password'] );
$pwd_login = mysql_real_escape_string( $_POST['password'] );

if (is_valid($user_login) == true && is_valid($pwd_login) == true)
{
$Username = preg_replace ( '/"/i', '\"' , $user_login); 
$Password= preg_replace ( "/'/i", "\'" , $pwd_login); 
anti_injection($Username,$Password,$IPADDRESS);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$Username."' AND password='".md5($Password)."'  "); 
$rows['admin'] = $db->rows($res['admin']); 
if($rows['admin']){
	$arr['admin'] = $db->fetch($res['admin']);
}
$db->closedb ();
if(USE_CAPCHA){
	if($_SESSION['security_code'] != $_POST['security_code'] OR empty($_POST['security_code'])) {
		echo "<script language='javascript'>" ;
		echo "alert('"._JAVA_CAPTCHA_NOACC."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
}

//Can Login
if($arr['admin']['id']){
session_unset($login_true);
	//Login ผ่าน
	ob_start();
	$_SESSION['admin_user'] = $Username ;
	$_SESSION['admin_pwd'] = md5($Password) ;
	$admin_user=$_SESSION['admin_user'];
	$admin_pwd=$_SESSION['admin_pwd'];
	$_SESSION['CKFinder_UserRole'] ='admin';
	$_SESSION['ua'] = $_SESSION['admin_user'].":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'];
	session_write_close();
	ob_end_flush();
			$timeoutseconds=20*60*60;
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
        <TR>
          <TD width="720" vAlign=top align=left><br>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="700" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
<BR><BR>
<CENTER><A HREF="?name=admin&file=main"><IMG SRC="images/icon/login-welcome.gif" BORDER="0"></A><BR><BR>
<FONT COLOR="#336600"><B><?=_ADMIN_LOGIN_MESSAGE_ACC;?></B></FONT><BR><BR>
<A HREF="?name=admin&file=main"><B><?=_ADMIN_GOBACK;?></B></A>
</CENTER>
<? echo "<meta http-equiv='refresh' content='1; url=?name=admin&file=main'>" ; ?>
<BR><BR>
<?
}else{
	//Login ไม่ผ่าน

?>
        <TR>
          <TD width="720" vAlign=top align=left><BR>
				<TABLE width="700" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD>
	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD vAlign=top align=center class="login" align="center"><FONT COLOR="#990000" size="3"><b><?=_ADMIN_LOGIN_MESSAGE_NOACC;?></b></font>
		  </td>
		</tr>
        <TR>
          <TD vAlign=top align=center><BR>
<div id="maincontent">
	<div id="loginform">
		<h2>Admin<span class="gray">istrator ! login</span></h2>
		<form name="login" id="login" method="post" action="?name=admin&file=login">
			<p>
				<?=_ADMIN_MOD_INDEX_USER;?> :
				<input type="text" name="username" id="username" class="<?php echo $classbox[0]; ?>"  value="<?php echo $username; ?>"  onclick="this.value=''" /><br />
				<?=_ADMIN_MOD_INDEX_PASS;?> : 
				<input type="password" name="password" id="password" class="<?php echo $classbox[1]; ?>"  value="<?php echo $password; ?>"  onclick="this.value=''" /><br />
		    	<div><?
if(USE_CAPCHA){
?>
						<?if(CAPCHA_TYPE == 1){ 
							echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						}else if(CAPCHA_TYPE == 2){ 
							echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						};?>&nbsp;
						<input name="security_code" type="text" id="security_code" class="<?php echo $classbox[1]; ?>" onclick="this.value=''" maxlength="10" size="10">

<?
}
?></div><br>
				<input type="hidden" name="action" id="action" value="login"> 
                <input name="button" type="submit" class="button" id="button" value="<?=_ADMIN_MOD_BUTTON_ADD;?>"   />
                <input name="button2" type="button" class="button" id="button2" value="<?=_ADMIN_MOD_BUTTON_CANCLE;?>" onClick="window.location='index.php'" /><br />
			</p>
		</form>
		<div style="line-height: 18px">
            <br />
<?=_ADMIN_MOD_CREDIT_ATOM1;?> :   <a href="http://maxtom.sytes.net"><font color="#3399FF"><b><?=_ADMIN_MOD_CREDIT_ATOM2;?></b></font></a><br>
<?=_ADMIN_MOD_CREDIT_ATOM3;?>
		</div>
	</div>
</div>
</td>
</tr>
</TABLE>
<?
}
?>
					</TD>
				</TR>
			</TABLE>
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
				</TD>
				</TR>
			</TABLE>
