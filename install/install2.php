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

$DBhostname = trim( mosGetParam( $_POST, 'DBhostname', '' ) );
$DBuserName = trim( mosGetParam( $_POST, 'DBuserName', '' ) );
$DBpassword = trim( mosGetParam( $_POST, 'DBpassword', '' ) );
$DBverifypassword = trim(mosGetParam( $_POST, 'DBverifypassword', '' ) );
$DBname  	= trim( mosGetParam( $_POST, 'DBname', '' ) );
$DBPrefix  	= trim( mosGetParam( $_POST, 'DBPrefix', 'web_' ) );
$DBDel  	= intval( trim( mosGetParam( $_POST, 'DBDel', '' ) ) );
$DBBackup  	= intval( trim( mosGetParam( $_POST, 'DBBackup', '' ) ) );
$DBSample  	= intval( trim( mosGetParam( $_POST, 'DBSample', '' ) ) );
$DBcreated = trim( mosGetParam( $_POST, 'DBcreated', 0 ) );
$footer1= trim( mosGetParam( $_POST, 'footer1', '' ) );
$footer2 = trim( mosGetParam( $_POST, 'footer2', '' ) );
$templates=trim( mosGetParam( $_POST, 'picture', '' ) );
$language_install = trim( mosGetParam( $_POST, 'language_install', '' ) );
$admin_language_install = trim( mosGetParam( $_POST, 'admin_language_install', '' ) );
$user_language_install = trim( mosGetParam( $_POST, 'user_language_install', '' ) );
$BUPrefix = 'old_';
$configArray['sitename'] = trim( mosGetParam( $_POST, 'sitename', '' ) );
$installer_version = trim( mosGetParam( $_POST, 'installer_version', '' ) );
$detected_lang = trim( mosGetParam( $_POST, 'detected_lang', '' ) );
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
$database = null;
$errors = array();

