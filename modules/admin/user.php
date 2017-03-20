<?
CheckAdmin($admin_user, $admin_pwd);
include ("editor.php");
$year=date('Y');
$yearlast=$year+488;
$Year = date("Y")+544;
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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_USER_MENU_TITLE;?></B>
					<BR><BR>
<A HREF="?name=admin&file=user"><IMG SRC="images/admin/admins.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_USER_MENU_LIST;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=user&op=admin_add"><IMG SRC="images/admin/user.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_USER_MENU_ADD_NEW;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=groups"><IMG SRC="images/admin/keys.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_USER_MENU_LEVEL;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=groups&op=group_add"><IMG SRC="images/admin/share.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_USER_MENU_ADD_LEVEL;?></A>
<BR><BR>
<!-- แสดงผลรายการผู้ดูแลระบบ -->
<?
//////////////////////////////////////////// แสดงรายชื่อผู้ดูแลระบบ
if($op == ""){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_ADMIN,"id","");

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=user&op=admin_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td><B><CENTER>Option</CENTER></B></td>
   <td><B><CENTER><?=_ADMIN_USER_TABLE_HEADER_USER;?></CENTER></B></td>
   <td><B><CENTER><?=_ADMIN_USER_TABLE_HEADER_NAME;?></CENTER></B></td>
   <td><B><CENTER>Email</CENTER></B></td>
   <td><B><CENTER>Level</CENTER></B></td>
   <td><B><CENTER>Check</CENTER></B></td>
  </tr>  
<?
$res['user'] = $db->select_query("SELECT * FROM ".TB_ADMIN." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['user'] = $db->fetch($res['user'])){
	$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." WHERE id='".$arr['user']['level']."' ");
	$arr['groups'] = $db->fetch($res['groups']);
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
?>

    <tr <?php echo $ColorFill; ?> >
     <td width="48">
      <a href="?name=admin&file=user&op=admin_edit&user=<? echo $arr['user']['username'];?>&id=<? echo $arr['user']['id'];?>"><img src="images/icon/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=user&op=admin_del&id=<? echo $arr['user']['id'];?>','<?=_ADMIN_PERSONNEL_CON_DEL_MEM;?> : <?echo $arr['user']['username'];?>');"><img src="images/icon/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><?echo $arr['user']['username'];?></td>
     <td ><? echo $arr['user']['name'];?></td>
     <td ><? echo $arr['user']['email'];?></td>
     <td ><? echo $arr['groups']['name'];?></td>
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
	SplitPage($page,$totalpage,"?name=admin&file=user");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
	echo "<BR><BR>";

