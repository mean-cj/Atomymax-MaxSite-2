    <TABLE cellSpacing=0 cellPadding=0 width=750 border=0 align=center>
      <TBODY>
        <TR>
          <TD &vAlign=top><BR>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="2" colspan="3"><img src="images/menu/textmenu_search.gif" border="0" /></td>
        </tr>
        <tr>
          <td height="10"><hr width="100%" color="#FF6600" /></td>
        </tr>
        <tr>
          <td></td>
        </tr>
      </table>
      <TBODY>
    <BR>
<style type="text/css">
.search {
  background-color:yellow;
  color:green;
}
</style>

    <table width="88%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="right">&nbsp;</td>
          </tr>
    </table>
	      <table width="90%" height="30"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E5E5E5">
	        <tr>
	          <td width="50%">
	            <form name="formboard" method="post" action="?name=search&file=getsearch" onsubmit="return checkboard();">
	              <div align="left">&nbsp; &nbsp;<strong><?=_WEBBOARD_SEARCH_TITLE_SEARCH;?> </strong>&nbsp;              
	                <input type="text" name="keyword" value="<? echo"$keyword"; ?>" style="width:150px; padding:1px">
	                <input type="submit" name="Submit" value="search">
                  </div>
			  </form>			</td>
              <td width="37%" align="left"><script language='JavaScript'>
					function checkboard() {
						if(document.formboard.keyword.value=='') {
						alert('<? echo _WEBBOARD_SEARCH_JAVA_WORD_NULL;?>') ;
						document.formboard.keyword.focus() ;
						return false ;
						}
						else
						return true ;
						}
                      </script>                </td>
            </tr>
          </table>
	      <br>
          <table width="90%" height="10"  border="0" align="center" cellpadding="0" cellspacing="0">
            <tr><td align="left">
              <? 
$keyword=$_GET[keyword];
$SQLwhere2 = "where (topic like '%$keyword%' ) or (detail like '%$keyword%' ) or (posted like '%$keyword%' )";
//แสดงผลกระทู้ 
$limit = _PERPAGE_BOARD ;

