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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_PERSONNEL_MENU_TITLE;?></B>
					<BR><BR>
<A HREF="?name=admin&file=personnel"><IMG SRC="images/admin/admins.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_PERSONNEL_MENU_LIST;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=personnel&op=admin_add"><IMG SRC="images/admin/user.gif"  BORDER="0" align="absmiddle"><?=_ADMIN_PERSONNEL_MENU_ADD_NEW;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=pgroup"><IMG SRC="images/admin/keys.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_PERSONNEL_MENU_LIST_GROUP;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=pgroup&op=group_add"><IMG SRC="images/admin/share.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_PERSONNEL_MENU_NEW_GROUP;?></A>
<BR><BR>
<!-- แสดงผลรายการบุคลากร -->
<?
//////////////////////////////////////////// แสดงรายชื่อบุคลากร
if($op == ""){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_personnel,"id","");

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=personnel&op=admin_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td><B><CENTER>Option</CENTER></B></td>
   <td><B><CENTER><?=_ADMIN_PERSONNEL_TABLE_NAME;?></CENTER></B></td>
	        <td><B><CENTER><?=_ADMIN_PERSONNEL_TABLE_POSISION;?></CENTER></B></td>
   <td><B><CENTER>Email</CENTER></B></td>
   <td><B><CENTER>tel</CENTER></B></td>
	    <td><B><CENTER><?=_ADMIN_FORM_CAT_ORDER;?></CENTER></B></td>
   <td><B><CENTER>Check</CENTER></B></td>
  </tr>  
<?
$res['user'] = $db->select_query("SELECT * FROM ".TB_personnel." ORDER BY sort  LIMIT $goto, $limit ");
$rows['user'] = $db->rows($res['user']);
$CATCOUNT = 0 ;
$count=0;
while($arr['user'] = $db->fetch($res['user'])){

	    $CATCOUNT ++ ;
	$row['groups'] = $db->num_rows(TB_personnel,"id","");
   //กำหนดการเปลี่ยนลำดับขึ้น
   $SETSORT_UP = $arr['user']['sort']-1;
   if($CATCOUNT == "1"){
	   $SETSORT_UP = "1" ;
   }
	//กำหนดการเปลี่ยนลำดับลง
   $SETSORT_DOWN = $arr['user']['sort']+1;
   if($CATCOUNT == $row['groups']){
	   $SETSORT_DOWN = $arr['user']['sort'] ;
   }
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=personnel&op=admin_edit&id=<? echo $arr['user']['id'];?>"><img src="images/icon/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=personnel&op=admin_del&id=<? echo $arr['user']['id'];?>','<?=_ADMIN_PERSONNEL_CON_DEL_MEM;?> : <?echo $arr['user']['p_name'];?>');"><img src="images/icon/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><A HREF="popup.php?name=personnel&file=popdetail&pid=<? echo $arr['user']['id'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 250} )" class="highslide">
	 <?echo $arr['user']['p_name'];?>
	 </a></td>
	      <td ><? echo $arr['user']['p_position'];?></td>
     <td ><? echo $arr['user']['p_mail'];?></td>
     <td ><? echo $arr['user']['p_tel'];?></td>
  
	 <td align="center" width="50"><A HREF="?name=admin&file=personnel&op=admin_edit&action=sort&setsort=<?echo $SETSORT_UP ;?>&move=up&id=<? echo $arr['user']['id'];?>"><IMG SRC="images/icon/arrow_up.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_UP;?>"></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=personnel&op=admin_edit&action=sort&setsort=<?echo $SETSORT_DOWN ;?>&move=down&id=<? echo $arr['user']['id'];?>"><IMG SRC="images/icon/arrow_down.gif"  BORDER="0" ALT="<?=_ADMIN_ORDER_DOWN;?>"></A></td>
     <td  align="center" width="40"><input type="checkbox" name="list[]" value="<? echo $arr['user']['id'];?>"></td>
    </tr>

<?
	$count++;
 } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=admin&file=personnel");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
	echo "<BR><BR>";

echo "<font color=#003399 size=2><b>"._PERSONNEL_MOD_DETAIL_SELECT_CAT."<b></font><br>";
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groupstext'] = $db->select_query("SELECT * FROM ".TB_personnel_group." ORDER BY gp_id ");
$i=1;
while ($arr['groupstext'] = $db->fetch($res['groupstext']))
   {
		echo "<font color=#990000 size=2><A HREF=\"?name=personnel&file=gdetail&id=".$arr['groupstext']['gp_id']."&op=gdetail&gr=".$arr['groupstext']['gp_name']."\"><B>".$i." : 
		</B>".$arr['groupstext']['gp_name']."</a></font><br>";
		$i++;
   }
