<?php
/**
* @version $Id: install4.php,v 1.10 2005/02/20 19:47:42 mic Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
* @edited by mic (developer@mamboworld.net) www.mamboworld.net
*/

/** Set flag that this is a parent file */
//require_once("../mainfile.php");
include_once ( 'common.php' );
//include( 'language/install_thai.php' );

$DBhostname = trim( mosGetParam( $_POST, 'DBhostname', '' ) );
$DBuserName = trim( mosGetParam( $_POST, 'DBuserName', '' ) );
$DBpassword = trim( mosGetParam( $_POST, 'DBpassword', '' ) );
$DBname  	= trim( mosGetParam( $_POST, 'DBname', '' ) );
$DBPrefix  	= trim( mosGetParam( $_POST, 'DBPrefix', '' ) );
$DBSample  	= trim( mosGetParam( $_POST, 'DBSample', '' ) );
$sitename  	= trim( mosGetParam( $_POST, 'sitename', '' ) );
$adminEmail = trim( mosGetParam( $_POST, 'adminEmail', '') );
$siteUrl  	= trim( mosGetParam( $_POST, 'siteUrl', '' ) );
$footer1= trim( mosGetParam( $_POST, 'footer1', '' ) );
$footer2 = trim( mosGetParam( $_POST, 'footer2', '' ) );
$templates = trim( mosGetParam( $_POST, 'templates', '' ) );
$use_capcha= trim( mosGetParam( $_POST, 'use_capcha', '' ) );
$capcha_type= trim( mosGetParam( $_POST, 'capcha_type', '' ) );
$capcha_num = trim( mosGetParam( $_POST, 'capcha_num', '' ) );
$absolutePath = trim( mosGetParam( $_POST, 'absolutePath', '' ) );
$adminPassword = trim( mosGetParam( $_POST, 'adminPassword', '') );
$language_install = trim( mosGetParam( $_POST, 'language_install', '' ) );
$installer_version = trim( mosGetParam( $_POST, 'installer_version', '' ) );
$detected_lang = trim( mosGetParam( $_POST, 'detected_lang', '' ) );
$install_iso = trim( mosGetParam( $_POST, 'install_iso', '' ) );

$filePerms = '';
if ( mosGetParam( $_POST, 'filePermsMode', 0 ) )
	$filePerms = '0'.
		(mosGetParam($_POST,'filePermsUserRead',0) * 4 +
	     mosGetParam($_POST,'filePermsUserWrite',0) * 2 +
	     mosGetParam($_POST,'filePermsUserExecute',0)).
		(mosGetParam($_POST,'filePermsGroupRead',0) * 4 +
	     mosGetParam($_POST,'filePermsGroupWrite',0) * 2 +
	     mosGetParam($_POST,'filePermsGroupExecute',0)).
		(mosGetParam($_POST,'filePermsWorldRead',0) * 4 +
	     mosGetParam($_POST,'filePermsWorldWrite',0) * 2 +
	     mosGetParam($_POST,'filePermsWorldExecute',0));

$dirPerms = '';
if ( mosGetParam( $_POST, 'dirPermsMode', 0 ) )
	$dirPerms = '0'.
		(mosGetParam($_POST,'dirPermsUserRead',0) * 4 +
	     mosGetParam($_POST,'dirPermsUserWrite',0) * 2 +
	     mosGetParam($_POST,'dirPermsUserSearch',0)).
		(mosGetParam($_POST,'dirPermsGroupRead',0) * 4 +
	     mosGetParam($_POST,'dirPermsGroupWrite',0) * 2 +
	     mosGetParam($_POST,'dirPermsGroupSearch',0)).
		(mosGetParam($_POST,'dirPermsWorldRead',0) * 4 +
	     mosGetParam($_POST,'dirPermsWorldWrite',0) * 2 +
	     mosGetParam($_POST,'dirPermsWorldSearch',0));

if($language_install=='thai'){
define("iso","TIS620");
define("resultsx","tis620");
define("langset","tis620_thai_ci");
} else  if($language_install=='thai_utf-8'){
define("iso","UTF8");
define("resultsx","utf8");
define("langset","utf8_general_ci");
} else {
$language_install='thai';
define("iso","TIS620");
define("resultsx","tis620");
define("langset","tis620_thai_ci");
}

