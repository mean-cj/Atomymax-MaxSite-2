
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
		  <!-- blog  -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_blog.gif" BORDER="0">
		  <div align="right">

              <table width="740" align="center" align="left" border="0">
                <tr>
                <td height="50" bgcolor="#F8F8F8"><form name="formsearch" method="post" action="?name=blog&file=blog_search">
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
&nbsp;<b><img src="images/admin/opendir.gif" align="absmiddle"> <a href="?name=blog"><?=_FROM_SEARCH_ALL;?></a>
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  &nbsp;&nbsp;&nbsp;&nbsp;<a href="?name=admin&file=blog&op=article_add"><img src="images/admin/i-editor.png" align="absmiddle"> </a>
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
                            <option value="?name=blog"><?=_FROM_SEARCH_CAT_ALL;?></option>
                            <?

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_BLOG_CAT." ORDER BY sort  ");
while($arr['category'] = $db->fetch($res['category'])){
	echo "<option value=\"?name=blog&category=".$arr['category']['id']."\" ";
	if($category == $arr['category']['id']){
		echo " Selected";
	}
	echo ">".$arr['category']['category_name']."</option>\n";
}
$db->closedb ();
// ระบบค้นหา blog ของ maxsite 1.10 พัฒนาโดย www.narongrit.net
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
	empty($_GET['page'])?$page="":$page=$_GET['page'];
empty($_GET['category'])?$category="":$category=$_GET['category'];
//แสดงข่าวสาร/ประชาสัมพันธ์ 
if($category){
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " WHERE category='".$category."' ";
} else {
	$SQLwhere = "";
	$SQLwhere2 = "";
}

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_BLOG,"id"," ".$SQLwhere."");

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." ".$SQLwhere2." ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['blog'] = $db->fetch($res['blog'])){
	if ($count==0) { echo "<TR>"; }
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_BLOG_CAT." WHERE id='".$arr['blog']['category']."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$res['cblog'] = $db->select_query("SELECT *,count(id) as co FROM ".TB_BLOG." WHERE posted='".$arr['blog']['posted']."' group by posted");
	$arr['cblog'] = $db->fetch($res['cblog']);	
				$ress['com'] = $db->select_query("SELECT *,count(blog_id) as com FROM ".TB_BLOG_COMMENT." WHERE blog_id ='".$arr['blog']['id']."' group by blog_id"); 
	$arrs['com'] = $db->fetch($ress['com']);
