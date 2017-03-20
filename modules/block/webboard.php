	<?
	//แสดงข่าวสาร
	?>


<center><TABLE cellSpacing=0 cellPadding=5 width="<?=$widthSUMC;?>" border=0>
      <TBODY>
        <TR>
          <TD width="<?=$widthSUMC;?>" vAlign=top align="center"> 
<?

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['BoardCat'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." ORDER BY sort ");
while($arr['BoardCat'] = $db->fetch($res['BoardCat'])){
//	echo "<TABLE width=95% align=center border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><TR><TD><LI><B><A HREF=\"?name=webboard&category=".$arr['BoardCat']['id']."\">".$arr['BoardCat']['category_name']."</A></B></TD>";
	//Sum Album
//	$SumCat = $db->num_rows(TB_WEBBOARD,"id"," category='".$arr['BoardCat']['id']."' "); 
//	echo "<TD width=\"100\" align=right><FONT COLOR=\"#808080\">".number_format($SumCat)."</FONT>&nbsp;&nbsp;</TD></TR></TABLE>";
//	echo "<TABLE width=95% align=center><TR><TD height=1 class=\"dotline\"></TD></TR></TABLE>\n";
}


	$CatShow = _WEBBOARD_LISTALL;
	$SQLwhere = " pin_date ='' ";
	$SQLwhere2 = " WHERE pin_date ='' ";
	$SQLwherePin = " WHERE pin_date !='' ";

?>
<BR>
<div align="right"><B><IMG SRC="images/icon/icon_folder.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=webboard"><?=_WEBBOARD_LISTALL;?></A> &nbsp;&nbsp;&nbsp; <IMG SRC="images/icon/icon_add.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=webboard&file=post_cat"><?=_WEBBOARD_ADD_NEW;?></A></B>&nbsp;&nbsp;</div>
<BR>


<table width="100%"  align="center" border="0" cellspacing="0" cellpadding="0" class="grids">
<tr class="odd">
	<td  width="60%"><CENTER><B><?=_WEBBOARD_TABLE_TOPIC;?></B></CENTER></td>
	<td width="15%"><CENTER><B><?=_DOWNLOAD_AUTH;?></B></CENTER></td>
	<td width="25%"><CENTER><B><?=_WEBBOARD_TABLE_DATE;?></B></CENTER></td>
</tr>

<?
//แสดงกระทู้ปักหมุด
$res['Pin'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD." $SQLwherePin ORDER BY pin_date desc  LIMIT "._SHOW_BOARD_PIN." ");

while($arr['Pin'] = $db->fetch($res['Pin'])){
			if($arr['Pin']['picture']!=''){
		$PicIcon = " <A HREF=webboard_upload/".$arr['Pin']['picture']." class=\"highslide\" onclick=\"return hs.expand(this)\"><IMG SRC=\"images/preview.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_PIC."\"></a>";
	}else{
		$PicIcon = "";
	}
	if($arr['Pin']['att'] !=''){
		$AttIcon = " <a href=webboard_upload/".$arr['Pin']['att']."><IMG SRC=\"images/attach.gif\" WIDTH=\"8\" HEIGHT=\"13\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_FILE."\"></a>";
	}else{
		$AttIcon = "";
	}

	$SumComm = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id='".$arr['Pin']['id']."' "); 
	echo "<tr height=\"20\" bgcolor=#FFFFCC><td  align=\"left\">";
	if($arr['Pin']['pageview']>45){ echo"<img src='images/icon/topichot.gif' border='0' hspace='5' ALIGN=\"absmiddle\">";}else{echo"<IMG SRC=\"images/icon/dock.gif\" BORDER=\"0\"  hspace='5' ALIGN=\"absmiddle\">";}
  echo "<B>".sprintf("%0"._NUM_ID."d",$arr['Pin']['id'])." : </B> <A HREF=\"?name=webboard&file=read&id=".$arr['Pin']['id']."\" target=\"_blank\">".$arr['Pin']['topic']."</A> ".$PicIcon."&nbsp;".$AttIcon."";

	//กรณีกระทู้ใหม่ 
		$Comm = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where  topic_id='".$arr['Pin']['id']."' ORDER BY id DESC");
	$Comms = $db->fetch($Comm);
	if($Comms['id']){
	UpdateIcon(TIMESTAMP, $Comms['post_date'], "images/icon/update.gif");
	}else{
	NewsIcon(TIMESTAMP, $arr['Pin']['post_date'], "images/icon_new.gif");
	 };
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($arr['Pin']['pageview'])."/".number_format($SumComm).")</FONT></td>\n";
	echo "<td  width=\"120\"><CENTER><B><FONT COLOR=\"#6600FF\">";
	//กรณีสมาชิก
	if($arr['Pin']['is_member']){
		echo "<IMG SRC=\"images/human.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> <B><FONT COLOR=\"#FF0066\">";
	}else{ };
	echo "".$arr['Pin']['post_name']."</FONT></B></CENTER></td>\n";
	echo "<td  width=\"120\" ><CENTER><FONT COLOR=\"#339900\">".ThaiTimeConvert($arr['Pin']['post_date'],"","2")."</FONT></CENTER></td></tr>";

}


