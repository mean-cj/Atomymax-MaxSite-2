<?
//require_once("mainfile.php");
		$classtext = array("", "");
		$classbox = array("noborder2", "noborder2");
		$username = "";
		$password = "";

 if($admin_user){
	 ?>
	 <link href="css/template_css.css" rel="stylesheet" type="text/css" />
	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top align=left><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>

<center><table cellpadding=0 cellspacing=0 bgcolor=#ffffff bordercolor=#CCCCCC border=0 width=650 >
<tr><td align="center" width=650>
<center></h4><h6>
<?
echo "<table cellpadding=0 cellspacing=0 bordercolor=#0A7CC0 border=0  width=Ø650>";
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['menu'] = $db->select_query("SELECT * FROM ".TB_MENU." order by id ");
$col=5;
$count=0;
while ($arr['menu'] = $db->fetch($res['menu'])){
if (($count%$col) == 0) {
echo "<tr><td>&nbsp;</td></tr>";
echo "<tr><td align=center >";
echo "<div id=body>";
echo "<div id=cpanel>";
}
?>
                <div style="float:left;">
                    <div class="icon">
                        <a href="<?=$arr['menu']['link'];?>">
                        <img src="images/admin/<?=$arr['menu']['icon'];?>" alt="<?=$arr['menu']['name'];?>" align="middle" border="0" />
                        <span><?=$arr['menu']['name'];?></span>
                        </a>
                    </div>
                </div>
<?
	$count++;
if (($count%$col) == 0) { echo "</div></div></td></TR>"; $count=0; 
} else{
	echo "";
} 
}
?>

</table>
<br>


</td>
</tr>
</table>

					</TD>
				</TR>
			</TABLE>
			<?
	// echo "<meta http-equiv='refresh' content='1; url=?name=admin&file=main'>" ;
} else {
?>

<center>
	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD vAlign=top align=center><img src="images/logoadmin.png" width="199" border='0'>
		  </td>
		</tr>
        <TR>
          <TD vAlign=top align=center>
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
<?
	}
?>


