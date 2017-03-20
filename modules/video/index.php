	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top><BR>
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_video.gif" BORDER="0"><BR>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>

				<TR>
					<TD>
					<A HREF="?name=video"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"><b><font color="#0033FF" size="2"> <?=_VIDEO_MOD_MENU_MAIN;?></A> &nbsp;&nbsp;&nbsp;<? if($admin_user){?><A HREF="?name=admin&file=video&op=video_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_VIDEO_MOD_MENU_ADD_FILE;?></A>&nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video_youtube"><IMG SRC="images/admin/7_40.gif"  BORDER="0" align="absmiddle"> <?=_VIDEO_MOD_MENU_ADD_YOUTUBE;?> </A>  &nbsp;&nbsp;&nbsp;<A HREF="?name=admin&file=video_category&op=videocat_add"><IMG SRC="images/admin/opendir.gif"  BORDER="0" align="absmiddle"> <?=_VIDEO_MOD_MENU_ADD_CAT;?></A><?}?></font></td></tr>
									<TR>
					<TD height="1" class="dotline"></TD>
				</TR><td>
		  <div align="right">
</script>
<style type="text/css">
.search {
  background-color:yellow;
  color:green;
}
</style>
			<script language='JavaScript'>
					function checkboard() {
						if(document.formboard.keyword.value=='') {
						alert('<?echo _FROM_SEARCH_NULL;?>') ;
						document.formboard.keyword.focus() ;
						return false ;
						}
						else
						return true ;
						}
                      </script> 

              <table width="740" align="center" align="left" border="0">
                <tr>
                <td height="50" bgcolor="#F8F8F8"><form name="formsearch" method="post" action="?name=video&file=video_search">
                    <div align="left">
&nbsp;&nbsp;<strong><font color="#009933"><?=_FROM_SEARCH_WORD;?></font></strong>&nbsp;
            <input type="text" name="keyword" value="<? echo"$keyword"; ?>">
&nbsp;&nbsp;&nbsp;<strong> <?=_FROM_SEARCH_FIELD;?></strong>
            <select name="fields">
              <option value="id" <? if($_POST['fields']=='id'){echo "selected";}?>><?=_FROM_SEARCH_FIELD_ID;?> </option>
              <option value="topic" <? if($_POST['fields']=='topic'){echo "selected";}?>><?=_FROM_SEARCH_FIELD_TOPIC;?> </option>
              <option value="headline" <? if($_POST['fields']=='headline'){echo "selected";}?>><?=_FROM_SEARCH_FIELD_HEADLINE;?></option>
            </select>
&nbsp;&nbsp;&nbsp;
            <input type="hidden" name="category" value="<?=$category;?>">
            <input type="submit" name="Submit" value="<?=_FROM_SEARCH_BUTTON;?>">
&nbsp;<b><img src="images/admin/opendir.gif" align="absmiddle"> <a href="?name=video"><?=_FROM_SEARCH_ALL;?></a>
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  &nbsp;&nbsp;&nbsp;&nbsp;<a href="?name=admin&file=video&op=article_add"><img src="images/admin/i-editor.png" align="absmiddle"> </a>
<?
}
?>
<br>
          </b></div>
                </form></td>
              </tr>
<tr>
			<form name="categoty" method="post" enctype="multipart/form-data"><center>
                  <td bgcolor="#F8F8F8"><div align="left"> &nbsp;&nbsp;<strong><font color="#009933"><?=_FROM_SEARCH_CAT;?> :</font></strong>&nbsp;
                          <select name="category" onchange="if(options[selectedIndex].value){location = options[selectedIndex].value};  MM_jumpMenu('parent',this,0)">
                            <option value="?name=video"><?=_FROM_SEARCH_CAT_ALL;?></option>
                            <?

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." ORDER BY sort  ");
while($arr['category'] = $db->fetch($res['category'])){
	echo "<option value=\"?name=video&category=".$arr['category']['id']."\" ";
	if($category == $arr['category']['id']){
		echo " Selected";
	}
	echo ">".$arr['category']['category_name']."</option>\n";
}
$db->closedb ();
// ระบบค้นหา video ของ maxsite 1.10 พัฒนาโดย www.narongrit.net
empty($_GET['category'])?$category="":$category=$_GET['category'];
empty($_POST['fields'])?$fields="":$fields=$_POST['fields'];
empty($_POST['keyword'])?$keyword="":$keyword=$_POST['keyword'];
?>
                          </select>
