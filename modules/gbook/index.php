<?include ("editor.php");?>
<script type="text/javascript">
function showemotion() {
	emotion1.style.display = 'none';
	emotion2.style.display = '';
}
function closeemotion() {
	emotion1.style.display = '';
	emotion2.style.display = 'none';
}

function emoticon(theSmilie) {

	document.form2.Message.value += ' ' + theSmilie + ' ';
	document.form2.Message.focus();
}
</script>


<table width="750" border="0" cellspacing="0" align="center" >
  <tr> 
    <td> 
      <table width="740" border="0" cellspacing="0" bgcolor="#000000" align="center" cellpadding="0">
        <tr>
          <td bgcolor="#FFFFFF" valign="top" align="left" colspan="2"> 
            <a href="#write"><img src="images/menu/gbook.png" height="40" width="562"></a>
		</td>
		</tr>

            <?// include("connectdb.php"); 
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 10 ;
  //ส่วนแสดงผล
 if($category){
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " WHERE category='".$category."' ";
} else {
	$SQLwhere = "";
	$SQLwhere2 = "";
}
if(empty($page)){
$page=1;
}
$SUMPAGE = $db->num_rows(TB_gbook,"No","".$SQLwhere."");
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;
$res['gbook'] = $db->select_query("SELECT * FROM ".TB_gbook." order by No DESC LIMIT $goto, $limit ");
$count=0;
while($arr['gbook'] = $db->fetch($res['gbook'])){
		$No = $arr['gbook']['No'];
		$Message= stripslashes($arr['gbook']['Message']);
		$Email    = wordwrap($arr['gbook']['Email'],30,"<br>\n",1);
		$Name = $arr['gbook']['Name'];
		$is_member=$arr['gbook']['is_member'];
		$Url = $arr['gbook']['URL'];
		$Date = $arr['gbook']['Date'];
		$IP=$arr['gbook']['IP'];

		  ?>
<tr>
          <td bgcolor="#FFFFFF" valign="top" align="center" width="100"> 
<?

	if ($is_member==1){


$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." where username='".$Name."' ");
$arr['admin'] = $db->fetch($res['admin']);

if ($arr['admin']['username']==$Name) {
 ?>
<A HREF="?name=admin&file=user&id=<?=$arr['admin']['id']; ?>">
	<? if($arr['admin']['picture']==""){ ?>
	<IMG SRC="icon/member_nrr.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }else{  ?>
	<IMG SRC="icon/<?=$arr['admin']['picture']; ?>" width='80' BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? } 
 ?> </a><?
}else {

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['member'] = $db->select_query("SELECT * FROM ".TB_MEMBER." where user='".$Name."' ");
$arr['member'] = $db->fetch($res['member']);
?>
	<? if($arr['member']['id']==""){ ?>
		<IMG SRC="icon/guest_nrr.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }else{  ?>
<a href='popup.php?name=member&file=member_view&id=<?=$arr['member']['id'];?>' onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )" class="highslide" >
	<? if($arr['member']['member_pic']==""){ ?>
	<IMG SRC="icon/member_nrr.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }else{  ?>
	<IMG SRC="icon/<?=$arr['member']['member_pic']; ?>" width='80' BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }; ?></a>
<? }; 

	};
	
	}else {?>
		<IMG SRC="icon/guest_nrr.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
<?	}
	?>
<br></font><font color="#003399">[ 
<?=$Name;?>
 ]</font></td>
<td bgcolor="#FFFFFF" valign="top" > 
<table  width="600"  border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td >
			<img src="images/com/b_01.jpg" width="23" height="13" alt=""></td>
		<td background="images/com/b_02.jpg" height="13" width="100%"></td>
		<td>
			<img src="images/com/b_03.jpg" width="10" height="13" alt=""></td>
	</tr>
	<tr>
		<td >
			<img src="images/com/b_04.jpg" width="23" alt=""></td>
		<td bgcolor="#F5F5F5"  width="100%" alt="">
		&nbsp;&nbsp;<b><?=_GBOOK_POSTED;?> </b><?=$Date; ?> &nbsp;&nbsp;&nbsp;&nbsp;<b><?=_FORM_MOD_POSTEDX;?> </b><?=$Name;?>&nbsp;&nbsp;&nbsp;&nbsp;<b><?=_FROM_COMMENT_IP;?> </b><?echo preg_replace('/([0-9]+\.[0-9]+)\.[0-9]+\.[0-9]+/', '\1<span style="color:red">.xxx.xxx</span>', $IP);?>
		</td>
		<td background="images/com/b_05.jpg" width="10" alt="" height="100%"></td>
	</tr>
	<tr>
		<td background="images/com/b_06.jpg" width="23" height="100%" alt=""></td>
		<td width="567">
		<table width="567" cellpadding="0" cellspacing="0" border="0">
		<tr>
		<td border=0 width="567">
			<?if($admin_user){ echo "<a href=\"index.php?name=admin&file=gbook&op=gbook_edit&id=".$No."\"><IMG SRC=\"images/mail1[1].gif\" BORDER=\"0\" ></a>&nbsp;&nbsp;<a href=\"index.php?name=admin&file=gbook&op=gbook_del&action=del&id=".$No."\"><IMG SRC=\"images/trash_16[1].gif\" BORDER=\"0\" ></a>";}?>
		</td></tr>
		<tr><td width="567"><br>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<? echo $Message;?>
		</td></tr>
		<tr><td width="567">
		<hr>
		&nbsp;&nbsp;<b>Homepage : </b><a href="<?=$Url;?>" target="_blank_" ><?=$Url;?></a>&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;<b>Email : </b> <? if(strlen($Email)==0) { $Email ="<font color='#009900'>"._GBOOK_EMAIL_SELECT."</font>"; 	echo $Email; } else {echo "<a href='mailto:$Email'>$Email</a>";} ?>
		</td></tr></table>
			</td>
		<td background="images/com/b_05.jpg" width="10" height="100%" alt=""></td>
	</tr>
	<tr>
		<td >
			<img src="images/com/b_07.jpg" width="23" height="11" alt=""></td>
		<td background="images/com/b_08.jpg" height="11" width="100%" alt=""></td>
		<td>
			<img src="images/com/b_09.jpg" width="10" height="11" alt=""></td>
	</tr>
