<?
CheckAdmin($admin_user, $admin_pwd);
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
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<IMG SRC="images/icon/arrow_wap.gif" BORDER="0" ALIGN="absmiddle">&nbsp;&nbsp; <?=_ADMIN_POLL_MENU_TITLE;?> </B>
					<BR><BR>
					<A HREF="?name=admin&file=poll"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_POLL_MENU_LIST;?> </A> &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=poll&op=poll_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_ADMIN_POLL_MENU_ADD_NEW;?></A> <BR><BR>
<?
//////////////////////////////////////////// แสดงรายการแบบสำรวจ 
if($op == ""){
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_POLL,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=poll&op=poll_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="44"><CENTER><B>Option</B></CENTER></td>
   <td width="200"><CENTER><B><?=_ADMIN_POLL_TABLE_HEADER_TOPIC;?></B></CENTER></td>
   <td ><CENTER><B><?=_ADMIN_POLL_TABLE_HEADER_CHOICE;?></B></CENTER></td>
   <td width="40"><CENTER><B><?=_ADMIN_POLL_TABLE_HEADER_STATUS;?></B></CENTER></td>
   <td width="40"><CENTER><B>Check</B></CENTER></td>
  </tr>  
<?
$res['poll'] = $db->select_query("SELECT * FROM ".TB_POLL." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['poll'] = $db->fetch($res['poll'])){
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
?>
    <tr <?php echo $ColorFill; ?> >
     <td width="44">
      <a href="?name=admin&file=poll&op=poll_edit&id=<? echo $arr['poll']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_ADMIN_BUTTON_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=poll&op=poll_del&id=<? echo $arr['poll']['id'];?>','<?=_ADMIN_BUTTON_DEL_MESSAGE;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_ADMIN_BUTTON_DEL;?>" ></a>
     </td> 
     <td><A HREF="popup.php?name=ajoxpoll&file=readpoll&poll_id=<?echo $arr['poll']['id'];?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 400} )" class="highslide"><?echo $arr['poll']['poll_question'];?></A></td>
     <td ><?echo $arr['poll']['poll_options'];?></td>
     <td align="center">
	 				  <? if($arr['poll']['status']=='0') { echo "<a HREF=?name=admin&file=poll&op=poll_update&action=update&id=".$arr['poll']['id']."&status=1><img src=images/publish_x.png alt='"._ADMIN_ORDER_PUBLISH_OFF."'></a>"; } else { echo "<a HREF=?name=admin&file=poll&op=poll_update&action=update&id=".$arr['poll']['id']."&status=0><img src=images/tick.png alt='่"._ADMIN_ORDER_PUBLISH_ON."'></a>"; };?>
	 </td>
     <td valign="top" align="center" width="40"><input type="checkbox" name="list[']" value="<? echo $arr['poll']['id'];?>"></td>
    </tr>

<?
$count++;
					  } 
?>
 </table>
 <div align="right">
 <input type="button" name="CheckAll" value="Check All" onclick="checkAll(document.myform)" >
 <input type="button" name="UnCheckAll" value="Uncheck All" onclick="uncheckAll(document.myform)" >
 <input type="hidden" name="ACTION" value="poll_del">
 <input type="submit" value="Delete" onclick="return delConfirm(document.myform)">
 </div>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=admin&file=poll");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;
}
else if($op == "poll_add" AND $action == "add"){
	//////////////////////////////////////////// กรณีเพิ่ม Database
	if(CheckLevel($admin_user,$op)){

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
if(isset($_POST['Submit'])){
$question = $_POST['QUESTION'];
$page = $_POST['PAGE'];
$ctr = $_POST['ctr'];
$options="";
	for($x=1;$x<=$ctr;$x++){
			$options .=  mysql_real_escape_string($_POST['opt'.$x])."|";
	}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$q = $db->select_query("insert into web_polls (poll_question,poll_options,page,status)values('$question','$options','$page','1')");
$db->closedb ();
	}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_POLL_MESSAGE_ADD."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=poll\"><B>"._ADMIN_POLL_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "poll_add"){
	//////////////////////////////////////////// กรณีเพิ่ม Form
	if(CheckLevel($admin_user,$op)){
?>
<script type="text/javascript" >
var is=1;
function CreateTextbox()
{
if(is<=10){
		
		try{
		v1 = document.getElementById('opt1').value
		v2 = document.getElementById('opt2').value
		v3 = document.getElementById('opt3').value
		v4 = document.getElementById('opt4').value
		v5 = document.getElementById('opt5').value
		v6 = document.getElementById('opt6').value
		v7 = document.getElementById('opt7').value
		v8 = document.getElementById('opt8').value
		v9 = document.getElementById('opt9').value
		v10 = document.getElementById('opt10').value
		
		
		}
		catch(err){
			
		}

		document.getElementById('createTextbox').innerHTML = document.getElementById('createTextbox').innerHTML + "<input type=text name='opt"+is+"' id='opt"+is+"' size='40' /><br>";
		document.getElementById('ctr').value = is;
		is++;
		try{
		document.getElementById('opt1').value = v1
		document.getElementById('opt2').value = v2
		document.getElementById('opt3').value = v3
		document.getElementById('opt4').value = v4
		document.getElementById('opt5').value = v5
		document.getElementById('opt6').value = v6	
		document.getElementById('opt7').value = v7
		document.getElementById('opt8').value = v8
		document.getElementById('opt9').value = v9
		document.getElementById('opt10').value = v10		
		}
		catch(err){
			
		}		

}
else
{
alert('Max limit reach');	
}

}
</script>

<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=poll&op=poll_add&action=add" enctype="multipart/form-data" id="myform">
            <center><table width="600" border="00" cellspacing="0" cellpadding="0" class="login">
              <tr>
                <td valign="middle" align="center">
                    <table width="550" border="00" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="domande" width="40%"><?=_ADMIN_POLL_FORM_CAT;?></td>
                        <td width="40%">
								<select name="PAGE" id="page">
								<option value="education" selected="selected"><?=_ADMIN_POLL_FORM_CAT_EDU;?></option>
								<option value="technology"><?=_ADMIN_POLL_FORM_CAT_TECHNO;?></option>
								<option value=""><?=_ADMIN_POLL_FORM_CAT_ETC;?></option>
								</select>
                        </td>
                      </tr>
                      <tr>
                        <td class="domande" width="40%" valign="top"><?=_ADMIN_POLL_TABLE_HEADER_TOPIC;?></td>
                        <td width="40%">
                          <textarea name="QUESTION" wrap="VIRTUAL" cols="80" rows="5"></textarea>
                        </td>
                      </tr>

    <tr>
      <td height="30" valign="top"><input type="button" value="Add Option" onclick="CreateTextbox()" /></td>
      <td>
      <div id="createTextbox" style="width:300px;"></div></td>

                      <tr>
                        <td width="40%">&nbsp;</td>
                        <td width="40%" class="domande"><br><input type="hidden" name="ctr" id="ctr"  />
                          <input type="submit" name="Submit" value="Submit" class="domande">
                          <input type="reset" name="Submit2" value="Reset" class="domande">
                        </td>
                      </tr>
                    </table>

                        </td>
                      </tr>
                    </table>
			                  </form>
<BR><BR>
</div>
</body>
</html>
<?
	}else{
		//กรณีไม่ผ่าน
		echo  $PermissionFalse ;
	}
}
else if($op == "poll_edit" AND $action == "edit"){
	//////////////////////////////////////////// กรณีแก้ไข Database Edit
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
$question = $_POST['QUESTION'];
$ctr = $_POST['ctr2'];
$page = mysql_real_escape_string($_POST['PAGE']);
$idd = $_POST['idd'];

$options="";
	for($x=0;$x<=$ctr;$x++){
		if(strlen($_POST['opt'.$x])>0){
			$options .= mysql_real_escape_string($_POST['opt'.$x])."|";
		}
	}
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_POLL,array(
			"poll_question"=>"$question",
			"poll_options"=>"$options",
			"page"=>"$page",
			)," id='".$_GET['id']."' ");
		$db->closedb ();


		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_POLL_MESSAGE_EDIT."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=poll\"><B>"._ADMIN_POLL_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "poll_edit"){
	//////////////////////////////////////////// กรณีแก้ไข Form
	if(CheckLevel($admin_user,$op)){
		//ดึงค่า
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['poll'] = $db->select_query("SELECT * FROM ".TB_POLL." WHERE id='".$_GET['id']."' ");
		$arr['poll'] = $db->fetch($res['poll']);
		$db->closedb ();
$op = explode("|",$arr['poll']['poll_options']);
$octr = count($op) - 2;

?>
<script type="text/javascript" >
var is=1;
function CreateTextboxs()
{
if(is<=10){
		
		try{
		v1 = document.getElementById('opt1').value
		v2 = document.getElementById('opt2').value
		v3 = document.getElementById('opt3').value
		v4 = document.getElementById('opt4').value
		v5 = document.getElementById('opt5').value
		v6 = document.getElementById('opt6').value
		v7 = document.getElementById('opt7').value
		v8 = document.getElementById('opt8').value
		v9 = document.getElementById('opt9').value
		v10 = document.getElementById('opt10').value
		
		
		}
		catch(err){
			
		}

		document.getElementById('createTextbox').innerHTML = document.getElementById('createTextbox').innerHTML + "<input type=text name='opt"+is+"' id='opt"+is+"' size='40' /><br>";
		document.getElementById('ctr').value = is;
		is++;
		try{
		document.getElementById('opt1').value = v1
		document.getElementById('opt2').value = v2
		document.getElementById('opt3').value = v3
		document.getElementById('opt4').value = v4
		document.getElementById('opt5').value = v5
		document.getElementById('opt6').value = v6	
		document.getElementById('opt7').value = v7
		document.getElementById('opt8').value = v8
		document.getElementById('opt9').value = v9
		document.getElementById('opt10').value = v10		
		}
		catch(err){
			
		}		

}
else
{
alert('Max limit reach');	
}

}
</script>

<FORM NAME="myform" METHOD=POST ACTION="?name=admin&file=poll&op=poll_edit&action=edit&id=<?=$_GET['id'];?>" id="myform" enctype="multipart/form-data">
            <center><table width="600" border="00" cellspacing="0" cellpadding="0" class="login">
              <tr>
                <td valign="middle" align="center">
                    <table width="550" border="00" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="domande" width="40%"><?=_ADMIN_POLL_FORM_CAT;?></td>
                        <td width="40%">
								<select name="PAGE" id="page">
								<option value="education" <? if($arr['poll']['page']=='education'){echo 'selected="selected"';} ?>><?=_ADMIN_POLL_FORM_CAT_EDU;?></option>
								<option value="technology" <? if($arr['poll']['page']=='technology'){echo 'selected="selected"';} ?>><?=_ADMIN_POLL_FORM_CAT_TECHNO;?></option>
								<option value="" <? if($arr['poll']['page']==''){echo 'selected="selected"';} ?>><?=_ADMIN_POLL_FORM_CAT_ETC;?></option>
								</select>
                        </td>
                      </tr>
                      <tr>
                        <td class="domande" width="40%" valign="top"><?=_ADMIN_POLL_TABLE_HEADER_TOPIC;?></td>
                        <td width="40%">
                          <textarea name="QUESTION" wrap="VIRTUAL" cols="80" rows="5" ><?=$arr['poll']['poll_question'];?></textarea>
                        </td>
                      </tr>
<script>
function addTextbox(){
	
	var last = eval(document.getElementById('ctr2').value) + 1;
	document.getElementById('opt'+ last).style.display = "block";
	
	document.getElementById('ctr2').value = last;
}
</script>
    <tr>
      <td height="30" valign="top"><input type="button" value="Add Option" onclick="addTextbox()" /></td>
      <td>
      <? for($xx=0;$xx<=$octr;$xx++){ ?><input name="opt<?=$xx; ?>" type="text" value="<?=$op[$xx]; ?>" size="40"/><br /><? } ?>     
      <? for($xx=$octr+1;$xx<10;$xx++){ ?><input id="opt<?=$xx; ?>" name="opt<?=$xx; ?>" type="text" value="" size="40" style="display:none" /><? } ?>           
      <div id="createTextbox" style="width:300px;"></div></td>
    </tr>
    <tr> 
      <td><input type="hidden" name="ctr2" id="ctr2" value="<?=$octr; ?>" />
        <input type="hidden" name="idd" id="idd" value="<?=$pid; ?>" /></td>
<td>
                          <input type="submit" name="Submit" value="Submit" class="domande">
                          <input type="reset" name="Submit2" value="Reset" class="domande">
                        </td>
                      </tr>
                    </table>

                        </td>
                      </tr>
                    </table>
			                  </form>
<BR><BR>
</div>
</body>
</html>
<?
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}

}
else if($op == "poll_del" AND $action == "multidel"){
	//////////////////////////////////////////// กรณีลบ Multi
	if(CheckLevel($admin_user,$op)){
		while(list($key, $value) = each ($_POST['list'])){
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['poll'] = $db->select_query("SELECT * FROM ".TB_POLL." WHERE id='".$value."' ");
			$arr['poll'] = $db->fetch($res['poll']);
			$db->del(TB_POLL," id='".$value."' "); 

			$db->closedb ();
		}
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_POLL_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=poll\"><B>"._ADMIN_POLL_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "poll_del"){
	//////////////////////////////////////////// กรณีลบ Form
	if(CheckLevel($admin_user,$op)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//		$db->del(TB_POLL," id='".$_GET['id']."' ");
			$res['poll'] = $db->select_query("SELECT * FROM ".TB_POLL." WHERE id='".$_GET['id']."' ");
			$arr['poll'] = $db->fetch($res['poll']);
			$db->del(TB_POLL," id='".$_GET['id']."' "); 

		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_POLL_MESSAGE_DEL."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=poll\"><B>"._ADMIN_POLL_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";
	}else{
		//กรณีไม่ผ่าน
		$ProcessOutput = $PermissionFalse ;
	}
	echo $ProcessOutput ;
}
else if($op == "poll_update" AND $action == "update"){

		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->update_db(TB_POLL,array(
			"status"=>"".$_GET['status'].""
		)," id=".$_GET['id']."");
		$db->closedb ();
		$ProcessOutput = "<BR><BR>";
		$ProcessOutput .= "<CENTER><A HREF=\"?name=admin&file=main\"><IMG SRC=\"images/icon/login-welcome.gif\" BORDER=\"0\"></A><BR><BR>";
		$ProcessOutput .= "<FONT COLOR=\"#336600\"><B>"._ADMIN_POLL_MESSAGE_UPDATE."</B></FONT><BR><BR>";
		$ProcessOutput .= "<A HREF=\"?name=admin&file=poll\"><B>"._ADMIN_POLL_MESSAGE_GOBACK."</B></A>";
		$ProcessOutput .= "<meta http-equiv='refresh' content='1; url=?name=admin&file=poll'>";
		$ProcessOutput .= "</CENTER>";
		$ProcessOutput .= "<BR><BR>";

	echo $ProcessOutput ;
}
?>
				</TD>
				</TR>
			</TABLE>


</td>
</tr>
</table>
