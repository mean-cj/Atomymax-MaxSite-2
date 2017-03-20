<meta http-equiv="Content-Type" content="text/html; charset=<?echo ISO;?>">
<?
$summ=$widthSUMC-10;
?>
										<table cellpadding='5' cellspacing='0' <?=$summ;?>>
										<tbody>
										<tr>
										<td >


<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 10;
// แสดงผลของรายการทั้งหมด
$result = $db->select_query("select * from ".TB_ALUMNUS." order by id DESC LIMIT $limit"); 
$NRow = $db->num_rows(TB_ALUMNUS,"id","");
	if($NRow==0) { 
		echo "<center>";
		echo "<br><br>";
		echo "<font size=2 face='MS Sans Serif'>"._ALUM_NULL."</font><br><br><br>\n";
		echo "<center>";
	} else {

		echo "<br><table width=$summ border=0 cellspacing=0 cellpadding=0 class=grids>";
		echo "<tr class=odd>
		<td width=40 bgcolor=#CCE9FD ><div align=center><b>"._ALUM_TABLE_COL1."</td>
		<td width=170 bgcolor=#CCE9FD ><div align=center><b>"._ALUM_TABLE_COL2."</b></div></td>
		<td width=40 bgcolor=#CCE9FD ><div align=center><b>"._ALUM_TABLE_COL3."</b></div></td>
		<td width=40 bgcolor=#CCE9FD ><div align=center><b>"._ALUM_TABLE_COL4."</b></div></td>
		<td width=70 bgcolor=#CCE9FD ><div align=center><b>"._ALUM_TABLE_COL5."</b></div></td>
		<td width=60 bgcolor=#CCE9FD ><div align=center><b>"._ALUM_TABLE_COL6."</b></div></td>";

$i=0;
$count=0;
while( $arr =  $db->sql_fetchrow($result) )
		{		
 // กำหนดสีของตาราง
 // กำหนดสีของตาราง
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
//		$bgc = ($bgc==$rowColor1) ? $rowColor2 : $rowColor1; 
echo "<tr ".$ColorFill.">";
		// กำหนดตัวแปล
		// For Admin Delete
		// เพศ
		if ($arr[7]=="1") {
			$sex = "<img src='modules/alumnus/img/male.gif' alt="._ALUM_SEX1.">";
			}
		elseif ($arr[7]=="2") {
			$sex = "<img src='modules/alumnus/img/female.gif' alt="._ALUM_SEX2.">";
			}
		elseif ($arr[7]=="3") {
			$sex = "<img src='modules/alumnus/img/notsoure.gif' alt="._ALUM_SEX3.">";
			}
		else {};

		// กำหนดตัวแปล MSN
		if ($arr[23]== "0") {
			$msn = "";
			}
		else {
			$msn = "<a 
 href=javascript:copyOnline('$arr[23]')><img src='modules/alumnus/img/msn.gif' border=0 alt='"._ALUM_CLICK_MSN."'></a>";
			};

		// กำหนดตัวแปล ICQ
		if ($arr[22]== "0") {
			$icq = "";
			}
		else {
			$icq = "&nbsp;<a 
 href=javascript:copyOnline('$arr[22]')><img src='modules/alumnus/img/icq.gif' border=0 alt='"._ALUM_CLICK_ICQ."'></a>";
			};

		// กำหนดตัวแปล YAHOO
		if ($arr[24]== "0") {
			$yahoo = "";
			}
		else {
			$yahoo = "&nbsp;<a 
 href=javascript:copyOnline('$arr[24]')><img src='modules/alumnus/img/yahoo.gif' border=0 alt='"._ALUM_CLICK_YAHOO."'></a>";
			};

		// กำหนดตัวแปล QQ
		if ($arr[25]== "0") {
			$qq = "";
			}
		else {
			$qq = "&nbsp;<a 
 href=javascript:copyOnline('$arr[25]')><img src='modules/alumnus/img/qq.gif' border=0 alt='"._ALUM_CLICK_QQ."'></a>";
			};


//		echo "		<td bgcolor=$bgc align=center vAlign=top >$msn$icq$yahoo$qq</td>		<td bgcolor=$bgc align=left vAlign=top >";
		echo "		<td  align=center vAlign=top >";
		if ($arr[8]=="" ) { echo "<img src=modules/alumnus/avartar/$arr[21] width=30 hieght=30 class=highslide >"; } else { echo "<A HREF=icon/$arr[8] width=30 hieght=30 class=\"highslide\" onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )\" ><img src=icon/$arr[8] width=20 hieght=20 ></a>"; } 
		echo "</td><td  align=left vAlign=top >";
		?>
		<A HREF="popup.php?name=alumnus&file=view&id=<?=$arr[0];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 520, objectHeight: 480} )" class="highslide">
		<?
		echo "$arr[2]  $arr[3] [$arr[4]]</a></td>
		<td align=center vAlign=top >$sex</td>
		<td align=center vAlign=top >$arr[11]</td>
		<td align=center vAlign=top >$arr[30]</td>
		<td align=center  vAlign=top>";
		if ($arr[17] !='' && $arr[18] =='') { echo "<font color=#00CC00>"._ALUM_STATUS_EDU1."</font>"; } else if ($arr[17] =='' && $arr[18] !='' ) {echo "<font color=#6633FF>"._ALUM_STATUS_EDU2."</font>";} else { echo "<font color=#CC0000>"._ALUM_STATUS_EDU3."</font>";}
		echo "</td></tr>";

		$i++;
$count++;
		}
}

// แสดงหน้า link ไปยังหน้าอื่นๆ
echo "<table width=$summ border='0' cellspacing='0' cellpadding='0' class=grids><tr  class=odd>";
echo "<br>";
echo "<td width=$summ  align=right><a href=index.php?name=alumnus><font color=#990000 size=2>["._ALUM_LINK_ALL."]&nbsp;</a><a href=index.php?name=alumnus&file=add><font color=#990000 size=2>["._ALUM_LINK_ADD."] </font></a></strong>";
echo "</td></tr></table>";

?>
										</td>
										</tr>
								</table>


