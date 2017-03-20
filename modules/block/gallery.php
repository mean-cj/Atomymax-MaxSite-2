<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>

 <table width="<?=$widthSUM;?>" cellspacing="0" cellpadding="0" border="0">
<tr>
<td width="<?=$widthSUM;?>" align="center">
<?
echo "<MARQUEE scrollamount='3' scrolldelay='30' align='center' direction='up' width='185' height='300'  onmouseover='this.stop()' onmouseout='this.start()'>";
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);

$res['gallerys'] = $db->select_query("SELECT * FROM ".TB_GALLERY." ORDER BY id DESC LIMIT 8");
while($arr['gallerys'] = $db->fetch($res['gallerys'])){
$res['cat'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT."  WHERE id='".$arr['gallerys']['category']."' ");
$arr['cat'] = $db->fetch($res['cat']);
$CAT=$arr['cat']['post_date'];
?>

	 <table cellpadding="0" cellspacing="0" border="0" width="<?=$widthSUM;?>">
	   <tr>
  <td colspan="2" align="center"><?=NewsIcon(TIMESTAMP, $arr['gallerys']['post_date'], "images/icon_new.gif");?>
  </td>
  </tr>

	 <tr>
	 <td colspan="2" align="center">
	 <table cellspacing=0 cellpadding=0 border=0 class='iconframe' ><tr><td  border=0  align="center"><a HREF="index.php?name=gallery&file=readgal&id=<?=$arr['gallerys']['id'];?>" >
                <img class="highslide-display-block" border=0 src="images/gallery/gal_<? echo "".$CAT."/thb_".$arr['gallerys']['pic'];?>" style="filter:alpha(opacity=50)" onMouseover="makevisible(this,0)" onMouseout="makevisible(this,1)" />
              </a></td><td class='shadow_right'><div class='shadow_top_right'></div></td>
</tr>
<tr>
  <td class='shadow_bottom'><div class='shadow_bottom_left'></div></td>
  <td class='shadow_bottom_right'></td>
  </tr>
  </table>
  </td>
  </tr>

  </table>
<?
}
echo "</MARQUEE>";
?>

</td>
</tr>
</table>

