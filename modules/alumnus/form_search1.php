 &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_alumnus.png" BORDER="0">
 <table width="750" align=center cellSpacing=0 cellPadding=0 border=0><tr><TD height="1" class="dotline" colspan="4"></TD></tr></table>
 <br>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="100%" valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="1" class="style">
<tr>
<td><FORM action="index.php?name=alumnus&file=search" method="get" name="form_search" id="form_search">
 <?=_ALUM_MOD_SEARCH_TITLE;?>
<SELECT name=list_pro size=1 id="list_pro" >
<option value="0" selected><?=_ALUM_MOD_SEARCH_LISTPRO;?></option>
<option value="msn">MSN</option>
<option value="icq">ICQ</option>
<option value="yahoo">YAHOO</option>
<option value="qq">QQ</option>
</SELECT>
<SELECT name=sex size=1 >
<option value="0" selected><?=_ALUM_MOD_FORM_SEX;?></option>
<OPTION value="1"><?=_ALUM_MOD_FORM_SEX_MAN;?></OPTION>
<OPTION value="2"><?=_ALUM_MOD_FORM_SEX_GIRL;?></OPTION>
<OPTION value="3"><?=_ALUM_MOD_FORM_SEX_BI;?></OPTION>
</SELECT>
<SELECT size=1 name=age>
<OPTION value="0" 
 selected><?=_ALUM_MOD_FORM_OLD;?></OPTION>
<OPTION value="a1"><?=_ALUM_MOD_SEARCH_OLD_DOWN;?> 18</OPTION>
<OPTION value="a2">18 - 20</OPTION>
<OPTION value="a3">21 - 30</OPTION>
<OPTION value="a4">31 - 40</OPTION>
<OPTION value="a5">41 <?=_ALUM_MOD_SEARCH_OLD_UP;?></OPTION>
</SELECT>
<?
$vprovince  = array(_PROVINCE_1, _PROVINCE_2, _PROVINCE_3, _PROVINCE_4, _PROVINCE_5, _PROVINCE_6, _PROVINCE_7, _PROVINCE_8, _PROVINCE_9, _PROVINCE_10, _PROVINCE_11, _PROVINCE_12, _PROVINCE_13, _PROVINCE_14, _PROVINCE_15, _PROVINCE_16, _PROVINCE_17, _PROVINCE_18, _PROVINCE_19, _PROVINCE_20, _PROVINCE_21, _PROVINCE_22, _PROVINCE_23, _PROVINCE_24, _PROVINCE_25, _PROVINCE_26, _PROVINCE_27, _PROVINCE_28, _PROVINCE_29, _PROVINCE_30, _PROVINCE_31, _PROVINCE_32, _PROVINCE_33, _PROVINCE_34, _PROVINCE_35, _PROVINCE_36, _PROVINCE_37, _PROVINCE_38, _PROVINCE_39, _PROVINCE_40, _PROVINCE_41, _PROVINCE_42, _PROVINCE_43, _PROVINCE_44, _PROVINCE_45, _PROVINCE_46, _PROVINCE_47, _PROVINCE_48, _PROVINCE_49, _PROVINCE_50, _PROVINCE_51, _PROVINCE_52, _PROVINCE_53, _PROVINCE_54, _PROVINCE_55, _PROVINCE_56, _PROVINCE_57, _PROVINCE_58, _PROVINCE_59, _PROVINCE_60, _PROVINCE_61, _PROVINCE_62, _PROVINCE_63, _PROVINCE_64, _PROVINCE_65, _PROVINCE_66, _PROVINCE_67, _PROVINCE_68, _PROVINCE_69, _PROVINCE_70, _PROVINCE_71, _PROVINCE_72, _PROVINCE_73, _PROVINCE_74, _PROVINCE_75, _PROVINCE_76, _PROVINCE_77);
echo "<select  name=province size=1 >
		<option >"._ALUM_MOD_FORM_PROV."</option>";
for($i=0;$i<count($vprovince);$i++){
echo 	"<option value=$vprovince[$i]>".$vprovince[$i]."</option>";
}
echo "</select>";
?>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="cam" type="checkbox" id="cam" value="1">
<img src="modules/alumnus/img/webcam.gif" width="23" height="18" align="absmiddle">
<input name="mic" type="checkbox" id="mic" value="1">
<img src="modules/alumnus/img/mic.gif" width="18" height="20" align="absmiddle">
<input name="pic" type="checkbox" id="pic" value="1">
<img src="modules/alumnus/img/pic.gif" width="15" height="12" align="absmiddle">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<INPUT class=blue type=submit value=Search name=submit>
<br>
</FORM></td>
</tr>
<tr>
<td><strong><a href="index.php"><font color="#990000"><?=_ALUM_MOD_FORM_IN;?></font></a></strong>&nbsp;&nbsp;<font color="#990000"><strong></td>
</tr>
</table></td>
</tr>
</table>