<?php
//	session_start();
empty($_SESSION['admin_user'])?$admin_user="":$admin_user=$_SESSION['admin_user'];
empty($_SESSION['admin_pwd'])?$admin_pwd="":$admin_pwd=$_SESSION['admin_pwd'];
	if(!isset($admin_user)){
		
		$target_url = 'index.php';
		
		header("Location: ".WEB_URL. "/" . $target_url);
	}
?>