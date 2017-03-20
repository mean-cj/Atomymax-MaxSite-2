<?
//include("includes/config.in.php");
$host = "".DB_HOST."";
$user = "".DB_USERNAME."";
$pwd ="".DB_PASSWORD."";
$db = "".DB_NAME."";
mysql_connect($host,$user,$pwd) or die ("Erorr connect DB Try Again");
mysql_select_db($db);
?>