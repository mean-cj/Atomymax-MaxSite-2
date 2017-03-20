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
			if ($admin_user<>"" || $login_true<>"" ){
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
						alert('<?echo _FORM_SEARCH_NULL;?>') ;
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
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_user.gif" BORDER="0"><BR>
				<TABLE width="740" align=center cellSpacing=0 cellPadding=5 border=0 >
				<TR>
					<TD height="1" class="dotline"></TD>
				</TR>
				<TR>
					<TD>
					<A HREF="?name=download"><IMG SRC="images/admin/open.gif"  BORDER="0" align="absmiddle"> <?=_DOWNLOAD_MOD_VIEW_TITLE;?></A> &nbsp;&nbsp;&nbsp;<A HREF="?name=download&file=add&op=download_add"><IMG SRC="images/admin/book.gif"  BORDER="0" align="absmiddle"> <?=_DOWNLOAD_MOD_VIEW_ADD;?></A><BR>
              <table width="740" align="center" align="left" border="0">
                <tr>
                <td height="50" bgcolor="#F8F8F8"><form name="formsearch" method="post" action="?name=download&file=download_search">
                    <div align="left">
&nbsp;&nbsp;<strong><font color="#009933"><?=_DOWNLOAD_MOD_SEARCH_WORD;?></font></strong>&nbsp;
            <input type="text" name="keyword" value="<? echo"$keyword"; ?>">
&nbsp;&nbsp;&nbsp;<strong> <?=_DOWNLOAD_MOD_SEARCH_SELECT;?></strong>
            <select name="fields">
              <option value="<?echo "$fields"; ?>"><?echo "$fields"; ?></option>
              <option value="id"><?=_DOWNLOAD_MOD_SEARCH_ID;?> download </option>
              <option value="topic"><?=_DOWNLOAD_MOD_SEARCH_TOPIC;?> download </option>
              <option value="headline"><?=_DOWNLOAD_MOD_SEARCH_HEADLINE;?> (headline)</option>
            </select>
&nbsp;&nbsp;&nbsp;
            <input type="hidden" name="category" value="<?=$category;?>">
            <input type="submit" name="Submit" value="<?=_DOWNLOAD_MOD_BUTTON_SEARCH;?>">
&nbsp;<b><img src="images/admin/opendir.gif" align="absmiddle"> <a href="?name=download"><?=_DOWNLOAD_MOD_LINK_ALL;?></a>
<?
if($admin_user){
	//Admin Login Show Icon
?>
				  &nbsp;&nbsp;&nbsp;&nbsp;<a href="?name=admin&file=download&op=article_add"><img src="images/admin/i-editor.png" align="absmiddle"> </a>
<?
}
?>
<br>
          </b></div>
                </form></td>
              </tr>
<tr>
			<form name="categoty" method="post" enctype="multipart/form-data"><center>
                  <td bgcolor="#F8F8F8"><div align="left"> &nbsp;&nbsp;<strong><font color="#009933"><?=_DOWNLOAD_MOD_SEARCH_CAT;?> :</font></strong>&nbsp;
                          <select name="category" onchange="if(options[selectedIndex].value){location = options[selectedIndex].value};  MM_jumpMenu('parent',this,0)">
                            <option value="?name=download"><?=_DOWNLOAD_MOD_SEARCH_CATALL;?></option>
                            <?

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD_CAT." ORDER BY sort  ");
while($arr['category'] = $db->fetch($res['category'])){
	echo "<option value=\"?name=download&category=".$arr['category']['id']."\" ";
	if($category == $arr['category']['id']){
		echo " Selected";
	}
	echo ">".$arr['category']['category_name']."</option>\n";
}
$db->closedb ();
// ระบบค้นหา download ของ maxsite 1.10 พัฒนาโดย www.narongrit.net
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
//////////////////////////////////////////// แสดงรายการ download  
empty($_GET['page'])?$page="":$page=$_GET['page'];
empty($_GET['category'])?$category="":$category=$_GET['category'];
//แสดงข่าวสาร/ประชาสัมพันธ์ 
if($category){
	$SQLwhere = " category='".$category."' and status='1' ";
	$SQLwhere2 = " WHERE category='".$category."' and status='1' ";
} else {
	$SQLwhere = "where status='1' ";
	$SQLwhere2 = "where status='1' ";
}
	$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
	$limit = 20 ;
	$SUMPAGE = $db->num_rows(TB_DOWNLOAD,"id","");

	if (empty($page)){
		$page=1;
	}
	$rt = $SUMPAGE%$limit ;
	$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
	$goto = ($page-1)*$limit ;
