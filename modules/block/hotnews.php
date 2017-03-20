  													<TABLE width="1000" align=center cellSpacing=0 cellPadding=0 border=0>
													<tr>
													<td>
  <?
echo "<table width=100% border=0 cellpadding=0 cellspacing=0>";
echo "<TR><td border=0 valign=top><marquee scrollamount='3' scrolldelay='60' align='center' onmouseover='this.stop()' onmouseout='this.start()'>"; 
 //        $url1 = "http://rssfeeds.sanook.com/rss/feeds/sanook/hot.news.xml";  
//			$url = "http://www.khaosod.co.th/rss/urgent_news.xml";
//			$url = "http://www.komchadluek.net/rss/news_widget.xml";
         $url = "http://www.thairath.co.th/rss/news.xml";   
		 
//		$random_integer = rand(1,2);
         $xml = file_get_contents($url);

         $xmlDoc = new DOMDocument();

         $xmlDoc->loadXML($xml);

         $items = $xmlDoc->getElementsByTagName("item");

         for ($i = 0; $i < $items->length; $i++) {

                  $item = $items->item($i);

//                  $titles = $item->getElementsByTagName("guid");
					$titles = $item->getElementsByTagName("title");
					$dates = $item->getElementsByTagName("pubDate");
					$links = $item->getElementsByTagName("link");
   //               echo ($i+1).". ".utf8_to_tis620($titles->item(0)->nodeValue). "";
   //$datex=print "".$dates->item(0)->nodeValue."";
   $word = explode(" ","".$dates->item(0)->nodeValue.""); 
   //echo "".$word[0]."" ;
   $ThaiTime="".$word[3]."-".$word[2]."-".$word[1]." ".$word[4]."";
   $ThaiDate=DateThai($ThaiTime);
   $Time=strtotime($ThaiTime);
	//echo TIMESTAMP."-".$Time;
	if(ISO=='utf-8'){
                  echo " <img src=images/a.gif> <a href='".$links->item(0)->nodeValue."' target='_blank' /><b>".$titles->item(0)->nodeValue. "</b></a>(".$ThaiDate.")";
				  echo " ".HotNewsIcon(TIMESTAMP, $Time, "images/icon_new.gif")."";
	} else {
                  echo " <img src=images/a.gif> <a href='".utf8_to_tis620($links->item(0)->nodeValue)."' target='_blank' /><b>".utf8_to_tis620($titles->item(0)->nodeValue). "</b></a>(".$ThaiDate.")";
				  echo " ".HotNewsIcon(TIMESTAMP, $Time, "images/icon_new.gif")."";
	}
         }


echo "</marquee></TD></TR>";
echo "</table>";
//News Icon
function HotNewsIcon($Ntime="", $Otime="", $Icon=""){
	if(TIMESTAMP <= ($Otime + 3600)){
		echo "<IMG SRC=\"".$Icon."\" BORDER=\"0\" ALIGN=\"absmiddle\"> ";
	}
}
	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("",_Month_1,_Month_2,_Month_3,_Month_4,_Month_5,_Month_6,_Month_7,_Month_8,_Month_9,_Month_10,_Month_11,_Month_12);
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
	}

//	$strDate = "2008-08-14 13:42:44";
//	echo "ThaiCreate.Com Time now : ".DateThai($strDate);
?>
											</td>
											</tr>
											</table>


