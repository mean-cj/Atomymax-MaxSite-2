<?
function anti_injection( $user, $pass ,$ip) {
	global $db;
           // We'll first get rid of any special characters using a simple regex statement.
           // After that, we'll get rid of any SQL command words using a string replacment.
            $banlist = ARRAY ("'", "--", "select", "union", "insert", "update", "like", "delete", "distinct", "having", "truncate", "replace", "handler", " as ", "or ", "procedure", "limit", "order by", "group by", "asc", "desc" , "1=1", "or", "#", "//","' or '1'='1'","'1'='1'" );
            // ---------------------------------------------
            IF ( preg_match ( "/[a-zA-Z0-9]+/i", $user ) ) {
                    $user = TRIM ( STR_REPLACE ( $banlist, '', STRTOLOWER ( $user ) ) );
            } ELSE {
                    $user = NULL;
            }
            // ---------------------------------------------
            // Now to make sure the given password is an alphanumerical string
            // devoid of any special characters. strtolower() is being used
            // because unfortunately, str_ireplace() only works with PHP5.
            IF ( preg_match ( "/[a-zA-Z0-9]+/i", $pass ) ) {
                    $pass = TRIM ( STR_REPLACE ( $banlist, '', STRTOLOWER ( $pass ) ) );
            } ELSE {
                    $pass = NULL;
            }
            // ---------------------------------------------
            // Now to make an array so we can dump these variables into the SQL query.
            // If either user or pass is NULL (because of inclusion of illegal characters),
            // the whole script will stop dead in its tracks.
            $array = ARRAY ( 'user' => $user, 'pass' => $pass );
            // ---------------------------------------------
            IF ( IN_ARRAY ( NULL, $array ) ) {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_IPBLOCK,array(
			"ip"=>"".$ip."",
			"post_date"=>"".time().""
		));
		$db->closedb ();
?>
<BR><BR>
<CENTER><A HREF="?name=index"><IMG SRC="images/dangerous.png" BORDER="0"></A><BR><BR>
<FONT COLOR="#336600"><B><?=_ADMIN_IPBLOCK_MESSAGE_HACK;?> <?=WEB_EMAIL;?></B></FONT><BR><BR>
<A HREF="?name=index"><B><?=_ADMIN_IPBLOCK_MESSAGE_HACK1;?></B></A>
</CENTER>
<? echo "<meta http-equiv='refresh' content='10; url=?name=index'>" ; ?>
<BR><BR>
<?
            } ELSE {
                    RETURN $array;
            }
    }

function youtubeID($url){
 	 $res = explode("v=",$url);
	 if(isset($res[1])) {
	 	$res1 = explode('&',$res[1]);
		if(isset($res1[1])){
			$res[1] = $res1[0];
		}
		$res1 = explode('#',$res[1]);
		if(isset($res1[1])){
			$res[1] = $res1[0];
		}
	 }
	 return substr($res[1],0,12);
  	 return false;
 }

function mbmGetFLVDuration($file){
    // read file
  if (file_exists($file)){
    $handle = fopen($file, "r");
    $contents = fread($handle, filesize($file));
    fclose($handle);
    //
    if (strlen($contents) > 3){
      if (substr($contents,0,3) == "FLV"){
        $taglen = hexdec(bin2hex(substr($contents,strlen($contents)-3)));
        if (strlen($contents) > $taglen){
          $duration = hexdec(bin2hex(substr($contents,strlen($contents)-$taglen,3)))  ;
          return $duration;
        }
      }
    }
  }
}

function check_captcha($cap) {
	if($_SESSION['security_code'] != $cap OR empty($cap)) {
		echo "<script language='javascript'>" ;
		echo "alert('"._JAVA_CAPTCHA_NOACC."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	} else {
	return true;
	}
}

function is_valid($input)
{
$input = strtolower($input);

if (str_word_count($input) > 1)
{
$loop = true;
$input = explode(" ",$input);
}

$bad_strings = array("'", "--", "select", "union", "insert", "update", "like", "delete", "distinct", "having", "truncate", "replace", "handler", " as ", "or ", "procedure", "limit", "order by", "group by", "asc", "desc" , "1=1", "or", "#", "//","' or '1'='1'","'1'='1'" );

if ($loop == true)
{
foreach($input as $value)
{
if (in_array($value, $bad_strings))
{
return false;
}
else
{
return true;
}
}
}
else
{
if (in_array($input, $bad_strings))
{
return false;
}
else
{
return true;
}
}
}

function resetpassword($email,$name,$user,$password) {
global $email,$name,$user,$password;
$admin_mail="".WEB_EMAIL."";
$home="".WEB_URL."";
$Headers = "MIME-Version: 1.0\r\n" ;
$Headers .= "Content-type: text/html; charset=".ISO."\r\n" ;
                          // ส่งข้อความเป็นภาษาไทย ใช้ "windows-874"
$Headers .= "From: ".WEB_EMAIL." <".WEB_EMAIL.">\r\n" ;
$Headers .= "Reply-to: ".WEB_EMAIL." <".WEB_EMAIL.">\r\n" ;
$Headers .= "X-Priority: 3\r\n" ;
$Headers .= "X-Mailer: PHP mailer\r\n" ;

$subject_mail = ""._RESET_MAIL_SUB."" ; // หัวข้ออีเมล์ 

//----------------------------------------------------------------------- เนื้อหาของอีเมล์ //
$message_mail = ""._RESET_MAIL_BODY."" ;
$message_mail .= ""._RESET_MAIL_BODY1." $name" ;
$message_mail .= ""._RESET_MAIL_BODY2." $user" ;
$message_mail .= ""._RESET_MAIL_BODY3." $password" ;
$message_mail .= ""._RESET_MAIL_BODY4." $home" ;
$message_mail .= ""._RESET_MAIL_BODY5."" ;

//------------------------------------------------------------------------ จบเนื้อหาของอีเมล์ //
$from = "".WEB_EMAIL."" ;
if(@mail($email,$subject_mail,$message_mail,$Headers,$from))
{
echo "<br><br><center><font size='3' face='MS Sans Serif'><b>" ;
echo "<center><font size=\"3\" face='MS Sans Serif'><b>"._RESET_MAIL_SEND1." $email "._RESET_MAIL_SEND2."</b></font></center>" ;
echo ""._RESET_MAIL_SEND_WAIT."</b></font></center>" ;
}else{
echo ""._RESET_MAIL_SEND_NO."";
}
}


function get_content($URL) {
         $ch = curl_init();
         $timeout = 0; // set to zero for no timeout
         $useragent="Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
         curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
         curl_setopt ($ch, CURLOPT_URL, $URL);
         curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
          $String = curl_exec($ch);
          curl_close($ch);
           return $String;
 }

function plgContentpdfembed( $row, $params) {
	
	// expression to search for
	$regex = "#{pdf[\=|\s]?(.+)}#s";
 	$regex1 = '/{(pdf=)\s*(.*?)}/i';

	// find all instances of mambot and put in $matches
	preg_match_all( $regex1, $row, $matches );

 	// Number of mambots
	$count = count( $matches[0] );

	for ($i=0; $i<$count; $i++) {	
		$r	=	str_replace( '{pdf=', '', $matches[0][$i]);
		$r	=	str_replace( '}', '', $r); 
		$ex	=	explode('|',$r);
		
		$ploc	=	$ex[0]; 		
		$w	=	$ex[1];
		$h	=	$ex[2];
		
		$replace = plg_pdfembed_replacer($ploc , $w, $h );
		$row= str_replace( '{pdf='.$ex[0].'|'.$ex[1].'|'.$ex[2].'}', $replace, $row);
	} 
	return true;
}
	
