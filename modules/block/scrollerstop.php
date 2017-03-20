<table width="<?=$widthSUM;?>" border="0" cellpadding="0" cellspacing="0" height="130">
<tr>
<td align="center" height="130">
<?php

echo "<link href='css/Scroller_Stop.css' rel='stylesheet' type='text/css' />";
echo "<script language='JavaScript' type='text/javascript' src='js/Scroller_Stop.js'></script>";
echo "<body onload=\"init()\">";

echo "<div id=\"scroller\">";
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['gallerys'] = $db->select_query("SELECT * FROM ".TB_GALLERY." ORDER BY id DESC LIMIT 8");
$i=1;
while($arr['gallerys'] = $db->fetch($res['gallerys'])){
$res['cat'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT."  WHERE id='".$arr['gallerys']['category']."' ");
$arr['cat'] = $db->fetch($res['cat']);
$CAT=$arr['cat']['post_date'];

if ($i==3){
echo "<div id=\"nextitem\" style=\"display: none\"><div class=\"sci\">";
} else if($i==2){
echo "<div class=\"scidis\">";
} else {
echo "<div class=\"sci\">";
}
echo "<table width=\"100%\" onclick=\"_go('index.php?name=gallery&file=readgal&id=".$arr['gallerys']['id']."')\"><tr><td align=\"center\">";
//echo "".NewsIcon(TIMESTAMP, $arr['gallerys']['post_date'], "images/icon_new.gif")."";
$s=$widthSUM-2;
echo "<img  border=0 src=\"images/gallery/gal_".$CAT."/thb_".$arr['gallerys']['pic']."\" width=".$s."></td></tr><tr><td style=\"padding: 2px 10px 5px 12px;\" valign=\"top\">";
echo "<center><b>".$arr['gallerys']['pic']."<br></center>&nbsp;</b></td></tr></table>";
if($i==2){
echo "</div></div>";
} else if ($i==8){
echo "</div></div>";
} else {
echo "</div>";
}
$i++;
}

?>

</body>
</td>
</tr>
</table>