if (empty($keyword)) {
	echo "<br><br>"._WEBBOARD_SEARCH_JAVA1_WORD_NULL."<br><br>";
}
else {
function highlight($word, $subject) {
  $pattern = '/(>[^<]*)('.$word.')/i';
  $replacement = '\1<span class="search">\2</span>';
  return preg_replace($pattern, $replacement, $subject);
}
?>
<font color=#0033CC size=3>1. <?=_SEARCH_FORM_TITLE_1;?></font>
</td></tr>
<tr><td align="center">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql="select * From ".TB_NEWS." where (topic like '%$keyword%') or (detail like '%$keyword%') or (posted like '%$keyword%')";	//เลือกข้อมูลใน DB จากตารางหมวด
$result = mysql_query($sql);
$num_rows=mysql_num_rows($result);	 //จำนวนเรคอร์ด

//เริ่มการตรวจสอบจากการค้นหาข้อมูล
if(empty($num_rows))  {
$message=""._WEBBOARD_SEARCH_WORD_NULL." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_NULL1."";
echo "$message";
} else {
$message = ""._WEBBOARD_SEARCH_WORD_FROMWORD." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_FROMWORD_TOTAL." <font color='#FF0033'><b>$num_rows</b></font> "._ADMIN_TABLE_TITLE_TOPIC." ";
echo "$message";
?>
</td>
</tr>
<tr><td align="center">
	      <table width="90%"  align="center" border="0" cellspacing="0" cellpadding="0">
	        <tr><td height="24" colspan="4">&nbsp;</td>
    </tr>
	        <tr height="24">
	    <td align="center" bgcolor="#E5E5E5" width="70%"><B><?=_WEBBOARD_TABLE_TOPIC;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_WEBBOARD_READ_POSTEDX;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_WEBBOARD_TABLE_DATE;?></B></td>
    </tr>
	        <tr><td colspan="4" height=1 class="dotline"></td></tr>
<?
$SUMPAGE = $db->num_rows(TB_NEWS,"id",$SQLwhere2);

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$Color = 0; 
$rank=1;
$BoardResult = $db->select_query("SELECT * FROM ".TB_NEWS." $SQLwhere2 ORDER BY id DESC");
//$BoardResult = $db->select_query("SELECT *, MATCH(topic, detail,post_name) AGAINST('". $keyword ."') as score FROM pages WHERE MATCH (topic, detail,post_name) AGAINST('". $term ."') ORDER BY score DESC");
while($search = $db->fetch($BoardResult)){
if($Color == 0){
		$Color = 1 ;
		$ColorFill = "#FFFFFF";
}else{
		$Color = 0 ;
		$ColorFill = "#FFFFFF";
}
$topics = highlight("$keyword", '<span>'.$search[topic].'</span>');
$details = highlight("$keyword", '<span>'.$search[detail].'</span>');
$postnames = highlight("$keyword", '<span>'.$search[posted].'</span>');


	$SumComm = $db->num_rows(TB_NEWS_COMMENT,"id","news_id='".$search[id]."' "); 
	echo "<tr height=\"20\">";
	echo "<td bgcolor=\"".$ColorFill."\" width='70%' class='content'><IMG SRC=\"images/icon/dok.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> <B>".sprintf("%0"._NUM_ID."d",$search[id])." : </B> <A HREF=\"?name=news&file=readnews&id=".$search[id]."\" target=\"_blank\">".$topics."</A> ";
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($search[pageview])."/".number_format($SumComm).")</FONT></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><B><FONT COLOR=\"#6600FF\">";
	echo "".$postnames."</FONT></B></CENTER></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><FONT COLOR=\"#339900\">".ThaiTimeConvert($search[post_date],"","2")."</FONT></CENTER></td>\n";
	echo "<tr><td colspan=\"4\" height=1 class=\"dotline\"></td></tr>\n";

	$rank++;
}
?>
            </td></tr>
    </table>
<?
}
?>
</td></tr>
<tr><td align="left">
<font color=#0033CC size=3>2. <?=_SEARCH_FORM_TITLE_2;?></font>
</td></tr>
<tr><td align="center">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql="select * From ".TB_BLOG." where (topic like '%$keyword%') or (detail like '%$keyword%') or (posted like '%$keyword%')";	//เลือกข้อมูลใน DB จากตารางหมวด
$result = mysql_query($sql);
$num_rows=mysql_num_rows($result);	 //จำนวนเรคอร์ด

//เริ่มการตรวจสอบจากการค้นหาข้อมูล
if(empty($num_rows))  {
$message=""._WEBBOARD_SEARCH_WORD_NULL." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_NULL1."";
echo "$message";
} else {
$message = ""._WEBBOARD_SEARCH_WORD_FROMWORD." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_FROMWORD_TOTAL." <font color='#FF0033'><b>$num_rows</b></font> "._WEBBOARD_TABLE_TITLE_TOPIC." ";
echo "$message";
?>
</td>
</tr>
<tr><td align="center">
	      <table width="90%"  align="center" border="0" cellspacing="0" cellpadding="0">
	        <tr><td height="24" colspan="4">&nbsp;</td>
    </tr>
	        <tr height="24">
	    <td align="center" bgcolor="#E5E5E5" width="70%"><B><?=_WEBBOARD_TABLE_TOPIC;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_WEBBOARD_READ_POSTEDX;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_WEBBOARD_TABLE_DATE;?></B></td>
    </tr>
	        <tr><td colspan="4" height=1 class="dotline"></td></tr>
<?
$SUMPAGE = $db->num_rows(TB_BLOG,"id",$SQLwhere2);

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$Color = 0; 
$rank=1;
$BoardResult = $db->select_query("SELECT * FROM ".TB_BLOG." $SQLwhere2 ORDER BY id DESC");
//$BoardResult = $db->select_query("SELECT *, MATCH(topic, detail,post_name) AGAINST('". $keyword ."') as score FROM pages WHERE MATCH (topic, detail,post_name) AGAINST('". $term ."') ORDER BY score DESC");
while($search = $db->fetch($BoardResult)){
if($Color == 0){
		$Color = 1 ;
		$ColorFill = "#FFFFFF";
}else{
		$Color = 0 ;
		$ColorFill = "#FFFFFF";
}
$topics = highlight("$keyword", '<span>'.$search[topic].'</span>');
$details = highlight("$keyword", '<span>'.$search[detail].'</span>');
$postnames = highlight("$keyword", '<span>'.$search[posted].'</span>');


	$SumComm = $db->num_rows(TB_BLOG_COMMENT,"id","news_id='".$search[id]."' "); 
	echo "<tr height=\"20\">";
	echo "<td bgcolor=\"".$ColorFill."\" width='70%' class='content'><IMG SRC=\"images/icon/dok.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> <B>".sprintf("%0"._NUM_ID."d",$search[id])." : </B> <A HREF=\"?name=blog&file=readblog&id=".$search[id]."\" target=\"_blank\">".$topics."</A> ";
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($search[pageview])."/".number_format($SumComm).")</FONT></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><B><FONT COLOR=\"#6600FF\">";
	echo "".$postnames."</FONT></B></CENTER></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><FONT COLOR=\"#339900\">".ThaiTimeConvert($search[post_date],"","2")."</FONT></CENTER></td>\n";
	echo "<tr><td colspan=\"4\" height=1 class=\"dotline\"></td></tr>\n";

	$rank++;
}
?>
            </td></tr>
    </table>
<?
}
?>
</td></tr>
<tr><td align="left">
<font color=#0033CC size=3>3. <?=_SEARCH_FORM_TITLE_3;?></font>
</td></tr>
<tr><td align="center">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql="select * From ".TB_DOWNLOAD." where (topic like '%$keyword%') or (detail like '%$keyword%') or (posted like '%$keyword%')";	//เลือกข้อมูลใน DB จากตารางหมวด
$result = mysql_query($sql);
$num_rows=mysql_num_rows($result);	 //จำนวนเรคอร์ด

//เริ่มการตรวจสอบจากการค้นหาข้อมูล
if(empty($num_rows))  {
$message=""._WEBBOARD_SEARCH_WORD_NULL." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_NULL1."";
echo "$message";
} else {
$message = ""._WEBBOARD_SEARCH_WORD_FROMWORD." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_FROMWORD_TOTAL." <font color='#FF0033'><b>$num_rows</b></font> "._ADMIN_TABLE_TITLE_TOPIC." ";
echo "$message";
?>
</td>
</tr>
<tr><td align="center">

	      <table width="90%"  align="center" border="0" cellspacing="0" cellpadding="0">
	        <tr><td height="24" colspan="4">&nbsp;</td>
    </tr>
	        <tr height="24">
	    <td align="center" bgcolor="#E5E5E5" width="70%"><B><?=_WEBBOARD_TABLE_TOPIC;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_WEBBOARD_READ_POSTEDX;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_WEBBOARD_TABLE_DATE;?></B></td>
    </tr>
	        <tr><td colspan="4" height=1 class="dotline"></td></tr>
<?
$SUMPAGE = $db->num_rows(TB_DOWNLOAD,"id",$SQLwhere2);

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$Color = 0; 
$rank=1;
$BoardResult = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." $SQLwhere2 ORDER BY id DESC");
//$BoardResult = $db->select_query("SELECT *, MATCH(topic, detail,post_name) AGAINST('". $keyword ."') as score FROM pages WHERE MATCH (topic, detail,post_name) AGAINST('". $term ."') ORDER BY score DESC");
while($search = $db->fetch($BoardResult)){
if($Color == 0){
		$Color = 1 ;
		$ColorFill = "#FFFFFF";
}else{
		$Color = 0 ;
		$ColorFill = "#FFFFFF";
}
$topics = highlight("$keyword", '<span>'.$search[topic].'</span>');
$details = highlight("$keyword", '<span>'.$search[detail].'</span>');
$postnames = highlight("$keyword", '<span>'.$search[posted].'</span>');


	$SumComm = $db->num_rows(TB_DOWNLOAD_COMMENT,"id","news_id='".$search[id]."' "); 
	echo "<tr height=\"20\">";
	echo "<td bgcolor=\"".$ColorFill."\" width='70%' class='content'><IMG SRC=\"images/icon/dok.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> <B>".sprintf("%0"._NUM_ID."d",$search[id])." : </B> <A HREF=\"?name=blog&file=readblog&id=".$search[id]."\" target=\"_blank\">".$topics."</A> ";
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($search[pageview])."/".number_format($SumComm).")</FONT></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><B><FONT COLOR=\"#6600FF\">";
	echo "".$postnames."</FONT></B></CENTER></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><FONT COLOR=\"#339900\">".ThaiTimeConvert($search[post_date],"","2")."</FONT></CENTER></td>\n";
	echo "<tr><td colspan=\"4\" height=1 class=\"dotline\"></td></tr>\n";

	$rank++;
}
?>
            </td></tr>
    </table>
<?
}
?>
</td></tr>
<tr><td align="left">
<font color=#0033CC size=3>4. <?=_SEARCH_FORM_TITLE_4;?></font>
</td></tr>
<tr><td align="center">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql="select * From ".TB_KNOWLEDGE." where (topic like '%$keyword%') or (detail like '%$keyword%') or (posted like '%$keyword%')";	//เลือกข้อมูลใน DB จากตารางหมวด
$result = mysql_query($sql);
$num_rows=mysql_num_rows($result);	 //จำนวนเรคอร์ด

