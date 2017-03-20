<?
//require_once("../mainfile.php");
include_once ( 'common.php' );
//include( 'language/install_thai.php' );
$installer_version = trim( mosGetParam( $_POST, 'installer_version', '' ) );

$installer_version = trim( mosGetParam( $_POST, 'installer_version', '' ) );
$language_install = trim( mosGetParam( $_POST, 'language_install', '' ) );
$admin_language_install = trim( mosGetParam( $_POST, 'admin_language_install', '' ) );
if ($admin_language_install == '-') $admin_language_install = '';
$user_language_install = trim( mosGetParam( $_POST, 'user_language_install', '' ) );
if ($user_language_install == '-') $user_language_install = '';
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
include_once ( 'language_detection.php' );

if ( file_exists( 'language/install_'.$language_install.'.php')) {
	include( 'language/install_'.$language_install.'.php' );
} else {
	include( 'language/install_thai.php' );
}

$lng_choose = array(999 => _INSTALL_LANGUAGE_CHOOSE );
function get_php_setting($val) {
	$r =  (ini_get($val) == '1' ? 1 : 0);
	return $r ? _INSTALL_ON : _INSTALL_OFF;
}
	?>
</head>
<body>
<?
//echo $install_iso;
function writableCell( $folder ) {
	echo '<tr>';
	echo '<td class="item">' . $folder . '/</td>';
	echo '<td align="left">';
	echo is_writable( "../$folder" ) ? '<strong><font color="green">' . _INSTALL_WRITABLE . '</font></strong>' : '<strong><font color="red">' . _INSTALL_UNWRITABLE . '</font></strong>' . '</td>';
	echo '</tr>';
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
<meta http-equiv="Content-Type" content="text/html; charset=<?=$install_iso;?>"/>
<title><?php echo _ATOMYMAXSITE_WEB_INSTALLER._INSTALL_STEP_PRECHECK; ?></title>
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
	<div class="install">
		<div id="stepbar">
			<div class="step-on"><?php echo _INSTALL_STEP_PRECHECK; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_1; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_2; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_3; ?></div>
			<div class="step-off"><?php echo _INSTALL_STEP_4; ?></div>
		</div>

		<div id="right">
			<form action="install1.php" method="post" name="form" id="form">
				<div id="step"><?php echo _INSTALL_PRECHECK_TITLE; ?></div>
				<div class="far-right">
					<input type="hidden" name="language_install" value="<?php echo $language_install; ?>" />
					<input type="hidden" name="installer_version" value="<?php echo $installer_version; ?>" />
					<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
					<input type="hidden" name="admin_language_install" value="<?php echo $admin_language_install; ?>" />
					<input type="hidden" name="user_language_install" value="<?php echo $user_language_install; ?>" />
					<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
					<input name="Button2" type="submit" class="button" value="<?php echo _INSTALL_NEXT; ?>" onclick="window.location='install1.php';" />
				</div>
				<div class="clr"></div>
			</form>
			<form action="index.php" method="post" name="Langue">
				<h1><?php echo _INSTALL_LANGUAGE_SECTION; ?>:</h1>
				<div class="install-text"> <?php echo _INSTALL_LANGUAGE_DESCRIPTION; ?>
					<div class="ctr"></div>
				</div>

				<div class="install-form">
					<div class="form-block">
						<table class="content">
							<tr>
								<td class="item"> <?php echo _INSTALL_LANGUAGE_LABEL; ?> </td>
								<td align="left">
									<?php
									$handle = @opendir( 'language' );
									$tmp_lang = array();
									while ( $file = @readdir ( $handle ) ) {
										if( strtolower( substr( $file, 0, 8 )) == 'install_' ){
											$file = str_replace( 'install_', '', $file );
											$file = str_replace( '.php', '', $file );
											$tmp_lang[] = strtolower( $file );
										} // end if
									} // end while
									@closedir( $handle );
									sort( $tmp_lang );
									echo '<select size="1" name="language_install" type="submit" onchange="this.form.submit();">';
									foreach ( $tmp_lang as $lang_found ){
										if( $lang_found == $language_install ){
											echo '<option value ="'.$lang_found.'" Selected>'.ucfirst($lang_found)."</option>\n";
										}else{
											echo '<option value ="'.$lang_found.'">'.ucfirst($lang_found)."</option>\n";
										}
									}
									echo '</select>';
									?>
								</td>
							</tr>
							<tr>
								<td colspan="2"><hr></td>
							</tr>
							<tr>
								<td colspan="2"><?php echo _INSTALL_LANGUAGE_NOTE; ?></td>
							</tr>
						</table>
					</div>
				</div>
			<div class="clr"></div>
			<h1><?php echo _INSTALL_PRECHECK_SECTION.'<br />' ._SCRIPT.'  '. _VERSION. '' ?></h1>
			<div class="install-text"> <?php echo _INSTALL_PRECHECK_DESCRIPTION; ?>
				<div class="ctr"></div>
			</div>

				<div class="install-form">
					<div class="form-block">
						<table class="content">
							<?php
							if( $admin_language_install == '' ){
								$tmp_admin_language_install = '<font color="red">' . _INSTALL_LANGUAGE_CHOOSE . '</font>';
							}else $tmp_admin_language_install = '<font color="green">' . ucfirst( $admin_language_install ) . '</font>';
							if( $user_language_install == '' ){
								$tmp_user_language_install = '<font color="red">' . _INSTALL_LANGUAGE_CHOOSE . '</font>';
							}else $tmp_user_language_install = '<font color="green">' . ucfirst( $user_language_install ) . '</font>';
							?>
							<tr>
								<td><strong><?php echo _INSTALL_LANGUAGE_CHECK; ?></strong></td>
							<tr>
								<td><?php echo _INSTALL_LANGUAGE_LABEL; ?></td>
								<td>
									<font color="green"><strong><?php echo ucfirst( $language_install ); ?></strong></font>
								</td>
							</tr>
							<tr>
								<td>ISO</td>
								<td>
									<font color="green"><strong><?php echo $install_iso; ?></strong></font>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</form>

			<div class="clr"></div>
			<h1><?php echo _INSTALL_PRECHECK_SECTION.'<br />' ._SCRIPT.'  '. _VERSION. '' ?></h1>
			<div class="install-text"> <?php echo _INSTALL_PRECHECK_DESCRIPTION; ?>
				<div class="ctr"></div>
			</div>

			<div class="install-form">
				<div class="form-block">
					<table class="content">
						<tr>
							<td class="item"><?php echo _INSTALL_PHP_VERSION; ?></td>
							<td align="left">
								<?php echo phpversion() < '4.1' ? '<strong><font color="red">'._INSTALL_NO.'</font></strong>' : '<strong><font color="green">'._INSTALL_YES.'</font></strong>'; ?>
								&nbsp;(<strong> <?php echo phpversion(); ?></strong> )
							</td>
						</tr>

						<tr>
							<td><?php echo _INSTALL_PHP_ZLIB; ?></td>
							<td align="left">
								<?php echo extension_loaded('zlib') ? '<strong><font color="green">'._INSTALL_AVAILABLE.'</font></strong>' : '<strong><font color="red">'._INSTALL_UNAVAILABLE.'</font></strong>'; ?>
							</td>
						</tr>

						<tr>
							<td><?php echo _INSTALL_PHP_XML; ?></td>
							<td align="left">
								<?php echo extension_loaded('xml') ? '<strong><font color="green">'._INSTALL_AVAILABLE.'</font></strong>' : '<strong><font color="red">'._INSTALL_UNAVAILABLE.'</font></strong>'; ?>
							</td>
						</tr>

						<tr>
							<td><?php echo _INSTALL_PHP_MYSQL; ?></td>
							<td align="left">
								<?php echo function_exists( 'mysql_connect' ) ? '<strong><font color="green">'._INSTALL_AVAILABLE.'</font></strong>' : '<strong><font color="red">'._INSTALL_UNAVAILABLE.'</font></strong>'; ?>
							</td>
						</tr>

						<tr>
							<td valign="top" class="item"><?php echo _INSTALL_CONFIG_FILE; ?></td>
							<td align="left">
								<?php
								if (@file_exists('../includes/config.in.php') && @is_writable( '../includes/config.in.php' )){
									echo '<strong><font color="green">'._INSTALL_WRITABLE.'</font></strong>';
								} else if ( @is_writable( '..' ) ) {
									echo '<strong><font color="green">'._INSTALL_WRITABLE.'</font></strong>';
								} else {
									echo '<strong>config.in.php<br /><font color="red">'._INSTALL_UNWRITABLE.'</font></strong><br /><span class="small">'._INSTALL_PHP_CONF.'</span>';
								} ?>
							</td>
						</tr>

						<tr>
							<td class="item"><?php echo _INSTALL_SESSION; ?></td>
							<td align="left">
								<strong><?php echo (( $sp=ini_get('session.save_path')) ? '' : _INSTALL_SESSION_NOT_SET ); ?></strong>
								<?php echo is_writable( $sp ) ? '<strong><font color="green">'._INSTALL_WRITABLE.'</font></strong>' : '<strong>'.$sp.'<br /><font color="red">'._INSTALL_UNWRITABLE.'</font></strong>'; ?>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<div class="clr"></div>
			<h1><?php echo _INSTALL_PHP_SETTINGS_TITLE; ?></h1>
			<div class="install-text"> <?php echo _INSTALL_PHP_SETTINGS_DESCRIPTION; ?>
				<div class="ctr"></div>
			</div>

			<div class="install-form">
				<div class="form-block">
					<table class="content">
						<tr>
							<td class="toggle"><?php echo _INSTALL_PHP_FONCTION; ?></td>
							<td class="toggle"><?php echo _INSTALL_PHP_FONCTION_IDEAL; ?></td>
							<td class="toggle"><?php echo _INSTALL_PHP_FONCTION_ACTUAL; ?></td>
						</tr>

						<?php
						$php_recommended_settings = array(
							array (_INSTALL_PHP_MODE, 'safe_mode', _INSTALL_OFF),
							array (_INSTALL_PHP_ERRORS, 'display_errors', _INSTALL_ON),
							array (_INSTALL_PHP_UPLOAD, 'file_uploads', _INSTALL_ON),
							array (_INSTALL_PHP_QUOTES_GPC, 'magic_quotes_gpc', _INSTALL_ON),
							array (_INSTALL_PHP_QUOTES_RUNTIME, 'magic_quotes_runtime', _INSTALL_OFF),
							array (_INSTALL_PHP_GLOBALS, 'register_globals', _INSTALL_OFF),
							array (_INSTALL_PHP_OUTBUFFER, 'output_buffering', _INSTALL_OFF),
							array (_INSTALL_PHP_AUTOSTART_SESSION, 'session.auto_start', _INSTALL_OFF),
						);

						foreach ($php_recommended_settings as $phprec) { ?>
							<tr>
								<td class="item"><?php echo $phprec[0]; ?></td>
								<td class="toggle"><?php echo $phprec[2]; ?></td>
								<td>
									<?php
									if ( get_php_setting($phprec[1]) == $phprec[2] ) { ?>
										<font color="green"><strong>
										<?php
									} else { ?>
										<font color="red"><strong>
										<?php
									}
									echo get_php_setting($phprec[1]); ?>
									</strong></font>
								</td>
							</tr>
							<?php
						} // end foreach
						?>
					</table>
				</div>
			</div>

			<div class="clr"></div>
			<h1><?php echo _INSTALL_DIRFILE_PERMS; ?></h1>
			<div class="install-text"> <?php echo _INSTALL_DIRFILE_PERMS_INFO; ?>
				<div class="clr">&nbsp;&nbsp;</div>
				<div class="ctr"></div>
			</div>

			<div class="install-form">
				<div class="form-block">
			    	<table class="content">
						<?php
						writableCell( 'attach' );
						writableCell( 'backup' );
						writableCell( 'data' );
						writableCell( 'images/personnel' );
                        writableCell( 'images/random' );
                        writableCell( 'images/icon' );
                        writableCell( 'images/gallery' );
						writableCell( 'icon' );
						writableCell( 'modules/aboutus' );
						writableCell( 'modules/editortalk' );
						writableCell( 'modules/block/banner.xml' );
						writableCell( 'modules/rss/news.xml' );
						writableCell( 'modules/smiletag/data' );
						writableCell( 'templates' );
						writableCell( 'video' );
						writableCell( 'UserFiles' );
						writableCell( 'webboard_upload' );
						writableCell( 'includes/config.in.php' );
						writableCell( 'download.dat' );
						writableCell( 'research.dat' );
						?>
					</table>
				</div>

				<div class="clr"></div>
			</div>

			<div class="clr"></div>
		</div>
		

	<div class="clr"></div>
  </div>

</div>
<div align="center">
<div class='install' align="center"><?php echo _INSTALL_FOOTER_CREDIT;?></div>
</div>
</div>
</body>
</html>