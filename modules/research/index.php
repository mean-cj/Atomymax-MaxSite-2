<?
//แรียก user online ทั้งหมด
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user2'] = $db->select_query("SELECT * FROM ".TB_useronline." ");			
			$rows['user2'] = $db->rows($res['user2']);
//ดึง user online จกา table TB_user
	//		while($arr['user2'] = $db->fetch($res['user2'])){	
			$arr['user2'] = $db->fetch($res['user2']);		
			$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
			$res['user'] = $db->select_query("SELECT * FROM ".TB_MEMBER." WHERE user='".$arr['user2']['useronline']."' ");		
			$arr['user'] = $db->fetch($res['user'])	;

?>
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
		  <!-- Admin -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/research.gif" BORDER="0"><BR>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=5 border=0>
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<A HREF="?name=research"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_RESEARCH_ALL;?> </A> &nbsp;&nbsp;&nbsp;<A HREF="?name=research&file=add&op=research_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_RESEARCH_MOD_FORM_MENU_ADD_TITLE;?></A><BR>
              <table width="740" align="center" align="left" border="0">
                <tr>
                <td height="50" bgcolor="#F8F8F8"><form name="formsearch" method="post" action="?name=research&file=research_search">
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
&nbsp;<b><img src="images/admin/opendir.gif" align="absmiddle"> <a href="?name=research"><?=_FROM_SEARCH_ALL;?></a>
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  &nbsp;&nbsp;&nbsp;&nbsp;<a href="?name=admin&file=research&op=article_add"><img src="images/admin/i-editor.png" align="absmiddle"> </a>
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
                            <option value="?name=research"><?=_FROM_SEARCH_CAT_ALL;?></option>
                            <?

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." ORDER BY sort  ");
while($arr['category'] = $db->fetch($res['category'])){
	echo "<option value=\"?name=research&category=".$arr['category']['id']."\" ";
	if($category == $arr['category']['id']){
		echo " Selected";
	}
	echo ">".$arr['category']['category_name']."</option>\n";
}
$db->closedb ();
// ระบบค้นหา research ของ maxsite 1.10 พัฒนาโดย www.narongrit.net
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
//////////////////////////////////////////// แสดงรายการผลงานทางวิชาการ 
if($category){
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " WHERE category='".$category."' ";
} else {
	$SQLwhere = "";
	$SQLwhere2 = "";
}
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_RESEARCH,"id","$SQLwhere");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=research&op=research_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="55"><CENTER><B><?=_FORM_TABLE_TD_TITLE_ID;?></B></CENTER></td>
   <td align=center><B><?=_RESEARCH_MOD_FORM_TABLE_TOPIC;?></B></td>
   <td width="100"><CENTER><B><?=_RESEARCH_MOD_FORM_TABLE_POSTED;?></B></CENTER></td>
   <td width="100"><CENTER><B><?=_RESEARCH_MOD_FORM_TABLE_CAT;?></B></CENTER></td>
   <td width="50"><CENTER><B>FullText</B></CENTER></td>
  </tr>  
<?
$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." $SQLwhere2 ORDER BY id DESC LIMIT $goto, $limit ");
$rank=1;
$count=0;
while($arr['research'] = $db->fetch($res['research'])){
			if ($page>1){
	$p=$page*10;
	$ranks=$rank+$p;
	} else {
		$ranks=$rank;
	}
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
echo "<tr ".$ColorFill.">";
	$res['category'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." WHERE id='".$arr['research']['category']."' ");
	$arr['category'] = $db->fetch($res['category']);
	$newsid=$arr['research']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(id) as com FROM ".TB_RESEARCH_COMMENT." WHERE id ='".$newsid."' group by id"); 
	$arrs['com'] = $db->fetch($ress['com']);

	//Comment Icon
	if($arr['research']['enable_comment']){
		$CommentIcon = " <IMG SRC=\"images/icon/suggest.gif\" WIDTH=\"13\" HEIGHT=\"9\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{
		$CommentIcon = "";
	}
?>
     <td  valign="top" align=center >
	 <?
if($admin_user){
	//Admin Login Show Icon
?>
      <a href="?name=admin&file=research&op=research_edit&id=<? echo $arr['research']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=research&op=research_del&id=<? echo $arr['research']['id'];?>&prefix=<? echo $arr['research']['post_date'];?>','<?echo _FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
	  
	  <?
	//	  echo "$rank";
} else {
echo "$ranks";
}

	  ?>

    </td> 
     <td  valign="top"><A HREF="?name=research&file=readresearch&id=<?echo $arr['research']['id'];?>" target="_blank"><?echo $arr['research']['topic'];?></A><?=$CommentIcon;?><?=NewsIcon(TIMESTAMP, $arr['research']['post_date'], "images/icon_new.gif");?><font color="#CC3300">( <?=_FORM_MOD_READ;?> <?=$arr['research']['pageview'];?> / <?=_FORM_MOD_DONWLOAD;?> : <?=$arr['research']['rate'];?> )</font> <?=_RESEARCH_AUTH;?> <font color="#CC3300"><?=$arr['research']['auth'];?></font></td>
     <td  valign="top"><CENTER><?echo ThaiTimeConvert($arr['research']['post_date'],'','');?></CENTER></td>
     <td align="center"  valign="top">
	 <?if($arr['category']['category_name']){ //หากมีหมวดแสดงรูป ?>
	 <A HREF="#"><?echo $arr['category']['category_name'];?></A>
	 <? } ?>
	 </td>
     <td align="center"  valign="top">
	 	 <?if($arr['research']['full_text']){ $fullt=$arr['research']['posted']; $timedd=$arr['research']['post_date']; ?>
		 
		  <a href="?name=research&file=rate&id=<?=$arr['research']['id']; ?>&filess=<?=$arr['research']['full_text'];?>"><font color="#0066FF">FullText</a>
		  <? } else {
		 echo "<font color=#CC0000>< "._RESEARCH_MOD_FORM_NULLID." >";
	 }?>
	 </td>

    </tr>

<?

$rank++;

	 $count++;

 } 
