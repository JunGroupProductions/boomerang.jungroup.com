
var vidIsPlaying = false;

var csInfo = [];

csInfo[0] = [];

csInfo[1] = [
"FIAT 500","<h4>SITUATION</h4>FIAT needed a way to create buzz around its new 2013 FIAT 500 among A25-49.",
"<h4>STRATEGY</h4>We identified the most relevant social networks in our publisher portfolio and distributed the 3-video series via our branded player.",
"<h4>RESULTS</h4>The campaign achieved <B>1,089,898</B> total views, with <B>38,766</B> post-view interactions (including <B>18,919</B> clicks to &#8220;See More&#8221;).","fiat.mp4","poster_fiat.jpg"];

csInfo[2] = [
"MCDONALD&#8217;S","<h4>SITUATION</h4>McDonald&#8217;s sought to showcase its &#8220;farm-to-table&#8221; approach to ingredients to A18-49.",
"<h4>STRATEGY</h4>We used pre-qualification screening to ensure an entirely relevant audience, targeting them through the hottest social applications.",
"<h4>RESULTS</h4><B>689,271</B> total views, with over <B>13,000</B> post-view interactions on desktop and mobile devices, with mobile delivering over <B>34MM</B> banner impressions.","mcdonalds.mp4","poster_mcds.jpg"];

csInfo[3] = [
"DOVE","<h4>SITUATION</h4>Dove needed to reach W25-49 with the message that they could be empowered to be everyday role models, as well as raise awareness around the campaign's mission of &#8220;self-esteem.&#8221;",
"<h4>STRATEGY</h4>As the desired audience &#8211; moms &#8211; are inherently on-the-move, we created a mobile-focused campaign that specifically targeted these users on their favorite apps.",
"<h4>RESULTS</h4>The program delivered <B>961,000+</B> views, with <B>8,400</B> clicks to Dove's self-esteem site and over <B>103MM</B> mobile impressions included as added value.","dove.mp4","poster_dove.jpg"];

csInfo[4] = [
"PURINA","<h4>SITUATION</h4>The Purina brand Friskies needed a way to build awareness around their humorous video, featuring comedian Chris Parnell.",
"<h4>STRATEGY</h4>Jun Group specifically targeted cat owners W25-54 with a pre-engagement screening question &#8211; &#8216;Do you have a cat?&#8217;",
"<h4>RESULTS</h4><B>745,702</B> total views, with <B>26,348</B> post-view interactions, translating to a <B>4.2%</B> engagement rate.","purina.mp4","poster_purina.jpg"];

csInfo[5] = [
"CORONA EXTRA","<h4>SITUATION</h4>Corona Extra wanted to promote its &#8220;Find Your Beach&#8221; campaign through a video series prompting users to enter a contest to &#8220;Win Your Beach.&#8221;",
"<h4>STRATEGY</h4>We used our proprietary prequalification tools to deliver the video to an audience that was 100 percent 21+.",
"<h4>RESULTS</h4>The campaign garnered <B>1,049,716</B> total views &#8211; <B>150,875</B> views over the initially promised amount. The campaign generated <B>29,601</B> post-view interactions, including <B>13,541</B> Facebook visits to &#8220;Win Your Beach.&#8221;","corona.mp4","poster_corona.jpg"];

csInfo[6] = [
"SAMSUNG","<h4>SITUATION</h4>Samsung wanted to drive significant traffic to their Facebook page over a period of 90 days.",
"<h4>STRATEGY</h4>Jun Group drove &#8220;likes&#8221; by guaranteeing over 400,000 clicks to the brand&#8217;s presence on Facebook.",
"<h4>RESULTS</h4>Over <B>1MM</B> video views and a <B>44%</B> engagement rate, resulting in <B>444,063</B> clicks to Samsung&#8217;s Facebook page.","samsung.mp4","poster_samsung.jpg"];


		  
		  function csRoll()	{
		  		 var id = $(this).attr('id');
				 var csNumber = Number(id.substring('csThumb'.length, id.length));
				 var whichImg;
				 var whichThumb;
				// alert(id);
				 
				 if (csNumber==1)	{
				 	whichImg = '<IMG SRC="images/cs-img_fiat.png" WIDTH="768" HEIGHT="435" HSPACE=30 BORDER="0" />';
					//whichImg = 'cs-img_fiat';
				 	whichThumb = 'fiat';
				 }
				 	if (csNumber==2)	{
				 	 whichImg = '<IMG SRC="images/cs-img_mac.png" WIDTH="549" HEIGHT="481" BORDER="0" />';
					//whichImg = 'cs-img_mac';
				 	 whichThumb = 'mcdonalds';
				  }
				 if (csNumber==3)	{
				 	whichImg = '<IMG SRC="images/cs-img_dove.png" WIDTH="602" HEIGHT="447" BORDER="0" />';
					//whichImg = 'cs-img_dove';
				 	whichThumb = 'dove';
				 }
				 if (csNumber==4)	{
				 	whichImg = '<IMG SRC="images/cs-img_purina.png" WIDTH="768" HEIGHT="458" BORDER="0" />';
					//whichImg = 'cs-img_purina';
				 	 whichThumb = 'purina';
				 }
				 if (csNumber==5)	{
				 	whichImg = '<IMG SRC="images/cs-img_corona.png" WIDTH="577" HEIGHT="463" BORDER="0" />';
					//whichImg = 'cs-img_corona';
				 	whichThumb = 'corona';
				 }
				 if (csNumber==6)	{
				 	whichImg = '<IMG SRC="images/cs-img_samsung.png" WIDTH="836" HEIGHT="452" BORDER="0" />';
					//whichImg = 'cs-img_samsung';
				 	whichThumb = 'samsung';
				 }
				 
				//$('#csThumb'+ csNumber).stop().html('<IMG SRC="images/cs_'+whichThumb+'_wt.png" WIDTH="176" HEIGHT="176" BORDER="0" />');
				document.images['csThumb'+csNumber].src = 'images/cs_'+ whichThumb + '_wt.png';
				
				 if (csNumber != curCSImage)	{
					 $('#caseStudiesImg').stop(true,true).fadeOut(100, function() {
   					 	
   					 	$('#caseStudiesImg').html(whichImg);
					//	document.images['csImage'].src = 'images/'+ whichImg + '.png';
   					 	curCSImage = csNumber;
 					 });
 				  }
				
				 $('#caseStudiesImg').delay(100).fadeIn(150);
		  }
		  
		  
		  function csRollOut()	{
		  			
		  		 var id = $(this).attr('id');
				 var csNumber = Number(id.substring('csThumb'.length, id.length));
				 var whichThumb;

				 if (csNumber==1)	{whichThumb = 'fiat';}
				 if (csNumber==2)	{whichThumb = 'mcdonalds';}
				 if (csNumber==3)	{whichThumb = 'dove';}
				 if (csNumber==4)	{whichThumb = 'purina';}
				 if (csNumber==5)	{whichThumb = 'corona';}
				 if (csNumber==6)	{whichThumb = 'samsung';}
				 
				 document.images['csThumb'+csNumber].src = 'images/cs_'+ whichThumb + '.png';
				// $('#csThumb'+ csNumber2).html('<IMG SRC="images/cs_'+whichThumb2+'.png" WIDTH="176" HEIGHT="176" BORDER="0" />');
		  
		  
		  }
		  
		