if (file_exists( 'language/install_' . $language_install . '.php' ) ) {
 	require 'language/install_' . $language_install . '.php';
} else {
	include( 'language/install_thai.php' );
}
//echo $install_iso;
if ($DBcreated != 1){
	if (!$DBhostname || !$DBuserName || !$DBname) {
		db_err ( 'install1.php', _INSTALL_DB_ERROR1);
	}
	if ($DBpassword !== $DBverifypassword) {
		db_err ("install1.php", _INSTALL_DB_ERROR6);
	}
	if (!($mysql_link = @mysql_connect( $DBhostname, $DBuserName, $DBpassword ))) {
		db_err ( 'install1.php', _INSTALL_DB_ERROR2);
	}

	if( $DBname == '' ) {
		db_err ( 'install1.php', _INSTALL_DB_ERROR3);
	}

	// Does this code actually do anything???
	$configArray['DBhostname'] = $DBhostname;
	$configArray['DBuserName'] = $DBuserName;
	$configArray['DBpassword'] = $DBpassword;
	$configArray['DBname']     = $DBname;
	$configArray['DBPrefix']   = $DBPrefix;
	$configArray['footer1']   = $footer1;
	$configArray['footer2']   = $footer2;

	// test if db exists or is reachable
	$sql = "CREATE DATABASE `$DBname`";
	$mysql_result = @mysql_query( $sql );
	$test = mysql_errno();

	if ($test <> 0 && $test <> 1007) {
		db_err( 'install1.php', _INSTALL_DB_ERROR4 . ' ' . mysql_errno() ); // '-L german' -> lokalisierte Fehlermeldung
	}

	// db is now new or existing, create the db object connector to do the serious work
	//$database = new database( $DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix );
	if ($DBpassword == $DBverifypassword) {
		function connectdb($db_name="DBname",$user="DBuserName",$pwd="DBpassword"){
		$DBhostname=$_POST[DBhostname];
		$DBname=$_POST[DBname];
		$DBuserName=$_POST[DBuserName];
		$DBpassword=$_POST[DBpassword];
		$connect_db=mysql_connect ( $DBhostname, $DBuserName, $DBpassword ) or $this->_error();
		//$this->connect_db = mysql_pconnect ( $this->host, $this->username, $this->password ) or $this->_error();
		mysql_select_db ( $DBname, $connect_db) or $this->_error();
		mysql_query("ALTER DATABASE ".$DBname." DEFAULT CHARACTER SET ".resultsx." COLLATE ".langset."");
//		mysql_query("SET NAMES ".$resultsx." collation_connection=".$langset." collation_database=".$langset." collation_server=".$langset.""); 
		mysql_query("SET NAMES ".iso.""); 
		mysql_query("SET character_set_results=".resultsx.""); 
		mysql_query("SET character_set_client=".resultsx."");
		mysql_query("SET character_set_connection=".resultsx."");
		mysql_query("collation_connection=".langset.""); 
		mysql_query("collation_database=".langset.""); 
		mysql_query("collation_server=".langset."");
		$database=$this->database;
		return true; 
	}
	}


	// delete existing mos table if requested
	if ($DBDel) {
		$connect_db=mysql_connect ( $DBhostname, $DBuserName, $DBpassword ) or $this->_error();
		//$this->connect_db = mysql_pconnect ( $this->host, $this->username, $this->password ) or $this->_error();
		mysql_select_db ( $DBname, $connect_db) or $this->_error();
/* query all tables */
$database_name = $DBname;
//echo "$database_name";
$sql = "SHOW TABLES FROM $DBname";
if($result = mysql_query($sql)){
  /* add table name to array */
  while($row = mysql_fetch_row($result)){
    $found_tables[]=$row[0];
  }
}
else{
  die("Error, could not list tables. MySQL Error: " . mysql_error());
}
 
/* loop through and drop each table */
foreach($found_tables as $table_name){
  $sql = "DROP TABLE $database_name.$table_name";
  if($result = mysql_query($sql)){
   // echo "Success - table $table_name deleted.";
  }
  else{
	$errors[$db->select_query()] = $database->getErrorMsg();
  }
}

		if( count( $errors ) ){
			db_err( 'install1.php', _INSTALL_DB_DATAERROR );
			//exit();
		}
	}
//	if( $DBDel != '0' || $DBBackup != '0' || $DBSample != '0' ) { // this is just an install for existing DB's

	if ($DBpassword == $DBverifypassword) {
		if( file_exists( 'sql/atomymaxsite_'.$language_install.'.sql' ) ) {
			populate_db( $DBname,$DBPrefix,'atomymaxsite_'.$language_install.'.sql' );
		}else populate_db( $DBname,$DBPrefix,'atomymaxsite.sql' );
//	}
	}
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

function db_err( $step, $alert ) {
	global $DBhostname,$DBuserName,$DBpassword,$DBDel,$DBname,$DBPrefix, $DBSample, $language_install, $admin_language_install, $user_language_install, $installer_version, $detected_lang, $install_iso; ?>
	<form name="stepBack" method="post" action="<?php echo $step; ?>">
		<input type="hidden" name="DBhostname" value="<?php echo $DBhostname; ?>" />
		<input type="hidden" name="DBuserName" value="<?php echo $DBuserName; ?>" />
		<input type="hidden" name="DBpassword" value="<?php echo $DBpassword; ?>" />
		<input type="hidden" name="DBname" value="<?php echo $DBname; ?>" />
		<input type="hidden" name="DBPrefix" value="<?php echo $DBPrefix; ?>" />
		<input type="hidden" name="DBSample" value="<?php echo $DBSample; ?>" />
		<input type="hidden" name="DBcreated" value="1" />
		<input type="hidden" name="language_install" value="<?php echo $language_install; ?>" />
		<input type="hidden" name="admin_language_install" value="<?php $admin_language_install; ?>" />
		<input type="hidden" name="user_language_install" value="<?php echo $user_language_install; ?>" />
		<input type="hidden" name="installer_version" value="<?php echo $installer_version; ?>" />
		<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
		<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
	</form>
	<?php
	echo "<script>alert('" . html_convert( $alert ) . "'); document.stepBack.submit();</script>";
}

function populate_db( $DBname, $DBPrefix, $sqlfile ) {
	global $errors;
	@mysql_select_db($DBname);
	mysql_query("ALTER DATABASE ".$DBname." DEFAULT CHARACTER SET ".resultsx." COLLATE ".langset."");
//	@mysql_query("SET NAMES ".$resultsx." collation_connection=".$langset." collation_database=".$langset." collation_server=".$langset.""); 
	mysql_query("SET NAMES ".iso.""); 
	mysql_query("SET character_set_results=".resultsx.""); 
	mysql_query("SET character_set_client=".resultsx."");
	mysql_query("SET character_set_connection=".resultsx."");
	mysql_query("collation_connection=".langset.""); 
	mysql_query("collation_database=".langset.""); 
	mysql_query("collation_server=".langset."");
	$mqr = @get_magic_quotes_runtime();
	@set_magic_quotes_runtime(0);
	$query = fread(fopen("sql/".$sqlfile, "r"), filesize("sql/".$sqlfile));
	@set_magic_quotes_runtime($mqr);
	$pieces  = split_sql($query);
	for ($i=0; $i<count($pieces); $i++) {
		$pieces[$i] = trim($pieces[$i]);
		if(!empty($pieces[$i]) && $pieces[$i] != "#") {
			$pieces[$i] = str_replace( "#__", $DBPrefix, $pieces[$i]);
			if (!$result = @mysql_query ($pieces[$i])) {
				$errors[] = array ( mysql_error(), $pieces[$i] );
			}
		}
	}
}

function split_sql($sql) {
	$sql = trim($sql);
	$sql = preg_replace("/\n#[^\n]*\n/", "\n", $sql);

	$buffer = array();
	$ret = array();
	$in_string = false;

	for($i=0; $i<strlen($sql)-1; $i++) {
		if($sql[$i] == ";" && !$in_string) {
			$ret[] = substr($sql, 0, $i);
			$sql = substr($sql, $i + 1);
			$i = 0;
		}

		if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {
			$in_string = false;
		}
		elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {
			$in_string = $sql[$i];
		}
		if(isset($buffer[1])) {
			$buffer[0] = $buffer[1];
		}
		$buffer[1] = $sql[$i];
	}

	if(!empty($sql)) {
		$ret[] = $sql;
	}
	return($ret);
}

$isErr = intval( count( $errors ) );

echo "<?xml version=\"1.0\" encoding=\"".$install_iso."\"?".">"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$install_iso;?>" />
<title>ATOMYMAXSITE 2.5 - Web Installer :: <?php echo _INSTALL_STEP_2; ?></title>
<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="../css/install.css" type="text/css" />
<script language="javascript" type="text/javascript">
<!--
function check() {
	<!-- form validation check -->
	var formValid = true;
	var f = document.form;
	if ( f.sitename.value == '' ) {
		alert('<?php echo html_convert(_INSTALL_DB_ERROR5); ?>');
		f.sitename.focus();
		formValid = false
	}
	return formValid;
}
// -->
</script>
</head>
<div id="wrapper">
	<div id="header">
		<div id="atomymaxsite">
    		<?php echo '<font color="#FF9900"><strong>Version: ' ._SCRIPT.'  '. _VERSION. '</strong></font>'; ?>
    	</div>
	</div>
</div>

<div id="ctr" align="center">
	<?php if (!$isErr) $butt_action = 'install3.php'; else $butt_action = 'install1.php'; ?>
	<form action="<?php echo $butt_action; ?>" method="post" name="form" id="form" onsubmit="return check();">
	<input type="hidden" name="DBhostname" value="<?php echo $DBhostname; ?>" />
	<input type="hidden" name="DBuserName" value="<?php echo $DBuserName; ?>" />
	<input type="hidden" name="DBpassword" value="<?php echo $DBpassword; ?>" />
	<input type="hidden" name="DBname" value="<?php echo $DBname; ?>" />
	<input type="hidden" name="DBPrefix" value="<?php echo $DBPrefix; ?>" />
	<input type="hidden" name="DBSample" value="<?php echo $DBSample; ?>" />
	<input type="hidden" name="language_install" value="<?php echo $language_install; ?>">
	<input type="hidden" name="admin_language_install" value="<?php echo $admin_language_install; ?>">
	<input type="hidden" name="user_language_install" value="<?php echo $user_language_install; ?>">
	<input type="hidden" name="installer_version" value="<?php echo $installer_version; ?>" />
	<input type="hidden" name="detected_lang" value="<?php echo $detected_lang; ?>" />
	<input type="hidden" name="install_iso" value="<?php echo $install_iso; ?>" />
	<div class="install">

    <div id="stepbar">
      	<div class="step-off"><?php echo _INSTALL_STEP_PRECHECK; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_LICENSE; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_1; ?></div>
		<div class="step-on"><?php echo _INSTALL_STEP_2; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_3; ?></div>
		<div class="step-off"><?php echo _INSTALL_STEP_4; ?></div>
      </div>
      <div id="right">

      <div class="far-right">
      <?php
      if (!$isErr) { ?>
      	<input class="button" type="submit" name="next" value="<?php echo _INSTALL_NEXT; ?>" />
        <?php
      }else{ ?>
      	<input style="font-family:verdana;font-size:x-small;color:red" class="button" type="submit" name="back" value="<?php echo _INSTALL_BACK; ?>" />
        <?php
      } ?>
      </div>

      <div id="step"><?php echo _INSTALL_STEP_2; ?></div>
  		<div class="clr"></div>

  		<h1><?php echo _INSTALL_DB_SITENAME; ?></h1>

      <div class="install-text">
        <?php if ($isErr) {
        echo '<span style="font-size:xx-small;color:red">';
		echo _INSTALL_DB_DATAERROR ;
		echo '</span>';
	 } else {
	 	echo _INSTALL_DB_INSTALLSUCCESS ;
	 } ?>
      </div>

      <div class="install-form">
        <div class="form-block">
          <table class="content2">
            <?php
            if ($isErr) {
            	echo '<tr><td colspan="2">';
            	echo _INSTALL_DB_LOGERROR . '<br />';
            	// abrupt failure
            	echo '<textarea rows="20" cols="65">';
            	foreach($errors as $error) {
            		echo "SQL=$error[0]:\n- - - - - - - - - -\n$error[1]\n= = = = = = = = = =\n\n";
            	}
            	echo '</textarea>';
            	echo '</td></tr>';
            } else { ?>
            <tr>
              <td width="100"><?php echo _INSTALL_DB_SITENAME_LABEL; ?></td>
              <td align="center"><input class="inputbox" type="text" name="sitename" size="45" value="<?php echo "{$configArray['sitename']}"; ?>" /></td>
            </tr>
            <tr>
              <td width="100">&nbsp;</td>
              <td align="center" class="small"><?php echo _INSTALL_SITE_NAME_DESCRIPTION; ?></td>
            </tr>
            <tr>
              <td width="100"><?php echo _INSTALL_DB_FOOTER1_LABEL; ?></td>
              <td align="center"><input class="inputbox" type="text" name="footer1" size="45" value="<?php echo "{$configArray['footer1']}"; ?>" /></td>
            </tr>
            <tr>
              <td width="100">&nbsp;</td>
              <td align="center" class="small"><?php echo _INSTALL_SITE_FOOTER1_DESCRIPTION; ?></td>
            </tr>
            <tr>
              <td width="100"><?php echo _INSTALL_DB_FOOTER2_LABEL; ?></td>
              <td align="center"><input class="inputbox" type="text" name="footer2" size="45" value="<?php echo "{$configArray['footer2']}"; ?>" /></td>
            </tr>
            <tr>
              <td width="100">&nbsp;</td>
              <td align="center" class="small"><?php echo _INSTALL_SITE_FOOTER2_DESCRIPTION; ?></td>
            </tr>
	            <tr>
              <td width="100" valign="top"><?php echo _INSTALL_DB_TEMPLATE_LABEL; ?></td>
              <td align="left" valign="top"><SELECT name="picture"  id="picture" onChange="showimage()" />
<?
echo "<option value=''>-------</option>";
  if ($handle = opendir("../templates")) {
    while (false !== ($item = readdir($handle))) {
      if ($item != "." && $item != ".." && $item != "Thumbs.db") {
	echo "<option value=".$item." >$item</option>";
      }
    }
    closedir($handle);
  }

?>

			  </select>
<script language="javascript">

function showimage()
{
if (!document.images)
return
document.images.pictures.src="../templates/"+document.form.picture.options[document.form.picture.selectedIndex].value+"/thumbnail.png";
}
//-->
</script>

<br><a href="javascript:linkrotate(document.form.picture.selectedIndex)" onMouseover="window.status='';return true"><img src="../images/knowledge_blank.gif" name="pictures" width="150" border=0></a>
</td>
            </tr>
            <tr>
              <td width="100">&nbsp;</td>
              <td align="center" class="small"><?php echo _INSTALL_SITE_TEMPLATE_DESCRIPTION; ?></td>
            </tr>
          <?php
          } ?>
          </table>
        </div>
      </div>
  	  <div class="clr"></div>
  	  <div id="break"></div>
	  </div>
	  <div class="clr"></div>

	</form>
	<div class="clr"></div>
  </div>

</div>
<div align="center" class="install"><?php echo _INSTALL_FOOTER_CREDIT;?></div>
</body>
</html>