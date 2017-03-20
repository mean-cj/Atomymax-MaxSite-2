<?
if (strstr($_SERVER['HTTP_USER_AGENT'], 'Yandex')){ $bot='Yandex';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot')){$bot='Google';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Mediapartners-Google')){$bot='Mediapartners-Google (Adsense)';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Slurp')){$bot='Hot Bot search';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'WebCrawler')){$bot='WebCrawler search';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'ZyBorg')){$bot='Wisenut search';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'scooter')){$bot='AltaVista';}  
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'StackRambler')){$bot='Rambler';}  
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Aport')){$bot='Aport';}  
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'lycos')){$bot='Lycos';}  
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'WebAlta')){$bot='WebAlta';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'yahoo')){$bot='Yahoo';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'msnbot')){$bot='msnbot/1.0';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'ia_archiver')){$bot='Alexa search engine';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'FAST')){$bot='AllTheWeb';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Teoma')){$bot='Teoma';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Baiduspider')){$bot='Baiduspider';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Gigabot')){$bot='Gigabot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'AdsBot-Google')){$bot='AdsBot-Google';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'gsa-crawler')){$bot='gsa-crawler';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot-Image')){$bot='Googlebot-Image';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'ia_archiver-web.archive.org')){$bot='ia_archiver-web.archive.org';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'omgilibot')){$bot='omgilibot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Speedy Spider')){$bot='Speedy Spider';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Y!J')){$bot='Y!J';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'link validator')){$bot='link validator';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'W3C_Validator')){$bot='W3C_Validator';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'W3C_CSS_Validator')){$bot='W3C_CSS_Validator';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'FeedValidator')){$bot='FeedValidator';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'W3C-checklink')){$bot='W3C-checklink';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'W3C-mobileOK')){$bot='W3C-mobileOK';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'P3P Validator')){$bot='P3P Validator';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Bloglines')){$bot='Bloglines';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Feedburner')){$bot='Feedburner';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Snapbot')){$bot='Snapbot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'psbot')){$bot='psbot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Websnapr')){$bot='Websnapr';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'asterias')){$bot='asterias';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], '192.comAgent')){$bot='192.comAgent';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'ABACHOBot')){$bot='ABACHOBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'abcdatos')){$bot='abcdatos';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Acoon')){$bot='Acoon';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Accoona')){$bot='Accoona';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'BecomeBot')){$bot='BecomeBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'BlogRefsBot')){$bot='BlogRefsBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Daumoa')){$bot='Daumoa';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'DuckDuckBot')){$bot='DuckDuckBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Exabot')){$bot='Exabot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Furlbot')){$bot='Furlbot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'FyberSpider')){$bot='FyberSpider';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'GeonaBot')){$bot='GeonaBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Girafabot')){$bot='Girafabot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'GoSeeBot')){$bot='GoSeeBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'ichiro')){$bot='ichiro';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'LapozzBot')){$bot='LapozzBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'WISENutbot')){$bot='WISENutbot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'MJ12bot/v2')){$bot='MJ12bot/v2';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'MLBot')){$bot='MLBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'msrbot')){$bot='msrbot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSR-ISRCCrawler')){$bot='MSR-ISRCCrawler';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'NaverBot')){$bot='NaverBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Yeti')){$bot='Yeti';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'noxtrumbot')){$bot='noxtrumbot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'OmniExplorer_Bot')){$bot='OmniExplorer_Bot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'OnetSzukaj')){$bot='OnetSzukaj';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Scrubby')){$bot='Scrubby';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'SearchSight')){$bot='SearchSight';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Seeqpod')){$bot='Seeqpod';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'ShablastBot')){$bot='ShablastBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'SitiDiBot')){$bot='SitiDiBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'silk/1.0')){$bot='silk/1.0';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Sogou')){$bot='Sogou';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Sosospider')){$bot='Sosospider';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'SurveyBot')){$bot='SurveyBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Touche')){$bot='Touche';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'appie')){$bot='appie';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'wisponbot')){$bot='wisponbot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'yacybot')){$bot='yacybot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'YodaoBot')){$bot='YodaoBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Charlotte')){$bot='Charlotte';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'DiscoBot')){$bot='DiscoBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'EnaBot')){$bot='EnaBot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Gaisbot')){$bot='Gaisbot';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'kalooga')){$bot='kalooga';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'ScoutJet')){$bot='ScoutJet';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'TinEye')){$bot='TinEye';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'twiceler')){$bot='twiceler';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'GSiteCrawler')){$bot='GSiteCrawler';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'HTTrack')){$bot='HTTrack';}
else if (strstr($_SERVER['HTTP_USER_AGENT'], 'Wget')){$bot='Wget';}

if(!empty($bot)){
	$tdiff = 3600 * 0; // เปลี่ยนจาก 0 เป็น 7 ถ้า Server นอก (GMT) หรือเพิ่มลดได้ตามแต่ Time Zone อยู่ที่ได (GMT -12 ถึง GMT +13)
	$file = "bots.txt";
	$day = date("d/m/Y",time() + $tdiff);
	$time = date("H:i:s",time() + $tdiff);
	$ip = $_SERVER['REMOTE_ADDR'];
	$fh = fopen($file, "w");
	fwrite($fh, "$day|$time|$bot|$ip");
	fclose($fh);
}

$month[1] = ""._F_Month_1."";
$month[2] = ""._F_Month_2."";
$month[3] = ""._F_Month_3."";
$month[4] = ""._F_Month_4."";
$month[5] = ""._F_Month_5."";
$month[6] = ""._F_Month_6."";
$month[7] = ""._F_Month_7."";
$month[8] = ""._F_Month_8."";
$month[9] = ""._F_Month_9."";
$month[10] = ""._F_Month_10."";
$month[11] = ""._F_Month_11."";
$month[12] = ""._F_Month_12."";

$file = "bots.txt";
if(file_exists($file)) {
	$fh = fopen($file, 'r+');
	$s = filesize($file);
	if($s == 0) {
		$out = "<strong>"._BOT_NOACCESS."</strong>";
	}else{
		$contents = fread($fh, $s);
		fclose($fh);
		
		$info = explode("|",$contents);
		$day = explode("/",$info[0]);
		$m = number_format($day[1]);
		$tm = explode(":",$info[1]);
		$agent = $info[2];
		$ip = $info[3];

		$out = "<strong>"._BOT_ACCESS." ".$agent ." ". ($ip) ."";
		
		if(date('d',time()) == $day[0]){
			$out .= " "._BOT_TODAY."";
		}else{
			$out .=" "._BOT_TODAYS." ".$day[0]." ".$month[$m]." ". ($day[2]+543);
		}
		$out .= " "._BOT_TIMES." ". $tm[0]. ".".$tm[1]." "._BOT_TIMESN."</strong>";
		
	}
	echo $out;
}
?>