if (file_exists( 'language/install_' . $language_install . '.php' ) ) {
 	require 'language/install_' . $language_install . '.php';
} else {
	include( 'language/install_thai.php' );
}
//echo $install_iso;
function html_convert( $text ){
	// if php <= 4.3 we cannot use htm_entity_decode (borought by php.net)
	if( phpversion() <= '4.3.0' ) {
		$trans_tbl = get_html_translation_table( HTML_ENTITIES );
   		$trans_tbl = array_flip( $trans_tbl );
   		$text = strtr( $text, $trans_tbl );
	}else{
		// php.version is greater then 4.3.0
		$text = html_entity_decode( $text );
	}
	return $text;
}

if ((trim($adminEmail== "")) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $adminEmail )==false)) {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBPrefix\" value=\"$DBPrefix\" />
		<input type=\"hidden\" name=\"install_iso\" value=\"$install_iso\" />
		<input type=\"hidden\" name=\"DBSample\" value=\"$DBSample\">
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
			<input type=\"hidden\" name=\"footer1\" value=\"$footer1\" />
			<input type=\"hidden\" name=\"footer2\" value=\"$footer2\" />
				<input type=\"hidden\" name=\"templates\" value=\"$templates\" />
			<input type=\"hidden\" name=\"use_capcha\" value=\"$use_capcha\" />
			<input type=\"hidden\" name=\"capcha_type\" value=\"$capcha_type\" />
			<input type=\"hidden\" name=\"capcha_num\" value=\"$capcha_num\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"installer_version\" value=\"$installer_version\" />
		<input type=\"hidden\" name=\"detected_lang\" value=\"$detected_lang\" />
		<input type=\"hidden\" name=\"install_iso\" value=\"$install_iso\" />
		<input type=\"hidden\" name=\"filePerms\" value=\"$filePerms\" />
		<input type=\"hidden\" name=\"dirPerms\" value=\"$dirPerms\" />
		</form>";
	echo "<script>alert('" . html_convert( _INSTALL_JS_CHECKEMAIL ) . "'); document.stepBack.submit(); </script>";
	return;
}

if($DBhostname && $DBuserName && $DBname) {
	$configArray['DBhostname'] = $DBhostname;
	$configArray['DBuserName'] = $DBuserName;
	$configArray['DBpassword'] = $DBpassword;
	$configArray['DBname']     = $DBname;
	$configArray['DBPrefix']   = $DBPrefix;
	$configArray['install_iso']   = $install_iso;
} else {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBPrefix\" value=\"$DBPrefix\" />
		<input type=\"hidden\" name=\"install_iso\" value=\"$install_iso\" />
		<input type=\"hidden\" name=\"DBSample\" value=\"$DBSample\">
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"footer1\" value=\"$footer1\" />
		<input type=\"hidden\" name=\"footer2\" value=\"$footer2\" />
			<input type=\"hidden\" name=\"templates\" value=\"$templates\" />
		<input type=\"hidden\" name=\"use_capcha\" value=\"$use_capcha\" />
		<input type=\"hidden\" name=\"capcha_type\" value=\"$capcha_type\" />
		<input type=\"hidden\" name=\"capcha_num\" value=\"$capcha_num\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"installer_version\" value=\"$installer_version\" />
		<input type=\"hidden\" name=\"detected_lang\" value=\"$detected_lang\" />
		<input type=\"hidden\" name=\"install_iso\" value=\"$install_iso\" />
		<input type=\"hidden\" name=\"filePerms\" value=\"$filePerms\" />
		<input type=\"hidden\" name=\"dirPerms\" value=\"$dirPerms\" />
		</form>";

	echo "<script>alert('" . html_convert( _INSTALL_JS_CHECKDB ) . "'); document.stepBack.submit(); </script>";
	return;
}

