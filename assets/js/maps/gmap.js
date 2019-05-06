var map=null;
var mapcenter_lat=41.11430833124999;
var mapcenter_lng=1.2540961265564166;

var markers=[];
var infowindows=[];
var fMapBounds;

var MY_MAPTYPE_ID = 'mensula';


var stylez = [
  {
    featureType: 'water',
    elementType: 'all',
    stylers: [
      { hue: '#bbbbbb' },
      { saturation: -100 },
      { lightness: -4 },
      { visibility: 'simplified' }
    ]
  },{
    featureType: 'landscape',
    elementType: 'all',
    stylers: [
      { hue: '#ffffff' },
      { saturation: -100 },
      { lightness: 100 },
      { visibility: 'simplified' }
    ]
  },{
    featureType: 'road',
    elementType: 'geometry',
    stylers: [
      { hue: '#cccccc' },
      { saturation: -100 },
      { lightness: 44 },
      { visibility: 'simplified' }
    ]
  },{
    featureType: 'poi',
    elementType: 'geometry',
    stylers: [
      { hue: '#666666' },
      { saturation: -100 },
      { lightness: -49 },
      { visibility: 'off' }
    ]
  },{
    featureType: 'poi',
    elementType: 'labels',
    stylers: [
      { hue: '#aaaaaa' },
      { saturation: -100 },
      { lightness: -15 },
      { visibility: 'off' }
    ]
  },{
    featureType: 'landscape.man_made',
    elementType: 'all',
    stylers: [
      { hue: '#cccccc' },
      { saturation: -100 },
      { lightness: -10 },
      { visibility: 'simplified' }
    ]
  },{
    featureType: 'road',
    elementType: 'labels',
    stylers: [
      { hue: '#aaaaaa' },
      { saturation: -100 },
      { lightness: 7 },
      { visibility: 'on' }
    ]
  }
];


function inicializa_mapa(center,divid,options){
  var coords=center.split(',');
  var lat=coords[0];
  var lng=coords[1];
   //coordenadas del marcador
  var myLatlng = new google.maps.LatLng(lat,lng);
  
 
  var myOptions = {
		zoom: 16,
	  disableDefaultUI: true,
	  panControl: false,
	  zoomControl: true,
	  mapTypeControl: false,
	  scaleControl: false,
	  streetViewControl: true,
	  overviewMapControl: false,
	  mapTypeControlOptions: {
	     mapTypeIds: [google.maps.MapTypeId.SATELLITE , MY_MAPTYPE_ID]
	   },
		mapTypeId: MY_MAPTYPE_ID
	}
  if(options){
    myOptions.zoomControl=options.zoomControl;
    myOptions.mapTypeControl=options.mapTypeControl;
    myOptions.streetViewControl=options.streetViewControl;
  }


  var styledMapOptions = {
    name: "Plano"
   };

  fMapBounds = new google.maps.LatLngBounds();

  var tallersMapType = new google.maps.StyledMapType(stylez, styledMapOptions);

	map = new google.maps.Map(document.getElementById(divid), myOptions);
  map.mapTypes.set(MY_MAPTYPE_ID, tallersMapType);

 
	   //map.addMarker(myLatlng);
 
  //patch to remove credits
  google.maps.event.addListener(map, 'tilesloaded', function() {
    var div=$(map.getDiv()).children('div');
    var credits=div.children('div');
    //al(credits);
    credits.eq(1).hide();
    credits.eq(2).hide();
  });


     


    return map;


}


function attachMarkerMessage(marker,label) {
  var message="<div class=\"inner-infowindow\">";
  message+=label;
  message+="</div>";
  var uri=$('#template_uri').val();
  
        var myOptions = {
                 content: message
                ,disableAutoPan: false
                ,maxWidth: 0
                ,pixelOffset: new google.maps.Size(-94, -119)
                ,zIndex: null
                ,closeBoxMargin: "4px 4px 4px 4px"
                ,closeBoxURL: uri+"/images/close-white.png"
                ,infoBoxClearance: new google.maps.Size(1, 1)
                ,isHidden: false
                ,pane: "floatPane"
                ,enableEventPropagation: false
        };

        var ib = new InfoBox(myOptions);
		//infowindows.push(ib);
        //ib.open(map, marker);

  /*google.maps.event.addListener(marker, 'click', function() {
  	if(ib.getVisible())
      ib.close(map,marker);
    else 
      ib.open(map,marker);
  });*/
}

google.maps.Map.prototype.addMarker = function(location,label) {
  
  var coords=location.split(',');
  var lat=coords[0];
  var lng=coords[1];
 // al("ADDING MARKER "+label + "["+location+"]");
   //coordenadas del marcador
  var myLatlng = new google.maps.LatLng(lat,lng);
 
  markers.push(myLatlng);

  var uri=$('#template_uri').val();
  var shadow = new google.maps.MarkerImage(uri+'/images/map_pin_shadow.png');
  var image = new google.maps.MarkerImage(uri+'/images/map_pin_2.png');
  var marker = new google.maps.Marker({
    position: myLatlng, 
    icon: image,
    /*animation: google.maps.Animation.DROP,*/
    /*shadow: shadow,*/
    map:this
  });
  attachMarkerMessage(marker,label);
 // zoomToShow();
  fMapBounds.extend(myLatlng);
      



};

function showInfoWindows(){
	
	for (var i = 0; i < markers.length; i++) {
    //  And increase the bounds to take this point
		var ib=infowindows[i];
		ib.open(map, markers[i]);
		//al(ib);
	}
}
function hideInfoWindows(){
	for (var i = 0; i < markers.length; i++) {
    //  And increase the bounds to take this point
		var ib=infowindows[i];
		ib.close(map, markers[i]);
		
	}
}


function zoomToShow(){ 
  //  Make an array of the LatLng's of the markers you want to show
 // var LatLngList = array (new google.maps.LatLng (52.537,-2.061), new google.maps.LatLng (52.564,-2.017));
  //  Create a new viewpoint bound
  var bounds = new google.maps.LatLngBounds ();
  //  Go through each...
  for (var i = 0, LtLgLen = markers.length; i < LtLgLen; i++) {
    //  And increase the bounds to take this point
    bounds.extend (markers[i]);
  }
  //  Fit these bounds to the map
  map.fitBounds(bounds);
}

function CenterMap() { //just fit it
  if (fMapBounds!= undefined) {
   map.fitBounds(fMapBounds);
  var listener = google.maps.event.addListener(map, "idle", function() { 
    //al(map.getZoom());
    if (map.getZoom() > 16) map.setZoom(16); 
    google.maps.event.removeListener(listener); 
  });

  }
}