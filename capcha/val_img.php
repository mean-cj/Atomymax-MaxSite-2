<?php
header("Content-type: image/png");
require_once("../includes/config.in.php");
require_once("../includes/function.in.php");

session_start();

//$targetPath="".WEB_PATH."";
//var $font = '/home/www/htdocs/capcha/monofont.ttf'; //ตรวจสอบ path เองมาใส่นะครับ
$_SERVER['DOCUMENT_ROOT'] = dirname(dirname(__FILE__));
$targetPath = $_SERVER['DOCUMENT_ROOT'];

	function generateCode($characters) {
     $possible = 'ผปอทมฟหกดสวงพรนยบลภถคตจขช';
//		$possible = _CAPTCHA_RAN;
		$code = '';
		$i = 0;
		while ($i < $characters) { 
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			
			$i++;
		}
		return $code;
	}

$font = $targetPath."/capcha/font/angsab.ttf";
$code = generateCode($_GET['characters']);
$im = imagecreate($_GET['width'], $_GET['height']);  
$white = ImageColorAllocate($im, 255, 255, 255); 
$black = ImageColorAllocate($im, 0, 0, 0); 
$new_string = tis620_to_utf8($code); 
imagefill($im, 0, 0, $black);
imageTTFText($im, 20 , 0, 6 ,18,$white,$font,$new_string);
if(ISO=='utf-8'){
$_SESSION["security_code"]=$new_string;
} else {
$_SESSION["security_code"]=utf8_to_tis620($new_string);
}
imagepng($im); 
imagedestroy($im);
?>