//แสดงผลกระทู้ 
$limit = 10;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$BoardResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD." $SQLwhere2 ORDER BY post_update DESC,post_date DESC,id DESC  LIMIT $limit ");
$count=0;
while($WebBoard = $db->fetch($BoardResult)){
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
	if($WebBoard['picture']!=''){
		$PicIcon = " <A HREF=webboard_upload/".$WebBoard['picture']." class=\"highslide\" onclick=\"return hs.expand(this)\"><IMG SRC=\"images/preview.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_PIC."\"></a>";
	}else{
		$PicIcon = "";
	}
	if($WebBoard['att'] !=''){
		$AttIcon = " <a href=webboard_upload/".$WebBoard['att']."><IMG SRC=\"images/attach.gif\" WIDTH=\"8\" HEIGHT=\"13\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_FILE."\"></a>";
	}else{
		$AttIcon = "";
	}
	//Sum comment
	$SumComm = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id='".$WebBoard['id']."' "); 
	echo "<tr ".$ColorFill."><td  align=left>";
		if($WebBoard['pageview']>45){ echo"<img src='images/icon/topichot.gif' border='0' hspace='5' ALIGN=\"absmiddle\">";}else{echo"<IMG SRC=\"images/icon/dok.gif\" BORDER=\"0\"  hspace='5' ALIGN=\"absmiddle\">";}
	echo "<B>".sprintf("%0"._NUM_ID."d",$WebBoard['id'])." : </B> <A HREF=\"?name=webboard&file=read&id=".$WebBoard['id']."\" target=\"_blank\">".$WebBoard['topic']."</A> ".$PicIcon."&nbsp;".$AttIcon."";

	//กรณีกระทู้ใหม่ 
	$Comm = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where topic_id='".$WebBoard['id']."' ORDER BY id DESC  LIMIT $limit ");
	$Comms = $db->fetch($Comm);
	if($Comms['id']){
	UpdateIcon(TIMESTAMP, $Comms['post_date'], "images/icon/update.gif");
	}else{
	NewsIcon(TIMESTAMP, $WebBoard['post_date'], "images/icon_new.gif");
	 };
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($WebBoard['pageview'])."/".number_format($SumComm).")</FONT></td>\n";
	echo "<td width=\"120\"><CENTER><B><FONT COLOR=\"#6600FF\">";
	//กรณีสมาชิก
	if($WebBoard['is_member']){
		echo "<IMG SRC=\"images/human.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> <B><FONT COLOR=\"#FF0066\">";
	}else{ };

	$postTimePast = checkPostTimePast($WebBoard['post_date']);
//	echo "".$WebBoard['post_name']."</FONT><br><FONT COLOR=\"#CC0066\">".$postTimePast."</FONT></B></CENTER></td>\n";
	echo "".$WebBoard['post_name']."</FONT></B></CENTER></td>\n";
	echo "<td width=\"120\"><CENTER><FONT COLOR=\"#339900\">".ThaiTimeConvert($WebBoard['post_date'],"","2")."</FONT></CENTER></td></tr>";

$count++;
}
@mysql_free_result($BoardResult);

echo "</table>";

?>
				<BR>

		  </td>
        </TR>
      </TBODY>
    </TABLE>



