	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=5 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<BR><BR>
 <br>
<?
CheckAdmin($admin_user, $admin_pwd);

include "modules/alumnus/form_search.php";
include "modules/alumnus/config.inc.php";

if (empty($page)){
		$page=1;
	}

// เริ่มติดต่อฐานข้อมูล

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$show_sql  = $db->select_query("SELECT * FROM ".TB_ALUMNUS." order by id DESC ");
$NRow = $db->num_rows(TB_ALUMNUS,"id",""); 

$list_page=20;
// แบ่งหน้าแสดง
$per_page=$list_page;
if (!$page) { 
 $page = 1; 
} 
$prev_page = $page - 1; 
$next_page = $page + 1; 
$page_start = ($per_page * $page) - $per_page; 

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
$show_sql  = $db->select_query("SELECT * FROM ".TB_ALUMNUS." order by id DESC LIMIT $page_start, $per_page");
$NRow = $db->num_rows(TB_ALUMNUS,"id",""); 


	if($NRow==0) { 
		echo "<center>";
		echo "<br><br>";
		echo "<font size=2 face='MS Sans Serif'>"._ALUM_NULL."</font><br><br><br>\n";
		echo "<center>";
	}

// แสดงข้อมูล
	else {
$check_m  = $db->select_query("SELECT * FROM ".TB_ALUMNUS." ");
$member_all = $db->num_rows(TB_ALUMNUS,"id",""); 


echo "<br><center><table width=98% border=0 cellspacing=0 cellpadding=0  class=grids><tr class=odd><td width=100% bgcolor=#ffffff align=center><b><font size='3' face='MS Sans Serif' color='red'>"._ALUM_MOD_DETAIL_TITLE." $member_all "._ADMIN_MEMBER_MESSAGE_MEM_BIRT2."</b><font></td></tr></table>" ;
		echo "<br><table width=98% border=0 cellspacing=0 cellpadding=0 class=grids><tr class=odd>";
		echo "<td width=10% bgcolor=#CCE9FD >&nbsp;</td>
		<td width=10% bgcolor=#CCE9FD class=style>&nbsp;</td>
		<td width=25% bgcolor=#CCE9FD class=style><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_NAME."</b></div></td>
		<td width=10% bgcolor=#CCE9FD class=style><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_SEX."</b></div></td>
		<td width=25% bgcolor=#CCE9FD class=style><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_COMMENT."</b></div></td>
		<td width=10% bgcolor=#CCE9FD class=style><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_YEAR."</b></div></td>
		<td width=18% bgcolor=#CCE9FD class=style><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_STATUS."</b></div></td></tr> ";

$i=0;
$count=0;
while( $arr = $db->sql_fetchrow( $check_m ) )
		{		
 // กำหนดสีของตาราง
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

		// กำหนดตัวแปล
		// For Admin Delete
		if ($admin_user !='' ) {
			$del = "<a href=index.php?name=alumnus&file=delete&id=$arr[0]><img src=images/delete.png border=0 alt="._FROM_IMG_DEL."></a>";
			$edit = "<a href=index.php?name=alumnus&file=edit&id=$arr[0]><img src=images/admin/edit.gif border=0 alt="._FROM_IMG_EDIT."></a>";
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

		echo "<tr ".$ColorFill.">";
		echo "<td align=center vAlign=top >$edit $del</td>
		<td  align=center vAlign=top >$msn$icq$yahoo$qq</td>
		<td align=left vAlign=top >";
		?>
		<A HREF="popup.php?name=alumnus&file=view&id=<?=$arr[0];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 520, objectHeight: 480} )" class="highslide">
		<?
		echo "$arr[2]  $arr[3] [$arr[4]]</a></td>
		<td align=center vAlign=top >$sex</td>
		<td  align=left vAlign=top >$arr[20]</td>
		<td  align=center vAlign=top >$arr[11]</td>
		<td  align=center  vAlign=top>";
		if ($arr[17] !='' && $arr[18] =='') { echo ""._ALUM_STATUS_EDU1.""; } else if ($arr[17] =='' && $arr[18] !='' ) {echo ""._ALUM_STATUS_EDU2."";} else { echo ""._ALUM_STATUS_EDU3."";}
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
echo "<table width='98%' border='0' cellspacing='0' cellpadding='0'><tr class=style >";
echo "<br>";
echo "<td width='98%' class=style align=right><a href=index.php?name=alumnus&file=add><font color=#990000 size=2><< "._ALUM_LINK_ADD." >> </font></a></strong>&nbsp;&nbsp;<font color=#990000><strong> ";
for ($i = 1; $i<= $num_pages; $i++) { 
if ($i != $page) { 
echo "| <a href=index.php?name=admin&file=alumnus&page=$i>$i</a>"; } else { echo " | <B><font color=red>$i</font></B>"; }
 };
echo "</td></tr></table>";

// จบการแบ่งหน้า

?>

</td>
</tr>
</table>
				</TD>
				</TR>
			</TABLE>