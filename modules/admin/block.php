<?
CheckAdmin($admin_user, $admin_pwd);
include ("editor.php");
?>

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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_BLOCK_MENU_NAME;?> </B>
					<BR><BR>
					<A HREF="?name=admin&file=block"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_BLOCK_MENU_ALL_TOPIC;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=block&op=block_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_BLOCK_MENU_ADD_TOPIC;?></A> &nbsp;&nbsp;&nbsp;
<?
//////////////////////////////////////////// แสดงรายการข่าวสาร / ประชาสัมพันธ์ 
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 30 ;
	$SUMPAGE= $db->num_rows(TB_BLOCK,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=block&op=block_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr  class="odd">
   <td width="44"><CENTER><B>Option</B></CENTER></td>
      <td width="130"><CENTER><B><?=_ADMIN_BLOCK_TABLE_HEADER_NAME;?></B></CENTER></td>
   <td><CENTER><B><?=_ADMIN_BLOCK_MENU_ALL_TOPIC;?></B></td>
   <td width="100"><CENTER><B><?=_ADMIN_BLOCK_TABLE_HEADER_STA_TUM;?></B></CENTER></td>
    <td width="40"><CENTER><B><?=_ADMIN_BLOCK_TABLE_HEADER_ORDER;?></B></CENTER></td>
      <td width="50"><CENTER><B><?=_ADMIN_BLOCK_TABLE_HEADER_STATUS;?></B></CENTER></td>
   <td width="40"><CENTER><B>Check</B></CENTER></td>
  </tr>  
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." ORDER BY pblock,sort  LIMIT $goto, $limit ");
$rows['block'] = $db->rows($res['block']);

