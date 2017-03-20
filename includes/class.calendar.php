<?
//หากมีการเรียกไฟล์นี้โดยตรง
if (preg_match("/class.calendar/i",$_SERVER['PHP_SELF'])) {
    Header("Location: ../index.php");
    die();
}
// PHP Calendar Class Version 1.4 (5th March 2001)
//  
// Copyright David Wilkinson 2000 - 2001. All Rights reserved.
// 
// This software may be used, modified and distributed freely
// providing this copyright notice remains intact at the head 
// of the file.
//
// This software is freeware. The author accepts no liability for
// any loss or damages whatsoever incurred directly or indirectly 
// from the use of this script. The author of this software makes 
// no claims as to its fitness for any purpose whatsoever. If you 
// wish to use this software you should first satisfy yourself that 
// it meets your requirements.
//
// URL:   http://www.cascade.org.uk/software/php/calendar/
// Email: davidw@cascade.org.uk


class Calendar
{
    /*
        Constructor for the Calendar class
    */
    function Calendar()
    {
    }
    
    
    /*
        Get the array of strings used to label the days of the week. This array contains seven 
        elements, one for each day of the week. The first entry in this array represents Sunday. 
    */
    function getDayNames()
    {
        return $this->dayNames;
    }
    

    /*
        Set the array of strings used to label the days of the week. This array must contain seven 
        elements, one for each day of the week. The first entry in this array represents Sunday. 
    */
    function setDayNames($names)
    {
        $this->dayNames = $names;
    }
    
    /*
        Get the array of strings used to label the months of the year. This array contains twelve 
        elements, one for each month of the year. The first entry in this array represents January. 
    */
    function getMonthNames()
    {
        return $this->monthNames;
    }
    
    /*
        Set the array of strings used to label the months of the year. This array must contain twelve 
        elements, one for each month of the year. The first entry in this array represents January. 
    */
    function setMonthNames($names)
    {
        $this->monthNames = $names;
    }
    
    
    
    /* 
        Gets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
      function getStartDay()
    {
        return $this->startDay;
    }
    
    /* 
        Sets the start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
    function setStartDay($day)
    {
        $this->startDay = $day;
    }
    
    
    /* 
        Gets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */
    function getStartMonth()
    {
        return $this->startMonth;
    }
    
    /* 
        Sets the start month of the year. This is the month that appears first in the year
        view. January = 1.
    */
    function setStartMonth($month)
    {
        $this->startMonth = $month;
    }
    
    
    /*
        Return the URL to link to in order to display a calendar for a given month/year.
        You must override this method if you want to activate the "forward" and "back" 
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
        
        If the calendar is being displayed in "year" view, $month will be set to zero.
    */
    function getCalendarLink($month, $year)
    {
        return "";
    }
    
    /*
        Return the URL to link to  for a given date.
        You must override this method if you want to activate the date linking
        feature of the calendar.
        
        Note: If you return an empty string from this function, no navigation link will
        be displayed. This is the default behaviour.
    */
    function getDateLink($day, $month, $year)
    {
        return "";
    }


    /*
        Return the HTML for the current month
    */
    function getCurrentMonthView()
    {
        $d = getdate(time());
        return $this->getMonthView($d["mon"], $d["year"]);
    }
    

    /*
        Return the HTML for the current year
    */
    function getCurrentYearView()
    {
        $d = getdate(time());
        return $this->getYearView($d["year"]);
    }
    
    
    /*
        Return the HTML for a specified month
    */
    function getMonthView($month, $year)
    {
        return $this->getMonthHTML($month, $year);
    }
    

    /*
        Return the HTML for a specified year
    */
    function getYearView($year)
    {
        return $this->getYearHTML($year);
    }
    
    
    
    /********************************************************************************
    
        The rest are private methods. No user-servicable parts inside.
        
        You shouldn't need to call any of these functions directly.
        
    *********************************************************************************/


    /*
        Calculate the number of days in a month, taking into account leap years.
    */
    function getDaysInMonth($month, $year)
    {
        if ($month < 1 || $month > 12)
        {
            return 0;
        }
   
        $d = $this->daysInMonth[$month - 1];
   
        if ($month == 2)
        {
            // Check for leap year
            // Forget the 4000 rule, I doubt I'll be around then...
        
            if ($year%4 == 0)
            {
                if ($year%100 == 0)
                {
                    if ($year%400 == 0)
                    {
                        $d = 29;
                    }
                }
                else
                {
                    $d = 29;
                }
            }
        }
    
        return $d;
    }


