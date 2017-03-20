
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
          <TD width="740" vAlign=top>
		  <!-- knowledge -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_knowledge.gif" BORDER="0">
		  <div align="right">
              <table width="740" align="center" align="left" border="0">
                <tr>
                <td height="50" bgcolor="#F8F8F8"><form name="formsearch" method="post" action="?name=knowledge&file=knowledge_search">
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
&nbsp;<b><img src="images/admin/opendir.gif" align="absmiddle"> <a href="?name=knowledge"><?=_FROM_SEARCH_ALL;?></a>
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  &nbsp;&nbsp;&nbsp;&nbsp;<a href="?name=admin&file=knowledge&op=article_add"><img src="images/admin/i-editor.png" align="absmiddle"> </a>
<?
}
?>
<br>
          </b></div>
                </form></td>
              </tr>
<tr>
			<form name="categoty" method="post" enctype="multipart/form-data"><center>
                  <td bgcolor="#F8F8F8"><div align="left"> &nbsp;&nbsp;<strong><font color="#009933"><?=_FROM_SEARCH_CAT;?></font></strong>&nbsp;
                          <select name="category" onchange="if(options[selectedIndex].value){location = options[selectedIndex].value};  MM_jumpMenu('parent',this,0)">
                            <option value="?name=knowledge"><?=_FROM_SEARCH_CAT_ALL;?></option>
                            <?

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE_CAT." ORDER BY sort  ");
while($arr['category'] = $db->fetch($res['category'])){
	echo "<option value=\"?name=knowledge&category=".$arr['category']['id']."\" ";
	if($category == $arr['category']['id']){
		echo " Selected";
	}
	echo ">".$arr['category']['category_name']."</option>\n";
}
$db->closedb ();
// ระบบค้นหา knowledge ของ maxsite 1.10 พัฒนาโดย www.narongrit.net
empty($_GET['category'])?$category="":$category=$_GET['category'];
empty($_POST['fields'])?$fields="":$fields=$_POST['fields'];
empty($_POST['keyword'])?$keyword="":$keyword=$_POST['keyword'];
?>
                          </select>
&nbsp;&nbsp; </div></td>
            </form>
</tr>
            </table>
            <? 


