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
						alert('<?php echo  _FROM_SEARCH_NULL;?>') ;
						document.formboard.keyword.focus() ;
						return false ;
						}
						else
						return true ;
						}
                      </script>
<?php
// ระบบค้นหา news ของ maxsite 1.10 พัฒนาโดย www.narongrit.net
empty($_GET['category'])?$category="":$category=$_GET['category'];
empty($_POST['fields'])?$fields="":$fields=$_POST['fields'];
empty($_POST['keyword'])?$keyword="":$keyword=$_POST['keyword'];

?>
    <TABLE cellSpacing=0 cellPadding=0 width=750 border=0>
      <TBODY>
        <TR>
          <TD width="10" vAlign=top></TD>
          <TD width="740" vAlign=top><BR>
		  <!-- video -->
		  &nbsp;&nbsp;<IMG SRC="images/menu/textmenu_video.gif" BORDER="0">
		  <h1></h1>
		  <div align="right">
              <table width="740" align="center" align="left" border="0">
                <tr>
                <td height="50" bgcolor="#F8F8F8"><form name="formsearch" method="post" action="?name=video&file=video_search">
                    <div align="left">
&nbsp;&nbsp;<strong><font color="#009933"><?php echo _FROM_SEARCH_WORD;?></font></strong>&nbsp;
            <input type="text" name="keyword" value="<?php echo"$keyword"; ?>">
&nbsp;&nbsp;&nbsp;<strong> <?php echo _FROM_SEARCH_FIELD;?></strong>
            <select name="fields">
              <option value="id" <?php if($fields=='id'){echo "selected";}?>><?php echo _FROM_SEARCH_FIELD_ID;?> </option>
              <option value="topic" <?php if($fields=='topic'){echo "selected";}?>><?php echo _FROM_SEARCH_FIELD_TOPIC;?> </option>
              <option value="detail" <?php if($fields=='detail'){echo "selected";}?>><?php echo _FROM_SEARCH_FIELD_HEADLINE;?></option>
            </select>
&nbsp;&nbsp;&nbsp;
            <input type="hidden" name="category" value="<?php echo $category;?>">
            <input type="submit" name="Submit" value="<?php echo _FROM_SEARCH_BUTTON;?>">
&nbsp;<b><img src="images/admin/opendir.gif" align="absmiddle"> <a href="?name=video"><?php echo _FROM_SEARCH_ALL;?></a>
<?php 
if($admin_user){
	//Admin Login Show Icon
?>
				  &nbsp;&nbsp;&nbsp;&nbsp;<a href="?name=admin&file=video&op=article_add"><img src="images/admin/i-editor.png" align="absmiddle"> </a>
<?php 
}
?>
<br>
          </b></div>
                </form></td>
              </tr>
<tr>
			<form name="categoty" method="post" enctype="multipart/form-data"><center>
                  <td bgcolor="#F8F8F8"><div align="left"> &nbsp;&nbsp;<strong><font color="#009933"><?php echo _FROM_SEARCH_CAT;?> </font></strong>&nbsp;
                          <select name="category" onchange="if(options[selectedIndex].value){location = options[selectedIndex].value};  MM_jumpMenu('parent',this,0)">
                            <option value="?name=video"><?php echo _FROM_SEARCH_CAT_ALL;?></option>
                            <?php 

$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." ORDER BY sort  ");
while($arr['category'] = $db->fetch($res['category'])){
	echo "<option value=\"?name=video&category=".$arr['category']['id']."\" ";
	if($category == $arr['category']['id']){
		echo " Selected";
	}
	echo ">".$arr['category']['category_name']."</option>\n";
}
$db->closedb ();
?>
                          </select>
&nbsp;&nbsp; </div></td>
            </form>
</tr>
            </table>
            <?php 
