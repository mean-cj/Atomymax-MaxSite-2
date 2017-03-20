		<center><table width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td align="center">
<?
		$dir=opendir("images/random");
		$file="";
		$a=0;
		$i=0;
		while (($file=readdir($dir))==true) {
//		print $file ."<br>";
		if (($file!=".")&&($file!="..")&&($file!="Thumbs.db")) { 
		$a+=$file;
		$ab[$i]=$file;
		$as[$a]=$file;
			$path="images/random/$ab[$i]";
			$size = getimagesize($path);
			$width = $size[0];
			$height = $size[1];
			$heights = $size[1]+20;
			$i++;
	//		echo "$heights";
?>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" height="<?=$heights;?>">
				<tr>
				<TD vAlign=top align=center >
				<? include 'modules/randomimg/index2.php'; ?>
			</td>
				</tr>
		</table>
		<?
		}
	}
closedir($dir);
?>
</td>
</tr>
</table>