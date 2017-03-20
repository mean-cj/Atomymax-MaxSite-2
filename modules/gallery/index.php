<link rel="stylesheet" href="css/backbox.css" type="text/css" />
<script type="text/javascript" src="js/prototype.compressed.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<script type="text/javascript" src="js/dhtmlHistory.js"></script>
<script type="text/javascript" src="js/customsignsheader.js"></script>
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_gallery.gif" BORDER="0"><BR>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>

				<TR>
					<TD>
					<A HREF="?name=gallery"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"><b><font color="#0033FF" size="2"> <?=_GALLERY_MENU_MAIN;?></A> &nbsp;&nbsp;&nbsp;<? if($admin_user){?><A HREF="?name=admin&file=gallery&op=gallery_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_GALLERY_MENU_ADD_IMG;?> </A>  &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=gallery_category&op=gallerycat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?=_GALLERY_MENU_ADD_CAT;?></A><?}?></font></td></tr>
									<TR>
					<TD height="1" class="dotline"></TD>
				</TR><td>
<?
//////////////////////////////////////////// áÊ´§ÃÒÂ¡ÒÃGALLERY 
if($op == ""){
	$limit = 10 ;
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$SUMPAGE = $db->num_rows(TB_GALLERY_CAT,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <table width="100%" cellspacing="2" cellpadding="1" >

<?
$count=0;
$res['gallery'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT." ORDER BY id DESC LIMIT $goto, $limit ");
while($arr['gallery'] = $db->fetch($res['gallery'])){
	if ($count==0) { echo "<TR>"; }
	$res['category'] = $db->select_query("SELECT * FROM ".TB_GALLERY." WHERE category='".$arr['gallery']['id']."' order by rand() limit 1");
	$arr['category'] = $db->fetch($res['category']);

?>
     <td width="30%" valign="top">
	 <table>
	 <tr>
	 <td width="<?=(_IGALLERYT_W)+35;?>" valign="top">
<table cellspacing=0 cellpadding=0 border=0 >
<tr>
<td  height=14 border=0 background= "images/border/TL.gif"></td>
<td  height=14 border=0 background="images/border/TT.gif"></td>
<td height=14  border=0 background= "images/border/TR.gif"></td></tr>
<tr><td   width=30 border=0 background= "images/border/LL.gif"></td>
<td  border=0>
<a href="?name=gallery&op=gallery_detail&id=<? echo $arr['gallery']['id'];?>">
<img width="<?=_IGALLERYT_W;?>" src="<?if($arr['category']['id']){ echo "images/gallery/gal_".$arr['gallery']['post_date']."/thb_".$arr['category']['pic'].""; } else { echo "images/news_blank.gif";}?>" />
</a></td>
<td width=14 border=0 background= "images/border/RR.gif"></td></tr>
<tr><td  height=15 border=0 background= images/border/BL.gif></td>
<td  height=15 border=0 background= "images/border/BB.gif"></td>
<td height=15 border=0 background= "images/border/BR.gif"></td></tr></table>
</td>
<td valign="top">
<font color="#990000"><b><a href="?name=gallery&op=gallery_detail&id=<? echo $arr['gallery']['id'];?>"><? echo $arr['gallery']['category_name'];?></b></font></a><?=NewsIcon(TIMESTAMP, $arr['gallery']['post_date'], "images/icon_new.gif");?> ( <?echo ThaiTimeConvert($arr['gallery']['post_date'],'','');?> ) <? if($admin_user){?><a href="?name=admin&file=gallery_category&op=gallerycat_edit&id=<? echo $arr['gallery']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=gallery_category&op=gallerycat_del&id=<? echo $arr['gallery']['id'];?>&pic=<? echo $arr['gallery']['pic'];?>&prefix=<? echo $arr['gallery']['post_date'];?>','<?echo _FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a><?}?><br>&nbsp;&nbsp;&nbsp;&nbsp;<? echo $arr['gallery']['category_detail'];?>
</td>
</tr>
</table>
</td>

<?
$count++;
//if (($count%_GALLERYCAT_COL) == 0) { echo "</TR><TR><TD colspan=3 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
 //else{
	//echo "</TD>";
//} 
echo "</TR><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>";
}
?>

 </table>
<?
	SplitPage($page,$totalpage,"?name=gallery");
	echo "$ShowSumPages ["._GALLERY_PAGE_NUM." $SUMPAGE "._GALLERY_PAGE_NUM1."]";
	echo "<BR>";
	echo $ShowPages ;
}

else if($_GET['op'] == "gallery_detail"){
	//////////////////////////////////////////// ´ÙÃÒÂÅÐàÕÍÕÂ´ã¹ gallery


if($_GET['id']){
	$SQLwhere = " where id='".$_GET['id']."' ";
	$SQLwhere2 = " WHERE category='".$_GET['id']."' ";
}

	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 15 ;
	$SUMPAGE = $db->num_rows(TB_GALLERY,"id"," category=".$_GET['id']."");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
	$res['cat'] = $db->select_query("SELECT * FROM ".TB_GALLERY_CAT."  WHERE id='".$_GET['id']."' ");
$arr['cat'] = $db->fetch($res['cat']);
$CAT=$arr['cat']['post_date'];

?>
 <table width="100%" cellspacing="2" cellpadding="1" >
<tr>
<td bgcolor="#F7F7F7" colspan="<?=_GALLERY_COL;?>"><font color="#990000" size="4"><b> >> <? echo $arr['cat']['category_name'];?></b></font></a>  <?=NewsIcon(TIMESTAMP, $arr['cat']['post_date'], "images/icon_new.gif");?> ( <?echo ThaiTimeConvert($arr['cat']['post_date'],'','');?> )  <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font size="2"><? echo $arr['cat']['category_detail'];?>
</font></td>
</tr>
<tr>
<td colspan="<?=_GALLERY_COL;?>">&nbsp;&nbsp;<td>
</tr>

<?

$count=0;
$res['gallery'] = $db->select_query("SELECT * FROM ".TB_GALLERY." WHERE category='".$arr['cat']['id']."' ORDER BY id DESC LIMIT $goto, $limit");
while($arr['gallery'] = $db->fetch($res['gallery'])){
	if ($count==0) { echo "<TR>"; }
?>
     <td valign="top" align="center">
	 <table cellpadding="0" cellspacing="0" border="0" id="Table_01" class='iconframe'>
	 <tr>
	 <td width="<?=_IGALLERYT_W+35;?>" colspan="2" class='imageframe'>
	 			<table cellspacing=0 cellpadding=0 border=0 class='iconframe'>
				<tr>
				<td  border=0  align="center" class='imageframe'>
				<div onclick="dhtmlHistory.add('location1',{message: 'backbox'});countdown()">
				<a HREF="images/gallery/<? echo "gal_".$CAT."/".$arr['gallery']['pic'];?>" rel="lightbox[slide]" caption="<?echo $arr['gallery']['pic'];?>"><img class="highslide-display-block" border=0 src="<?if($arr['gallery']['id']){ echo "images/gallery/gal_".$CAT."/thb_".$arr['gallery']['pic'].""; } else { echo "images/news_blank.gif";}?>" /></a></div></td><a HREF="images/gallery/<? echo "gal_".$CAT."/".$arr['gallery']['pic'];?>" rel="lightbox[slide]" caption="<?echo $arr['gallery']['pic'];?>"></a><td class='shadow_right'><div class='shadow_top_right'></div></td>
</tr>
<tr>
  <td class='shadow_bottom'><div class='shadow_bottom_left'></div></td>
  <td class='shadow_bottom_right'></td>
  </tr>
<tr>
<td align="right">
<a HREF="index.php?name=gallery&file=readgal&id=<?=$arr['gallery']['id'];?>" ><img src="images/icon-view.gif" border="0"></a> <? if($admin_user){?><a href="javascript:Confirm('?name=admin&file=gallery&op=gallery_del&cat=<? echo $CAT;?>&id=<? echo $arr['gallery']['id'];?>&pic=<? echo $arr['gallery']['pic'];?>&cats=<? echo $arr['cat']['id'];?>&prefix=<? echo $arr['gallery']['post_date'];?>','<?echo _FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a><?}?>
</td>
</tr>
<tr>
<td align="left"><?=_FORM_MOD_POSTED;?> <?=$arr['gallery']['posted'];?> (VIEW : <?=$arr['gallery']['pageview'];?>)<?=NewsIcon(TIMESTAMP, $arr['gallery']['post_date'], "images/icon_new.gif");?>
</td>
</tr>
  </table>

</td>
</tr>

</table>
</td>
<?
$count++;
if (($count%_GALLERY_COL) == 0) { echo "</TR><TR><TD colspan=5 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
 
}
echo "</table>";
?>
  <script type="text/javascript" src="js/customsignsfooter.js"></script>
<?
	SplitPage($page,$totalpage,"?name=gallery&op=gallery_detail&id=".$_GET['id']."");
	echo "$ShowSumPages ["._GALLERY_PAGE_NUM_IMG." $SUMPAGE "._GALLERY_PAGE_NUM_IMG1."]";
	echo "<BR>";
	echo $ShowPages ;


}
?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
				</TD>
				</TR>
			</TABLE>
