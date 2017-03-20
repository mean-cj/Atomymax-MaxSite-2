<?php
empty($_GET['op'])?$op="":$op=$_GET['op'];
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD); // Connect DB
$res['page'] = $db->select_query("SELECT * FROM ".TB_PAGE." WHERE name='". $_GET['op']."' "); // Query page information from database.
$arr['page'] = $db->fetch($res['page']);

$content = $arr['page']['detail'];
$Detail = stripslashes(FixQuotes($content));
$db->closedb (); // Disconnect DB
?>
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/more.gif" BORDER="0">
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD>
<div class="content-header"><b><FONT COLOR="#990000" size="2"><?php echo $arr['page']['menuname'];?>&nbsp;&nbsp;</b></font> <!– Input "menuname" in page header –>
<?php
if($admin_user){
// Show edit button for admin
echo '

<a href="?name=admin&file=page&op=page_edit&id='.$arr['page']['id'].'"><img src="images/admin/edit.gif" border="0" alt="'._FROM_IMG_EDIT.'" ></a>
';
}
?>
</div>
</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
<tr>
<td>
<br />
<?php echo $Detail; // Show Page Content ?>
<br />
</td>
</tr>
</table>
</td>
</tr>
</table>

