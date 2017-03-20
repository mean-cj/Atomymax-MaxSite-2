<?
require_once("mainfile.php");
		$classtext = array("", "");
		$classbox = array("noborder2", "noborder2");
		$username = "";
		$password = "";
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->del(TB_useronline," useronline='".$_SESSION['admin_user']."' "); 
			$db->closedb ();
session_unset();
//session_destroy();
setcookie("admin_user");
?>

	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="820" vAlign=top align=left><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>

        <TR>
          <TD vAlign="top" align="center" class="login" align="center"><FONT COLOR="#009900" size="3"><b><?=_ADMIN_MOD_LOGOUT_REPORT;?></b></font>
		  </td>
		</tr>
				<TR>
					<TD>
<BR>
<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD vAlign=top align=center><BR>
<div id="maincontent">
	<div id="loginform">
		<h2>Admin<span class="gray">istrator ! login</span></h2>
		<form name="login" id="login" method="post" action="?name=admin&file=login">
			<p>
				<?=_ADMIN_MOD_INDEX_USER;?> :
				<input type="text" name="username" id="username" class="<?php echo $classbox[0]; ?>"  value="<?php echo $username; ?>"  onclick="this.value=''" /><br />
				<?=_ADMIN_MOD_INDEX_PASS;?> : 
				<input type="password" name="password" id="password" class="<?php echo $classbox[1]; ?>"  value="<?php echo $password; ?>"  onclick="this.value=''" /><br />
		    	<div><?
if(USE_CAPCHA){
?>
						<?if(CAPCHA_TYPE == 1){ 
							echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						}else if(CAPCHA_TYPE == 2){ 
							echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
						};?>&nbsp;
						<input name="security_code" type="text" id="security_code" class="<?php echo $classbox[1]; ?>" onclick="this.value=''" maxlength="10" size="10">

<?
}
?></div><br>
				<input type="hidden" name="action" id="action" value="login"> 
                <input name="button" type="submit" class="button" id="button" value="<?=_ADMIN_MOD_BUTTON_ADD;?>"   />
                <input name="button2" type="button" class="button" id="button2" value="<?=_ADMIN_MOD_BUTTON_CANCLE;?>" onClick="window.location='index.php'" /><br />
			</p>
		</form>
		<div style="line-height: 18px">
            <br />
<?=_ADMIN_MOD_CREDIT_ATOM1;?> :   <a href="http://maxtom.sytes.net"><font color="#3399FF"><b><?=_ADMIN_MOD_CREDIT_ATOM2;?></b></font></a><br>
<?=_ADMIN_MOD_CREDIT_ATOM3;?>
		</div>
	</div>
</div>
</td>
</tr>
</TABLE>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
