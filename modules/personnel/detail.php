	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_personnel.gif" BORDER="0"><BR>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
<!-- แสดงผลรายการสมาชิกในคณะ -->
<?
//////////////////////////////////////////// แสดงรายชื่อสมาชิกในคณะ
empty($_GET['op'])?$op="":$op=$_GET['op'];
empty($_GET['page'])?$page="1":$page=$_GET['page'];

if($op == ""){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_personnel,"id","");

$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;
?>

 <table width="750" cellspacing="2" cellpadding="1" >
  
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//$res['userx'] = $db->select_query("SELECT * FROM ".TB_personnel_list." group by u_id ORDER BY u_id,g_id,p_order LIMIT $goto, $limit ");
$res['user'] = $db->select_query("SELECT * FROM ".TB_personnel." ORDER BY sort LIMIT $goto, $limit ");
$rank=1;
$count=0;
while($arr['user'] = $db->fetch($res['user'])){
	if ($count==0) { echo "<TR>"; }

?>

	<td width="50%" valign=top>
	<? OpenTablecom();?>
					<TABLE width="100%" border=0>
				<TR>
					<TD  width=80 rowspan="5">
					  <p><?if ($arr['user']['p_pic']){?><A HREF="images/personnel/<? echo $arr['user']['p_pic'];?>" class="highslide" onclick="return hs.expand(this)"><img src="images/personnel/thb_<? echo $arr['user']['p_pic'];?>" width=80></a><?} else { echo "<img src=\"images/nopic.jpg\" border=0"; }?></p></TD>
				    <TD ><b><?=_PERSONNEL_MOD_DETAIL_NAME;?> : </b><a href="popup.php?name=personnel&file=popdetail&pid=<?=$arr['user']['id'];?>"onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 510, objectHeight:300} )" class="highslide"><?=$arr['user']['p_name'];?></a></TD>
				</TR>
				<TR>
				 <TD height="1"class="dotline"><b><?=_PERSONNEL_MOD_DETAIL_POSITION;?> : </b><?=$arr['user']['p_position'];?></TD>
				  </TR>
				<TR>
				 <TD height="1"class="dotline"><b><?=_PERSONNEL_MOD_DETAIL_DATA;?> : </b><? echo $arr['user']['p_data'];?></TD>
				  </TR>
				<TR>
				  <TD height="1"class="dotline"><b><?=_PERSONNEL_MOD_DETAIL_EMAIL;?> : </b><?=$arr['user']['p_mail'];?></TD>
				  </TR>
				  <TD height="1" valign="top" class="dotline"><b><?=_PERSONNEL_MOD_DETAIL_PHONE;?> : </b><?=$arr['user']['p_tel'];?></TD>
				  </TR>
				</TABLE>
	<? CloseTablecom();?>
	</td>

<?
$count++;

if (($count%_NEWS_COL) == 0) { echo "</TR><TR><TD align=center colspan=2 height=\"1\" ></TD></TR>"; $count=0; 
} 
}
$db->closedb ();
?>
 </table>

<?
	SplitPage($page,$totalpage,"?name=personnel&file=detail");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
	echo "<BR><BR>";
echo "<font color=#003399 size=2><b>"._PERSONNEL_MOD_DETAIL_SELECT_CAT."<b></font><br>";
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groupstext'] = $db->select_query("SELECT * FROM ".TB_personnel_group." ORDER BY gp_id ");
while ($arr['groupstext'] = $db->fetch($res['groupstext']))
   {
		echo "<font color=#990000 size=2><A HREF=\"?name=personnel&file=gdetail&id=".$arr['groupstext']['gp_id']."&op=gdetail&gr=".$arr['groupstext']['gp_name']."\"><B>".$arr['groupstext']['gp_id']." : </B>".$arr['groupstext']['gp_name']."</a></font><br>";
   }
$db->closedb ();

}