?>
 <form action="?name=admin&file=download&op=download_del&action=multidel" name="myform" method="post">
 <table width="100%" cellspacing="0" cellpadding="0" class="grids">
  <tr class="odd">
   <td width="55"><CENTER><B><?=_DOWNLOAD_T_ID;?></B></CENTER></td>
   <td align=center><B><?=_DOWNLOAD_T_TOPIC;?> </B></td>
   <td width="50"><CENTER><B>size</B></CENTER></td>
      <td width="60"><CENTER><B><?=_DOWNLOAD_T_DOWN;?></B></CENTER></td>
   <td width="100"><CENTER><B><?=_DOWNLOAD_T_CAT;?></B></CENTER></td>
   <td width="50"><CENTER><B><?=_DOWNLOAD_T_FILE_ATT;?></B></CENTER></td>
  </tr>  
<?
$res['download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." ".$SQLwhere2." ORDER BY id DESC LIMIT $goto, $limit ");
$rank=1;
$count=0;
while($arr['download'] = $db->fetch($res['download'])){
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
	$res['category'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD_CAT." WHERE id='".$arr['download']['category']."' ");
	$arr['category'] = $db->fetch($res['category']);
	$newsid=$arr['download']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(id) as com FROM ".TB_DOWNLOAD_COMMENT." WHERE id ='".$newsid."' group by id"); 
	$arrs['com'] = $db->fetch($ress['com']);

	//Comment Icon
	if($arr['download']['enable_comment']){
		$CommentIcon = " <IMG SRC=\"images/icon/suggest.gif\" WIDTH=\"13\" HEIGHT=\"9\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{
		$CommentIcon = "";
	}
?>
    
     <td  valign="top" width="60" align=center >
	 <?
if($admin_user){
	//Admin Login Show Icon
?>
      <a href="?name=admin&file=download&op=download_edit&id=<? echo $arr['download']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=download&op=download_del&id=<? echo $arr['download']['id'];?>&prefix=<? echo $arr['download']['post_date'];?>','<?=_FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
	  
	  <?
//		  echo "$rank";
} else {
echo "$ranks";
}
	  ?>

     <? //echo "$rank"; ?></td> 
     <td valign="top"><A HREF="?name=download&file=readdownload&id=<?echo $arr['download']['id'];?>" target="_blank"><?echo $arr['download']['topic'];?></A><?=$CommentIcon;?><?=NewsIcon(TIMESTAMP, $arr['download']['post_date'], "images/icon_new.gif");?><font color="#CC3300">( <?=_FORM_MOD_POSTDATE;?> <?echo ThaiTimeConvert($arr['download']['post_date'],'','');?> || <?=_FORM_MOD_READ;?> <?=$arr['download']['pageview'];?>  ) <?=_FORM_MOD_POSTED;?> <?=$arr['download']['posted'];?></font></td>
	      <td align="center" valign="top">
<?	
	$bytes=$arr['download']['size'];
	echo getfilesize($bytes) ;?>
		  </td>
		  	      <td align="center"  valign="top">
				  <?=$arr['download']['rate'];?>
				  </td>
     <td align="center"  valign="top">
	 <?if($arr['category']['category_name']){ //หากมีหมวดแสดงรูป ?>
	 <A HREF="#"><?echo $arr['category']['category_name'];?></A>
	 <? } ?>
	 </td>
     <td align="center"  valign="top">
		  <A HREF="popup.php?name=download&file=rate&id=<?=$arr['download']['id']; ?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )" class="highslide">
		  <? 
	 if ($arr['download']['type']=="application/pdf") {
		 ?>
		  <img src="modules/download/images/pdf.gif" border="0" >
		  <?
	 } else if ($arr['download']['type']=="application/msword") {
		 ?>
		  <img src="modules/download/images/word.gif" border="0" >
		  <?
		 } else if ($arr['download']['type']=="application/vnd.ms-excel") {
		 ?>
		  <img src="modules/download/images/excel.gif" border="0" >
		  <?
		 }else if ($arr['download']['type']=="application/vnd.ms-powerpoint") {
		 ?>
		  <img src="modules/download/images/powerpoint.gif" border="0" >
		  <?
		 }else if ($arr['download']['type']=="image/gif" || $arr['download']['type']=="image/jpg"|| $arr['download']['type']=="image/jpeg"|| $arr['download']['type']=="image/png" ) {
		 ?>
		  <img src="modules/download/images/pics.gif" border="0" >
		  <?
		 }else if ($arr['download']['type']=="application/x-zip-compressed" ) {
		 ?>
		  <img src="modules/download/images/zip.gif" border="0" >
		  <?
		 }else {
		 ?>
		  <img src="modules/download/images/stuff3.gif" border="0" >
		  <?
		 }

		 ?>

		  </a>
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
	SplitPage($page,$totalpage,"?name=download");
	echo $ShowSumPages ;
	echo "<BR>";
	echo $ShowPages ;


} else { 
empty($_GET['page'])?$page="":$page=$_GET['page'];
empty($_GET['category'])?$category="":$category=$_GET['category'];

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql="select * From ".TB_DOWNLOAD." where $fields like '%$keyword%'";	//เลือกข้อมูลใน DB จากตารางหมวด
$result = mysql_query($sql);
$num_rows=mysql_num_rows($result);				//จำนวนเรคอร์ด

if(empty($num_rows)) /* ตรวจสอบว่ามีอยู่หรือยัง */
{
		if ($fields=="id") { $fields=""._DOWNLOAD_MOD_SEARCH_ID." download "; }
		else if ($fields=="topic") { $fields=""._DOWNLOAD_MOD_SEARCH_TOPIC." download "; }
		else { $fields=""._DOWNLOAD_MOD_SEARCH_HEADLINE." (headline)"; }
echo"<center><br><br>"._DOWNLOAD_MOD_SEARCH_NULL." <b>$keyword</b> "._DOWNLOAD_MOD_SEARCH_FROMCAT." <b>$fields </b> </center><br><br><br><br><br>";
} else {
		if ($fields=="id") { $fields=""._DOWNLOAD_MOD_SEARCH_ID." download "; }
		else if ($fields=="topic") { $fields=""._DOWNLOAD_MOD_SEARCH_TOPIC." download "; }
		else { $fields=""._DOWNLOAD_MOD_SEARCH_HEADLINE." (headline)"; }
		echo "<center> "._DOWNLOAD_MOD_SEARCH_DETAIL." <b>$keyword</b> "._DOWNLOAD_MOD_SEARCH_FROMCAT." <b>$fields</b> "._DOWNLOAD_MOD_SEARCH_POP." <b>$num_rows</b>  download </center><br> ";  
}
?>
          </div>
		  <TABLE width="740" align=center cellSpacing=0 cellPadding=0 border=0>
            <?

//แสดงสาระ download  
if($_GET['category']){
	$SQLwhere = " category='".$_GET['category']."' ";
	$SQLwhere2 = " WHERE category='".$_GET['category']."' ";
}

if($_POST['fields']) { 
	$SQLwhere2 =" WHERE ".$_POST['fields']." like '%$keyword%' ";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_DOWNLOAD,"id","$SQLwhere");
$page=$_GET['page'];
if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

// ระบบค้นหา download ของ maxsite 1.10 พัฒนาโดย www.narongrit.net
$res['download'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD." $SQLwhere2 and status='1' ORDER BY id DESC LIMIT $goto, $limit ");
$rank=1;
$count=0;
while($arr['download'] = $db->fetch($res['download'])){
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
	$res['category'] = $db->select_query("SELECT * FROM ".TB_DOWNLOAD_CAT." WHERE id='".$arr['download']['category']."' ");
	$arr['category'] = $db->fetch($res['category']);
	$newsid=$arr['download']['id'];
	$ress['com'] = $db->select_query("SELECT *,count(id) as com FROM ".TB_DOWNLOAD_COMMENT." WHERE id ='".$newsid."' group by id"); 
	$arrs['com'] = $db->fetch($ress['com']);

	//Comment Icon
	if($arr['download']['enable_comment']){
		$CommentIcon = " <IMG SRC=\"images/icon/suggest.gif\" WIDTH=\"13\" HEIGHT=\"9\" BORDER=\"0\" ALIGN=\"absmiddle\">";
	}else{
		$CommentIcon = "";
	}
?>
    
     <td  valign="top" width="60" align=center >
	 <?
if($admin_user){
	//Admin Login Show Icon
?>
      <a href="?name=admin&file=download&op=download_edit&id=<? echo $arr['download']['id'];?>"><img src="images/admin/edit.gif" border="0" alt="<?=_FROM_IMG_EDIT;?>" ></a> 
      <a href="javascript:Confirm('?name=admin&file=download&op=download_del&id=<? echo $arr['download']['id'];?>&prefix=<? echo $arr['download']['post_date'];?>','<?=_FROM_COMFIRM_DEL;?>');"><img src="images/admin/trash.gif"  border="0" alt="<?=_FROM_IMG_DEL;?>" ></a>
	  
	  <?
//		  echo "$rank";
} else {
echo "$ranks";
}
	  ?>

     <? //echo "$rank"; ?></td> 
     <td valign="top"><A HREF="?name=download&file=readdownload&id=<?echo $arr['download']['id'];?>" target="_blank"><?echo $arr['download']['topic'];?></A><?=$CommentIcon;?><?=NewsIcon(TIMESTAMP, $arr['download']['post_date'], "images/icon_new.gif");?><font color="#CC3300">( <?=_FORM_MOD_POSTDATE;?> <?echo ThaiTimeConvert($arr['download']['post_date'],'','');?> || <?=_FORM_MOD_READ;?> <?=$arr['download']['pageview'];?>  ) <?=_FORM_MOD_POSTED;?> <?=$arr['download']['posted'];?></font></td>
	      <td align="center" valign="top">
<?	
	$bytes=$arr['download']['size'];
	echo getfilesize($bytes) ;?>
		  </td>
		  	      <td align="center"  valign="top">
				  <?=$arr['download']['rate'];?>
				  </td>
     <td align="center"  valign="top">
	 <?if($arr['category']['category_name']){ //หากมีหมวดแสดงรูป ?>
	 <A HREF="#"><?echo $arr['category']['category_name'];?></A>
	 <? } ?>
	 </td>
     <td align="center"  valign="top">
		  <A HREF="popup.php?name=download&file=rate&id=<?=$arr['download']['id']; ?>" onclick="return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: 500, objectHeight: 300} )" class="highslide">
		  <? 
	 if ($arr['download']['type']=="application/pdf") {
		 ?>
		  <img src="modules/download/images/pdf.gif" border="0" >
		  <?
	 } else if ($arr['download']['type']=="application/msword") {
		 ?>
		  <img src="modules/download/images/word.gif" border="0" >
		  <?
		 } else if ($arr['download']['type']=="application/vnd.ms-excel") {
		 ?>
		  <img src="modules/download/images/excel.gif" border="0" >
		  <?
		 }else if ($arr['download']['type']=="application/vnd.ms-powerpoint") {
		 ?>
		  <img src="modules/download/images/powerpoint.gif" border="0" >
		  <?
		 }else if ($arr['download']['type']=="image/gif" || $arr['download']['type']=="image/jpg"|| $arr['download']['type']=="image/jpeg"|| $arr['download']['type']=="image/png" ) {
		 ?>
		  <img src="modules/download/images/pics.gif" border="0" >
		  <?
		 }else if ($arr['download']['type']=="application/x-zip-compressed" ) {
		 ?>
		  <img src="modules/download/images/zip.gif" border="0" >
		  <?
		 }else {
		 ?>
		  <img src="modules/download/images/stuff3.gif" border="0" >
		  <?
		 }

		 ?>

		  </a>
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
				SplitPage($page,$totalpage,"?name=download&category=".$_GET['category']."");
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
		<?
			} else {
include 'modules/user/danger.php';
		  }
		  ?>