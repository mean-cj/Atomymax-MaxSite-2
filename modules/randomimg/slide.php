		<table  border="0" align="center" cellpadding="0" cellspacing="0" >
			<tr>
			<td align=center border=0 >


	<?
		$dir=opendir("images/random");
		$file="";
		$i=0;
		$a=0;
		while (($file=readdir($dir))==true) {
//		print $file ."<br>";
		if (($file!=".")&&($file!="..")&&($file!="Thumbs.db")&&($file!="...")) { 
		$a+=$file;
		$ab[$i]=$file;
		$as[$a]=$file;
				$path="".WEB_PATH."/images/random/$ab[$i]";
			$size = getimagesize($path);
			$width = $size[0];
			$height = $size[1];
			$heights = $size[1]+20;
			$i++;
	?>

<a href="#" class="show"><img alt="" border="0" src="images/random/<? echo $as[$a]; ?>" alt="Stone" width="<?=$width;?>" height="<?=$height;?>" title="" alt="" rel="<h3>Stone</h3>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur."></a>

<?
$a++;
					}
		}
		?>
</div>


		</td>
		</tr>
		<tr>
		<td>&nbsp;&nbsp;
		</td>
		</tr>
	</table>

