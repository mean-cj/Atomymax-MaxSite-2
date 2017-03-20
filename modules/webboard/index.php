<TABLE cellSpacing=0 cellPadding=0 width=750 border=0 bgcolor=#FFFFFF>
      <TBODY>
        <TR>
          <TD vAlign=top><BR>
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_webboard.gif" BORDER="0"></td>
		  </tr>
				<TR>
					<TD height="1" ><br>
            <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr><td width="60%" height="30"><?echo "<a href='index.php?name=webboard&amp;file=post_cat'><img src='images/webboard/post.png' border='0' /></a>" ;  ?></td>
              <td width="40%" align="right" bgcolor="#E6E6E6"><form name="formboard" method="post" action="?name=webboard&file=getsearch" onsubmit="return checkboard();">
              <div align="left" width="50%">&nbsp; &nbsp; <strong><?=_WEBBOARD_MENU_TITLE_SEARCH;?> </strong>&nbsp;              
                <input type="text" name="keyword" value="<?if(!empty($keyword)){ echo"$keyword"; } else {echo "";}?>" style="width:145px; padding:1px">
                <input type="submit" name="Submit" value="search">
              </div>
			</form></td>
            </tr></table>
			<br />
          <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="grids">
            <tr class="odd">
              <td height="26" bgcolor="#0099CC">&nbsp; <b>WEBBOARD</b></font></td>
            </tr>
            <tr>
              <td>
		    <?
echo "<TABLE width=100% align=center border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"grids\">";
$limit = _PERPAGE_BOARD ;
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['BoardCat'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." ORDER BY sort ");
$count=0;
while($arr['BoardCat'] = $db->fetch($res['BoardCat'])){
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = 'class="odd"';
} else {
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
}
	$Cat = $arr['BoardCat']['id'];
	echo "<TR ".$ColorFill.">";
	echo "<TD width=\"10%\"  align=\"center\"><A HREF=\"?name=webboard&amp;file=board&category=".$arr['BoardCat']['id']."\">";
	$BoardResults = $db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE category=$Cat ORDER BY id desc LIMIT 1 ");
	$WebBoards = $db->fetch($BoardResults);
	$tim=$WebBoards['post_date']+86400;
if($tim >= TIMESTAMP){
	echo "<img src='images/webboard/forum_new.gif' border=\"0\"  vspace='5' alt='".$arr['BoardCat']['category_name']."'/>";
		} else {
	echo "<img src='images/webboard/forum_old.gif' border=\"0\"  vspace='5' alt='".$arr['BoardCat']['category_name']."'/>";
	}
	echo "</a></TD>";
	echo "<TD width=50% valign='middle'><B><A HREF=\"?name=webboard&amp;file=board&category=".$arr['BoardCat']['id']."\"><font size='2' color='#4C657B'><b>".$arr['BoardCat']['category_name']."</b></font></A></B>	<font size='2' color='#666666'>".$arr['BoardCat']['category_des']."</font></TD>";
	//Sum Album
	$SumCat = $db->num_rows(TB_WEBBOARD,"id"," category='".$arr['BoardCat']['id']."' "); 
	echo "<TD width=\"10%\" align='center'><font size='2' color='#0099FF'>".number_format($SumCat)." "._WEBBOARD_INDEX_TOPIC."</FONT><br>";
	
	//Last Post
	$BoardResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD." WHERE category=$Cat ORDER BY id desc LIMIT 1 ");
while($WebBoard = $db->fetch($BoardResult)){
	$SumComm = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id='".$WebBoard['id']."' "); 
	echo " <TD width=30% align='center'><A HREF=\"?name=webboard&file=read&id=".$WebBoard['id']."\" ><FONT COLOR=\"#666666\" size='2'>".$WebBoard['topic']."</FONT></A><br>";
	echo "<FONT COLOR=\"#999999\" size='1'>".$WebBoard['post_name']."</FONT> - <font size='1' color='#999999'>".ThaiTimeConvert($WebBoard['post_date'],"","2")."</font></td></tr>";  
	}
