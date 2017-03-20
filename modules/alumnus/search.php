 <table width="750" align=center cellSpacing=0 cellPadding=0 border=0><tr><TD ><IMG SRC="images/menu/textmenu_alumnus.png" BORDER="0"></TD></tr>
 <tr><TD height="1" class="dotline" colspan="4"></td></tr></table>
 <br>
<?

//include "modules/alumnus/form_search1.php";
include "modules/alumnus/config.inc.php";
include "modules/alumnus/form_search.php";
// รับค่าตัวแปล
empty($_POST['list_pro'])?$list_pro="":$list_pro=$_POST['list_pro'];
empty($_POST['sex'])?$sex="":$sex=$_POST['sex'];
empty($_POST['age'])?$age="":$age=$_POST['age'];
empty($_POST['province'])?$province="":$province=$_POST['province'];
empty($_POST['cam'])?$cam="":$cam=$_POST['cam'];
empty($_POST['mic'])?$mic="":$mic=$_POST['mic'];
empty($_POST['pic'])?$pic="":$pic=$_POST['pic'];
empty($_POST['Search'])?$Search="":$Search=$_POST['Search'];


// รับค่าตัวแปล ทำลิงค์ แบ่งหน้า
	$link_page =  "index.php?name=alumnus&list_pro=$list_pro&sex=$sex&age=$age&province=$province&cam=$cam&mic=$mic&pic=$pic";

if (empty($page)){
		$page=1;
	}

	// กำหนดตัวแปล
	// ( 1 ) โปรแกรม
	if ($list_pro=="0") {
		$pro = "";
	}
	elseif ($list_pro=="msn") {
		$msn = "msn !='0' AND";
	}
	elseif ($list_pro=="icq") {
		$icq = "icq !='0' AND";
	}
	elseif ($list_pro=="yahoo") {
		$yahoo = "yahoo !='0' AND";
	}
	elseif ($list_pro=="qq") {
		$qq = "qq !='0' AND";
	}
	else {};

	// ( 2 ) เพศ
	if ($sex=="0") {
		$sex_a = "";
	}
	else {
		$sex_a = "$sex";
	};

	// ( 3 ) อายุ
	if ($age=="0") {
		$age_a = "";
	}
	elseif ($age=="a1") {
		$age_a = "AND age < 18 ";
	}
	elseif ($age=="a2") {
		$age_a = "AND age between 18 and 20 ";
	}
	elseif ($age=="a3") {
		$age_a = "AND age between 21 and 30 ";
	}
	elseif ($age=="a4") {
		$age_a = "AND age between 31 and 40 ";
	}
	elseif ($age=="a5") {
		$age_a = "AND age > 41 ";
	}
	else {};

	// ( 4 ) จังหวัด
	if ($province=="0") {
		$province_a = "";
	}
	else {
		$province_a = "$province";
	};

	// ( 5 ) Web can
	if ($cam == "1") {
		$cam_a = "1";
	}
	else {
		$cam_a = "";
	};

	// ( 5 ) Mic
	if ($mic == "1") {
		$mic_a = "1";
	}
	else {
		$mic_a = "";
	};

	// ( 6 ) Picture
	if ($pic == "1") {
		$pic_a = "AND picture !='0'";
	}
	else {
		$pic_a = "";
	};


	// ติดต่อ database เพื่ออ่านข้อมูล	

	// หาจำนวนหน้าทั้งหมด
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

	if (empty($Search)){
	$sql = $db->select_query("select * from ".TB_ALUMNUS." WHERE $pro $msn $icq $yahoo $qq sex LIKE '%$sex_a%' $age_a AND province LIKE '%$province_a%' AND cam LIKE '%$cam_a%' AND mic LIKE '%$mic_a%' $pic_a ");
	$NRow = $db->num_rows(TB_ALUMNUS,"id","  $pro $msn $icq $yahoo $qq sex LIKE '%$sex_a%' $age_a AND province LIKE '%$province_a%' AND cam LIKE '%$cam_a%' AND mic LIKE '%$mic_a%' $pic_a "); 
	$NRow = mysql_num_rows($sql );
	} else {
	$sql = $db->select_query("select * from ".TB_ALUMNUS." WHERE ".$Search2." like '%".$Search."%' ");
	$NRow = $db->num_rows(TB_ALUMNUS,"id","  ".$Search2." like '%".$Search."%' "); 
	}

	// แบ่งหน้าแสดง
	$per_page=$list_page;
		if (!$page) { 
			 $page = 1; 
		} 
	$prev_page = $page - 1; 
	$next_page = $page + 1; 
	$page_start = ($per_page * $page) - $per_page; 
	$result = mysql_db_query($dbname,$sql);
	$num_rows = $NRow ;
	if ($num_rows<= $per_page) { 
		 $num_pages = 1; 
	} else if (($num_rows % $per_page) == 0) { 
		 $num_pages = ($num_rows / $per_page); 
	} else { 
		 $num_pages = ($num_rows / $per_page) + 1; 
	} 
		$num_pages = (int) $num_pages; 

	if (($page > $num_pages) && ($page< 0)) { 
		 error("You have specified an invalid page number"); 
	}


