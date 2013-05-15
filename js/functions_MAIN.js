var bioScrollLoc = 0;
var clientScrollLoc = 0;
var publishersScrollLoc = 0;
var adUnitsScrollLoc = 0;
var pressScrollLoc = 0;
var xOffsetArray = [0,247,494,741];
var bioExpanded = false;
var bioClickedOn;
var adUnitTabState = 1;

var screenShots = ['','',''];

	

// CHECK FOR CSS TRANSITION SUPPORT
var thisBody = document.body || document.documentElement;
var thisStyle = thisBody.style;
isWebKit = thisStyle.WebkitTransition !== undefined;
isMoz = thisStyle.MozTransition !== undefined;


  		//--------------------------------------------
		//  main scroll
		//--------------------------------------------
		
		
function mainContentScroll(id)	{

	   isAutoScrolling = true;
	   curPage = id;
	   var scrollLocationsArray = [0,460,1060,1782,2650,3522,4389,5406];
		
	   $('body').append($('<div></div>').addClass('iosfix'));
	   
	  // var newPageHeight = parseInt($('#page'+id).css('height'));
	  
	  if (vidIsPlaying)	{
	 	 csClose();
	  }
	   
	   for (var i=0;i<=7;i++)	{
	   		if (i==id)	{
	   			$('#topnav'+i).removeClass('hasHover');
	   			$('#topnav'+i).addClass('isOn');
	   		}
	   		else	{
	   			$('#topnav'+i).removeClass('isOn');
	   			$('#topnav'+i).addClass('hasHover');
	   		}
	   }
	  
		
		$('html, body').animate({scrollTop: scrollLocationsArray[id]}, 900, 'easeOutQuint', function() {
   	   		setTimeout(function(){
				isAutoScrolling = false;
				//scrollHack();
				$('.iosfix').remove();
				},50);
				
  			});
  	  
}



function scrollHack()	{
	$('#footer').css('width', '+=10');

	//Remove width css
	setTimeout(function() {
  		$('#footer').css('width', '-=10');
	}, 0);
}




function clientScrollold(id)	{
		
		clientScrollLoc = id;
		alert(clientScrollLoc);
		xDestination = id * 680;
       $('#clientsInnerContainer').stop().animate({
  	 'marginLeft' : 0 - xDestination + "px"
  }, 1000, 'easeOutQuint', function() {
    // Animation complete.
  	});
  	
  for (var i=0;i<=6;i++)	{
  		$('#clientNav' + i).css('opacity',.3);
  	}
  	$('#clientNav' + id).css('opacity',1);

}


		//--------------------------------------------
		//  master horizontal scroll
		//--------------------------------------------

function horizScroll(id,whichSection)	{
		whichSection = '#'+whichSection;
		
		if (whichSection == '#biosInnerContainer')	{
			scrollIncrement = 437;
			if (bioExpanded == true)	{
				bioExpand(bioClickedOn);
				}
			} else if (whichSection == '#adUnitsInnerContainer')	{
				scrollIncrement = 500;
			} else if (whichSection == '#publishersInnerContainer')	{
				scrollIncrement = 675;
			} else if (whichSection == '#pressInnerContainer')	{
				scrollIncrement = 955;
			} else	{
				scrollIncrement = 680;
			}
	
		var xDestination = id * scrollIncrement;
		var target = (0 - xDestination)  + "px";
		
		if (isWebKit == true)	{
     		 $(whichSection).css({'-webkit-transition-timing-function': 'cubic-bezier(0.230, 1.000, 0.320, 1.000)','-webkit-transition-duration': '1s'});
	  		 $(whichSection).css("-webkit-transform", "translate3d("+ target + ",0px,0)");
		}  else if (isMoz == true)	{
			 $(whichSection).css({'-moz-transition-timing-function': 'cubic-bezier(0.230, 1.000, 0.320, 1.000)','-moz-transition-duration': '1s'});
	  		 $(whichSection).css("-moz-transform", "translate("+ target + ",0px)");
		}	else	{
			$(whichSection).stop().animate({
  	 'marginLeft' : 0 - xDestination + "px"}, 1000, 'easeOutQuint', function() {
    	// Animation complete.
  		});
			
		}
		

	if (whichSection == '#clientsInnerContainer')	{
		navdDotName = '#clientNav';
		clientScrollLoc = id;
	}
	if (whichSection == '#publishersInnerContainer')	{
		navdDotName = '#publishersNav';
		publishersScrollLoc = id;
	}
	if (whichSection == '#adUnitsInnerContainer')	{
		navdDotName = '#adUnitsNav';
		adUnitsScrollLoc = id;
	}
	if (whichSection == '#pressInnerContainer')	{
		navdDotName = '#pressNav';
		pressScrollLoc = id;
	}
	if (whichSection == '#biosInnerContainer')	{
		navdDotName = '#bioNav';
		bioScrollLoc = id;
		
	}

  	
  for (var i=0;i<=6;i++)	{
  		$(navdDotName + i).css('opacity',.3);
  	}
  	$(navdDotName + id).css('opacity',1);

}



		//--------------------------------------------
		//  bio stuff
		//--------------------------------------------
		
