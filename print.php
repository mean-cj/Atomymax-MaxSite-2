<?
ob_start();
session_start();

$globals_test = @ini_get('register_globals');
if ( isset($globals_test) && empty($globals_test) ) {
$types_to_register = array('GET', 'POST', 'COOKIE', 'SESSION', 'SERVER');
foreach ($types_to_register as $type) {
$arr = @${'_' . $type};
if (@count($arr) > 0)
extract($arr, EXTR_SKIP);
}
}

require_once("mainfile.php");

$PHP_SELF = "print.php";
GETMODULE($_GET['name'],$_GET['file']);
//include ("db_config.php");

?>
<link href="css/template_css.css" rel="stylesheet" type="text/css">
<link href="templates/<?=WEB_TEMPLATES;?>/css/<?=WEB_TEMPLATES;?>.css" rel="stylesheet" type="text/css">

<?
include ("".$MODPATHFILE."");
?>