if ($sitename) {
	if (!get_magic_quotes_gpc()) {
		$configArray['sitename'] = addslashes($sitename);
	} else {
		$configArray['sitename'] = $sitename;
	}
} else {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBPrefix\" value=\"$DBPrefix\" />
		<input type=\"hidden\" name=\"install_iso\" value=\"$install_iso\" />
		<input type=\"hidden\" name=\"DBSample\" value=\"$DBSample\" />
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"footer1\" value=\"$footer1\" />
		<input type=\"hidden\" name=\"footer2\" value=\"$footer2\" />
			<input type=\"hidden\" name=\"templates\" value=\"$templates\" />
		<input type=\"hidden\" name=\"use_capcha\" value=\"$use_capcha\" />
		<input type=\"hidden\" name=\"capcha_type\" value=\"$capcha_type\" />
		<input type=\"hidden\" name=\"capcha_num\" value=\"$capcha_num\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"installer_version\" value=\"$installer_version\" />
		<input type=\"hidden\" name=\"detected_lang\" value=\"$detected_lang\" />
		<input type=\"hidden\" name=\"install_iso\" value=\"$install_iso\" />
		<input type=\"hidden\" name=\"filePerms\" value=\"$filePerms\" />
		<input type=\"hidden\" name=\"dirPerms\" value=\"$dirPerms\" />
		</form>";

	echo "<script>alert('".html_convert(_INSTALL_JS_CHECKSITENAME)."'); document.stepBack2.submit();</script>";
	return;
}

if (file_exists( '../includes/config.in.php' )) {
	$canWrite = is_writable( '../includes/config.in.php' );
} else {
	$canWrite = is_writable( '../includes/..' );
}

