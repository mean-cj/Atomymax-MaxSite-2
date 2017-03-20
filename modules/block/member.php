				<script language='JavaScript'>
					function check_Form_login() {
						if(document.checkForm2.user_login.value=='') {
						alert('<?echo _MEMBER_MOD_CHECK_USER_MESS_NULL;?>') ;
						document.checkForm2.user_login.focus() ;
						return false ;
						} else if(document.checkForm2.pwd_login.value=='') {
							alert('<? echo _MEMBER_MOD_FORM_JAVA_PASS;?>') ;
							document.checkForm2.pwd_login.focus() ;
							return false ;
						} else {
						return true ;
						}
						}
                      </script>

		<?
empty($_SESSION['login_true'])?$login_true="":$login_true=$_SESSION['login_true'];
empty($_SESSION['admin_user'])?$admin_user="":$admin_user=$_SESSION['admin_user'];
if ($admin_user) {

	//	CheckUser($_SESSION['admin_user']);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['admin'] = $db->select_query("SELECT * FROM ".TB_ADMIN." WHERE username='".$admin_user."' ");
		$arr['admin'] = $db->fetch($res['admin']);
		?>

<center><table border="0" cellpadding="0" cellspacing="0" width="<?=$widthSUM;?>">
			
			<? if ($arr['admin']['picture']<>""){?>
			<tr><td align="center"><img src="icon/<?=$arr['admin']['picture'];?>" name="view01" border="0" id="view01" <?echo "WIDTH="._Iadmin_W."";?> /></td></tr>
			<? } else {
			?>
			<tr><td align="center"><img src="icon/admin.png" name="view01" border="0" id="view01" <?echo "WIDTH="._Iadmin_W."  ";?> /></td></tr>
			<? } ?>
			<tr>
			<td align="center">Hello <?=$admin_user; ?></td>
			</tr>
			<tr class="off" onmouseover="this.className='on'" onmouseout="this.className='off'">
            <td align="left"><ul style="list-style:none; padding:0;height:24px;" id="menu"><li><a href="index.php?name=admin&file=member_detail"> <?=_MEMBER_AUTH;?> </a></li></ul></td>
			</tr>
			<tr class="off" onmouseover="this.className='on'" onmouseout="this.className='off'">
            <td align="left"><ul style="list-style:none; padding:0;height:24px;" id="menu"><li><a href="index.php?name=blog&file=blogad"> <?=_MEMBER_BLOG;?> </a></li></ul></td>
			</tr>
			<tr class="off" onmouseover="this.className='on'" onmouseout="this.className='off'">
            <td align="left"><ul style="list-style:none; padding:0;height:24px;" id="menu"><li><a href="index.php?name=blog&file=blogad&op=article_add"> <?=_MEMBER_BLOGADD;?> </a></li></ul></td>
			</tr>
			<tr>
			<td align="center"><a href='index.php?name=admin&file=logout'>[ <?=_MEMBER_EXIT;?> ]</a></td>
			</tr>
			<table>
			</td>
</tr>
</table>
			<?
	
} else if($login_true){

	//	CheckUser($_SESSION['user_user']);
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$login_true."' ");
		$arr['user'] = $db->fetch($res['user']);
		?>

			<table cellspacing="0" cellpadding="0" width="<?=$widthSUM;?>" border="0">
			
		<?		if($arr['user']['member_pic']==""){ 
	echo "<tr><td align=center><IMG SRC=\"icon/member_nrr.gif\" BORDER=0 ALIGN=center class=membericon></td></tr>";
	}else{  
	echo "<tr><td align=center><IMG SRC=\"icon/".$arr['user']['member_pic']."\" BORDER=0 ALIGN=center></td></tr>";
	 }
?>

			<tr>
			<td align="center">Hello <?=$login_true; ?></td>
			</tr>
			<tr class="off" onmouseover="this.className='on'" onmouseout="this.className='off'">
            <td align="left"><ul style="list-style:none; padding:0;height:24px;" id="menu"><li><a href="index.php?name=member&file=member_detail"> <?=_MEMBER_AUTH;?> </a></li></ul></td>
			</tr>
			<tr class="off" onmouseover="this.className='on'" onmouseout="this.className='off'">
            <td align="left"><ul style="list-style:none; padding:0;height:24px;" id="menu"><li><a href="index.php?name=member&file=change_pwd"> <?=_MEMBER_CPASS;?> </a></li></ul></td>
			</tr>
			<tr class="off" onmouseover="this.className='on'" onmouseout="this.className='off'">
            <td align="left"><ul style="list-style:none; padding:0;height:24px;" id="menu"><li><a href="index.php?name=blog&file=blog"> <?=_MEMBER_BLOG;?> </a></li></ul></td>
			</tr>
			<tr class="off" onmouseover="this.className='on'" onmouseout="this.className='off'">
            <td align="left"><ul style="list-style:none; padding:0;height:24px;" id="menu"><li><a href="index.php?name=blog&file=blog&op=article_add"> <?=_MEMBER_BLOGADD;?> </a></li></ul></td>
			<tr>
            <td align="center"><a href="index.php?name=member&file=logout"> <?=_MEMBER_EXIT;?> </a>
			</td>
			</tr>
			<table>
			</td>
