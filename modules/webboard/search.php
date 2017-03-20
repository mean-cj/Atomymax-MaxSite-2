    <TABLE cellSpacing=0 cellPadding=0 width=750 border=0 align=center>
      <TBODY>
        <TR>
          <TD &vAlign=top><BR>
		  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="2" colspan="3"><img src="images/menu/textmenu_webboard.gif" border="0" /></td>
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
	            <form name="formboard" method="post" action="?name=webboard&file=getsearch" onsubmit="return checkboard();">
	              <div align="left">&nbsp; &nbsp;<strong><?=_WEBBOARD_SEARCH_TITLE_SEARCH;?></strong>&nbsp;              
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
            <tr><td align="center">
              <? 
$keyword=$_GET[keyword];

if (empty($keyword)) {
	echo "<br><br>"._WEBBOARD_SEARCH_JAVA1_WORD_NULL."<br><br>";
}
else {
function highlight($word, $subject) {
  $pattern = '/(>[^<]*)('.$word.')/i';
  $replacement = '\1<span class="search">\2</span>';
  return preg_replace($pattern, $replacement, $subject);
}

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql="select * From ".TB_WEBBOARD." where (topic like '%$keyword%') or (detail like '%$keyword%') or (post_name like '%$keyword%')";	//เลือกข้อมูลใน DB จากตารางหมวด
$result = mysql_query($sql);
$num_rows=mysql_num_rows($result);	 //จำนวนเรคอร์ด

//เริ่มการตรวจสอบจากการค้นหาข้อมูล
if(empty($num_rows))  {
$message=""._WEBBOARD_SEARCH_WORD_NULL." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_NULL1."";
}
else {
$message = ""._WEBBOARD_SEARCH_WORD_FROMWORD." <font style=background:#FFFF66>".$keyword."</font> "._WEBBOARD_SEARCH_WORD_FROMWORD_TOTAL." <font color='#72A545'><b>$num_rows</b></font> "._WEBBOARD_SEARCH_WORD_TOPIC." ";
}
echo "$message";
//จบการตรวจสอบการค้นหา
?>
            </td></tr>
    </table>
	      <table width="90%"  align="center" border="0" cellspacing="0" cellpadding="0">
	        <tr><td height="24" colspan="4">&nbsp;</td>
    </tr>
	        <tr height="24">
	    <td align="center" bgcolor="#E5E5E5" width="70%"><B><?=_WEBBOARD_TABLE_TOPIC;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_FORM_MOD_POSTED;?></B></td>
	    <td width="15%" align="center" bgcolor="#E5E5E5"><B><?=_WEBBOARD_TABLE_DATE;?></B></td>
    </tr>
	        <tr><td colspan="4" height=1 class="dotline"></td></tr>
	        <?
	$SQLwhere2 = "where (topic like '%$keyword%' ) or (detail like '%$keyword%' ) or (post_name like '%$keyword%' )";
//แสดงผลกระทู้ 
$limit = _PERPAGE_BOARD ;
$SUMPAGE = $db->num_rows(TB_WEBBOARD,"id",$SQLwhere2);

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$Color = 0; 
$rank=1;
$BoardResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD." $SQLwhere2 ORDER BY id DESC");
//$BoardResult = $db->select_query("SELECT *, MATCH(topic, detail,post_name) AGAINST('". $keyword ."') as score FROM pages WHERE MATCH (topic, detail,post_name) AGAINST('". $term ."') ORDER BY score DESC");
while($WebBoard = $db->fetch($BoardResult)){
	if($Color == 0){
		$Color = 1 ;
		$ColorFill = "#FFFFFF";
	}else{
		$Color = 0 ;
		$ColorFill = "#FFFFFF";
	}
$topics = highlight("$keyword", '<span>'.$WebBoard[topic].'</span>');
$details = highlight("$keyword", '<span>'.$WebBoard[detail].'</span>');
$postnames = highlight("$keyword", '<span>'.$WebBoard[post_name].'</span>');


	$SumComm = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id='".$WebBoard[id]."' "); 
	echo "<tr height=\"20\">";
	echo "<td bgcolor=\"".$ColorFill."\" width='70%' class='content'><IMG SRC=\"images/icon/dok.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> <B>".sprintf("%0"._NUM_ID."d",$WebBoard[id])." : </B> <A HREF=\"?name=webboard&file=read&id=".$WebBoard[id]."\" target=\"_blank\">".$topics."</A> ";
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($WebBoard[pageview])."/".number_format($SumComm).")</FONT></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><B><FONT COLOR=\"#6600FF\">";
	echo "".$postnames."</FONT></B></CENTER></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><FONT COLOR=\"#339900\">".ThaiTimeConvert($WebBoard[post_date],"","2")."</FONT></CENTER></td>\n";
	echo "<tr><td colspan=\"4\" height=1 class=\"dotline\"></td></tr>\n";

	$rank++;
}
// เริ่ม comment
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//แสดงผลกระทู้ 
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_WEBBOARD_COMMENT,"id","(detail like '%$keyword%') or (post_name like '%$keyword%')");
$page=$_GET[page];
if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

