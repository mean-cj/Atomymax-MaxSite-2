	<table width="820"  border="0" cellspacing="0" cellpadding="0">
      <tr>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top ><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<img src="images/menu/textmenu_admin.gif" BORDER="0"><BR>
		  



<?php
CheckAdmin($admin_user, $admin_pwd);

	if(CheckLevel($admin_user,"member_edit")){

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

empty($_GET['date'])?$date=$_POST['date']:$date=$_GET['date'];
//$date=$_POST['date'];
empty($_GET['month'])?$month=$_POST['month']:$month=$_GET['month'];
//$month=$_POST['month'];
empty($_GET['year'])?$year=$_POST['year']:$year=$_GET['year'];
//$year=$_POST['year'];
empty($_GET['check_year'])?$check_year=$_POST['check_year']:$check_year=$_GET['check_year'];
//$check_year=$_POST['check_year'];
empty($_GET['username'])?$username=$_POST['username']:$username=$_GET['username'];
//$username=$_POST['username'];
$level=$_GET['level'];
empty($_GET['search'])?$search=$_POST['search']:$search=$_GET['search'];
//$search=$_POST['search'];
$start=$_GET['start'];
$member_id=$_GET['member_id'];
$page=$_GET['page'];



// ถ้าไม่ระบุปีในการค้นหา
if(isset($check_year) and $check_year =="no") {
$year = "" ;
}
if(empty($year) and (isset($check_year) and $check_year=="yes")) {
$year = 0 ;
}

// ค่าเริ่มต้นให้เรียงลำดับสมาชิกจากลำดับล่าสุด
if(empty($level)) {
$level = "id_desc" ;
}

$e_page=$member_num_show ; 
if(empty($_GET['s_page'])){   
	$_GET['s_page']=0;
	$chk_page=$_GET['s_page'];
	$s_page=$_GET['s_page'];
}else{   
	$chk_page=$_GET['s_page'];     
	$_GET['s_page']=$_GET['s_page']*$e_page;   
		$s_page=$_GET['s_page'];
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$check_m = mysql_query("select * from ".TB_MEMBER."  ");
$member_all =mysql_num_rows($check_m);

// หาจำนวนสมาชิกทั้งหมด
//$check_m = mysql_query("select * from ".TB_MEMBER."") ;
//$member_all = mysql_num_rows($check_m) ;
if(empty($username) ) {
// กำหนดค่าเริ่มต้นต่างๆ เพื่อแบ่งเพจ
if(empty($search)) {
$result2 = mysql_query("select * from ".TB_MEMBER." LIMIT ".$_GET['s_page'].",$e_page ") ;
//$rows2 = mysql_num_rows($result2) ;
$rows2 = $db->num_rows(TB_MEMBER,"id"," LIMIT ".$_GET['s_page'].",$e_page ");
$total = $db->num_rows(TB_MEMBER,"id","");
}
if((empty($check_year) or $check_year=="no") and isset($search)) {
$result2 = mysql_query("select * from ".TB_MEMBER." where date='$date' and month='$month' LIMIT ".$_GET['s_page'].",$e_page ") ;
$rows2 = $db->num_rows(TB_MEMBER,"id"," date='$date' and month='$month' LIMIT ".$_GET['s_page'].",$e_page");
//$rows2 = mysql_num_rows($result2) ;
$total = $db->num_rows(TB_MEMBER,"id"," date='$date' and month='$month'");
}
if(isset($check_year) and ($check_year=="yes")) {
$result2 = mysql_query("select * from ".TB_MEMBER." where date='$date' and month='$month' and year='$year' LIMIT ".$_GET['s_page'].",$e_page ") ;
//$rows2 = mysql_num_rows($result2) ;
$rows2 = $db->num_rows(TB_MEMBER,"id"," date='$date' and month='$month' and year='$year' LIMIT ".$_GET['s_page'].",$e_page");
$total = $db->num_rows(TB_MEMBER,"id"," date='$date' and month='$month' and year='$year' ");
}

} else {
$result2 = mysql_query("select * from ".TB_MEMBER." where user like '%$username%'  LIMIT ".$_GET['s_page'].",$e_page ") ;
$rows2 = $db->num_rows(TB_MEMBER,"id"," user like '%$username%'  LIMIT ".$_GET['s_page'].",$e_page");
$total = $db->num_rows(TB_MEMBER,"id"," user like '%$username%'  ");
}
//$e_page= (int)($rows2/$member_num_show) ;

if($rows2  >=1){   
	$plus_p=($chk_page*$e_page)+$rows2 ;   
}else{   
	$plus_p=($chk_page*$e_page);       
}   
$total_p=ceil($total/$e_page);   
$before_p=($chk_page*$e_page)+1;  

?>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
          <TR>
            <TD> <B>&nbsp;&nbsp;<IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <a href="?name=admin&file=member"><?=_ADMIN_MEMBER_MENU_TITLE;?></a> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <a href="?name=admin&file=member_mail"><?=_ADMIN_MEMBER_MENU_MAILTO_MEM;?></a></B> <BR>
                <BR>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="grids">
                  <tr class="odd"><td>
					&nbsp;&nbsp;<?=_ADMIN_MEMBER_FORM_MAIL_SEARCH_DATE;?>
                        <form action="?name=admin&file=member" method="post" name="checkForm" onsubmit="return check();">
                          &nbsp;&nbsp;<?=_ADMIN_MEMBER_FORM_MAIL_SEARCH_SELECT_DATE;?>
<?
echo "<SELECT name=date>
		<option >--</option>";
for($i=1;$i<32;$i++){
echo 	"<option value=$i>$i</option>";
}
echo "</select>";
$vmont  = array(_F_Month_1, _F_Month_2, _F_Month_3, _F_Month_4, _F_Month_5, _F_Month_6, _F_Month_7, _F_Month_8, _F_Month_9, _F_Month_10, _F_Month_11, _F_Month_12);

echo "<select  name=month size=1>
		<option >------------</option>";
for($i=0;$i<count($vmont);$i++){
$ss=$i+1;
echo 	"<option value=$ss>$vmont[$i]</option>";
}
echo "</select>";
?>
&nbsp; <?=_ADMIN_MEMBER_FORM_MAIL_SEARCH_YEAR;?>
              <input name="year" type="text" id="year" size="5">
              <input type="radio" name="check_year" value="yes">
              <?=_ADMIN_MEMBER_FORM_MAIL_SEARCH_SELECT_YEAR;?>
              <input type="radio" name="check_year" value="no" checked>
              <?=_ADMIN_MEMBER_FORM_MAIL_SEARCH_UNSELECT_YEAR;?>
			  &nbsp;&nbsp;or Search from Username : <input name="username" type="text" id="username" size="20">
              <input name="search" type="hidden" id="search" value="search">
              <input type="submit" name="Submit2" value="<?=_ADMIN_MEMBER_FORM_BUTTON_SEARCH;?>">
              <script language="javascript">
function check() {
if(isNaN(document.checkForm.year.value)) {
alert("<?echo _ADMIN_MEMBER_FORM_JAVA_CHECK_NUM;?>") ;
document.checkForm.year.focus() ;
return false ;
}
else 
return true ;
}

</script>
              </font>
                        </form>
</td>
</tr>
</table><br>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="grids">
                  <tr class="odd"><td>
                        <div align="center"> <br>
                            <br>
                            <a href="?name=admin&file=member&level=normal"><?=_ADMIN_MEMBER_SEARCH_RANK_NORMAL;?></a>&nbsp;&nbsp;|&nbsp;&nbsp; <a href="?name=admin&file=member&level=id_desc"><?=_ADMIN_MEMBER_SEARCH_RANK_LAST;?></a>&nbsp;&nbsp;|&nbsp;&nbsp; <a href="?name=admin&file=member&level=member_lastlog"><?=_ADMIN_MEMBER_SEARCH_RANK_LAST_LOG;?></a>&nbsp;&nbsp;|&nbsp;&nbsp; <a href="?name=admin&file=member&level=member_addpic"><?=_ADMIN_MEMBER_SEARCH_RANK_MEM_PIC;?></a></font> <br>
                            <br>
                            <?php 
// เข้าสู่การเช็คค่าต่างๆ แบบแบ่งจำนวนสมาชิกขึ้นมาโชว์ตามที่กำหนด
if(empty($search)) { // ถ้าไม่ได้ค้นหาตาม วัน เดือน ป
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
// ถ้าเลือกให้แสดงสมาชิกคนแรกก่อน
if($level=="normal") {
$result = mysql_query("select * from ".TB_MEMBER." LIMIT ".$_GET['s_page'].",$e_page ") ;
$rows = $db->num_rows(TB_MEMBER,"id"," LIMIT ".$_GET['s_page'].",$e_page");
//$rows = mysql_num_rows($result) ;
}
if($level=="id_desc") {
$result = mysql_query("select * from ".TB_MEMBER." order by id desc  LIMIT ".$_GET['s_page'].",$e_page ") ;
$rows = $db->num_rows(TB_MEMBER,"id"," order by id desc  LIMIT ".$_GET['s_page'].",$e_page");
}
if($level=="member_lastlog") {
// หาสมาชิกที่เข้ามาล่าสุด
$result = mysql_query("select * from ".TB_MEMBER." order by lastlog desc LIMIT ".$_GET['s_page'].",$e_page  ") ;
$rows = $db->num_rows(TB_MEMBER,"id"," order by lastlog desc LIMIT ".$_GET['s_page'].",$e_page");
}

if($level=="member_addpic") {
// หาสมาชิกที่ใส่รูปแล้ว
$result = mysql_query("select * from ".TB_MEMBER." order by member_pic desc LIMIT ".$_GET['s_page'].",$e_page  ") ;
$rows = $db->num_rows(TB_MEMBER,"id"," order by member_pic desc LIMIT ".$_GET['s_page'].",$e_page");
}

}
else { 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
##// ถ้าเกิดเข้าสู่การค้นหา //##
// ถ้าไม่เลือกปีในการค้นหา
if(empty($username)) {

if((empty($check_year) or $check_year=="no") and isset($search)) {
$result = mysql_query("select * from ".TB_MEMBER." where date='$date' and month='$month' LIMIT ".$_GET['s_page'].",$e_page ") ;
$rows = $db->num_rows(TB_MEMBER,"id"," date='$date' and month='$month' LIMIT ".$_GET['s_page'].",$e_page");
$totalx = $db->num_rows(TB_MEMBER,"id"," date='$date' and month='$month' ");
}
// ถ้าเลือกปีในการค้นหา
if(isset($check_year) and ($check_year=="yes")) {
$result = mysql_query("select * from ".TB_MEMBER." where date='$date' and month='$month' and year='$year' LIMIT ".$_GET['s_page'].",$e_page ") ;
$rows = $db->num_rows(TB_MEMBER,"id"," date='$date' and month='$month' and year='$year' LIMIT ".$_GET['s_page'].",$e_page");
$totalx = $db->num_rows(TB_MEMBER,"id"," date='$date' and month='$month' and year='$year' ");
}

} else {
$result = mysql_query("select * from ".TB_MEMBER." where user like '%$username%'  LIMIT ".$_GET['s_page'].",$e_page ") ;
$rows = $db->num_rows(TB_MEMBER,"id"," user like '%$username%'  LIMIT ".$_GET['s_page'].",$e_page");
$totalx = $db->num_rows(TB_MEMBER,"id"," user like '%$username%'   ");

echo "<center><b>Number of member $totalx person</b></font></center>" ;
echo "<br>" ;

}

} // จบ else ถ้ามีการค้นหา
if(empty($username) ) {
// ถ้าไม่มีการค้นหา คือค่าเริ่มต้น ให้บอกจำนวนสมาชิกทั้งหมด
if(empty($search)) {
echo "<center><font  color='red'><b>"._ADMIN_MEMBER_MESSAGE_MEM_ALL." $total "._ADMIN_MEMBER_MESSAGE_MEM_ALL1."</b><font></center>" ;
}
// ถ้ามีการค้นหา ให้แสดงขผลลัพท์ในการค้นหาแทน
if(isset($search)) {
echo "<center><b>"._ADMIN_MEMBER_MESSAGE_MEM_BIRT." $date/$month/$year "._ADMIN_MEMBER_MESSAGE_MEM_BIRT1." $totalx "._ADMIN_MEMBER_MESSAGE_MEM_BIRT2."</b></font></center>" ;
echo "<br>" ;
}

}
?>
</td>
</tr>
</table>
							<br>

				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
                  
<?
if($rows  >=1){   
	$plus_p=($chk_page*$e_page)+$rows ;   
}else{   
	$plus_p=($chk_page*$e_page);       
}   
$total_p=ceil($total/$e_page);   
$before_p=($chk_page*$e_page)+1;  
$count=0;
while($dbarr = mysql_fetch_array($result)) {
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}

?></div>
<tr ><td><br>
                            <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="grids">
                              <tr <?php echo $ColorFill; ?>>
                                <td colspan="6"><font color="#000000" ><strong><?=_MEMBER_MOD_MEMDETAIL_MEMID;?> <?php echo $dbarr['member_id'] ; ?> &nbsp;</strong></font>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td colspan="6"> <strong><?=_MEMBER_MOD_MEMDETAIL_NAME;?>&nbsp;: </strong>&nbsp;<?php echo $dbarr['name'] ; ?> &nbsp;&nbsp;( <? echo $dbarr['nic_name'];?> )</font></td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right"><strong>user :</font></strong></td>
                                <td width="155"><?php echo $dbarr['user'] ; ?></font></td>
                                <td width="5">&nbsp;</td>
                                <td width="123" align="right"><strong><?=_MEMBER_MOD_MEMDETAIL_MEMPIC;?> : </font></strong></td>
                                <td width="197" colspan="2" rowspan="6" valign="top"><div align="left">
                                  <?
					//Show Picture
					if($dbarr['member_pic']){
						$postpicupload = @getimagesize ("icon/".$dbarr['member_pic']."");
						if ( $postpicupload['0'] > _MEMBER_LIMIT_PICWIDTH ) {
							$PicUpload = "<img src='icon/".$dbarr['member_pic']."' width='"._MEMBER_LIMIT_PICWIDTH."' border=\"1\" ALIGN='absmiddle' class='membericon'>	<br><br>"._MEMBER_MOD_MEMDETAIL_MEMPIC_NOW." ".$dbarr['member_pic']."";
							}else{
							$PicUpload = "<img src='icon/".$dbarr['member_pic']."' border=\"1\" ALIGN='absmiddle' class='membericon'><br><br>"._MEMBER_MOD_MEMDETAIL_MEMPIC_NOW." ".$dbarr['member_pic']."";
							}
						echo $PicUpload ; 		
						echo " <br>&nbsp;<A HREF=\"javascript:Confirm('?name=admin&file=delete_memberpic&member_id=".$dbarr['member_id']."','"._ADMIN_MEMBER_JAVA_CON_DEL_PIC."');\"><IMG SRC=\"images/admin/trash.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALIGN=\"absmiddle\"> <font color='red'>"._ADMIN_MEMBER_JAVA_CON_DEL_PIC_OK."</font></A>";
					}else{ echo "<font color='red'>"._MEMBER_MOD_MEMDETAIL_MEMPIC_NULL."</font><br><IMG SRC=\"images/knowledge_blank.gif\" WIDTH=\"80\" HEIGHT=\"60\" BORDER=\"0\" ALIGN=\"absmiddle\">"; };
					?>
                                </div>                                  <div align="left"></div>                                <div align="left"></div>                                <div align="left"></div>                                <div align="left">
                                </div></td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right"><strong>email : </font></strong></td>
                                <td><?php echo "<a href='mailto:".$dbarr['email']."'>".$dbarr['email']."</a>" ; ?></font></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right"><strong><?=_MEMBER_MOD_MEMDETAIL_SEX;?> : </font></strong></td>
                                <td><?php echo $dbarr['sex'] ; ?></font></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right"><strong><?=_MEMBER_MOD_MEMDETAIL_BIRTDAY;?> : </font></strong></td>
                                <td><?php echo $dbarr['date']."/".$dbarr['month']."/".$dbarr['year']  ; ?></font></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right"><strong><?=_MEMBER_MOD_MEMDETAIL_AGE;?> : </font></strong></td>
                                <td align="left"><?php echo $dbarr['age'] ; ?> <?=_MEMBER_MOD_MEMDETAIL_PEE;?> </font></td>
                                <td align="left">&nbsp;</td>
                                <td align="left">&nbsp;</td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right"><strong><?=_MEMBER_MOD_MEMDETAIL_ADDRESS;?> : </font></strong></td>
                                <td><?php echo $dbarr['address'] ; ?></font></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right"><strong><?=_MEMBER_MOD_MEMDETAIL_AMP;?> : </font></strong></td>
                                <td><?php echo $dbarr['amper'] ; ?></font></td>
                                <td>&nbsp;</td>
                                <td align="right"><strong><?=_MEMBER_MOD_FORM_EDUCATION;?> : </font></strong></td>
                                <td colspan="2"><div align="left"><?php echo $dbarr['education'] ; ?></font></div></td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right"><strong><?=_MEMBER_MOD_MEMDETAIL_PROV;?> : </font></strong></td>
                                <td><?php echo $dbarr['province'] ; ?></font></td>
                                <td>&nbsp;</td>
                                <td align="right"><strong><?=_MEMBER_MOD_FORM_USER_WORK;?> : </font></strong></td>
                                <td colspan="2"><div align="left"><?php echo $dbarr['work'] ; ?></font></div></td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right"><strong><?=_MEMBER_MOD_MEMDETAIL_POST;?> : </font></strong></td>
                                <td><?php echo $dbarr['zipcode'] ; ?></font></td>
                                <td>&nbsp;</td>
                                <td align="right" valign="middle"><strong><?=_MEMBER_MOD_MEMDETAIL_LASTLOG;?> : </font></strong></td>
                                <td colspan="2"><?php echo $dbarr['lastlog'] ; ?></font></td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right"><strong><?=_MEMBER_MOD_MEMDETAIL_PHONE;?> : </font></strong></td>
                                <td><?php echo $dbarr['phone'] ; ?></font></td>
                                <td>&nbsp;</td>
                                <td align="right"><strong><?=_ADMIN_MEMBER_FORM_DEL_MEM;?> :</strong></font></td>
                                <td colspan="2"><? echo " <A HREF=\"javascript:Confirm('?name=admin&file=member_delete&member_id=".$dbarr['member_id']."','"._ADMIN_MEMBER_JAVA_DEL_MEM_CON." Username: ".$dbarr['user']."  ?');\"><IMG SRC=\"images/admin/trash.gif\" WIDTH=\"20\" HEIGHT=\"20\" BORDER=\"0\" ALIGN=\"absmiddle\"> <font color='red'>"._ADMIN_MEMBER_JAVA_DEL_MEM_CON_OK."</font></A>"; ?>
                                    <? $member_id=$dbarr['member_id']; ?></A><a href="?name=admin&file=member_edit&member_id=<?=$dbarr['member_id'];?>"><IMG SRC="images/admin/7_40.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALIGN="absmiddle"><font color='#0066FF'><?=_ADMIN_BUTTON_EDIT;?></a>
                                    <input name="member_id" type="hidden" id="member_id" value="<?php echo $member_id ; ?>">
                                    <input name="delete" type="hidden" id="delete" value="delete">
                                </font></td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right"><strong><?=_ADMIN_MEMBER_FORM_ADD_MEM;?> : </font></strong></td>
                                <td><?php echo $dbarr['signup'] ; ?></font></td>
                                <td>&nbsp;</td>
                                <td align="right" valign="middle"><strong><?=_ADMIN_MEMBER_FORM_ADD_BLOG;?> :</font></strong></td>
                                <td colspan="2"><div align="left">
												  <? if($dbarr['blog']==0) { echo "<a HREF=?name=admin&file=member&op=member_update&action=update&id=".$dbarr['id']."&status=1><img src=images/publish_x.png alt='"._ADMIN_MEMBER_FORM_ADD_BLOG_OFF."'><font color=#FF0000><b>  "._ADMIN_MEMBER_FORM_ADD_BLOG_OFF."</b></font></a>"; } else { echo "<a HREF=?name=admin&file=member&op=member_update&action=update&id=".$dbarr['id']."&status=0><img src=images/tick.png alt='่"._ADMIN_MEMBER_FORM_ADD_BLOG_OK."'><font color=#00CC00><b>  "._ADMIN_MEMBER_FORM_ADD_BLOG_OK."</b></font></a>"; };?></div></td>
                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right" valign="top"><strong><?=_MEMBER_MOD_FORM_WORK;?> : </font></strong></td>
                                <td colspan=5><?=$dbarr['office'] ; ?></font>
								</td>

                              </tr>
                              <tr <?php echo $ColorFill; ?>>
                                <td align="right" valign="top"><strong><?=_MEMBER_MOD_FORM_USER_SIG;?> : </font></strong></td>
                                <td colspan=5><?=stripslashes($dbarr['signature']) ; ?></font>
								</td>

                              </tr>
                      </table>
                        </div>
</td>
</tr>
                              <?php 
$count++;
}
echo "<center><table width=700  border=0 cellspacing=0 cellpadding=0><tr><td width=800 class=\"browse_page\">";
if($total>0){ ?>
<div class="browse_page">
 <?php   
 // ???????????????????? ?????????????????????   
  page_navigator("admin","member","&date=$date&month=$month&year=$year&check_year=$check_year&username=$username&search=$search",$before_p,$plus_p,$total,$total_p,$chk_page);    
  ?> 
</div>
<?php 
} 
echo "</td></tr></table></center>";
}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
}
?>

			</TABLE>

<?
 if($op == "member_update" AND $action == "update"){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_MEMBER,array(
			"blog"=>"".$_GET['status'].""
		)," id='".$_GET['id']."'");
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_MEMBER_MESSAGE_UPDATE_BLOG."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=member\"><B>"._ADMIN_MEMBER_MESSAGE_UPDATE_BLOG_GOBACK." </B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=member'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}

?>

				</TD>
				</TR>
			</TABLE>