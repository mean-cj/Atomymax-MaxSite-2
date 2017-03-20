			<table cellspacing="0" cellpadding="0" width="<?=$widthSUM;?>" border="0">
			<tbody>
			<tr class="off" onmouseover="this.className='on'" onmouseout="this.className='off'">
            <td align="left" ><ul style="list-style:none; padding:0;height:24px;" id="menu" height="24"><li><a href="index.php"><?=_MAIN_INDEX;?></a></li></ul></td>
			</tr>
<?php
$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
$res['page'] = $db->select_query("SELECT * FROM ".TB_PAGE." WHERE status='1' and menugr='mainmenu' ORDER BY sort ");
while($arr['page'] = $db->fetch($res['page'])){
//echo $arr['page']['links'];
if($arr['page']['links']){
echo "<tr class=off onmouseover=this.className=\"on\" onmouseout=this.className=\"off\">";
echo '<td><ul id="menu" style="list-style:none; padding:0; height:24px;" ><li>';
echo '<a href='.$arr['page']['proto'].''.$arr['page']['links'].' target='.$arr['page']['target'].' >'.$arr['page']['menuname'].'</a></li></ul></td></tr>';
} else { 
echo "<tr class=off onmouseover=this.className=\"on\" onmouseout=this.className=\"off\">";
echo '<td><ul id="menu" style="list-style:none; padding:0;height:24px;"><li>';
echo '<a href="?name=page&file=page&op='.$arr['page']['name'].'"> '.$arr['page']['menuname'].'</a></li></ul></td></tr>'; 
}
}
?>
			<tr class="off" onmouseover="this.className='on'" onmouseout="this.className='off'">
            <td align="left"><ul style="list-style:none; padding:0;height:24px;" id="menu"><li><a href="index.php?name=admin"  title="Administrator" >Administrator</a></li></ul></td>
			</tr>
			</table>
			



