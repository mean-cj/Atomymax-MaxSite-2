<?
require_once("includes/config.in.php");
if(ISO =='utf-8'){
require_once("lang/thai_utf8.php");
} else {
require_once("lang/thai_tis620.php");
}
require_once("includes/class.mysql.php");
require_once("includes/function.in.php");
$db = New DB();
include ("modules/useronline/counter.php");
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['configs'] = $db->select_query("SELECT * FROM ".TB_CONFIG."  ORDER BY id ");
$sd=1;
while($arr['configs'] = $db->fetch($res['configs'])){
if ($arr['configs']['posit']=='title'){ $title=$arr['configs']['name'];}
if ($arr['configs']['posit']=='url'){ $url=$arr['configs']['name'];}
if ($arr['configs']['posit']=='path'){ $path=$arr['configs']['name'];}
if ($arr['configs']['posit']=='footer1'){ $footer1=$arr['configs']['name'];}
if ($arr['configs']['posit']=='footer2'){ $footer2=$arr['configs']['name'];}
if ($arr['configs']['posit']=='email'){ $email=$arr['configs']['name'];}
if ($arr['configs']['posit']=='templates'){ $templates=$arr['configs']['name'];}
if ($arr['configs']['posit']=='iso'){ $iso=$arr['configs']['name'];}
$sd++;
}
define("WEB_TITILE","".$title.""); 
define("WEB_URL","".$url."") ; 
define("WEB_PATH","".$path."") ; 
define("WEB_FOOTER1","".$footer1."") ; 
define("WEB_FOOTER2","".$footer2."") ; 
define("WEB_EMAIL","".$email."") ;
define("WEB_TEMPLATES","".$templates."") ;
?>
<script type="text/javascript">
var dayArrayShort = new Array('<? echo _S_Sunday;?>', '<? echo _S_Monday;?>', '<? echo _S_Tuesday;?>', '<? echo _S_Wednesday;?>', '<? echo _S_Thursday;?>', '<? echo _S_Friday;?>', '<? echo _S_Saturday;?>');
var dayArrayMed = new Array('<? echo _S_Sunday;?>', '<? echo _S_Monday;?>', '<? echo _S_Tuesday;?>', '<? echo _S_Wednesday;?>', '<? echo _S_Thursday;?>', '<? echo _S_Friday;?>', '<? echo _S_Saturday;?>');
var dayArrayLong = new Array('<? echo _Sunday;?>', '<? echo _Monday;?>', '<? echo _Tuesday;?>', '<? echo _Wednesday;?>', '<? echo _Thursday;?>', '<? echo _Friday;?>', '<? echo _Saturday;?>');
var monthArrayShort = new Array('<? echo _Month_1;?>', '<? echo _Month_2;?>', '<? echo _Month_3;?>', '<? echo _Month_4;?>', '<? echo _Month_5;?>', '<? echo _Month_6;?>', '<? echo _Month_7;?>', '<? echo _Month_8;?>', '<? echo _Month_9;?>', '<? echo _Month_10;?>', '<? echo _Month_11;?>', '<? echo _Month_12;?>');
var monthArrayMed = new Array('<? echo _Month_1;?>', '<? echo _Month_2;?>', '<? echo _Month_3;?>', '<? echo _Month_4;?>', '<? echo _Month_5;?>', '<? echo _Month_6;?>', '<? echo _Month_7;?>', '<? echo _Month_8;?>', '<? echo _Month_9;?>', '<? echo _Month_10;?>', '<? echo _Month_11;?>', '<? echo _Month_12;?>');
var monthArrayLong = new Array('<? echo _F_Month_1;?>', '<? echo _F_Month_2;?>', '<? echo _F_Month_3;?>', '<? echo _F_Month_4;?>', '<? echo _F_Month_5;?>', '<? echo _F_Month_6;?>', '<? echo _F_Month_7;?>', '<? echo _F_Month_8;?>', '<? echo _F_Month_9;?>', '<? echo _F_Month_10;?>', '<? echo _F_Month_11;?>', '<? echo _F_Month_12;?>');
</script>