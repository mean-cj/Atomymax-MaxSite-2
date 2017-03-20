<table  width="385"  border="0" cellpadding="0" cellspacing="0" >
<tr>
<td  align="right">
<form name="formboard" method="post" action="?name=search&file=getsearch" onsubmit="return checkboard();">
              <div align="right"><strong><?=_FROM_SEARCH_BUTTON;?></strong>            
                <input type="text" name="keyword" value="<?if(!empty($keyword)){ echo"$keyword"; } else {echo "";}?>" style="width:150px; padding:1px">
                <input type="submit" name="Submit" type="button" class="button" value="search">&nbsp;&nbsp;
              </div>
</form>
</td>
</tr>
</table>


