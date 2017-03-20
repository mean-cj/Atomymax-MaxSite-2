<?

if(!$login_true) {
echo "<meta http-equiv=refresh content=2;URL=?name=member>" ; 
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net

?>
<TABLE WIDTH="750"  border="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
  <TR>
            <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top >

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" colspan="4"></TD>
				</TR>
      <TR>
        <TD> </TD>
      </TR>
      <TR>
        <TD><DIV ALIGN="center">
            <P>&nbsp;</P>
            <P><IMG SRC="images/icon/dangerous.png" WIDTH="48" HEIGHT="42"> </P>
          </DIV>
            <P ALIGN="center"><?=_MEMBER_MOD_CHECK_NOACC;?>
            <P ALIGN="center">
            <P ALIGN="center">
          <P ALIGN="center"></TD>
      </TR>
    </TABLE></TD>
  </TR>
</TABLE>
<? 
exit();	
} ?>