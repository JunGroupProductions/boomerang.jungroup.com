2
var adVidIsPlaying = false;

var adUnitClips = ['','adunit_cartown.mp4','adunit_jwire2.mp4','adunit_maybelline.mp4','adunit_foodnetwork3b.mp4'];
var adUnitPosters = ['','','adunit_poster_jwire.jpg','','adunit_poster_foodnetwork.jpg'];

		  
	function adUnitClick()	{
	
		  		mainContentScroll(4);
		   		var id = $(this).attr('id');
				var adUnitNumber = Number(id.substring('adUnitthumb'.length, id.length));
		  		adUnitNumber = adUnitNumber + adUnitTabState;
		  		
		  		$('#overlay').fadeIn(200);
		  		
				$('#adUnitsVid').fadeIn(0);
		  		$('#adUnitsVid').css('width', '668px');
  				$('#adUnitsVid').css('height', '538px');
  				
  				
				//$('#caseStudiesImg').css('z-index', 0);
				//$('#caseStudiesMasterContainer').css('z-index', 0);
				//$('#mainContentContainer').css('z-index', 0);
				//$('#overlay').css('z-index', 1);
				$('#adUnitsVid').css('z-index', 999);
		 	
			
					 
			//alert(adUnitClips[adUnitNumber]);
			
			
			setTimeout(function(){
				//adVidInit(adUnitNumber);
				adVidInit(4);
			},1)
	}
	
	
	function adVidInit(whichVid)	{
		if (whichVid)	{
  		
  		jwplayer('adUnitsVid').setup({
    		'flashplayer': 'jwplayer_old/player.swf',
			'autostart': true,
    		'id': 'playerID2',
    		'width': 668,
    		'height': 538,
    		'wmode':'transparent',
			'image': 'images/' + adUnitPosters[whichVid],
   			'file': 'videos/' + adUnitClips[whichVid]
  		});
  		
  		
  		$('#adUnitsCloseBtn').delay(550).fadeIn(250);
  		
  		vidIsPlaying = true;
		
		
	}
}
		 	
		 	
		 	
	function adUnitClose()	{

			$('#overlay').fadeOut(200);
			//jwplayer().stop();
			//jwplayer('adUnitsVid').remove();
			 adVidIsPlaying = false;
		  	$('#adUnitsVid').css('display', 'none');
		  	

		 }
		  