$res['left'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='left' ORDER BY sort  ");
$rows['left'] = $db->rows($res['left']);
$res['center'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='center' ORDER BY sort  ");
$rows['center'] = $db->rows($res['center']);
$res['right'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='right' ORDER BY sort  ");
$rows['right'] = $db->rows($res['right']);
$res['user1'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='user1' ORDER BY sort  ");
$rows['user1'] = $db->rows($res['user1']);
$res['user2'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='user2' ORDER BY sort  ");
$rows['user2'] = $db->rows($res['user2']);
$res['bottom'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='bottom' ORDER BY sort  ");
$rows['bottom'] = $db->rows($res['bottom']);

$CATCOUNT = 0 ;
$count=0;
while ($arr['block'] = mysql_fetch_array($res['block'])){

    $CATCOUNT ++ ;
   //กำหนดการเปลี่ยนลำดับขึ้น
   $SETSORT_UP = $arr['block']['sort']-1;
   if($CATCOUNT == "1"){
	   $SETSORT_UP = "1" ;
   }
	//กำหนดการเปลี่ยนลำดับลง
   $SETSORT_DOWN = $arr['block']['sort']+1;
   if($CATCOUNT == $rows['block']){
	   $SETSORT_DOWN = $arr['block']['sort'] ;
   }
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
	$sfile=$arr['block']['sfile'];
	$filename=$arr['block']['filename'];
	$code=$arr['block']['code'];
	if($code==''){
	$files="".$filename."";
	}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=block&op=block_edit&id=<? echo $arr['block']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=block&op=block_del&id=<? echo $arr['block']['id'];?>&prefix=<? echo $arr['block']['post_date'];?>', '<? echo _ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
	      <td><?if($code==''){?><A HREF="index2.php?name=block&file=<?echo $arr['block']['filename'];?>&op=show" target="_blank"><?echo $arr['block']['name'];?></A><?} else {?><A HREF="index2.php?name=block&file=codeblock&id=<?echo $arr['block']['id'];?>" target="_blank"><?echo $arr['block']['name'];?></A><?}?></td>
     <td><?if($code==''){?><A HREF="index2.php?name=block&file=<?echo $arr['block']['filename'];?>&op=show" target="_blank"><?echo $arr['block']['blockname'];?></A><?} else {?><A HREF="index2.php?name=block&file=codeblock&id=<?echo $arr['block']['id'];?>" target="_blank"><?echo $arr['block']['name'];?></A><?}?></td>
     <td ><CENTER><? if ($arr['block']['pblock']=='0'){ echo "<font color=#CC0000><b>"._ADMIN_BLOCK_STATUS_HIDE."</font>"; } else if ($arr['block']['pblock']=='center'){ echo "<font color=#CC0000><b>"._ADMIN_BLOCK_STATUS_CENTER."</font>"; }  else if ($arr['block']['pblock']=='left'){ echo "<font color=#9900CC><b>"._ADMIN_BLOCK_STATUS_LEFT."</font>"; }  else if ($arr['block']['pblock']=='right'){ echo "<font color=#33FF00><b>"._ADMIN_BLOCK_STATUS_RIGHT."</font>"; }else if ($arr['block']['pblock']=='user1'){ echo "<font color=#33FF00><b>user1</font>"; }else if ($arr['block']['pblock']=='user2'){ echo "<font color=#33FF00><b>user2</font>"; }else if ($arr['block']['pblock']=='bottom'){ echo "<font color=#33FF00><b>bottom</font>"; }else if ($arr['block']['pblock']=='header'){ echo "<font color=#33FF00><b>header</font>"; }else if ($arr['block']['pblock']=='pathway'){ echo "<font color=#33FF00><b>pathway</font>"; }?></CENTER></td>

     <td align="center" width="50">
	 
	 <?php
		
		if ($arr['block']['pblock']=='left' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A>
		<?} else if ($arr['block']['sort']==$rows['left'] ){?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>
		 <?}else{?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A><?}
		} else if ($arr['block']['pblock']=='center' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A>
		<?} else if ($arr['block']['sort']==$rows['center'] ){?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>
		 <?}else{?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A><?}
		} else	if ($arr['block']['pblock']=='header' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A>
		<?} else if ($arr['block']['sort']==$rows['header'] ){?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>
		 <?}else{?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A><?}
		} else	if ($arr['block']['pblock']=='right' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A>
		<?} else if ($arr['block']['sort']==$rows['right'] ){?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>
		 <?}else{?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A><?}
		} else  if ($arr['block']['pblock']=='user1' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A>
		<?} else if ($arr['block']['sort']==$rows['user1'] ){?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>
		 <?}else{?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A><?}
		} else if ($arr['block']['pblock']=='user2' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A>
		<?} else if ($arr['block']['sort']==$rows['user2'] ){?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>
		 <?}else{?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A><?}
		} else if ($arr['block']['pblock']=='bottom' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A>
		<?} else if ($arr['block']['sort']==$rows['bottom'] ){?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>
		 <?}else{?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A><?}
		} else if ($arr['block']['pblock']=='pathway' ){ 
			 if ($arr['block']['sort']==1){?>
		 <A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A>
		<?} else if ($arr['block']['sort']==$rows['pathway'] ){?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>
		 <?}else{?>
		<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=block&op=block_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['block']['id'];?>&pblock=<?echo $arr['block']['pblock'];?>""><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_BLOCK_ORDER_DOWN;?>"></A><?}
		} else{echo "";}
		
		
		?>


	 </td>
	<td align="center"  valign="top">
				  <? if($arr['block']['status']=='0') { echo "<a HREF=?name=admin&file=block&op=block_update&action=update&id=".$arr['block']['id']."&status=1><img src=images/publish_x.png alt='"._ADMIN_BLOCK_ORDER_PUBLISH_OFF."'></a>"; } else { echo "<a HREF=?name=admin&file=block&op=block_update&action=update&id=".$arr['block']['id']."&status=0><img src=images/tick.png alt='่"._ADMIN_BLOCK_ORDER_PUBLISH_ON."'></a>"; };?>
				  </td>

     <td valign="top" align="center" width="40"><input type="checkbox" name="list[]" value="<? echo $arr['block']['id'];?>"></td>
    </tr>

<?
		 $count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="block_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
		SplitPage($page,$totalpage,"?name=admin&file=block");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "block_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){
	//	require("includes/class.resizepic.php");

		//ทำการเพิ่มข้อมูลลงดาต้าเบส
$REF = TIMESTAMP ; 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); 
$res['maxsort'] = $db->select_query("SELECT *,count(pblock) as srt FROM ".TB_BLOCK." where pblock='".$_POST['PBLOCK']."' group by pblock ORDER BY sort DESC "); 
$arr['maxsort'] = mysql_fetch_array($res['maxsort']); 
$SORT = $arr['maxsort']['srt']+1 ; 
// ?????????????????
$db->add_db(TB_BLOCK,array(
"name"=> $_POST['NAME'],
"blockname"=> $_POST['BLOCKNAME'],
"filename"=> $_POST['FILENAME'],
"sfile"=> $_POST['SFILE'],
"code"=> $_POST['DETAIL'],
"pblock"=> $_POST['PBLOCK'],
"status"=> intval($_POST['STATUS']),
"sort"=>$SORT
));
$db->closedb ();


		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_SUCCESS."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=block\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "block_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=block&op=block_add&action=add" enctype="multipart/form-data">
