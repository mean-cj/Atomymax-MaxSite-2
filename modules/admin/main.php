<?
CheckAdmin($_SESSION['admin_user'], $_SESSION['admin_pwd']);
?>
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