if ($siteUrl) {

$FileBNK = "../includes/config.in.php.bnk";
$FileBNKOpen = @fopen($FileBNK, "r");
$FileBNKContent = @fread ($FileBNKOpen, @filesize($FileBNK));
@fclose ($FileBNKOpen);

$FileBNKContent = str_replace ("%DB_HOST%", $DBhostname, $FileBNKContent);
$FileBNKContent = str_replace ("%DB_NAME%", $DBname, $FileBNKContent);
$FileBNKContent = str_replace ("%DB_USERNAME%", $DBuserName, $FileBNKContent);
$FileBNKContent = str_replace ("%DB_PASSWORD%", $DBpassword, $FileBNKContent);
$FileBNKContent = str_replace ("%ISO%", $install_iso, $FileBNKContent);

$FileBNKContent = str_replace ("%USE_CAPCHA%", $use_capcha, $FileBNKContent);
$FileBNKContent = str_replace ("%CAPCHA_TYPE%", $capcha_type, $FileBNKContent);
$FileBNKContent = str_replace ("%CAPCHA_NUM%", $capcha_num, $FileBNKContent);
$FileBNKContent = str_replace ("%WEB_TIMESTART%", "".time()."", $FileBNKContent);

$config_open = @fopen("../includes/config.in.php", "w");
@fwrite($config_open, "".$FileBNKContent."");
@fclose($config_open);

	// create the admin user
 //$db->connectdb($DBname,$DBuserName,$DBpassword);
$host=addslashes($_POST['DBhostname']);
$db_name=addslashes($_POST['DBname']);
$db_user=addslashes($_POST['DBuserName']);
$db_pwd=addslashes($_POST['DBpassword']);


$connect=mysql_connect($host,$db_user,$db_pwd) or die( mysql_error());
$select=mysql_select_db($db_name);
//mysql_query("SET NAMES ".$resultsx." collation_connection=".$langset." collation_database=".$langset." collation_server=".$langset.""); 
	mysql_query("SET NAMES ".iso.""); 
	mysql_query("SET character_set_results=".resultsx.""); 
	mysql_query("SET character_set_client=".resultsx."");
	mysql_query("SET character_set_connection=".resultsx."");
	mysql_query("collation_connection=".langset.""); 
	mysql_query("collation_database=".langset.""); 
	mysql_query("collation_server=".langset."");
	$installdate = date("Y-m-d H:i:s");
//	$query = "INSERT INTO `{$DBPrefix}users` VALUES (62, 'Administrator', 'admin', '$adminEmail', '$cryptpass', 'Superadministrator', 0, 1, 25, '$installdate', '0000-00-00 00:00:00', '', '')";
	//mysql_query( $query );
$cryptpass = md5($adminPassword);
$sql = "update  web_admin set password='$cryptpass', email='$adminEmail' where username='admin'";
$result = mysql_query($sql);
$sqlx = "update  web_member set password='$cryptpass', email='$adminEmail' where user='admin'";
$resultx = mysql_query($sqlx);

if($sitename){
$sqls = "update  web_config set name='$sitename' where posit='title' ";
$results = mysql_query($sqls);
}
if($siteUrl){
$sqls = "update  web_config set name='$siteUrl' where posit='url' ";
$results = mysql_query($sqls);
}
if($absolutePath){
$sqls = "update  web_config set name='$absolutePath' where posit='path' ";
$results = mysql_query($sqls);
}
if($adminEmail){
$sqls = "update  web_config set name='$adminEmail' where posit='email' ";
$results = mysql_query($sqls);
}
if($footer1){
$sqls = "update  web_config set name='$footer1' where posit='footer1' ";
$results = mysql_query($sqls);
}
if($footer2){
$sqls = "update  web_config set name='$footer2' where posit='footer2' ";
$results = mysql_query($sqls);
}
if($templates){
$sqls = "update  web_config set name='$templates' where posit='templates' ";
$results = mysql_query($sqls);
}
if($install_iso){
$sqls = "update  web_config set name='$install_iso' where posit='iso' ";
$results = mysql_query($sqls);
}
	// +++++++++++++++++++++++++++++++
	// chmod files and directories if desired
   	$chmod_report = _INSTALL_MESS_DIRSAND_FILES_UNCHANGED;
	if ($filePerms != '' || $dirPerms != '') {
		$mosrootfiles = array(
	        'attach',
	        'backup',
	        'data',
	        'images/personnel',
	        'images/random',
	        'images/icon',
	        'images/gallery',
	        'icon',
	        'templates',
	        'modules/aboutus',
	        'modules/editortalk',
	        'modules/block/banner.xml',
	        'modules/rss/news.xml',
	        'modules/smiletag/data',
			'templates',
			'video',
	        'UserFiles',
	        'webboard_upload',
	        'includes/config.in.php',
	        'install',
	        'download.dat',
	        'research.dat'
		);
		$filemode = NULL;
	    if ($filePerms != '') $filemode = octdec($filePerms);
	    $dirmode = NULL;
	    if ($dirPerms != '') $dirmode = octdec($dirPerms);
		$chmodOk = TRUE;
		foreach ($mosrootfiles as $file)
		    if (!mosChmodRecursive($absolutePath.'/'.$file, $filemode, $dirmode))
				$chmodOk = FALSE;
		
	    if ($chmodOk)
			$chmod_report = _INSTALL_CHMOD_DIR;
	    else{
			$chmod_mail = 1;
			$chmod_report = _INSTALL_CHMOD_DIR_FAIL.'
			<strong>
			/attach<br />
	    	/modules/aboutus<br />
		    /backup<br />
		    /data<br />
		    /icon<br />
		    /modules/editortalk<br />
		    /images/personnel<br />
		    /images/random<br />
		    /images/icon<br />
		    /images/gallery<br />
		    /modules/smiletag/data<br />
			/templates<br />
		    /UserFiles<br />
		    /webboard_upload<br />
		    /video<br />
		    /install<br />
		    /templates<br />'
			. _INSTALL_CHMOD_FILES_FAIL
		    . 'includes/config.in.php<br />
		    /modules/block/banner.xml<br />
		    /modules/rss/news.xml<br />
	    	download.dat<br />
		    research.dat<br />
			</strong>';
		}
	}

	// now rename the installation folder
	$ren_mail = false;
	// contruct a new name for installation folder
	$tmp_instname = crc32( time() );
	$tmp_instname = substr( $tmp_instname, 1, strlen( $tmp_instname ) ) . 'install';
	@chmod( $absolutePath.'/install', 0777 );
	if( @rename ( $absolutePath.'/install', $absolutePath.'/' . $tmp_instname ) ){
		$ren_mail = true;
		@chmod( $absolutePath.'/' . $tmp_instname, 0644 );
	}

} else { ?>
	<form action="install3.php" method="post" name="stepBack3" id="stepBack3">
  		<input type="hidden" name="DBhostname" value="<?php echo $DBhostname; ?>" />
  		<input type="hidden" name="DBusername" value="<?php echo $DBuserName; ?>" />
  		<input type="hidden" name="DBpassword" value="<?php echo $DBpassword; ?>" />
  		<input type="hidden" name="DBname" value="<?php echo $DBname; ?>" />
  		<input type="hidden" name="DBPrefix" value="<?php echo $DBPrefix; ?>" />
  		<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
  		<input type="hidden" name="DBcreated" value="1" />
  		<input type="hidden" name="sitename" value="<?php echo $sitename; ?>" />
  		<input type="hidden" name="installer_version" value="<?php echo $installer_version; ?>" />
  		<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
  		<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
  		<input type="hidden" name="adminEmail" value="<?php echo $adminEmail; ?>" />
  		<input type="hidden" name="siteUrl" value="<?php echo $siteUrl; ?>" />
  		<input type="hidden" name="absolutePath" value="<?php echo $absolutePath; ?>" />
  		<input type="hidden" name="filePerms" value="<?php echo $filePerms; ?>" />
  		<input type="hidden" name="dirPerms" value="<?php echo $dirPerms; ?>" />
  	</form>
	<?php
	echo "<script>alert('".html_convert(_INSTALL_JS_CHECKURL)."'); document.stepBack3.submit();</script>";
}
echo "<?xml version=\"1.0\" encoding=\"".$install_iso."\"?".">"; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$install_iso;?>" />
<title>ATOMYMAXSITE 2.5 - Web Installer :: <?php echo _INSTALL_STEP_4; ?></title>
<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="../css/install.css" type="text/css" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="atomymaxsite">
    		<?php echo '<font color="#FF9900"><strong>Version: ' ._SCRIPT.'  '. _VERSION. '</strong></font>'; ?>
    	</div>
	</div>