<BR><BR><B><?=_ADMIN_BLOCK_FORM_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="20">
<BR><BR>
<B><?=_ADMIN_BLOCK_FORM_BLOCKNAME;?> :</B><BR>
<INPUT TYPE="text" NAME="BLOCKNAME" size="50">
<BR>
<B><?=_ADMIN_BLOCK_FORM_FILENAME;?> :</B><BR>
<INPUT TYPE="text" NAME="FILENAME" size="20">
<BR><BR>
<B><?=_ADMIN_BLOCK_FORM_FILE_SNAME;?> :</B><BR>
 <select name="SFILE">
<option value="">---</option>
<option value="php">php</option>
<option value="html">html</option>
<option value="htm">htm</option>
</select>
<BR><BR>
<?=_ADMIN_BLOCK_FORM_STATUS;?><input type=radio name=STATUS value=0><B><?=_ADMIN_BLOCK_STATUS_HIDE;?></B><input type=radio name=STATUS value=1><B><?=_ADMIN_BLOCK_STATUS_SHOW;?></B><br>
<?=_ADMIN_BLOCK_STATUS_PBLOCK;?><input type=radio name=PBLOCK value=center><B><?=_ADMIN_BLOCK_STATUS_CENTER;?></B><input type=radio name=PBLOCK value=left><B><?=_ADMIN_BLOCK_STATUS_LEFT;?></B><input type=radio name=PBLOCK value=right><B><?=_ADMIN_BLOCK_STATUS_RIGHT;?></B><input type=radio name=PBLOCK value=user1><B>user1</B><input type=radio name=PBLOCK value=user2><B>user2</B><input type=radio name=PBLOCK value=bottom><B>bottom</B><input type=radio name=PBLOCK value=pathway><B>pathway</B><input type=radio name=PBLOCK value=header><B>header</B><BR>
<BR><BR>
<B><?=_ADMIN_BLOCK_FORM_DETAIL;?> :</B><BR>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ></textarea>

<input type="submit" value=" <?=_ADMIN_BLOCK_FORM_BUTTON_ADD;?> " name="submit"> <input type="reset" value="<?=_ADMIN_BLOCK_FORM_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "block_edit" AND $action == "edit" ){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		//ทำการแก้ไขข้อมูลลงดาต้าเบส
//$REF = TIMESTAMP ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where id='".$_GET['id']."' ");
$arr['block'] = $db->fetch($res['block']);
$pblock=$arr['block']['pblock'];
$sort=$arr['block']['sort'];

