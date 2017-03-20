<SCRIPT src="modules/alumnus/function.js"></SCRIPT>
<script language="javascript"> 
<!-- 
var state = 'none'; 

function showhide(layer_ref) { 

if (state == 'block') { 
state = 'none'; 
} 
else { 
state = 'block'; 
} 
if (document.all) { //IS IE 4 or 5 (or 6 beta) 
eval( "document.all." + layer_ref + ".style.display = state"); 
} 
if (document.layers) { //IS NETSCAPE 4 or below 
document.layers[layer_ref].display = state; 
} 
if (document.getElementById &&!document.all) { 
hza = document.getElementById(layer_ref); 
hza.style.display = state; 
} 
} 
//--> 
</script> 
 <table width="750" align=center cellSpacing=0 cellPadding=0 border=0><tr><TD ><IMG SRC="images/menu/textmenu_alumnus.png" BORDER="0"></TD></tr>
 <tr><TD height="1" class="dotline" colspan="4"></td></tr></table>
<?
include "modules/alumnus/config.inc.php";
include "modules/alumnus/form_search.php";


if (empty($page)){
		$page=1;
	}

// เริ่มติดต่อฐานข้อมูล
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$show_sql = $db->select_query("SELECT * FROM ".TB_ALUMNUS." order by id DESC ");
$NRow = $db->num_rows(TB_ALUMNUS,"id",""); 
// แบ่งหน้าแสดง
$per_page=$list_page;
if (!$page) { 
 $page = 1; 
} 
$prev_page = $page - 1; 
$next_page = $page + 1; 
$page_start = ($per_page * $page) - $per_page; 
//$result = mysql_db_query($dbname,$sql);
$num_rows = $NRow ;
if ($num_rows<= $per_page) { 
 $num_pages = 1; 
} else if (($num_rows % $per_page) == 0) { 
 $num_pages = ($num_rows / $per_page); 
} else { 
 $num_pages = ($num_rows / $per_page) + 1; 
} 
$num_pages = (int) $num_pages; 
if (($page > $num_pages) || ($page< 0)) { 
 error("You have specified an invalid page number"); 
} 

// แสดงผลของรายการทั้งหมด
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$query = $db->select_query("SELECT * FROM ".TB_ALUMNUS." order by id DESC LIMIT $page_start, $per_page ");
$NRow = $db->num_rows(TB_ALUMNUS,"id",""); 
	if($NRow==0) { 
		echo "<center>";
		echo "<br><br>";
		echo "<font size=2 face='MS Sans Serif'>"._ALUM_NULL."</font><br><br><br>\n";
		echo "<center>";
	}

