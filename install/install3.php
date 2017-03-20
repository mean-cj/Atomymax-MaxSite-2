<?php
/**
* @version $Id: install3.php,v 1.6 2005/02/20 19:18:51 mic Exp $
* @package MMLi
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
$filePerms = mosGetParam( $_POST, 'filePerms', '');
$dirPerms = mosGetParam( $_POST, 'dirPerms', '');
$footer1= trim( mosGetParam( $_POST, 'footer1', '' ) );
$footer2 = trim( mosGetParam( $_POST, 'footer2', '' ) );
$templates=trim( mosGetParam( $_POST, 'picture', '' ) );
$configArray['siteUrl'] = trim( mosGetParam( $_POST, 'siteUrl', '' ) );
$configArray['absolutePath'] = trim( mosGetParam( $_POST, 'absolutePath', '' ) );
$language_install = trim( mosGetParam( $_POST, 'language_install', '' ) );
$admin_language_install = trim( mosGetParam( $_POST, 'admin_language_install', '' ) );
$user_language_install = trim( mosGetParam( $_POST, 'user_language_install', '' ) );
$installer_version = trim( mosGetParam( $_POST, 'installer_version', '' ) );
$detected_lang = trim( mosGetParam( $_POST, 'detected_lang', '' ) );
$install_iso = trim( mosGetParam( $_POST, 'install_iso', '' ) );

if (get_magic_quotes_gpc()) {
	$configArray['absolutePath'] = stripslashes(stripslashes($configArray['absolutePath']));
	$sitename = stripslashes(stripslashes($sitename));
}
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
if( file_exists( 'language/install_' . $language_install . '.php' ) ){
 	require 'language/install_' . $language_install . '.php';
} else {
	include( 'language/install_thai.php' );
}
//echo $install_iso;
if ($sitename == '') {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install2.php\">
			<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
			<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
			<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
			<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
			<input type=\"hidden\" name=\"DBPrefix\" value=\"$DBPrefix\" />
			<input type=\"hidden\" name=\"DBSample\" value=\"$DBSample\" />
			<input type=\"hidden\" name=\"footer1\" value=\"$footer1\" />
			<input type=\"hidden\" name=\"footer2\" value=\"$footer2\" />
			<input type=\"hidden\" name=\"templates\" value=\"$templates\" />
			<input type=\"hidden\" name=\"DBcreated\" value=1 />
			<input type=\"hidden\" name=\"language_install\" value=\"$language_install\" />
			<input type=\"hidden\" name=\"admin_language_install\" value=\"$admin_language_install\" />
			<input type=\"hidden\" name=\"user_language_install\" value=\"$user_language_install\" />
			<input type=\"hidden\" name=\"installer_version\" value=\"$installer_version\" />
			<input type=\"hidden\" name=\"detected_lang\" value=\"$detected_lang\" />
			<input type=\"hidden\" name=\"install_iso\" value=\"$install_iso\" />
		</form>";

	echo "<script>alert('".html_convert(_INSTALL_SITE_NONAME)."'); document.stepBack.submit();</script>";
	return;
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

echo "<?xml version=\"1.0\" encoding=\"".$install_iso."\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$install_iso;?>" />
<title>ATOMYMAXSITE 2.5 - Web Installer :: <?php echo _INSTALL_STEP_3; ?></title>
<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="../css/install.css" type="text/css" />
<script language="javascript" type="text/javascript">
<!--
function check() {
	<!-- form validation check -->
	var formValid = true;
	var f = document.form;
	if ( f.siteUrl.value == '' ) {
		alert('<?php echo html_convert(_INSTALL_JS_SITENAME); ?>');
		f.siteUrl.focus();
		formValid = false;
	} else if ( f.absolutePath.value == '' ) {
		alert('<?php echo html_convert(_INSTALL_JS_PATH); ?>');
		f.absolutePath.focus();
		formValid = false;
	} else if ( f.adminEmail.value == '' ) {
		alert('<?php echo html_convert(_INSTALL_JS_EMAIL); ?>');
		f.adminEmail.focus();
		formValid = false;
	} else if ( f.adminPassword.value == '' ) {
		alert('<?php echo html_convert(_INSTALL_JS_PASSWORD); ?>');
		f.adminPassword.focus();
		formValid = false;
	}

	return formValid;
}

function changeFilePermsMode(mode)
{
    if(document.getElementById) {
        switch (mode) {
            case 0:
                document.getElementById('filePermsFlags').style.display = 'none';
                break;
            default:
                document.getElementById('filePermsFlags').style.display = '';
        } // switch
    } // if
}

function changeDirPermsMode(mode)
{
    if(document.getElementById) {
        switch (mode) {
            case 0:
                document.getElementById('dirPermsFlags').style.display = 'none';
                break;
            default:
                document.getElementById('dirPermsFlags').style.display = '';
        } // switch
    } // if
}
//-->
</script>
</head>
<body onload="document.form.siteUrl.focus();"/>
<div id="wrapper">
	<div id="header">
		<div id="atomymaxsite">
    		<?php echo '<font color="#FF9900"><strong>Version: ' ._SCRIPT.'  '. _VERSION. '</strong></font>'; ?>
    	</div>
	</div>
</div>
<div id="ctr" align="center">
	<form action="install4.php" method="post" name="form" id="form" onsubmit="return check();">
	<input type="hidden" name="DBhostname" value="<?php echo "$DBhostname"; ?>" />
	<input type="hidden" name="DBuserName" value="<?php echo "$DBuserName"; ?>" />
	<input type="hidden" name="DBpassword" value="<?php echo "$DBpassword"; ?>" />
	<input type="hidden" name="DBname" value="<?php echo "$DBname"; ?>" />
	<input type="hidden" name="DBPrefix" value="<?php echo "$DBPrefix"; ?>" />
	<input type="hidden" name="DBSample" value="<?php echo "$DBSample"; ?>" />
	<input type="hidden" name="sitename" value="<?php echo "$sitename"; ?>" />
	<input type="hidden" name="footer1" value="<?php echo "$footer1"; ?>" />
	<input type="hidden" name="footer2" value="<?php echo "$footer2"; ?>" />
	<input type="hidden" name="templates" value="<?php echo "$templates"; ?>" />
	<input type="hidden" name="language_install" value="<?php echo $language_install; ?>">
	<input type="hidden" name="admin_language_install" value="<?php echo $admin_language_install; ?>">
	<input type="hidden" name="user_language_install" value="<?php echo $user_language_install; ?>">
	<input type="hidden" name="installer_version" value="<?php echo $installer_version; ?>" />
	<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
	<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
	<div class="install">
    	<div id="stepbar">
      		<div class="step-off"><?php echo _INSTALL_STEP_PRECHECK ; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_LICENSE ; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_1 ; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_2 ; ?></div>
			<div class="step-on"><?php echo _INSTALL_STEP_3 ; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_4 ; ?></div>
      	</div>
      	<div id="right">

      		<div id="step"><?php echo _INSTALL_STEP_3 ; ?></div>
      			<div class="far-right">
        			<input class="button" type="submit" name="next" value="<?php echo _INSTALL_NEXT; ?>" />
      			</div>
    			<div class="clr"></div>

    			<h1><?php echo _INSTALL_SITE_SECTION ; ?></h1>

      			<div class="install-text"> <?php echo _INSTALL_SITE_DESCRIPTION ; ?> </div>
      				<div class="install-form">
        				<div class="form-block">
          					<table class="content2">
            					<tr>
    		  						<td width="100"><?php echo _INSTALL_SITE_URL; ?></td>
									<?php
									$url = '';
									if( $configArray['siteUrl'] ){
										$url = $configArray['siteUrl'];
    								}else{
        								$root = $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
    		        					$root = str_replace( 'install/', '', $root);
    		        					$root = str_replace( '/install3.php', '', $root);
        								$url = 'http://' . $root;
    		    					}
?>    		   						<td align="center"><input class="inputbox" type="text" name="siteUrl" value="<?php echo $url; ?>" size="50" /></td>
            					</tr>
            					<tr>
    								<td><?php echo _INSTALL_SITE_PATH ; ?></td>
									<?php
									$abspath = '';
									if( $configArray['absolutePath'] ){
    									$abspath = $configArray['absolutePath'];
									}else{
    		        					$path = getcwd();
    		            				if( preg_match( '/\/install/i', $path )) {
    		            					$abspath = str_replace( '/install', '', $path);
    		            				}else{
    		            					$abspath = str_replace( '\install' , '', $path);
    		            				} 
    		            			} ?>
    		            			<td align="center"><input class="inputbox" type="text" name="absolutePath" value="<?php echo $abspath; ?>" size="50" /></td>
    		            		</tr>
    		            		<tr>
    		            			<td><?php echo _INSTALL_SUPERADMIN_EMAIL; ?></td>
    		            			<td align="center"><input class="inputbox" type="text" name="adminEmail" value="<?php echo "$adminEmail"; ?>" size="50" /></td>
								</tr>
								<tr>
    		            			<td><?php echo _INSTALL_SUPERADMIN_PASSWORD; ?></td>
    		            			<td align="center"><input class="inputbox" type="text" name="adminPassword" value="<?php echo mosMakePassword(8); ?>" size="50" /></td>
	                			</tr>
	                			<tr>
	                				<td>&nbsp;</td>
	                				<td><?php echo _INSTALL_ADMIN_PW; ?></td>
	                			</tr>

								<tr>
									<td colspan="2">
										<fieldset><legend><?php echo _INSTALL_CAPCHA_TITLE; ?></legend>
<table cellpadding="1" cellspacing="1" border="0">
      <tr>
        <td><div align="right"><?php echo _INSTALL_CAPCHA_ADD; ?></div></td>
        <td><div align="left">
            <input name="use_capcha" type="radio" value="true" checked="checked" />
          <?php echo _INSTALL_CAPCHA_TURE; ?>
            <input name="use_capcha" type="radio" value="false" />
<?php echo _INSTALL_CAPCHA_FALSE; ?></div></td>
      </tr>
      <tr>
        <td valign="top"><div align="right"><?php echo _INSTALL_CAPCHA_TYPE; ?></div></td>
        <td><div align="left">
          <input name="capcha_type" type="radio" value="2" checked="checked" />
          <?php echo _INSTALL_CAPCHA_NOMAL; ?><br />
          <input name="capcha_type" type="radio" value="1" />
        <?php echo _INSTALL_CAPCHA_SPE; ?></div></td>
      </tr>
      <tr>
        <td><div align="right"><?php echo _INSTALL_CAPCHA_NUM; ?></div></td>
        <td><div align="left">
          <input name="capcha_num" type="text" id="capcha_num" readonly style="color: #FF0000" value="4" size="5" maxlength="2" />
        </div></td>
      </tr>
      <tr>
	  </table>
										</fieldset>
									</td>
								</tr>

	                			<tr>
									<?php
									$mode = 0;
									$flags = 0644;
									if( $filePerms != '' ) {
										$mode = 1;
										$flags = octdec( $filePerms );
									} // if
									?>
									<td colspan="2">
										<fieldset><legend><?php echo _INSTALL_FILE_PERMISSIONS; ?></legend>
											<table cellpadding="1" cellspacing="1" border="0">
												<tr>
													<td><input type="radio" id="filePermsMode0" name="filePermsMode" value="0" onclick="changeFilePermsMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?> /></td>
													<td><label for="filePermsMode0"><?php echo _INSTALL_DONT_CHM_FILES; ?></label></td>
												</tr>
												<tr>
													<td><input type="radio" id="filePermsMode1" name="filePermsMode" value="1" onclick="changeFilePermsMode(1)"<?php if ($mode) echo ' checked="checked"'; ?> /></td>
													<td><label for="filePermsMode1"><?php echo _INSTALL_CHMOD_FILES_TO; ?></label></td>
												</tr>
												<tr id="filePermsFlags"<?php if (!$mode) echo ' style="display:none"'; ?>>
													<td>&nbsp;</td>
													<td>
														<table cellpadding="1" cellspacing="0" border="0">
															<tr>
																<td><?php echo _INSTALL_CHMOD_USER; ?></td>
																<td><input type="checkbox" id="filePermsUserRead" name="filePermsUserRead" value="1"<?php if ($flags & 0400) echo ' checked="checked"'; ?> /></td>
																<td><label for="filePermsUserRead"><?php echo _INSTALL_CHMOD_READ; ?></label></td>
																<td><input type="checkbox" id="filePermsUserWrite" name="filePermsUserWrite" value="1"<?php if ($flags & 0200) echo ' checked="checked"'; ?> /></td>
																<td><label for="filePermsUserWrite"><?php echo _INSTALL_CHMOD_WRITE; ?></label></td>
																<td><input type="checkbox" id="filePermsUserExecute" name="filePermsUserExecute" value="1"<?php if ($flags & 0100) echo ' checked="checked"'; ?> /></td>
																<td width="100%"><label for="filePermsUserExecute"><?php echo _INSTALL_CHMODE_EXECUTE; ?></label></td>
															</tr>
															<tr>
																<td><?php echo _INSTALL_CHMOD_GROUP; ?></td>
																<td><input type="checkbox" id="filePermsGroupRead" name="filePermsGroupRead" value="1"<?php if ($flags & 040) echo ' checked="checked"'; ?> /></td>
																<td><label for="filePermsGroupRead"><?php echo _INSTALL_CHMOD_READ; ?></label></td>
																<td><input type="checkbox" id="filePermsGroupWrite" name="filePermsGroupWrite" value="1"<?php if ($flags & 020) echo ' checked="checked"'; ?>/></td>
																<td><label for="filePermsGroupWrite"><?php echo _INSTALL_CHMOD_WRITE; ?></label></td>
																<td><input type="checkbox" id="filePermsGroupExecute" name="filePermsGroupExecute" value="1"<?php if ($flags & 010) echo ' checked="checked"'; ?>/></td>
																<td width="100%"><label for="filePermsGroupExecute"><?php echo _INSTALL_CHMODE_EXECUTE; ?></label></td>
															</tr>
															<tr>
																<td><?php echo _INSTALL_CHMOD_WORLD; ?></td>
																<td><input type="checkbox" id="filePermsWorldRead" name="filePermsWorldRead" value="1"<?php if ($flags & 04) echo ' checked="checked"'; ?> /></td>
																<td><label for="filePermsWorldRead"><?php echo _INSTALL_CHMOD_READ; ?></label></td>
																<td><input type="checkbox" id="filePermsWorldWrite" name="filePermsWorldWrite" value="1"<?php if ($flags & 02) echo ' checked="checked"'; ?> /></td>
																<td><label for="filePermsWorldWrite"><?php echo _INSTALL_CHMOD_WRITE; ?></label></td>
																<td><input type="checkbox" id="filePermsWorldExecute" name="filePermsWorldExecute" value="1"<?php if ($flags & 01) echo ' checked="checked"'; ?> /></td>
																<td width="100%"><label for="filePermsWorldExecute"><?php echo _INSTALL_CHMODE_EXECUTE; ?></label></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</fieldset>
									</td>
								</tr>

								<tr>
								<?php
								$mode = 0;
								$flags = 0755;
								if( $dirPerms != '' ){
									$mode = 1;
									$flags = octdec($dirPerms);
								} // if
								?>
									<td colspan="2">
									<fieldset>
										<legend><?php echo _INSTALL_DIR_PERMISSIONS; ?></legend>
										<table cellpadding="1" cellspacing="1" border="0">
											<tr>
												<td><input type="radio" id="dirPermsMode0" name="dirPermsMode" value="0" onclick="changeDirPermsMode(0)"<?php if (!$mode) echo ' checked="checked"'; ?> /></td>
												<td><label for="dirPermsMode0"><?php echo _INSTALL_DONT_CHM_FILES; ?></label></td>
											</tr>
											<tr>
												<td><input type="radio" id="dirPermsMode1" name="dirPermsMode" value="1" onclick="changeDirPermsMode(1)"<?php if ($mode) echo ' checked="checked"'; ?> /></td>
												<td><label for="dirPermsMode1"><?php echo _INSTALL_CHMOD_DIR_TO; ?></label></td>
											</tr>
											<tr id="dirPermsFlags"<?php if( !$mode ) echo ' style="display:none"'; ?>>
												<td>&nbsp;</td>
												<td>
													<table cellpadding="1" cellspacing="0" border="0">
														<tr>
															<td><?php echo _INSTALL_CHMOD_USER; ?></td>
															<td><input type="checkbox" id="dirPermsUserRead" name="dirPermsUserRead" value="1"<?php if ($flags & 0400) echo ' checked="checked"'; ?> /></td>
															<td><label for="dirPermsUserRead"><?php echo _INSTALL_CHMOD_READ; ?></label></td>
															<td><input type="checkbox" id="dirPermsUserWrite" name="dirPermsUserWrite" value="1"<?php if ($flags & 0200) echo ' checked="checked"'; ?> /></td>
															<td><label for="dirPermsUserWrite"><?php echo _INSTALL_CHMOD_WRITE; ?></label></td>
															<td><input type="checkbox" id="dirPermsUserSearch" name="dirPermsUserSearch" value="1"<?php if ($flags & 0100) echo ' checked="checked"'; ?> /></td>
															<td width="100%"><label for="dirPermsUserSearch"><?php echo _INSTALL_CHMOD_SEARCH; ?></label></td>
														</tr>
														<tr>
															<td><?php echo _INSTALL_CHMOD_GROUP; ?></td>
															<td><input type="checkbox" id="dirPermsGroupRead" name="dirPermsGroupRead" value="1"<?php if ($flags & 040) echo ' checked="checked"'; ?> /></td>
															<td><label for="dirPermsGroupRead"><?php echo _INSTALL_CHMOD_READ; ?></label></td>
															<td><input type="checkbox" id="dirPermsGroupWrite" name="dirPermsGroupWrite" value="1"<?php if ($flags & 020) echo ' checked="checked"'; ?> /></td>
															<td><label for="dirPermsGroupWrite"><?php echo _INSTALL_CHMOD_WRITE; ?></label></td>
															<td><input type="checkbox" id="dirPermsGroupSearch" name="dirPermsGroupSearch" value="1"<?php if ($flags & 010) echo ' checked="checked"'; ?> /></td>
															<td width="100%"><label for="dirPermsGroupSearch"><?php echo _INSTALL_CHMOD_SEARCH; ?></label></td>
														</tr>
														<tr>
															<td><?php echo _INSTALL_CHMOD_WORLD; ?></td>
															<td><input type="checkbox" id="dirPermsWorldRead" name="dirPermsWorldRead" value="1"<?php if ($flags & 04) echo ' checked="checked"'; ?> /></td>
															<td><label for="dirPermsWorldRead"><?php echo _INSTALL_CHMOD_READ; ?></label></td>
															<td><input type="checkbox" id="dirPermsWorldWrite" name="dirPermsWorldWrite" value="1"<?php if ($flags & 02) echo ' checked="checked"'; ?> /></td>
															<td><label for="dirPermsWorldWrite"><?php echo _INSTALL_CHMOD_WRITE; ?></label></td>
															<td><input type="checkbox" id="dirPermsWorldSearch" name="dirPermsWorldSearch" value="1"<?php if ($flags & 01) echo ' checked="checked"'; ?> /></td>
															<td width="100%"><label for="dirPermsWorldSearch"><?php echo _INSTALL_CHMOD_SEARCH; ?></label></td>
														</tr>
													
													</table>
												</td>
											</tr>
										</table>
									</fieldset>
								</td>
							</tr>
						</table>
					</div>
				</div>
    			<div id="break"></div>
			</div>
			<div class="clr"></div>
		</div>
	</form>
	<div class="clr"></div>
  </div>

</div>
<div align="center" class="install"><?php echo _INSTALL_FOOTER_CREDIT;?></div>
</body>
</html>