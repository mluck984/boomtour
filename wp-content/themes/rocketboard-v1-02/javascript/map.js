// JavaScript Document

var geocoder;
var map;
var mobile;

$(document).ready(function(){
	
	mobile = ($(window).width() < 767);
	
	if(mobile){ $('#map').css('height', 'auto'); }

	$('#map-cta').click(function(){
		if($('#map').css('display') == 'none'){
			$('#map').slideDown(600, function(){
				if(! map){
					initMap();
				} else{
					if(! mobile){
						map.invalidateSize();
					}
				}
			});
			if(map){
				$('.list-filters').slideDown(600);
				$('#map-list').slideDown(600);
			}
			$('#map-cta .cta-arrow').html('&#x25B2;');
			$('#map-cta #text').html("CLOSE LOCATIONS");
			$('#map-cta').removeClass('closed');
			$('#map-cta').addClass('open');
		} else{
			$('#map').slideUp(600);
			$('#map-list').slideUp(600);
			$('.list-filters').slideUp(600);
			$('#map-cta .cta-arrow').html('&#x25BC;');
			$('#map-cta #text').html("SEE WHERE WE'RE BRINGING THE BOOM.");
			$('#map-cta').removeClass('open');
			$('#map-cta').addClass('closed');
			$("html, body").animate({ scrollTop: 0 }, 500);
		}
	});
	
	$('.list-filters .filter').click(function(event, noScroll){
		var type = $(this).attr('id');
		var delay = 0;
			
		$('#map-list div').each(function(){
			if(type == 'all'){
				$(this).delay(delay).fadeIn("fast");
				delay += 10;
			} else{
				if($(this).hasClass(type)){
					$(this).delay(delay).fadeIn("fast");
				} else{
					$(this).delay(delay).fadeOut("fast");
				}
				delay += 10;
			}
		});
		
		$('.list-filters ul li').each(function(){
			if(type == 'all'){
				$(this).removeClass('filter-off');
			} else{
				if($(this).attr('id') != type){
					$(this).addClass('filter-off');
				} else{
					$(this).removeClass('filter-off');
				}
			}
		});
		
		if(! mobile){
			map.setView([$(this).attr('lat'), $(this).attr('long')], $(this).attr('zoom'));
			
			$('#map img.leaflet-marker-icon, #map img.leaflet-marker-shadow').each(function(){
				if(type == 'all'){
					$(this).show();
				} else{
					if($(this).hasClass(type)){
						$(this).show();
					} else if(! $(this).hasClass('instagram-map-icon')){
						$(this).hide();
					}
				}
			});
		} else if(! noScroll){
			$("html, body").animate({ scrollTop: $('.list-filters').offset().top }, 500);
		}
	});
});

function initMap(){
	if(! mobile){
		map = L.map('map').setView([41.8819, -87.6278], 8);
		
		// add an OpenStreetMap tile layer
		L.tileLayer("https://{s}.tiles.mapbox.com/v3/growsoomboom.j5j6e7lm/{z}/{x}/{y}.png", {
		attribution: "Map data &copy; <a href=\'http://openstreetmap.org\'>OpenStreetMap</a> contributors, <a href=\'http://creativecommons.org/licenses/by-sa/2.0/\'>CC-BY-SA</a>, Imagery © <a href=\'http://cloudmade.com\'>CloudMade</a>"
		}).addTo(map);
		
		var InstagramIcon = L.Icon.extend({
			options: {
				className:		'instagram-map-icon',
				iconSize:		[50, 50],
				iconAnchor:		[25, 25],
				popupAnchor:	[0, -25],
				shadowUrl:		'wp-content/themes/rocketboard-v1-02/images/instagram-shadow.png',
				shadowAnchor:	[32,32],
				shadowSize:		[82,82]
			}
		});
			
		geocoder = new google.maps.Geocoder();
	} else{
		map = document.createElement("img");
		map.src = "wp-content/themes/rocketboard-v1-02/images/Mobile_Map.png";
		map.className = "mobile-map";
		$('#map').append(map);
	}
	
	Papa.parse('wp-content/themes/rocketboard-v1-02/assets/itinerary-KPC.csv',{
download: true, complete: function(results, file) {
		var arr = results['data'];
		
		for(var i = 0; i < arr.length; i++){
			var date = arr[i][0];
			var time = arr[i][1];
			var name = arr[i][2];
			var street = arr[i][3];
			var city = arr[i][4];
			var state = arr[i][5];
			var zip = arr[i][6];
			var lat = parseFloat(arr[i][7]);
			var long = parseFloat(arr[i][8]);
			var category = arr[i][9];
			
			var address = street + ' ' + city + ', ' + state + ' ' + zip;
			var textAddress = street + ' ' + city + ', ' + state;
			
			//getLatLng(date,time,name,street,city,state,zip,address);

			$('#map-list').append('<div class="'+category+'"><span>'+date+'<br/>'+time+'</span>'+name+'<br/>'+street+'<br/>'+city+', '+state+'</div>');
			
			if(! mobile){
				
				var MapIcon = L.Icon.extend({
					options: {
						className:		category,
						iconSize:		[30, 30],
						iconAnchor:		[15, 30],
						popupAnchor:	[-5, -35],
						shadowUrl:		'wp-content/themes/rocketboard-v1-02/images/mapicon_shadow.png',
						shadowAnchor:	[10,28],
						shadowSize:		[30,30]
					}
				});
				
				var icon = new MapIcon({iconUrl: 'wp-content/themes/rocketboard-v1-02/images/mapicon.png'});
				
				L.marker([lat, long], {icon: icon}).addTo(map)
					.bindPopup('<b>'+name+'</b><br/>'+
						street+'<br/>'+ 
						city+', '+state+'<br/>'+
						zip+'<br/><br/>'+
						date+'<br/>'+
						time);
			}
		}
		
		$('#map-list').slideDown(600);

		$('.list-filters').slideDown(600);
		$('.list-filters #chicago').trigger('click', [true]);
		
		if(! mobile){
			$('.grid-item.photo').each(function(){
				if($(this).attr('lat') != ""){
					var icon = new InstagramIcon({iconUrl: $(this).attr('thumbnail')});
					var picLat = parseFloat($(this).attr('lat'));
					var picLong = parseFloat($(this).attr('long'));
	
					L.marker([picLat,picLong], {icon: icon}).addTo(map).bindPopup('<p>'+$(this).attr('caption')+'</p>'+'<a href="'+$(this).attr('link')+'" target="_blank">View on Instagram</a>');
				}
			});
		}
	}});	
	
	
}

function getLatLng(date,time,name,street,city,state,zip,address){
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			var latlng = results[0].geometry.location;
			$('#map-list').append(date+','+time+','+name+','+street+','+city+','+state+','+zip+','+latlng['k']+','+latlng['B']+'<br/>');
		} else {
		  console.log('Geocode was not successful for the following reason: ' + status);
		}
	});
}