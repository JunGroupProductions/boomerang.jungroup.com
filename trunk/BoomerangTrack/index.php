<!DOCTYPE html><html><head>	<title>:: JUN GROUP ::</title><link href="css_MAIN.css" rel="stylesheet" type="text/css"><!-- jquery core --><script type="text/javascript" src="js/jquery-1.6.1.min.js"></script><!--[if lt IE 9 ]><script type="text/javascript" src="js/jquery-1.8.3.min.js"></script><![endif]--> <!-- jquery easing equations --><script type="text/javascript" src="js/jquery-ui-1.10.2.custom.min.js"></script><script type="text/javascript" src="js/jquery-scrolltofixed-min.js"></script><script type="text/javascript" src="js/functions_MAIN.js"></script><script type="text/javascript" src="//use.typekit.net/vns3hig.js"></script><script type="text/javascript">try{Typekit.load();}catch(e){}</script><script type='text/javascript' src='js/jquery.jqplugin.1.0.2.min.js'></script></head><body bgcolor="#ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">	<div id="overlay"></div>	<div id="topLogoExtendedBG"></div>		<div id="wrapper">			<div id="topLogoBar">		<IMG SRC="images/logo2.png" WIDTH="702" HEIGHT="222" BORDER="0" />	</div>								<div id="mainContentContainer">			<!--------------- PAGE 1 >>>> HOME AND CASE STUDIES --------------->			<div id="contentPage1">		</script>	<?php		require 'config.php';		function getbgc($trcount)	{		$blue="\"background-color: #fbfbfb;\"";		$green="\"background-color: #eff0ef;\"";		$odd=$trcount%2;	    if($odd==1){return $blue;}    	else{return $green;    }        }	if (!isset($_SERVER['PHP_AUTH_USER']))	{    $_SERVER['PHP_AUTH_USER'] = 0;	}	$partner_name = $_SERVER['PHP_AUTH_USER'];##################### COLLECTING THE DATA WITH MYSQL ################################ But, for the current month, we're really concerned with showing the payouts by day.$offer_id_query = mysql_fetch_array(mysql_query( "select offers.id, offers.title from offers								where offers.name = '$partner_name'" ));#### START OUTPUTTING OF DATA AROUND PAYOUT DELIVERY BY MONTH$traffic_by_day_query = mysql_query( "select date(convert_tz((wtuv.created_at),'GMT','EST')) as date, count(*) as page_views from web_traffic_url_visits wtuv									join viewings on viewings.id = wtuv.viewing_id									where offer_id = $offer_id_query[0]									group by date");# Go through our payouts by day for the current month, output the data so the user can see it.echo "<BR>";    #echo "<h1>" . strtoupper($offer_id_query[1]) . "<BR><BR></h1>";echo "<h2>TOTAL TRAFFIC BY DATE:</h2>";echo "<table class=\"gridtable\">";echo "<tr>";echo "<th>DATE</th><th>PAGE VIEWS</th>";echo "</tr>";$i = 0;    $pages_overall = 0;                                            while ($row = mysql_fetch_array($traffic_by_day_query)) {      echo "<tr style=".getbgc($i).">";    echo "<td>" . date("F j, Y", strtotime($row['date'])). " </td><td> " . number_format($row['page_views']) . "</td>";    echo "</tr>";        $pages_overall += $row['page_views'];        $i++;                                                    }                                                echo "</table>";                                                echo "<BR/>";$traffic_by_url = mysql_query( "select url as url, count(*) as page_views from web_traffic_url_visits wtuv									join viewings on viewings.id = wtuv.viewing_id									where offer_id = $offer_id_query[0]									group by url");	$i = 0;echo "<table class=\"gridtable2\">";echo "<tr>";echo "<th>URL</th><th>PAGE VIEWS</th>";echo "</tr>";function Truncate($string, $length, $stopanywhere=true) {    //truncates a string to a certain char length, stopping on a word if not specified otherwise.    if (strlen($string) > $length) {        //limit hit!        $string = substr($string,0,($length -3));        if ($stopanywhere) {            //stop anywhere            $string .= '...';        } else{            //stop on a word.            $string = substr($string,0,strrpos($string,' ')).'...';        }    }    return $string;}	      echo "<h2>TOTAL TRAFFIC BY URL:</h2>";	                                            while ($row = mysql_fetch_array($traffic_by_url)) {      echo "<tr style=".getbgc($i).">";    echo "<td>" . Truncate($row['url'],80). " </td><td style=\"text-align:center;\"> " . number_format($row['page_views']) . "</td>";    echo "</tr>";            $i++;                                                    }		echo "</table>";    echo "</br>";echo "<h2>TOTAL PAGE VIEWS: <br><br><FONT COLOR=\"#cc0000\">" . number_format($pages_overall) . " total page views <BR></h2><BR></FONT>";?>	<div id="output">	</div>	<script type="text/javascript">var $output = $('#output');var elementOffset = $('#output').offset().top    $(document).ready(function(){  $("#wrapper")	.css("height",elementOffset + "px");});$(function(){  $("table.alternate_color tr:even").addClass("d0");   $("table.alternate_color tr:odd").addClass("d1");});</script>                                                                    </div><!----- end press page 1 ----->                            	    	</div>    </div>	<!-- end main content -->		    <div id="footer"><h1>	<font color="#ffffff">CONTACT US<br></font></h1><br>554 5th Avenue<br>6th Floor<br>New York, NY 10036<br>212.692.9500<br><br><a href="mailto:sales@jungroup.com">SALES@JUNGROUP.COM</a>	</div></body></html>