if (empty($keyword) or empty($fields))
{
?>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
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
$SUMPAGE = $db->num_rows(TB_KNOWLEDGE,"id","$SQLwhere");

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$res['knowledge'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE." $SQLwhere2 ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['knowledge'] = $db->fetch($res['knowledge'])){
	if ($count==0) { echo "<TR>"; }
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE_CAT." WHERE id='".$arr['knowledge']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$content = $arr['knowledge']['headline'];
	$Detail = stripslashes(FixQuotes($content));
			$ress['com'] = $db->select_query("SELECT *,count(knowledge_id) as com FROM ".TB_KNOWLEDGE_COMMENT." WHERE knowledge_id ='".$arr['knowledge']['id']."' group by knowledge_id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>
			<TD width="50%" valign=top align=left>	
				<TABLE width="100%">
				<TR>
					<TD><FONT COLOR="#990000"><B>
					<?= ThaiTimeConvert($arr['knowledge']['post_date'],"","");?> : </font><FONT COLOR="#3333FF"><?=$arr['category']['category_name'];?>
					</B></FONT></TD>
				</TR>
				<TR><TD height="3" ></TD></TR>
				<TR>
					<TD valign="top" align="center">
					<A HREF="?name=knowledge&file=readknowledge&id=<?=$arr['knowledge']['id'];?>" target="_blank">
					<?if ($arr['knowledge']['pic']==1){echo "<img  src=icon/knowledge_".$arr['knowledge']['post_date'].".jpg  class=mysborder border=0 align=center>";} else {echo "<img class=mysborder src=images/icon/".$arr['category']['icon']." border=0 align=center>";} ?></a>
					</td>
					</tr>
					<tr>
					<td colspan="2" ><img src="images/a.gif"><A HREF="?name=knowledge&file=readknowledge&id=<?=$arr['knowledge']['id'];?>" ><B><?=$arr['knowledge']['topic'];?></A></B>
					<?NewsIcon(TIMESTAMP, $arr['knowledge']['post_date'], "images/icon_new.gif");?>( <?=$arr['knowledge']['pageview'];?> / <?=$arrs['com']['com'];?> )
					<BR>&nbsp;&nbsp;&nbsp;&nbsp;<?=$Detail;?><br><?$rater_ids=$arr['knowledge']['id'];$rater_item_name='knowledge';include("modules/rater/raters.php");?>
					</TD>
				</TR>
				<TR><TD height="3" ></TD></TR>
				</TABLE>
			</TD>
<?
$count++;
if (($count%_KNOW_COL) == 0) { echo "</TR><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
}
$db->closedb ();
//จบการแสดงข่าวสาร
?>
				</TABLE>
				<BR>
				<table border="0" cellpadding="0" cellspacing="1" width="700" align=center>
					<tr>
						<td>
				<?
				SplitPage($page,$totalpage,"?name=knowledge&category=".$category."");
				echo $ShowSumPages ;
				echo "<BR>";
				echo $ShowPages ;
				?>
						</td>
					</tr>
				</table>
				<BR><BR>
<?


} else { 
function highlight($word, $subject) {
  $pattern = '/(>[^<]*)('.$word.')/i';
  $replacement = '\1<span class="search">\2</span>';
  return preg_replace($pattern, $replacement, $subject);
}
if (!empty($keyword)){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql="select * From ".TB_KNOWLEDGE." where $fields like '%$keyword%'";	//เลือกข้อมูลใน DB จากตารางหมวด
$result = mysql_query($sql);
$num_rows=mysql_num_rows($result);				//จำนวนเรคอร์ด

if(empty($num_rows)) /* ตรวจสอบว่ามีอยู่หรือยัง */
{
		if ($fields=="id") { $fields=_FROM_SEARCH_FIELD_ID; }
		else if ($fields=="topic") { $fields=_FROM_SEARCH_FIELD_TOPIC; }
		else { $fields=_FROM_SEARCH_FIELD_HEADLINE; }
echo"<center><br><br>"._FROM_SEARCH_ACC_NULL."<b>$keyword</b> "._FROM_SEARCH_FIELD." <b>$fields </b> </center><br><br><br><br><br>";
} else {
		if ($fields=="id") { $fields=_FROM_SEARCH_FIELD_ID; }
		else if ($fields=="topic") { $fields=_FROM_SEARCH_FIELD_TOPIC; }
		else { $fields=_FROM_SEARCH_FIELD_HEADLINE; }
		echo "<center> "._FROM_SEARCH_ACC." <b>$keyword</b> "._FROM_SEARCH_FIELD." <b>$fields</b> "._FROM_SEARCH_ACC_YES." <b>$num_rows</b> "._FROM_SEARCH_ACC_DATA." </center><br> ";  
}
} else {
echo"<center><br><br>"._FROM_SEARCH_NULL."</b> </center><br><br><br><br><br>";
}
?>
          </div>
		  <TABLE width="650" align=center cellSpacing=0 cellPadding=0 border=0>
            <?

//แสดงสาระความรู้ 
if($category){
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " WHERE category='".$category."' ";
}

if($_POST['fields']) { 
	$SQLwhere2 =" WHERE $_POST[fields] like '%$keyword%' ";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_KNOWLEDGE,"id","$SQLwhere");
$page=$_GET['page'];
if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

// ระบบค้นหาความรู้ของ maxsite 1.10 พัฒนาโดย www.narongrit.net
$res['knowledge'] = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE." $SQLwhere2 ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['knowledge'] = $db->fetch($res['knowledge'])){
	if ($count==0) { echo "<TR>"; }
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT category_name FROM ".TB_KNOWLEDGE_CAT." WHERE id=".$arr['knowledge']['category']." "); 
	$arr['category'] = $db->fetch($res['category']);
?>
  <TD width="320" valign=top><TABLE width="320">
        <TR>
          <TD><FONT COLOR="#990000"><B>
            <?= ThaiTimeConvert($arr['knowledge']['post_date'],"","");?>
            :
            <?=$arr['category']['category_name'];?>
          </B></FONT></TD>
        </TR>
        <TR>
          <TD height="3" ></TD>
        </TR>
        <TR>
          <TD width="320"><A HREF="?name=knowledge&file=readknowledge&id=<?=$arr['knowledge']['id'];?>"> <IMG SRC="knowledgeIcon/<?=$arr['knowledge']['post_date'];?>.jpg" WIDTH="80" HEIGHT="60" BORDER="0" ALIGN="left" class="topicicon"><B>
            <?=$arr['knowledge']['topic'];?>
            </b></A>
              <?NewsIcon(TIMESTAMP, $arr['knowledge']['post_date'], "images/icon_new.gif");?>
              <BR>
              <?=$arr['knowledge']['headline'];?>
          </TD>
        </TR>
        <TR>
          <TD height="3" ></TD>
        </TR>
    </TABLE></TD>
      <?
$count++;
if (($count%_KNOW_COL) == 0) { echo "</TR><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
}
$db->closedb ();

//จบการแสดงข่าวสาร
?>
          </TABLE>
		  <BR>
          <table border="0" cellpadding="0" cellspacing="1" width="750" align=center>
            <tr>
              <td><?
				SplitPage($page,$totalpage,"?name=knowledge&category=".$category."");
				echo $ShowSumPages ;
				echo "<BR>";
				echo $ShowPages ;
				?>
              </td>
            </tr>
          </table> <? } ?>
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
