    <TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- About us -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_contact.gif" BORDER="0"><BR>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR>
<?php 
empty($_GET['action'])?$action="":$action=$_GET['action'];
if($action == "sendmail"){
$subject=$_POST['SUBJECT'];
$alldetail=$_POST['DETAIL'];
$yourmail=$_POST['YOURMAIL'];
$province=$_POST['province'];
$known=$_POST['known'];
$suggest=$_POST['suggest'];
	if(!$_POST['SUBJECT'] OR !$_POST['YOURMAIL'] OR !$_POST['DETAIL']){
		$Process .= "<CENTER><FONT SIZE=\"3\" COLOR=\"#FF0000\"><B>"._CONTACT_DATA_NOSUC."</B></FONT></CENTER><BR>";
	}
	if(!preg_match("/^[a-z0-9]+([_\\.-][a-z0-9]+)*"."@([a-z0-9]+([\.-][a-z0-9]{1,})+)*$/i",$_POST['YOURMAIL'])){
		$Process = "<CENTER><FONT SIZE=\"3\" COLOR=\"#FF0000\"><B>"._CONTACT_DATA_EMAIL."</B></FONT></CENTER><BR>";
	}
	if(USE_CAPCHA){
check_captcha($_POST['security_code']);
	}
	if(!empty($Process)){
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$db->add_db(TB_MAIL,array(
			"subject"=>"".$subject."",
			"detail"=>"".$alldetail."",
			"form_mail"=>"".$yourmail.""
		));
		$db->closedb ();
		sendmailnew($subject ,$alldetail,$yourmail,$province,$known,$suggest);
//		SendMail("Tis-620","".$_POST[YOURMAIL]."","".WEB_EMAIL."","".WEB_EMAIL."","".$_POST[SUBJECT]."","".$_POST[DETAIL]."");
		$Process = "<BR><BR><CENTER><IMG SRC=\"images/icon/mail.gif\" BORDER=\"0\" ><BR><BR><FONT SIZE=\"3\" COLOR=\"#009900\"><B>"._CONTACT_DATA_SUC."</B></FONT></CENTER><BR><BR>";
		$Process .= "<meta http-equiv='refresh' content='1; url=?name=contact'>";
		$Complete = True;
}

	}

if(!empty($Process)){
echo "".$Process."" ;
}
if(empty($Complete)){
?>
					<FORM METHOD=POST ACTION="?name=contact&action=sendmail">
					<TABLE width="80%" align="center">
					<TR>
						<TD align="right"><B><?php echo _CONTACT_FORM_DATA;?> <font color=red>*</font> : </B></TD>
						<TD><INPUT TYPE="text" NAME="SUBJECT" size="40" ></TD>
					</TR>
					<TR>
						<TD align="right"><B><?php echo _CONTACT_FORM_EMAIL;?> <font color=red>*</font> : </B></TD>
						<TD><INPUT TYPE="text" NAME="YOURMAIL" size="40" ></TD>
					</TR>
<TR>
      <TD align="right"><B><?php echo _CONTACT_FORM_PROVINCE;?> </B></font></TD>
      <TD>
                     <select name="province" id="province" >
		<option VALUE="" selected><?php echo _CONTACT_FORM_PROVINCE_OP;?></option>
<?php 
$province = array(_PROVINCE_1,_PROVINCE_2,_PROVINCE_3,_PROVINCE_4,_PROVINCE_5,_PROVINCE_6,_PROVINCE_7,_PROVINCE_8,_PROVINCE_9,_PROVINCE_10,_PROVINCE_11,_PROVINCE_12,_PROVINCE_13,_PROVINCE_14,_PROVINCE_15,_PROVINCE_16,_PROVINCE_17,_PROVINCE_18,_PROVINCE_19,_PROVINCE_20,_PROVINCE_21,_PROVINCE_22,_PROVINCE_23,_PROVINCE_24,_PROVINCE_25,_PROVINCE_26,_PROVINCE_27,_PROVINCE_28,_PROVINCE_29,_PROVINCE_30,_PROVINCE_31,_PROVINCE_32,_PROVINCE_33,_PROVINCE_34,_PROVINCE_35,_PROVINCE_36,_PROVINCE_37,_PROVINCE_38,_PROVINCE_39,_PROVINCE_40,_PROVINCE_41,_PROVINCE_42,_PROVINCE_43,_PROVINCE_44,_PROVINCE_45,_PROVINCE_46,_PROVINCE_47,_PROVINCE_48,_PROVINCE_49,_PROVINCE_50,_PROVINCE_51,_PROVINCE_52,_PROVINCE_53,_PROVINCE_54,_PROVINCE_55,_PROVINCE_56,_PROVINCE_57,_PROVINCE_58,_PROVINCE_59,_PROVINCE_60,_PROVINCE_61,_PROVINCE_62,_PROVINCE_63,_PROVINCE_64,_PROVINCE_65,_PROVINCE_66,_PROVINCE_67,_PROVINCE_68,_PROVINCE_69,_PROVINCE_70,_PROVINCE_71,_PROVINCE_72,_PROVINCE_73,_PROVINCE_74,_PROVINCE_75,_PROVINCE_76,_PROVINCE_77);
for($i=0;$i<77;$i++){
echo 	"<option value=$province[$i]>$province[$i]</option>";
}
?>
                    </select>
      </TD>
</TR>

<TR>
      <TD align="right"><B><?php echo _CONTACT_WAY;?> </B></font></TD>
      <TD>
<?php 
$way = array(_WAY_1,_WAY_2);
for($i=0;$i<2;$i++){
echo 	"<input name=known type=radio value=$way[$i]>$way[$i]";
}
	?>
      </TD>
     </TR>
<TR>
      <TD align="right"><B><?php echo _CONTACT_SUGGEST;?> </B></font></TD>
      <TD><input type="text" name="suggest" size="40"></TD>
     </TR>
     <TR>
					<TR>
						<TD align="right" valign="top"><B><?php echo _CONTACT_DETAIL;?> <font color=red>*</font>: </B></TD>
						<TD><TEXTAREA NAME="DETAIL" ROWS="5" COLS="40"></TEXTAREA></TD>
					</TR>
<?php 
if(USE_CAPCHA){
?>
					<TR>
						<TD align="right">
						<?php if (CAPCHA_TYPE == 1){ 
							echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						}else if(CAPCHA_TYPE == 2){ 
							echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						};?>
						</TD>
						<TD><input name="security_code" type="text" id="security_code" size="20" maxlength="6" style="width:80" > <?php echo _JAVA_CAPTCHA_ADD;?></TD>
					</TR>
<?php 
}
?>
					<TR>
						<TD align="right" valign="top"><B></B></TD>
						<TD><INPUT TYPE="submit" value="<?php echo _CONTACT_BUTTON_SEND;?>"> <INPUT TYPE="reset" value="<?php echo _CONTACT_BUTTON_CLEAR;?>"></TD>
					</TR>
					</TABLE>
					</FORM>
<?php 
}
?>
					<BR><BR>
					</TD>
				</TR>
			</TABLE>
			<BR><BR>
			<!-- About us -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>