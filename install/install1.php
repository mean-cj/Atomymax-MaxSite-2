<?php
/**
* @version $Id: install1.php,v 1.7 2004/02/20 20:20:51 mic Exp $
* @package MMLi
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
* @edited by mic (developer@mamboworld.net) www.mamboworld.net
*/

/** Set flag that this is a parent file */

/** Include common.php */
//require_once("../mainfile.php");
include_once ( 'common.php' );
//include( 'language/install_thai.php' );

$DBhostname = trim( mosGetParam( $_POST, 'DBhostname', 'localhost' ) );
$DBuserName = trim( mosGetParam( $_POST, 'DBuserName', '' ) );
$DBpassword = trim( mosGetParam( $_POST, 'DBpassword', '' ) );
$DBverifypassword = trim(mosGetParam( $_POST, 'DBverifypassword', '' ) );
$DBname  	= trim( mosGetParam( $_POST, 'DBname', '' ) );
$DBPrefix  	= trim( mosGetParam( $_POST, 'DBPrefix', 'web_' ) );
$DBDel  	= trim( mosGetParam( $_POST, 'DBDel', '' ) );
$DBBackup  	= trim( mosGetParam( $_POST, 'DBBackup', '' ) );
$DBSample  	= trim( mosGetParam( $_POST, 'DBSample', 1 ) );
$DBHelp 	= trim( mosGetParam( $_POST, 'DBHelp', '' ) );
$DBcreated = trim( mosGetParam( $_POST, 'DBcreated', 0 ) );
$language_install = trim( mosGetParam( $_POST, 'language_install', '' ) );
$admin_language_install = trim( mosGetParam( $_POST, 'admin_language_install', '' ) );
$user_language_install = trim( mosGetParam( $_POST, 'user_language_install', '' ) );
$installer_version = trim( mosGetParam( $_POST, 'installer_version', '' ) );
$detected_lang = trim( mosGetParam( $_POST, 'detected_lang', '' ) );
$iso = trim( mosGetParam( $_POST, 'iso', '' ) );
$resultsx = trim( mosGetParam( $_POST, 'resultsx', '' ) );
$langset = trim( mosGetParam( $_POST, 'langset', '' ) );
$install_iso = trim( mosGetParam( $_POST, 'install_iso', '' ) );

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

//echo $install_iso;

if (file_exists( 'language/install_' . $language_install . '.php' )) {
 	require 'language/install_' . $language_install . '.php';
} else {
	include( 'language/install_thai.php' );
}

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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$install_iso;?>" />
<title>ATOMYMAXSITE 2.5 - Web Installer :: <?php echo _INSTALL_STEP_1; ?></title>
<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="../css/install.css" type="text/css" />
<script language="javascript" type="text/javascript">
<!--
function check() {
	<!-- form validation check -->
	var formValid=false;
	var f = document.form;
	if ( f.DBhostname.value == '' ) {
		alert('<?php echo html_convert( _INSTALL_DB_JS_HOSTNAME ); ?>');
		f.DBhostname.focus();
		formValid=false;
	} else if ( f.DBuserName.value == '' ) {
		alert('<?php echo html_convert( _INSTALL_DB_JS_USERNAME ); ?>');
		f.DBuserName.focus();
		formValid=false;
	} else if ( f.DBpassword.value == '' ) {
		alert('<?php echo html_convert( _INSTALL_DB_JS_PASSWORD ); ?>');
		f.DBpassword.focus();
		formValid=false;
	} else if ( f.DBname.value == '' ) {
		alert('<?php echo html_convert( _INSTALL_DB_JS_BASENAME ); ?>');
		f.DBname.focus();
		formValid=false;
	} else if ( confirm('<?php echo html_convert( _INSTALL_DB_JS_WARNING ); ?>')) {
		formValid=true;
	}
	return formValid;
}
// -->
</script>
</head>
<body onload="document.form.DBhostname.focus();"/>
<div id="wrapper">
	<div id="header">
		<div id="atomymaxsite">
    		<?php echo '<font color="#FF9900"><strong>Version: ' ._SCRIPT.'  '. _VERSION. '</strong></font>'; ?>
    	</div>
	</div>
