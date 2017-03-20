<?php
CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);
?>
<body>
	<TABLE cellSpacing=0 cellPadding=0 width=820 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top><IMG src="images/fader.gif" border=0></TD>
          <TD width="810" vAlign=top><IMG src="images/topfader.gif" border=0><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_admin.gif" BORDER="0"><BR>
				<TABLE width="800" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<BR><B><IMG SRC="images/icon/plus.gif" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=admin&file=main"><?=_ADMIN_GOBACK;?></A> &nbsp;&nbsp;<BR><BR>
 <br>
 <br>
 <br>
<br>
 <br><center>
<table width="350" align=center cellSpacing=3 cellPadding=2 border=0 >
<tr>
<td align="center"><a href="index.php?name=admin&file=backup"><img src="images/admin/data.png" border="0"><br><?=_ADMIN_BACKUP_SELECT_DATA;?></a></td>
<td align="center"><a href="index.php?name=admin&file=backupdb"><img src="images/admin/db.png" border="0"><br><?=_ADMIN_BACKUP_SELECT_DATABASE;?></a></td>
</tr>
</table>
<br>
<br>


</td>
</tr>
</table>
				</TD>
				</TR>
			</TABLE>
