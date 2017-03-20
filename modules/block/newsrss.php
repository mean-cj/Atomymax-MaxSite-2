<meta http-equiv="Content-Type" content="text/html; charset=<?php echo ISO;?>">
	<center>
										<table class='iconframe' cellpadding='0' cellspacing='0'>
										<tbody>
										<tr>
										<td class='imageframe'>
  													<TABLE width="<?=$widthSUMC;?>" align=center cellSpacing=0 cellPadding=0 border=0>
													<tr>
													<td>
  <?
  //header("content-type: application/x-javascript; charset=utf-8");
//  include ("http://maxtom.sytes.net/modules/rss/readnews.php");
 //   include iconv("UTF-8","TIS-620","http://maxtom.sytes.net/modules/rss/readnews.php");
ini_set('allow_url_fopen','On'); 
ini_set('allow_url_include','On'); 

$site="".WEB_URL."";


$xml5=file("".$site."/modules/rss/news.xml"); // กำหนด url ของ rss ไฟล์ที่ต้องการ
$xmlDATA=""; // สรัางตัวแปรสำหรับเก็บค่า xml ทั้งหมด
foreach($xml5 as $key=>$value){
	$xmlDATA.=$value;
}
$data1=explode("<item>",$xmlDATA);
$iTitle=array(); 			// ตัวแปร Array สำหรับเก็บหัวข้อข่าว
$iLink=array(); 			// ตัวแปร Array สำหรับเก็บลิ้งค์
$iPic=array(); 	// ตัวแปร Array รูปภาพ
$iDesc=array(); 			// ตัวแปร Array สำหรับเก็บรายละเอียดแบบย่อ
$ipubDate=array(); 	// ตัวแปร Array สำหรับเก็บวันที่
echo "<table width=100% border=0 cellpadding=0 cellspacing=0>";
$Color == 0;
foreach ($data1 as $key=>$value){ // วนลูป เพื่อเก็บค่าต่างๆ ไว้ในตัวแปรด้านบนที่กำหนด
//
	if($key>0){
echo "<TR>"; 
		if($Color == 0){
		$Color = 1 ;
		$ColorFill = "#F0F0F0";
	}else{
		$Color = 0 ;
		$ColorFill = "#FDEAFB";
	}
		$value=str_replace("</item>","",$value);
		$iTitle[$key]=strip_tags(substr($value,strpos($value,"<title>"),strpos($value,"</title>")));
		$iLink[$key]=strip_tags(substr($value,strpos($value,"<link>"),strpos($value,"</link>")-strpos($value,"<link>")));
		$iPic[$key]=strip_tags(substr($value,strpos($value,"<pic>"),strpos($value,"</pic>")-strpos($value,"<pic>")));
		$iDesc[$key]=strip_tags(substr($value,strpos($value,"<description>"),strpos($value,"</description>")-strpos($value,"<description>")));
		$ipubDate[$key]=strip_tags(substr($value,strpos($value,"<pubDate>"),strpos($value,"</pubDate>")-strpos($value,"<pubDate>")));
		//แสดงข้อมูล
		$timesdate=ThaiTimeConvert($ipubDate[$key],"","");
//		echo "<tr><td><img src=images/go.gif><a href='".$iLink[$key]."' target='_blank' /><img src='".$iPic[$key]."' border=0 align=left><b>".$iTitle[$key]."</b></a><br>".$iDesc[$key]." ";
//		echo " ".NewsIcon(TIMESTAMP, $ipubDate[$key], "images/icon_new.gif")."";
//		echo "(".$timesdate.")</td></tr>";
		
		echo "<td bgcolor=$ColorFill><img src=images/17.png><a href='".$iLink[$key]."' target='_blank' /><b>  ".$iTitle[$key]."</b></a>";
		echo " ".NewsIcon(TIMESTAMP, $ipubDate[$key], "images/icon_new.gif")."";
		echo "(".$timesdate.")</td></tr>";
echo "</Tr><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>";
		}
}
echo "<TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>";
echo "</table>";
?>
													<td>
													</tr>
													<tr>
													<td colspan="2" align="right"><A HREF="<?echo $site;?>index.php?name=news&category=2" ><img src="images/admin/2_15.gif"></a></td>
													</tr>
													</table>
											</td>
											</tr>
											</table>


