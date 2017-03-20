<?php 
//session_save_path('/var/www/vhosts/buraphank.com/httpdocs/sessions');
ob_start();
if (session_id() =='') { session_start(); }
//session_start();
$globals_test = @ini_get('register_globals');
if ( isset($globals_test) && empty($globals_test) ) {
$types_to_register = array('GET', 'POST', 'COOKIE', 'SESSION', 'SERVER');
foreach ($types_to_register as $type) {
$arr = @${'_' . $type};
if (@count($arr) > 0)
extract($arr, EXTR_SKIP);
}
}
//error_reporting(E_ALL);

//error_reporting(E_ALL ^ E_NOTICE);
//หากมีการเรียกไฟล์นี้โดยตรง
if (preg_match("/mainfile.php/i",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}
$PHP_SELF = "index.php";
require_once("setconf.php");
require_once("includes/config.in.php");
require_once("includes/function.in.php");
require_once("includes/class.mysql.php");
require_once("includes/array.in.php");
require_once("includes/class.ban.php");
require_once("includes/class.calendar.php");
header( 'Content-Type:text/html; charset='.ISO.'');
$db = New DB();
empty($_SESSION['admin_user'])?$admin_user="":$admin_user=$_SESSION['admin_user'];
empty($_SESSION['admin_pwd'])?$admin_pwd="":$admin_pwd=$_SESSION['admin_pwd'];
empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];
empty($_SESSION['pwd_login'])?$pwd_login="":$pwd_login=$_SESSION['pwd_login'];
empty($_GET['op'])?$op="":$op=$_GET['op'];
empty($_GET['action'])?$action="":$action=$_GET['action'];
empty($_GET['page'])?$page="":$page=$_GET['page'];
empty($_GET['category'])?$category="":$category=$_GET['category'];
empty($_POST['loop'])?$loop="":$loop=$_POST['loop'];
$IPADDRESS=get_real_ip();
if (!empty($admin_user)){
if(empty($_SESSION['ua']) || $_SESSION['ua'] != $admin_user.":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'])
{
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->del(TB_useronline," useronline='".$_SESSION['admin_user']."' "); 
$db->add_db(TB_IPBLOCK,array(
	"ip"=>"".$IPADDRESS."",
	"post_date"=>"".time().""
	));
$db->closedb ();
session_unset();
//session_destroy();
session_regenerate_id(); // เริ่ม session อื่นใหม
die('Session Hijacking Attempt');
}

} 
if(!empty($login_true)){
if(empty($_SESSION['uax']) || $_SESSION['uax'] != $login_true.":".$_SERVER['HTTP_USER_AGENT'].":".$IPADDRESS.":".$_SERVER['HTTP_ACCEPT_LANGUAGE'])
{
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->del(TB_useronline," useronline='".$_SESSION['login_true']."' "); 
$db->add_db(TB_IPBLOCK,array(
	"ip"=>"".$IPADDRESS."",
	"post_date"=>"".time().""
	));
$db->closedb ();
session_unset();
//session_destroy();
session_regenerate_id(); // เริ่ม session อื่นใหม
die('Session Hijacking Attempt');
}
}
//ตรวจสอบว่ามีโมดูลหรือไม่ (โมดูล User)
function GETMODULE($name,$file){
	global $MODPATH, $MODPATHFILE ;
	$targetPath = WEB_PATH;
	if(empty($name)){$name= "index";}
	if(empty($file)){$file = "index";}
	$files = str_replace('../', '', $file);
	$names = str_replace('../', '', $name);
$modpathfile=$targetPath."/modules/".$names."/".$files.".php";
if (file_exists($modpathfile)) {
	$MODPATHFILE = $modpathfile;
	$MODPATH = $targetPath."/modules/".$names."/";
	}else{
header( 'Content-Type:text/html; charset='.ISO.'');
	die (""._NO_MOD."");
	}
}


//ผู้ดูแลระบบไม่ผ่านสิทธิการใช้งาน
$PermissionFalse = "<BR><BR>";
$PermissionFalse .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\"></A><BR><BR>";
$PermissionFalse .= "<FONT COLOR=\"#336600\"><B>"._PERMISSION_ADMIN."</B></FONT><BR><BR>";
$PermissionFalse .= "<A HREF=\"?name=admin&file=main\"><B>"._PERMISSION_INDEX."</B></A>";
$PermissionFalse .= "</CENTER>";
$PermissionFalse .= "<BR><BR>";

// ส่วนของระบบสมาชิกเพิ่มเติมภายหลังโดย narongrit.net
$home = "".WEB_URL."" ; // url เว็บไซด์ของคุณ เวลาที่ต้องการเรียก
$admin_email = "".WEB_EMAIL."" ; // อีเมล์ของคุณ
$yourcode = "web" ; // รหัสนำหน้าหมายเลขสมาชิกของคุณ เช่น ip00001 , abc00005
$member_num_show = 5 ;  // จำนวนของสมาชิกที่ต้องการให้แสดงต่อ  1 หน้า ในระบบของ admin 
$member_num_show_last = 5 ;  // จำนวนของสมาชิกล่าสุดที่ต้องการให้แสดง
$member_num_last = 1 ;  // จำนวนของสมาชิกล่าสุดที่ต้องการให้แสดงหน้าแรก

$bkk= mktime(gmdate("H")+7,gmdate("i")+0,gmdate("s"),
	gmdate("m") ,gmdate("d"),gmdate("Y"));
$datetimeformat="j/m/y - H:i";
$now = date($datetimeformat,$bkk);

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$IPB=$db->select_query("select * from ".TB_IPBLOCK." where ip='".$IPADDRESS."' ");
$IPBS=$db->fetch($IPB);
$db->closedb ();
$IPBLOCK=$IPBS['ip'];
if ($IPBLOCK){
?>
<BR><BR>
<CENTER><A HREF="?name=index"><IMG SRC="images/dangerous.png" BORDER="0"></A><BR><BR>
<FONT COLOR="#336600"><B><?php echo _ADMIN_IPBLOCK_MESSAGE_HACK;?> <?php echo WEB_EMAIL;?></B></FONT><BR><BR>
<A HREF="?name=index"><B><?php echo _ADMIN_IPBLOCK_MESSAGE_HACK1;?></B></A>
</CENTER>
<BR><BR>
<?php 
exit();
} else {
$timestamp=time();
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['user3'] = $db->select_query("SELECT * FROM ".TB_useronline." where timeout < $timestamp");
//$rows['user3'] = $db->fetch($res['user3']);
//if($rows['user3']['useronline']){
while ($rows['user3'] = $db->fetch($res['user3'])){
if ($login_true==$rows['user3']['useronline']){
//$db->del(TB_useronline,"  timeout < $timestamp  "); 
$db->del(TB_useronline,"  timeout < $timestamp and useronline='".$login_true."' "); 
session_unset($rows['user3']['useronline']);
setcookie($rows['user3']['useronline'],'');
} else if ($admin_user==$rows['user3']['useronline']){
$db->del(TB_useronline,"  timeout < $timestamp and useronline='".$admin_user."' "); 
session_unset($rows['user3']['useronline']);
setcookie($rows['user3']['useronline'],'');
} else {
$db->del(TB_useronline,"  timeout < $timestamp  "); 
session_unset($rows['user3']['useronline']);
setcookie($rows['user3']['useronline'],'');
}
}

require_once("templates/".WEB_TEMPLATES."/function.php");
}

?>

