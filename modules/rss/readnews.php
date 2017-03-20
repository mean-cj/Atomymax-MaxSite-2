<meta http-equiv="Content-Type" content="text/html; charset=<?=$iso;?>">
<?
//header("content-type: application/x-javascript; charset=tis-620");
$file=("news.xml"); // ใส่ url ของเวปที่ท่านต้องการดึงข่าวมาครับ
//$file=iconv("UTF-8","TIS-620",$file);
$rss=array();
$tag="";
$main="";
$count=0;
function startElement($parser,$name,$attrs){
global $rss,$tag,$main;
switch ($name){
case "RSS" :
case "CHANNEL" :
$main="CHANNEL";
break;
case "ITEM" :
$main="ITEM";
break;
case "IMAGE" :
$main="IMAGE";
break;
default :
$tag=$name;
break;
}
}
function characterData($parser,$data){
global $rss,$tag,$main,$count;
if ($tag!=""){
switch ($main){
case "CHANNEL" :
$rss[$tag]=$data;
break;
case "IMAGE" :
$rss[$main][$tag].=$data;
break;
case "ITEM" :
$rss[$main][$count][$tag].=$data;
break;
}
}
}
function endElement($parser,$name){
global $rss,$tag,$count,$main;
$tag="";
switch ($name){
case "ITEM" :
$count++;
break;
case "IMAGE" :
$main="CHANNEL";
break;
}
}
$xml_parser=xml_parser_create();
xml_set_element_handler($xml_parser,"startElement","endElement");
xml_set_character_data_handler($xml_parser,"characterData");
if (!($fp=fopen($file,"r"))){
die("Cound not open XML input");
}
while ($data=fread($fp,4096)){
if (!xml_parse($xml_parser,$data,feof($fp))){
die(sprintf("XML error : %s at line %d",xml_error_string(xml_get_error_code($xml_parser)),xml_get_current_line_number($xml_parser)));
}
}
xml_parser_free($xml_parser);
echo "<table width=100% border=0 cellpadding=0 cellspacing=0><tr><td>";
$title=$rss["TITLE"];
$link=$rss["LINK"];
$description=$rss["DESCRIPTION"];
$lastBuildDate=$rss["LASTBUILDDATE"];
echo "<h2><a href='$link' target='_blank'>$title</a></h2> $description ($lastBuildDate)";

$image_url=$rss["IMAGE"]["URL"];
$image_title=$rss["IMAGE"]["TITLE"];
$image_link=$rss["IMAGE"]["LINK"];
if ($image_url!=""){
echo "<a href='$link' target='_blank'><img src='$image_url' alt='$title' border=0></a>";
}
echo "</td></tr>";
for ($i=0;$i<count($rss["ITEM"]);$i++){
$title=$rss["ITEM"][$i]["TITLE"];
$link=$rss["ITEM"][$i]["LINK"];
$description=$rss["ITEM"][$i]["DESCRIPTION"];
$pubDate=$rss["ITEM"][$i]["PUBDATE"];
$pics=$rss["ITEM"][$i]["PIC"];
echo "<tr><td>";
echo "<img src=images/go.gif>";
echo "<a href='$link' target='_blank'>$title</a></td></tr>";
echo "<tr><td valign=top>";
if ($pics !=""){echo "<a href='$link' target='_blank'><img src='$pics' border=0 align=left></a>";}
if ($description!=""){echo "$description<br>";}
if ($pubDate!=""){echo "<font size='2'>$pubDate</font>";}
echo "</td></tr>";
}
echo "</table>";
?>
