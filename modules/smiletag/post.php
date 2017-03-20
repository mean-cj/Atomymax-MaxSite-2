<?php
	session_start();	
require_once("../../includes/config.in.php");
require_once("../../includes/function.in.php");	
if(ISO =='utf-8'){
require_once("../../lang/thai_utf8.php");
$lang=_JAVA_CAPTCHA_NOACC;
} else {
require_once("../../lang/thai_tis620.php");
$lang=_JAVA_CAPTCHA_NOACC;
}

 //defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
	require_once('lib/domit/xml_domit_lite_include.php');
	require_once('lib/St_XmlParser.class.php');	
	require_once('lib/St_ConfigManager.class.php');
	require_once('lib/St_FileDao.class.php');
	require_once('lib/St_PersistenceManager.class.php');
	require_once('lib/St_RuleProcessor.class.php');
	require_once('lib/St_InputProcessor.class.php');
	require_once('lib/St_PostManager.class.php');
//require_once('../../mainfile.php');	


	$HttpRequest['name'] = trim($_POST['name']);
//	$HttpRequest['url'] =  trim($_POST['mail_or_url']);
	$HttpRequest['message'] = trim($_POST['message']);
	$HttpRequest['capttt'] = trim($_POST['security_code']);
    $postManager =& new St_PostManager();
	$errorMessage = null;
if($_SESSION['login_true'] || $_SESSION['admin_user']){
} else {
if(USE_CAPCHA){
//check_captcha($_POST['security_code']);
	if($_SESSION['security_code'] != $_POST['security_code'] OR empty($_POST['security_code'])) {
		echo "<script language='javascript'>" ;
		echo "alert('".$lang."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
}
}

	if(empty($HttpRequest['name']) or empty($HttpRequest['message'])){
		$errorMessage = "Name and Message is required!";
	}else{
		if($postManager->doPost($HttpRequest) == false){
			$errorMessage = $postManager->getErrorMessage();
		}
	}
	
	if(empty($errorMessage)){
		header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/view.php');
	}else{
		echo '<center>';
		echo $errorMessage;
		echo '<br/><br/><a href="view.php">[Back]</a></center>';
	}
	
	
	
?>