if ($_POST['PBLOCK'] !=$pblock){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['blockx'] = $db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='".$pblock."' and sort >'".$sort."' order by sort");
while( $arr['blockx'] = $db->fetch( $res['blockx'] ) ){
		$sorty=$arr['blockx']['sort'];
		$sortyy=$sorty-1;
//		echo "$sorty<br>";
		$db->update_db(TB_BLOCK,array(
		"sort"=> $sortyy
		)," id=".$arr['blockx']['id']." ");
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$query['pp']=$db->select_query("SELECT * FROM ".TB_BLOCK." where pblock='".$_POST['PBLOCK']."' ORDER BY sort desc limit 1");
$arr['pp'] = $db->fetch( $query['pp'] );
$sortx=$arr['pp']['sort'];
//echo "$sortx";
$sortxx=$sortx+1;
if ($_POST['FILENAME']){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_BLOCK,array(
"name"=> $_POST['NAME'],
"blockname"=> $_POST['BLOCKNAME'],
"filename"=> $_POST['FILENAME'],
"sfile"=> $_POST['SFILE'],
"code"=> "",
"sort"=>$sortxx,
"pblock"=> $_POST['PBLOCK'],
"status"=> intval($_POST['STATUS'])
)," id=".$_GET['id']." ");
		$db->closedb ();
//file_put_contents("".WEB_PATH."/modules/block/".$_POST['FILENAME'].".".$_POST['SFILE']."", "".$_POST['DETAIL']."", FILE_APPEND);
$handle = fopen("".WEB_PATH."/modules/block/".$_POST['FILENAME'].".".$_POST['SFILE']."", "w");
fwrite($handle, "".stripslashes($_POST['DETAIL'])."");
fclose($handle);
} else {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_BLOCK,array(
"name"=> $_POST['NAME'],
"blockname"=> $_POST['BLOCKNAME'],
"filename"=> "",
"sfile"=> "",
"sort"=>$sortxx,
"code"=> $_POST['DETAIL'],
"pblock"=> $_POST['PBLOCK'],
"status"=> intval($_POST['STATUS'])
)," id=".$_GET['id']." ");
		$db->closedb ();
}

} else {

if ($_POST['FILENAME']){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_BLOCK,array(
"name"=> $_POST['NAME'],
"blockname"=> $_POST['BLOCKNAME'],
"filename"=> $_POST['FILENAME'],
"sfile"=> $_POST['SFILE'],
"code"=> "",
"status"=> intval($_POST['STATUS'])
)," id=".$_GET['id']." ");
		$db->closedb ();
//file_put_contents("".WEB_PATH."/modules/block/".$_POST['FILENAME'].".".$_POST['SFILE']."", "".$_POST['DETAIL']."", FILE_APPEND);
$handle = fopen("".WEB_PATH."/modules/block/".$_POST['FILENAME'].".".$_POST['SFILE']."", "w");
fwrite($handle, "".stripslashes($_POST['DETAIL'])."");
fclose($handle);
} else {
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$db->update_db(TB_BLOCK,array(
"name"=> $_POST['NAME'],
"blockname"=> $_POST['BLOCKNAME'],
"filename"=> "",
"sfile"=> "",
"code"=> $_POST['DETAIL'],
"status"=> intval($_POST['STATUS'])
)," id=".$_GET['id']." ");
		$db->closedb ();
}
}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=block\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}