$count++;	

}
	echo "</TABLE>";
if(!empty($category)){
	$SQLwhere = " pin_date='' AND category='".$category."' ";
	$SQLwhere2 = " WHERE pin_date='' AND category='".$category."' ";
	$SQLwherePin = " WHERE pin_date!='' AND category='".$category."' ";
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT category_name FROM ".TB_WEBBOARD_CAT." WHERE id='".$category."' "); 
	$arr['category'] = $db->fetch($res['category']);
	$CatShow = $arr['category']['category_name'];
}else{
	$CatShow = ""._WEBBOARD_LISTALL."";
	$SQLwhere = " pin_date='' ";
	$SQLwhere2 = " WHERE pin_date='' ";
	$SQLwherePin = " WHERE pin_date!='' ";
}

?></td></tr></table>
          <BR>
          <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
          <table width="95%"  align="center" border="0" cellspacing="0" cellpadding="0" class="grids">
            <tr >
              <td height="24" colspan="6"><b><img src="images/icon/icon_folder.gif" width="16" height="16" border="0" align="absmiddle" /> <a href="?name=webboard"><?=$limit;?> <?=_WEBBOARD_LISTALL_UPDATE;?></a> &nbsp;&nbsp;</b></td>
            </tr>
            <tr class="odd">
           <td width="12%" height="26" align="center" ><center><b><?=_WEBBOARD_TABLE_TITLE_RANK;?></b></center></td>
              <td  width="48%" height="26"><center><b><?=_WEBBOARD_TABLE_TITLE_TOPIC;?></b></center></td>
              <td  width="16%" height="26"><center><b><?=_FORM_MOD_POSTED;?></b></center></td>
              <td width="5%" align="center"  height="26"><center><b><?=_FORM_MOD_READX;?></b></center></td>
              <td width="5%" align="center"  height="26"><center><b><?=_WEBBOARD_TABLE_TITLE_POSTDATE;?></b></center></td>
              <td width="16%" align="center"  height="26"><center><b><?=_WEBBOARD_TABLE_TITLE_POSTDATE_LAST;?></b></center></td>
            </tr>
            <?

