/*!
 * Planit - jQuery Plugin
 * version: 2.3 (Tues, 1st October 2013)
 * @requires jQuery v1.6 or later
 *
 * Copyright 2013 Panaround - enquiries@panaround.co.uk
 *
 */

(function ($) {
	
    $.fn.planit = function (options) {

        var defaults = {
            basepath: 'planit',
            roomName: 'Room Name',
			pageTitle: 'Page Title',
			selectedLayout: 'boardroom',
			color: '#333333',
			virtualTour: true,
			roomDimensions: true,
			power:true,
			tvScreens: false,
			fireEscapes: false,

        };

		var $tourWidth = '930';
    	var $tourHeight = '470';
		
		var $floorplanHeight;
		var $floorplanWidth; 

	/* ///////////////////////////  */
	/*	ROOM LAYOUT SETUP			*/
	/* ///////////////////////////  */
	
	$('.fancybox').fancybox();
	
	if(options.virtualTour == true){$("#tour_button").show()}
	
	var $selected = options.selectedLayout
	var $curRoomName;
	var $container = $(this);

	init() 
	  
	function init() {
		createHTML();
		$('#floorplan_title').html(options.pageTitle);
		setInitialImageLoad($selected);
		createRooms();
	}
	
	    	
    function createHTML() {
		
	  var $htmlLayout; 
	  
	  $htmlLayout =     '<div id="planit_container">';
	  $htmlLayout +=       '<div id="planit_left">'
	  $htmlLayout +=      	 '<div class="planit_left_col capacities round">'
	  $htmlLayout +=      	 	'<div class="title round">Capacities</div>'
	  $htmlLayout +=      	 	'<ul id="capacities"></ul>'
	  $htmlLayout +=       	  '</div>'
	 
	  $htmlLayout += 			'<div class="planit_left_col options round">'
	  $htmlLayout += 			'<div class="title round">Options</div>'
	  $htmlLayout += 				'<ul>'
	  if(options.power != false){
	 	 $htmlLayout +=					'<li  id="power"><a href="#">Power Sockets</a></li>'
	  }if(options.tvScreens != false){
	  	 $htmlLayout +=					'<li  id="screens"><a href="#">TV Screens</a></li>' 
	  }if(options.fireEscapes != false){
	  	 $htmlLayout +=				    '<li  id="fire"><a href="#">Fire Escape</a></li>' 
	  }if(options.roomDimensions != false){
	  	 $htmlLayout +=				    '<li  id="dimensions"><a href="#">Dimensions</a></li>' 
	  }
	  $htmlLayout += 				'</ul>'
	  $htmlLayout += 			'</div>'
	  $htmlLayout +=       '</div>'
	   
      $htmlLayout +=       '<div id="planit_right">'
	  
	  $htmlLayout +=       	 '<div id="main_content_panel">'
	    
      $htmlLayout +=     		    '<div id="panaround_virtual_tour"></div><div id="html5_tour"></div>'

	  $htmlLayout +=       		    '<div id="planit_floorplan_display">'
	  $htmlLayout +=						'<div id="floorplan_title"></div> '
	  $htmlLayout +=						'<img id="image_floorplan" />'
	  
	  if(options.roomDimensions != false){
	  	$htmlLayout += 						'<img id="image_dimensions" src="'+options.basepath+'/rooms/'+options.roomName+'/floorplans/dimensions.png" />'
	  }
      $htmlLayout += 						'<img id="image_power" src="'+options.basepath+'/rooms/'+options.roomName+'/floorplans/power.png" />'
      $htmlLayout += 						'<img id="image_screens" src="'+options.basepath+'/rooms/'+options.roomName+'/floorplans/tv.png" />' 
      $htmlLayout += 						'<img id="image_fire" src="'+options.basepath+'/rooms/'+options.roomName+'/floorplans/fire-exit.png" />' 
	  $htmlLayout += 						'<img id="image_compass" src="'+options.basepath+'/rooms/'+options.roomName+'/floorplans/compass.png" />'
	  $htmlLayout +=  			    '</div>'
	  
	  $htmlLayout +=			'</div>'
	  
	  $htmlLayout +=			'<div id="planit_right_footer">'
	  
	  if(options.virtualTour != false){
	  $htmlLayout += 					'<a class="button" id="tour_button"><span>V</span>Virtual Tour</a>'
	  }
	  $htmlLayout += 				    '<a class="button" id="plan_button"><span>p</span>Floor Plan</a>'
	  
	  $htmlLayout +=					'<a class="fancybox button" id="enlarge_button" href="#lightbox" >'
	  
	  $htmlLayout +=					'<span>%</span>Enlarge</a>'
	  $htmlLayout +=					'<a href="http://www.panaround.co.uk" target="_blank"><img id="logo" src="'+options.basepath+'/global/img/planit-logo.png" alt=""/></a>'
	  $htmlLayout +=			'</div>'
	  $htmlLayout +=		'</div>'
	  $htmlLayout +=	'</div>'
	  
	  $htmlLayout += '<div id="lightbox" style="display:none;position:relative;height:'+$floorplanHeight+';width:'+$floorplanWidth+'; " >'
		
	  $htmlLayout += '<img id="lightbox_main_image" src="'+options.basepath+'/rooms/'+options.roomName+'/floorplans/'+$selected+'.jpg" style="max-width:800px; max-height:600px; position:absolute; width:750px" /> ' 
	  
	  $htmlLayout += '<img id="lightbox_compass" src="'+options.basepath+'/rooms/'+options.roomName+'/floorplans/compass.png" style="max-width:800px; max-height:600px; position:absolute; width:750px;  " /> ' 
	  
	  $htmlLayout += '<img id="lightbox_power" src="'+options.basepath+'/rooms/'+options.roomName+'/floorplans/power.png" style="max-width:800px; max-height:600px; position:absolute; width:750px; display:none; " /> ' 
	  
	  $htmlLayout += '<img id="lightbox_fire" src="'+options.basepath+'/rooms/'+options.roomName+'/floorplans/fire-exit.png" style="max-width:800px; max-height:600px; position:absolute; width:750px; display:none; " /> ' 
	  
	  $htmlLayout += '<img id="lightbox_screens" src="'+options.basepath+'/rooms/'+options.roomName+'/floorplans/tv.png" style="max-width:800px; max-height:600px; position:absolute; width:750px; display:none; " /> ' 
	  
	  $htmlLayout += '<img id="lightbox_dimensions" src="'+options.basepath+'/rooms/'+options.roomName+'/floorplans/dimensions.png" style="max-width:800px; max-height:600px; position:absolute; width:750px; display:none; " /> ' 

	  $htmlLayout += '<a href="#" class="print" rel="lightbox">Print</a>'
	  $htmlLayout += '</div>'
	  
	  $($container).html($htmlLayout)
	  	  
	}
	
	$(function() {
	
		$('.print').click(function() {
			
			var container = $(this).attr('rel');
			$('#' + container).printArea();
			return false;
		});
	
	});
	

   function parseXml(xml) {
     if (jQuery.browser.msie) {
        var xmlDoc = new ActiveXObject("Microsoft.XMLDOM"); 
        xmlDoc.loadXML(xml);
        xml = xmlDoc;
    }   
    return xml;
	}
	
	
	 /* PRELOAD IMAGES */
		 
	  var images = [
		  options.basepath+'/rooms/'+options.roomName+'/floorplans/boardroom.jpg',
		  options.basepath+'/rooms/'+options.roomName+'/floorplans/buffet.jpg',
		  options.basepath+'/rooms/'+options.roomName+'/floorplans/cabaret.jpg',
		  options.basepath+'/rooms/'+options.roomName+'/floorplans/classroom.jpg',
		  options.basepath+'/rooms/'+options.roomName+'/floorplans/dinner.jpg',
		  options.basepath+'/rooms/'+options.roomName+'/floorplans/exam.jpg',
		  options.basepath+'/rooms/'+options.roomName+'/floorplans/reception.jpg',
		  options.basepath+'/rooms/'+options.roomName+'/floorplans/theatre.jpg',
		  options.basepath+'/rooms/'+options.roomName+'/floorplans/ushape.jpg',
		  options.basepath+'/rooms/'+options.roomName+'/floorplans/hollowsquare.jpg',
		  options.basepath+'/rooms/'+options.roomName+'/floorplans/clearfloor.jpg'
	  ];
	  
	  $(images).each(function() {
		  var image = $('<img />').attr('src', this);
	  });
	  
	
	
	function createRooms() {
		
		var html;
		
		var $url = options.basepath+'/rooms/'+options.roomName+'/xml/layouts.xml';
		
		$.get($url, function(xmldata){  
		
		  newData = xmldata;
		  
		  $(newData).find('layout').each(function(){  
		  
			  var $layout = $(this);  
			  var $title = $layout.attr("title"); 
			  
			  if($layout.find('capacity').text() == ''){
			  var $capacity = "";
			  }else{
			  var $capacity = $layout.find('capacity').text(); 
		 	  }
			   
			  if ($title == $selected){
					html = '<li class="selected">'+$title+'<span>'+$capacity+'</span></li>';
			  }else{
					html = '<li>'+$title+'<span>'+$capacity+'</span></li>';
			  }  
  
			  $('#capacities').append($(html));  
			  
		  });  	

	   }); 
	   
		 	
	 }
	 
	 
	/* ///////////////////////////  */
	/*	HOVER ACTIONS			*/
	/* ///////////////////////////  */

	function getCurRoomName($name) {

		$curRoomName = $name.replace(/\d+/g,'');
	    $curRoomName = $curRoomName.replace(/ /g,'').toLowerCase()
		
		return $curRoomName;
	}
	
	function setInitialImageLoad($name) {

		var src = options.basepath+"/rooms/"+options.roomName+"/floorplans/"+$name+".jpg"
		$('#image_floorplan').attr('src', src);
		
		$("#image_floorplan").load(function() {
			   setTimeout( function() {
			  	 setWidths()
		 		}, 250 );
		})

	}
	

	function setCurRoom($name) {

		var src = options.basepath+"/rooms/"+options.roomName+"/floorplans/"+$name+".jpg"
		$('#image_floorplan').attr('src', src);
		$('#lightbox_main_image').attr('src', src);

	}
	
	$('ul#capacities, #planit_left, #planit_container').live({

       mouseleave:
	   function(e)
           {  
		   	   setTimeout( function() {
			   setCurRoom($selected); 
			   }, 300 );
		   }
		   
	});
	
	$('#planit_right').live({

       mouseenter:
	   function(e)
           {  setCurRoom($selected); 
		      e.stopPropagation();
       		  return false;
		   }
	});

	$("ul#capacities li span").live({

        mouseenter:
           function(e)
           {  setCurRoom($curRoomName); 
		      e.stopPropagation();
       		  return false;
		   }
       }
    );
	
	
	$("#inline1 h3").live({
		
		click:
           function(e)
           {
			 window.print();
           }
       }
	   
    );
	
	
	$("ul#capacities li").live({

		 mouseenter:
           function(e)
           {  
		    getCurRoomName($(this).text());
			setCurRoom($curRoomName);
           },
        mouseleave:
           function(e)
           {
 		    setCurRoom($selected);
           },

		click:
           function(e)
           {
			   
			  e.preventDefault();
			  $("ul#capacities li").removeClass('selected');      
			  getCurRoomName($(this).text())
			  $selected = $curRoomName;
			  setCurRoom($selected)
			  $(this).addClass('selected'); 
			  $("a#single_image").attr('href',options.basepath+'/rooms/'+options.roomName+'/floorplans/'+$selected+'.jpg');
			  
           }
       }
	   
    );
	
	
	/* ///////////////////////////  */
	/*	OPTIONS SELECTION		*/
	/* ///////////////////////////  */
	
	$("#planit_container .options ul li").live('click', function (e) {
		
		e.preventDefault();
		
		var $currentItem = '#image_' + $(this).attr('id');
		var $currentLightbox = '#lightbox_' + $(this).attr('id');
		
		if ($(this).hasClass('selected')) {
			 $($currentItem).hide();
			 $($currentLightbox).hide();
			 $(this).removeClass('selected');
			 //$(this).css("backgroundPosition", "5px 7px" );
			 
		
		}else {
			$($currentItem).show();
			$($currentLightbox).show();
			$(this).addClass('selected');
			//$(this).css("backgroundPosition", "5px -54px" );
		
		}
	});


	$("#planit_container .options ul li").live({
		
        mouseenter:
           function()
           {  
 			  // $(this).css("backgroundPosition", "5px -25px" );
           },
        mouseleave:
           function()
           {
			   if ($(this).hasClass('selected')) {
			  // $(this).css("backgroundPosition", "5px -54px" );
			   }else{ // $(this).css("backgroundPosition", "5px 7px" );
			}
			   
           }
	
       }
    );
	

	/* ///////////////////////////  */
	/*		FLOORPLAN				*/
	/* ///////////////////////////  */
	

	  /* SET POSITION */
	  function setWidths(){

		   //height offet 
	 	 var imageheight = $('#image_floorplan').height();
	 	 var containerHeight = $('#planit_container #planit_floorplan_display').height();
		 var heightOffSet = ((containerHeight - imageheight) / 2) + 35;
	
		  
		 //width offet 
	 	 var imagewidth = $('#image_floorplan').width();
	 	 var containerWidth = $('#planit_container #planit_floorplan_display').width();
		 var widthOffSet = (containerWidth - imagewidth) / 2;
		 

		 if(imagewidth >containerWidth){
		 
			$('#planit_container img#image_floorplan, img#image_screens, img#image_dimensions, img#image_power, img#image_fire, img#image_compass').css("width",containerWidth-30)
			
			$('#planit_container img#image_floorplan, img#image_screens, img#image_dimensions, img#image_power, img#image_fire, img#image_compass').css("left",15)
			
			$('#planit_container img#image_floorplan, img#image_screens, img#image_dimensions, img#image_power, img#image_fire, img#image_compass').css("height","auto")
			
			$('#planit_container img#image_floorplan, img#image_screens, img#image_dimensions, img#image_power, img#image_fire, img#image_compass').css("top",heightOffSet)
		 
		 }else{

			 $('#planit_container img#image_floorplan, img#image_screens, img#image_dimensions, img#image_power, img#image_fire, img#image_compass').css("left",widthOffSet)
			 
			 $('#planit_container img#image_floorplan, img#image_screens, img#image_dimensions, img#image_power, img#image_fire, img#image_compass').css("top",55)

		 }
		 
	     setTimeout( function() {
			  	 $('#planit_container img#image_floorplan, #planit_container img#image_compass,').fadeIn(400);
		 	}, 200 );
	    
		 
	   //setup lightbox properties	 
		 
	   if(imageheight > imagewidth){
		   
			 var $floorplanWidth = "450";
			
		 }else{
			 
	 		 var $floorplanWidth = "850";
		}
			 
	   var $floorplanHeight = ($floorplanWidth * (imageheight / imagewidth ) ) + 20;	
	   
	   $('#lightbox').css("height", $floorplanHeight+"px");
	   $('#lightbox').css("width", $floorplanWidth+"px");
	   
	   $('#lightbox_main_image').width($floorplanWidth+"px");
	   $('#lightbox_compass').width($floorplanWidth+"px");
	   $('#lightbox_power').width($floorplanWidth+"px");
	   $('#lightbox_fire').width($floorplanWidth+"px");
	   $('.fancybox-skin').width($floorplanWidth+"px");

	  }
	  
	  
	   
	  $("#plan_button").live("click", function(){
		  
		  
		   // Hide Gallery Panel
		   $('#gallery_display').hide();
		  
		   $('#planit_left_gallery').animate({
			 marginLeft: '-=200px'
		   }, {
			duration: 300
		   })
		  
		   //Hide Virtual Tour
		   $('#panaround_virtual_tour').html('');
		   $('#html5_tour').html('');
		   $('#html5_tour').hide();
		   
		  
		  //Buttons
		  $('#gallery_button').show();
		  $('#plan_button').hide();
		  $('#tour_button').show();
		  
		  $('#planit_left').animate({
			 marginLeft: '-200px'
		   }, {
			duration: 0
		   })
	
		  //Animations
		  $('#planit_right_footer').animate({
			 //width: $tourWidth-185
		   }, {
			duration: 180
		   });
	
		   setTimeout( function() {
			showPlan();
		   }, 250 );

	});

	
	function showPlan() {
		
	  $('#tour_button').show();
	  $('#plan_button').hide();
	  $('#lightwindow').show();
	  $('#single_image').show();
	  $('#enlarge_button').show();
	 // 
		
	  $('#compass').fadeIn();
	  $('#logo').fadeIn();
	  // Show Plan Panels
      $('#planit_left').show();
	  
	  
	  $('#planit_floorplan_display').show();

	  $('#image_floorplan').hide();
	  $('#image_dimensions').hide();
	  $('#image_power').hide();
	  

	  $("#planit_left").animate({
		  marginLeft: '0px'
		},{duration: 300})
		.promise().done(function(){
		
		
			   setTimeout( function() {
				   
			    	$('#image_floorplan').fadeIn(300);
					
					if ($("#power").hasClass('selected')) {
		
						 $("#image_power").fadeIn(300);

					}else if ($("#dimensions").hasClass('selected')) {
		
						 $("#image_dimensions").fadeIn(300);

					}
					
		 		}, 500 );

		});
		
	   
	}
	

	/* ///////////////////////////  */
	/*		VIRTUAL TOUR			*/
	/* ///////////////////////////  */
	
	$("#tour_button").live("click", function(){
		
	  $('#compass').hide();
	  $('#logo').hide();
	  
	  $('#planit_floorplan_display').hide();
	  $('#image_floorplan').hide();
	  
	  $('#enlarge_button').hide();
	  
	  $('#planit_left').animate({
		 marginLeft: '-=184px'
	   }, {
		duration: 200
	   })
	   
	   setTimeout( function() {
		initTour()
	   }, 130 );

	});
	
	function initTour() {
		
	   $('#planit_left').hide();
	   $('#planit_left_gallery').hide();
	   $('#gallery_display').hide();
	   $('#lightwindow').hide();
	   $('#single_image').hide();
	   $('#image_floorplan').hide();
	   $('#gallery_button').show();
		
	   $('#panaround_virtual_tour').fadeIn();
		
	   $('#planit_right_footer').animate({
		 //width: $tourWidth
	   }, {
		duration: 380
	   });
	   
	   setTimeout( function() {
		loadTour()
	   }, 250 );
	   
	 }
	  
	function loadTour() {
		 
	  $('#tour_button').hide();
	  $('#plan_button').show();
	  $('#html5_tour').hide();
	  
	  <!-- FLASH -->

	  if (DetectFlashVer(9,0,0)) {
		  
		  var so = new SWFObject(options.basepath+"/rooms/"+options.roomName+"/tour/desktop/swf/pano.swf", "pano", "100%", "100%", "9", "#FFFFFF"); 
	  	  so.addParam("base",options.basepath+"/rooms/"+options.roomName+"/tour/desktop/");
		  so.addVariable("xml_file","xml/pano.xml");    
		  so.addParam("allowFullScreen","true");
		  so.addParam("allowScriptAccess","sameDomain"); 
		  so.write("panaround_virtual_tour"); 
		  
	
	  <!-- IOS-->
	   
	  }else{
	  	
	    $('#panaround_virtual_tour').hide();

		 setTimeout( function() {
		
			  $('#html5_tour').css("width","100%");
			  $('#html5_tour').css("height","100%")
			  
			  embedpano({xml:"planit/rooms/"+options.roomName+"/tour/ios/panos/p1/single.xml",target:"html5_tour",html5:"auto",passQueryParameters:true});
				
			  setTimeout( function() {
			 	 $('#html5_tour').fadeIn(300);
			  }, 200 );

		}, 200 );
		
		
		
  	  }
	 
	}
 
  };	
 

///////////////
	// HELPERS
 	////////////////////
 
	// Live -> ON
	jQuery.fn.extend({
	  live: function( types, data, fn ) {
			  if( window.console && console.warn ) {
			   //console.warn( "jQuery.live is deprecated. Use jQuery.on instead." );
			  }
	
			  jQuery( this.context ).on( types, this.selector, data, fn );
			  return this;
			}
	});
	 

})(jQuery);