?>
 </table>
 </form><BR><BR>
<?
	SplitPage($page,$totalpage,"?name=research");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;

} else { 

empty($_GET['page'])?$page="":$page=$_GET['page'];
empty($_GET['category'])?$category="":$category=$_GET['category'];
function highlight($word, $subject) {
  $pattern = '/(>[^<]*)('.$word.')/i';
  $replacement = '\1<span class="search">\2</span>';
  return preg_replace($pattern, $replacement, $subject);
}
if ($keyword){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql="select * From ".TB_RESEARCH." where $fields like '%$keyword%'";	//เลือกข้อมูลใน DB จากตารางหมวด
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

//แสดงสาระ research  
if($_GET['category']){
	$SQLwhere = " category='".$_GET['category']."' ";
	$SQLwhere2 = " WHERE category='".$_GET['category']."' ";
}

if($_POST['fields']) { 
	$SQLwhere2 =" WHERE ".$_POST['fields']." like '%$keyword%' ";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_RESEARCH,"id","$SQLwhere");
$page=$_GET['page'];
if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

// ระบบค้นหา research ของ maxsite 1.10 พัฒนาโดย www.narongrit.net
$res['research'] = $db->select_query("SELECT * FROM ".TB_RESEARCH." $SQLwhere2 ORDER BY id DESC LIMIT $goto, $limit ");
$rank=1;
$count=0;
while($arr['research'] = $db->fetch($res['research'])){
			if ($page>1){
	$p=$page*10;
	$ranks=$rank+$p;
	} else {
		$ranks=$rank;
	}
if($count%2==0) { //ส่วนของการ สลับสี 
$ColorFill = ' onmouseover="this.style.backgroundColor=\'#FFF0DF\'" onmouseout="this.style.backgroundColor=\'#ffffff\'"  ';
} else {
$ColorFill = 'class="odd"';
}
echo "<tr ".$ColorFill.">";
	$res['category'] = $db->select_query("SELECT * FROM ".TB_RESEARCH_CAT." WHERE id='".$arr['research']['category']."' ");
	$arr['category'] = $db->fetch($res['category']);
	$newsid=$arr['research']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(id) as com FROM ".TB_RESEARCH_COMMENT." WHERE research_id ='".$arr['research']['id']."' group by id"); 
	$arrs['com'] = $db->fetch($ress['com']);

	//Comment Icon
	if($arr['research']['enable_comment']){
		$CommentIcon = " <IMG SRC=\"images/icon/suggest.gif\" WIDTH=\"13\" HEIGHT=\"9\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{
		$CommentIcon = "";
	}
$ids = highlight("$keyword", '<span>'.$arr['research']['id'].'</span>');
$topics = highlight("$keyword", '<span>'.$arr['research']['topic'].'</span>');
$details = highlight("$keyword", '<span>'.$arr['research']['headline'].'</span>');
?>
     <td  valign="top" align=center >
	 <?
if($admin_user){
	//Admin Login Show Icon
?>
      <a href="?name=admin&file=research&op=research_edit&id=<? echo $arr['research']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=research&op=research_del&id=<? echo $arr['research']['id'];?>&prefix=<? echo $arr['research']['post_date'];?>','<? echo _FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
	  
	  <?
	//	  echo "$rank";
} else {
echo "$ranks";
}

	  ?>

    </td> 
     <td  valign="top"><A HREF="?name=research&file=readresearch&id=<?echo $arr['research']['id'];?>" target="_blank"><?echo $topics;?></A><?=$CommentIcon;?><?=NewsIcon(TIMESTAMP, $arr['research']['post_date'], "images/icon_new.gif");?><font color="#CC3300">( <?=_RESEARCH_READ;?> <?=$arr['research']['pageview'];?> / <?=_FORM_MOD_DONWLOAD;?> : <?=$arr['research']['rate'];?> )</font> <?=_RESEARCH_AUTH;?> <font color="#CC3300"><?=$arr['research']['auth'];?></font></td>
     <td  valign="top"><CENTER><?echo ThaiTimeConvert($arr['research']['post_date'],'','');?></CENTER></td>
     <td align="center"  valign="top">
	 <?if($arr['category']['category_name']){ //หากมีหมวดแสดงรูป ?>
	 <A HREF="#"><?echo $arr['category']['category_name'];?></A>
	 <? } ?>
	 </td>
     <td align="center"  valign="top">
	 	 <?if($arr['research']['full_text']){ $fullt=$arr['research']['posted']; $timedd=$arr['research']['post_date']; ?>
		 
		  <a href="?name=research&file=rate&id=<?=$arr['research']['id']; ?>&filess=<?=$arr['research']['full_text'];?>"><font color="#0066FF">FullText</a>
		  <? } else {
		 echo "<font color=#CC0000>< "._RESEARCH_MOD_FORM_NULLID." >";
	 }?>
	 </td>

    </tr>

<?
		  $rank++;
	 $count++;
 } 
?>
          </TABLE>
		  <BR>
          <table border="0" cellpadding="0" cellspacing="1" width="740" align=center>
            <tr>
              <td><?
				SplitPage($page,$totalpage,"?name=research&category=".$_GET['category']."");
				echo $ShowSumPages ;
				echo "<BR>";
				echo $ShowPages ;
				?>
              </td>
            </tr>
          </table> <? } ?>
						<BR><BR>
					</TD>
				</TR>
			</TABLE>
			<BR><BR>
			<!-- Admin -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>
