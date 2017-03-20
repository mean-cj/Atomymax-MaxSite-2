<?
//////////////////////		 เพิ่ม  สมาชิกออนไลน์   ////////////////////////////
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$db->del(TB_useronline," useronline='".$login_true."' "); 
			$db->closedb ();
//////////////////////		 เพิ่ม  สมาชิกออนไลน์   ////////////////////////////	
//ระบบสมาชิกเสริม maxsite 1.10 พัฒนาโดย www.narongrit.net
session_destroy() ;
setcookie("login_true");
echo "<meta http-equiv=refresh content=3;URL=index.php>" ; 

?>


<table width="750"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
            <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top >

      &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_member.gif" BORDER="0">
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
				<TR>
					<TD height="1" class="dotline" colspan="4"></TD>
				</TR>
      <tr>
        <td> </td>
      </tr>
      <tr>
        <td width="100%"><div align="center">
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><b><?=_MEMBER_MOD_FORM_LOGOUT_MESS;?></b></font> </p>
          </div>
            <p align="center"></p>
            <p align="center"><font size="3" face="MS Sans Serif, Tahoma, sans-serif"><?=_MEMBER_MOD_FORM_LOGOUT_WAIT;?></font>
            <br><br><br><br><br><br><br><br></td>
      </tr>
    </table></td>
  </tr>
</table>