$db->closedb ();

}
else if($op == "admin_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม User Admin Database
	if(CheckLevel($admin_user,$op)){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
	$res['admin'] = $db->select_query("SELECT p_name FROM ".TB_personnel." WHERE p_name='".$_POST['NAME']."' ");
	$rows['admin'] = $db->rows($res['admin']); 
	$db->closedb ();
		if($rows['admin']){
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_NAME_MEM." : ".$_POST['NAME']." "._ADMIN_PERSONNEL_MESSAGE_ERROR_ADD1."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>"._JAVA_FORM_BACK_EDIT."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}else{

		require("includes/class.resizepic.php");
		$FILESS = $_FILES['FILE'];
		$namepic=$FILESS['tmp_name'];
		$namepic_name=$FILESS['name'];
		$namepic_size=$FILESS['size'];
		$namepic_type=$FILESS['type'];

$size = getimagesize($FILESS['tmp_name']);
$sizezz=$size['0']*$size['1'];
$widths = $size['0'];
$heights = $size['1'];
if ($sizezz > _IPER_W*_IPER_H ) {
				$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/dangerous.png\" BORDER=\"0\"></A><BR><BR>";
				$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_PIC_WIDTH_LIMIT." "._IPER_W."  px. "._ADMIN_PERSONNEL_PIC_WIDTH_LIMIT1." "._IPER_H." px. "._ADMIN_PERSONNEL_PIC_WIDTH_LIMIT2." ".$size['0']." px "._ADMIN_PERSONNEL_PIC_WIDTH_LIMIT3." ".$size['1']." px </FONT><BR><BR>";
				$ProcessOutput .= "<A HREF=\"?name=admin&file=personnel\"><B>"._ADMIN_PERSONNEL_MESSAGE_GOBACK."</B></A>";
				$ProcessOutput .= "</CENTER>";
}  else {

if (($namepic_type=='image/jpg') || ($namepic_type=='image/jpeg') || ($namepic_type=='image/pjpeg')){

                copy($namepic, "images/personnel/".TIMESTAMP."_".$namepic_name.""); 
				$original_image = "images/personnel/".TIMESTAMP."_".$namepic_name."";
				$width = _IPERTHB_W ;
				$height = _IPERTHB_H ;
				$desired_width = $size['0'] ;
				$desired_height = $size['1'] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size['1']/$height;
					$imwidth=$size['0']/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/personnel/thb_".TIMESTAMP."_".$namepic_name."", "JPG");

				} else if (($namepic_type=='image/gif')){

                copy($namepic, "images/personnel/".TIMESTAMP."_".$namepic_name.""); 
				$original_image = "images/personnel/".TIMESTAMP."_".$namepic_name."";
				$width = _IPERTHB_W ;
				$height = _IPERTHB_H ;
				$desired_width = $size['0'] ;
				$desired_height = $size['1'] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size['1']/$height;
					$imwidth=$size['0']/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/personnel/thb_".TIMESTAMP."_".$namepic_name."", "GIF");
				} else if (($namepic_type=='image/x-png') || ($namepic_type=='image/png')){

                copy($namepic, "images/personnel/".TIMESTAMP."_".$namepic_name.""); 
				$original_image = "images/personnel/".TIMESTAMP."_".$namepic_name."";
				$width = _IPERTHB_W ;
				$height = _IPERTHB_H ;
				$desired_width = $size['0'] ;
				$desired_height = $size['1'] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size['1']/$height;
					$imwidth=$size['0']/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/personnel/thb_".TIMESTAMP."_".$namepic_name."", "PNG");
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
 $result = $db->select_query("SELECT count(*) as x FROM ".TB_personnel."  ");
 $numq = $db->fetch($result);
 $num=$numq['x'];
if ($FILESS['tmp_name'] !=''){
$pername="".TIMESTAMP."_".$namepic_name."";
}else {
$pername='';
}

if (empty($num)){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->add_db(TB_personnel,array(
				"p_name"=>"".$_POST['NAME']."",
				"p_position"=>"".$_POST['POST']."",
				"p_data"=>"".$_POST['DATAS']."",
				"p_add"=>"".$_POST['ADD']."",
				"p_tel"=>"".$_POST['TEL']."",
				"p_mail"=>"".$_POST['EMAIL']."",
				"sort"=>"1",
				"p_pic"=>"".$pername."",
				"boss"=>"".$_POST['BOSS'].""
			));
$id = mysql_insert_id();
} else {
$nums=$num+1;
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->add_db(TB_personnel,array(
				"p_name"=>"".$_POST['NAME']."",
				"p_position"=>"".$_POST['POST']."",
				"p_data"=>"".$_POST['DATAS']."",
				"p_add"=>"".$_POST['ADD']."",
				"p_tel"=>"".$_POST['TEL']."",
				"p_mail"=>"".$_POST['EMAIL']."",
				"sort"=>"".$nums."",
				"p_pic"=>"".$pername."",
				"boss"=>"".$_POST['BOSS'].""
			));
$id = mysql_insert_id();
}

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
  		for($i=0;$i<=(int)($_POST["LEVEL".$i]);$i++)
		{
			if($_POST["ORDER".$i] != "")
			{
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->add_db(TB_personnel_list,array(
				"g_id"=>"".$_POST['LEVEL'.$i]."",
				"u_id"=>"".$id."",
				"p_order"=>"".$_POST['ORDER'.$i]."",
				"p_detail"=>"".$_POST['DATA'.$i].""
			));
			}
		}
			$db->closedb ();
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_ADD_MEM."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"?name=admin&file=personnel\"><B>"._ADMIN_PERSONNEL_MESSAGE_GOBACK."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}
		}

	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "admin_add"){
	//////////////////////////////////////////// กรณีเพิ่ม User Admin Form
	if(CheckLevel($admin_user,$op)){
?>
<FORM METHOD=POST ACTION="?name=admin&file=personnel&op=admin_add&action=add" enctype="multipart/form-data" name="add">
<B><?=_PERSONNEL_MOD_DETAIL_NAME_FULL;?> :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="40"><BR>
<B><?=_PERSONNEL_MOD_DETAIL_POSITION;?> :</B><BR>
<INPUT TYPE="text" NAME="POST" size="50"><BR>
<B><?=_PERSONNEL_MOD_DETAIL_DATA;?> :</B><BR>
<INPUT TYPE="text" NAME="DATAS" size="50"><BR>
<B><?=_PERSONNEL_MOD_DETAIL_ADD;?> :</B><BR>
<INPUT TYPE="text" NAME="ADD" size="50"><BR>
<B>Telephone :</B><BR>
<INPUT TYPE="text" NAME="TEL" size="10"><BR>
<B>Email :</B><BR>
<INPUT TYPE="text" NAME="EMAIL" size="20"><BR>
<B><?=_PERSONNEL_MOD_DETAIL_CAT;?> :</B><BR>
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$i=1;
	$res['groups'] = $db->select_query("SELECT * FROM ".TB_personnel_group." order by gp_id ");
   while ($arr['groups'] = $db->fetch($res['groups']))
   {

		echo "<INPUT TYPE=text NAME=GROUP".$i." value=\"".$arr['groups']['gp_name']."\" readonly style=\"color: #FF0000\">";
		echo "<INPUT TYPE=hidden NAME=LEVEL".$i." value=\"".$arr['groups']['gp_id']."\" >";
?>
 <?=_PERSONNEL_MOD_DETAIL_DATAX_CAT;?> <INPUT TYPE="text" NAME="DATA<?=$i;?>" size="50" value=<?=$arr['x']['p_detail'];?>> <?=_ADMIN_PERSONNEL_FORM_ROW;?><INPUT TYPE="text" NAME="ORDER<?=$i;?>" size="10" value=<?=$arr['x']['p_order'];?>> <br>
 <?
	$i++;
   }


?>
<BR>
<?=_ADMIN_PERSONNEL_FORM_POSISION;?><input type=radio name=BOSS value=1><B><?=_ADMIN_PERSONNEL_FORM_POSISION_BOSS;?></B><input type=radio name=BOSS value=0><B><?=_ADMIN_PERSONNEL_FORM_POSISION_GELNERAL;?></B><br>
<B><?=_ADMIN_PERSONNEL_FORM_PIC;?> :</B><BR>
<INPUT TYPE="file" name="FILE" onpropertychange="view01.src=FILE.value;" size="40"><BR>
<BR><BR>
<INPUT TYPE="submit" value="<?=_ADMIN_PERSONNEL_BUTTON_NEW_ADD;?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "admin_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข User Admin Database Edit
	if(CheckLevel($admin_user,$op)){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->del(TB_personnel_list," u_id='".$_GET['id']."' "); 
  		for($i=0;$i<=(int)($_POST["LEVEL".$i]);$i++)
		{
			if($_POST["ORDER".$i] != "")
			{
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->add_db(TB_personnel_list,array(
				"g_id"=>"".$_POST['LEVEL'.$i]."",
				"u_id"=>"".$_GET['id']."",
				"p_order"=>"".$_POST['ORDER'.$i]."",
				"p_detail"=>"".$_POST['DATA'.$i].""
			));
			}
		}
	//ตรวจสอบมี user นี้หรือยัง
	$res['admin'] = $db->select_query("SELECT p_name,id FROM ".TB_personnel." WHERE p_name='".$_POST['name']."' and id !='".$_GET['id']."' ");
	$rows['admin'] = $db->rows($res['admin']);
	$ids=$rows['admin']['id'];
	$db->closedb ();
		$FILESS = $_FILES['FILE'];
		$namepic=$FILESS['tmp_name'];
		$namepic_name=$FILESS['name'];
		$namepic_size=$FILESS['size'];
		$namepic_type=$FILESS['type'];

		if($rows['admin']) {
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_ERROR_ADD." ".$_POST['NAME']." "._ADMIN_PERSONNEL_MESSAGE_ERROR_ADD1."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>"._JAVA_FORM_BACK_EDIT."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}else {
			
if ($FILESS['tmp_name'] !="") {
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['personnel'] = $db->select_query("SELECT * FROM ".TB_personnel." WHERE id='".$_GET['id']."' ");
		$arr['personnel'] = $db->fetch($res['personnel']);
		$picture=$arr['personnel']['p_pic'];
		if ($picture !=''){
		@unlink("images/personnel/".$picture."");
		@unlink("images/personnel/thb_".$picture."");
		}

require("includes/class.resizepic.php");
$size = getimagesize($FILESS['tmp_name']);
$sizezz=$size['0']*$size['1'];
$widths = $size['0'];
$heights = $size['1'];

if ($sizezz > _IPER_W*_IPER_H ) {
				$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/dangerous.png\" BORDER=\"0\"></A><BR><BR>";
				$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_PIC_WIDTH_LIMIT."</FONT><BR><BR>";
				$ProcessOutput .= "<A HREF=\"?name=admin&file=personnel\"><B>"._ADMIN_PERSONNEL_MESSAGE_GOBACK."</B></A>";
				$ProcessOutput .= "</CENTER>";

}  else {
if (($namepic_type=='image/jpg') || ($namepic_type=='image/jpeg') || ($namepic_type=='image/pjpeg')){

                copy($namepic, "images/personnel/".TIMESTAMP."_".$namepic_name.""); 
				$original_image = "images/personnel/".TIMESTAMP."_".$namepic_name."";
				$width = _IPERTHB_W ;
				$height = _IPERTHB_H ;
				$desired_width = $size['0'] ;
				$desired_height = $size['1'] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size['1']/$height;
					$imwidth=$size['0']/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/personnel/thb_".TIMESTAMP."_".$namepic_name."", "JPG");

				} else if (($namepic_type=='image/gif')){

                copy($namepic, "images/personnel/".TIMESTAMP."_".$namepic_name.""); 
				$original_image = "images/personnel/".TIMESTAMP."_".$namepic_name."";
				$width = _IPERTHB_W ;
				$height = _IPERTHB_H ;
				$desired_width = $size['0'] ;
				$desired_height = $size['1'] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size['1']/$height;
					$imwidth=$size['0']/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/personnel/thb_".TIMESTAMP."_".$namepic_name."", "GIF");
				} else if (($namepic_type=='image/x-png') || ($namepic_type=='image/png')){

                copy($namepic, "images/personnel/".TIMESTAMP."_".$namepic_name.""); 
				$original_image = "images/personnel/".TIMESTAMP."_".$namepic_name."";
				$width = _IPERTHB_W ;
				$height = _IPERTHB_H ;
				$desired_width = $size['0'] ;
				$desired_height = $size['1'] ;
				if ($desired_width > $width ) {
					$im=$desired_width/$width;
					$imheight=$desired_height/$im;
				$image = new hft_image($original_image);
				$image->resize($width,$imheight,  '0');
				} else {
					$im=$size['1']/$height;
					$imwidth=$size['0']/$im;
				$image = new hft_image($original_image);
				$image->resize($imwidth,$height,  '0');
				}
				$image->output_resized("images/personnel/thb_".TIMESTAMP."_".$namepic_name."", "PNG");
}
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->update_db(TB_personnel,array(
				"p_name"=>"".$_POST['NAME']."",
				"p_position"=>"".$_POST['POST']."",
				"p_data"=>"".$_POST['DATAS']."",
				"p_add"=>"".$_POST['ADD']."",
				"p_tel"=>"".$_POST['TEL']."",
				"p_mail"=>"".$_POST['EMAIL']."",
				"p_pic"=>"".TIMESTAMP."_".$FILESS['name']."",
				"boss"=>"".$_POST['BOSS'].""
			)," id='".$_GET['id']."' ");
			$db->closedb ();
						$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_EDIT_MEM."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"?name=admin&file=personnel\"><B>"._ADMIN_PERSONNEL_MESSAGE_GOBACK."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
}

		} else {
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->update_db(TB_personnel,array(
				"p_name"=>"".$_POST['NAME']."",
				"p_position"=>"".$_POST['POST']."",
				"p_data"=>"".$_POST['DATAS']."",
				"p_add"=>"".$_POST['ADD']."",
				"p_tel"=>"".$_POST['TEL']."",
				"p_mail"=>"".$_POST['EMAIL']."",
				"boss"=>"".$_POST['BOSS'].""
			)," id='".$_GET['id']."' ");
		$db->closedb ();
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_EDIT_MEM."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"?name=admin&file=personnel\"><B>"._ADMIN_PERSONNEL_MESSAGE_GOBACK."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}

}
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "admin_edit" AND $action == "sort"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['block'] = $db->select_query("SELECT * FROM ".TB_personnel." WHERE id='".$_GET['id']."' ");
		$arr['block'] = $db->fetch($res['block']);
		$db->closedb ();

		//กรณีเลื่อนขึ้น
		if($_GET['move'] == "up"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_personnel." SET sort = sort+1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_personnel." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		if($_GET['move'] == "down"){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETD'] = "UPDATE ".TB_personnel." SET sort = sort-1 WHERE sort = '".$_GET['setsort']."' ";
			$sql['SETD'] = mysql_query ( $q['SETD'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();

			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$q['SETU'] = "UPDATE ".TB_personnel." SET sort = '".$_GET['setsort']."' WHERE id = '".$_GET['id']."' ";
			$sql['SETU'] = mysql_query ( $q['SETU'] ) or sql_error ( "db-query",mysql_error() );
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_EDIT_ORDER_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=personnel\"><B>"._ADMIN_PERSONNEL_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "admin_edit"){
	//////////////////////////////////////////// กรณีแก้ไข User Admin Edit Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่าของบุคลากรออกมา
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['admin'] = $db->select_query("SELECT * FROM ".TB_personnel." WHERE id='".$_GET['id']."' ");
		$arr['admin'] = $db->fetch($res['admin']);
		$db->closedb ();
		//ไม่ให้อัพเดทตัวเอง
		if($admin_user == $arr['admin']['name']){
			$Readonly = " readonly ";
		}
?>
<FORM METHOD=POST ACTION="?name=admin&file=personnel&op=admin_edit&action=edit&id=<?=$_GET['id'];?>" enctype="multipart/form-data" name="edit">

<B><?=_PERSONNEL_MOD_DETAIL_NAME_FULL;?> :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="40" VALUE="<?=$arr['admin']['p_name'];?>"><BR>
<B><?=_PERSONNEL_MOD_DETAIL_POSITION;?> :</B><BR>
<INPUT TYPE="text" NAME="POST" size="50" VALUE="<?=$arr['admin']['p_position'];?>"><BR>
<B><?=_PERSONNEL_MOD_DETAIL_DATA;?> :</B><BR>
<INPUT TYPE="text" NAME="DATAS" size="50" VALUE="<?=$arr['admin']['p_data'];?>"><BR>
<B><?=_PERSONNEL_MOD_DETAIL_ADD;?> :</B><BR>
<INPUT TYPE="text" NAME="ADD" size="50" VALUE="<?=$arr['admin']['p_add'];?>"><BR>
<B>Telephone :</B><BR>
<INPUT TYPE="text" NAME="TEL" size="10" VALUE="<?=$arr['admin']['p_tel'];?>"><BR>
<B>Email :</B><BR>
<INPUT TYPE="text" NAME="EMAIL" size="20" VALUE="<?=$arr['admin']['p_mail'];?>"><BR>
<B><?=_PERSONNEL_MOD_DETAIL_CAT;?> :</B><BR>
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$i=1;
	$res['groups'] = $db->select_query("SELECT * FROM ".TB_personnel_group." order by gp_id ");
   while ($arr['groups'] = $db->fetch($res['groups']))
   {


	   	$res['x'] = $db->select_query("SELECT * FROM ".TB_personnel_list." where g_id='".$arr['groups']['gp_id']."' and u_id='".$arr['admin']['id']."' ");
		$arr['x'] = $db->fetch($res['x']);
		echo "<INPUT TYPE=text NAME=GROUP".$i." value=\"".$arr['groups']['gp_name']."\" readonly style=\"color: #FF0000\">";
		echo "<INPUT TYPE=hidden NAME=LEVEL".$i." value=\"".$arr['groups']['gp_id']."\" >";
?>
 <?=_PERSONNEL_MOD_DETAIL_DATAX_CAT;?> <INPUT TYPE="text" NAME="DATA<?=$i;?>" size="50" value=<?=$arr['x']['p_detail'];?>> <?=_ADMIN_PERSONNEL_FORM_ROW;?> <INPUT TYPE="text" NAME="ORDER<?=$i;?>" size="10" value=<?=$arr['x']['p_order'];?>> <br>
 <?
$i++;

}
?>
<BR>
<?=_ADMIN_PERSONNEL_FORM_POSISION;?><input type=radio name=BOSS VALUE=1 <? if ($arr['admin']['boss']==1) { echo "checked"; } ?>><B><?=_ADMIN_PERSONNEL_FORM_POSISION_BOSS;?></B><input type=radio name=BOSS value=0 <? if ($arr['admin']['boss']==0) { echo "checked"; } ?>><B><?=_ADMIN_PERSONNEL_FORM_POSISION_GELNERAL;?></B><br>
<B><?=_ADMIN_PERSONNEL_FORM_PIC;?> :</B><BR>
<INPUT TYPE="file" name="FILE" onpropertychange="view01.src=FILE.value;" size="40"><BR>
<BR><BR>
<INPUT TYPE="hidden" NAME="id" size="40" VALUE="<?=$arr['admin']['id'];?>">
<INPUT TYPE="hidden" NAME="pic" size="40" VALUE="<?=$arr['admin']['p_pic'];?>">
<INPUT TYPE="hidden" NAME="NAME_OLD" size="40" VALUE="<?=$arr['admin']['name'];?>">
<INPUT TYPE="submit" value="<?=_ADMIN_PERSONNEL_FORM_BUTTON_EDIT;?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
}
else if($op == "admin_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ User Admin Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['personnel'] = $db->select_query("SELECT * FROM ".TB_personnel." WHERE id='".$value."' ");
		$arr['personnel'] = $db->fetch($res['personnel']);
		$picture=$arr['personnel']['p_pic'];
		if ($picture !=''){
		@unlink("images/personnel/".$picture."");
		@unlink("images/personnel/thb_".$picture."");
		}
		$row['user'] = $db->num_rows(TB_personnel_list,"id"," u_id=".$arr['personnel']['id']." ");
		if ($row['user']){
		$db->del(TB_personnel_list," u_id='".$arr['personnel']['id']."' "); 
		}
			$db->del(TB_personnel," id='".$value."' "); 
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_DEL_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=personnel\"><B>"._ADMIN_PERSONNEL_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "admin_del"){
	//////////////////////////////////////////// กรณีลบ User Admin Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['personnel'] = $db->select_query("SELECT * FROM ".TB_personnel." WHERE id='".$_GET['id']."' ");
		$arr['personnel'] = $db->fetch($res['personnel']);
		$picture=$arr['personnel']['p_pic'];
		if ($picture !=''){
		@unlink("images/personnel/".$picture."");
		@unlink("images/personnel/thb_".$picture."");
		}
		$row['user'] = $db->num_rows(TB_personnel_list,"id"," u_id=".$arr['personnel']['id']." ");
		if ($row['user']){
		$db->del(TB_personnel_list," u_id='".$arr['personnel']['id']."' "); 
		}
		$db->del(TB_personnel," id='".$_GET['id']."' "); 

		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_PERSONNEL_MESSAGE_DEL_MEM."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=personnel\"><B>"._ADMIN_PERSONNEL_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
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
