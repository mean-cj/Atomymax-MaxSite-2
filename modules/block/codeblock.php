<?
	//	CheckUser($_SESSION['admin_user']);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where id='".$_GET['id']."' ");
		while ($arr['block'] = $db->fetch($res['block'])) {
		$code=$arr['block']['code'];
	if ( $arr['block']['code'] !='') {
	echo $code;
	} else {}
}

?>