function bioScroll(id)	{

	if (bioExpanded == true)	{
		bioExpand(bioClickedOn);
	}

		xDestination = id * 437;
       $('#biosInnerContainer').stop().animate({
  	 'marginLeft' : 0 - xDestination + "px"
  }, 1000, 'easeOutQuint', function() {
    // Animation complete.
  	});
  	bioScrollLoc = id;
  	$('#bioNav0').css('opacity',.3);
  	$('#bioNav1').css('opacity',.3);
  	$('#bioNav' + id).css('opacity',1);

}




function bioExpand(id)	{

	if (bioExpanded == false)	{   // then expand bio
	
	bioClickedOn = id;
	
	for (var i=1;i<=4;i++)	{
		if (i != id)	{
			//$('#bio' + i).css('display','none');
			$('#bio' + i).fadeOut(200);
		}
	}
	
		$('#biosDivider').fadeOut(250);
	
		var target = 0-xOffsetArray[id-1] + "px";
	
		if (isWebKit == true)	{
			setTimeout(function()	{
     		 $('#biosInnerContainer').css({'-webkit-transition-timing-function': 'cubic-bezier(0.230, 1.000, 0.320, 1.000)','-webkit-transition-duration': '.3s'});
	  		$('#biosInnerContainer').css("-webkit-transform", "translate3d("+ target + ",0px,0)");
	  		},150);
			}	else if (isMoz == true)	{
				$('#biosInnerContainer').css({'-moz-transition-timing-function': 'cubic-bezier(0.230, 1.000, 0.320, 1.000)','-moz-transition-duration': '.3s'});
	  		 	$('#biosInnerContainer').css("-moz-transform", "translate("+ target + ",0px)");
			} else	{
   	 $('#biosInnerContainer').delay(150).animate({'marginLeft' : target}, 200,'easeOutQuint');
    }
	 
   // $('#biosInnerContainer').delay(200).animate({'marginLeft' : 0 + "px"}, 0);
		
    $('#bio' + id).delay(150).animate({'width': 1035 + "px"}, 500, 'easeOutQuint', function() {});
    $('#biosMasterContaner').delay(200).animate({'width': 1045 + "px"}, 500, 'easeOutQuint', function() {});
	$('#bioOpen'+id+' img').delay(150).fadeOut(250);
	$('#bioClose'+id +' img').delay(150).fadeIn(250);
	//$('#biosDivider').delay(200).animate({'left': 1104 + "px"}, 500, 'easeOutQuint', function() {});

	bioExpanded = true;
	
	}	else	{  // then collapse it
		
		bioExpanded = false;
		
		target = 0-bioScrollLoc * 437 + "px"
		
		if (isWebKit == true)	{
     		 $('#biosInnerContainer').css({'-webkit-transition-timing-function': 'cubic-bezier(0.230, 1.000, 0.320, 1.000)','-webkit-transition-duration': '.2s'});
	  		 $('#biosInnerContainer').css("-webkit-transform", "translate3d("+ target + ",0px,0)");
			}	else if (isMoz == true)	{
				$('#biosInnerContainer').css({'-moz-transition-timing-function': 'cubic-bezier(0.230, 1.000, 0.320, 1.000)','-moz-transition-duration': '.2s'});
	  		 	$('#biosInnerContainer').css("-moz-transform", "translate("+ target + ",0px)");
			} else	{
			 $('#biosInnerContainer').animate({'marginLeft' : target}, 200,'easeOutQuint');
		 }
		 
		 
		$('#bio' + id).animate({'width': 237 + "px"}, 250, 'easeOutQuint');
		$('#biosMasterContaner').animate({'width': 546 + "px"}, 250);
		for (var j=1;j<=4;j++)	{
			$('#bio' + j).delay(200).fadeIn(200);
		
		}
		$('#biosDivider').fadeIn(250);
		$('#bioOpen'+id+' img').fadeIn(250);
		$('#bioClose'+id+' img').fadeOut(250);
	
	}
	
}


		//--------------------------------------------
		//  ad unit stuff
		//--------------------------------------------
		
		
