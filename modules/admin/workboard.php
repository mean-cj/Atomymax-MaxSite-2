<?
CheckAdmin($admin_user, $admin_pwd);
require_once("mainfile.php");
include("modules/admin/workboard/includes/functions.php");
if(ISO=='utf-8'){
include("modules/admin/workboard/language/lang-thai_utf-8.php");
} else {
include("modules/admin/workboard/language/lang-thai.php");
}
?>
<link href="css/template_css.css" rel="stylesheet" type="text/css" />

<? 

		include('modules/admin/workboard/index.php');

?>
