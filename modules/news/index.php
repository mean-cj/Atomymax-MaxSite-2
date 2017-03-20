<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options['selObj.selectedIndex'].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
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
    <TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width=740 vAlign=top>
		  <!-- News -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_news.gif" BORDER="0">
		  <h1></h1>
		  <div align="right">
              <table width="740" align="center" align="left" border="0">
                <tr>
                <td height="50" bgcolor="#F8F8F8"><form name="formsearch" method="post" action="?name=news&file=news_search">
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
&nbsp;<b><img src="images/admin/opendir.gif" align="absmiddle"> <a href="?name=news"><?=_FROM_SEARCH_ALL;?></a>
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  &nbsp;&nbsp;&nbsp;&nbsp;<a href="?name=admin&file=news&op=article_add"><img src="images/admin/i-editor.png" align="absmiddle"> </a>
<?
}
?>
<br>
          </b></div>
                </form></td>
              </tr>
<tr>
			<form name="categoty" method="post" enctype="multipart/form-data"><center>
                  <td bgcolor="#F8F8F8"><div align="left"> &nbsp;&nbsp;<strong><font color="#009933"><?=_FROM_SEARCH_CAT;?> </font></strong>&nbsp;
                          <select name="category" onchange="if(options[selectedIndex].value){location = options[selectedIndex].value};  MM_jumpMenu('parent',this,0)">
                            <option value="?name=news"><?=_FROM_SEARCH_CAT_ALL;?></option>
                            <?

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." ORDER BY sort  ");
while($arr['category'] = $db->fetch($res['category'])){
	echo "<option value=\"?name=news&category=".$arr['category']['id']."\" ";
	if($category == $arr['category']['id']){
		echo " Selected";
	}
	echo ">".$arr['category']['category_name']."</option>\n";
}
$db->closedb ();
// ระบบค้นหา news ของ maxsite 1.10 พัฒนาโดย www.narongrit.net
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
$SUMPAGE = $db->num_rows(TB_NEWS,"id","".$SQLwhere."");

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$res['news'] = $db->select_query("SELECT * FROM ".TB_NEWS." ".$SQLwhere2." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['news'] = $db->fetch($res['news'])){
	if ($count==0) { echo "<TR>"; }
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_NEWS_CAT." WHERE id='".$arr['news']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
		$content = $arr['news']['headline'];
	$Detail = stripslashes(FixQuotes($content));
		$ress['com'] = $db->select_query("SELECT *,count(news_id) as com FROM ".TB_NEWS_COMMENT." WHERE news_id ='".$arr['news']['id']."' group by news_id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>
			<TD width="50%" valign=top align=left>	
				<TABLE width="100%">
				<TR>
					<TD><FONT COLOR="#990000"><B>
					<?= ThaiTimeConvert($arr['news']['post_date'],"","");?> : </font><FONT COLOR="#3333FF"><?=$arr['category']['category_name'];?>
					</B></FONT></TD>
				</TR>
				<TR><TD height="3" ></TD></TR>
				<TR>
					<TD valign="top" align="center">
					<A HREF="?name=news&file=readnews&id=<?=$arr['news']['id'];?>" target="_blank">
					<?if ($arr['news']['pic']==1){echo "<img  src=icon/news_".$arr['news']['post_date'].".jpg class=mysborder border=0 align=center>";} else {echo "<img class=mysborder src=images/icon/".$arr['category']['icon']." border=0 align=center>";} ?></a>
					</td>
					</tr>
					<tr>
					<td colspan="2" ><img src="images/a.gif"><A HREF="?name=news&file=readnews&id=<?=$arr['news']['id'];?>" ><B><?=$arr['news']['topic'];?></A></B>
					<?NewsIcon(TIMESTAMP, $arr['news']['post_date'], "images/icon_new.gif");?>( <?=$arr['news']['pageview'];?> / <?=$arrs['com']['com'];?> )
				<BR>&nbsp;&nbsp;&nbsp;&nbsp;<?=$Detail;?><br><?$rater_ids=$arr['news']['id'];$rater_item_name="news";include("modules/rater/raters.php");?>
					</TD>
				</TR>
				<TR><TD height="3" ></TD></TR>
				</TABLE>
			</TD>
<?
$count++;
if (($count%_NEWS_COL) == 0) { echo "</TR><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
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
				SplitPage($page,$totalpage,"?name=news&category=".$category."");
				echo $ShowSumPages ;
				echo "<BR>";
				echo $ShowPages ;
				?>
						</td>
					</tr>
				</table>
				<BR><BR>

			<!-- End News -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