// แสดงผลของรายการทั้งหมด
//$sql1 = "select * from $tblname WHERE $pro $msn $icq $yahoo $qq sex LIKE '%$sex_a%' $age_a AND province LIKE '%$province_a%' AND cam LIKE '%$cam_a%' AND mic LIKE '%$mic_a%' $pic_a order by id DESC LIMIT $page_start, $per_page"; 
//$result1 = mysql_db_query($dbname,$sql1);
//$NRow1 = mysql_num_rows($result1);
	if (empty($Search)){
	$sql1 = $db->select_query("select * from ".TB_ALUMNUS." WHERE $pro $msn $icq $yahoo $qq sex LIKE '%$sex_a%' $age_a AND province LIKE '%$province_a%' AND cam LIKE '%$cam_a%' AND mic LIKE '%$mic_a%' $pic_a order by id DESC LIMIT $page_start, $per_page ");
	$NRow1 = $db->num_rows(TB_ALUMNUS,"id","  $pro $msn $icq $yahoo $qq sex LIKE '%$sex_a%' $age_a AND province LIKE '%$province_a%' AND cam LIKE '%$cam_a%' AND mic LIKE '%$mic_a%' $pic_a order by id DESC LIMIT $page_start, $per_page "); 


	} else {
	$sql1 = $db->select_query("select * from ".TB_ALUMNUS." WHERE ".$Search2." like '%".$Search."%'  ");
	$NRow1 = $db->num_rows(TB_ALUMNUS,"id","  ".$Search2." like '%".$Search."%'  "); 

	}
if($NRow1==0) { 
		echo "<center>";
		echo "<br><br>";
		echo "<font size=2 face='MS Sans Serif'>"._ALUM_MOD_SEARCH_END_NULL."</font><br><br><br>\n";
		echo "<center>";
	}

// แสดงข้อมูล
	else {

		echo "<br><table width=98% border=0 cellspacing=1 cellpadding=2 bgcolor=#FFFFFF align=center>";
		echo "<td width=5% bgcolor=#CCE9FD >&nbsp;</td>
		<td width=15% bgcolor=#CCE9FD class=style>&nbsp;</td>
		<td width=23% bgcolor=#CCE9FD class=style><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_NAME."</b></div></td>
		<td width=10% bgcolor=#CCE9FD class=style><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_SEX."</b></div></td>
		<td width=25% bgcolor=#CCE9FD class=style><div align=center><b>"._ALUM_MOD_DETAIL_TABLE_COMMENT."</b></div></td>
		<td width=15% bgcolor=#CCE9FD class=style><div align=center><b>"._ALUM_MOD_FORM_PROV."</b></div></td>
		<td width=8% bgcolor=#CCE9FD class=style><div align=center><b>"._ALUM_MOD_SEARCH_TABLE_VIEW."</b></div></td>";
		echo "<tr> ";

$i=0;
$count=0;

while( $arr = mysql_fetch_row($sql1) )
		{		
 // กำหนดสีของตาราง
 if($count%2==0) { //ส่วนของการ สลับสี 
$bgc = "#FDEAFB";
} else {
$bgc = "#F0F0F0";
}

		// กำหนดตัวแปล
		// For Admin Delete
		if ($admin_user !='' ) {
			$del = "<a href=index.php?name=alumnus&file=delete&id=$arr[0]><img src=modules/alumnus/img/delete.gif border=0 alt="._ALUM_MOD_DETAIL_TABLE_DEL."></a>";
			} else {
			$del = "<img src=modules/alumnus/emotion/$arr[28].gif>";
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
 href=javascript:copyOnline('$arr[24]')><img src='modules/alumnus/img/yahoo.gif' border=0 alt='"._ALUM_MOD_DETAIL_TABLE_CLICK." Copy YAHOO'></a>";
			};

		// กำหนดตัวแปล QQ
		if ($arr[25]== "0") {
			$qq = "";
			}
		else {
			$qq = "&nbsp;<a 
 href=javascript:copyOnline('$arr[25]')><img src='modules/alumnus/img/qq.gif' border=0 alt='"._ALUM_MOD_DETAIL_TABLE_CLICK." Copy QQ'></a>";
			};

		echo "<td bgcolor=$bgc align=center vAlign=top class=style>$del</td>
		<td bgcolor=$bgc align=center vAlign=top class=style>$msn$icq$yahoo$qq</td>
		<td bgcolor=$bgc align=left vAlign=top class=style>";
		?>
		<A HREF="popup.php?name=alumnus&file=view&id=<?=$arr[0];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 450, objectHeight: 350} )" class="highslide">
		<?
		echo "$arr[2]  $arr[3] [$arr[4]]</a></td>
		<td bgcolor=$bgc align=center vAlign=top class=style>$sex</td>
		<td bgcolor=$bgc align=left vAlign=top class=style>$arr[20]</td>
		<td bgcolor=$bgc align=center vAlign=top class=style>$arr[16]</td>
		<td bgcolor=$bgc align=center class=style>";
		?>
		<A HREF="popup.php?name=alumnus&file=view&id=<?=$arr[0];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 450, objectHeight: 350} )" class="highslide"><img src="modules/alumnus/avartar/<?=$arr[21];?>" border="0" alt="<?=_ALUM_MOD_DETAIL_TABLE_CLICKDETAIL;?>"></a>
		<?
		echo "</td></tr>";

		$i++;
$count++;
		}
}
// ปิดการติดต่อฐานข้อมูล
//mysql_close();

?>
<?

// แสดงหน้า link ไปยังหน้าอื่นๆ
echo "<table width='98%' border='0' cellspacing='0' cellpadding='0'><tr class=style >";
echo "<br>";
echo "<td width='98%' class=style align=right>";
for ($i = 1; $i<= $num_pages; $i++) { 
if ($i != $page) { 
echo " | <a href=index.php?name=alumnus&file=search&page=$i$link_page>$i</a>"; } else { echo " | <B><font color=red>$i</font></B>"; }
 };
echo "</td></tr></table>";

// จบการแบ่งหน้า
?>