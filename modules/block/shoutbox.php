			<? $smiletagURL = 'modules/smiletag/';
			?>

<!-- Edit HTML Below to customize the look of your smiletag form and iframe -->

<style type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
.smiletagFrame{
	border-right: #cccccc 1px solid;
	border-top: #cccccc 1px solid;
	border-left: #cccccc 1px solid;
	border-bottom: #cccccc 1px solid;
}
#smiley_box{
	width:95px;
	position:absolute;
	display:none;
	margin-left: 55px;
}
#smiley_box .smiley_top{
	background: url(modules/smiletag/images/smiley_top.png);
	background-repeat:no-repeat;
	height:30px;
	padding-left: 36px;
	
}
#smiley_box .smiley_middle{
	background: url(modules/smiletag/images/smiley_middle.png);
	background-repeat:repeat-y;	
	background-position:bottom left;
	padding-left:7px;
	padding-right:7px;
	padding-bottom: 0px;
	padding-top: 0px;
	margin-top: 0px;
	
}
#smiley_box .smiley_middle span{
	position:relative;
}
#smiley_box .smiley_bottom{
	background: url(modules/smiletag/images/smiley_bottom.png);
	background-repeat:no-repeat;
	background-position:bottom left;
	height:44px;
	top:-6px;
	
}
#smiley_box a {
	float: left; text-decoration: none
}
#smiley_box a:link {
	color: #808080
}
#smiley_box a:hover {
	color: #333; background-color: #efefef
}
#smiley_box a:active {
	color: #808080
}
#smiley_box a:visited {
	color: #808080
}
#smiley_box img {
	border: 0;
}
</style>
<script type="text/javascript" language="JavaScript">

	var smiletagURL = "<?php echo $smiletagURL; ?>";

</script>
<script type="text/javascript" language="JavaScript" src="<?php echo $smiletagURL; ?>smiletag-script.js"></script>


			<table border="0" cellpadding="0" cellspacing="0" width="<?=$widthSUM;?>">
			<tr>
			<td valign="top" align=center width="100%">
      		<iframe name="iframetag" marginwidth="0" marginheight="0" src="<?php echo $smiletagURL; ?>view.php" width="<?=$widthSUM;?>" height="192" frameborder="0" class="smiletagFrame">
			Your Browser must support IFRAME to view
			this page correctly
			</iframe>
			</td>
			</tr>
			<tr>
			<td align=left>
			<table border="0" cellpadding="0" cellspacing="0" bgcolor="#F7F7F7" width="100%">
			<tr>
			<td align="right">
  			<form name="smiletagform" method="post" action="<?php echo $smiletagURL; ?>post.php" target="iframetag">
              <b><?=_SMILE_NAME_ADD;?> </b></td><td ><input type="text" name="name" <?if(!empty($_SESSION['login_true'])){echo "value=\"".$_SESSION['login_true']."\" readonly style=\"color: #FF0000\" ";};?><?if(!empty($_SESSION['admin_user'])){echo "value=\"".$_SESSION['admin_user']."\" readonly style=\"color: #FF0000\" ";};?> size="15" /></td></tr>


<?
 if(!empty($_SESSION['login_true']) || !empty($_SESSION['admin_user'])){
} else {
if(USE_CAPCHA){
?>
			  <tr><td align="right">
	<table width="80%" border="0" cellspacing="5" cellpadding="0">
						<TR>
							<TD align=center>
							<?if(CAPCHA_TYPE == 1){ 
								echo "<img src=\"capcha/CaptchaSecurityImages.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							}else if(CAPCHA_TYPE == 2){ 
								echo "<img src=\"capcha/val_img.php?width=".CAPCHA_WIDTH."&height=".CAPCHA_HEIGHT."&characters=".CAPCHA_NUM."\" width=\"".CAPCHA_WIDTH."\" height=\"".CAPCHA_HEIGHT."\" align=\"absmiddle\" />";
							};?>
							</TD></tr>
</table></td>
							<TD align=left><input name="security_code" type="text" id="security_code" size="10" maxlength="5" style="width:60" >  
</td>
</tr>
<?
}
}
?>
<tr><td colspan="2">
              <?=_SMILE_DETAIL;?> 
			  <div id="smiley_box">
			<div class="smiley_top"><br /><a href="javascript:hideSmileyWindow();"><img src="<?php echo $smiletagURL;?>images/delete_icon.gif" alt="Close" /></a></div>
			<div class="smiley_middle">
			<div id="smiley_box_content" style="padding: 0px;" >
			<table width="80%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="center"><a href="javascript:insertSmiley(':)');"><img src="<?php echo $smiletagURL;?>images/smilies/smile.gif" alt=":)" /></a></td>
				<td align="center"><a href="javascript:insertSmiley(':D');"><img src="<?php echo $smiletagURL;?>images/smilies/laugh.gif" alt=":D" /></a></td>
				<td align="center"><a href="javascript:insertSmiley(':(');"><img src="<?php echo $smiletagURL;?>images/smilies/sad.gif" alt=":(" /></a></td>
			  </tr>
			  <tr>
				<td align="center"><a href="javascript:insertSmiley(':o');"><img src="<?php echo $smiletagURL;?>images/smilies/shock.gif" alt=":o" /></a></td>
				<td align="center"><a href="javascript:insertSmiley(':p');"><img src="<?php echo $smiletagURL;?>images/smilies/tongue.gif" alt=":p" /></a></td>
				<td align="center"><a href="javascript:insertSmiley(';)');"><img src="<?php echo $smiletagURL;?>images/smilies/wink.gif" alt=";)" /></a></td>
			  </tr>
			  <tr>
				<td align="center"><a href="javascript:insertSmiley(':|');"><img src="<?php echo $smiletagURL;?>images/smilies/blah.gif" alt=":|" /></a></td>
				<td align="center"><a href="javascript:insertSmiley('x(');"><img src="<?php echo $smiletagURL;?>images/smilies/mad.gif" alt="x(" /></a></td>
				<td align="center"><a href="javascript:insertSmiley(':~');"><img src="<?php echo $smiletagURL;?>images/smilies/drool.gif" alt=":~" /></a></td>
			  </tr>
			</table>
			</div>
			</div>
			<div class="smiley_bottom"></div>
			</div>
			<a href="<?=WEB_URL;?>" onclick="showSmileyWindow(event);return false">(<?=_SMILE_SMILE;?>)</a>
</td>
</tr>
<tr>
<td align="center" colspan="2">
<textarea name="message_box" rows="5" cols="25"></textarea><br>
              <input type="hidden" name="message" value="" />
              <div align=center><input type="submit" name="submit" value="<?=_SMILE_BUTTON_SEND;?>" onclick="clearMessage()" /> 
			  <input type="reset"  name="reset" value="<?=_SMILE_BUTTON_CLEAR;?>" /></center>
            </form>
			</td>
			  </tr>
			</table>
			</td>
			  </tr>
			</table>