else if($op == "block_edit" AND $action == "sort"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE id='".$_GET['id']."' ");
		$arr['block'] = $db->fetch($res['block']);
		$db->closedb ();

		if($_GET['move'] == "up"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_BLOCK." SET sort = sort+1 WHERE sort = '".$_GET['setsort']."' and pblock='".$_GET['pblock']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_BLOCK." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' and pblock='".$_GET['pblock']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		if($_GET['move'] == "down"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_BLOCK." SET sort = sort-1 WHERE sort = '".$_GET['setsort']."' and pblock='".$_GET['pblock']."'  ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_BLOCK." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' and pblock='".$_GET['pblock']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		$ProcessOutput .= "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=block\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "block_edit" ){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE id='".$_GET['id']."' ");
		$arr['block'] = $db->fetch($res['block']);
		$db->closedb ();
		if($arr['block']['code']){
		$TextContent = stripslashes($arr['block']['code']);
		} else {
		$TextContent = file_get_contents ("modules/block/".$arr['block']['filename'].".".$arr['block']['sfile']."");
		}
?>
<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=block&op=block_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data">
<B><?=_ADMIN_BLOCK_FORM_TOPIC;?> :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="50" value="<?=$arr['block']['name'];?>">
<BR><BR>
<B><?=_ADMIN_BLOCK_FORM_BLOCKNAME;?> :</B><BR>
<INPUT TYPE="text" NAME="BLOCKNAME" size="50" value="<?=$arr['block']['blockname'];?>">
<BR><BR>
<?if($arr['block']['filename'] !=''){?>
<B><?=_ADMIN_BLOCK_FORM_FILENAME;?> :</B><BR>
<INPUT TYPE="text" NAME="FILENAME" size="20" value="<?=$arr['block']['filename'];?>">
<BR><BR>
<B><?=_ADMIN_BLOCK_FORM_FILE_SNAME;?> :</B><BR>
<INPUT TYPE="text" NAME="SFILE" size="20" value="<?=$arr['block']['sfile'];?>">
<?}?>
<BR>
<BR>
<input type="hidden" name=pblock_old value="<?=$arr['block']['pblock'];?>">
<?
		echo "<B>"._ADMIN_BLOCK_TABLE_HEADER_STATUS." / "._ADMIN_BLOCK_STATUS_PBLOCK."</B>&nbsp;&nbsp;<input type=Radio "; ?><? if ($arr['block']['status']==0) { echo "checked"; } ?> <?  echo " name=STATUS  value=0>"._ADMIN_BLOCK_STATUS_HIDE."&nbsp;&nbsp;<input type=Radio ";?><? if ($arr['block']['status']==1) { echo "checked"; } ?> <?  echo " name=STATUS value=1>"._ADMIN_BLOCK_STATUS_SHOW."&nbsp;&nbsp;<br><b>"._ADMIN_BLOCK_STATUS_PBLOCK."</b><input type=Radio "; ?><? if ($arr['block']['pblock']==center) { echo "checked"; } ?> <?  echo " name=PBLOCK  value=center>"._ADMIN_BLOCK_STATUS_CENTER."&nbsp;&nbsp;<input type=Radio "; ?><? if ($arr['block']['pblock']==left) { echo "checked"; } ?> <?  echo " name=PBLOCK  value=left>"._ADMIN_BLOCK_STATUS_LEFT."&nbsp;&nbsp;<input type=Radio "; ?><? if ($arr['block']['pblock']==right) { echo "checked"; } ?> <?  echo " name=PBLOCK  value=right>"._ADMIN_BLOCK_STATUS_RIGHT."&nbsp;&nbsp;<input type=Radio "; ?><? if ($arr['block']['pblock']==user1) { echo "checked"; } ?> <?  echo " name=PBLOCK  value=user1>user1&nbsp;&nbsp;<input type=Radio "; ?><? if ($arr['block']['pblock']==user2) { echo "checked"; } ?> <?  echo " name=PBLOCK  value=user2>user2&nbsp;&nbsp;<input type=Radio "; ?><? if ($arr['block']['pblock']==bottom) { echo "checked"; } ?> <?  echo " name=PBLOCK  value=bottom>bottom&nbsp;&nbsp;<input type=Radio "; ?><? if ($arr['block']['pblock']==pathway) { echo "checked"; } ?> <?  echo " name=PBLOCK  value=pathway>pathway&nbsp;&nbsp;<input type=Radio "; ?><? if ($arr['block']['pblock']==header) { echo "checked"; } ?> <?  echo " name=PBLOCK  value=header>header<BR>";
?>
<BR>
<B><?=_ADMIN_BLOCK_FORM_DETAIL;?> :</B><BR>
<? if ($arr['block']['filename']){?><textarea cols="150"  rows="30" id="DETAIL"  name="DETAIL" ><?=$TextContent;?></textarea>
<?} else{?>
<textarea cols="100" id="DETAIL" rows="50" class="ckeditor"  name="DETAIL" ><?=$TextContent;?></textarea>
<?}?>
<br><input type="submit" value="<?=_ADMIN_BLOCK_FORM_BUTTON_EDIT;?>" name="submit"> <input type="reset" value="<?=_ADMIN_BLOCK_FORM_BUTTON_CLEAR;?>" name="reset">
</FORM>
<BR><BR>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}

}
else if($op == "block_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){

		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE id='".$value."' ");
			$arr['block'] = $db->fetch($res['block']);
			$res['blocks'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE sort >'".$arr['block']['sort']."' and pblock='".$arr['block']['pblock']."' order by sort");
			
			while($arr['blocks'] = $db->fetch($res['blocks'])){
			$i=1;
			$sortd=$arr['blocks']['sort']-$i;
			$db->update_db(TB_BLOCK,array(
			"sort"=> $sortd
			)," id=".$arr['blocks']['id']." ");
			}
			$db->del(TB_BLOCK," id='".$value."' "); 
			$db->closedb ();

		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=block\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "block_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['block'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE id='".$_GET['id']."' ");
			$arr['block'] = $db->fetch($res['block']);
			$res['blocks'] = $db->select_query("SELECT * FROM ".TB_BLOCK." WHERE sort >'".$arr['block']['sort']."' and pblock='".$arr['block']['pblock']."' order by sort");
			while($arr['blocks'] = $db->fetch($res['blocks'])){
			$i=1;
			$db->update_db(TB_BLOCK,array(
			"sort"=> $arr['blocks']['sort']-$i
			)," id=".$arr['blocks']['id']." ");
			}

		$db->del(TB_BLOCK," id='".$_GET['id']."' "); 
		$db->closedb ();

//	@unlink("blockicon/".$_GET['prefix'].".jpg");
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=block\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "block_update" AND $action == "update"){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_BLOCK,array(
			"status"=>"".$_GET['status'].""
		)," id=".$_GET['id']."");
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_UPDATE."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=block\"><B>"._ADMIN_BLOCK_MESSAGE_ADD_GOBACK."</B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=block'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}
?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