?>
			<TD width="50%" valign=top align=left>	
				<TABLE width="100%">
				<TR>
					<TD><FONT COLOR="#990000"><B><?=_BLOG_MOD_CAT;?>
					 </font><b><FONT COLOR="#0066FF"><?=$arr['category']['category_name'];?>
					</B></FONT><br><FONT COLOR="#990000">Blog name : </font><FONT COLOR="#0066FF"><?=$arr['cblog']['posted'];?> </font><FONT COLOR="#CC33CC"><?BlogLevel($arr['cblog']['co']);?></font><br><b><FONT COLOR="#990000"><?=_BLOG_MOD_DATE_ACC;?> </font><FONT COLOR="#0066FF"><?= ThaiTimeConvert($arr['blog']['post_date'],"","");?></font><FONT COLOR="#CC33CC"> [<?=_BLOG_MOD_PRIVIEW;?>  <?=$arr['blog']['pageview'];?>]</font></TD>
				</TR>
				<TR><TD height="3" ></TD></TR>
				<TR>
					<TD valign="top" align="center">
					<A HREF="?name=blog&file=readblog&id=<?=$arr['blog']['id'];?>" target="_blank">
					<?if ($arr['blog']['pic']){echo "<img  src=icon/blog_".$arr['blog']['post_date']."_".$arr['blog']['posted'].".jpg class=mysborder border=0 align=center>";} else {echo "<img class=mysborder src=images/icon/".$arr['category']['icon']." border=0 align=center>";} ?></a>
					</td>
					</tr>
					<tr>
					<td colspan="2" ><img src="images/a.gif"><A HREF="?name=blog&file=readblog&id=<?=$arr['blog']['id'];?>" target="_blank">
					<B><?=$arr['blog']['topic'];?></A><?if ($login_true==$arr['blog']['posted']){echo "<A HREF=\"?name=blog&file=blog&op=article_edit&id=".$arr['blog']['id']."\">&nbsp;&nbsp;<IMG SRC=\"images/mail1[1].gif\" BORDER=\"0\" ALIGN=\"absmiddle\"></a><a href=\"index.php?name=blog&file=blog&op=article_del&id=".$arr['blog']['id']."\">&nbsp;<IMG SRC=\"images/trash_16[1].gif\" BORDER=\"0\" ALIGN=\"absmiddle\"></a>";}?></b>
					<?NewsIcon(TIMESTAMP, $arr['blog']['post_date'], "images/icon_new.gif");?>( <?=$arr['blog']['pageview'];?> / <?=$arrs['com']['com'];?> )
					<BR>&nbsp;&nbsp;&nbsp;&nbsp;<?=$arr['blog']['headline'];?><br><?$rater_ids=$arr['blog']['id'];$rater_item_name='blog';include("modules/rater/raters.php");?>
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
				<table border="0" cellpadding="0" cellspacing="1" width="740" align=center>
					<tr>
						<td>
				<?
				SplitPage($page,$totalpage,"?name=blog&category=".$category."");
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
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
function highlight($word, $subject) {
  $pattern = '/(>[^<]*)('.$word.')/i';
  $replacement = '\1<span class="search">\2</span>';
  return preg_replace($pattern, $replacement, $subject);
}
if (!empty($keyword)){
$sql="select * From ".TB_BLOG." where $fields like '%$keyword%'";	//เลือกข้อมูลใน DB จากตารางหมวด
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
		  <TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
            <?

//แสดงสาระ blog  
if($_GET['category']){
	$SQLwhere = " category='".$_GET['category']."' ";
	$SQLwhere2 = " WHERE category='".$_GET['category']."' ";
}

if($_POST['fields']) { 
	$SQLwhere2 =" WHERE ".$_POST['fields']." like '%$keyword%' ";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_BLOG,"id","$SQLwhere");
$page=$_GET['page'];
if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

// ระบบค้นหา blog ของ maxsite 1.10 พัฒนาโดย www.narongrit.net
$res['blog'] = $db->select_query("SELECT * FROM ".TB_BLOG." $SQLwhere2 ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['blog'] = $db->fetch($res['blog'])){
	if ($count==0) { echo "<TR>"; }
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT category_name FROM ".TB_BLOG_CAT." WHERE id=".$arr['blog']['category']." "); 
	$arr['category'] = $db->fetch($res['category']);
?>
  <TD width="320" valign=top><TABLE width="320">
        <TR>
          <TD><FONT COLOR="#990000"><B>
            <?= ThaiTimeConvert($arr['blog']['post_date'],"","");?>
            :
            <?=$arr['category']['category_name'];?>
          </B></FONT></TD>
        </TR>
        <TR>
          <TD height="3" ></TD>
        </TR>
        <TR>
          <TD width="320"><A HREF="?name=blog&file=readblog&id=<?=$arr['blog']['id'];?>"> <IMG SRC="NewsIcon/<?=$arr['blog']['post_date'];?>.jpg" WIDTH="80" HEIGHT="60" BORDER="0" ALIGN="left" class="topicicon"><B>
            <?=$arr['blog']['topic'];?>
            </b></A>
              <?NewsIcon(TIMESTAMP, $arr['blog']['post_date'], "images/icon_new.gif");?>
              <BR>
              <?=$arr['blog']['headline'];?>
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
          <table border="0" cellpadding="0" cellspacing="1" width="740" align=center>
            <tr>
              <td><?
				SplitPage($page,$totalpage,"?name=blog&category=".$_GET['category']."");
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