    /*
        Generate the HTML for a given month
    */
    function getMonthHTML($m, $y, $showYear = 1)
    {
        $s = "";
        
        $a = $this->adjustDate($m, $y);
        $month = $a[0];
        $year = $a[1];        
        
    	$daysInMonth = $this->getDaysInMonth($month, $year);
    	$date = getdate(mktime(12, 0, 0, $month, 1, $year));
    	
    	$first = $date["wday"];
    	$monthName = $this->monthNames[$month - 1];
    	
    	$prev = $this->adjustDate($month - 1, $year);
    	$next = $this->adjustDate($month + 1, $year);
    	
    	if ($showYear == 1)
    	{
    	    $prevMonth = $this->getCalendarLink($prev[0], $prev[1]);
    	    $nextMonth = $this->getCalendarLink($next[0], $next[1]);
    	}
    	else
    	{
    	    $prevMonth = "";
    	    $nextMonth = "";
    	}
    	
		if(USE_THAIYEAR){
    		$header = $monthName . (($showYear > 0) ? " " . ($year+543) : "");
		}else{
			$header = $monthName . (($showYear > 0) ? " " . $year : "");
		}
    	
    	$s .= "<table class=\"calendar\" cellpadding=\"1\" cellspacing=\"1\">\n";
    	$s .= "<tr>\n";
    	$s .= "<td align=\"right\" valign=\"middle\" >" . (($prevMonth == "") ? "&nbsp;" : "<a href=\"$prevMonth\"><img src=\"images/calendar/back1.png\" border=\"0\"></a>")  . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"calendarHeader\" colspan=\"5\">$header</td>\n"; 
    	$s .= "<td align=\"left\" valign=\"middle\" >" . (($nextMonth == "") ? "&nbsp;" : "<a href=\"$nextMonth\"><img src=\"images/calendar/next1.png\" border=\"0\"></a>")  . "</td>\n";
    	$s .= "</tr>\n";
    	
    	$s .= "<tr>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"padding\">" . $this->dayNames[($this->startDay)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"padding\">" . $this->dayNames[($this->startDay+1)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"padding\">" . $this->dayNames[($this->startDay+2)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"padding\">" . $this->dayNames[($this->startDay+3)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"padding\">" . $this->dayNames[($this->startDay+4)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"padding\">" . $this->dayNames[($this->startDay+5)%7] . "</td>\n";
    	$s .= "<td align=\"center\" valign=\"top\" class=\"padding\">" . $this->dayNames[($this->startDay+6)%7] . "</td>\n";
    	$s .= "</tr>\n";
    	
    	// We need to work out what date to start at so that the first appears in the correct column
    	$d = $this->startDay + 1 - $first;
    	while ($d > 1)
    	{
    	    $d -= 7;
    	}

        // Make sure we know when today is, so that we can use a different CSS style
        $today = getdate(time());
    	
    	while ($d <= $daysInMonth)
    	{
    	    $s .= "<tr>\n";       
    	    
    	    for ($i = 0; $i < 7; $i++)
    	    {
        	    $class = ($year == $today["year"] && $month == $today["mon"] && $d == $today["mday"]) ? "calendarToday" : "padding";
    	        $s .= "<td class=\"$class\" align=\"right\" valign=\"top\">";       
    	        if ($d > 0 && $d <= $daysInMonth)
    	        {
    	            $link = $this->getDateLink($d, $month, $year);
    	            //Date link here
					$s .= (($link == "") ? $d : "<a href=\"".$link['link']."\" onclick=\"return hs.htmlExpand(this, { contentId: 'highslide-html', objectType: 'iframe', objectWidth: '500', objectHeight: '300'} )\" )\"><IMG SRC=\"images/icon/pencil_icon.gif\" BORDER=\"0\" ALIGN=\"\"> <B>$d</B></a>");
    	        }
    	        else
    	        {
    	            $s .= "&nbsp;";
    	        }
      	        $s .= "</td>\n";       
        	    $d++;
    	    }
    	    $s .= "</tr>\n";    
    	}
    	
    	$s .= "</table>\n";
    	
    	return $s;  	
    }
    
    
    /*
        Generate the HTML for a given year
    */
    function getYearHTML($year)
    {
        $s = "";
    	$prev = $this->getCalendarLink(0, $year - 1);
    	$next = $this->getCalendarLink(0, $year + 1);
		if(USE_THAIYEAR){
			$Syear = $year+543 ;
		}else{
			$Syear = $year ;
		}
        
        $s .= "<table  cellpadding=\"1\" cellspacing=\"1\">\n";
        $s .= "<tr>";
    	$s .= "<td  valign=\"middle\" align=\"right\" >" . (($prev == "") ? "&nbsp;" : "<a href=\"$prev\"><img src=\"images/calendar/back1.png\" border=\"0\"></a>")  . "</td>\n";
        $s .= "<td class=\"calendarHeader\" valign=\"top\" align=\"center\">" . (($this->startMonth > 1) ? $Syear . " - " . ($Syear + 1) : $Syear) ."</td>\n";
    	$s .= "<td  valign=\"middle\" align=\"left\" >" . (($next == "") ? "&nbsp;" : "<a href=\"$next\"><img src=\"images/calendar/next1.png\" border=\"0\"></a>")  . "</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>";
        $s .= "<td valign=\"top\">" . $this->getMonthHTML(0 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td valign=\"top\">" . $this->getMonthHTML(1 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td  valign=\"top\">" . $this->getMonthHTML(2 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td  valign=\"top\">" . $this->getMonthHTML(3 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td  valign=\"top\">" . $this->getMonthHTML(4 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td  valign=\"top\">" . $this->getMonthHTML(5 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td  valign=\"top\">" . $this->getMonthHTML(6 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td  valign=\"top\">" . $this->getMonthHTML(7 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td  valign=\"top\">" . $this->getMonthHTML(8 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "<tr>\n";
        $s .= "<td  valign=\"top\">" . $this->getMonthHTML(9 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td  valign=\"top\">" . $this->getMonthHTML(10 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "<td  valign=\"top\">" . $this->getMonthHTML(11 + $this->startMonth, $year, 0) ."</td>\n";
        $s .= "</tr>\n";
        $s .= "</table>\n";
        
        return $s;
    }

    /*
        Adjust dates to allow months > 12 and < 0. Just adjust the years appropriately.
        e.g. Month 14 of the year 2001 is actually month 2 of year 2002.
    */
    function adjustDate($month, $year)
    {
        $a = array();  
        $a[0] = $month;
        $a[1] = $year;
        
        while ($a[0] > 12)
        {
            $a[0] -= 12;
            $a[1]++;
        }
        
        while ($a[0] <= 0)
        {
            $a[0] += 12;
            $a[1]--;
        }
        
        return $a;
    }

    /* 
        The start day of the week. This is the day that appears in the first column
        of the calendar. Sunday = 0.
    */
    var $startDay = 0;

    /* 
        The start month of the year. This is the month that appears in the first slot
        of the calendar in the year view. January = 1.
    */
    var $startMonth = 1;

    /*
        The labels to display for the days of the week. The first entry in this array
        represents Sunday.
    */
    //var $dayNames = array("S", "M", "T", "W", "T", "F", "S");
	var $dayNames = array(_S_Sunday, _S_Monday, _S_Tuesday, _S_Wednesday, _S_Thursday, _S_Friday, _S_Saturday);
    
    /*
        The labels to display for the months of the year. The first entry in this array
        represents January.
    */
    //var $monthNames = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	var $monthNames = array(_F_Month_1, _F_Month_2, _F_Month_3, _F_Month_4, _F_Month_5, _F_Month_6, _F_Month_7, _F_Month_8, _F_Month_9, _F_Month_10, _F_Month_11, _F_Month_12);
                            
                            
    /*
        The number of days in each month. You're unlikely to want to change this...
        The first entry in this array represents January.
    */
    var $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    
}


class MyCalendar extends Calendar
{
	function getCalendarLink($month, $year)
    {
        // to set the new month and year 
		$link = "?name=calendar&file=index";
		return "".$link."&month=".$month."&year=".$year.""; 
	} 

    function getDateLink($day, $month, $year)
    {
		global $db ;
        // Only link the first day of every month 

        $link = "";
		$db->connectdb(DB_NAME,DB_USERNAME,DB_PASSWORD);
		$res['event'] = $db->select_query("SELECT * FROM ".TB_CALENDAR." WHERE date_event='".$year."-".$month."-".$day."' ");
		$arr['event'] = $db->fetch($res['event']);
        if ($arr['event']['id'])
        {
            $link['link'] = "popup.php?name=calendar&file=view&id=".$arr['event']['id']."&dates=".$arr['event']['date_event']."";
			$arr['event']['subject'] = preg_replace("/\'/i", "&#039;", $arr['event']['subject']);
			$arr['event']['subject'] = htmlspecialchars($arr['event']['subject']);
			$link['title'] = "".stripslashes($arr['event']['subject'])."";
        }
        return $link;
    }
}

?>
