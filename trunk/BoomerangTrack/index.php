<!DOCTYPE html><html><head>	<title>:: JUN GROUP ::</title><link href="css_MAIN.css" rel="stylesheet" type="text/css"><!-- jquery core --><script type="text/javascript" src="js/jquery-1.6.1.min.js"></script><!--[if lt IE 9 ]><script type="text/javascript" src="js/jquery-1.8.3.min.js"></script><![endif]--> <!-- jquery easing equations --><script type="text/javascript" src="js/jquery-ui-1.10.2.custom.min.js"></script><script type="text/javascript" src="js/jquery-scrolltofixed-min.js"></script><script type="text/javascript" src="js/functions_MAIN.js"></script><script type="text/javascript" src="js/functions_case_studies.js"></script><script type="text/javascript" src="js/functions_adunits.js"></script><!--<script type='text/javascript' src='jwplayer/jwplayer.js'></script><script type='text/javascript' src='mediaplayer/jwplayer.js'></script>--><script type="text/javascript" src="//use.typekit.net/pek2ifk.js"></script><script type="text/javascript">try{Typekit.load();}catch(e){}</script><script type='text/javascript' src='js/jquery.jqplugin.1.0.2.min.js'></script><script type="text/javascript"> var touchDevice = ('ontouchstart' in window);if (jQuery.browser.flash) {     var script = document.createElement('script');    script.type = "text/javascript";    script.src = 'jwplayer_old/jwplayer.js';  // use the old jw player for flash/desktop	document.getElementsByTagName("head")[0].appendChild(script);	var css=document.createElement("link") 	css.setAttribute("rel", "stylesheet")  	css.setAttribute("type", "text/css")  	css.setAttribute("href", 'css_FLASH.css')	document.getElementsByTagName("head")[0].appendChild(css);}	else	{	var script2 = document.createElement('script');    script2.type = "text/javascript";    script2.src = 'jwplayer/jwplayer.js'; // use the new one for no flash/mobile    document.getElementsByTagName("head")[0].appendChild(script2);    var script3 = document.createElement('script');    script3.type = "text/javascript";    script3.src = 'jwplayer/key.js'; // use the new one for no flash/mobile    document.getElementsByTagName("head")[0].appendChild(script3);	var css2=document.createElement("link") 	css2.setAttribute("rel", "stylesheet")  	css2.setAttribute("type", "text/css")  	css2.setAttribute("href", 'css_NOFLASH.css')	document.getElementsByTagName("head")[0].appendChild(css2);		}var curPage = 0;var curCSImage = 1;var isAutoScrolling = false;var scrollMethod;if($.browser.webkit)	{	scrollMethod = 'body';	} else	{	scrollMethod = 'html, body';	}	//alert($(window).width() + ',' + $(window).height());$(document).ready(function() {if (touchDevice)	{	$('#topLogoExtendedBG').css('width', 1216);	$('#overlay').css('width', 1216);}  $('#overlay').css('display', 'none'); $('#caseStudiesVid').css('display', 'none'); $('#adUnitsVid').css('display', 'none');  			if (document.images) {	var img, n;    img = new Array(13);	for (n=0; n < img.length; n++) img[n] = new Image();	img[0].src = "images/cs-img_corona.png";	img[1].src = "images/cs-img_mac.png";	img[2].src = "images/cs-img_purina.png";	img[3].src = "images/cs-img_samsung.png";	img[4].src = "images/cs-img_dove.png";	img[5].src = "images/cs_corona_wt.png";	img[6].src = "images/cs_dove_wt.png";	img[7].src = "images/cs_fiat_wt.png";	img[8].src = "images/cs_mcdonalds_wt.png";	img[9].src = "images/cs_purina_wt.png";	img[10].src = "images/cs_samsung_wt.png";	img[11].src = "images/adunit2a_thumb.jpg";	img[12].src = "images/adunit2b_thumb.jpg";}	//if (!window.Touch)	{        $('#topNavContainer').scrollToFixed();        $('#topNavExtendedBG').scrollToFixed();	//}                $('.csThumb').bind('mouseleave', csRollOut);        $('.csThumb').bind('mouseenter', csRoll);        $('.csThumb').bind('click', csClick);                $('#adUnitThumb1, #adUnitThumb2').bind('click', adUnitClick);               // $('#caseStudiesVid').bind('click', csClose);                 $('#overlay').bind('click', csClose);         //$('#overlay').bind('click', adUnitClose);                $('.adUnitsTab').bind('click', tabClick);		        		$('#pressArchive').load('press_archive3.html');				        $(window).scroll(function () {         			x = parseInt($('#topNavContainer').css('top')); 		 			var scrollPos = $(scrollMethod).scrollTop(); 			 			var scrollRangesArray = [[-1,270],[272,1028],[1080,1770],[1772,2600],[2602,3454],[3456,4320],[4322,4742],[4744,9000]]; 		//alert(scrollPos); 		if (isAutoScrolling == false)	{ 			for (var i=0;i<=7;i++)	{ 				if ((scrollPos > scrollRangesArray[i][0]) && (scrollPos < scrollRangesArray[i][1]))	{ 					if (i != curPage)	{ 						//console.log(curPage); 						$('#topnav'+curPage).removeClass('isOn');	   					$('#topnav'+curPage).addClass('hasHover'); 						$('#topnav'+i).removeClass('hasHover');	   					$('#topnav'+i).addClass('isOn');	   					curPage = i;	   						   				} 				} 			} 			if (touchDevice)	{ 				if (scrollPos >= 6150 - $(window).height())	{ 				  $('#topnav'+curPage).removeClass('isOn');	   			  $('#topnav'+curPage).addClass('hasHover');	   			  $('#topnav7').removeClass('hasHover');	   			  $('#topnav7').addClass('isOn');	   			  curPage = 7; 				} 			} 			 		} 		 				if (x <= 0)	{ 					$('.topnav0').html('<IMG SRC="images/logo_nav.png" WIDTH="150" HEIGHT="73" BORDER="0" />');					}	else	{						$('.topnav0').html('BOOMERANG REPORTING');				}		});		});</script></head><body bgcolor="#ffffff" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">	<div id="overlay"></div>	<div id="topLogoExtendedBG"></div>			<div id="wrapper">			<div id="topLogoBar">		<IMG SRC="images/logo2.png" WIDTH="702" HEIGHT="222" BORDER="0" />	</div>								<div id="mainContentContainer">			<!--------------- PAGE 1 >>>> HOME AND CASE STUDIES --------------->			<div id="contentPage1">			<?php		if (!isset($_SERVER['PHP_AUTH_USER']))	{    $_SERVER['PHP_AUTH_USER'] = 0;	}	$partner_name = $_SERVER['PHP_AUTH_USER'];define("BITLYTESTPATH", pathinfo(__FILE__, PATHINFO_BASENAME));/*To test bitly-api-php;1) get your access token from http://bitly.com/a/oauth_apps2) copy accesstoken.php.example to accesstoken.php3) open accesstoken.php and paste your token into the script.*/require("accesstoken.php");if (!defined('ACCESSTOKEN'))    exit('Check your accesstoken.php file');require("bitly_api.php");if($partner_name == "Comedy Central") {	$bundle_keys = array(4);}if($partner_name == "Spike") {	$bundle_keys = array(5);}function gatherAudienceData($key){    $auth  = array(        "access_token" => ACCESSTOKEN    );    $bitly = new Bitly($auth);    // ===============================================================        $params = "http://bitly.com/bundles/jungroup/" . $key;        $data   = $bitly->bundle_contents($params);	$title = array();        $long_url = array();    $link_list = array();		echo "<BR><BR>";    echo "<h1>" . strtoupper(($data["bundle"]["title"])) . "<BR><BR></h1>";            foreach($data["bundle"]["links"] as $array => $key) {    	array_push($link_list, ($key["link"]));    	$long_url[$key["link"]] = $key["long_url"];		$title[$key["link"]] = $key["title"];    }    	    if (!$data)        exit("bundle: No bundle found");                // ===============================================================        $params = array(        "shortUrl" => array($link_list        )    );    $data   = $bitly->clicks($params);        $bundle_clicks = 0;        foreach($data as $array => $key) {    	echo "<h3>";    	echo "<b>" . ($title[$key["short_url"]]) . "</b><BR>";    	echo ($long_url[$key["short_url"]]) . "<BR>";				# No longer echoing the short_url		#echo $key["short_url"] . PHP_EOL;    	    	echo "<b><FONT COLOR=\"#CC00000\">";    	echo number_format($key["user_clicks"]) . " clicks<BR>";    			echo "</FONT></h3>";		echo "</b>";    	$bundle_clicks += $key["user_clicks"];    }        echo "<h2>OVERALL STATISTICS: <br><b> <FONT COLOR=\"#CC00000\">" . number_format($bundle_clicks) . " clicks</FONT></B><BR><BR></h2><BR>";            if (!$data)        exit("clicks: clicks returned no data");        // ===============================================================    }foreach($bundle_keys as $key) {	gatherAudienceData($key);}?>									                                                </div><!----- end press page 1 ----->                            	        <div id="footer"><h1>	<font color="#ffffff">CONTACT US<br></font></h1><br>554 5th Avenue<br>6th Floor<br>New York, NY 10036<br>212.692.9500<br><br><a href="mailto:sales@jungroup.com">SALES@JUNGROUP.COM</a>	</div>    </div>	<!-- end main content -->			</div></body></html>