</div>

<div id="ctr" align="center">
		<form name="form" id="form">

	<div class="install">
		<div id="stepbar">
      	<div class="step-off"><?php echo _INSTALL_STEP_PRECHECK; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_LICENSE; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_1; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_2; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_3; ?></div>
		<div class="step-on"><?php echo _INSTALL_STEP_4; ?></div>
		</div>
		<div id="right">

	  <div id="step"><?php echo _INSTALL_STEP_4; ?></div>

	  <div class="far-right">
        <input class="button" type="button" name="runSite" value="<?php echo _INSTALL_VIEWSITE; ?>"
     		<?php if ($siteUrl){
     			print "onClick='window.location.href=\"$siteUrl"."/index.php\" '";
     		}	else {
     			print "onClick='window.location.href=\"{$configArray['siteURL']}"."/index.php\" '";
     		}
    		?> />
        <input class="button" type="button" name="Admin" value="<?php echo _INSTALL_LOGINADMIN; ?>"
     		<?php
     		if ($siteUrl){
     			print "onClick='window.location.href=\"$siteUrl"."?name=admin&file=index\" '";
     		} else {
     			print "onClick='window.location.href=\"{$configArray['siteURL']}"."/?name=admin&file=index\" '";
     		}
    		?> />
      </div>
    	<div class="clr"></div>
    	<h1><?php echo _INSTALL_CONGRATULATION; ?></h1>

      <div class="install-text"> <?php echo _INSTALL_DESCRIPTION; ?> </div>

	  <div class="install-form">
        <div class="form-block">
          <table width="100%">
            <tr>
              <td colspan="2" class="error" align="center">
              	<?php if( $ren_mail ) echo sprintf( _INSTALL_MAIL_DEL_INSTALLDIR_RENAME, $tmp_instname ); else echo _INSTALL_MAIL_DEL_INSTALLDIR; ?>
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center"><h5><?php echo _INSTALL_LOGIN; ?></h5></td>
            </tr>
            <tr>
              <td colspan="2" align="center" class="notice"><strong><?php echo _INSTALL_ADMIN_USERNAME; ?></strong></td>
            </tr>
            <tr>
              <td colspan="2" align="center" class="notice"><strong><?php echo _INSTALL_ADMIN_PASSWORD." ".$adminPassword; ?></strong></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="right">&nbsp;</td>
            </tr>
            <?php
    		  	if (!$canWrite) { ?>
            		<tr>
              			<td colspan="2" class="small"><?php echo html_convert(_INSTALL_ALERT); ?> </td>
            	   	</tr>
            		<tr>
              			<td colspan="2" align="center"> <textarea rows="5" cols="60" name="configcode" onclick="javascript:this.form.configcode.focus();this.form.configcode.select();" ><?php echo html_convert( $config ); ?></textarea>
              			</td>
            		</tr>
            		<?php
    		  	} ?>
          </table>
        </div>
      </div>
    	<div id="break"></div>
		</div>
		<div class="clr"></div>
		</form>
	<div class="clr"></div>
  </div>

</div>
<div align="center" class="install"><?php echo _INSTALL_FOOTER_CREDIT;?></div>
</div>
</html>