else if($_GET['op'] == "detail" ){
	//////////////////////////////////////////// กรณีเพิ่ม User Admin Form
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
	$res['admin'] = $db->select_query("SELECT * FROM ".TB_personnel." WHERE id='$id' ");
	$arr['admin'] = $db->fetch($res['admin']);
	$db->closedb ();

?>
<center>
<table >
<tr>
<td align="center">
<table class='iconframe' width="120" border="0" cellpadding="0" cellspacing="0">
<tr>
  <td class='imageframe' align="center"> <A HREF="images/personnel/<? echo $arr['admin']['p_pic'];?>" class="highslide" onclick="return hs.expand(this)">
	  <img src='images/personnel/thb_<? echo $arr['admin']['p_pic'];?>' /></a></td>
  <td class='shadow_right'><div class='shadow_top_right'></div></td>
</tr>
<tr>
  <td class='shadow_bottom'><div class='shadow_bottom_left'></div></td>
  <td class='shadow_bottom_right'></td>
</tr>
</table>
</td>

<td>
<table>
<tr>
<h5>
<td width="100" align=left><h5><?=_PERSONNEL_MOD_DETAIL_NAME_FULL;?> :</td><td width="400" align=left><font color=#CC0000><h5><?echo $arr['admin']['p_name'];?></td>
</tr>
<td width="100" align=left><h5><?=_PERSONNEL_MOD_DETAIL_POSITION;?> :</td><td width="400" align=left><font color=#CC0000><h5><?echo $arr['admin']['p_position'];?></td>
</tr><tr>
<td width="100" align=left><h5><?=_PERSONNEL_MOD_DETAIL_DATAX;?> :</td><td width="400" align=left><font color=#CC0000><h5><?echo $arr['admin']['p_data'];?></td>
</tr><tr>
<td width="100" align=left><h5><?=_PERSONNEL_MOD_DETAIL_ADD;?> :</td><td width="400" align=left><font color=#CC0000><h5><?echo $arr['admin']['p_add'];?></td>
</tr><tr>
<td width="100" align=left><h5><?=_PERSONNEL_MOD_DETAIL_PHONE;?> :</td width="400" align=left><td><font color=#CC0000><h5><?echo $arr['admin']['p_tel'];?></td>
</tr><tr>
<td width="100" align=left><h5><?=_PERSONNEL_MOD_DETAIL_EMAIL;?> :</td><td width="400" align=left><font color=#CC0000><h5><?echo $arr['admin']['p_mail'];?></td>
</tr><tr>
<td width="100" align=left><h5><?=_PERSONNEL_MOD_DETAIL_CAT;?> :</td>

<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groups'] = $db->select_query("SELECT * FROM ".TB_personnel_group.",".TB_personnel." where p_level=gp_id and p_level='".$arr['admin']['p_level']."' ORDER BY gp_id ");
$arr['groups'] = $db->fetch($res['groups']);
$db->closedb ();
?>
<td width="300" align=left><h5><font color=#CC0000><? echo $arr['groups']['gp_name'];?></td>
</tr>
</table>
</td>
</tr>
</table>
<br>

<?
	echo "<form action='?name=personnel&file=detail' method='post'>";
echo "<center><input type='submit' name='index' value=' "._FORM_BUTTON_LINK_INDEX."' ></form></center>";

	}

else if($_GET['op'] == "gdetail" ){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_personnel,"id","");
$page=$_GET['page'];
if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;
?>
<br><h5><?=_PERSONNEL_MOD_DETAIL_CAT;?> :  <font color=#CC0000><?echo $gr;?></font><br>
 <table width="100%" cellspacing="2" cellpadding="1" >
  <tr bgcolor="#0066FF" height=25>
   <td><font color="#FFFFFF" align="center"><B><CENTER><?=_FORM_TABLE_TD_TITLE_ID;?></CENTER></B></font></td>
   <td><font color="#FFFFFF" align="center"><B><CENTER><?=_PERSONNEL_MOD_DETAIL_NAME_FULL;?></CENTER></B></font></td>
	        <td><font color="#FFFFFF" align="center"><B><CENTER><?=_PERSONNEL_MOD_DETAIL_POSITION;?></CENTER></B></font></td>
   <td><font color="#FFFFFF" align="center"><B><CENTER><?=_PERSONNEL_MOD_DETAIL_EMAIL;?></CENTER></B></font></td>
   <td><font color="#FFFFFF" align="center"><B><CENTER>tel</B></CENTER></font></td>


  </tr>  
<?
$res['user'] = $db->select_query("SELECT * FROM ".TB_personnel." where p_level='".$pid."' ORDER by p_level,sort LIMIT $goto, $limit ");
$rank=1;
while($arr['user'] = $db->fetch($res['user'])){
	$res['groups'] = $db->select_query("SELECT * FROM ".TB_personnel_group." WHERE gp_id='".$arr['user']['p_level']."' ");
	$arr['groups'] = $db->fetch($res['groups']);
	$uid=$arr['user']['id'];
	$gid=$arr['user']['p_level'];
?>
    <tr>
     <td width="44" align="center"><A HREF="images/personnel/<? echo $arr['user']['p_pic'];?>" class="highslide" onclick="return hs.expand(this)"><img src="images/personnel/<? echo $arr['user']['p_pic'];?>" width=40 ></a></td> 
     <td><A HREF="?name=personnel&file=detail&id=<?=$uid;?>&op=detail"><?echo $arr['user']['p_name'];?></a></td>
	      <td ><? echo $arr['user']['p_position'];?></td>
     <td ><? echo $arr['user']['p_email'];?></td>
     <td ><? echo $arr['user']['p_tel'];?></td>

    </tr>
	<TR>
		<TD colspan="8" height="1" class="dotline"></TD>
	</TR>
<?
		  $rank++;
 } 
?>
 </table>

<?
	SplitPage($page,$totalpage,"?name=personnel&file=detail&&pid=".$_GET['pid']."&gr=".$_GET['gr']."&op=gdetail");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
	echo "<BR><BR>";

		echo "<br><form action='?name=personnel&file=detail' method='post'>";
echo "<center><input type='submit' name='index' value=' "._FORM_BUTTON_LINK_INDEX."' ></form></center>";

}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}

?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
			<BR><BR>
			<!-- Admin -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