function plg_pdfembed_replacer($ploc , $w, $h ) {
		
		return '<embed src="'.$ploc.'" width="'.$w.'" height="'.$h.'"/>';
	}

function timeyoutube($duration){
//Initially we set hours,minutes and second all to zero
$hours = 0;
$minutes = 0;
$seconds = 0;
//If duration > 3600 sec then we increase hour count
// We increase count untill duration is less than 3600
while($duration >= 3600) {
$hours = $hours + 1;
$duration = $duration - 3600;
}
//suppose we have duration more than 60 sec then we increment minute count
//We increase count untill duration is less than 60 sec
while($duration >= 60) {
$minutes = $minutes + 1;
$duration = $duration - 60;
}
$seconds = $duration;
//if duration of video is less than 10 sec then we directly write it in M:S
if($seconds < 10) {
$seconds = '0'.$seconds.'';
}
//We store the duration in Variable Time
$time = ''.$minutes.':'.$seconds.'';
if($hours > 0) {
$time = ''.$hours.':'.$time.'';
}
return $time;
}

function dateTimeDiff($db_date) {

	if (!function_exists('gregoriantojd')) {
	 	function gregoriantojd() {
	 		$msg = "The PHP calendar function is disabled\n
	 		Please ask your host to do a normal php install";
	 		$fo = @fopen('phpmotion_errors.txt', 'w');
	 		@fwrite($fo, $msg);
	 		@fclose($fo);
	 	}
	 }


	$h_r			= '';
	$m_r 			= '';
	$s_r 			= '';

	// from V3 tables
	// 2008-07-14 20:34:03

	$c_date		= date('Y-m-d H:i:s');
	$c_year 		= substr($c_date,0,4);
	$c_month 		= substr($c_date,5,2);
	$c_day 		= substr($c_date,8,2);
	$r_year 		= substr($db_date,0,4);
	$r_month 		= substr($db_date,5,2);
	$r_day 		= substr($db_date,8,2);
	$tmp_m_dates	= $c_year . $c_month . $c_day;
	$tmp_r_use 		= $r_year . $r_month . $r_day;
	$tmp_dif 		= $tmp_m_dates-$tmp_r_use;
	$use_diff 		= $tmp_dif;
	$c_hour 		= substr($c_date,11,2);
	$c_min 		= substr($c_date,14,2);
	$c_seconds 		= substr($c_date,17,2);
	$r_hour 		= substr($db_date,11,2);
	$r_min 		= substr($db_date,14,2);
	$r_seconds 		= substr($db_date,17,2);
	$h_r 			= $c_hour-$r_hour;
	$m_r 			= $c_min-$r_min;
	$s_r 			= $c_seconds-$r_seconds;

	if( $use_diff < 1 ) {
		if( $h_r > 0 ) {
			if( $m_r < 0 ) {
				$m_r	= 60 + $m_r;
				$h_r 	= $h_r - 1;
				return $m_r . " Mins ago";
			} else {
				return $h_r. " Hrs " . $m_r . " Mins ago";
			}
		} else {
			if( $m_r > 0 ){
				return $m_r . " Mins ago";
			} else {
				return $s_r . " Secs ago";
			}
		}
	} else {
		$c_date		= date('m/d/Y');
		$date_str 		= strtotime($db_date);
		$db_date 		= date('m/d/Y', $date_str);
		$dformat 		= '/';
		$date_part_1	= explode($dformat, $db_date);
		$date_part_2  	= explode($dformat, $c_date);
		$db_date	  	= gregoriantojd($date_part_1[0], $date_part_1[1], $date_part_1[2]);
		$c_date 		= gregoriantojd($date_part_2[0], $date_part_2[1], $date_part_2[2]);
		$days_ago 		= $c_date - $db_date;

		if ( $days_ago == 1 ) {
			$day_word = 'day ago';
		} else {
			$day_word = 'days ago';
		}

		return $days_ago . " " . $day_word;
	}

}

//function แปลง tis620 เป็น utf8
function tis620_to_utf8($tis) {
	$utf8="";
  for( $i=0 ; $i< strlen($tis) ; $i++ ){
    $s = substr($tis, $i, 1);
    $val = ord($s);
    if( $val < 0x80 ){
	 $utf8 .= $s;
    } elseif ((0xA1 <= $val and $val <= 0xDA) 
              or (0xDF <= $val and $val <= 0xFB))  {
	 $unicode = 0x0E00 + $val - 0xA0;
	 $utf8 .= chr( 0xE0 | ($unicode >> 12) );
	 $utf8 .= chr( 0x80 | (($unicode >> 6) & 0x3F) );
	 $utf8 .= chr( 0x80 | ($unicode & 0x3F) );
    }
  }
return $utf8;
} 

//function แปลง utf8 เป็น tis620
function utf8_to_tis620($string) {
  $str = $string;
  $res = "";
  for ($i = 0; $i < strlen($str); $i++) {
	if (ord($str[$i]) == 224) {
	  $unicode = ord($str[$i+2]) & 0x3F;
	  $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
	  $unicode |= (ord($str[$i]) & 0x0F) << 12;
	  $res .= chr($unicode-0x0E00+0xA0);
	  $i += 2;
	} else {
	  $res .= $str[$i];
	}
  }
  return $res;
} 

//function แปลงวันที่ให้เหมือน facebook
function fb_date($timestamp){
	$difference = time() - $timestamp;
	$periods = array("second", "minute", "hour");
	$ending=" ago";
	if($difference<60){
		$j=0;
		$periods[$j].=($difference != 1)?"s":"";
		$difference=($difference==3 || $difference==4)?"a few ":$difference;
		$text = "$difference $periods[$j] $ending";
	}elseif($difference<3600){
		$j=1;
		$difference=round($difference/60);
		$periods[$j].=($difference != 1)?"s":"";
		$difference=($difference==3 || $difference==4)?"a few ":$difference;
		$text = "$difference $periods[$j] $ending";		
	}elseif($difference<86400){
		$j=2;
		$difference=round($difference/3600);
		$periods[$j].=($difference != 1)?"s":"";
		$difference=($difference != 1)?$difference:"about an ";
		$text = "$difference $periods[$j] $ending";		
	}elseif($difference<172800){
		$difference=round($difference/86400);
		$periods[$j].=($difference != 1)?"s":"";
		$text = "Yesterday at ".date("g:ia",$timestamp);								
	}else{
		if($timestamp<strtotime(date("Y-01-01 00:00:00"))){
			$text = date("l j, Y",$timestamp)." at ".date("g:ia",$timestamp);		
		}else{
			$text = date("l j",$timestamp)." at ".date("g:ia",$timestamp);			
		}
	}
	return $text;
}


function get_real_ip()
{
    if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($addr[0]);
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    else {
        return $_SERVER['REMOTE_ADDR'];
    }
}


//webboard Icon
function WebIcon($Ntime="", $Otime="", $Icon=""){
	if(TIMESTAMP <= ($Otime + 86400)){
		echo "<IMG SRC=\"".$Icon."\" BORDER=\"0\" ALIGN=\"absmiddle\"> ";
	}
}

//News Icon
function NewsIcon($Ntime="", $Otime="", $Icon=""){
	if(TIMESTAMP <= ($Otime + 86400)){
		echo "<IMG SRC=\"".$Icon."\" BORDER=\"0\" ALIGN=\"absmiddle\"> ";
	}
}
//update icon
function UpdateIcon($Ntime="", $Otime="", $Icon=""){
	if(TIMESTAMP <= ($Otime + 86400)){
		echo "<IMG SRC=\"".$Icon."\" BORDER=\"0\" ALIGN=\"absmiddle\"> ";
	}
}
//ฟังก์ชั่นในการลบตัว \ ออกเพื่อให้แสดงผลได้ถุกต้อง
function FixQuotes ($what = "") {
        $what = preg_replace("/'/i","''",$what);
        while (preg_match("/\\\\'/i", $what)) {
                $what = preg_replace("/\\\\'/i","'",$what);
        }
        return $what;
}