function tabClick()	{
	var id = $(this).attr('id');
	var tabNumber = Number(id.substring('tab'.length, id.length));
	
	adUnitTabState = tabNumber;
	
	var otherTab = tabNumber+1;
	if (otherTab == 3) {otherTab = 1;}
	$('#tab'+tabNumber).css('background-position','0 0');
	$('#tab'+tabNumber).css('color','#fff');
	$('#tab'+otherTab).css('background-position','319px 0');
	$('#tab'+otherTab).css('color','#999');
	
	var target = target = 0-((tabNumber-1) * 638) + "px"
	$('#adUnitsInnerContainer').css('marginLeft',target);
	
	//document.images['adUnitThumb1'].src = 'images/adunit'+ tabNumber + 'a_thumb.jpg';
	//document.images['adUnitThumb2'].src = 'images/adunit'+ tabNumber + 'b_thumb.jpg';
	
	}
	
		//--------------------------------------------
		//  press screenshots
		//--------------------------------------------
	
function showScreenshot(which)	{
			$('html, body').animate({scrollTop: 4520}, 900, 'easeOutQuint');
			$('#overlay').fadeIn(200);
			$('#screenshotsCloseBtn').delay(550).fadeIn(250);
			$('#screenShot'+which).delay(550).fadeIn(250);
}

function screenshotsClose(which)	{
			$('#overlay').fadeOut(200);
			$('#screenshotsCloseBtn').fadeOut(100);
			$('#screenShot0').fadeOut(100);
			$('#screenShot1').fadeOut(100);
			$('#screenShot2').fadeOut(100);
}


		//--------------------------------------------
		//  touch functions
		//--------------------------------------------
		
