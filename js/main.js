Gumby.init();
$(function() {

	$('#subToggle').on('click', function(e){
		e.preventDefault();
		$('#subBarContent').toggle();
	});
	if (element_exists('#mainhall')){
		 $('#planit').planit({
			basepath: '/wp-content/themes/conwayhall/roomplanner/planit',
			roomName: 'main-hall',
			selectedLayout: 'boardroom',
			pageTitle: 'Main Hall',
			roomDimensions: true,
			power: true,
			tvScreens: true,
			fireEscapes: true,
		 });
	};
	if (element_exists('#brockway')){
		 $('#planit').planit({
			basepath: '/wp-content/themes/conwayhall/roomplanner/planit',
			roomName: 'brockway-room',
						selectedLayout: 'boardroom',
			pageTitle: 'Brockway Room',
			roomDimensions: true,
			power:true,
			tvScreens: true,
			fireEscapes: false,
		 });
	};
	if (element_exists('#artists')){
		 $('#planit').planit({
			basepath: '/wp-content/themes/conwayhall/roomplanner/planit',
			roomName: 'artists-room',
						selectedLayout: 'boardroom',
			pageTitle: "Artists' Room",
			roomDimensions: true,
			power:true,
			tvScreens: false,
			fireEscapes: false,
		 });
	};
	if (element_exists('#foyer')){
		 $('#planit').planit({
			basepath: '/wp-content/themes/conwayhall/roomplanner/planit',
			roomName: 'foyer',
						selectedLayout: 'buffet',
			pageTitle: 'Foyer',
			roomDimensions: true,
			power:true,
			tvScreens: false,
			fireEscapes: false,
		 });
	};
	if (element_exists('#bertrand')){
		 $('#planit').planit({
			basepath: '/wp-content/themes/conwayhall/roomplanner/planit',
			roomName: 'bertrand-russell-room',
						selectedLayout: 'boardroom',
			pageTitle: 'Bertrand Russell Room',
			roomDimensions: true,
			power:true,
			fireEscapes: false,
			tvScreens: false,
		 });
	};
	if (element_exists('#club')){
		 $('#planit').planit({
			basepath: '/wp-content/themes/conwayhall/roomplanner/planit',
			roomName: 'club-room',
						selectedLayout: 'boardroom',
			pageTitle: 'Club Room',
			roomDimensions: true,
			power:true,
			tvScreens: false,
			fireEscapes: true,
		 });
	};
	if (element_exists('#balcony')){
		 $('#planit').planit({
			basepath: '/wp-content/themes/conwayhall/roomplanner/planit',
			roomName: 'balcony',
						selectedLayout: 'theatre',
			pageTitle: 'Balcony',
			roomDimensions: false,
			power:true,
			tvScreens: false,
			fireEscapes: true,
			virtualTour: false,
		 });
	};
	if (element_exists('#artists360')){
		var so = new SWFObject("/wp-content/themes/conwayhall/360tour/artists-room/assets/swf/pano.swf", "pano", "955", "350", "9", "#FFFFFF");
		so.addVariable("xml_file","/wp-content/themes/conwayhall/360tour/artists-room/assets/xml/pano.xml");
		so.addParam("allowFullScreen","true");
		so.addParam("allowScriptAccess","sameDomain");
		so.write("artists360");
	};
	if (element_exists('#bertrand360')){
		var so = new SWFObject("/wp-content/themes/conwayhall/360tour/bertrand-russell/assets/swf/pano.swf", "pano", "955", "350", "9", "#FFFFFF");
		so.addVariable("xml_file","/wp-content/themes/conwayhall/360tour/bertrand-russell/assets/xml/pano.xml");
		so.addParam("allowFullScreen","true");
		so.addParam("allowScriptAccess","sameDomain");
		so.write("bertrand360");
	};
	if (element_exists('#mainhall360')){
		var so = new SWFObject("/wp-content/themes/conwayhall/360tour/main-hall/assets/swf/pano.swf", "pano", "955", "350", "9", "#FFFFFF");
		so.addVariable("xml_file","/wp-content/themes/conwayhall/360tour/main-hall/assets/xml/pano.xml");
		so.addParam("allowFullScreen","true");
		so.addParam("allowScriptAccess","sameDomain");
		so.write("mainhall360");
	};
	if (element_exists('#brockway360')){
		var so = new SWFObject("/wp-content/themes/conwayhall/360tour/brockway-room/assets/swf/pano.swf", "pano", "955", "350", "9", "#FFFFFF");
		so.addVariable("xml_file","/wp-content/themes/conwayhall/360tour/brockway-room/assets/xml/pano.xml");
		so.addParam("allowFullScreen","true");
		so.addParam("allowScriptAccess","sameDomain");
		so.write("brockway360");
	};
	if (element_exists('#clubsquare360')){
		var so = new SWFObject("/wp-content/themes/conwayhall/360tour/club-room-1/assets/swf/pano.swf", "pano", "955", "350", "9", "#FFFFFF");
		so.addVariable("xml_file","/wp-content/themes/conwayhall/360tour/club-room-1/assets/xml/pano.xml");
		so.addParam("allowFullScreen","true");
		so.addParam("allowScriptAccess","sameDomain");
		so.write("clubsquare360");
	};
	if (element_exists('#clubtheatre360')){
		var so = new SWFObject("/wp-content/themes/conwayhall/360tour/club-room-2/assets/swf/pano.swf", "pano", "955", "350", "9", "#FFFFFF");
		so.addVariable("xml_file","/wp-content/themes/conwayhall/360tour/club-room-2/assets/xml/pano.xml");
		so.addParam("allowFullScreen","true");
		so.addParam("allowScriptAccess","sameDomain");
		so.write("clubtheatre360");
	};
	if (element_exists('#foyer360')){
		var so = new SWFObject("/wp-content/themes/conwayhall/360tour/foyer-1/assets/swf/pano.swf", "pano", "955", "350", "9", "#FFFFFF");
		so.addVariable("xml_file","/wp-content/themes/conwayhall/360tour/foyer-1/assets/xml/pano.xml");
		so.addParam("allowFullScreen","true");
		so.addParam("allowScriptAccess","sameDomain");
		so.write("foyer360");
	};
	if (element_exists('#foyeropen360')){
		var so = new SWFObject("/wp-content/themes/conwayhall/360tour/foyer-2/assets/swf/pano.swf", "pano", "955", "350", "9", "#FFFFFF");
		so.addVariable("xml_file","/wp-content/themes/conwayhall/360tour/foyer-2/assets/xml/pano.xml");
		so.addParam("allowFullScreen","true");
		so.addParam("allowScriptAccess","sameDomain");
		so.write("foyeropen360");
	};
	if (element_exists('#library360')){
		var so = new SWFObject("/wp-content/themes/conwayhall/360tour/library/assets/swf/pano.swf", "pano", "955", "350", "9", "#FFFFFF");
		so.addVariable("xml_file","/wp-content/themes/conwayhall/360tour/library/assets/xml/pano.xml");
		so.addParam("allowFullScreen","true");
		so.addParam("allowScriptAccess","sameDomain");
		so.write("library360");
	};
	$('#pano').sixteenbynine();
	$("#ch-carousel").owlCarousel({
		items: 1,
		lazyLoad : true,
		navigation : true,
		slideSpeed : 2000,
		paginationSpeed : 800,
		navigationText: ["",""],
		autoPlay: true,
		itemsDesktop: false,
		itemsDesktopSmall: false,
		itemsTablet: false,
		itemsTabletSmall: false,
		itemsMobile: false,
		stopOnHover: true
	});
	$('iframe').sixteenbynine();
	if (element_exists('#bikestation')){
		bikes();
	}
	if (element_exists('#holbornStationC')){
		holBornC();
	}
	if (element_exists('#holbornStationP')){
		holBornP();
	}
	if (element_exists('#chanceryStationC')){
		chanceryL();
	}
	if (element_exists('#russellSqP')){
		russellSq();
	}
	if (element_exists('#busses')){
		busses();
	}
	$('body').on('click', '#holbornStationC .tube-loop', function(e){
		$('#holbornStationC').html('<div id="loading"></div>');
		holBornC();
	});
	$('body').on('click', '#holbornStationP .tube-loop', function(e){
		$('#holbornStationP').html('<div id="loading"></div>');
		holBornP();
	});
	$('body').on('click', '#chanceryStationC .tube-loop', function(e){
		$('#chanceryStationC').html('<div id="loading"></div>');
		chanceryL();
	});
	$('body').on('click', '#russellSqP .tube-loop', function(e){
		$('#russellSqP').html('<div id="loading"></div>');
		russellSq();
	});
	$('body').on('click', '#bikestation .tube-loop', function(e){
		$('#bikestation').html('<div id="loading"></div>');
		bikes();
	});
	var winHeight = $(window).height(),
		docHeight = $(document).height(),
		progressBar = $('progress'),
		max, value;
	/* Set the max scrollable area */
	max = docHeight - winHeight;
	progressBar.attr('max', max);

	$(document).on('scroll', function(){
		value = $(window).scrollTop();
		progressBar.attr('value', value);
	});

	$(progressBar).attr('max', max);

	$(window).on('resize', function() {
		winHeight = $(window).height(),
		docHeight = $(document).height();

		max = docHeight - winHeight;
		progressBar.attr('max', max);

		value =  $(window).scrollTop();
		progressBar.attr('value', value);
	});
});
function bikes() {
	var dock = '/wp-content/themes/conwayhall/php/bikestation.php?dock=003421';
	$.getJSON(dock, function(data){
		var tfl = '';
		$.each(data, function(i,a) {
			$('title').prepend(a.name + ' | ');
			tfl = '<div class="row"><div class="twelve columns stationTitle bike"><h4>'+a.name+' <i class="tube-loop"></i></h4></div></div>';
			tfl += '<div class="row"><div class="four columns"><h5>Available Bikes</h5></div><div class="four columns"><h5>Spaces Available</h5></div><div class="four columns"><h5>Total Spaces</h5></div></div>';
			tfl += '<div class="row">';
			tfl += '<div class="four columns">';
			tfl += '<p>'+a.nbBikes+'</p>';
			tfl += '</div>';
			tfl += '<div class="four columns">';
			tfl += '<p>'+a.nbEmptyDocks+'</p>';
			tfl += '</div>';
			tfl += '<div class="four columns">';
			tfl += '<p>'+a.nbDocks+'</p>';
			tfl += '</div>';
			tfl += '</div>';
			tfl += '<div class="row">';
			tfl += '<div class="twelve columns"><div id="map" data-lat="'+a.lat+'" data-lng="'+a.long+'"></div>';
			tfl += '</div>';
			tfl += '</div>';
		});
		tfl += '</table>';
		$('#bikestation').html(tfl).append('<h6>Data provided by Transport for London and Barclays Cycle Hire <i class="tube-tfl"></i></h6>');
		$('#map').gmap3({
			marker: {
				latLng: [$('#map').data('lat'),$('#map').data('lng')],
				options: {
					icon: '/wp-content/themes/conwayhall/img/bikeMarker.png'
				}
			},
			map: {
				options: {
					center: [$('#map').data('lat'),$('#map').data('lng')],
					zoom: 17,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					mapTypeControl: true
				}
			}
		});
	});
}
function holBornC() {
	var holBornC = '/wp-content/themes/conwayhall/php/PredictionDetailed.php?id=C&station=HOL';
	$.getJSON(holBornC, function(data){
		if(exists(data.LineName)) {
		var lineName = data.LineName,
			stationName = data.S['@attributes'].N.replace('.', ''),
			plat = '<div class="row"><div class="twelve columns stationTitle C"><h4>Central Line <i class="tube-loop"></i></h4></div></div>';
		$.each(data.S.P, function(i,a) {
			plat += '<div class="row"><div class="twelve columns platformholder platform alert info"><h5>'+a['@attributes'].N+'</h5></div></div>';
			if(exists(a.T)){
				$.each(a.T, function(i,b) {
					if(i < 5) {
						if(exists(b.TimeTo)) {
							var mins = (b.TimeTo).replace(':00', ' mins'),
								halfMins = (mins).replace(':30', '&frac12; mins'),
								secs = (halfMins).replace('0 &frac12; mins', '30 secs'),
								amp = (b.Destination).replace(' and ', ' &amp; ');
							if(b.TimeTo == '-') {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>due</p></div></div>';
							} else {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div>';
							}
						} else {
							var mins = (b['@attributes'].TimeTo).replace(':00', ' mins'),
								halfMins = (mins).replace(':30', '&frac12; mins'),
								secs = (halfMins).replace('0 &frac12; mins', '30 secs'),
								amp = (b['@attributes'].Destination).replace(' and ', ' &amp; ');
							if(b['@attributes'].TimeTo == '-') {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
							} else {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
							}
						}
					}
				});
			} else {
				plat += '<div class="row"><div class="twelve columns"><h5>Service closed</h5></div></div>';
			}
		});
		plat += '</div>';
		$('#holbornStationC').html(plat).append('<h6>Data provided by Transport for London <i class="tube-tfl"></i></h6>');
		$('th').on('click', 'i', function(){
			stationSniff(line, station);
		});
		} else {
			var plat = '<div class="row">';
			plat += '<br /><div class="twelve columns platformholder"><div class="panel panel-default"><div class="panel-body"><h2>No data for this station</h2></div></div></div>';
			plat += '</div>';
			$('#station').html(plat).append('<h6>Data provided by Transport for London <i class="tube-tfl"></i></h6>');
		}
	});
	$("#map").gmap3({
		getroute:{
			options:{
				origin:"Conway Hall, 25 Red Lion Square, London, WC1R 4RL",
				destination:"Holborn Station",
				travelMode: google.maps.DirectionsTravelMode.WALKING
			},
			callback: function(results){
				if (!results) return;
				$(this).gmap3({
					map:{
						options:{
							zoom: 13,
							center: [-33.879, 151.235]
						}
					},
					directionsrenderer:{
						container: $(document.createElement("div")).addClass("googlemap").insertAfter($("#map")),
						options:{
							directions:results
						}
					}
				});
			}
		}
	});
}
function chanceryL() {
	var chanceryL = '/wp-content/themes/conwayhall/php/PredictionDetailed.php?id=C&station=CYL';
	$.getJSON(chanceryL, function(data){
		if(exists(data.LineName)) {
		var lineName = data.LineName,
			stationName = data.S['@attributes'].N.replace('.', ''),
			plat = '<div class="row"><div class="twelve columns stationTitle C"><h4>Central Line <i class="tube-loop"></i></h4></div></div>';
		$.each(data.S.P, function(i,a) {
			plat += '<div class="row"><div class="twelve columns platformholder platform alert info"><h5>'+a['@attributes'].N+'</h5></div></div>';
			if(exists(a.T)){
				$.each(a.T, function(i,b) {
					if(i < 5) {
						if(exists(b.TimeTo)) {
							var mins = (b.TimeTo).replace(':00', ' mins'),
								halfMins = (mins).replace(':30', '&frac12; mins'),
								secs = (halfMins).replace('0 &frac12; mins', '30 secs'),
								amp = (b.Destination).replace(' and ', ' &amp; ');
							if(b.TimeTo == '-') {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>due</p></div></div>';
							} else {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div>';
							}
						} else {
							var mins = (b['@attributes'].TimeTo).replace(':00', ' mins'),
								due = (b['@attributes'].TimeTo).replace('-', ' due'),
								halfMins = (mins).replace(':30', '&frac12; mins'),
								secs = (halfMins).replace('0 &frac12; mins', '30 secs'),
								amp = (b['@attributes'].Destination).replace(' and ', ' &amp; ');
							if(b['@attributes'].TimeTo == '-') {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
							} else {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
							}
						}
					}
				});
			} else {
				plat += '<div class="row"><div class="twelve columns"><h5>Service closed</h5></div></div>';
			}
		});
		plat += '</div>';
		$('#chanceryStationC').html(plat).append('<h6>Data provided by Transport for London <i class="tube-tfl"></i></h6>');
		$('th').on('click', 'i', function(){
			stationSniff(line, station);
		});
		} else {
			var plat = '<div class="row">';
			plat += '<br /><div class="twelve columns platformholder"><div class="panel panel-default"><div class="panel-body"><h2>No data for this station</h2></div></div></div>';
			plat += '</div>';
			$('#station').html(plat).append('<h6>Data provided by Transport for London <i class="tube-tfl"></i></h6>');
		}
	});
	$("#map").gmap3({
		getroute:{
			options:{
				origin:"Conway Hall, 25 Red Lion Square, London, WC1R 4RL",
				destination:"Chancery Lane Station",
				travelMode: google.maps.DirectionsTravelMode.WALKING
			},
			callback: function(results){
				if (!results) return;
				$(this).gmap3({
					map:{
						options:{
							zoom: 13,
							center: [-33.879, 151.235]
						}
					},
					directionsrenderer:{
						container: $(document.createElement("div")).addClass("googlemap").insertAfter($("#map")),
						options:{
							directions:results
						}
					}
				});
			}
		}
	});
}
function holBornP() {
	var holBornP = '/wp-content/themes/conwayhall/php/PredictionDetailed.php?id=P&station=HOL';
	$.getJSON(holBornP, function(data){
		if(exists(data.LineName)) {
		var lineName = data.LineName,
			stationName = data.S['@attributes'].N.replace('.', ''),
			plat = '<div class="row"><div class="twelve columns stationTitle P"><h4>Picadilly Line <i class="tube-loop"></i></h4></div></div>';
		$.each(data.S.P, function(i,a) {
			plat += '<div class="row"><div class="twelve columns platformholder platform alert info"><h5>'+a['@attributes'].N+'</h5></div></div>';
			if(exists(a.T)){
				$.each(a.T, function(i,b) {
					if(i < 5) {
						if(exists(b.TimeTo)) {
							var mins = (b.TimeTo).replace(':00', ' mins'),
								halfMins = (mins).replace(':30', '&frac12; mins'),
								secs = (halfMins).replace('0 &frac12; mins', '30 secs'),
								amp = (b.Destination).replace(' and ', ' &amp; ');
							if(b.TimeTo == '-') {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>due</p></div></div>';
							} else {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div>';
							}
						} else {
							var mins = (b['@attributes'].TimeTo).replace(':00', ' mins'),
								halfMins = (mins).replace(':30', '&frac12; mins'),
								secs = (halfMins).replace('0 &frac12; mins', '30 secs'),
								amp = (b['@attributes'].Destination).replace(' and ', ' &amp; ');
							if(b['@attributes'].TimeTo == '-') {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
							} else {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
							}
						}
					}
				});
			} else {
				plat += '<div class="row"><div class="twelve columns"><h5>Service closed</h5></div></div>';
			}
		});
		plat += '</div>';
		$('#holbornStationP').html(plat).append('<h6>Data provided by Transport for London <i class="tube-tfl"></i></h6>');
		$('th').on('click', 'i', function(){
			stationSniff(line, station);
		});
		} else {
			var plat = '<div class="row">';
			plat += '<br /><div class="twelve columns platformholder"><div class="panel panel-default"><div class="panel-body"><h2>No data for this station</h2></div></div></div>';
			plat += '</div>';
			$('#station').html(plat).append('<h6>Data provided by Transport for London <i class="tube-tfl"></i></h6>');
		}
	});
}
function russellSq() {
	var russellSq = '/wp-content/themes/conwayhall/php/PredictionDetailed.php?id=P&station=RSQ';
	$.getJSON(russellSq, function(data){
		if(exists(data.LineName)) {
		var lineName = data.LineName,
			stationName = data.S['@attributes'].N.replace('.', ''),
			plat = '<div class="row"><div class="twelve columns stationTitle P"><h4>Picadilly Line <i class="tube-loop"></i></h4></div></div>';
		$.each(data.S.P, function(i,a) {
			plat += '<div class="row"><div class="twelve columns platformholder platform alert info"><h5>'+a['@attributes'].N+'</h5></div></div>';
			if(exists(a.T)){
				$.each(a.T, function(i,b) {
					if(i < 5) {
						if(exists(b.TimeTo)) {
							var mins = (b.TimeTo).replace(':00', ' mins'),
								halfMins = (mins).replace(':30', '&frac12; mins'),
								secs = (halfMins).replace('0 &frac12; mins', '30 secs'),
								amp = (b.Destination).replace(' and ', ' &amp; ');
							if(b.TimeTo == '-') {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>due</p></div></div>';
							} else {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div>';
							}
						} else {
							var mins = (b['@attributes'].TimeTo).replace(':00', ' mins'),
								halfMins = (mins).replace(':30', '&frac12; mins'),
								secs = (halfMins).replace('0 &frac12; mins', '30 secs'),
								amp = (b['@attributes'].Destination).replace(' and ', ' &amp; ');
							if(b['@attributes'].TimeTo == '-') {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
							} else {
								plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
							}
						}
					}
				});
			} else {
				plat += '<div class="row"><div class="twelve columns"><h5>Service closed</h5></div></div>';
			}
		});
		plat += '</div>';
		$('#russellSqP').html(plat).append('<h6>Data provided by Transport for London <i class="tube-tfl"></i></h6>');
		$('th').on('click', 'i', function(){
			stationSniff(line, station);
		});
		} else {
			var plat = '<div class="row">';
			plat += '<br /><div class="twelve columns platformholder"><div class="panel panel-default"><div class="panel-body"><h2>No data for this station</h2></div></div></div>';
			plat += '</div>';
			$('#station').html(plat).append('<h6>Data provided by Transport for London <i class="tube-tfl"></i></h6>');
		}
	});
	$("#map").gmap3({
		getroute:{
			options:{
				origin:"Conway Hall, 25 Red Lion Square, London, WC1R 4RL",
				destination:"Russell Square Station",
				travelMode: google.maps.DirectionsTravelMode.WALKING
			},
			callback: function(results){
				if (!results) return;
				$(this).gmap3({
					map:{
						options:{
							zoom: 13,
							center: [-33.879, 151.235]
						}
					},
					directionsrenderer:{
						container: $(document.createElement("div")).addClass("googlemap").insertAfter($("#map")),
						options:{
							directions:results
						}
					}
				});
			}
		}
	});
}
function busses() {
	var lat = 51.519532,
		lng = -0.118446;
					//var pos = new google.maps.LatLng(lat, lng);
				var swLat = lat - 0.003,
						swLng = lng - 0.003,
						neLat = lat + 0.003,
						neLng = lng + 0.003,
					stops = '/wp-content/themes/conwayhall/php/bus.php?swLat='+swLat+'&swLng='+swLng+'&neLat='+neLat+'&neLng='+neLng;

	$.getJSON(stops, function(data) {
		$.each(data.markers, function (i, a) {
			$('#map').gmap3({
				marker: {
					latLng: [a.lat, a.lng],
					id: a.id,
					title: a.name,
					events:{
						click: function(marker, event, context) {
							var id = a.id,
								name = a.name,
								towards = a.towards,
								stopID = a.stopIndicator;
							getStop(id, name, towards, stopID);
							$('#busses').html('<div id="loading"></div>');
						}
					},
					options: {
						icon: '/wp-content/themes/conwayhall/img/busMarker.png'
					}
				},
				circle:{
					options:{
						center: [lat, lng],
						radius : 320,
						fillColor : 'rgba(0,139,178,0.05)',
						strokeColor : 'rgba(0,139,178,0.3)'
					}
				},
				map: {
					options: {
						center: [lat, lng],
						zoom: 16,
						mapTypeId: google.maps.MapTypeId.ROADMAP,
						mapTypeControl: true
					}
				}
			});
		});
	});
}
function getStop(id, name, towards, stopID) {
	var stopSearch = '/wp-content/themes/conwayhall/php/busstop.php?stop='+id;
	$.getJSON(stopSearch, function(data) {
		if(data.arrivals != '') {
			var stop = '<div class="row"><div class="twelve columns stationTitle bus"><h4>'+name+' <br /> Towards '+towards+' <br /> Stop '+stopID+'</h4></div></div><div class="row"><div class="two columns"><h5>Route</h5></div><div class="eight columns"><h5>To</h5></div><div class="two columns"><h5>Arrives</h5></div></div>';
			$.each(data.arrivals, function (i, a) {
				if(i < 10) {
					stop += '<div class="row"><div class="two columns">';
					stop += '<p><strong>'+a.routeName+'</strong></p>';
					stop += '</div>';
					stop += '<div class="eight columns">';
					stop += '<p>'+a.destination+'</p>';
					stop += '</div>';
					stop += '<div class="two columns">';
					stop += '<p>'+a.estimatedWait+'</p>';
					stop += '</div></div>';
				}
			});
			if(data.serviceDisruptions.infoMessages.length > 0) {
				stop += '<div class="row"><div class="twelve columns"><div class="alert alert-info">'+data.serviceDisruptions.infoMessages+'</div></div></div>';
			}
			if(data.serviceDisruptions.importantMessages.length > 0) {
				stop += '<div class="row"><div class="twelve columns"><div class="alert alert-success">'+data.serviceDisruptions.importantMessages+'</div></div></div>';
			}
			if(data.serviceDisruptions.criticalMessages.length > 0) {
				stop += '<div class="row"><div class="twelve columns"><div class="alert alert-danger">'+data.serviceDisruptions.criticalMessages+'</div></div></div>';
			}
			stop += '</div>';
			$('#busses').html(stop);
		} else {
			$('#busses').html('<h4>No data currently available for this stop.<br />Please try later</h4>');
		}
	});
}
(function($){
	$.fn.sixteenbynine=function(){
		var width=this.width();
		this.height(width*9/16);
	};
})(jQuery);
(function($,sr){
	var debounce = function (func, threshold, execAsap) {
			var timeout;

			return function debounced () {
					var obj = this, args = arguments;
					function delayed () {
							if (!execAsap)
									func.apply(obj, args);
							timeout = null;
					};
					if (timeout)
							clearTimeout(timeout);
					else if (execAsap)
							func.apply(obj, args);

					timeout = setTimeout(delayed, threshold || 100);
			};
	}
	jQuery.fn[sr] = function(fn){	return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
})(jQuery,'smartresize');
$(window).smartresize(function(){
	$('iframe').sixteenbynine();
});
function getUrlVars() {
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	for(var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}
	return vars;
}
function exists(data) {
	if(!data || data==null || data=='undefined' || typeof(data)=='undefined') return false;
	else return true;
}
function element_exists(id){
	if($(id).length > 0){
		return true;
	}
	return false;
}