//ฟังก์ชั่นเปลี่ยนข้อความเว็บและเมล์ให้เป็นลิงก์ 
function CHANGE_LINK($Message = ""){
	$Message = preg_replace("/([[:alnum:]]+)://([^[:space:]]*)([[:alnum:]#?/&=])/i","<a href=\"\\1://\\2\\3\" target=\"_blank\">\\1://\\2\\3</a>",$Message);
	$Message = preg_replace("/([[:alnum:]]+)@([^[:space:]]*)([[:alnum:]])/i","<a href=mailto:\\1@\\2\\3>\\1@\\2\\3</a>",$Message); 
return ($Message);
}

//ทำการแบ่งหน้า
function SplitPage($page="",$totalpage="",$option=""){
	global $ShowSumPages , $ShowPages ;
	// สร้าง link เพื่อไปหน้าก่อน-หน้าถัดไป
	$ShowSumPages .= "<B>"._FUNC_Page1."  </B>";
	if($page>1 && $page<=$totalpage) {
		$prevpage = $page-1;
		$ShowSumPages .= "<a href='".$option."&page=$prevpage' title='Back'><B><-</B></a>\n";
	}
	$ShowSumPages .= " <b>$page/$totalpage</b> ";
	if($page!=$totalpage) {
		$nextpage = $page+1;
		if($nextpage >= $totalpage){
			$nextpage = $totalpage ;
		}
		$ShowSumPages .= "<a href='".$option."&page=$nextpage' title='Next'><B>-></B></a>\n";
	}

	// วนลูปแสดงเลขหน้าทั้งหมด แบบเป็นช่วงๆ ช่วงละ 10 หน้า
	$b=floor($page/10); 
	$c=(($b*10));

	if($c>1) {
		$prevpage = $c-1;
		$ShowPages .= "<a href='".$option."&page=$prevpage' title='10 "._FUNC_Page2."'><<</a> \n";
	}
	else{
		$ShowPages .= "<B><<</B>\n";
	}
	$ShowPages .= " <b>";
	for($i=$c; $i<$page ; $i++) {
		if($i>0)
		$ShowPages .= "<a href='".$option."&page=$i'>$i</a> \n";
	}
	$ShowPages .= "<font color=red>$page</font> \n";
	for($i=($page+1); $i<($c+10) ; $i++) {
		if($i<=$totalpage)
		$ShowPages .= "<a href='".$option."&page=$i'>$i</a> \n";
	}
	$ShowPages .= "</b> ";
	if($c>=0) {
		if(($c+2)<$totalpage){
	$nextpage = $c+10;
	$ShowPages .= "<a href='".$option."&page=$nextpage' title='10 "._FUNC_Page3."'>>></a> \n";
		}
		else
	$ShowPages .= "<B>>></B>\n";
	}
	else{
		$ShowPages .= "<B>>></B>\n";
	}
}

//ทำการแบ่งหน้า webboard
function SplitPageboard($page="",$totalpage="",$option=""){
	global $ShowSumPages , $ShowPages ;
	// สร้าง link เพื่อไปหน้าก่อน-หน้าถัดไป
	echo "<div align=left><table  cellpadding=0 cellspacing=0 align=left><tr>";
	$ShowSumPages .= "<td align=left><div class=pagessum><B>"._FUNC_Page1."</B>";
	if($page>1 && $page<=$totalpage) {
		$prevpage = $page-1;
		$ShowSumPages .= "<a href='".$option."&page=$prevpage' title='Back'><B><-</B></a>";
	}
	$ShowSumPages .= " <b>$page/$totalpage</b>";
	if($page!=$totalpage) {
		$nextpage = $page+1;
		if($nextpage >= $totalpage){
			$nextpage = $totalpage ;
		}
		$ShowSumPages .= "<a href='".$option."&page=$nextpage' title='Next'><B>-></B></a>";
	}
	$ShowSumPages .="</div></td><td border=0 align=left>&nbsp;&nbsp;</td>";
	// วนลูปแสดงเลขหน้าทั้งหมด แบบเป็นช่วงๆ ช่วงละ 10 หน้า
	$b=floor($page/10); 
	$c=(($b*10));

	if($c>1) {
		$prevpage = $c-1;
		$ShowPages .= "<td align=left><div class=pages><a href='".$option."&page=$prevpage' title='10 "._FUNC_Page2."'><<</a>";
	}
	else{
		$ShowPages .= "<td align=left><div class=pages><B><<</B>";
	}
	$ShowPages .= " <b></div></td><td border=0 align=left>&nbsp;</td>";

	for($i=$c; $i<$page ; $i++) {
		if($i>0)
		$ShowPages .= "<td align=left><div class=pages><a href='".$option."&page=$i'>$i</a></div></td><td border=0 align=left>&nbsp;</td>";
	}
	$ShowPages .= "<td align=left><div class=pages><font color=red>$page</font></div></td><td border=0 align=left>&nbsp;</td>";
	for($i=($page+1); $i<($c+10) ; $i++) {
		if($i<=$totalpage)
		$ShowPages .= "<td align=left><div class=pages><a href='".$option."&page=$i'>$i</a></div></td><td border=0 align=left>&nbsp;</td>";
	}
	$ShowPages .= "</b> ";
	if($c>=0) {
		if(($c+2)<$totalpage){
	$nextpage = $c+10;
	$ShowPages .= "<td align=left><div class=pages><a href='".$option."&page=$nextpage' title='10 "._FUNC_Page3."'>>></a></div></td><td border=0 align=left>&nbsp;</td>";
		}
		else
	$ShowPages .= "<td align=left><div class=pages><B>>></B></div></td><td border=0 align=left>&nbsp;</td>";
	}
	else{
		$ShowPages .= "<td align=left><div class=pages><B><td class=login>>></B></div></td><td border=0 align=left>&nbsp;</td>";
	}
	echo "</tr></table></div>";
}

// แบ่งหน้าแบบสวยงาม

function page_navigator($modules="",$file="",$id="",$before_p="",$plus_p="",$total="",$total_p="",$chk_page=""){   
	global $db;
	$pPrev=$chk_page-1;
	$pPrev=($pPrev>=0)?$pPrev:0;
	$pNext=$chk_page+1;
	$pNext=($pNext>=$total_p)?$total_p-1:$pNext;		
	$lt_page=$total_p-9;
	if($chk_page>0){  
		echo "<a  href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$pPrev' class='naviPN'>Prev</a>";
	}
	if($total_p>=17){
		if($chk_page>=9){
			echo "<a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=0'>1</a><a class='SpaceC'>. . .</a>";   
		}
		if($chk_page<9){
			for($i=0;$i<$total_p;$i++){  
				$nClass=($chk_page==$i)?"class='selectPage'":"";
				if($i<=9){
				echo "<a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$i'>".intval($i+1)."</a> ";   
				}
				if($i==$total_p-1 ){ 
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$i'>".intval($i+1)."</a> ";   
				}		
			}
		}
		if($chk_page>=9 && $chk_page<$lt_page){
			$st_page=$chk_page-3;
			for($i=1;$i<=10;$i++){
				$nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";
				echo "<a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=".intval($st_page+$i)."'>".intval($st_page+$i+1)."</a> ";   	
			}
			for($i=0;$i<$total_p;$i++){  
				if($i==$total_p-1 ){ 
				$nClass=($chk_page==$i)?"class='selectPage'":"";
				echo "<a class='SpaceC'>. . .</a><a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$i'>".intval($i+1)."</a> ";   
				}		
			}									
		}	
		if($chk_page>=$lt_page){
			for($i=0;$i<=9;$i++){
				$nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";
				echo "<a $nClass href='?name=".$modules."&file=".$file."&id=".$id."&s_page=".intval($lt_page+$i-1)."'>".intval($lt_page+$i)."</a> ";   
			}
		}		 
	}else{
		for($i=0;$i<$total_p;$i++){  
			$nClass=($chk_page==$i)?"class='selectPage'":"";
			echo "<a href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$i' $nClass  >".intval($i+1)."</a> ";   
		}		
	} 	
	if($total_p !='' && $chk_page<$total_p-1){
		echo "<a href='?name=".$modules."&file=".$file."&id=".$id."&s_page=$pNext'  class='naviPN'>Next</a>";
	}
}   