//เริ่มการตรวจสอบจากการค้นหาข้อมูล
if(empty($num_rows))  {
$message=""._WEBBOARD_SEARCH_WORD_NULL." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_NULL1."";
echo "$message";
} else {
$message = ""._WEBBOARD_SEARCH_WORD_FROMWORD." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_FROMWORD_TOTAL." <font color='#FF0033'><b>$num_rows</b></font> "._ADMIN_TABLE_TITLE_TOPIC." ";
echo "$message";
?>
</td>
</tr>
<tr><td align="center">

	      <table width="90%"  align="center" border="0" cellspacing="0" cellpadding="0">
	        <tr><td height="24" colspan="4">&nbsp;</td>
    </tr>
	        <tr height="24">
	    <td align="center" bgcolor="#E5E5E5" width="70%"><B><?=_WEBBOARD_TABLE_TOPIC;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_WEBBOARD_READ_POSTEDX;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_WEBBOARD_TABLE_DATE;?></B></td>
    </tr>
	        <tr><td colspan="4" height=1 class="dotline"></td></tr>
<?
$SUMPAGE = $db->num_rows(TB_KNOWLEDGE,"id",$SQLwhere2);

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$Color = 0; 
$rank=1;
$BoardResult = $db->select_query("SELECT * FROM ".TB_KNOWLEDGE." $SQLwhere2 ORDER BY id DESC");
//$BoardResult = $db->select_query("SELECT *, MATCH(topic, detail,post_name) AGAINST('". $keyword ."') as score FROM pages WHERE MATCH (topic, detail,post_name) AGAINST('". $term ."') ORDER BY score DESC");
while($search = $db->fetch($BoardResult)){
if($Color == 0){
		$Color = 1 ;
		$ColorFill = "#FFFFFF";
}else{
		$Color = 0 ;
		$ColorFill = "#FFFFFF";
}
$topics = highlight("$keyword", '<span>'.$search[topic].'</span>');
$details = highlight("$keyword", '<span>'.$search[detail].'</span>');
$postnames = highlight("$keyword", '<span>'.$search[posted].'</span>');


	$SumComm = $db->num_rows(TB_KNOWLEDGE_COMMENT,"id","news_id='".$search[id]."' "); 
	echo "<tr height=\"20\">";
	echo "<td bgcolor=\"".$ColorFill."\" width='70%' class='content'><IMG SRC=\"images/icon/dok.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> <B>".sprintf("%0"._NUM_ID."d",$search[id])." : </B> <A HREF=\"?name=blog&file=readblog&id=".$search[id]."\" target=\"_blank\">".$topics."</A> ";
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($search[pageview])."/".number_format($SumComm).")</FONT></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><B><FONT COLOR=\"#6600FF\">";
	echo "".$postnames."</FONT></B></CENTER></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><FONT COLOR=\"#339900\">".ThaiTimeConvert($search[post_date],"","2")."</FONT></CENTER></td>\n";
	echo "<tr><td colspan=\"4\" height=1 class=\"dotline\"></td></tr>\n";

	$rank++;
}
?>
            </td></tr>
    </table>
<?
}
?>
</td></tr>
<tr><td align="left">
<font color=#0033CC size=3>5. <?=_SEARCH_FORM_TITLE_5;?></font>
</td></tr>
<tr><td align="center">
<?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql="select * From ".TB_RESEARCH." where (topic like '%$keyword%') or (detail like '%$keyword%') or (posted like '%$keyword%')";	//เลือกข้อมูลใน DB จากตารางหมวด
$result = mysql_query($sql);
$num_rows=mysql_num_rows($result);	 //จำนวนเรคอร์ด

