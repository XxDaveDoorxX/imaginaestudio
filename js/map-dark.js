//Google map dark version
(function($) {
"use strict";
google.maps.event.addDomListener(window, 'load', init);
    var map;
    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(21.026721, -89.646908),
            zoom: 18,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
            },
            disableDoubleClickZoom: true,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            },
            scaleControl: true,
            scrollwheel: false,
            panControl: true,
            streetViewControl: true,
            draggable : false,
            overviewMapControl: false,
            overviewMapControlOptions: {
                opened: false,
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: 
[
	{
	        stylers: [
			{ hue: '#FFF' },
			{ invert_lightness: false },
			{ saturation: -100  },
			{ lightness: 33 },
			{ gamma: 0.5 }
	        ]
	},{
		featureType: 'water',
		elementType: 'geometry',
		stylers: [
			{ color: '#3b4357' }
		]
	}
    ],
        }
        var mapElement = document.getElementById('map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var locations = [
['Imagina Estudio', 'Somos un equipo multidisciplinario comprometido con ofrecer nuestros conocimientos y habilidades.', '(999) 925-8404', 'hola@imaginaestudio.mx', 'undefined', 21.026721, -89.646908]
        ];
		var i;
		var description;
		var telephone;
		var email;
		var web;
		var marker;
		var link;
        for (i = 0; i < locations.length; i++) {
			if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
			if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
			if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
			if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
			
	var companyImage = new google.maps.MarkerImage('images/icons/ico-marker.png',
		new google.maps.Size(91,90),
		new google.maps.Point(0,0),
		new google.maps.Point(0,90)
		
	);
			
            marker = new google.maps.Marker({
                icon: companyImage,
                position: new google.maps.LatLng(locations[i][5], locations[i][6]),
                map: map,
                title: locations[i][0],
                desc: description,
                tel: telephone,
                email: email,
                web: web
            });
            bindInfoWindow(marker, map, locations[i][0], description, telephone , email, web);
        }
 function bindInfoWindow(marker, map, title, desc, tel, email, web) {
if (web.substring(0, 7) != "http://") {
link = "http://" + web;
} else {
link = web;
}
      google.maps.event.addListener(marker, 'click', function() {
            var html= "<div style='color:#000;background-color:#fff;padding:5px;width:150px;'><h4 style='color:#000;'>"+title+"</h4><p>"+desc+"<p><p>"+telephone+"<p><a href='mailto:"+email+"' >"+email+"<a><a href='"+link+"'' >"+web+"<a></div>";
            var iw = new google.maps.InfoWindow({content:html});
            iw.open(map,marker);
        });
    }
}
})(jQuery);