//code แบ่งหน้าสำหรับบทความที่มีข้อความยาวๆ
function breakpage($mod="",$page="",$id="",$thepage=""){
	global $mod , $page ,$id ,$thepage;

$contentpages = explode( "<!--pagebreak-->", $thepage );

$pageno = count($contentpages);
if ( $page=="" || $page < 1 ) $page = 1;
if ( $page > $pageno ) $page = $pageno;
$arrayelement = (int)$page;
$arrayelement --;
if ($pageno > 1) $thepageNew .= "<b>"._PAGES." $page/$pageno</b><br />";
$thepageNew = "<p align=\"justify\">".$contentpages["".$arrayelement.""]."</p>";
if($page >= $pageno) $next_page = "";
else {
   $next_pagenumber = $page + 1;
   if ($page != 1) {
      $next_page .= "- ";
   }
   $next_page .= "<a href=\"?name=".$mod."&amp;file=read".$mod."&amp;id=".$id."&amp;page=$next_pagenumber\"><b>"._NEXT." ($next_pagenumber/$pageno)</b></a><a href=\"?name=".$mod."&amp;file=read".$mod."&amp;id=".$id."&amp;page=$next_pagenumber\">  <img src=\"images/go.gif\"border=\"0\" alt=\""._NEXT."\" /></a>";
}
if($page <= 1) $previous_page = "";
else {
   $previous_pagenumber = $page - 1;
   $previous_page = "<a href=\"?name=".$mod."&amp;file=read".$mod."&amp;id=".$id."&amp;page=$previous_pagenumber\"><img src=\"images/backs.gif\" border=\"0\" alt=\""._PREVIOUS."\" /></a>  <a href=\"?name=".$mod."&amp;file=read".$mod."&amp;id=".$id."&amp;page=$previous_pagenumber\"><b>"._PREVIOUS." ($previous_pagenumber/$pageno)</b></a>";
}
$thepageNew .= "<br /><center><b> $previous_page $next_page </b></center><br />";
$thepages = $thepageNew;
echo "$thepages";
// End PageBreak Code
}

//Function Sendmail
function SendMail($charset="",$to="",$tocc="",$from="",$subject="",$topic=""){
	/* message */
	$message = "
	<html>
	<head>
	<title>".$subject."</title>
	</head>
	<body>
	".$topic."
	</body>
	</html>
	";

	/* To send HTML mail, you can set the Content-type header. */
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=".$charset."\r\n";

	/* additional headers */
	$headers .= "To: ".$to."\r\n";
	$headers .= "From: ".$from."\r\n";
	$headers .= "Cc: ".$tocc."\r\n";

	/* and now mail it */
	if(mail($to, $subject, $message, $headers)){
		return true ;
	}else{
		return false ;
	}
}


function sendmailnew($subject ,$detail,$yourmail,$province,$known,$suggest) {
//$yourmail= $_POST['YOURMAIL'];
//$from = "From:\"$yourmail\"<$yourmail>" ;
$admin_mail="".WEB_EMAIL."";
$Headers = "MIME-Version: 1.0\r\n" ;
$Headers .= "Content-type: text/html; charset=".ISO."\r\n" ;
                          // ส่งข้อความเป็นภาษาไทย ใช้ "windows-874"
$Headers .= "From: ".$yourmail." <".$yourmail.">\r\n" ;
$Headers .= "Reply-to: ".WEB_EMAIL." <".WEB_EMAIL.">\r\n" ;
$Headers .= "X-Priority: 3\r\n" ;
$Headers .= "X-Mailer: PHP mailer\r\n" ;
 //----------------------------------------------------------------------- ???????????????? //
$alldetail = _MAIL_NEW;
$alldetail .= _MAIL_NEW1." $yourmail";
$alldetail .= _MAIL_NEW2." $province";
$alldetail .= _MAIL_NEW3." $known";
$alldetail .= _MAIL_NEW4." $suggest";
$alldetail .= _MAIL_NEW5." $detail";
@mail($admin_mail,$subject,$alldetail,$Headers,$from);
}