//เริ่มการตรวจสอบจากการค้นหาข้อมูล
if(empty($num_rows))  {
$message=""._WEBBOARD_SEARCH_WORD_NULL." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_NULL1."";
echo "$message";
} else {
$message = ""._WEBBOARD_SEARCH_WORD_FROMWORD." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_FROMWORD_TOTAL." <font color='#FF0033'><b>$num_rows</b></font> "._ADMIN_TABLE_TITLE_TOPIC." ";
echo "$message";
?>
</td>
</tr>
<tr><td align="center">

	      <table width="90%"  align="center" border="0" cellspacing="0" cellpadding="0">
	        <tr><td height="24" colspan="4">&nbsp;</td>
    </tr>
	        <tr height="24">
	    <td align="center" bgcolor="#E5E5E5" width="70%"><B><?=_WEBBOARD_TABLE_TOPIC;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_WEBBOARD_READ_POSTEDX;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_WEBBOARD_TABLE_DATE;?></B></td>
    </tr>
	        <tr><td colspan="4" height=1 class="dotline"></td></tr>
<?
$SUMPAGE = $db->num_rows(TB_RESEARCH,"id",$SQLwhere2);

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$Color = 0; 
$rank=1;
$BoardResult = $db->select_query("SELECT * FROM ".TB_RESEARCH." $SQLwhere2 ORDER BY id DESC");
//$BoardResult = $db->select_query("SELECT *, MATCH(topic, detail,post_name) AGAINST('". $keyword ."') as score FROM pages WHERE MATCH (topic, detail,post_name) AGAINST('". $term ."') ORDER BY score DESC");
while($search = $db->fetch($BoardResult)){
if($Color == 0){
		$Color = 1 ;
		$ColorFill = "#FFFFFF";
}else{
		$Color = 0 ;
		$ColorFill = "#FFFFFF";
}
$topics = highlight("$keyword", '<span>'.$search[topic].'</span>');
$details = highlight("$keyword", '<span>'.$search[detail].'</span>');
$postnames = highlight("$keyword", '<span>'.$search[posted].'</span>');


	$SumComm = $db->num_rows(TB_RESEARCH_COMMENT,"id","news_id='".$search[id]."' "); 
	echo "<tr height=\"20\">";
	echo "<td bgcolor=\"".$ColorFill."\" width='70%' class='content'><IMG SRC=\"images/icon/dok.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> <B>".sprintf("%0"._NUM_ID."d",$search[id])." : </B> <A HREF=\"?name=blog&file=readblog&id=".$search[id]."\" target=\"_blank\">".$topics."</A> ";
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($search[pageview])."/".number_format($SumComm).")</FONT></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><B><FONT COLOR=\"#6600FF\">";
	echo "".$postnames."</FONT></B></CENTER></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><FONT COLOR=\"#339900\">".ThaiTimeConvert($search[post_date],"","2")."</FONT></CENTER></td>\n";
	echo "<tr><td colspan=\"4\" height=1 class=\"dotline\"></td></tr>\n";

	$rank++;
}
?>
            </td></tr>
    </table>
<?
}
?>
            </td></tr>
<?
}
?>
</table>
