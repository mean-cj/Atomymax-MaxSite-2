		<center>
<link rel="stylesheet" href="css/calendar.css" type="text/css" media="screen" />
		<style type="text/css">
<!--
.calendar { 
    width:190;
    background-color: #FFFFFF;
}
-->
</style>
<table width="<?=$widthSUM;?>" border="0" cellpadding="0" cellspacing="0">

<tr>
<td width="<?=$widthSUM;?>" border="1" align=center><br>
								<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" WIDTH=120 HEIGHT=120 align=center >
								<PARAM NAME=movie VALUE="UserFiles/Flash/watch1.swf">
								  <PARAM NAME=quality VALUE=high>
                                  <PARAM NAME=bgcolor VALUE=#FFFFFF>
                                 <param name=wmode value=transparent>
                                <param name=menu value=false>
								<EMBED src="UserFiles/Flash/watch1.swf" quality=high  WIDTH=120 HEIGHT=120  type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
								</EMBED>
								</OBJECT>
								</td>
</tr>
<tr>
<td width="<?=$widthSUM;?>" border="0" align="center">
								<BR>
						
						<?
						$month=(isset($_GET['month']));
						$year=(isset($_GET['year']));
						if($month==''){
							$mon = date('m');
						} else {
						$mon = $months;
						}
						if($year==''){
							$yea = date('Y');
						} else {
							$yea=$years;
						}
						$cal = new MyCalendar;
						echo $cal->getmonthView($mon,$yea );
						?>
						</CENTER>
				<BR>
		  </TD>
        </TR>

		<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
						$dateday=date('Y-m-d');
						$mn=date('m')+1;
						$daten=date('Y-'.$mn.'-d');
	$mt=date('m');
	$my=date('Y');
	$dd=date('d');
$numrow=$db->num_rows(TB_CALENDAR,"id"," date_event >= '$my-$mt-$dd'  limit 10");
if($numrow !=0){
?>
		<tr>
		<td align="center"><b><?=_CAL_STA_TEN;?></td><b>
		</tr>
		<tr>
            <td height="1" align="left" class="dotline"></td>
			</tr>
<?

$res['calendar'] = $db->select_query("SELECT * FROM ".TB_CALENDAR." where date_event >= '$my-$mt-$dd' ORDER BY date_event  limit 10");

$count=0;

while($arr['calendar'] = $db->fetch($res['calendar'])){
if (!empty($arr['calendar']['id'])) {
echo "<TR>"; 
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = "#FDEAFB";
} else {
$ColorFill = "#F0F0F0";
}
	$year=substr($arr['calendar']['date_event'],0,4);
    $month=substr($arr['calendar']['date_event'],6,2)-1;
	$day=substr($arr['calendar']['date_event'],8,2);
//echo "$day-$month-$year";
//	$link = $this->getDateLink($day, $month, $year);
            $link['link'] = "popup.php?name=calendar&file=view&id=".$arr['calendar']['id']."&dates=".$arr['calendar']['date_event']."";
			$arr['calendar']['subject'] = preg_replace("/\'/i", "&#039;", $arr['calendar']['subject']);
			$arr['calendar']['subject'] = htmlspecialchars($arr['calendar']['subject']);
			$link['title'] = "".stripslashes($arr['calendar']['subject'])."";

?>
			<TD width="100%" valign=top height="20"><img src="images/admin/calendar.gif" border="0">&nbsp;<font color="#990000"><b>(<? echo $arr['calendar']['date_event']; ?>)</b></font>&nbsp;<? echo "<a href=\"".$link['link']."\" onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: '500', objectHeight: '300'} )\" )\">"; ?><? echo $arr['calendar']['subject']; ?></b></a></td>	
												</tr>
												<tr>
            <td height="1" align="left" class="dotline"></td>
			</tr>
<?
} else {
	echo "<tr><td align=center><font color=#FF0033><b><< "._CAL_STA_NULL." >></font></td></tr>";
}
}
}
$db->closedb ();
?>

      </TBODY>
    </TABLE>

