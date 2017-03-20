 <?
 //CheckWebboard($_SESSION['login_true'], $_SESSION['pwd_login'] ,$_GET['catrgory']);
if($_SESSION['login_true']){
CheckWebboard($login_true, $pwd_login,$_GET['category']);
} else if($_SESSION['admin_user']){
CheckWebboard($admin_user, $admin_pwd,$_GET['category']);
} else {
CheckWebboard('', '',$_GET['category']);
}
$category = intval($category);
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['BoardCat'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_CAT." ORDER BY sort ");
while($arr['BoardCat'] = $db->fetch($res['BoardCat'])){
	//Sum Album
	$SumCat = $db->num_rows(TB_WEBBOARD,"id"," category='".$arr['BoardCat']['id']."' "); 
}

if($category){
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
?>
<TABLE cellSpacing=0 cellPadding=0 width=750 border=0 bgcolor=#FFFFFF>
      <TBODY>
        <TR>

          <TD vAlign=top>

  <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="index.php?name=webboard"><font size='2' color='#0066FF'><b><?=_WEBBOARD_MENU_TITLE;?></b></font></a>&nbsp;&nbsp;   <font size="1">>></font>&nbsp;&nbsp;   <font size="2"><b><?=$CatShow;?></b></font>
  <hr width="95%" color="#999999" align="center" />
<br />
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="2">
            <tr><td width="60%" height="30"><? echo "<a href='index.php?name=webboard&file=post&category=".$category."'><img src='images/webboard/post.png' border='0' /></a>" ; ?>              &nbsp;&nbsp;</td>
            <td width="40%" align="right" bgcolor="#E6E6E6"><form name="formboard" method="post" action="?name=webboard&file=getsearch" onsubmit="return checkboard();">
              <div align="left">&nbsp; &nbsp; <strong><?=_WEBBOARD_MENU_TITLE_SEARCH;?> </strong>&nbsp;              
                <input type="text" name="keyword" value="<? if (!empty($keyword)){echo"$keyword";} ?>" style="width:145px; padding:1px">
                <input type="submit" name="Submit" value="search">
              </div>
			</form></td>
            </tr></table>
			

          <BR> <table width="95%"  align="center" border="0" cellspacing="5" cellpadding="0"><tr><td>
          <table width="100%"  align="center" border="0" cellspacing="0" cellpadding="0" class="grids">
            <tr class="odd">
           <td width="12%" height="26" align="center" ><b><?=_WEBBOARD_TABLE_TITLE_RANK;?></b></font></td>
              <td height="26" width="45%"><center><b><?=_WEBBOARD_TABLE_TITLE_TOPIC;?></b></font></center></td>
              <td  width="15%" height="26"><center><b><?=_FORM_MOD_POSTED;?></b></font></center></td>
              <td width="5%" align="center"  height="26"><b><?=_FORM_MOD_READX;?></b></font></td>
              <td width="5%" align="center"  height="26"><b><?=_WEBBOARD_TABLE_TITLE_POSTDATE;?></b></font></td>
              <td width="15%" align="center"  height="26"><b><?=_WEBBOARD_TABLE_TITLE_POSTDATE_LAST;?></b></font></td>
            </tr>
            <?
//แสดงกระทู้ปักหมุด
$res['Pin'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD." $SQLwherePin ORDER BY pin_date DESC ");
while($arr['Pin'] = $db->fetch($res['Pin'])){
	$SumComm = $db->num_rows(TB_WEBBOARD_COMMENT,"id"," topic_id='".$arr['Pin']['id']."' "); 
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

	echo "<tr height=\"35\" bgcolor=#FFFFCC><td  width='10%'><IMG SRC=\"images/icon/dock.gif\" BORDER=\"0\"  hspace='5' ALIGN=\"absmiddle\">".sprintf("%0"._NUM_ID."d",$arr['Pin']['id'])." </td>	<td  width='45%'> <A HREF=\"?name=webboard&file=read&id=".$arr['Pin']['id']."\" >&nbsp;&nbsp; <font  color='#333333'>".$arr['Pin']['topic']."</font></A>".$PicIcon."&nbsp;".$AttIcon."";

	//กรณีกระทู้ใหม่ 
	$Comm = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." where topic_id='".$arr['Pin']['id']."' ORDER BY id DESC ");
	$Comms = $db->fetch($Comm);
	if($Comms['id']){
	UpdateIcon(TIMESTAMP, $Comms['post_date'], "images/icon/update.gif");
	}else{
	NewsIcon(TIMESTAMP, $arr['Pin']['post_date'], "images/icon_new.gif");
	 };

	echo "</td>\n";
	echo "<td  width=\"15%\"><CENTER><B><FONT COLOR=\"#6600FF\">";
	echo "".$arr['Pin']['post_name']."</FONT></B>&nbsp;";
			if($arr['Pin']['is_member']){
		echo "<IMG SRC=\"images/human.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{ };
	echo "<br><font size='1'>"._WEBBOARD_DETAIL_POST." ".ThaiTimeConvert($arr['Pin']['post_date'],"","2")."</font></CENTER></td>	<td  width='5%' align='center''><FONT FACE=\"tahoma\" COLOR=\"#0099FF\">".number_format($arr['Pin']['pageview'])."</FONT></td>	<td  width='5%' align='center'><FONT FACE=\"tahoma\" COLOR=\"#808080\">".number_format($SumComm)."</FONT></td>\n";
	// แสดงคนตอบล่าสุด     
$res['ment'] = $db->select_query("SELECT * FROM ".TB_WEBBOARD_COMMENT." WHERE topic_id=".$arr['Pin']['id']." ORDER BY id DESC LIMIT 1 ");
echo "<td   width=\"15%\">";
while($arr['ment'] = $db->fetch($res['ment'])){ 
	echo "<CENTER><B><FONT COLOR=#6600FF\"> ".$arr['ment']['post_name']."</B></FONT><br><font size='1'>"._WEBBOARD_DETAIL_POST." ".ThaiTimeConvert($arr['ment']['post_date'],"","2")."</font></CENTER>\n";
}

}


//แสดงผลกระทู้ 
$limit = _PERPAGE_BOARD ;
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

$count = 0; 
$qr= $db->select_query("SELECT * FROM ".TB_WEBBOARD." $SQLwhere2 ORDER BY post_update DESC  LIMIT ".$_GET['s_page'].",$e_page ");

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
	echo "<tr ".$ColorFill."><td  width='10%'>";
	//กรณีกระทู้ฮอต
	if($WebBoard['pageview']>45){ echo"<img src='images/icon/topichot.gif' border='0' hspace='5' ALIGN=\"absmiddle\">";}else{echo"<IMG SRC=\"images/btn_paper.jpg\" BORDER=\"0\"  hspace='5' ALIGN=\"absmiddle\">";} 	
	echo "<B>".sprintf("%0"._NUM_ID."d",$WebBoard['id'])." </B></td>	<td  width='45%'> <A HREF=\"?name=webboard&file=read&id=".$WebBoard['id']."\" >&nbsp;&nbsp; <font  color='#333333'>".$WebBoard['topic']."</font></A> ".$PicIcon."&nbsp;".$AttIcon."";	
	

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
	echo "<td  width=\"15%\"><CENTER>";
			if($WebBoard['is_member']==1){
		echo "<B><FONT COLOR=\"#FF0066\">".$WebBoard['post_name']."</FONT></B>&nbsp;<IMG SRC=\"images/human.gif\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{	echo "<B><FONT COLOR=\"#6600FF\">".$WebBoard['post_name']."</FONT></B>&nbsp;"; };
	echo "<br><font size='1'>"._WEBBOARD_DETAIL_POST." ".ThaiTimeConvert($WebBoard['post_date'],"","2")."</font></CENTER></td>\n";
	echo "<td  width='5%' align='center'><FONT FACE=\"tahoma\" COLOR=\"#0099FF\">".number_format($WebBoard['pageview'])."</FONT></td>
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
<tr ><td colspan="6" class="browse_page" width="500"><?page_navigator("webboard","board","".$category."&category=".$category."",$before_p,$plus_p,$total,$total_p,$chk_page); ?></td></tr>

</table>
</td></tr></table>

		  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="grids">
  <tr class="odd">
    <td width="64%" valign="top"><img src="images/btn_paper.jpg" alt="<?=_WEBBOARD_TOPIC_NOLMAL;?>" width="16" height="16" hspace="2" vspace="5" align="absmiddle" /><?=_WEBBOARD_TOPIC_NOLMAL;?>&nbsp;&nbsp;
    <img src="images/icon/topichot.gif" alt="<?=_WEBBOARD_TOPIC_HOT;?>" hspace="6" vspace="2" align="absmiddle" /><?=_WEBBOARD_TOPIC_HOT;?>&nbsp;&nbsp;<img src="images/pic_s.gif" alt="<?=_WEBBOARD_ATT_PIC_ADD;?>" hspace="6" vspace="2" align="absmiddle" /><?=_WEBBOARD_ATT_PIC_ADD_TOPIC;?>&nbsp;&nbsp;<img src="images/icon/dock.gif" alt="<?=_WEBBOARD_PIC_TOPIC;?>" width="16" height="16" hspace="2" vspace="2" align="absmiddle" /><?=_WEBBOARD_PIC_TOPIC;?></td>
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


          <br />
		  <br /></TD>
        </TR></TBODY></TABLE> 