</table>
            <br>
            <?}?>
            <br>
</td>
</tr>

<tr>
<td width="750" colspan="2" align="center" bgcolor="#ffffff">
            <table width="100%" border="0" cellspacing="0" align="center">
              <tr>
               <td align="center">
<?/* สร้างปุ่มย้อนกลับ */
				SplitPage($page,$totalpage,"?name=gbook&category=".$category."");
				echo $ShowSumPages ;
				echo "<BR>";
				echo $ShowPages ;
			?></td>
              </tr>
            </table><br>

<form name="form2" id="form2" class="inputform" method="post" action="index.php?name=gbook&file=commit" enctype="multipart/form-data" onsubmit= "return checkfrm()";>
				<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr id="#write">
				<td width="10" height="10"><img src="images/pic/news-tl.gif"></td>
				<td height="10" width="100" background="images/pic/news-tbg.png"></td>
				<td height="10" width="500" background="images/pic/news-tbg.png"></td>
				<td width="10" height="10"><img src="images/pic/news-tr.gif"></td></tr>
                <tr> 
                    <td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="120" valign="top"  align="right" bgcolor="#FFFFFF">*<?=_FROM_COMMENT_DETAIL;?></font></td>
                  <td width="500" align="left"> 
				  <TEXTAREA NAME="Messages" ROWS="10" COLS="100" style="width:400" id="editor1"></TEXTAREA>
					<script type="text/javascript">CKEDITOR.replace ( 'editor1',{toolbar: 'Mini'});</script>
</td>
                    <td width="10" align="center"  height="100%"  background="images/pic/news-right.png"></td>
                </tr>
                <tr> 
                    <td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="120" valign="top"  align="right" bgcolor="#FFFFFF">URL :</font></td>
                  <td width="500" align="left"> 
                    <input type="text" name="Url" size="40" maxlength="40" value="http://">
                  </td>
                    <td width="10" align="center"  height="100%"  background="images/pic/news-right.png"></td>
                </tr>
                <tr> 
                    <td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="120" valign="top"  align="right" bgcolor="#FFFFFF">Email :</font></td>
                  <td width="500" align="left"> 
                    <input type="text" name="Email" size="40" maxlength="35">
                  </td>
                    <td width="10" align="center"  height="100%"  background="images/pic/news-right.png"></td>
                </tr>
<?
 if($login_true || $admin_user){
} else {
if(USE_CAPCHA){
?>
                <tr> 
                    <td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="120" valign="top"  align="right" bgcolor="#FFFFFF"><?=_JAVA_CAPTCHA_NAME;?></font></td>
                  <td width="500" align="left"> 
							<?if(CAPCHA_TYPE == 1){ 
								echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							}else if(CAPCHA_TYPE == 2){ 
								echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							};?>
					<input name="security_code" type="text" id="security_code"  maxlength="6" style="width:80" > <?=_JAVA_CAPTCHA_ADD;?>
                  </td>
                    <td width="10" align="center"  height="100%"  background="images/pic/news-right.png"></td>
						</TR>
<?
}
}
?>
                <tr> 
                    <td width="10" valign="top" height="100%" background="images/pic/news-left.png"></td>
                    <td width="120" valign="top"  align="right" bgcolor="#FFFFFF">*<?=_GBOOK_POSTED_USER;?></font></td>
                  <td width="500" align="left"> 
                    <input type="text" name="Name" size="40" maxlength="35" <?if($login_true){echo "value=\"".$login_true."\" readonly style=\"color: #FF0000\" ";};?><?if($admin_user){echo "value=\"".$admin_user."\" readonly style=\"color: #FF0000\" ";};?>>
                  </td>
                    <td width="10" align="center"  height="100%"  background="images/pic/news-right.png"></td>
						</TR>
				<tr>
				<td width="10" height="10"><img src="images/pic/news-bl.gif"></td>
				<td height="10" width="120" background="images/pic/news-bbg.png"></td>
				<td height="10" width="500" background="images/pic/news-bbg.png"></td>
				<td width="10" height="10"><img src="images/pic/news-br.gif"></td>
				</tr>
                <tr> 
                  <td colspan="4" align="center"> 
                    <input type="submit" name="Submit" value="<?=_GBOOK_BUTTON_ADD;?>" class="input_button">
                    <input type="reset" name="reset" value="<?=_GBOOK_BUTTON_CLEAR;?>" class="input_button">
                  </td>
                </tr>
              </table>
       
            </form>
          </td>
        </tr>

      </table>

    </td>
  </tr>
</table>

<script type="text/javascript">
function checkfrms(){
  if(document.form2.Messages.value==""){
	alert("<?echo _GBOOK_JAVA_MESSAGE;?>");
    return false;
  }else if(document.form2.Name.value==""){
	alert("<?echo _GBOOK_JAVA_USER;?>");
    return false;
  }else{
    return true;
  }
}
</script>