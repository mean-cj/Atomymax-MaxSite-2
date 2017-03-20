<?
//require_once("mainfile.php");
CheckAdmin($admin_user, $admin_pwd);
?>
<link href="css/template_css.css" rel="stylesheet" type="text/css" />
<?
if ($_GET['file']=="smiletag" ){

		include('modules/smiletag/admin/admin.php');
}
if ($_GET['files']=="adminProcess"){
		
	if($_POST['addip']=='addip'){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_IPBLOCK,array(
			"ip"=>"".$_POST['ipaddress']."",
			"post_date"=>"".time().""
		));
		$db->closedb ();
		include('modules/smiletag/admin/adminProcess.php');
	} 
 if($_POST['delip']=='delip'){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		while(list($key, $value) = each ($_POST['ipaddress'])){

		$db->del(TB_IPBLOCK," ip='".$value."' "); 
}
		$db->closedb ();
include('modules/smiletag/admin/adminProcess.php');
} 
include('modules/smiletag/admin/adminProcess.php');
}

?>