function highlight($word, $subject) {
  $pattern = '/(>[^<]*)('.$word.')/i';
  $replacement = '\1<span class="search">\2</span>';
  return preg_replace($pattern, $replacement, $subject);
}
if ($keyword){
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$sql="select * From ".TB_VIDEO." where $fields like '%$keyword%' ";	//เลือกข้อมูลใน DB จากตารางหมวด
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
		  <TABLE width="750" align=center cellSpacing=0 cellPadding=0 border=0>
            <?php 

//แสดงสาระความรู้ 
if($category){
	$SQLwhere = " category='".$category."' ";
	$SQLwhere2 = " WHERE category='".$category."' ";
} else {
	$SQLwhere = " ";
	$SQLwhere2 = " ";
}

if($_POST['fields']) { 
	$SQLwhere2 =" WHERE $_POST[fields] like '%$keyword%'  ";
}
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$limit = 20 ;
$SUMPAGE = $db->num_rows(TB_VIDEO,"id","$SQLwhere");

if (empty($page)){
	$page=1;
}
$rt = $SUMPAGE%$limit ;
$totalpage = ($rt!=0) ? floor($SUMPAGE/$limit)+1 : floor($SUMPAGE/$limit); 
$goto = ($page-1)*$limit ;

// ระบบค้นหาบทความของ maxsite 1.10 พัฒนาโดย www.narongrit.net
$res['video'] = $db->select_query("SELECT * FROM ".TB_VIDEO." $SQLwhere2 ORDER BY id DESC LIMIT $goto, $limit ");
$count=0;
while($arr['video'] = $db->fetch($res['video'])){
	if ($count==0) { echo "<TR>"; }
	//ชื่อหมวดหมู่ 
	$res['category'] = $db->select_query("SELECT * FROM ".TB_VIDEO_CAT." WHERE id=".$arr['video']['category']." "); 
	$arr['category'] = $db->fetch($res['category']);
$ids = highlight("$keyword", '<span>'.$arr['video']['id'].'</span>');
$topics = highlight("$keyword", '<span>'.$arr['video']['topic'].'</span>');
$details = highlight("$keyword", '<span>'.$arr['video']['detail'].'</span>');
?>
													<TD width="33%" valign=top align="center">	
														<TABLE width="100%" border=0 cellSpacing=0 cellPadding=0>
															<tr>
															<TD align="center" >
															<TABLE width="200" border=0 cellSpacing=0 cellPadding=0>
															<tr>
															<TD align="left" ><img src="images/video_icon.png" border="0"> <b><?php echo $topics;?></b>
															</td>
															</tr>
															<TD align="left" ><b>By : <FONT COLOR="#990000"><?php echo $arr['video']['posted'];?></font></b>
															</td>
															</tr>
															<tr>
															<TD align="center" >
															<div class="photo" >
<a HREF="index.php?name=video&file=readvideo&id=<?php echo $arr['video']['id'];?>" ><span></span><img src="<?php if  ($arr['video']['youtube']!=1){ if ($arr['video']['pic']){echo "video/thumbs/".$arr['video']['pic'].""; } else{ echo "images/video_blank.gif";} }else { echo "http://img.youtube.com/vi/".$arr['video']['video']."/default.jpg";}?>" width="<?php echo _IVIDEOT_W;?>" height="<?php echo _IVIDEOT_H;?>"></a>
															</div>
															</td>
															</tr>
															<tr >
															<TD align="left" ><b>Rated :</b> <?php $rater_ids=$arr['video']['id'];$rater_item_name='video';include("modules/rater/raterx.php");?>
															</td>
															</tr>
															<tr >
															<TD align="left" ><b>Added :</b> <?php echo checkPostTimePast($arr['video']['post_date']);?>
</td>
</tr>
															<tr >
															<TD align="left" ><b>Size :</b> <?php echo $arr['video']['size'];?>
</td>
</tr>
															</table>
															</td>
															</tr>
															</TABLE>

													</TD>
      <?php 
$count++;
if (($count%_VIDEO_COL) == 0) { echo "</TR><TR><TD colspan=2 height=\"1\" class=\"dotline\"></TD></TR>"; $count=0; }
}
$db->closedb ();

//จบการแสดงข่าวสาร
?>
          </TABLE>
		  <BR>
          <table border="0" cellpadding="0" cellspacing="1" width="750" align=center>
            <tr>
              <td><?php 
				SplitPage($page,$totalpage,"?name=video&category=".$category."");
				echo $ShowSumPages ;
				echo "<BR>";
				echo $ShowPages ;
				?>
              </td>
            </tr>
          </table>
          <BR>
          <BR>
			<!-- End video -->
		  </TD>
        </TR>
      </TBODY>
    </TABLE>