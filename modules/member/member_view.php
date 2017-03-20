<?php
$_GET['id'] = intval($_GET['id']);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['member'] = $db->select_query("SELECT * FROM ".TB_MEMBER."  where id='".$_GET['id']."' ");
//$dbarr[member] = $db->fetch($res[member]);
$NRow = mysql_num_rows($res['member']);
$arr = mysql_fetch_row( $res['member'] );

?>
<!-- จาวา แถบสี -->
<SCRIPT LANGUAGE="javascript"> 
function mOvr(src,clrOver){ 
if (!src.contains(event.fromElement)){ 
src.style.cursor = 'hand'; 
src.bgColor = clrOver; 
} 
} 
function mOut(src,clrIn){ 
if (!src.contains(event.toElement)){ 
src.style.cursor = 'default'; 
src.bgColor = clrIn; 
} 
} 
</SCRIPT>


<center><table width="450" height="300" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCE9FD">
<tr>
<td valign="top" bgcolor="#FFFFFF" align="center"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCE9FD" class="style">
<tr valign="top">
<td width="20%" rowspan="14" bgcolor="#FFFFFF"><div align="center"><? if ($arr[20]=="") { echo "<img src=modules/alumnus/photo/nopic.gif>"; } else { echo "<img src=icon/$arr[20]>"; } ?>
    <br>
    <? echo "[ $arr[17] ]"; ?><br>
</div></td>
<td width="23%" bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><? echo _MEMBER_MOD_MEMDETAIL_NAME;?>&nbsp;:&nbsp;</strong></font></div></td>
<td width="57%" bgcolor="#FFFFFF"><? echo "$arr[2]"; ?></td>
</tr>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><?=_MEMBER_MOD_FORM_USER_NICK;?>&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "$arr[3]"; ?></td>
</tr>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><? echo _MEMBER_MOD_MEMDETAIL_BIRTDAY;?>&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "$arr[4]/$arr[5]/$arr[6]"; ?></td>
</tr>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><?=_MEMBER_MOD_MEMDETAIL_AGE;?>&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "$arr[7]"; ?></td>
</tr>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><? echo _MEMBER_MOD_MEMDETAIL_SEX;?>&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "$arr[8]"; ?></td>
</tr>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong>E-mail&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "<a href=mailto:$arr[19]>$arr[19]&nbsp;&nbsp;<img src=\"images/icon/email.gif\" border=\"0\" title=\"".$arr[19]."\" /></a>"; ?></td>
</tr>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><?=_MEMBER_MOD_MEMDETAIL_ADDRESS;?>&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "$arr[9]"; ?></td>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><?=_MEMBER_MOD_MEMDETAIL_AMP;?>&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "$arr[10]"; ?></td>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><?=_MEMBER_MOD_MEMDETAIL_PROV;?>&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "$arr[11]"; ?></td>
</tr>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><?=_MEMBER_MOD_MEMDETAIL_POST;?>&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "$arr[12]"; ?></td>
</tr>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><?=_MEMBER_MOD_MEMDETAIL_PHONE;?>&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "$arr[13]"; ?></td>
</tr>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><?=_MEMBER_MOD_FORM_WORK;?>&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "$arr[15]"; ?></td>
</tr>
<tr valign="top">
<td bgcolor="#FFFFFF"><div align="right"><font color="#990000"><strong><? echo _MEMBER_MOD_FORM_EDUCATION;?>&nbsp;:&nbsp;</strong></font></div></td>
<td bgcolor="#FFFFFF"><? echo "$arr[14]"; ?></td>
</tr>

</table></td>
</tr>
</table>