$sql2="select * From ".TB_WEBBOARD_COMMENT." $SQLwhere LIMIT $goto, $limit";	//เลือกข้อมูลใน DB จากตารางหมวด
$result2 = mysql_query($sql2);
?>
	        </td></tr>
    </table>
        <br /><br />
	      <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td> <font size="3"><b><?=_WEBBOARD_SEARCH_WORD_COMMENT;?> <u> <?=$SUMPAGE;?></u> comment</b></font></td>
            </tr>
            <tr>
              <td><?
				SplitPage($page,$totalpage,"?name=webboard&file=search&keyword=$_GET[keyword]");
				echo $ShowSumPages  ;
				echo "&nbsp;";
				echo $ShowPages ;
				echo "<br>" ;
				?></td>
            </tr>
          </table>
				<table width="90%" border="0"  align="center" cellpadding="0" cellspacing="0" background="images/line_tab_green.jpg">
<tr height="20">
	<td height="25" align="center"><B><font color="#FFFFFF"><?=_WEBBOARD_TOPIC_TOP;?></font></B></td>
	<td width="80" align="center"><B><font color="#FFFFFF"><?=_WEBBOARD_SEARCH_TABLE_POST;?></font></B></td>	
		<td width="80" align="center"> <B><font color="#FFFFFF"><?=_WEBBOARD_TABLE_DATE;?></font></B></td>
</tr>
<tr><td colspan="4" height="1" class="dotline" ></td></tr>
<?
$SQLwhere3 = "where (detail like '%$keyword%') or (post_name like '%$keyword%')";


$Color = 0; 
$BoardResult2 = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." $SQLwhere3 ORDER BY id DESC LIMIT $goto, $limit");
while($WebBoard2 = $db->fetch($BoardResult2)){
	if($Color == 0){
		$Color = 1 ;
		$ColorFill = "#FFFFFF";
	}else{
		$Color = 0 ;
		$ColorFill = "#FFFFFF";
	}

$result3 = mysql_query( $sql3 ); 
$showboard = $db->fetch($db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE id = '".$WebBoard2[topic_id]."' "));

//Sum comment
	echo "<tr height=\"20\">";
	echo "<td bgcolor=\"".$ColorFill."\" align='left' width='70%'><IMG SRC=\"images/icon/dok.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> <B>".sprintf("%0"._NUM_ID."d",$showboard[id])." : </B> ";
	$text4="<A HREF=\"index.php?name=webboard&file=read&id=".$showboard[id]."#comment".$WebBoard2[id]."\" target='_blank'>Re: ".$showboard[topic]." "._FROM_COMMENT_NUM." ".$dbarr[comment][id]." </A></td><td bgcolor=\"".$ColorFill."\" align='center'> "; 
$bodytag4 = str_replace("$key", "<FONT style=\"BACKGROUND-COLOR: yellow\">$key</FONT>", "$text4");
echo $bodytag4;	
	
	$text5="<B><FONT COLOR=\"#6600FF\">".$showboard[post_name]."</FONT></B></CENTER></td>\n";
$bodytag5 = str_replace("$key", "<FONT style=\"BACKGROUND-COLOR: yellow\">$key</FONT>", "$text5");
echo $bodytag5;	
	echo "<td bgcolor=\"".$ColorFill."\" width=\"15%\"><CENTER><FONT COLOR=\"#339900\">".ThaiTimeConvert($showboard[post_date],"","")."</FONT></CENTER></td>\n";
	echo "<tr><td colspan=\"4\" height=1 class=\"dotline\"></td></tr>\n";
}
@mysql_free_result($BoardResult);
$db->closedb();
}
?></table>
