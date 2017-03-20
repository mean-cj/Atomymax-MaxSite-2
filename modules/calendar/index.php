<link rel="stylesheet" href="css/calendar.css" type="text/css" media="screen" />
<style type="text/css">
<!--
.calendar { 
    width:200;
    background-color: #FFFFFF;
}
-->
</style>

	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top >
		  <!-- News -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_calendar.gif" BORDER="0"><BR><BR>
						
<?php 
if(empty($admin_user)){?>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=5 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?php echo _MENU_MAIN_INDEX;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?php echo _CAL_MENU_INDEX;?></B>
					<BR><BR>
				</td>
				</tr>
								<table >
<?php } else {
?>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=5 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?php echo _MENU_MAIN_INDEX;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?php echo _CAL_MENU_INDEX;?> &nbsp;&nbsp;<IMG SRC="images/icon/calendar.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <A HREF="popup.php?name=admin&file=addevent" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 700, objectHeight: 800} )" class="highslide"><?php echo _MENU_MAIN_ADDNEW;?> </A></B>
					<BR><BR>
				</td>
				</tr>
								<table >
<?php
}	
?>
<CENTER>
		<table>
		<tr>
		<td>
						<?php 
						if(empty($_GET['year'])){
							$_GET['year'] = date("Y");
						}
						$cal = new MyCalendar;
						echo $cal->getYearView($_GET['year']);
						?>
						</CENTER>
				<BR><BR>
			<!-- End News -->
		</td>
		</tr>
		</table>
		<table width="100%" cellspacing="0" cellpadding="0" class="grids">
		<tr ><td colspan=5 align=center ><b><?php echo _CAL_MONTH_NOW;?></b></td></tr>

		<tr class="odd">
		<td width="20" align="center"><?php echo _CAL_T_RANK;?></td><td width="100" align="center"><?php echo _CAL_T_DATE;?></td><td  width="150" align="center"><?php echo _CAL_T_ACTIVIT;?></td><td  width="300" align="center"><?php echo _CAL_T_DETAIL;?></td><td  width="60" align="center"><?php echo _CAL_T_TIME;?></td></tr>


	<?php 
	$mt=date('m');
	$my=date('Y');
$res['calendar'] = $db->select_query("SELECT * FROM ".TB_CALENDAR." where date_event between  '$my-$mt-01' and '$my-$mt-31' ORDER BY date_event  ");

$rank=1;
$resa['calendar'] = $db->select_query("SELECT * FROM ".TB_CALENDAR." where date_event between  '$my-$mt-01' and '$my-$mt-31' ORDER BY date_event  ");
$arrs['calendar'] = $db->fetch($resa['calendar']);
$id=$arrs['calendar']['id'];
if ($id !='') {
$count=0;
while($arr['calendar'] = $db->fetch($res['calendar'])){
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
echo "<TR ".$ColorFill.">";
	$year=substr($arr['calendar']['date_event'],0,4);
    $month=substr($arr['calendar']['date_event'],6,2)-1;
	$day=substr($arr['calendar']['date_event'],8,2);
//echo "$day-$month-$year";
//	$link = $this->getDateLink($day, $month, $year);
            $link['link'] = "popup.php?name=calendar&file=view&id=".$arr['calendar']['id']."&dates=".$arr['calendar']['date_event']."";
			$arr['calendar']['subject'] = preg_replace("/\'/", "&#039;", $arr['calendar']['subject']);
			$arr['calendar']['subject'] = htmlspecialchars($arr['calendar']['subject']);
			$link['title'] = "".stripslashes($arr['calendar']['subject'])."";

?>
			<TD align="center"><?php echo $rank;?></td><TD valign=top align="center">[ <?php echo $arr['calendar']['date_event']; ?>]</td><TD ><img src="images/a.gif" border="0"><?php echo "<a href=\"".$link['link']."\" onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 700, objectHeight: 500} )\" )\">"; ?><font color="<?php echo $textfill; ?>"><b><?php echo $arr['calendar']['subject']; ?></a>
<?php 
if($admin_user){
	//Admin Login Show Icon
?>
				  <a href="?name=admin&file=editevent&id=<?php echo $arr['calendar']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?php echo _FROM_IMG_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=news&op=news_del&id=<?php echo $arr['calendar']['id'];?>&pic=<?php echo $arr['news']['pic'];?>&prefix=<?php echo $arr['calendar']['post_date'];?>','<?php echo _ADMIN_BUTTON_DEL_MESSAGE;?>');">

				  <a href="javascript:Confirm('?name=admin&file=delevent&id=<?php echo $arr['calendar']['id'];?>&op=calendar_del','<?php echo  _FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?php echo _FROM_IMG_DEL;?>" ></a>
<?php 
}
?>	
</td><TD >	<?php echo $arr['calendar']['detail']; ?></td><TD  align="center"><?php echo $arr['calendar']['timeout']; ?></td>
												</tr>
<?php 
				$rank++;
$count++;
}

}	
else {
echo "<tr class=odd><td colspan=5 align=center ><b><< "._CAL_NULLACTIVIT." >></b></td></tr>";
}

$db->closedb ();
?>


		</table>

		  </TD>
        </TR>
      </TBODY>
    </TABLE>