function ThaiTimeMini($timestamp="",$mini=""){
	global $SHORT_MONTH, $FULL_MONTH, $DAY_SHORT_TEXT, $DAY_FULL_TEXT;
	$day = date("l",$timestamp);
	$month = date("n",$timestamp);
	$year = date("Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	$times = date("H:i",$timestamp);

	    $ThaiText = date("j",$timestamp);

return $ThaiText;
}
//แปลงเวลาเป็นภาษาไทย
function ThaiTimeConvert($timestamp="",$full="",$showtime=""){
	global $SHORT_MONTH, $FULL_MONTH, $DAY_SHORT_TEXT, $DAY_FULL_TEXT;
	$day = date("l",$timestamp);
	$month = date("n",$timestamp);
	$year = date("Y",$timestamp);
	$time = date("H:i:s",$timestamp);
	$times = date("H:i",$timestamp);
	if($full){
		$ThaiText = $DAY_FULL_TEXT[$day]." "._TIME_AT." ".date("j",$timestamp)." "._MONTH_AT." ".$FULL_MONTH[$month]." "._YEAR_AT."".($year+543) ;
	}else{
		$ThaiText = date("j",$timestamp)."/".$SHORT_MONTH[$month]."/".($year+543);
	}

	if($showtime == "1"){
		return $ThaiText." "._TIMES_AT." ".$time;
	}else if($showtime == "2"){
		$ThaiText = date("j",$timestamp)." ".$SHORT_MONTH[$month]." ".($year+543);
		return $ThaiText." : ".$times;
	}else{
		return $ThaiText;
	}
}

//เปลี่ยนจาก 11/2/2554  เป็น 11 ก.พ. 2554
function formatDateThai($date){
$list= array("",""._Month_1."",""._Month_2."",""._Month_3."",""._Month_4."",""._Month_5."",""._Month_6."",""._Month_7."",""._Month_8."",""._Month_9."",""._Month_10."",""._Month_11."",""._Month_12."");
list($d,$m,$y) =preg_split("/\//",$date);
return "$d {$list[$m]} $y";
}

//ตรวจสอบสิทธิ์การใช้งาน webboard
function CheckWebboard($user = "", $pwd ="" ,$cat="" ){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['web'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." where id='$cat' ");
	$arr['web'] = $db->fetch($res['web']);
     if($arr['web']['status'] =='1'){
				if ($_SESSION['login_true']){
				$res['mem'] = $db->select_query("SELECT * FROM ".TB_MEMBER." where user='$user' AND password='$pwd'  ");
			    $arr['mem'] = $db->fetch($res['mem']);
				if (!$arr['mem']['id']){
				echo "<script language='javascript'>" ;
				echo "alert('"._BOARD_SIT."')" ;
				echo "</script>" ;
				echo "<meta http-equiv='refresh' content='0; url=?name=member'>";
				exit();
				} 
				} else if ($_SESSION['admin_user']){
				$res['mem'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where username='$user' AND password='$pwd'  ");
			    $arr['mem'] = $db->fetch($res['mem']);
				if (!$arr['mem']['id']){
				echo "<script language='javascript'>" ;
				echo "alert('"._BOARD_SIT."')" ;
				echo "</script>" ;
				echo "<meta http-equiv='refresh' content='0; url=?name=admin'>";
				exit();
				} 
				} else {
				echo "<script language='javascript'>" ;
				echo "alert('"._BOARD_SIT."')" ;
				echo "</script>" ;
				echo "<meta http-equiv='refresh' content='0; url=?name=member'>";
				exit();
				}
	    }
}

//ตรวจสอบว่าเป็น Admin จริงหรือไม่จริง
function CheckAdmin($user = "", $pwd =""){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['user'] = $db->select_query("SELECT id FROM ".TB_ADMIN." WHERE username='$user' AND password='$pwd' ");
	$arr['user'] = $db->fetch($res['user']);
	if(!$arr['user']['id']){
		echo "<script language='javascript'>" ;
		echo "alert('"._ADMIN_SIT."')" ;
		echo "</script>" ;
		echo "<meta http-equiv='refresh' content='1; url=?name=admin'>";
		exit();
	}
}

//ตรวจสอบว่าเป็น User จริงหรือไม่จริง ใช้สำหรับระบบสมาชิก สำหรับ MAXSITE @V.3
function CheckUser($user = "", $pwd =""){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['user'] = $db->select_query("SELECT id FROM ".TB_MEMBER." WHERE user='$user' AND password='$pwd' ");
	$arr['user'] = $db->fetch($res['user']);
	if(!$arr['user']['id']){
		echo "<script language='javascript'>" ;
		echo "alert('"._MEMBER_SIT."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
}
function OpenTable(){
echo "<TABLE cellSpacing=0 cellPadding=0 width=660  border=0>
      <TBODY>
        <TR>
          <TD><IMG SRC=images/main/1.gif BORDER=0 width=7 height=7></td><TD background=images/main/2.gif BORDER=0 height=7 width=650><IMG SRC=images/main/2.gif BORDER=0  height=7></td><TD><IMG SRC=images/main/3.gif BORDER=0 width=7 height=7></td>
		</tr>
        <TR>
          <TD background=images/main/4.gif BORDER=0 height=100% width=7></td>
		  <TD width=100%>";

}

function CloseTable(){
echo "</td>
  <TD background=images/main/5.gif BORDER=0 height=100% width=7></td>
		</tr>
        <TR>
          <TD><IMG SRC=images/main/6.gif BORDER=0 width=7 height=7></td><TD background=images/main/7.gif BORDER=0 height=7 width=650><IMG SRC=images/main/7.gif BORDER=0  height=7></td><TD><IMG SRC=images/main/8.gif BORDER=0 width=7 height=7></td>
		</tr>
		</table>";

}


function OpenTablemod(){
echo "<table  width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
				<td width=\"10\" height=\"10\"><img src=\"images/pic/news-tl.gif\"></td>
				<td height=\"10\" background=\"images/pic/news-tbg.png\"></td>
				<td width=\"10\" height=\"10\"><img src=\"images/pic/news-tr.gif\"></td>
				</tr>
                  <tr>
                    <td width=\"10\" valign=\"top\" height=\"100%\" background=\"images/pic/news-left.png\"></td>
                    <td width=\"100%\" valign=\"top\"  >";
}

function CloseTablemod(){
echo "</td>
                    <td width=\"10\" align=\"center\"  height=\"100%\"  background=\"images/pic/news-right.png\"></td>
				</tr>
				<tr>
				<td width=\"10\" height=\"10\"><img src=\"images/pic/news-bl.gif\"></td>
				<td height=\"10\" background=\"images/pic/news-bbg.png\"></td>
				<td width=\"10\" height=\"10\"><img src=\"images/pic/news-br.gif\"></td>
				</tr>
            </table>";
}

function OpenTableAd(){
echo "<table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
				<td width=\"11\" height=\"11\"><img src=\"../images/pic/block01.jpg\"></td>
				<td height=\"11\"  background=\"../images/pic/block02.jpg\"></td>
				<td width=\"12\" height=\"11\"><img src=\"../images/pic/block03.jpg\"></td>
				</tr>
              <tr>
			  <td width=\"12\" align=\"center\"  height=\"100%\"  background=\"../images/pic/block04.jpg\"></td>
                <td width=\"100%\" valign=\"top\">";
}

function CloseTableAd(){
echo "</td>
				<td width=\"12\" align=\"center\"  height=\"100%\"  background=\"../images/pic/block05.jpg\"></td>
				</tr>
				<tr>
				<td width=\"11\" height=\"12\"><img src=\"../images/pic/block06.jpg\"></td>
				<td height=\"11\" background=\"../images/pic/block07.jpg\"></td>
				<td width=\"12\" height=\"12\"><img src=\"../images/pic/block08.jpg\"></td>
            </table>";
}

function OpenTablecom(){
echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
				<tr>
				<td width=\"11\" height=\"11\"><img src=\"images/pic/block01.jpg\"></td>
				<td height=\"11\"  background=\"images/pic/block02.jpg\"></td>
				<td width=\"12\" height=\"11\"><img src=\"images/pic/block03.jpg\"></td>
				</tr>
              <tr>
			  <td width=\"12\" align=\"center\"  height=\"100%\"  background=\"images/pic/block04.jpg\"></td>
                <td width=\"100%\" valign=\"top\" align=\"center\">";
}

function CloseTablecom(){
echo "</td>
				<td width=\"12\" align=\"center\"  height=\"100%\"  background=\"images/pic/block05.jpg\"></td>
				</tr>
				<tr>
				<td width=\"11\" height=\"12\"><img src=\"images/pic/block06.jpg\"></td>
				<td height=\"11\" background=\"images/pic/block07.jpg\"></td>
				<td width=\"12\" height=\"12\"><img src=\"images/pic/block08.jpg\"></td>
            </table>";
}

function CheckUserblog($user = "", $pwd =""){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['user'] = $db->select_query("SELECT id FROM ".TB_MEMBER." WHERE user='$user' AND password='$pwd' and blog='1' ");
	$arr['user'] = $db->fetch($res['user']);
	if(!$arr['user']['id']){
		echo "<script language='javascript'>" ;
		echo "alert('"._MEMBER_BLOG_ALL."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
}

//ตรวจสอบระดับของผู้ดูแลระบบ
function CheckLevel($Username = "", $Action = ""){
	global $db ;
	//Check Level
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='$Username' ");
	$arr['user'] = $db->fetch($res['user']);
	//Check Action
	$res['action'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." WHERE id='".$arr['user']['level']."' ");
	$arr['action'] = $db->fetch($res['action']);
	if($arr['action'][$Action]){
		return True;
	}else{
		return False;
	}
}


//ตรวจสอบระดับของผู้ดูแลระบบ ใช้สำหรับระบบสมาชิก สำหรับ MAXSITE @V.3
function CheckLevelUser($Username = "", $Action = ""){
	global $db ;
	//Check Level
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='$Username' ");
	$arr['user'] = $db->fetch($res['user']);
	//Check Action
	$res['action'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." WHERE id='".$arr[user][level]."' ");
	$arr['action'] = $db->fetch($res['action']);
	if($arr['action'][$Action]){
		return True;
	}else{
		echo "<script language='javascript'>" ;
		echo "alert('"._MEMBER_MOD_ALL."')" ;
		echo "</script>" ;
		echo "<script language='javascript'>javascript:history.go(-1)</script>";
		exit();
	}
}


//countblock
function CountBlock($pblock=""){
	global $db ;
	//Check Level
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['Countsx'] = $db->select_query("SELECT *,count(pblock) as num FROM ".TB_BLOCK." WHERE status='1' and pblock='$pblock' group by pblock");
	$arr['Countsx'] = $db->fetch($res['Countsx']);
if($arr['Countsx']['num']){
return True;
} else {
echo "";
}
}

//blog level
function BlogLevel($count=""){
	global $db ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['countsy'] = $db->select_query("SELECT * FROM ".TB_BLOG_LEVEL." ");

while ($arr['countsy'] = $db->fetch($res['countsy'])) {
$levelid=$arr['countsy']['level_id'];
if ($levelid=='1'){
	$level1=$arr['countsy']['level_count'];
}
if ($levelid=='2'){
	$level2=$arr['countsy']['level_count'];
} 
if ($levelid=='3'){
	$level3=$arr['countsy']['level_count'];
} 
if ($levelid=='4'){
	$level4=$arr['countsy']['level_count'];
} 
 if ($levelid=='5'){
	$level5=$arr['countsy']['level_count'];
} 
 if ($levelid=='6'){
	$level6=$arr['countsy']['level_count'];
}
}
if ($count >=0 && $count <= $level1 ){ echo '<img src=images/rate/rank1.gif BORDER=\"0\" ALIGN=\"absmiddle\">  <font color=#CC3399>[ '._COUNT_STAR1.' ]</font>';}
if ($count >$level1 && $count <= $level2) { echo '<img src=images/rate/rank2.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR2.' ]</font>';}
if ($count >$level2 && $count <= $level3) { echo '<img src=images/rate/rank3.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR3.' ]</font>';}
if ($count >$level3 && $count <= $level4) { echo '<img src=images/rate/rank4.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR4.' ]</font>';}
if ($count >$level4 && $count <= $level5 ) { echo '<img src=images/rate/rank5.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR5.' ]</font>';}
if ($count >=$level6) { echo '<img src=images/rate/rank6.gif BORDER=\"0\" ALIGN=\"absmiddle\">   <font color=#CC3399>[ '._COUNT_STAR6.' ]</font>';}

}

//ตัว Alert ว่าไม่สามารถเข้าใช้งานได้ 
function NotTrueAlert($permission="", $option="", $text=""){
	if($option == 1){
		$option = "<script language='javascript'>javascript:history.go(-1)</script>";
	}elseif($option == 2){
		$option = "<script language='javascript'>refresh_close();</script>";
	}elseif($option == 3){
		$option = "<script language='javascript'>self.close();</script>";
	}

	if(!$permission){
		echo "<script language='javascript'>" ;
		echo "alert('".$text."')" ;
		echo "</script>" ;
		echo $option ;
		exit();
	}
}

//เช็คขนาด Folder
function dirsize($dirName = '.') {
   $dir  = dir($dirName);
   $size = 0;

   while($file = $dir->read()) {
       if ($file != '.' && $file != '..') {
           if (is_dir($file)) {
               $size += dirsize($dirName . '/' . $file);
           } else {
               $size += filesize($dirName . '/' . $file);
           }
       }
   }
   $dir->close();
   return $size;
}

//แปลงหน่วยขนาดไฟล์ 
function getfilesize($bytes) {
   if ($bytes >= 1099511627776) {
       $return = round($bytes / 1024 / 1024 / 1024 / 1024, 2);
       $suffix = "TB";
   } elseif ($bytes >= 1073741824) {
       $return = round($bytes / 1024 / 1024 / 1024, 2);
       $suffix = "GB";
   } elseif ($bytes >= 1048576) {
       $return = round($bytes / 1024 / 1024, 2);
       $suffix = "MB";
   } elseif ($bytes >= 1024) {
       $return = round($bytes / 1024, 2);
       $suffix = "KB";
   } else {
       $return = $bytes;
       $suffix = "Byte";
   }
   if ($return == 1) {
       $return .= " " . $suffix;
   } else {
       $return .= " " . $suffix . "s";
   }
   return $return;
}

function showerror($showmsg) { 
	echo" <table width=\"400\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr>
    <td><div align=\"left\">
      <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
        <tbody>
          <tr>
            <td width=\"20\"></td>
            <td></td>
            <td width=\"19\"></td>
          </tr>
        </tbody>
      </table>
      <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
        <tbody>
          <tr>
            <td width=\"10\"></td>
            <td valign=\"top\" width=\"100%\"><div align=\"center\">
              <table cellspacing=\"0\" cellpadding=\"0\" width=\"98%\" border=\"0\">
                <tbody>
                  <tr>
                    <td><table width=\"100%\" cellspacing=\"5\">
                      <tr>
                        <td><div align=\"center\"><strong><br />
                          <br />
                          $showmsg</strong><br />
                        </div></td>
                      </tr>
                    </table></td>
                  </tr>
                </tbody>
              </table>
            </div></td>
            <td width=\"10\"></td>
          </tr>
        </tbody>
      </table>
      <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\">
        <tbody>
          <tr>
            <td width=\"20\"></td>
            <td></td>
            <td width=\"19\"></td>
          </tr>
        </tbody>
      </table>
    </div></td>
  </tr>
</table>";
} // end fuction checktel

//ฟังก์ชั่นเปลี่ยนไอคอน
function CHANGE_EMOTICON($Message = ""){
	$Message = preg_replace("/:emo1:","<IMG SRC=\"images/emotion/angel_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo2:","<IMG SRC=\"images/emotion/angry_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo3:","<IMG SRC=\"images/emotion/broken_heart.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo4:","<IMG SRC=\"images/emotion/cake.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo5:","<IMG SRC=\"images/emotion/confused_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo6:","<IMG SRC=\"images/emotion/cry_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo7:","<IMG SRC=\"images/emotion/devil_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo8:","<IMG SRC=\"images/emotion/embaressed_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo9:","<IMG SRC=\"images/emotion/envelope.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo10:","<IMG SRC=\"images/emotion/heart.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo11:","<IMG SRC=\"images/emotion/kiss.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo12:","<IMG SRC=\"images/emotion/lightbulb.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo13:","<IMG SRC=\"images/emotion/omg_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo14:","<IMG SRC=\"images/emotion/regular_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo15:","<IMG SRC=\"images/emotion/sad_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo16:","<IMG SRC=\"images/emotion/shades_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo17:","<IMG SRC=\"images/emotion/teeth_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo18:","<IMG SRC=\"images/emotion/thumbs_down.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo19:","<IMG SRC=\"images/emotion/thumbs_up.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo20:","<IMG SRC=\"images/emotion/tounge_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo21:","<IMG SRC=\"images/emotion/whatchutalkingabout_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo22:","<IMG SRC=\"images/emotion/wink_smile.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message);
	$Message = preg_replace("/:emo23:","<img src=\"images/emotion2/001.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo24:","<img src=\"images/emotion2/002.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo25:","<img src=\"images/emotion2/003.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo26:","<img src=\"images/emotion2/004.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo27:","<img src=\"images/emotion2/005.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo28:","<img src=\"images/emotion2/006.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo29:","<img src=\"images/emotion2/007.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo30:","<img src=\"images/emotion2/008.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/::emo31:","<img src=\"images/emotion2/009.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo32:","<img src=\"images/emotion2/010.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo33:","<img src=\"images/emotion2/011.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo34:","<img src=\"images/emotion2/012.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo35:","<img src=\"images/emotion2/013.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo36:","<img src=\"images/emotion2/014.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo37:","<img src=\"images/emotion2/015.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo38:","<img src=\"images/emotion2/016.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo39:","<img src=\"images/emotion2/017.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo40:","<img src=\"images/emotion2/018.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo41:","<img src=\"images/emotion2/019.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo42:","<img src=\"images/emotion2/020.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo43:","<img src=\"images/emotion2/021.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo44:","<img src=\"images/emotion2/022.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo45:","<img src=\"images/emotion2/023.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo46:","<img src=\"images/emotion2/024.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo47:","<img src=\"images/emotion2/025.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo48:","<img src=\"images/emotion2/026.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo49:","<img src=\"images/emotion2/027.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo50:","<img src=\"images/emotion2/028.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo51:","<img src=\"images/emotion2/029.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 
	$Message = preg_replace("/:emo52:","<img src=\"images/emotion2/030.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">/i",$Message); 

	return stripslashes($Message);
}

//BB Code
$_BBCONFIG['QuotedBgColor'] = '#F7F7F7';
$_BBCONFIG['QuotedBorderColor'] = '#CCCCCC';
$_BBCONFIG['CodeBgColor'] = '#EFF7FF';
$_BBCONFIG['CodeBorderColor'] = '#BDBEBD';

function BBCODE($string){
	global $_BBCONFIG;
	$string = nl2br($string);
	$patterns = array(
		'`\[b\](.+?)\[/b\]`is',
		'`\[i\](.+?)\[/i\]`is',
		'`\[u\](.+?)\[/u\]`is',
		'`\[strike\](.+?)\[/strike\]`is',
		'`\[color=#([0-9A-F]{6})\](.+?)\[/color\]`is',
		'`\[email\](.+?)\[/email\]`is',
		'`\[img\](.+?)\[/img\]`is',
		'`\[url=([a-z0-9]+://)([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\](.*?)\[/url\]`si',
		'`\[url\]([a-z0-9]+?://){1}([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)\[/url\]`si',
		'`\[url\]((www|ftp)\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\[/url\]`si',
		'`\[flash=([0-9]+),([0-9]+)\](.+?)\[/flash\]`is',
		'`\[quote\](.+?)\[/quote\]`is',
		'`\[indent](.+?)\[/indent\]`is',
		'`\[size=([1-6]+)\](.+?)\[/size\]`is',
		'`\[sup\](.+?)\[/sup\]`is',
		'`\[sub\](.+?)\[/sub\]`is',
		'`\[code\](.+?)\[/code\]`is',
		'`\r\n|\r|\n`',
		'`\t`',
		'`\[img=(.+?)\]`is',
		'`\[align=(left|center|right)\](.+?)\[/align\]`is',
		'`\[glow\](.+?)\[/glow\]`is',
		'`\[shadow\](.+?)\[/shadow\]`is',
		'`\[media\](.+?)\[/media\]`is',
		'`\[movie\](.+?)\[/movie\]`is',

		'`\[center\](.+?)\[/center\]`is',
		'`\[left\](.+?)\[/left\]`is',
		'`\[right\](.+?)\[/right\]`is',
		'`\[\-\-\-\]`is',
			);

	$replaces =  array(
			'<strong>\\1</strong>',
			'<em>\\1</em>',
			'<span style="border-bottom: 1px dotted">\\1</span>',
			'<strike>\\1</strike>',
			'<span style="color:#\1;">\2</span>',
			'<a href="mailto:\1">\1</a>',
			'<img src="\1" alt="" style="border:0px;" />',
			'<a href="\1\2">\6</a>',
			'<a href="\1\2">\1\2</a>',
			'<a href="http://\1">\1</a>',
			'<object width="\1" height="\2"><param name="movie" value="\3" /><embed src="\3" width="\1" height="\2"></embed></object>',
			'<strong>'._WEBBOARD_READ_QOUTE.' :</strong><div style="margin:0px 10px;padding:5px;background-color:'.$_BBCONFIG["QuotedBgColor"].';border:1px dotted '.$_BBCONFIG["QuotedBorderColor"].';width:100%;"><em>\1</em></div>',
			'<pre>\\1</pre>',
			'<h\1 style="display:inline">\2</h\1>',
			'<sup>\\1</sup>',
			'<sub>\\1</sub>',
			'<strong style="color:green;font-family:courier new,monospace;font-size:8pt;">Code:</strong><pre style="margin:0px 10px;padding:5px;background-color:'.$_BBCONFIG["CodeBgColor"].';border:1px solid '.$_BBCONFIG["CodeBorderColor"].';width:100%;font-size:10pt;font-family:courier new,monospace;">\1</pre>',
			'',
			'&nbsp;&nbsp;',
			'<img src="\1" alt="" style="border:0px;" />',
			'<div align="\1">\2</div>',
				'<table style=filter:glow(color=#00FF00, strength=3)>\\1</table>',
			'<table style=\"filter:shadow(color=pink, direction=left)\">\\1</table>',
			'<embed src=\\1  TYPE=\"application/x-mplayer2\" align=\"middle\" width=\"200\" height=\"42\" autostart=\"1\" autoplay=\"true\" dhtype=\"wma\">',
			'<object classid=\"CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6\" type=\"application/x-oleobject\" width=\"262\" height=\"260\" id=\"MediaPlayer1\">\n<param name=\"URL\" value=\\1  >\n<PARAM NAME=ShowControls VALUE=true>\n<PARAM NAME=ShowStatusBar VALUE=false>\n<PARAM NAME=Autostart VALUE=true>\n<PARAM NAME=ShowPositionControls value=true>\n<PARAM NAME=ShowTracker value=true>\n</object>',
			'<div align=center>\\1</div>',
			'<div align=left>\\1</div>',
			'<div align=right>\\1</div>',
			'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
			);
	$string = preg_replace($patterns, $replaces , $string);
	return stripslashes($string);
}

#   [b]bold[/b]                                                                                         : BOLD TEXT
#   [i]Italic[/i]                                                                                  : ITALIC TEXT
#   [u]Underline[/u]                                                                                : UNDERLINED TEXT
#   [strike]Text[/strike]                                                                        : STRIKE THROUGH TEXT
#   [color=#ffffff]Colored Text[/color]                                          : COLORED TEXT
#   [email]me@email.com[/email]                                                            : EMAIL LINK
#   [img]http://www.blah.com/img.gif[/img]                                    : IMAGE
#   [url=http://www.domain.com]Text[/url]                                        : HYPERLINKED TEXT OR IMAGE
#   [url]http://www.url.com[/url]                                                        : HYPERLINK
#   [url]www.yourdomain.com[/url]                                              : HYPERLINK WWW
#   [flash=width,height]http://blah.com/flash.swf[/flash]        : FLASH MOVIE
#   [quote]Text![/quote]                                                                        : QUOTE    
#   [indent]Text[/indent]                                                                        : PREFORMATTED TEXT
#   [size=1-6]Text[/size]                                                                        : TEXT HEADINGS
#   [sup]superscription[/sup]
#   [sub]subscription[/sub]
#   [code]program code[/code]
#   [img=http://www.blah.com/img.gif]
#   [align=left,center,right]Alignment[/align]
function sendmail_welcome($member_id ,$name, $user_name , $pwd_name1, $email ,$home) {
                 ## ข้อความในการส่งเมล์เมื่อมีผู้สมัครสมาชิก ##
                ##( หากกด Enter เว้นบรรทัด ข้อความของคุณก็จะเว้นบรรทัดด้วย) ##
global $admin_email ;
$subject_mail = _MAIL_WELCOME; // หัวข้ออีเมล์ 

//----------------------------------------------------------------------- เนื้อหาของอีเมล์ //
$message_mail =_MAIL_WELCOME1." $name" ;
$message_mail .=_MAIL_WELCOME4." $member_id" ;
$message_mail .=_MAIL_WELCOME5 ;
$message_mail .=_MAIL_WELCOME6." $user_name" ;
$message_mail .=_MAIL_WELCOME7." $pwd_name1" ;
$message_mail .=_MAIL_WELCOME8 ;
$message_mail .=_MAIL_WELCOME9."  $home";
//------------------------------------------------------------------------ จบเนื้อหาของอีเมล์ //

$from = "From:\"$admin_email\"<$admin_email>\r\n" ;
if(mail($email,$subject_mail,$message_mail,$from)) {
echo "<br><br><center><font size='3' face='MS Sans Serif'><b>" ;
echo ""._MAIL_WELCOME2."</b></font></center>" ;
}
else {
echo _MAIL_WELCOME;
}
}

function sendmailnewx($member_id ,$name, $user_name , $pwd_name1, $email ,$home) {
//global $admin_email ;
$admin_mail="".WEB_EMAIL."";
$Headers = "MIME-Version: 1.0\r\n" ;
$Headers .= "Content-type: text/html; charset=".ISO."\r\n" ;
                          // ส่งข้อความเป็นภาษาไทย ใช้ "windows-874"
$Headers .= "From: ".WEB_EMAIL." <".WEB_EMAIL.">\r\n" ;
$Headers .= "Reply-to: ".WEB_EMAIL." <".WEB_EMAIL.">\r\n" ;
$Headers .= "X-Priority: 3\r\n" ;
$Headers .= "X-Mailer: PHP mailer\r\n" ;

$subject_mail = _MAILNEW_TOPIC ; // หัวข้ออีเมล์ 

//----------------------------------------------------------------------- เนื้อหาของอีเมล์ //
$message_mail = "
<html>
<title>Email for new User</title>
<body>
<table>
<tr><td><br>"._MAILNEW_DETAIL1." $name</td></tr>
<tr><td><br>"._MAILNEW_DETAIL2."</td></tr>
<tr><td><br>"._MAILNEW_DETAIL3." $member_id</td></tr>
<tr><td><br>"._MAILNEW_DETAIL4."</td></tr>
<tr><td><br>"._MAILNEW_DETAIL5." $user_name</td></tr>
<tr><td><br>"._MAILNEW_DETAIL6." $pwd_name1</td></tr>
<tr><td><br>"._MAILNEW_DETAIL7."</td></tr>
<tr><td><br>"._MAILNEW_DETAIL8." $home</td></tr>
</table>
</body>
</html>
" ;
//------------------------------------------------------------------------ จบเนื้อหาของอีเมล์ //
$from = "From:\"".WEB_EMAIL."\"<".WEB_EMAIL.">" ;
if(@mail($email,$subject_mail,$message_mail,$Headers,$from))
{
echo "<br><br><center><font size='3' face='MS Sans Serif'><b>" ;
echo ""._MAIL_WELCOME2."" ;
}else{
echo _MAIL_WELCOME;
}

}

function unzip(){
    global $instdir;
    global $zip_file;

    $dir = $instdir;

    $zip_file_full=$dir.$zip_file;

    $zip = zip_open($zip_file_full);

    if ($zip) {
           while ($zip_entry = zip_read($zip)) {
               $dirname=dirname(zip_entry_name($zip_entry));

            $val=$dir.$dirname;

            if (($dirname!=".") && (!is_dir($val))) {
                mkdir($val);
            }

               $file = zip_entry_name($zip_entry);

                   if (zip_entry_open($zip, $zip_entry, "r")) {

                $size = zip_entry_filesize($zip_entry);
                if ($size==0) continue;

                   $fp = fopen($dir.$file, "w+");

                       $buf = zip_entry_read($zip_entry, $size);

                     fwrite($fp, $buf);
                fclose($fp);

                       zip_entry_close($zip_entry);
                   }
           }
           zip_close($zip);
        return true;
    }
    return false;
}



function writableCell( $folder ) {
	echo '<tr>';
	echo '<td class="item">' . $folder . '/</td>';
	echo '<td align="left">';
	echo is_writable( "../$folder" ) ? '<strong><font color="green">' . _INSTALL_WRITABLE . '</font></strong>' : '<strong><font color="red">' . _INSTALL_UNWRITABLE . '</font></strong>' . '</td>';
	echo '</tr>';
}

function checkPostTimePast($timeStamp)

    {
        $dayArray    =    array(
                                    0    =>    _BOT_TODAY,
                                    1    =>   _TIME_POST_YES
                                    );
        
        $datePost     =     time() - $timeStamp;
        
        $datePast    =    $datePost / 86400;
        
        list ( $number1, $number2)    =    explode(".", $datePast);
        
        if ( $number1 < 30)
        {
        
            foreach ( $dayArray as $f => $d)
            {
                if ( $f == $number1 )
                
                return $d;
            }
            
            return ""._TIME_POST." " . $number1 . " "._TIME_POST_YES1."";    
        
        }
        
        return ""._TIME_POST." " . round($number1 / 30) . " "._TIME_POST_MONTH."";
        
    }

//ตรวจสอบชนิดไฟล์อัพโหลด

//แปลง ip ให้เป็น xxx.xxx
// $ip1 = '127.0.0.1';
//     $ip2 = '111.222.11.33';
     
     // แบบที่ 1 ใช้ explode
//     list($a, $b, $c, $d) = explode('.', $ip1); // แยก IP ออกเป็นตำแหน่งต่างๆ
//     echo "$a.$b.xxx.xxx"; // ผลลัพท์สามารถเลือกได้ว่าจะบล๊อกตำแหน่งไหนบ้าง
     
 //    echo '<br />';
     
     // แบบที่ 2 ใช้ preg_replace แบ่งออกเป็น 2 กลุ่มโดยแทนที่กลุ่มหลังด้วย xxx.xxx
 //    echo preg_replace('/([0-9]+\.[0-9]+)\.[0-9]+\.[0-9]+/', '\1<span style="color:red">.xxx.xxx</span>', $ip2);
      
      // แบบที่ 3 ใช้ preg_replace แทนที่รายการที่ block ทีละตัวตามตำแหน่งของมัน
  //    function bockipstr( $ip ) {
  //        preg_match('/([0-9]+\.[0-9]+\.)([0-9\.]+)/', $ip, $ips); // แยกออกเป็น 2 กลุ่ม คือ 2 หลักหน้า และ 2 หลักหลัง
   //       return  $ips[1].preg_replace('/[0-9]/','<span style="color:red">x</span>',$ips[2]); // แทนที่ตัวเลขหลักหลังด้วย x ทีละตัว
  //    }
      
 //     echo '<br />';
  //    echo "$ip1 = ".bockipstr($ip1);
  //    echo '<br />';
  //    echo "$ip2 = ".bockipstr($ip2);
function remove_directory($dir) {
  if ($handle = opendir("$dir")) {
    while (false !== ($item = readdir($handle))) {
      if ($item != "." && $item != "..") {
        if (is_dir("$dir/$item")) {
          remove_directory("$dir/$item");
        } else {
          unlink("$dir/$item");
    //      echo " removing $dir/$item<br>\n";
        }
      }
    }
    closedir($handle);
    rmdir($dir);
//    echo "removing $dir<br>\n";
  }



function upimg($img,$imglocate){
			if($img['name']!=''){
			$fileupload1=$img['tmp_name'];
			$g_img=explode(".",$img['name']);
			$file_up=TIMESTAMP.".".$g_img[1];  // เปลี่ยนชื่อไฟล์ไหม่ เป็นตัวเลข
				if($fileupload1){
					$array_last=explode(".",$file_up);
					$c=count($array_last)-1;
					$lastname=strtolower($array_last[$c]);
						@copy($fileupload1,$imglocate.$file_up);			
						
				}				
			}
			return $file_up; // ส่งกลับชื่อไฟล์
}


}
?>