// แสดงข้อมูล
	else {

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$check_m = $db->select_query("SELECT * FROM ".TB_ALUMNUS." order by id DESC ");
$member_all  = $db->num_rows(TB_ALUMNUS,"id",""); 

echo "<center><table width=98% border=0 cellspacing=0 cellpadding=5 align=center><tr><td width=100% bgcolor=#ffffff align=center><b><font size='3' face='MS Sans Serif' color='red'>"._ALUM_MOD_DETAIL_TITLE." $member_all "._ADMIN_MEMBER_MESSAGE_MEM_ALL1."</b><font></td></tr></table></center>" ;
		echo "<br><table width=750 border=0 cellspacing=0 cellpadding=0  align=center class=grids>";
		echo "<tr class=odd>
		<td width=10% bgcolor=#CCE9FD ><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_PIC."</td><td width=5% bgcolor=#CCE9FD >&nbsp;</td>
		<td width=25% bgcolor=#CCE9FD ><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_NAME."</b></div></td>
		<td width=10% bgcolor=#CCE9FD ><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_SEX."</b></div></td>
		<td width=25% bgcolor=#CCE9FD ><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_COMMENT."</b></div></td>
		<td width=10% bgcolor=#CCE9FD ><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_YEAR."</b></div></td>
		<td width=18% bgcolor=#CCE9FD ><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_STATUS."</b></div></td><tr> ";

$i=0;
$count=0;
while( $arr = $db->sql_fetchrow( $check_m ) )
		{		
 // กำหนดสีของตาราง
 // กำหนดสีของตาราง
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
echo "<tr ".$ColorFill.">";
		// กำหนดตัวแปล
		// For Admin Delete
		if ($admin_user !='' ) {
			$del = "<a href=index.php?name=alumnus&file=delete&id=$arr[0]><img src=modules/alumnus/img/delete.gif border=0 alt="._ALUM_MOD_DETAIL_TABLE_DEL."></a>";
			} else {
			$del = "<img src=modules/alumnus/avartar/$arr[21]>";
			};

		// เพศ
		if ($arr[7]=="1") {
			$sex = "<img src='modules/alumnus/img/male.gif' alt="._ALUM_MOD_FORM_SEX_MAN.">";
			}
		elseif ($arr[7]=="2") {
			$sex = "<img src='modules/alumnus/img/female.gif' alt="._ALUM_MOD_FORM_SEX_GIRL.">";
			}
		elseif ($arr[7]=="3") {
			$sex = "<img src='modules/alumnus/img/notsoure.gif' alt="._ALUM_MOD_FORM_SEX_BI.">";
			}
		else {};

		// กำหนดตัวแปล MSN
		if ($arr[23]== "0") {
			$msn = "";
			}
		else {
			$msn = "<a 
 href=javascript:copyOnline('$arr[23]')><img src='modules/alumnus/img/msn.gif' border=0 alt='"._ALUM_MOD_DETAIL_TABLE_CLICK." Copy MSN'></a>";
			};

		// กำหนดตัวแปล ICQ
		if ($arr[22]== "0") {
			$icq = "";
			}
		else {
			$icq = "&nbsp;<a 
 href=javascript:copyOnline('$arr[22]')><img src='modules/alumnus/img/icq.gif' border=0 alt='"._ALUM_MOD_DETAIL_TABLE_CLICK." Copy ICQ'></a>";
			};

		// กำหนดตัวแปล YAHOO
		if ($arr[24]== "0") {
			$yahoo = "";
			}
		else {
			$yahoo = "&nbsp;<a 
 href=javascript:copyOnline('$arr[24]')><img src='modules/alumnus/img/yahoo.gif' border=0 alt='"._ALUM_MOD_DETAIL_TABLE_CLICK."Copy YAHOO'></a>";
			};

		// กำหนดตัวแปล QQ
		if ($arr[25]== "0") {
			$qq = "";
			}
		else {
			$qq = "&nbsp;<a 
 href=javascript:copyOnline('$arr[25]')><img src='modules/alumnus/img/qq.gif' border=0 alt='"._ALUM_MOD_DETAIL_TABLE_CLICK." Copy QQ'></a>";
			};


		echo "		<td  align=center vAlign=top >";
		if ($arr[8]=="") { echo "<img src=modules/alumnus/avartar/$arr[21] width=40% hieght=40% class=highslide ></a>"; } else { echo "<A HREF=icon/$arr[8] width=40% hieght=40% class=\"highslide\" onclick=\"return hs.expand(this)\"><img src=icon/$arr[8] width=30% hieght=30% ></a>"; } 
		echo "<td  align=center vAlign=top >$msn$icq$yahoo$qq</td>
		<td  align=left vAlign=top >";
		?>
		<A HREF="popup.php?name=alumnus&file=view&id=<?=$arr[0];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 520, objectHeight: 480} )" class="highslide">
		<?
		echo "$arr[2]  $arr[3] [$arr[4]]</a></td>
		<td  align=center vAlign=top >$sex</td>
		<td  align=left vAlign=top >$arr[20]</td>
		<td  align=center vAlign=top >$arr[11]</td>
		<td  align=center  vAlign=top>";
		if ($arr[17] !='' && $arr[18] =='') { echo "<font color=#00CC00>"._ALUM_STATUS_EDU1."</font>"; } else if ($arr[17] =='' && $arr[18] !='' ) {echo "<font color=#6633FF>"._ALUM_STATUS_EDU2."</font>";} else { echo "<font color=#CC0000>"._ALUM_STATUS_EDU3."</font>";}
		echo "</td></tr>";

		$i++;
$count++;
		}
}

// ปิดการติดต่อฐานข้อมูล
//mysql_close( $show_db );

?>
<?

// แสดงหน้า link ไปยังหน้าอื่นๆ
echo "<table width='98%' border='0' cellspacing='0' cellpadding='0' class=grids><tr  class=odd>";
echo "<br>";
echo "<td width='98%'  align=right><a href=index.php?name=alumnus&file=add><font color=#990000 size=2>"._ALUM_MOD_DETAIL_ADD." </font></a></strong>&nbsp;&nbsp;<font color=#990000><strong> ";
for ($i = 1; $i<= $num_pages; $i++) { 
if ($i != $page) { 
echo " | <a href=index.php?name=alumnus&page=$i>$i</a>"; } else { echo " | <B><font color=red>$i</font></B>"; }
 };
echo "</td></tr></table>";

// จบการแบ่งหน้า
?>
</p>
