<?

$year=date('Y');
$yearlast=$year+488;
	$Year = date("Y")+544;

//include "modules/alumnus/form_search1.php";
include "modules/alumnus/config.inc.php";
?>
<form action="index.php?name=alumnus&file=addok" method="post" enctype="multipart/form-data" name="webForm" onSubmit="return check1()">
<TABLE width=471 border=0 align="center" cellPadding=3 class="style">
<TBODY>


<TR vAlign=top>
<TD vAlign=center align=right width=135><?=_ALUM_MOD_FORM_NUMID;?> :</TD>
<TD width=345><INPUT maxLength=30 size=30 name=numid><img src="modules/alumnus/img/priority.gif" width="11" height="12">
</TD>
</tr>
<TR vAlign=top>
<TD vAlign=center align=right width=108><?=_ALUM_MOD_FORM_STUID;?> :</TD>
<TD width=345><INPUT maxLength=30 size=30 name=schid> <?=_ALUM_MOD_FORM_JUM;?>
</TD>
</tr>
<TR vAlign=top>
<TD vAlign=center align=right width=108><?=_ALUM_MOD_FORM_YEAR_END;?> :</TD>
<TD width=345>
<?
echo "<select  name=yearfin size=1>
		<option >------</option>";
for($a=$yearlast;$a<$Year;$a++){
echo 	"<option value=$a>$a</option>";
}
echo "</select>";
?><img src="modules/alumnus/img/priority.gif" width="11" height="12">
</TD>
</tr>

<TR vAlign=top>
<TD vAlign=center align=right width=108>Homepage :</TD>
<TD width=345><INPUT name="website" id="website" value=http:// size=45 maxLength=100></TD>
</TR>

<TR vAlign=top>
<TD vAlign=center align=right width=108><?=_ALUM_MOD_FORM_SCHOOL;?> :</TD>
<TD width=345><INPUT maxLength=100 size=30 name=school> <?=_ALUM_MOD_FORM_SCHOOL_DETAIL;?>
</TD>
</TR>
<TR vAlign=top>
<TD align=right width=108><?=_ALUM_MOD_FORM_OFFICE;?> :</TD>
<TD width=345><INPUT maxLength=100 size=30 name=work> <?=_ALUM_MOD_FORM_OFFICE_DETAIL;?>
</TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right><?=_ALUM_MOD_FORM_HOPPY;?> :</TD>
<TD><INPUT maxLength=100 size=30 name=hobby></TD>
</TR>
<TR vAlign=top>
<TD vAlign=top align=right width=108><?=_ALUM_MOD_FORM_COMMENT;?> :</TD>
<TD width=345><textarea name="comment" cols="45" rows="3"></textarea>
<img src="modules/alumnus/img/priority.gif" width="11" height="12"></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right>ICQ :</TD>
<TD><INPUT name=icq id="icq" size=10 maxLength=10></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right>MSN :</TD>
<TD><INPUT name=msn id="msn" size=45 maxLength=50></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right>YAHOO :</TD>
<TD><INPUT name=yahoo id="yahoo" size=30 maxLength=30></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right>QQ :</TD>
<TD><INPUT name=qq id="qq" size=10 maxLength=10></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right><div align="right">Other :</div></TD>
<TD><input name="cam" type="checkbox" id="cam" value="1">
<img src="modules/alumnus/img/webcam.gif" width="23" height="18" align="absmiddle">
<input name="mic" type="checkbox" id="mic" value="1">
<img src="modules/alumnus/img/mic.gif" width="18" height="20" align="absmiddle"></TD>
</TR>
<TR vAlign=top>
<TD vAlign=center align=right><?=_ALUM_MOD_FORM_ICON;?> :</TD>
<TD><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="33%"><select name="icon" onChange="showimage()" class="text_box">
<?
								$handle=opendir('modules/alumnus/avartar/');
								while (false!==($file = readdir($handle))) { 
								 if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != "guest.gif") { 
								 echo "<option value=".$file.">$file</option>\n";
								 } 
								}
								closedir($handle);
						 	?>
</select></td>
<td width="67%"><img src="modules/alumnus/avartar/member.png" name="icons" border="0"></td>
</tr>
</table></TD>
</TR>
<TR vAlign=top>
<TD vAlign=top align=right>Emotion :</TD>
<TD><input name="emo" type="radio" value="e1" checked>
<img src="modules/alumnus/emotion/e1.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e2">
<img src="modules/alumnus/emotion/e2.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e3">
<img src="modules/alumnus/emotion/e3.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e4">
<img src="modules/alumnus/emotion/e4.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e5">
<img src="modules/alumnus/emotion/e5.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e6">
<img src="modules/alumnus/emotion/e6.gif" width="19" height="19" align="absmiddle"><br>
<input name="emo" type="radio" value="e7">
<img src="modules/alumnus/emotion/e7.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e8">
<img src="modules/alumnus/emotion/e8.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e9">
<img src="modules/alumnus/emotion/e9.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e10">
<img src="modules/alumnus/emotion/e10.gif" width="19" height="19" align="absmiddle">
<input name="emo" type="radio" value="e11">
<img src="modules/alumnus/emotion/e11.gif" width="20" height="20" align="absmiddle">
<input name="emo" type="radio" value="e12">
<img src="modules/alumnus/emotion/e12.gif" width="20" height="20" align="absmiddle"></TD>
</TR>
</TBODY>
</TABLE>
<br>

</form>
