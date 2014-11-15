Gumby.init();
$(function() {
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
	$('body').on('click', '.tube-loop', function(e){
		location.reload();
	});
});
function bikes() {
	var dock = '//localhost:8888/conwayhall/wp-content/themes/conwayhall/php/bikestation.php?dock=003421';
	$.getJSON(dock, function(data){
		var tfl = '';
		$.each(data, function(i,a) {
			$('title').prepend(a.name + ' | ');
			tfl = '<div class="row"><div class="twelve columns stationTitle bike"><h4>'+a.name+'</h4></div></div>';
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
					icon: '//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/bikeMarker.png'
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
	var holBornC = '//localhost:8888/conwayhall/wp-content/themes/conwayhall/php/PredictionDetailed.php?id=C&station=HOL';
	$.getJSON(holBornC, function(data){
		if(exists(data.LineName)) {
		var lineName = data.LineName,
			stationName = data.S['@attributes'].N.replace('.', ''),
			plat = '<div class="row"><div class="twelve columns stationTitle C"><h4>Central Line <i class="tube-loop"></i></h4></div></div>';
		$.each(data.S.P, function(i,a) {
			plat += '<div class="row"><div class="twelve columns platformholder platform alert info"><h5>'+a['@attributes'].N+'</h5></div></div>';
			if(exists(a.T)){
				$.each(a.T, function(i,b) {
					if(exists(b.TimeTo)) { 
						var mins = (b.TimeTo).replace(':00', ' mins'),
							halfMins = (mins).replace(':30', ':30 mins'),
							secs = (halfMins).replace('0:30 mins', '30 secs'),
							amp = (b.Destination).replace(' and ', ' &amp; ');
				    	if(b.TimeTo == '-') {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>due</p></div></div>';
				    	} else {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div>';
				    	}
					} else {
						var mins = (b['@attributes'].TimeTo).replace(':00', ' mins'),
							halfMins = (mins).replace(':30', ':30 mins'),
							secs = (halfMins).replace('0:30 mins', '30 secs'),
							amp = (b['@attributes'].Destination).replace(' and ', ' &amp; ');
				    	if(b['@attributes'].TimeTo == '-') {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
				    	} else {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
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
}
function chanceryL() {
	var chanceryL = '//localhost:8888/conwayhall/wp-content/themes/conwayhall/php/PredictionDetailed.php?id=C&station=CYL';
	$.getJSON(chanceryL, function(data){
		if(exists(data.LineName)) {
		var lineName = data.LineName,
			stationName = data.S['@attributes'].N.replace('.', ''),
			plat = '<div class="row"><div class="twelve columns stationTitle C"><h4>Central Line <i class="tube-loop"></i></h4></div></div>';
		$.each(data.S.P, function(i,a) {
			plat += '<div class="row"><div class="twelve columns platformholder platform alert info"><h5>'+a['@attributes'].N+'</h5></div></div>';
			if(exists(a.T)){
				$.each(a.T, function(i,b) {
					if(exists(b.TimeTo)) { 
						var mins = (b.TimeTo).replace(':00', ' mins'),
							halfMins = (mins).replace(':30', ':30 mins'),
							secs = (halfMins).replace('0:30 mins', '30 secs'),
							amp = (b.Destination).replace(' and ', ' &amp; ');
				    	if(b.TimeTo == '-') {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>due</p></div></div>';
				    	} else {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div>';
				    	}
					} else {
						var mins = (b['@attributes'].TimeTo).replace(':00', ' mins'),
							halfMins = (mins).replace(':30', ':30 mins'),
							secs = (halfMins).replace('0:30 mins', '30 secs'),
							amp = (b['@attributes'].Destination).replace(' and ', ' &amp; ');
				    	if(b['@attributes'].TimeTo == '-') {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
				    	} else {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
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
}
function holBornP() {
	var holBornP = '//localhost:8888/conwayhall/wp-content/themes/conwayhall/php/PredictionDetailed.php?id=P&station=HOL';
	$.getJSON(holBornP, function(data){
		if(exists(data.LineName)) {
		var lineName = data.LineName,
			stationName = data.S['@attributes'].N.replace('.', ''),
			plat = '<div class="row"><div class="twelve columns stationTitle P"><h4>Picadilly Line <i class="tube-loop"></i></h4></div></div>';
		$.each(data.S.P, function(i,a) {
			plat += '<div class="row"><div class="twelve columns platformholder platform alert info"><h5>'+a['@attributes'].N+'</h5></div></div>';
			if(exists(a.T)){
				$.each(a.T, function(i,b) {
					if(exists(b.TimeTo)) { 
						var mins = (b.TimeTo).replace(':00', ' mins'),
							halfMins = (mins).replace(':30', ':30 mins'),
							secs = (halfMins).replace('0:30 mins', '30 secs'),
							amp = (b.Destination).replace(' and ', ' &amp; ');
				    	if(b.TimeTo == '-') {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>due</p></div></div>';
				    	} else {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div>';
				    	}
					} else {
						var mins = (b['@attributes'].TimeTo).replace(':00', ' mins'),
							halfMins = (mins).replace(':30', ':30 mins'),
							secs = (halfMins).replace('0:30 mins', '30 secs'),
							amp = (b['@attributes'].Destination).replace(' and ', ' &amp; ');
				    	if(b['@attributes'].TimeTo == '-') {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
				    	} else {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
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
	var russellSq = '//localhost:8888/conwayhall/wp-content/themes/conwayhall/php/PredictionDetailed.php?id=P&station=RSQ';
	$.getJSON(russellSq, function(data){
		if(exists(data.LineName)) {
		var lineName = data.LineName,
			stationName = data.S['@attributes'].N.replace('.', ''),
			plat = '<div class="row"><div class="twelve columns stationTitle P"><h4>Picadilly Line <i class="tube-loop"></i></h4></div></div>';
		$.each(data.S.P, function(i,a) {
			plat += '<div class="row"><div class="twelve columns platformholder platform alert info"><h5>'+a['@attributes'].N+'</h5></div></div>';
			if(exists(a.T)){
				$.each(a.T, function(i,b) {
					if(exists(b.TimeTo)) { 
						var mins = (b.TimeTo).replace(':00', ' mins'),
							halfMins = (mins).replace(':30', ':30 mins'),
							secs = (halfMins).replace('0:30 mins', '30 secs'),
							amp = (b.Destination).replace(' and ', ' &amp; ');
				    	if(b.TimeTo == '-') {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>due</p></div></div>';
				    	} else {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div>';
				    	}
					} else {
						var mins = (b['@attributes'].TimeTo).replace(':00', ' mins'),
							halfMins = (mins).replace(':30', ':30 mins'),
							secs = (halfMins).replace('0:30 mins', '30 secs'),
							amp = (b['@attributes'].Destination).replace(' and ', ' &amp; ');
				    	if(b['@attributes'].TimeTo == '-') {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
				    	} else {
				    		plat += '<div class="row"><div class="stationName nine columns"><p>'+amp+'</p></div> <div class="timeTo three columns"><p>'+secs+'</p></div></div>';
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
}
function busses() {
	var lat = 51.519532,
		lng = -0.118446;
    			//var pos = new google.maps.LatLng(lat, lng);
				var swLat = lat - 0.003,
		    		swLng = lng - 0.003,
		    		neLat = lat + 0.003,
		    		neLng = lng + 0.003,
					stops = '//localhost:8888/conwayhall/wp-content/themes/conwayhall/php/bus.php?swLat='+swLat+'&swLng='+swLng+'&neLat='+neLat+'&neLng='+neLng;
		    	
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
						icon: '//localhost:8888/conwayhall/wp-content/themes/conwayhall/img/busMarker.png'
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
	var stopSearch = '//localhost:8888/conwayhall/wp-content/themes/conwayhall/php/busstop.php?stop='+id;
	$.getJSON(stopSearch, function(data) {
		if(data.arrivals != '') {
			var stop = '<div class="row"><div class="twelve columns"><h3>'+name+' | Towards '+towards+' | Stop '+stopID+'</h3></div></div><div class="row"><div class="two columns"><h4>Route</h4></div><div class="eight columns"><h4>To</h4></div><div class="two columns"><h4>Arrives</h4></div></div>';
			$.each(data.arrivals, function (i, a) {
				stop += '<div class="row"><div class="two columns">';
				stop += '<p><strong>'+a.routeName+'</strong></p>';
				stop += '</div>';
				stop += '<div class="eight columns">';
				stop += '<p>'+a.destination+'</p>';
				stop += '</div>';
				stop += '<div class="two columns">';
				stop += '<p>'+a.estimatedWait+'</p>';
				stop += '</div></div>';
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
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
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