/*!
 * Planit - jQuery Plugin
 * Version: 3.5
 * @requires jQuery v1.6 or later
 *
 * Copyright 2015 Panaround - enquiries@panaround.co.uk
 *
 */
(function($) {

	"use strict";

	$.fn.planit = function(options) {

		var defaults = {
				basepath: 'http://conwayhall.org.uk/wp-content/themes/conwayhall/planit/',
				roomName: 'room-name',
				userAgentDetection: false,
				userAgentIsMobile: false,
				mobileBreakpoint: 750
			},
			floorplanHeight,
			currentLayout,
			currentContext = 'plan',
			previousContext = 'plan',
			config = {layouts:[],settings:{},gallery:[]},
			imgUrls = [],
			selectedGalleryImage = {},
			views = 1,
			$container = $(this);

		var settings = $.extend( true, {}, defaults, options );
		var isMobile = checkIfMobile(settings);

		$(function() {
			loadConfig(function() {
				preloadImages(imgUrls, function() {
					appendToHead(function() {
						initFB();
						render(function() {
							initCarousel();
							initSwipe();
							initScrollbars();
							checkIfMobile(settings);
							if ($('#planit').width() >= 500) {
								$('#planit').removeClass('menu_hidden');
								$('#menu_toggle').removeClass('active');
								smoothTransition();
							}
						});
					});
				});
			});
		});

		/*===============*\
		||  LOAD CONFIG  ||
		\*===============*/

		function loadConfig(callback) {
			var xmlPath = settings.basepath + '/rooms/' + settings.roomName + '/xml/config.xml';

			$.get(xmlPath, function(xmldata) {

				$(xmldata).find('layout').each(function() {
					var layout = {
						layout: $(this).attr('title'),
						capacity: $(this).find('capacity').text()
					};

					config.layouts.push(layout);
					imgUrls.push(settings.basepath + '/rooms/' + settings.roomName + '/floorplans/' + $(this).attr("title") + '.' + $(xmldata).find('layoutFileType').text());

					if (currentLayout === undefined) currentLayout = $(this).attr("title");
				});

				config.settings.planTitle = $(xmldata).find('planTitle').text();
				config.settings.layoutFileType = $(xmldata).find('layoutFileType').text();
				config.settings.showVirtualTour = ($(xmldata).find('showVirtualTour').text() === "true");
				config.settings.showGallery = ($(xmldata).find('showGallery').text() === "true");
				config.settings.showOptions = ($(xmldata).find('showOptions').text() === "true");
				config.settings.showEnquiry = ($(xmldata).find('showEnquiry').text() === "true");
				if ($(xmldata).find('showEnquiry').text() === "true") config.settings.enquiryEmailAddress = $(xmldata).find('enquiryEmailAddress').text();
				config.settings.primaryColour = $(xmldata).find('primaryColour').text();
				config.settings.secondaryColour = $(xmldata).find('secondaryColour').text();
				config.settings.options = [];
				config.settings.gallery = [];

				if (config.settings.showVirtualTour) views += 1;
				if (config.settings.showGallery) views += 1;

				// options
				$(xmldata).find('option').each(function() {
					if ($(this).text() === "true") {
						config.settings.options.push({
							option: $(this).attr('title'),
							id: $(this).attr('id'),
							name: $(this).data('name')
						});
					}
				});

				// gallery
				$(xmldata).find('image').each(function() {
					config.settings.gallery.push({
						title: $(this).attr('title'),
						filename: $(this).text(),
					});
					if (selectedGalleryImage.title === undefined) selectedGalleryImage.title = $(this).attr('title');
				});

				selectedGalleryImage.number = 1;
				settings = $.extend( true, {}, settings, config.settings );

				if (typeof callback === "function") {
					callback();
				}
			});
		}

		/*==================*\
		||  PRELOAD IMAGES  ||
		\*==================*/

		function preloadImages(imgUrls, callback) {
			var i,
				j,
				loaded = 0;

			for (i = 0, j = imgUrls.length; i < j; i++) {
				(function (img, src) {
					img.onload = function () {
						if (++loaded == imgUrls.length && (typeof callback === "function")) {
							callback();
						}
					};
					img.src = src;
				} (new Image(), imgUrls[i]));
			}
		}

		/*======================================*\
		||  ADD FILE DEPENDENCIES TO PAGE HEAD  ||
		\*======================================*/

		function appendToHead(callback) {
			var headLayout = '';
			var scripts = ['jquery.printarea.min.js','jquery.fancybox.min.js','flash-detection.min.js','swfobject.min.js','jquery.mCustomScrollbar.min.js','jquery.touchSwipe.min.js','jquery.jcarousel.min.js','jquery.tooltip.min.js','tour.min.js'];

			for (var i = scripts.length - 1; i >= 0; i--) {
				headLayout += '<script type="text/javascript" src="' + settings.basepath + '/global/js/' + scripts[i] + '"></script>';
			}

			headLayout += '<link rel="stylesheet" type="text/css" href="' + settings.basepath + '/global/lightwindow/jquery.fancybox.min.css" media="screen" />';
			headLayout += '<link rel="stylesheet" type="text/css" href="' + settings.basepath + '/global/css/style.css" media="screen" />';
			headLayout += '<link rel="stylesheet" type="text/css" href="' + settings.basepath + '/global/css/skin.css" media="screen"  />';
			headLayout += '<link rel="stylesheet" type="text/css" href="' + settings.basepath + '/global/css/jquery.mCustomScrollbar.min.css" media="screen"  />';
			headLayout += '<link rel="stylesheet" type="text/css" href="' + settings.basepath + '/global/css/print.min.css" media="print" />';
			$('head').append(headLayout);

			if (typeof callback === "function") {
				callback();
			}
		}

		/*============================*\
		||  COMPONENTS TO INITIALISE  ||
		\*============================*/

		function initFB() {
			$('.fancybox').fancybox({
				'scrolling': 'no'
			});
		}

		function initCarousel() {
			$('#mycarousel').jcarousel({
				auto: true,
				vertical: true,
				scroll: 1,
				wrap: 'last',
				itemFallbackDimension: 105
			});
			$('.jcarousel-container-vertical').outerHeight($('#planit').height()-80);
		}

		function initSwipe() {
			$("#gallery_display").swipe( {
				swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
					swipeHandler(event, direction, distance, duration, fingerCount, fingerData);
				},
				threshold:0
			});
		}

		function initScrollbars() {
			$(".jcarousel-container-vertical").mCustomScrollbar({
				scrollButtons:{enable:false},
				scrollbarPosition:"outside"
			});
		}

		/*==========*\
		||  RENDER  ||
		\*==========*/

		function render(callback) {
			$container.append(
				$('<div>').attr('id', 'planit_container').append(
					getGallery(),
					getPlanitLeft(),
					getPlanitRight()
				),
				getLightbox()
			);

			// check to see if dom has loaded required parts of page, hide preloader after successful detection
			var poller = window.setInterval(function(){
				var detected = document.getElementById('marker');
				if (detected) {
					window.clearInterval(poller);
					$(detected).remove();
					$('#preloader').hide();
					setImagePosition();
					if (typeof callback === "function") {
						callback();
					}
				}
			}, 100);
		}

		/*===========================*\
		||  UPDATE WINDOW ON RESIZE  ||
		\*===========================*/

		$(window).resize(function() {
			isMobile = checkIfMobile(settings);
			if (currentContext == 'plan') setImagePosition();
			if (currentContext == 'gallery') {
				resizeGalleryImage(null, $("#gallery_display img"));
				$('.jcarousel-container-vertical').outerHeight($('#planit').height()-80);
			}
			if ($('#planit').width() < 500) {
				if (!$('#planit').hasClass('menu_hidden')) {
					$('#menu_toggle').fadeOut(function() {
						$(this).addClass('active');
					});
					$('#planit').addClass('menu_hidden');
					smoothTransition();
				}
			} else if ($('#menu_toggle').is(':hidden')) {
				$('#menu_toggle').fadeIn();
				$('#planit').removeClass('menu_hidden');
				smoothTransition();
			}
		});

		/*=====================*\
		||  CONSTITUENT PARTS  ||
		\*=====================*/

		function getPlanitLeft() {

			var capacities	= $('<ul>').attr('id', 'capacities'),
				node;

			$.each(config.layouts, function( index, entry ) {
				node = $('<li data-current-layout="' + entry.layout + '">' + prettyPrint(entry.layout) + '<span>' + entry.capacity + '</span></li>');
				if (entry.layout == currentLayout) {
					node.addClass('selected');
				}
				capacities.append(node);
			});

			var pLeft = '<div id="planit_left"><div class="planit_left_col capacities round"><div class="title round">Layouts & Capacities</div>' +
					capacities.prop('outerHTML') + '</div>';

			if (settings.showOptions) {
				pLeft += '<div class="planit_left_col options round"><div class="title round">Options</div><ul>';

				var counter;
				$.each(settings.options, function(key, value) {
					if (counter === undefined) counter = key;
					if (counter % 2 === 0) pLeft += ' <li>';
					pLeft += '<a id="' + value.id + '" href="#" data-alt="' + value.id + '_mob"><div><i class="icon-' + value.id + '"></i></div><span>' + value.name + '</span></a>';
					counter += 1;
					if (counter % 2 === 0) pLeft += ' </li>';
				});

				if (settings.showEnquiry === true) pLeft += '<li><a class="enquire" style="background:' + settings.secondaryColour + '" href="mailto:' + settings.enquiryEmailAddress + '"><span>Enquire about this room</span></a></li>';

				pLeft += '</ul></div>';
			}

			pLeft += '</div>';

			return pLeft;
		}

		function getPlanitRight() {

			var layouts	= $('<select>').attr('id', 'layouts-select'),
				capacity,
				node;

			$.each(config.layouts, function( index, entry ) {
				node = $('<option value="' + entry.layout + '" data-capacity="' + entry.capacity + '">' + prettyPrint(entry.layout) + '</option>');
				layouts.append(node);
				if (index === 0) capacity = entry.capacity;
			});

			var mobileTopNav = '<div id="top-bar-mobile"><div id="floorplan_title_mobile">' + settings.planTitle + '</div>' +
							   '<div id="mobile_room_select">' + // plan
							   '<div><div>Room Layout Style</div><div class="left">Capacity</div></div>' +
							   '<div><div>' + layouts.prop('outerHTML') + '</div><div><span class="capacity">' + capacity + '</span></div></div></div>';

			if (settings.showGallery === true) {
				mobileTopNav += '<div id="mobile_gallery">' + // gallery
							    '<div><div>Gallery</div></div>' +
							    '<div><div id="current-image-title">' + settings.gallery[0].title + '</div><div><span class="current-image">1</span> of ' + settings.gallery.length + '</div></div></div>';
			}

			mobileTopNav += '<div id="mobile_virtual_tour"><div>Virtual Tour</div></div></div>'; // tour

			var pRight = '<div id="planit_right"><div id="main_content_panel"><div id="preloader"><div></div></div>' +
					   	 mobileTopNav +
					   	 '<div id="plan_info"><a href="#" id="menu_toggle" class="active"><span></span></a><div id="floorplan_title">' + settings.planTitle + '</div></div>' +
					   	 '<div id="gallery_display"></div>' +
					   	 '<div id="panaround_virtual_tour"><div id="html5_tour"></div></div><div id="planit_floorplan_display">' +
					   	 '<img id="image_floorplan_base" src="' + settings.basepath + '/rooms/' + settings.roomName + '/floorplans/base.jpg" />' +
					   	 '<img id="current_layer" src="' + settings.basepath + '/rooms/' + settings.roomName + '/floorplans/' + currentLayout + '.' + settings.layoutFileType + '" /><div id="marker"></div>';

			// Overlay images
			$.each(settings.options, function(key, value) {
				pRight += '<img id="image_' + value.id + '" class="overlays" src ="' + settings.basepath + '/rooms/' + settings.roomName + '/floorplans/' + value.id + '.svg" />';
			});

			pRight += '</div><div id="swipe-message"><img src="' + settings.basepath + '/global/img/swipe.svg">Swipe left & right to view</div>' +
					  '<div id="planit_right_footer" class="' + prettyPrint(views) + '">';

			if (settings.showOptions) {
				pRight += '<div id="mobile_options">';
				if (settings.options.length > 0) pRight += '<div class="header">Options</div>';

				var counter;
				$.each(settings.options, function(key, value) {
					if (counter === undefined) counter = key;
					pRight += '<a id="' + value.id + '_mob" href="#" class="button options mob ' + prettyPrint(settings.options.length) + '" data-alt="' + value.id + '"><span><i class="icon-' + value.id + '"></i></span>' + value.name + '</a>';
				});

				pRight += '</div>';
			}

			if (settings.showVirtualTour === true) pRight += '<a class="button context_switch" style="background:' + settings.secondaryColour + '" data-context="tour" id="tour_button"><span><i class="icon-tour"></i></span>Virtual Tour</a>';
			pRight += '<a class="button context_switch" style="background:' + settings.secondaryColour + '" data-context="plan" id="plan_button"><span><i class="icon-plan"></i></span>Floor Plan</a>';
			if (settings.showGallery === true) pRight += '<a class="button context_switch" style="background:' + settings.secondaryColour + '" data-context="gallery" id="gallery_button"><span><i class="icon-gallery"></i></span>Gallery</a>';
			pRight += '<a class="fancybox button" style="background:' + settings.secondaryColour + '" id="enlarge_button" href="#lightbox" onclick="javascript:setTimeout(function(){$(window).resize();},250)"><span><i class="icon-enlarge"></i></span>Enlarge</a>';
			if (settings.showEnquiry === true) pRight += '<a class="enquire button" style="background:' + settings.secondaryColour + '" href="mailto:' + settings.enquiryEmailAddress + '">Enquire about this room</a>';
			pRight += '<a href="http://www.panaround.co.uk" target="_blank"><img id="logo" src="' + settings.basepath + '/global/img/planit-logo.png" alt=""/></a></div></div></div>';

			return pRight;
		}

		function getLightbox() {
			var lightbox = '<div id="lightbox" style="position:relative;height:'+floorplanHeight+';">' +
						   '<img id="lightbox_main_image" src="' + settings.basepath + '/rooms/' + settings.roomName + '/floorplans/base.jpg" style="width: 100%; position: relative" />' +
						   '<img id="lightbox_current_layer" src="' + settings.basepath + '/rooms/' + settings.roomName + '/floorplans/' + currentLayout + '.' + settings.layoutFileType + '" style="position:absolute; left:0; top: 0; z-index:2;" />';

			$.each(settings.options, function(key, value) {
				lightbox += '<img id="lightbox_' + value.id + '" src ="' + settings.basepath + '/rooms/' + settings.roomName + '/floorplans/' + value.id + '.' + settings.layoutFileType + '" style="position:absolute; display:none; left:0; top: 0; z-index:3;" />';
			});

			lightbox += '<a href="#" class="print" rel="lightbox" style="background:' + settings.secondaryColour + '">Print</a></div>';

			return lightbox;
		}

		function getGallery() {
			var gallery = '<div id="planit_left_gallery" class="hide"><div class="planit_left_col_gallery gallery round"><div class="title round">Gallery</div>';
				gallery += '<div id="secondary_title"><span>' + selectedGalleryImage.title + '</span><div id="current_gallery_image"><span class="current-image">1</span> of ' + settings.gallery.length + '</div></div><ul id="mycarousel" class="jcarousel jcarousel-skin">';

			$.each(settings.gallery, function(key, value) {
				if (key % 2 === 0) gallery += ' <li>';
				gallery += '<a href="' + settings.basepath + '/rooms/' + settings.roomName + '/gallery/main/' + value.filename + '" data-current-gallery-image="' + (key+1) + '"><img title="' + value.title + '" class="left" src="' + settings.basepath + '/rooms/' + settings.roomName + '/gallery/thumbs/' + value.filename + '" width="70" height="70" style="' + (key === 0 ? "opacity:0.5" : "") + '" alt="" /></a>';
				if (key % 2 !== 0) gallery += ' </li>';
			});

			gallery += '</ul></div>';

			if (settings.showEnquiry === true) gallery += '<ul id="gallery_enquire"><li><a class="enquire" style="' + settings.secondaryColour + '" href="mailto:' + settings.enquiryEmailAddress + '"><span>Enquire about this room</span></a></li></ul>';

			gallery += '</div>';

			return gallery;
		}


		/*==================*\
		||	LAYOUT ACTIONS  ||
		\*==================*/

		function setLayout(layout) {

			var src = settings.basepath + "/rooms/" + settings.roomName + "/floorplans/" + layout + "." + settings.layoutFileType;

			if ($('#current_layer').attr('src') !== src) {

				var str = navigator.userAgent;

				if (str.match("Safari") && str.match("OS X")) {
					var replacementImage = '<img id="current_layer" src="' + src +
										   '" style="width: ' + $('#image_floorplan_base').width() +
										   'px; height: ' + $('#image_floorplan_base').height() + 'px; left: ' +
										   $('#image_floorplan_base').css('left') + '; top: ' +
										   $('#image_floorplan_base').css('top') + ';" />';

					$('#current_layer').remove();
					$(replacementImage).insertAfter($('#image_floorplan_base'));

				} else {
					$('#current_layer').attr('src', src);
				}

				$('#lightbox_current_layer').attr('src', src);
			}
		}

		$("ul#capacities li").live({
			mouseenter: function() {
				setLayout($(this).data('current-layout'));
			},
			mouseleave: function() {
				setLayout(currentLayout);
			},
			click: function(e) {
				e.preventDefault();
				$("ul#capacities li").removeClass('selected');
				currentLayout = $(this).data('current-layout');
				setLayout(currentLayout);
				$(this).addClass('selected');
				$("a#single_image").attr('href', settings.basepath + '/rooms/' + settings.roomName + '/floorplans/' + currentLayout + '.' + settings.layoutFileType);
			}
		});

		$('select[id="layouts-select"]').live('change', function() {
			setLayout($(this).val());
			$('span.capacity').html($(this).find(":selected").data('capacity'));
		});

		/*=====================*\
		||  OPTIONS SELECTION  ||
		\*=====================*/

		$("#planit_container .options ul li a:not(.enquire), #mobile_options a:not(.enquire)").on('click', function(e) {
			e.preventDefault();
			var id = $(this).hasClass('mob') ? $(this).data('alt') : $(this).attr('id');

			var $currentItem = $('#image_' + id);
			var $currentLightbox = $('#lightbox_' + id);
			$currentItem.toggle();
			$currentLightbox.toggle();
			$(this).toggleClass('selected');
			$('#' + $(this).data('alt')).toggleClass('selected');
			console.log($currentItem);
		});

		$("#planit_container .options ul li a").on({
			mouseenter: function() {
				$(this).addClass('hovered');
			},
			mouseleave: function() {
				$(this).removeClass('hovered');
			}
		});

		/*===================*\
		||  POSITION IMAGES  ||
		\*===================*/

		function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {
			var ratio = Math.min(maxWidth / srcWidth, maxHeight / srcHeight);
			return { width: srcWidth*ratio, height: srcHeight*ratio };
		}

		function setImagePosition() {
			var $imgContainer = $('#planit_container #planit_floorplan_display'),
				$images = $('#planit_container img#image_floorplan_base, #current_layer, img#image_screens, img#image_dimensions, img#image_power, img#image_hdcams, img#image_fire'),
				$lightboxElements = $('#lightbox_main_image, #lightbox_current_layer, #lightbox_screens, #lightbox_power, #lightbox_fire, #lightbox_dimensions, #lightbox_hdcams, .fancybox-skin'),
				imageHeight = $('#image_floorplan_base').height(),
				containerHeight = $imgContainer.height() - 50, // deduct footer height
				imageWidth = $('#image_floorplan_base').width(),
				containerWidth = $imgContainer.width();

			var topOffset = isMobile ? 140 : $('#planit_container #floorplan_title').height()+parseInt($('#planit_container #floorplan_title').css('top'));
			containerHeight = (containerHeight-$('#planit_right_footer').height()-topOffset);

			var sizes = calculateAspectRatioFit(imageWidth, imageHeight, containerWidth-40, containerHeight); // includes padding compensation
			resize(sizes, $images, containerWidth, containerHeight, 0, topOffset);

			var floorplanWidth = $('#lightbox').width();

			$('#lightbox').css("height", $('#lightbox_main_image').height() + "px");
			$lightboxElements.width(floorplanWidth + "px");
		}

		function resize(sizes, image, containerWidth, containerHeight, widthOffSetAdjustment, heightOffSetAdjustment, callback) {
			if (sizes.height > 10 && sizes.width > 10) { // sane limitations

				image.css("width", sizes.width);
				image.css("height", sizes.height);

				var widthOffSet = (containerWidth - sizes.width) / 2;
				image.css("left", widthOffSet+widthOffSetAdjustment);

				var heightOffSet = (containerHeight - sizes.height) / 2;
				image.css("top", heightOffSet+heightOffSetAdjustment);
			}

			if (typeof callback === "function") {
				callback();
			}
		}

		/*====================*\
		||  CONTEXT SWITCHER  ||
		\*====================*/

		$('.context_switch').live("click", function() {
			previousContext = currentContext;
			currentContext = $(this).data('context');
			$('#planit_right_footer').removeClass('one two three');
			switch(currentContext) {
				case 'plan':
					showPlan();
					break;
				case 'tour':
					showTour();
					break;
				case 'gallery':
					showGallery();
					break;
			}
		});

		/*================*\
		||  MENU CONTROL  ||
		\*================*/

		function hideMenu(type, callback) {

			if (type == 'plan') $('#planit_left').addClass('hide');
			if (type == 'gallery') $('#planit_left_gallery').addClass('hide');
			if (currentContext == 'tour') $('#planit_right').addClass('full');

			if(!isMobile) {
				setTimeout(function() {
					if (typeof callback === "function") {
						callback();
					}
				}, 1000);
			} else {
				if (typeof callback === "function") {
					callback();
				}
			}
		}

		function showMenu(type, callback) {
			if (type == 'plan') $('#planit_left').removeClass('hide');
			if (type == 'gallery') $('#planit_left_gallery').removeClass('hide');
			$('#planit_right').removeClass('full');

			if(!isMobile) {
				setTimeout(function() {
					if (typeof callback === "function") {
						callback();
					}
				}, 1000);
			} else {
				if (typeof callback === "function") {
					callback();
				}
			}
		}

		/*=============*\
		||  FLOORPLAN  ||
		\*=============*/

		function hidePlan(callback) {
			$('#planit_floorplan_display').animate({opacity:0},450);
			$('#enlarge_button').hide();
			$('#lightwindow').hide();
			$('#plan_button').show();
			$('#mobile_room_select').hide();
			$('#mobile_options').hide();
			hideMenu('plan', function() {
				$('#image_floorplan_base').hide();
				$('#planit_floorplan_display').hide();
				if (typeof callback === "function") {
					callback();
				}
			});
		}

		function showPlan() {
			$('#enlarge_button').show();
			$('#mobile_room_select').show();
			if (isMobile) $('#mobile_options').show();
			$('#plan_button').hide();
			$('#planit_right_footer').addClass(prettyPrint(views));
			if (previousContext == 'tour') hideTour(function() { showPlanComplete(); });
			if (previousContext == 'gallery') hideGallery(function() { showPlanComplete(); });
		}

		function showPlanComplete() {
			$('#panaround_virtual_tour').hide();
			$('#planit_floorplan_display').show();
			showMenu('plan', function() {
				$('#planit_floorplan_display').animate({opacity:1},450);
				$('#image_floorplan_base').show();
				$('#lightwindow').show();
				setImagePosition();
			});
		}

		/*================*\
		||  VIRTUAL TOUR  ||
		\*================*/

		function showTour() {
			$('#tour_button').hide();
			$('#html5_tour').hide();
			$('#planit_right_footer').addClass(prettyPrint(views-1));
			$('#mobile_virtual_tour').show();
			if (previousContext == 'gallery') hideGallery(function() { showTourComplete(); });
			if (previousContext == 'plan') hidePlan(function() { showTourComplete(); });
		}

		function showTourComplete() {
			$('#panaround_virtual_tour').css({opacity: 1});
			$('#panaround_virtual_tour').fadeIn(function() {
				setTimeout(function() {
					$('#html5_tour').css("width", "100%");
					$('#html5_tour').css("height", "100%");

					embedpano({
						swf:settings.basepath + "/global/js/tour.swf",
						xml: settings.basepath + "/rooms/" + settings.roomName + "/tour/tour.xml",
						target: "html5_tour",
						html5: "auto",
						passQueryParameters: true
					});

					setTimeout(function() {
						$('#html5_tour').fadeIn(300);
					}, 200);
				}, 200);
			});
		}

		function hideTour(callback) {
			$('#panaround_virtual_tour').css({opacity: 0});
			$('#html5_tour').html('').hide();
			$('#mobile_virtual_tour').hide();
			$('#tour_button').show();
			if (typeof callback === "function") {
				callback();
			}
		}

		/*===========*\
		||  GALLERY  ||
		\*===========*/

		function showGallery() {
			$('#gallery_button').hide();
			$('#mobile_gallery').show();
			$('#planit_right_footer').addClass(prettyPrint(views-1));
			if (isMobile) showSwipeMessage();
			if (previousContext == 'tour') hideTour(function() { showGalleryComplete(); });
			if (previousContext == 'plan') hidePlan(function() { showGalleryComplete(); });
		}

		function showGalleryComplete() {
			$('#panaround_virtual_tour').hide();
			$('#gallery_display').show().animate({opacity:1},450);
			$('#planit_left_gallery').show();
			showMenu('gallery', function() {
				if (isMobile) {
					setTimeout(function() { // allow time for the height transition to play out
						setGalleryImage(settings.basepath + '/rooms/' + settings.roomName + '/gallery/main/image-1.jpg');
					},450);
				} else {
					setGalleryImage(settings.basepath + '/rooms/' + settings.roomName + '/gallery/main/image-1.jpg');
				}
			});
		}

		function hideGallery(callback) {
			$('#gallery_button').show();
			$('#mobile_gallery').hide();
			$("#gallery_display img").fadeOut();
			$('#gallery_display').animate({opacity:0},450);
			hideMenu('gallery', function() {
				$(this).hide();
				$('#gallery_display').hide();
				$('#single_image').hide();
				if (typeof callback === "function") {
					callback();
				}
			});
		}

		function setGalleryImage(imgSrc) {
			var oldImg = $("#gallery_display img"),
				img = $("<img />");
			img.attr('src', imgSrc);
			img.unbind("load");
			img.bind("load", function () {
				resizeGalleryImage(this, img, function() {
					oldImg.stop(true).fadeOut(100, function() {
						$(this).remove();
					});
					img.fadeIn(400);
				});
			});
		}

		function resizeGalleryImage(image, $image, callback) {
			var containerWidth = $('#main_content_panel').width()-100;
			var containerHeight =$('#main_content_panel').height()-100-$('#planit_right_footer').height();
			var sizes;

			if (isMobile) containerHeight -= 104;

			if (image!==null) {
				sizes = calculateAspectRatioFit(image.width, image.height, containerWidth, containerHeight);
				$image.hide();
				$("#gallery_display").append($image);
			} else {
				sizes = calculateAspectRatioFit($image.width(), $image.height(), containerWidth, containerHeight);
			}

			var topOffset = isMobile ? 150 : 65;

			resize(sizes, $image, containerWidth, containerHeight, 50, topOffset, function() {
				if (typeof callback === "function") {
					callback();
				}
			});
		}

		$("#mycarousel a").live({
			mouseenter: function() {
				$('#secondary_title > span').html($(this).find('img').attr('title'));
				$('#current_gallery_image .current-image').html($(this).data('current-gallery-image'));
			},
			mouseleave: function() {
				$('#secondary_title > span').html(selectedGalleryImage.title);
				$('#current_gallery_image .current-image').html(selectedGalleryImage.number);
			},
			click: function(e) {
				e.preventDefault();
				selectedGalleryImage.title = $(this).find('img').attr('title');
				selectedGalleryImage.number = $(this).data('current-gallery-image');
				$('#secondary_title > span').html(selectedGalleryImage.title);
				$('#current_gallery_image .current-image').html($(this).data('current-gallery-image'));
				setGalleryImage(this.href);
				$('#mycarousel img').css({opacity: 1});
				$(this).find('img').css({opacity: 0.5});
			}
		});

		$('#menu_toggle').live('click', function(e) {
			e.preventDefault();
			$(this).toggleClass('active');
			$('#planit').toggleClass('menu_hidden');
			smoothTransition();
		});

		/*==============================*\
		||	MOBILE DETECTION & ACTIONS  ||
		\*==============================*/

		function checkIfMobile(settings) {
			var isMobile = settings.userAgentDetection ? settings.userAgentIsMobile : window.innerWidth < settings.mobileBreakpoint;
			if (isMobile && !$('#planit').hasClass('mobile')) {
				$('#planit').addClass('mobile');
				if (currentContext == 'plan') {
					setTimeout(function() {
						if (currentContext == 'plan') $('#planit.mobile #mobile_options').slideDown();
					},1000);
				}
				smoothTransition(function() {
					smoothTransition();
				});
			} else if (!isMobile && $('#planit').hasClass('mobile')) {
				$('#planit').removeClass('mobile');
				$('#planit #mobile_options').hide();
				$('#planit_right_footer').removeClass('absolute');
				smoothTransition();
			}
			return isMobile;
		}

		function smoothTransition(callback) {
			var interval = setInterval(function () {
				setImagePosition();
				resizeGalleryImage(null, $("#gallery_display img"));
			}, 10);
			setTimeout(function() {
				clearInterval(interval);
				if (isMobile) {
					$('#planit_right_footer').addClass('absolute');
				} else {
					$('#planit_right_footer').removeClass('absolute');
				}
				if (typeof callback === "function") {
					callback();
				}
			}, 1000);
		}

		function showSwipeMessage() {
			setTimeout(function() {
				$('#swipe-message').fadeIn(function() {
					setTimeout(function() {
						$('#swipe-message').fadeOut();
					},1500);
				});
			}, 500);
		}

		function swipeHandler(event, direction) {
			if (isMobile) {
				var currentImageArrNumber = parseInt($('span.current-image').html())-1;
				if (direction == 'left') {
					if (settings.gallery.length > (currentImageArrNumber+1)) {
						var nextImage = settings.gallery[currentImageArrNumber+1];
						selectedGalleryImage.title = nextImage.title;
						$('#secondary_title > span').html(selectedGalleryImage.title);
						setGalleryImage(settings.basepath + '/rooms/' + settings.roomName + '/gallery/main/' + nextImage.filename);
						$('span.current-image').html(currentImageArrNumber+2);
						$('#current-image-title').html(nextImage.title);
					}
				}
				if (direction == 'right') {
					if ((currentImageArrNumber-1) >= 0) {
						var previousImage = settings.gallery[currentImageArrNumber-1];
						selectedGalleryImage.title = previousImage.title;
						$('#secondary_title > span').html(selectedGalleryImage.title);
						setGalleryImage(settings.basepath + '/rooms/' + settings.roomName + '/gallery/main/' + previousImage.filename);
						$('span.current-image').html(currentImageArrNumber);
						$('#current-image-title').html(previousImage.title);
					}
				}
			}
		}

	};

	/*=====================*\
	||	DETECT SCRIPT URI  ||
	\*=====================*/

	var scripts = document.getElementsByTagName("script"),
	    scriptPath = scripts[scripts.length-1].src;

	/*==================*\
	||	PRINT FUNCTION  ||
	\*==================*/

	$(function() {
		$(".print").live('click', function() {
			var container = $(this).attr('rel');
			var ua = navigator.userAgent;

			// Javascript Browser Detection - Internet Explorer - test for MSIE x.x; True or False
			if (/MSIE (\d+\.\d+);/.test(ua) || /rv:11.0/i.test(ua)) {
				var divToPrint = document.getElementById(container);
				var newWin = window.open();
				newWin.document.write(divToPrint.innerHTML);
				newWin.document.close();
				newWin.focus();
				newWin.print();
				newWin.close();
			} else {
				$('#' + container).printArea();
				return false;

			}
		});
	});

	/*================*\
	||  PRETTY PRINT  ||
	\*================*/

	function prettyPrint(input) {
		switch(input) {
			case 'ushape':
				input = 'U Shape';
				break;
			case 1:
				input = 'one';
				break;
			case 2:
				input = 'two';
				break;
			case 3:
				input = 'three';
				break;
			case 4:
				input = 'four';
				break;
			default:
				break;
		}
		return input;
	}

	/*===========*\
	||  HELPERS  ||
	\*===========*/

	// Live -> ON
	$.fn.extend({
		live: function(types, data, fn) {
			$(this.context).on(types, this.selector, data, fn);
			return this;
		}
	});

	function getCurrentBasePath(url) {
		var a = document.createElement('a');
		a.href = url;
		if (! a.pathname) return url;
		a.pathname = a.pathname.replace(/[^/]*$/, '');
		return a.href;
	}

})($);