</div>
<div id="ctr" align="center">
	<form action="install2.php" method="post" name="form" id="form" onsubmit="return check();">
	<input type="hidden" name="language_install" value="<?php echo $language_install; ?>">
	<input type="hidden" name="admin_language_install" value="<?php echo $admin_language_install; ?>">
	<input type="hidden" name="user_language_install" value="<?php echo $user_language_install; ?>">
	<input type="hidden" name="installer_version" value="<?php echo $installer_version; ?>" />
	<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
	<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
	<div class="install">
    <div id="stepbar">
      	<div class="step-off"><?php echo _INSTALL_STEP_PRECHECK ; ?></div>
		<div class="step-on"><?php echo _INSTALL_STEP_1 ; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_2 ; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_3 ; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_4 ; ?></div>
      </div>
      <div id="right">
      <div class="far-right">
        <input class="button" type="submit" name="next" value="<?php echo _INSTALL_NEXT; ?>"/>
      </div>
      <div id="step"><?php echo _INSTALL_STEP_1 ; ?></div>
  		<div class="clr"></div>
  		<h1><?php echo _INSTALL_DB_SECTION ; ?></h1>
      <div class="install-text" width=100%> <?php echo _INSTALL_DB_STEPS_DESCRIPTION; ?>
      </div><br><br>
      <div class="install-form">
        <div class="form-block">
          <table class="content2">

					<tr>
  						<td></td>
  						<td></td>
  					</tr>

            <tr>
              <td colspan="2"><?php echo _INSTALL_DB_HOSTNAME; ?><br/><input class="inputbox" type="text" name="DBhostname" value="<?php echo "$DBhostname"; ?>" /></td>
			  <td><em><?php echo _INSTALL_DB_HOSTNAME_DESCRIPTION ; ?></em></td>
            </tr>
            <tr>
              <td colspan="2"><?php echo _INSTALL_DB_USERNAME ; ?><br/><input class="inputbox" type="text" name="DBuserName" value="<?php echo "$DBuserName"; ?>" /></td>
			  <td><em><?php echo _INSTALL_DB_USERNAME_DESC ; ?></em></td>
            </tr>
            <tr>
              <td colspan="2"><?php echo _INSTALL_DB_PASSWORD ; ?><br/><input class="inputbox" type="password" name="DBpassword" value="<?php echo "$DBpassword"; ?>" /></td>
              <td align="left" class="warning" colspan="2"><?php echo _INSTALL_DB_PASSWORD_DESCRIPTION ; ?></td>
            </tr>
			<tr>
				<td colspan="2"><?php echo _INSTALL_DB_PASSWORD_VERRIFY ; ?><br/><input class="inputbox" type="password" name="DBverifypassword" value="<?php echo "$DBverifypassword"; ?>" /></td>
				<td><em><?php echo _INSTALL_DB_PASSWORD_VERRIFY_DESC ; ?></em></td>
			</tr>
            <tr>
              <td colspan="2"><?php echo _INSTALL_DB_BASENAME ; ?><br/><input class="inputbox" type="text" name="DBname" value="<?php echo "$DBname"; ?>" /></td><td><em><?php echo _INSTALL_DB_NAME ; ?></em></td>
            </tr>
             <tr>
			  <td><input type="checkbox" name="DBDel" id="DBDel" value="1" <?php if ($DBDel) echo 'checked="checked"'; ?> /></td>
					<td><label for="DBDel"><?php echo _INSTALL_DB_DROPTABLES ; ?></label></td>
  						<td><em><?php echo _INSTALL_DB_BACKUP_DESCRIPTION ; ?></em></td>
			  </tr>

          </table>
        </div>
      </div>
    </div>
	<div class="clr"></div>
	</form>
	<div class="clr"></div>
  </div>

</div>
<div align="center" class="install"><?php echo _INSTALL_FOOTER_CREDIT;?></div>
</body>
</html>