$res['groupstext'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ORDER BY id ");
while ($arr['groupstext'] = $db->fetch($res['groupstext']))
   {
		echo "<LI><B>".$arr['groupstext']['name']." : </B>".$arr['groupstext']['description']."</LI>";
   }
$db->closedb ();

}
else if($op == "admin_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม User Admin Database
	if(CheckLevel($admin_user,$op)){

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
	$res['admin'] = $db->select_query("SELECT id FROM ".TB_ADMIN." WHERE username='".$_POST['USERNAME']."' ");
	$rows['admin'] = $db->rows($res['admin']); 
	$db->closedb ();

		if($rows['admin']){
			$ProcessOutput .= "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_USER_MEASSAGE_USERNAME." : ".$_POST['USERNAME']." "._ADMIN_USER_MEASSAGE_USER_NOADD."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>"._JAVA_FORM_BACK_EDIT."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}else{
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['mem'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE id=".$_POST['USERNAME']." ");
	$arr['mem'] = $db->fetch($res['mem']);

	$res['level'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." WHERE id=".$_POST['LEVEL']." ");
	$arr['level'] = $db->fetch($res['level']);

//ทำการเพิ่มข้อมูลลงดาต้าเบส
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->add_db(TB_ADMIN,array(
				"username"=>"".$arr['mem']['user']."",
				"password"=>"".$arr['mem']['password']."",
				"name"=>"".$arr['mem']['name']."",
				"email"=>"".$arr['mem']['email']."",
				"level"=>"".$arr['level']['id']."",
				"picture"=>"".$arr['mem']['member_pic'].""
			));
			$db->closedb ();
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_USER_MESSAGE_ADD."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"?name=admin&file=user\"><B>"._ADMIN_USER_MESSAGE_GOBACK."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}


	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "admin_add" AND $action == "multiadd"){
	//////////////////////////////////////////// กรณีลบ User Admin Multi
if(CheckLevel($admin_user,$op)){
$votesx = $_POST['levels']; 
$level = array_diff($votesx,array(0));
//sort($level,SORT_NUMERIC);
//echo '<pre>';print_r($level);echo '</pre>';
$num=count($_POST['list']);

if ($num !=0){

for ( $i = 0 ; $i < $num ; $i++ ) {
list($key, $levelx) = each ($level);
//echo $levelx;
list($key, $value) = each ($_POST['list']);

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['mem'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE id='".$value."' ");
$arr['mem'] = $db->fetch($res['mem']);

$username=$arr['mem']['user'];
$password= $arr['mem']['password'];
$name= $arr['mem']['name'];
$email= $arr['mem']['email'];
$picture= $arr['mem']['member_pic'];

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$db->add_db(TB_ADMIN,array(
	"username"=>"".$username."",
	"password"=>"".$password."",
	"name"=>"".$name."",
	"email"=>"".$email."",
	"level"=>"".$levelx."",
	"picture"=>"".$picture.""
	));
	$db->closedb ();

}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_USER_MESSAGE_ADD."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=user&op=admin_add\"><B>"._ADMIN_USER_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
} else {
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_USER_MESSAGE_NO_SELECT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=user\"><B>"._ADMIN_USER_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

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
<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$q = "SELECT * FROM ".TB_MEMBER." ORDER BY id ";
//$q.=" ORDER BY id DESC   ";
//$qr=mysql_query($q);
$e_page=20 ; 
if(empty($_GET['s_page'])){   
	$_GET['s_page']=0;
	$chk_page=$_GET['s_page'];
	$s_page=$_GET['s_page'];
}else{   
	$chk_page=$_GET['s_page'];     
	$_GET['s_page']=$_GET['s_page']*$e_page;   
		$s_page=$_GET['s_page'];
}
$qr= $db->select_query("select * from ".TB_MEMBER." ORDER BY id limit ".$_GET['s_page'].",".$e_page."");
$total=$db->num_rows(TB_MEMBER,"id","");



if($rows2  >=1){   
	$plus_p=($chk_page*$e_page)+$rows2 ;   
}else{   
	$plus_p=($chk_page*$e_page);       
}   
$total_p=ceil($total/$e_page);   
$before_p=($chk_page*$e_page)+1;  
?>

 <form action="?name=admin&file=user&op=admin_add&action=multiadd" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td><B><CENTER>select</CENTER></B></td>
   <td><B><CENTER>username</CENTER></B></td>
   <td><B><CENTER><?=_ADMIN_USER_TABLE_HEADER_NAME;?></CENTER></B></td>
   <td><B><CENTER>Email</CENTER></B></td>
   <td><B><CENTER><?=_ADMIN_USER_MEASSAGE_SELECT_GR;?></CENTER></B></td>
  </tr>
<?php
$i=1;
 $count=0;
while($rs=$db->fetch($qr)){
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
$count++;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$res['ad'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username ='".$rs['user']."' ");
//	$as['ad'] =$db->rows($res['ad']);
	$arr['ad'] = $db->fetch($res['ad']);
?>  
    <tr <? echo $ColorFill; ?> >
     <td  align="center"><?php if($arr['ad']['username']==''){ echo "<input type=\"checkbox\" name=\"list[]\" value=\"".$rs['id']."\" id=list[]>";} else {?>
      <a href="?name=admin&file=user&op=admin_edit&id=<? echo $arr['ad']['id'];?>"><img src="images/tick.png" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=user&op=admin_del&id=<? echo $arr['ad']['id'];?>','<?=_ADMIN_USER_MESSAGE_DEL_CON;?> : <?echo $arr['user']['username'];?>');"><img src="images/publish_x.png"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a><?php }?></td> 
     <td><?echo $rs['user'];?></td>
     <td ><? echo $rs['name'];?></td>
     <td ><? echo $rs['email'];?></td>
     <td >
<?php if($arr['ad']['username'] !=''){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groupsx'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." where id='".$arr['ad']['level']."' ");
$arr['groupsx'] = $db->fetch($res['groupsx']);
echo $arr['groupsx']['name'];
	 }else{ ?>
<SELECT NAME="levels[]"  id="levels[]" >
<option value="0"><?=_ADMIN_USER_MEASSAGE_SELECT_GR;?></option>
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ORDER BY id ");
   while ($arr['groups'] = $db->fetch($res['groups']))
   {
		echo "<option value=\"".$arr['groups']['id']."\">".$arr['groups']['name']."</option>";
   }
$db->closedb ();
?>
</SELECT><?php } ?>&nbsp;&nbsp;
</td>
</tr>
<?php $i++; } ?>
</table>

<?php if($total>0){ ?>
<div class="browse_page">
 <?php   
  page_navigator("admin","user&op=admin_add","",$before_p,$plus_p,$total,$total_p,$chk_page);    
  ?> 
</div>
<?php } ?>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="submit" value="Add" onclick="return addConfirm(document.myform)">
 </div>
 </form>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "admin_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข User Admin Database Edit
	if(CheckLevel($admin_user,$op)){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	//ตรวจสอบมี user นี้หรือยัง
	$res['admin'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$_POST['USERNAME']."' and member_id !='".$_POST['member_id']."' ");
	$rows['admin'] = $db->rows($res['admin']); 
	$db->closedb ();
		if($rows['admin'] AND ($_POST['USERNAME'] != $_POST['USERNAME_OLD'])){
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\"><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_USER_MEASSAGE_USERNAME." : ".$_POST['USERNAME']." "._ADMIN_USER_MEASSAGE_USER_NOADD."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>"._JAVA_FORM_BACK_EDIT."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";
		}else{
			if($_POST['PASSWORD']){
				$NewPass = md5($_POST['PASSWORD']);
			}else{
				$NewPass = $_POST['oldpass'];
			}

		if ($_FILES['FILE']['tmp_name'] !="") {

$sql = "select member_pic from ".TB_MEMBER." where member_pic='".$_FILES['FILE']['name']."'" ;
$result = mysql_query($sql) ;
$numrow = mysql_num_rows($result) ;
if($numrow !=0) {
$showmsg="<br><br><center><font size='3' face='MS Sans Serif'>"._MEMBER_MOD_FORM_IMAGES_DENIED."<br><br><input type='button' value='"._MEMBER_MOD_FORM_JAVA_RETERN."' onclick='history.back();'></center>" ;
	showerror($showmsg);
	exit();
//	echo"<meta http-equiv=\"refresh\" content=\"3;URL=?name=member\" />";
}
		require("includes/class.resizepic.php");
		$FILE = $_FILES['FILE'];
		$namepic=$_FILES['FILE']['tmp_name'];
		$namepic_name=$_FILES['FILE']['name'];
		$namepic_size=$_FILES['FILE']['size'];
		$namepic_type=$_FILES['FILE']['type'];

	$size = getimagesize($FILE['tmp_name']);
	$sizezz=$size[0]*$size[1];
	$widths = $size[0];
	$heights = $size[1];
	if ( $FILE['size'] > _MEMBER_LIMIT_UPLOAD ) {
	$showmsg="<br><br><center><font size='3' face='MS Sans Serif'><b>"._ADMIN_USER_MESSAGE_LIMIT_PIC." ".(_MEMBER_LIMIT_UPLOAD/1024)." kB "._ADMIN_USER_MESSAGE_LIMIT_PIC1."</b></font><br><br><input type='button' value='"._JAVA_FORM_BACK_COME."' onclick='history.back();'></center>" ;
	showerror($showmsg);
} else {
if (($FILE['type']=='image/jpg') || ($FILE['type']=='image/jpeg') || ($FILE['type']=='image/pjpeg')){
			$filepic=$FILE['tmp_name'];
			@copy ($FILE['tmp_name'] , "icon/admin_".TIMESTAMP."_".$namepic_name."");
			$original_image = "icon/admin_".TIMESTAMP."_".$namepic_name."" ;
			$desired_width = _Iadmin_W ;
			$desired_height = _Iadmin_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/admin_".TIMESTAMP."_".$namepic_name."", "JPG");
			$Filenames="admin_".TIMESTAMP."_".$namepic_name." ";
} else if (($FILE['type']=='image/gif')){
			$filepic=$FILE['tmp_name'];
			@copy ($FILE['tmp_name'] , "icon/admin_".TIMESTAMP."_".$namepic_name."");
			$original_image = "icon/admin_".TIMESTAMP."_".$namepic_name."" ;
			$desired_width = _Iadmin_W ;
			$desired_height = _Iadmin_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/admin_".TIMESTAMP."_".$namepic_name."", "GIF");
			$Filenames="admin_".TIMESTAMP."_".$namepic_name." ";

} else if (($FILE['type']=='image/x-png')){
			$filepic=$FILE['tmp_name'];
			@copy ($FILE['tmp_name'] , "icon/admin_".TIMESTAMP."_".$namepic_name."");
			$original_image = "icon/admin_".TIMESTAMP."_".$namepic_name."" ;
			$desired_width = _Iadmin_W ;
			$desired_height = _Iadmin_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/admin_".TIMESTAMP."_".$namepic_name."", "PNG");
			$Filenames="admin_".TIMESTAMP."_".$namepic_name." ";
} else {
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC1."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.go(-1)</script>";
		//	echo "$namepic_name<br>";
			exit();
		}

}
			//ทำการเพิ่มข้อมูลลงดาต้าเบส
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->update_db(TB_ADMIN,array(
				"username"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['name']."",
				"email"=>"".$_POST['email']."",
				"level"=>"".$_POST['LEVEL']."",
				"picture"=>"".$Filenames.""
			)," id='".$_GET['id']."' ");
			$db->update_db(TB_MEMBER,array(
				"user"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['name']."",
				"sex"=>"".$_POST['sex']."",
				"email"=>"".$_POST['email']."",
				"date"=>"".$_POST['date']."",
				"month"=>"".$_POST['month']."",
				"year"=>"".$_POST['year']."",
				"work"=>"".$_POST['work']."",
				"age"=>"".$_POST['age']."",
				"address"=>"".$_POST['address']."",
				"amper"=>"".$_POST['amper']."",
				"province"=>"".$_POST['province']."",
				"zipcode"=>"".$_POST['zipcode']."",
				"phone"=>"".$_POST['phone']."",
				"education"=>"".$_POST['education']."",
				"office"=>"".$_POST['office']."",
				"signature"=>"".$_POST['signature']."",
				"nic_name"=>"".$_POST['nic_name']."",
				"member_pic"=>"".$Filenames.""
			)," member_id='".$_POST['member_id']."' ");

		} else {
			//ทำการเพิ่มข้อมูลลงดาต้าเบส
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->update_db(TB_ADMIN,array(
				"username"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['name']."",
				"email"=>"".$_POST['email']."",
				"level"=>"".$_POST['LEVEL'].""
			)," id='".$_GET['id']."' ");
			$db->update_db(TB_MEMBER,array(
				"user"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['name']."",
				"sex"=>"".$_POST['sex']."",
				"email"=>"".$_POST['email']."",
				"date"=>"".$_POST['date']."",
				"month"=>"".$_POST['month']."",
				"year"=>"".$_POST['year']."",
				"work"=>"".$_POST['work']."",
				"age"=>"".$_POST['age']."",
				"address"=>"".$_POST['address']."",
				"amper"=>"".$_POST['amper']."",
				"province"=>"".$_POST['province']."",
				"zipcode"=>"".$_POST['zipcode']."",
				"phone"=>"".$_POST['phone']."",
				"education"=>"".$_POST['education']."",
				"office"=>"".$_POST['office']."",
				"signature"=>"".$_POST['signature']."",
				"nic_name"=>"".$_POST['nic_name'].""
			)," member_id='".$_POST['member_id']."' ");

		}
			$db->closedb ();
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_USER_MESSAGE_EDIT."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"?name=admin&file=logout\"><B>"._ADMIN_USER_MESSAGE_CHPASS_GOBACK."</B></A><br><br>";
			$ProcessOutput .= "<A HREF=\"?name=admin&file=main\"><B>"._ADMIN_USER_MESSAGE_CHPASS_USER."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";

		}


	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "admin_edit"){
	//////////////////////////////////////////// กรณีแก้ไข User Admin Edit Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่าของผู้ดูแลระบบออกมา
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE id='".$_GET['id']."' ");
		$arr['admin'] = $db->fetch($res['admin']);

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//$login_true=$_SESSION['login_true'];
	$result = mysql_query("select * from ".TB_MEMBER." where user='".$_GET['user']."' ") or die ("Err Can not to result") ;
	$dbarr = mysql_fetch_array($result) ;
	$db->closedb ();

function mosMakePassword($length) {
	$salt = "abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789";
	$len = strlen($salt);
	$makepass="";
	mt_srand(10000000*(double)microtime());
	for ($i = 0; $i < $length; $i++)
	$makepass .= $salt[mt_rand(0,$len - 1)];
	return $makepass;
}

?>
          <BR>
              <DIV ALIGN="left">
                <P>&nbsp;&nbsp;<STRONG><FONT SIZE="4"><IMG SRC="images/human.gif" ></FONT></STRONG> <FONT COLOR="#FF3300" SIZE="4"><u><STRONG><?=_ADMIN_USER_FORM_EDIT_TITLE;?> <?php echo $dbarr['user'] ; ?></STRONG></u></FONT></P>
              </DIV>            
            <DIV ALIGN="left">
              <FORM NAME="checkForm" ACTION="?name=admin&file=user&op=admin_edit&action=edit&id=<?=$_GET['id'];?>" METHOD="post" onSubmit="return check2();" ENCTYPE="multipart/form-data">
                <TABLE WIDTH="100%" BORDER="0" CELLSPACING="5" CELLPADDING="0">
				<tr>
				<td ALIGN="right"><B><?=_ADMIN_USER_TABLE_HEADER_USER;?> :</B></td><td><INPUT TYPE="text" NAME="USERNAME" size="30" VALUE="<?=$dbarr['user'];?>">
				<INPUT TYPE="hidden" NAME="USERNAME_OLD" VALUE="<?=$dbarr['user'];?>">
				</td>
				<td ALIGN="right" WIDTH="18%"><B><?=_ADMIN_USER_FORM_EDIT_PASSWORD;?> :</B></td><td><INPUT TYPE="text" NAME="PASSWORD" size="30" VALUE="">
				<INPUT TYPE="hidden" NAME="oldpass" value="<?=$arr['admin']['password'];?>">
				</td>
				</tr>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><B>Level :</B></TD>
                    <TD WIDTH="32%"><SELECT NAME="LEVEL">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['groups'] = $db->select_query("SELECT * FROM ".TB_ADMIN_GROUP." ORDER BY id ");
   while ($arr['groups'] = $db->fetch($res['groups']))
   {
		echo "<option value=\"".$arr['groups']['id']."\" ";
		if($arr['groups']['id'] == $arr['admin']['level']){echo " Selected";};
		echo ">".$arr['groups']['name']."</option>";
   }
$db->closedb ();
?>
</SELECT></TD>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_MEMPIC;?> : </FONT></STRONG></TD>
                    <TD WIDTH="38%" ROWSPAN="5" VALIGN="top"><?
					//Show Picture
					if($dbarr['member_pic']){
						$postpicupload = @getimagesize ("icon/".$dbarr[member_pic]."");
						if ( $postpicupload[0] > _MEMBER_LIMIT_PICWIDTH ) {
							$PicUpload = "<img src='icon/".$dbarr['member_pic']."' width='"._MEMBER_LIMIT_PICWIDTH."' border='1' ALIGN='absbottom' class='membericon'>	<br><br>"._MEMBER_MOD_MEMDETAIL_MEMPIC_NOW." ".$dbarr['member_pic']."<BR>";
							}else{
							$PicUpload = "<img src='icon/".$dbarr['member_pic']."' border='1' ALIGN='absbottom' class='membericon'>							<br><br>"._MEMBER_MOD_MEMDETAIL_MEMPIC_NOW." ".$dbarr['member_pic']."<BR>";
							}
						echo $PicUpload ;
					}else{ echo ""._MEMBER_MOD_MEMDETAIL_MEMPIC_NULL." "; };
					?> 
                      <INPUT NAME="member_pic" TYPE="hidden" VALUE="<?php echo $dbarr['member_pic'] ;?>" >
                    </FONT>&nbsp;
                    </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_NAME;?> : </FONT></STRONG></TD>
                    <TD>
                      <INPUT NAME="name" TYPE="text"  size="20" VALUE="<?php echo "$dbarr[name]" ; ?>">
                    </FONT></TD>
                    <TD ALIGN="right">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_BIRTDAY;?> : </FONT></STRONG></TD>
                    <TD>
<?
$dt=date('d');
$mt=date('m');
$yy=date('Y');
$yt=$yy+543;
echo "<SELECT name=date>
		<option >--</option>";
for($i=1;$i<32;$i++){
echo 	"<option value=$i ";
if($dbarr['date']=="$i"){ echo "selected" ; }
echo ">$i</option>";
}
echo "</select>";
$vmont  = array(_F_Month_1, _F_Month_2, _F_Month_3, _F_Month_4, _F_Month_5, _F_Month_6, _F_Month_7, _F_Month_8, _F_Month_9, _F_Month_10, _F_Month_11, _F_Month_12);
echo "<select  name=month size=1>
		<option >------------</option>";
for($ix=0;$ix<count($vmont);$ix++){
$ss=$ix+1;
echo 	"<option value=$ss ";
if($dbarr['month']=="$ss"){ echo "selected" ; }
echo ">$vmont[$ix]</option>";
}
echo "</select>";

echo "<select  name=year size=1>";
for($a=$yearlast;$a<$Year;$a++){
echo 	"<option value=$a ";
if($dbarr['year']=="$a"){ echo "selected" ; }
echo ">$a</option>";
}
echo "</select>";

?>
</TD>
                     <TD ALIGN="right">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><? echo _MEMBER_MOD_MEMDETAIL_SEX;?> : </FONT></STRONG></TD>
                    <TD>
                      <INPUT NAME="sex" TYPE="radio" VALUE="<? echo _MEMBER_MOD_FORM_SEX_MAN;?>" <?php if($dbarr['sex']==_MEMBER_MOD_FORM_SEX_MAN) { echo "checked" ;}  ?>>
                <? echo _MEMBER_MOD_FORM_SEX_MAN;?> &nbsp;
                <INPUT NAME="sex" TYPE="radio" VALUE="<? echo _MEMBER_MOD_FORM_SEX_GIRL;?>" <?php if($dbarr['sex']==_MEMBER_MOD_FORM_SEX_GIRL) { echo "checked" ;}  ?>>
                <? echo _MEMBER_MOD_FORM_SEX_GIRL;?>&nbsp;&nbsp;</FONT></TD>
                    <TD ALIGN="right">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><? echo _MEMBER_MOD_FORM_EDUCATION;?> : </FONT></STRONG></TD>
                    <TD>
<?
$education  = array(_EDU_1, _EDU_2, _EDU_3, _EDU_4, _EDU_5, _EDU_6, _EDU_7);
echo "<select  name=education size=1 >
		<option >------------</option>";
for($i=0;$i<count($education);$i++){
echo 	"<option value=$education[$i] ";
if($dbarr['education']=="$education[$i]"){ echo "selected" ; }
echo ">".$education[$i]."</option>";
}
echo "</select>";
?>
                    </FONT></TD>
                    <TD ALIGN="right">&nbsp;</TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_ADDRESS;?> : </FONT></STRONG></TD>
                    <TD>
                      <INPUT NAME="address" TYPE="text" VALUE="<?php echo $dbarr['address'] ; ?>">
                    </FONT></TD>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_MEMPIC;?> : </FONT></STRONG></TD>
                    <TD WIDTH="38%"><INPUT TYPE="file" NAME="FILE" STYLE="width:250" CLASS="inputform">
                        <FONT COLOR="#FF0000">
						<BR>Limit  <?=(_MEMBER_LIMIT_UPLOAD/1024);?> kb </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_AMP;?> : </FONT></STRONG></TD>
                    <TD>
                      <INPUT NAME="amper" TYPE="text" VALUE="<?php echo $dbarr['amper'] ; ?>">
                    </FONT></TD>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_FORM_USER_WORK;?> : </STRONG></FONT></TD>
                    <TD WIDTH="38%">
<?
$vwork  = array(_WORK_1, _WORK_2, _WORK_3, _WORK_4, _WORK_5, _WORK_6, _WORK_7, _WORK_8, _WORK_9, _WORK_10, _WORK_11, _WORK_12, _WORK_13, _WORK_14, _WORK_15, _WORK_16, _WORK_17, _WORK_18, _WORK_19, _WORK_20, _WORK_21, _WORK_22, _WORK_23);
echo "<select  name=work size=1 >
		<option >------------</option>";
for($i=0;$i<count($vwork);$i++){
echo 	"<option value=$vwork[$i] ";
if($dbarr['work']=="$vwork[$i]"){ echo "selected" ; }
echo ">".$vwork[$i]."</option>";
}
echo "</select>";
?>
                    </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_PROV;?> : </FONT></STRONG></TD>
 <TD width=345>
 <?
$vprovince  = array(_PROVINCE_1, _PROVINCE_2, _PROVINCE_3, _PROVINCE_4, _PROVINCE_5, _PROVINCE_6, _PROVINCE_7, _PROVINCE_8, _PROVINCE_9, _PROVINCE_10, _PROVINCE_11, _PROVINCE_12, _PROVINCE_13, _PROVINCE_14, _PROVINCE_15, _PROVINCE_16, _PROVINCE_17, _PROVINCE_18, _PROVINCE_19, _PROVINCE_20, _PROVINCE_21, _PROVINCE_22, _PROVINCE_23, _PROVINCE_24, _PROVINCE_25, _PROVINCE_26, _PROVINCE_27, _PROVINCE_28, _PROVINCE_29, _PROVINCE_30, _PROVINCE_31, _PROVINCE_32, _PROVINCE_33, _PROVINCE_34, _PROVINCE_35, _PROVINCE_36, _PROVINCE_37, _PROVINCE_38, _PROVINCE_39, _PROVINCE_40, _PROVINCE_41, _PROVINCE_42, _PROVINCE_43, _PROVINCE_44, _PROVINCE_45, _PROVINCE_46, _PROVINCE_47, _PROVINCE_48, _PROVINCE_49, _PROVINCE_50, _PROVINCE_51, _PROVINCE_52, _PROVINCE_53, _PROVINCE_54, _PROVINCE_55, _PROVINCE_56, _PROVINCE_57, _PROVINCE_58, _PROVINCE_59, _PROVINCE_60, _PROVINCE_61, _PROVINCE_62, _PROVINCE_63, _PROVINCE_64, _PROVINCE_65, _PROVINCE_66, _PROVINCE_67, _PROVINCE_68, _PROVINCE_69, _PROVINCE_70, _PROVINCE_71, _PROVINCE_72, _PROVINCE_73, _PROVINCE_74, _PROVINCE_75, _PROVINCE_76, _PROVINCE_77);
echo "<select  name=province size=1 >
		<option >------------</option>";
for($i=0;$i<count($vprovince);$i++){
echo 	"<option value=$vprovince[$i] ";
if($dbarr['province']=="$vprovince[$i]"){ echo "selected" ; }
echo ">".$vprovince[$i]."</option>";
}
echo "</select>";
?>
</TD>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_POST;?> : </STRONG></FONT></TD>
                    <TD>
                      <INPUT NAME="zipcode" TYPE="text" VALUE="<?php echo $dbarr['zipcode'] ; ?>" SIZE="10" MAXLENGTH="15">
                    </FONT></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="14%" ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_PHONE;?> : </FONT></STRONG></TD>
                    <TD>
                      <INPUT NAME="phone" TYPE="text" ID="phone2" VALUE="<?php echo $dbarr['phone'] ;?>">
                    </FONT></TD>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_TIMEADD;?> : </STRONG></FONT></TD>
                    <TD><INPUT NAME="signup" TYPE="text" ID="office" VALUE="<?php echo $dbarr['signup'] ; ?>"></TD>
                  </TR>
                  <TR>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_MEMDETAIL_AGE;?></STRONG>&nbsp;: </FONT></TD>
                    <TD>
                      <INPUT NAME="age" TYPE="text" VALUE="<?php echo $dbarr['age'] ; ?>" SIZE="5" MAXLENGTH="3">
<?=_MEMBER_MOD_MEMDETAIL_PEE;?>                    </FONT></TD>
                    <TD ALIGN="right"><STRONG><?=_MEMBER_MOD_FORM_WORK;?></STRONG>&nbsp;:</TD><td>
                      <INPUT NAME="office" TYPE="text" ID="office" VALUE="<?php echo $dbarr['office'] ;?>"></td>
                  </TR>

                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG><?=_MEMBER_MOD_FORM_USER_NICK;?> : </STRONG></TD>
                    <TD BGCOLOR="#FFFFFF" ><INPUT NAME="nic_name" TYPE="text"  size="5" VALUE="<?php echo "$dbarr[nic_name]" ; ?>"></TD>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF"><STRONG>Email : </STRONG></TD>
                    <TD BGCOLOR="#FFFFFF" ><INPUT NAME="email" TYPE="text"  size="30" VALUE="<?php echo "$dbarr[email]" ; ?>"></TD>
                  </TR>
                  <TR>
                    <TD WIDTH="21%" ALIGN="right" BGCOLOR="#FFFFFF" valign="top" ><FONT SIZE="2"><STRONG>&nbsp;&nbsp;<?=_MEMBER_MOD_FORM_USER_SIG;?> : </STRONG></FONT></TD>
                    <TD BGCOLOR="#FFFFFF" colspan="3"><textarea cols="70" id="editor1" rows="5"  name="signature" ><?php echo $dbarr['signature'] ;?></textarea>
					<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'AdminBasic'});</script>
					</TD>
                  </TR>
                </TABLE>
                <DIV ALIGN="center"><BR>
				   <INPUT NAME="page" TYPE="hidden" VALUE="<?php echo $_GET['page'] ;?>" >
                    <INPUT NAME="member_id" TYPE="hidden" ID="member_id" VALUE="<?php echo $dbarr['member_id'] ; ?>">
&nbsp;&nbsp; 
            <INPUT TYPE="submit" NAME="Submit2" VALUE="<?=_MEMBER_MOD_FORM_BUTTON_EDIT;?>">
          </FONT></DIV>
                <SCRIPT LANGUAGE="javascript">

function check2() {
var x=document.forms["checkForm"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("<?echo _MEMBER_MOD_FORM_JAVA_EMAIL;?>");
  return false;
  }
if(document.checkForm.name.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_USER;?>") ;
document.checkForm.name.focus() ;
return false ;
}
else if(document.checkForm.year.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_BIRTH;?>") ;
document.checkForm.year.focus() ;
return false ;
}
else if(isNaN(document.checkForm.year.value)) {
alert("<?echo _MEMBER_MOD_FORM_JAVA_YEAR;?>") ;
document.checkForm.year.focus() ;
return false ;
}
else if(document.checkForm.age.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_AGE;?>") ;
document.checkForm.age.focus() ;
return false ;
}
else if(isNaN(document.checkForm.age.value)) {
alert("<?echo _MEMBER_MOD_FORM_JAVA_AGE_NUM;?>") ;
document.checkForm.age.focus() ;
return false ;
}
else if(document.checkForm.email.value=="") {
alert("<?echo _MEMBER_MOD_FORM_JAVA_EMAIL_NULL;?>") ;
return false ;
}
else 
return true ;
}

      </SCRIPT>
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
			$db->del(TB_ADMIN," id='".$value."' "); 
			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_USER_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=user\"><B>"._ADMIN_USER_MESSAGE_GOBACK."</B></A>";
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
		$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE id='".$_GET['id']."' ");
		$arr['admin'] = $db->fetch($res['admin']);
		$picture=$arr['admin']['picture'];
		if (empty($picture)){
		//unlink("images/stupic/".$picture."");
		} else {
		unlink("icon/".$picture."");
		}

		$db->del(TB_ADMIN," id='".$_GET['id']."' "); 

		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_USER_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=user\"><B>"._ADMIN_USER_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "minepass_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไขข้อมูลส่วนตัว
	if(CheckLevel($admin_user,$op)){
			if(!$_POST['USERNAME'] OR !$_POST['NAME'] OR !$_POST['EMAIL']){
				$ProcessOutput = "<BR><BR>";
				$ProcessOutput .= "<CENTER><IMG SRC=\"images/icon/notview.gif\" BORDER=\"0\"><BR><BR>";
				$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._JAVA_DATA_NULL."</B></FONT><BR><BR>";
				$ProcessOutput .= "<A HREF=\"javascript:history.go(-1);\"><B>"._JAVA_FORM_BACK_EDIT."</B></A>";
				$ProcessOutput .= "</CENTER>";
				$ProcessOutput .= "<BR><BR>";
			}else{

				if($_POST['PASSWORD']){
					$NewPass = md5($_POST['PASSWORD']);
					$URLre = "?name=admin&logout";
					session_unset();
					session_destroy();
				}else{
					$NewPass = $_POST['oldpass'];
					$URLre = "?name=admin&file=main";
				}
		if ($_FILES['FILE']['tmp_name'] !="") {
$sql = "select member_pic from ".TB_MEMBER." where member_pic='".$_FILES['FILE']['name']."'" ;
$result = mysql_query($sql) ;
$numrow = mysql_num_rows($result) ;
if($numrow !=0) {
$showmsg="<br><br><center><font size='3' face='MS Sans Serif'>"._MEMBER_MOD_FORM_IMAGES_DENIED."<br><br><input type='button' value='"._MEMBER_MOD_FORM_JAVA_RETERN."' onclick='history.back();'></center>" ;
	showerror($showmsg);
	exit();
//	echo"<meta http-equiv=\"refresh\" content=\"3;URL=?name=member\" />";
}
		require("includes/class.resizepic.php");
		$FILE = $_FILES['FILE'];
		$namepic=$_FILES['FILE']['tmp_name'];
		$namepic_name=$_FILES['FILE']['name'];
		$namepic_size=$_FILES['FILE']['size'];
		$namepic_type=$_FILES['FILE']['type'];

		if (($FILE['type']!="image/jpg") AND ($FILE['type']!="image/jpeg") AND ($FILE['type']!="image/pjpeg")){
			echo "<script language='javascript'>" ;
			echo "alert('"._JAVA_IMG_ACC."')" ;
			echo "</script>" ;
			echo "<script language='javascript'>javascript:history.go(-1)</script>";
		//	echo "$namepic_name<br>";
			exit();
		}else{
			$filepic=$FILE['tmp_name'];
			@copy ($FILE['tmp_name'] , "icon/admin_".TIMESTAMP."_".$namepic_name."");
			$original_image = "icon/admin_".TIMESTAMP."_".$namepic_name."" ;
			$desired_width = _Iadmin_W ;
			$desired_height = _Iadmin_H ;
			$image = new hft_image($original_image);
			$image->resize($desired_width, $desired_height, '0');
			$image->output_resized("icon/admin_".TIMESTAMP."_".$namepic_name."", "JPG");
		}	
			//ทำการเพิ่มข้อมูลลงดาต้าเบส
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->update_db(TB_ADMIN,array(
				"username"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['NAME']."",
				"email"=>"".$_POST['EMAIL']."",
				"picture"=>"admin_".TIMESTAMP."_".$namepic_name.""
			)," id='".$_GET['id']."' ");

			$db->update_db(TB_MEMBER,array(
				"user"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['NAME']."",
				"email"=>"".$_POST['EMAIL']."",
				"member_pic"=>"admin_".TIMESTAMP."_".$namepic_name.""
			)," user='".$_POST['USERNAME_OLD']."' ");

		} else {
			//ทำการเพิ่มข้อมูลลงดาต้าเบส
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->update_db(TB_ADMIN,array(
				"username"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['NAME']."",
				"email"=>"".$_POST['EMAIL'].""
			)," id='".$_GET['id']."' ");
			$db->update_db(TB_MEMBER,array(
				"user"=>"".$_POST['USERNAME']."",
				"password"=>"".$NewPass."",
				"name"=>"".$_POST['NAME']."",
				"email"=>"".$_POST['EMAIL'].""
			)," user='".$_POST['USERNAME_OLD']."' ");

		}
			$db->closedb ();
			$ProcessOutput = "<BR><BR>";
			$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
			$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_USER_MESSAGE_EDIT."</B></FONT><BR><BR>";
			$ProcessOutput .= "<A HREF=\"".$URLre."\"><B>"._ADMIN_USER_MESSAGE_CHPASS_GOBACK."</B></A><br><br>";
			$ProcessOutput .= "<A HREF=\"".$URLre."\"><B>"._ADMIN_USER_MESSAGE_CHPASS_USER."</B></A>";
			$ProcessOutput .= "</CENTER>";
			$ProcessOutput .= "<BR><BR>";

		}
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "minepass_edit"){
	//////////////////////////////////////////// กรณีแก้ไขข้อมูลส่วนตัว
	if(CheckLevel($admin_user,$op)){
		//ดึงค่าของผู้ดูแลระบบออกมา
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$admin_user."' ");
		$arr['admin'] = $db->fetch($res['admin']);
		$id=$arr['admin']['id'];
		$db->closedb ();
?>
<FORM METHOD=POST ACTION="?name=admin&file=user&op=minepass_edit&action=edit&id=<?=$id;?> " enctype="multipart/form-data" id="edit">
<B><?=_ADMIN_USER_TABLE_HEADER_USER;?> :</B><BR>
<INPUT TYPE="text" NAME="USERNAME" size="40" VALUE="<?=$arr['admin']['username'];?>" readonly style="color=#FF0000;"><BR>
<B><?=_ADMIN_USER_FORM_EDIT_PASSWORD;?> :</B><BR>
<INPUT TYPE="password" NAME="PASSWORD" size="40" VALUE=""><BR>
<B><?=_ADMIN_USER_TABLE_HEADER_NAME;?> :</B><BR>
<INPUT TYPE="text" NAME="NAME" size="40" VALUE="<?=$arr['admin']['name'];?>"><BR>
<B>Email :</B><BR>
<INPUT TYPE="text" NAME="EMAIL" size="40" VALUE="<?=$arr['admin']['email'];?>"><BR>
<B><?=_ALUM_TABLE_COL1;?> :</B><BR>
<INPUT TYPE="file" name="FILE" onpropertychange="view01.src=FILE.value;" size="40"><BR>

<INPUT TYPE="submit" value="<?=_ADMIN_USER_FORM_BUTTON_EDIT_TITLE;?>"><INPUT TYPE="hidden" NAME="oldpass" value="<?=$arr['admin']['password'];?>">
</FORM>
<?
	}else{
		//กรณีไม่ผ่าน
		echo $PermissionFalse ;
	}
}


?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
