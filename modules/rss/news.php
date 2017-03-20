<?
  include_once("../../mainfile.php"); //โหลด settings
  include_once("../../includes/function.in.php"); //โหลด ฟังก์ชั่น
  include_once("../../includes/class.mysql.php"); //เรียกใช้ คลาส text database

$data ='<?xml version="1.0" encoding="TIS-620"?>'."\n";
$data .='<rss version="2.0">'."\n";
$data .='<channel>'."\n";

$data .='<title>'.WEB_TITILE.'</title>'."\n";
$data .='<description>News</description>'."\n";
$data .='<link>'.WEB_URL.'</link>'."\n";
$data .='<lastBuildDate>'.date("D, d M Y H:i:s").'</lastBuildDate>'."\n";

if ($_GET[id]){
$id=$_GET[id];
} else {
$id=2;
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$listof= $db->select_query("SELECT * FROM ".TB_NEWS." where category=$id ORDER BY id desc limit 10");

while($result = $db->fetch($listof)) {
$data .='<item>'."\n"; 
$data .='<title>'.$result[topic].'</title>'."\n"; 
$data .='<link>'.WEB_URL.'/?name=news&amp;file=readnews&amp;id='.$result[id].'</link>'."\n"; 
$data .='<description>'.$result[headline].'</description>'."\n";
$data .='<pubDate>'.$result[post_date].'</pubDate>'."\n";
$data .='</item>'."\n"; 
}

$data .='</channel>'."\n";
$data .='</rss>'."\n";

$f = fopen( 'news.xml' , 'w' ); // 2 อ่านหมายเหตุของบรรทัดนี้ด้านล่าง
fputs( $f , $data );
fclose( $f );


?>