//alert(csInfo[0][1]);
		
		  
	function csClick()	{
		  
		  		mainContentScroll(1);
		   		var id = $(this).attr('id');
				var csNumber = Number(id.substring('csThumb'.length, id.length));
		  		
		  		$('#overlay').fadeIn(200);
		  		
				$('#caseStudiesVid').fadeIn(0);
		  		//$('#caseStudiesVid').css('top', 310);
		  		//$('#caseStudiesVid').css('opacity', 1);
				
		  		$('#caseStudiesVid').css('width', '665px');
  				$('#caseStudiesVid').css('height', '374px');
  				
  				
				//$('#caseStudiesImg').css('z-index', 0);
				//$('#caseStudiesMasterContainer').css('z-index', 0);
				//$('#mainContentContainer').css('z-index', 0);
				//$('#overlay').css('z-index', 1);
				$('#caseStudiesVid').css('z-index', 999);
		 			 
		 		$('#caseStudiesHeader').html("<h1><font color='#ffffff'>CASE STUDY</font> <font color='#cc0000'>" + csInfo[csNumber][0] + "</font></h1>");

				$('#csSituation').html(csInfo[csNumber][1]);
				$('#csStrategy').html(csInfo[csNumber][2]);
				$('#csResults').html(csInfo[csNumber][3]);

			$('#caseStudiesHeader').delay(100).fadeIn(200);
			$('#caseStudiesInfo').delay(100).fadeIn(200);
			
			setTimeout(function(){
				vidInit(csNumber);
			},1)
	}
	
	
	function vidInit(whichVid)	{
		if (whichVid)	{
		
		//$('#overlay').css('z-index', 700);
		//$('#caseStudiesMasterContainer').css('z-index', 0);
		
		
		/*
		jwplayer('caseStudiesVid').setup({
			'autostart': true,
    		'id': 'playerID',
    		'width': 664,
    		'height': 374,
   			'file': 'videos/' + csInfo[whichVid][4]
  		});
  		
  		jwplayer('caseStudiesVid').resize(664,374);
  		*/
  		
  		jwplayer('caseStudiesVid').setup({
    		'flashplayer': 'jwplayer_old/player.swf',
			'autostart': true,
    		'id': 'playerID',
    		'width': 664,
    		'height': 374,
    		'wmode':'transparent',
    		'image': 'images/' + csInfo[whichVid][5],
   			'file': 'videos/' + csInfo[whichVid][4]
  		});
  		
  		
  		$('#caseStudiesCloseBtn').delay(550).fadeIn(250);
  		
  		vidIsPlaying = true;
		
		//$('#caseStudiesVid').css('z-index', 999);
		//$('#caseStudiesMasterContainer').css('z-index', 1);
		//$('#caseStudiesVid').css('display', 'inline');
		//$('#vidNav').css('display', 'block');
		
		
		
	}
}
		 	
		 	
		 	
	function csClose()	{

			adUnitClose();
			screenshotsClose();
			jwplayer().stop();
			//jwplayer('caseStudiesVid').remove();
			 vidIsPlaying = false;
			
		  //	$('#caseStudiesVid').fadeOut(200);
		  	$('#caseStudiesVid').css('display', 'none');
		  	$('#overlay').fadeOut(200);
		  	$('#caseStudiesCloseBtn').fadeOut(200);
		  	$('#adUnitsCloseBtn').fadeOut(200);
			$('#screenshotsCloseBtn').fadeOut(200);
		  	$('#caseStudiesHeader').fadeOut(200);
		  	$('#caseStudiesInfo').fadeOut(200);
		  	
		 }
		  


