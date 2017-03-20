<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options['selObj.selectedIndex'].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
	<TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top>
		  <!-- Webboard -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_webboard.gif" BORDER="0"><BR>

<div align="right" width="740"><B><IMG SRC="images/icon/icon_folder.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=webboard"><?=_WEBBOARD_LISTALL;?></A> &nbsp;&nbsp;&nbsp; <IMG SRC="images/icon/icon_add.gif" WIDTH="16" HEIGHT="16" BORDER="0" ALIGN="absmiddle"> <A HREF="?name=webboard&file=post"><?=_WEBBOARD_ADD_NEW;?></A></B>&nbsp;&nbsp;</div>
<BR>
		  <div align="right">
            <form name="categoty" ><center>
              <table width="740" align="center" align="left" border="0">
                <tr>
                  <td bgcolor="#F8F8F8"><div align="left"> <font color="#009933"><?=_WEBBOARD_SEARCH_CAT;?> :</font>
                          <select name="category" onchange="MM_jumpMenu('parent',this,0)">
                            <option value="?name=webboard"><?=_WEBBOARD_JUM_ALLCAT;?></option>
                            <?
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['categorys'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." ORDER BY sort "); 
while($arr['categorys'] = $db->fetch($res['categorys'])){
	echo "<option value=\"?name=webboard&categorys=".$arr['categorys']['id']."\" ";
	if($_GET['categorys'] == $arr['categorys']['id']){
		echo " Selected";
	}
	echo ">".$arr['categorys']['category_name']."</option>\n";
}

// ระบบค้นหาบทความของ maxsite 1.10 พัฒนาโดย www.narongrit.net
?>
                          </select>
&nbsp;&nbsp; </div></td>

            </form>

                <td height="50" bgcolor="#F8F8F8"><form name="formsearch" method="post" action="?name=webboard&file=webboard_search">
                    <div align="left">
&nbsp;&nbsp;<strong><font color="#009933"><?=_FROM_SEARCH_WORD;?></font></strong>&nbsp;
            <input type="text" name="keyword" value="<? echo"$keyword"; ?>">
&nbsp;&nbsp;&nbsp;<strong> <?=_FROM_SEARCH_FIELD;?></strong>
            <select name="fields">
              <option value="id" <? if($_POST['fields']=='id'){echo "selected";}?>><?=_FROM_SEARCH_FIELD_ID;?> </option>
              <option value="topic" <? if($_POST['fields']=='topic'){echo "selected";}?>><?=_FROM_SEARCH_FIELD_TOPIC;?> </option>
              <option value="detail" <? if($_POST['fields']=='detail'){echo "selected";}?>><?=_FROM_SEARCH_FIELD_DETAIL;?></option>
            </select>
&nbsp;&nbsp;&nbsp;
            <input type="hidden" name="category" value="<?=$category;?>">
            <input type="submit" name="Submit" value="<?=_FROM_SEARCH_BUTTON;?>">
&nbsp;<b><img src="images/admin/opendir.gif" align="absmiddle"> <a href="?name=webboard"><?=_FROM_SEARCH_ALL;?></a>
                </form></td>
              </tr>
            </table>
            <? 
