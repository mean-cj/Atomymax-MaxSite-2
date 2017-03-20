<table >
<tbody>
<tr>
<td align="center">
<script type="text/javascript" src="modules/randomimg/contentslider.js"></script>
<link href="modules/randomimg/contentslider.css" type="text/css" rel="stylesheet"><!-- start slider-->
<div class="sliderwrapper" id="slider1" align="center">
	<?
		$dir=opendir("images/random");
		$file="";
		$i=0;
		$a=0;
		while (($file=readdir($dir))==true) {
//		print $file ."<br>";
		if (($file!=".")&&($file!="..")&&($file!="Thumbs.db")) { 
		$a+=$file;
		$ab[$i]=$file;
		$as[$a]=$file;
		//$a++;

	?>	


<div class="contentdiv"><a href="index.php"><img alt="" border="0" src="images/random/<? echo $as[$a]; ?>"></a></div>
<?
					}
		}
		?>
</div>
<div class="pagination" id="paginate-slider1"></div>
<script type="text/javascript">
featuredcontentslider.init({
id: "slider1",
contentsource: ["inline", ""],
toc: "#increment",
nextprev: ["<<", ">>"],
revealtype: "click",
enablefade: [true, 0.1],
autorotate: [true, 4000],
onChange: function(previndex, curindex){ 
}
})
</script><!-- end slider -->
</td>
</tr>
</tbody>
</table>