//แสดงกระทู้ปักหมุด
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['Pin'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD." $SQLwherePin ORDER BY pin_date DESC  ");
while($arr['Pin'] = $db->fetch($res['Pin'])){
		if($arr['Pin']['picture']!=''){
		$PicIcon = " <A HREF=webboard_upload/".$arr['Pin']['picture']." class=\"highslide\" onclick=\"return hs.expand(this)\"><IMG SRC=\"images/preview.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_PIC_TITLE."\"></a>";
	}else{
		$PicIcon = "";
	}
	if($arr['Pin']['att'] !=''){
		$AttIcon = " <a href=webboard_upload/".$arr['Pin']['att']."><IMG SRC=\"images/attach.gif\" WIDTH=\"8\" HEIGHT=\"13\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_FILE_TITLE."\"></a>";
	}else{
		$AttIcon = "";
	}

		echo "<tr height=\"22\" bgcolor=#FFFFCC><td  align=\"left\">";
	$SumComm = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id='".$arr['Pin']['id']."' "); 
	if($arr['Pin']['pageview']>45){ echo"<img src='images/icon/topichot.gif' border='0' hspace='5' ALIGN=\"absmiddle\">";}else{echo"<IMG SRC=\"images/icon/dock.gif\" BORDER=\"0\"  hspace='5' ALIGN=\"absmiddle\">";}
echo "<B>".sprintf("%0"._NUM_ID."d",$arr['Pin']['id'])." : </B></td><td> <A HREF=\"?name=webboard&file=read&id=".$arr['Pin']['id']."\" target=\"_blank\">".$arr['Pin']['topic']."</A> ".$PicIcon."&nbsp;".$AttIcon."";

	//กรณีกระทู้ใหม่ 
	$Comm = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where topic_id='".$arr['Pin']['id']."' ORDER BY id DESC ");
	$Comms = $db->fetch($Comm);
	if($Comms['id']){
	UpdateIcon(TIMESTAMP, $Comms['post_date'], "images/icon/update.gif");
	}else{
	NewsIcon(TIMESTAMP, $arr['Pin']['post_date'], "images/icon_new.gif");
	 };
	echo "<FONT FACE=\"tahoma\" COLOR=\"#808080\">(".number_format($arr['Pin']['pageview'])."/".number_format($SumComm).")</FONT></td>\n";
	//กรณีสมาชิก


	echo "<td  width=\"19%\"><CENTER>";
		if($arr['Pin']['is_member']==1){
			echo "<B><FONT COLOR=\"#FF0033\">".$arr['Pin']['post_name']."</FONT></B>&nbsp;";
		echo "<IMG SRC=\"images/human.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{	echo "<B><FONT COLOR=\"#6600FF\">".$arr['Pin']['post_name']."</FONT></B>&nbsp;"; };
	echo"<br><font size='1'>"._WEBBOARD_DETAIL_POST." ".ThaiTimeConvert($arr['Pin']['post_date'],"","2")."</font></CENTER></td>\n";
	echo "<td  width='5%' align='center'><FONT FACE=\"tahoma\" COLOR=\"#0099FF\">".number_format($arr['Pin']['pageview'])."</FONT></td>	<td  width='5%' align='center'><FONT FACE=\"tahoma\" COLOR=\"#808080\">".number_format($SumComm)."</FONT></td>\n";
		// แสดงคนตอบล่าสุด     
echo "<td  width=\"19%\">";
$res['ments'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE topic_id=".$arr['Pin']['id']." ORDER BY id DESC LIMIT 1 ");
$arr['ments'] = $db->fetch($res['ments']);
if ($arr['ments']['topic_id']){
	echo "<CENTER><B><FONT COLOR=#6600FF\"> ".$arr['ments']['post_name']."</B></FONT><br><font size='1'>"._WEBBOARD_DETAIL_POST." ".ThaiTimeConvert($arr['ments']['post_date'],"","2")."</font></CENTER>\n";
} else {
	echo "<CENTER><B></CENTER>\n";
}

}
//แสดงผลกระทู้ 

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
//$total = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id=' ".$VIEWBOARD['id']." ' ");
$total = $db->num_rows(TB_WEBBOARD,"id","$SQLwhere");

$e_page=$limit ; 
if(empty($_GET['s_page'])){   
	$_GET['s_page']=0;
	$chk_page=$_GET['s_page'];
	$s_page=$_GET['s_page'];
}else{   
	$chk_page=$_GET['s_page'];     
	$_GET['s_page']=$_GET['s_page']*$e_page;   
		$s_page=$_GET['s_page'];
}

$count=0;
$qr = $db->select_query("SELECT * FROM ".TB_WEBBOARD." $SQLwhere2 ORDER BY post_update DESC  LIMIT ".$_GET['s_page'].",$e_page ");
$numr=$db->num_rows($qr);
if($numr >=1){   
	$plus_p=($chk_page*$e_page)+$numr;   
}else{   
	$plus_p=($chk_page*$e_page);       
}   
$total_p=ceil($total/$e_page);   
$before_p=($chk_page*$e_page)+1;  

while($WebBoard = $db->fetch($qr)){
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
	if($WebBoard['picture']!=''){
		$PicIcon = " <A HREF=webboard_upload/".$WebBoard['picture']." class=\"highslide\" onclick=\"return hs.expand(this)\"><IMG SRC=\"images/preview.gif\" WIDTH=\"16\" HEIGHT=\"16\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_PIC_TITLE."\"></a>";
	}else{
		$PicIcon = "";
	}
	if($WebBoard['att'] !=''){
		$AttIcon = " <a href=webboard_upload/".$WebBoard['att']."><IMG SRC=\"images/attach.gif\" WIDTH=\"8\" HEIGHT=\"13\" BORDER=\"0\" ALIGN=\"absmiddle\" alt=\""._WEBBOARD_ATT_FILE_TITLE."\"></a>";
	}else{
		$AttIcon = "";
	}
	//Sum comment
	$SumComm = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id='".$WebBoard['id']."' "); 
	echo "<tr ".$ColorFill."><td  width=25>";
		if($WebBoard['pageview']>45){ echo"<img src='images/icon/topichot.gif' border='0' hspace='5' ALIGN=\"absmiddle\">";}else{echo"<IMG SRC=\"images/btn_paper.jpg\" BORDER=\"0\"  hspace='5' ALIGN=\"absmiddle\">";}
		echo "".sprintf("%0"._NUM_ID."d",$WebBoard['id'])." </td><td > <A HREF=\"?name=webboard&file=read&id=".$WebBoard['id']."\" > <font  color='#333333'>".$WebBoard['topic']."</font></A> ".$PicIcon."&nbsp;".$AttIcon."";	

	//กรณีกระทู้ใหม่ 
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$Comm = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where topic_id='".$WebBoard['id']."' ORDER BY id DESC  LIMIT $limit ");
	$Comms = $db->fetch($Comm);
	if($Comms['id']){
	UpdateIcon(TIMESTAMP, $Comms['post_date'], "images/icon/update.gif");
	}else{
	NewsIcon(TIMESTAMP, $WebBoard['post_date'], "images/icon_new.gif");
	 };

	echo "</td>\n";
	echo "<td width=\"19%\"><CENTER>";
			if($WebBoard['is_member']==1){
		echo "<B><FONT COLOR=\"#FF0066\">".$WebBoard['post_name']."</FONT></B>&nbsp;<IMG SRC=\"images/human.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{	echo "<B><FONT COLOR=\"#6600FF\">".$WebBoard['post_name']."</FONT></B>&nbsp;"; };
	echo "<br><font size='1'>"._WEBBOARD_DETAIL_POST." ".ThaiTimeConvert($WebBoard['post_date'],"","2")."</font></CENTER></td>\n";
	echo "<td width='5%' align='center'><FONT FACE=\"tahoma\" COLOR=\"#0099FF\">".number_format($WebBoard['pageview'])."</FONT></td>
	<td  width='5%' align='center'><FONT FACE=\"tahoma\" COLOR=\"#808080\">".number_format($SumComm)."</FONT></td>\n";
		// แสดงคนตอบล่าสุด     
$res['ment'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE topic_id=".$WebBoard['id']." ORDER BY id DESC LIMIT 1 ");
$arr['ment']= $db->fetch($res['ment']);
	if ($arr['ment']['post_name']){
				if($arr['ment']['is_member']==1){
	echo "<td width=\"19%\"><CENTER><B><FONT COLOR=#FF0033\"> ".$arr['ment']['post_name']."</B></FONT><IMG SRC=\"images/human.gif\" BORDER=\"0\" ALIGN=\"absmiddle\"><br><font size='1'>"._WEBBOARD_DETAIL_POST." ".ThaiTimeConvert($arr['ment']['post_date'],"","2")."</font></CENTER></td></tr>\n";
				} else {
	echo "<td width=\"19%\"><CENTER><B><FONT COLOR=#6600FF\"> ".$arr['ment']['post_name']."</B></FONT><br><font size='1'>"._WEBBOARD_DETAIL_POST." ".ThaiTimeConvert($arr['ment']['post_date'],"","2")."</font></CENTER></td></tr>\n";
				}
	}else {
	echo "<td width=\"19%\"><CENTER><B></CENTER></td></tr>\n";
	}

	$count++;
	}

$db->closedb();
?>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  >
<tr ><td colspan="6" class="browse_page" width=500><?page_navigator("webboard","index","",$before_p,$plus_p,$total,$total_p,$chk_page); ?></td></tr>
</table><br />
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="grids">
  <tr class="odd">
    <td width="64%" valign="top"><img src="images/btn_paper.jpg" alt="<?=_WEBBOARD_TOPIC_NOLMAL;?>" width="16" height="16" hspace="2" vspace="5" align="absmiddle" /><font size="1" color="#000000"><?=_WEBBOARD_TOPIC_NOLMAL;?></font>&nbsp;&nbsp;
    <img src="images/icon/topichot.gif" alt="<?=_WEBBOARD_TOPIC_HOT;?>" hspace="6" vspace="2" align="absmiddle" /><font size="1" color="#000000"><?=_WEBBOARD_TOPIC_HOT;?></font>&nbsp;&nbsp;<img src="images/pic_s.gif" alt="<?=_WEBBOARD_ATT_PIC_ADD;?>" hspace="6" vspace="2" align="absmiddle" /><font size="1" color="#000000"><?=_WEBBOARD_ATT_PIC_ADD_TOPIC;?></font>&nbsp;&nbsp;<img src="images/icon/dock.gif" alt="<?=_WEBBOARD_PIC_TOPIC;?>" width="16" height="16" hspace="2" vspace="2" align="absmiddle" /><font size="1" color="#000000"><?=_WEBBOARD_PIC_TOPIC;?></font></td>
	<td width="36%" align="center">
	<form id="form1" name="form1" method="post" action=""><?=_WEBBOARD_JUM_CAT;?> :  
	  <label>
	  <select name="menu1" onchange="MM_jumpMenu('parent',this,0)">
	  <option value=""><?=$CatShow;?></option>
	  <option value="">...........................</option>
	  <option value="index.php?name=webboard&file=board"><?=_WEBBOARD_JUM_ALLCAT;?></option>
	  <option value="">...........................</option>
	<?
$category = intval($category);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['BoardCat'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." ORDER BY sort ");
while($arr['BoardCat'] = $db->fetch($res['BoardCat'])){
	echo "<option value=index.php?name=webboard&amp;file=board&category=".$arr['BoardCat']['id'].">".$arr['BoardCat']['category_name']."</option>";
}
?>
          </select>
	    </label>
	  <input type="submit" name="Submit" value="GO" />
	</form>	 </td>
  </tr>
</table>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="grids">
  <tr >
    <td height="26" colspan="2" bgcolor="#0099CC">&nbsp;&nbsp;<img src="images/icon/chart.png" width="12" height="12" align="absmiddle" /><b>  <font color="#ffffff"><?=_WEBBOARD_INDEX_STATIC;?></b></font></td>
  </tr>
  <tr >
    <td width="10">&nbsp;</td>
	<td height="26">
	<?
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$BoardResult = $db->select_query("SELECT * FROM ".TB_WEBBOARD." $SQLwhere2 ORDER BY id DESC  LIMIT 1 ");
while($WebBoard = $db->fetch($BoardResult)){
echo "<font size='2' color='#333333'>".$WebBoard['id']." "._WEBBOARD_INDEX_TOPIC."</font>";

$res['member'] = $db->select_query("SELECT * FROM ".TB_MEMBER." ORDER BY id DESC  LIMIT 1 ");
while($arr['member'] = $db->fetch($res['member'])){
echo "&nbsp;&nbsp;&nbsp;";
echo ""._FORM_MOD_POSTED." ".$arr['member']['id']." "._WEBBOARD_INDEX_MEMBER." ";
echo "&nbsp;&nbsp;&nbsp;";
echo ""._WEBBOARD_INDEX_MEMBER_LAST."</font><a href='popup.php?name=member&file=member_view&id=".$arr['member']['id']."' onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )\" class=\"highslide\" ><b>&nbsp;".$arr['member']['user']." </b></a>";
}
echo "&nbsp;&nbsp;&nbsp;";
echo "<br> "._WEBBOARD_INDEX_TOPIC_LAST." : <A HREF=\"?name=webboard&file=read&id=".$WebBoard['id']."\" ><b>".$WebBoard['topic']."</b></A>  (".ThaiTimeConvert($WebBoard['post_date'],"","2")." )</font>";
}
?></td>
  </tr>
</table>

          <p>&nbsp;</p></TD></TR></TBODY>
</TABLE> 