$fields=$_POST['fields'];
$keyword=$_POST['keyword'];
if (empty($keyword)) {
	echo "<br><br>"._WEBBOARD_SEARCH_JAVA1_WORD_NULL."<br><br>";
}
else {
//echo $_POST['categorys'];
function highlight($word, $subject) {
  $pattern = '/(>[^<]*)('.$word.')/i';
  $replacement = '\1<span class="search">\2</span>';
  return preg_replace($pattern, $replacement, $subject);
}
 $db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql="select * From ".TB_WEBBOARD." where $fields like '%$keyword%' and category='".$_POST['category']."' ";	//เลือกข้อมูลใน DB จากตารางหมวด
$result = mysql_query($sql);
$num_rows=mysql_num_rows($result);				//จำนวนเรคอร์ด

if(empty($num_rows)) /* ตรวจสอบว่ามีอยู่หรือยัง */
{
		if ($fields=="id") { $fields=_FROM_SEARCH_FIELD_ID; }
		else if ($fields=="topic") { $fields=_FROM_SEARCH_FIELD_TOPIC; }
		else { $fields=_FROM_SEARCH_FIELD_DETAIL; }
echo"<center><br><br>"._FROM_SEARCH_ACC_NULL."<b>$keyword</b> "._FROM_SEARCH_FIELD." <b>$fields </b> </center><br><br><br><br><br>";
} else {
		if ($fields=="id") { $fields=_FROM_SEARCH_FIELD_ID; }
		else if ($fields=="topic") { $fields=_FROM_SEARCH_FIELD_TOPIC; }
		else { $fields=_FROM_SEARCH_FIELD_DETAIL; }
		echo "<center><h5><font color=#003399> "._FROM_SEARCH_ACC." <b></font><font color=#990000>$keyword</b> </font><font color=#003399>"._FROM_SEARCH_FIELD." <b></font><font color=#990000>$fields</b><font color=#003399> "._FROM_SEARCH_ACC_YES." <b></font><font color=#990000>$num_rows</b></font><font color=#003399> "._FROM_SEARCH_ACC_DATA."</center></font></h5><br> ";  
}
?>
          </div>
<table width="740"  align="center" border="0" cellspacing="2" cellpadding="0">
<tr height="20">
	<td bgcolor="#E5E5E5"><CENTER><B><?=_WEBBOARD_TABLE_TOPIC;?></B></CENTER></td>
	<td bgcolor="#E5E5E5" width="120"><CENTER><B><?=_FORM_MOD_POSTED;?></B></CENTER></td>
	<td bgcolor="#E5E5E5" width="120"><CENTER><B><?=_WEBBOARD_TABLE_DATE;?></B></CENTER></td>
</tr>
<tr><td colspan="3" height=1 class="dotline"></td></tr>
            <?

//แสดงสาระความรู้ 
if($_GET['categorys']){
	$SQLwhere = " category='".$_GET['categorys']."' ";
	$SQLwhere2 = " WHERE $fields like '%$keyword%' and category='".$_GET['categorys']."' ";
}

if($_POST['fields']) { 
	$SQLwhere2 =" WHERE $_POST['fields'] like '%$keyword%' and category='".$_POST['category']."' ";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_WEBBOARD,"id","$SQLwhere2");
$page=$_GET['page'];
if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

// ระบบค้นหาบทความของ maxsite 1.10 พัฒนาโดย www.narongrit.net
$Color = 0; 
$BoardResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD." $SQLwhere2 ORDER BY id DESC  LIMIT $goto, $limit ");
while($WebBoard = $db->fetch($BoardResult)){
	if($Color == 0){
		$Color = 1 ;
		$ColorFill = "#F0F0F0";
	}else{
		$Color = 0 ;
		$ColorFill = "#FDEAFB";
	}
$topics = highlight("$keyword", '<span>'.$WebBoard[topic].'</span>');
$details = highlight("$keyword", '<span>'.$WebBoard[detail].'</span>');
$postnames = highlight("$keyword", '<span>'.$WebBoard[post_name].'</span>');

	//Sum comment
	$SumComm = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id='".$WebBoard['id']."' "); 
	echo "<tr height=\"20\"><td bgcolor=\"".$ColorFill."\"><IMG SRC=\"images/icon/dok.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> <B>".sprintf("%0"._NUM_ID."d",$WebBoard['id'])." : </B> <A HREF=\"?name=webboard&file=read&id=".$WebBoard['id']."\" target=\"_blank\">".$WebBoard['topic']."</A> ";
	//กรณีแนบรูป
	if($WebBoard['picture']){
		echo "<IMG SRC=\"images/attach.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> ";
	}else{ };
	//กรณีกระทู้ใหม่ 
	NewsIcon(TIMESTAMP, $WebBoard['post_date'], "images/icon_new.gif");
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($WebBoard['pageview'])."/".number_format($SumComm).")</FONT></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"120\"><CENTER><B><FONT COLOR=\"#6600FF\">";
	//กรณีสมาชิก
	if($WebBoard['is_member']){
		echo "<IMG SRC=\"images/human.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"> <B><FONT COLOR=\"#FF0066\">";
	}else{ };
			$postTimePast = checkPostTimePast($WebBoard['post_date']);
	echo "".$WebBoard['post_name']."</FONT><br><FONT COLOR=\"#CC0066\">".$postTimePast."</FONT></B></CENTER></td>\n";

	//echo "".$WebBoard['post_name']."</FONT></B></CENTER></td>\n";
	echo "<td bgcolor=\"".$ColorFill."\" width=\"120\"><CENTER><FONT COLOR=\"#339900\">".ThaiTimeConvert($WebBoard['post_date'],"","2")."</FONT></CENTER></td>\n";
	echo "<tr><td colspan=\"3\" height=1 class=\"dotline\"></td></tr>\n";
}
@mysql_free_result($BoardResult);
$db->closedb();
echo "</table>";

?>
				<BR>
				<table border="0" cellpadding="0" cellspacing="1" width="740" align=center>
					<tr>
						<td>
				<?
				SplitPage($page,$totalpage,"?name=webboard&category=".$_GET['categorys']."");
				echo $ShowSumPages ;
				echo "<BR>";
				echo $ShowPages ;
}
				?>
						</td>
					</tr>
				</table>

			<!-- webboard -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>