</tr>
</table>
			<?
			} else if($login_true =='' && $admin_user=='') {

		 ?>

			<table width="<?=$widthSUM;?>" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td colspan="3" align="left">
			<img src="images/menu/graduatelogin.gif" width="150" height="30" />
			<FORM ACTION='?name=member&file=login_check'  name='checkForm2' id='checkForm2' method='post' onsubmit='return check_Form_login()' ENCTYPE="multipart/form-data">
				<TABLE width="<?=$widthSUM;?>">
				<TR>
				<TD width='95' align='right' valign='top'>Username : </TD>
				<TD width='100'><INPUT name='user_login' type='text' id='user_login' size='15'></TD>
				</TR>
				<TR>
				<TD width='87' align='right'  valign='top'>Password : </TD>
				<TD><input name='pwd_login' type='password' id='pwd_login' size='15'></TD>
				</TR>
				<?
				if(USE_CAPCHA){
				?>
                 <tr>
                 <td width='95' align='right' ><?if(CAPCHA_TYPE == 1){
							echo "<img src=\"capcha/CaptchaSecurityImages.php?path=".WEB_PATH."&width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						}else if(CAPCHA_TYPE == 2){ 
							echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						};?>
                    </td>
                    <td><input name="security_code" type="text" id="security_code" maxlength="6" size='15'/></td>
                    </tr>
                    <? } ?>
					<TR align='right' valign='top'>
					<TD colspan='2' align='center' valign='middle'><input name='submit' type='submit' value='<?=_MEMBER_LOGIN;?>'></TD>
					</TR>
					<TR align='right' valign='top'>
					<TD colspan='2' align='center' valign='middle'><span class="style1"><a href='?name=member&file=index'> [ <?=_MEMBER_SIGNIN;?> ] </a>  |  <a href='?name=member&file=forget_pwd'>[ <?=_MEMBER_PASSRESET;?> ]</a></span></TD>
					</TR>
					</TABLE>
				</FORM>
				</td>
				</tr>
				</table>



<?
	//echo "".$_SESSION['admin_user']."<br>";
	//echo "".$_SESSION['user_user']."<br>";
}


			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['member'] = $db->select_query("SELECT count(id) as members FROM ".TB_MEMBER." ");
			$rows['member'] = $db->fetch($res['member']); 
			$res['user2'] = $db->select_query("SELECT count(useronline) as online FROM ".TB_useronline." as a,".TB_MEMBER." as b where a.useronline=b.user ");
			$rows['user2'] = $db->fetch($res['user2']); 
			$res['mem2'] = $db->select_query("SELECT * FROM ".TB_useronline." as a,".TB_MEMBER." as b where a.useronline=b.user ");
			$rows['mem2'] = $db->fetch($res['mem2']); 
			$db->closedb ();
?>
<table border="0" cellpadding="0" cellspacing="0" width="<?=$widthSUM;?>" bgcolor="#F7F7F7" >
<tr><td width="<?=$widthSUM;?>" bgcolor="#F7F7F7" colspan="2"><img src="images/admin/members[1].png" border="0"> <?=_MEMBER_ALL;?> <font color="#FF0033"><?=$rows['member']['members'];?> </font><?=_COUNT_ONLINE_KON;?></td></tr>
<tr><td width="<?=$widthSUM;?>" bgcolor="#F7F7F7" colspan="2"><img src="images/admin/i_member[1].gif" border="0"> <?=_MEMBER_ALL_ONLINE;?> <font color="#FF0033"><?=$rows['user2']['online'];?> </font><?=_COUNT_ONLINE_KON;?></td></tr>
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['mem2'] = $db->select_query("SELECT * FROM ".TB_useronline.",".TB_MEMBER." where useronline=user ");

$count=0;
while($arr['mem2'] = $db->fetch($res['mem2'])){
	if ($count==0) { echo "<TR bgcolor=#F7F7F7>"; }
?>
<td width="50%"  align="center" bgcolor="#F7F7F7" ><? if($arr['mem2']['member_pic']==""){ ?>
	<IMG SRC="images/user_blank.gif" BORDER='1' ALIGN='center' class="membericon" style="filter:alpha(opacity=100)" onMouseover="makevisible(this,1)" onMouseout="makevisible(this,0)">
	<? }else{  ?>
	<A HREF="icon/<? echo $arr['mem2']['member_pic'];?>" class="highslide" onclick="return hs.expand(this)"><IMG SRC="icon/<?=$arr['mem2']['member_pic']; ?>" width='48' BORDER='1' ALIGN='center' ></a>
	<? };?><br>[<?=$arr['mem2']['user'];?>]
<?
$count++;

if (($count%_MEMBER_COL) == 0) { echo "</TR><TR bgcolor=#F7F7F7><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; 
} else{
	echo "</TD>";
} 
}
$db->closedb ();
	?>

</table>