$(function () {
		
var originalCoord = { x: 0, y: 0 };
var finalCoord = { x: 0, y: 0 };

var targID = 0;

var timer;
var transitioning = 'off';
var listenerOn;
var newX = 0;



function forwardClick(whichSection) {
	if (whichSection == 'clientsInnerContainer')	{
		clientScrollLoc++;
		if (clientScrollLoc > 5)	{
			clientScrollLoc = 5
		}
		horizScroll(clientScrollLoc,whichSection);
	}
   	if (whichSection == 'publishersInnerContainer')	{
   		publishersScrollLoc++;
		if (publishersScrollLoc > 1)	{
			publishersScrollLoc = 1
		}	 
		horizScroll(publishersScrollLoc,whichSection);
	}
	if (whichSection == 'pressInnerContainer')	{
   		pressScrollLoc++;
		if (pressScrollLoc > 1)	{
			pressScrollLoc = 1
		}	 
		horizScroll(pressScrollLoc,whichSection);
	}
	if (whichSection == 'biosInnerContainer')	{
   		bioScrollLoc++;
		if (bioScrollLoc > 1)	{
			bioScrollLoc = 1
		}	 
		horizScroll(bioScrollLoc,whichSection);
	}
	if (whichSection == 'adUnitsInnerContainer')	{
   		adUnitsScrollLoc++;
		if (adUnitsScrollLoc > 1)	{
			adUnitsScrollLoc = 1
		}	 
		horizScroll(adUnitsScrollLoc,whichSection);
	}
}


function backClick(whichSection) {
  	if (whichSection == 'clientsInnerContainer')	{
		clientScrollLoc--;
		if (clientScrollLoc < 0)	{
			clientScrollLoc = 0
		}
		horizScroll(clientScrollLoc,whichSection);
	}
   	if (whichSection == 'publishersInnerContainer')	{
   		publishersScrollLoc--;
		if (publishersScrollLoc < 0)	{
			publishersScrollLoc = 0
		}	 
		horizScroll(publishersScrollLoc,whichSection);
	}
		if (whichSection == 'pressInnerContainer')	{
   		pressScrollLoc--;
		if (pressScrollLoc < 0)	{
			pressScrollLoc = 0
		}	 
		horizScroll(pressScrollLoc,whichSection);
	}
	if (whichSection == 'biosInnerContainer')	{
   		bioScrollLoc--;
		if (bioScrollLoc < 0)	{
			bioScrollLoc = 0
		}	 
		horizScroll(bioScrollLoc,whichSection);
	}
	if (whichSection == 'adUnitsInnerContainer')	{
   		adUnitsScrollLoc--;
		if (adUnitsScrollLoc < 0)	{
			adUnitsScrollLoc = 0
		}	 
		horizScroll(adUnitsScrollLoc,whichSection);
	}
}


function touch_start() {

   originalCoord.x = null;
   originalCoord.y = null;
   finalCoord.x = null;
   finalCoord.y = null;
  
   originalCoord.x = event.targetTouches[0].pageX
   originalCoord.y = event.targetTouches[0].pageY
   // originalX = 0- (curSlide * masterImageWidth);
   p = $(this).position();
   originalX = p.left;
   //$('#testtext').html(p.left);
}

function touch_move() {      
    // updated x,y coordinates  
    finalCoord.x = event.targetTouches[0].pageX;  
    finalCoord.y = event.targetTouches[0].pageY;    
    var changeX = originalCoord.x - finalCoord.x;  
    var changeY = originalCoord.y - finalCoord.y;    
    if (((changeX > 20) || (changeX < -20))  && (listenerOn != 'on'))    {    
        //console.log('body.addlistener');  
        document.body.addEventListener('touchmove', temp = function(event) {event.preventDefault(); }, false);      
        listenerOn = 'on'; 
    }   
    newX = originalX - changeX;  
    if (transitioning == 'off')    {      
        dragAllImages(newX,this.id);  
    }
}

function touch_end() {
	var changeX = originalCoord.x - finalCoord.x;
	var changeY = originalCoord.y - finalCoord.y;
	
	 if (listenerOn == 'on')    {        
        document.body.removeEventListener('touchmove', temp, false);         
        listenerOn = 'off';
        //console.log('body.removelistener');
    }    
	
	
	if (changeY < 100 && changeY > -100) {
		if (changeX > 60) {
     		forwardClick(this.id);
    	} else if (changeX < -60) {
      		backClick(this.id);
    	} else {
    		if (this.id == 'clientsInnerContainer')	{
				horizScroll(clientScrollLoc,this.id);	
			}
			if (this.id == 'publishersInnerContainer')	{
				horizScroll(publishersScrollLoc,this.id);	
			}
			if (this.id == 'pressInnerContainer')	{
				horizScroll(pressScrollLoc,this.id);	
			}
			if (this.id == 'biosInnerContainer')	{
				horizScroll(biosScrollLoc,this.id);	
			}
			if (this.id == 'adUnitsInnerContainer')	{
				horizScroll(adUnitsScrollLoc,this.id);	
			}
		}
	}
}

function touch_cancel() {
}

function dragAllImages(newX,whichSection) 	{
	var target = newX  + "px";
		$('#'+whichSection).css('-webkit-transition-duration', '0s');
		//var slide = $('#clientsInnerContainer');
		//$('#clientsInnerContainer').style.webkitTransform = "translate3d("+ target + ",0px,0)";
		$('#'+whichSection).css("-webkit-transform", "translate3d("+ target + ",0px,0)");
	
}

});