&nbsp;&nbsp; </div></td>
            </form>
</tr>
            </table>
				<TABLE width=740 align=center cellSpacing=0 cellPadding=0 border=0>
<?
//แสดงข่าวสาร/ประชาสัมพันธ์ 
if($category){
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " WHERE category='".$category."' ";
} else {
	$SQLwhere = "";
	$SQLwhere2 = "";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 10 ;
$SUMPAGE = $db->num_rows(TB_VIDEO,"id","".$SQLwhere."");

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." ".$SQLwhere2." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['video'] = $db->fetch($res['video'])){
	if ($count==0) { echo "<TR>"; }

	$content = $arr['video']['detail'];
	$Detail = stripslashes(FixQuotes($content));
	$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." WHERE id='".$arr['video']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$videoid=$arr['video']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(video_id) as com FROM ".TB_VIDEO_COMMENT." WHERE video_id ='".$videoid."' group by video_id"); 
	$arrs['com'] = $db->fetch($ress['com']);
	if($arr['video']['youtube']==1){
$durationx=timeyoutube($arr['video']['times']);
} else {
$durationx = $arr['video']['times'];
}
?>
													<TD width="33%" valign=top align="center">	
														<TABLE width="100%" border=0 cellSpacing=0 cellPadding=0>
															<tr>
															<TD align="center" >
															<TABLE width="200" border=0 cellSpacing=0 cellPadding=0>
															<tr>
															<TD align="left" ><img src="images/video_icon.png" border="0"> <b><? echo $arr['video']['topic'];?></b>
															</td>
															</tr>
															<TD align="left" ><b>By : <FONT COLOR="#990000"><? echo $arr['video']['posted'];?></font></b>
															</td>
															</tr>
															<tr>
															<TD align="center" >
															<div class="photo" >
<a HREF="index.php?name=video&file=readvideo&id=<?=$arr['video']['id'];?>" ><span></span><img src="<?if ($arr['video']['youtube']!=1){ if ($arr['video']['pic']){echo "video/thumbs/".$arr['video']['pic'].""; } else{ echo "images/video_blank.gif";} }else { echo "http://img.youtube.com/vi/".$arr['video']['video']."/default.jpg";}?>" width="<?=_IVIDEOT_W;?>" height="<?=_IVIDEOT_H;?>"></a>
<div class="photox"><?echo $durationx;?></div>
															</div>
															</td>
															</tr>
															<tr >
															<TD align="left" ><b>Rated :</b> <? $rater_ids=$arr['video']['id'];$rater_item_name='video';include("modules/rater/raterx.php");?>
															</td>
															</tr>
<?
//$date = date("D M j G:i:s T Y",$arr['video']['post_date']);
$date = date("M,j Y",$arr['video']['post_date']);
?>
															<tr >
															<TD align="left" ><b>Added :</b> <? echo $date ;?>
</td>
</tr>
<tr >

					<TD align="left" ><b>Duration : </b><? echo "".$durationx."";?>
</td>
</tr>
															</table>
															</td>
															</tr>
															</TABLE>

													</TD>
<?
$count++;
if (($count%_VIDEO_COL) == 0) { echo "</TR><TR><TD colspan=3 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
}
$db->closedb ();
//จบการแสดงข่าวสาร
?>
				</TABLE>
				<BR>
				<table border="0" cellpadding="0" cellspacing="1" width=740 align=center>
					<tr>
						<td>
				<?
				SplitPage($page,$totalpage,"?name=video&category=".$category."");
				echo $ShowSumPages ;
				echo "<BR>";
				echo $ShowPages ;
				?>
						</td>
					</tr>
				</table>
				<BR><BR>

						</td>
					</tr>
				</table>
		  </TD>
        </TR>
      </TBODY>
    </TABLE>

