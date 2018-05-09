var GMapLogic = GMapLogic || {};

(function($, window, document){ 
    "use strict";
    GMapLogic.load = function() {
        $(GMapLogic.MapClass).each(function() {
            GMapLogic.initMap( $(this) );
        });
    }

    GMapLogic.initMap = function( $map ) {
        var gmap = GMapLogic.newMap( $map );

        $(window).on( 'resize', function() {
            GMapLogic.centerMap( gmap );
        });
    }

    GMapLogic.newMap = function( $el ) {
        var $markers = $el.find(GMapLogic.MarkerClass);

        var args = {
                zoom		: GMapLogic.defaultZoom,
                center		: new google.maps.LatLng(0, 0),
                mapTypeId           : google.maps.MapTypeId.ROADMAP,
                scrollwheel         : false,
                disableDefaultUI    : false,
                draggable           : true,
                styles              : GMapLogic.styles
            };        	
            var map = new google.maps.Map( $el[0], args);
            map.markers = [];
     
            $markers.each(function(){
                GMapLogic.addMarker( $(this), map );
            });
            GMapLogic.centerMap( map );
            return map;        
    }

    GMapLogic.centerMap = function( map ) {
        var bounds = new google.maps.LatLngBounds();
        var visiblePoints = 0;
        
        $.each( map.markers, function( i, marker ){
            var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
            bounds.extend( latlng );
        });
        if( map.markers.length == 1 ) {
            var boundCenter = bounds.getCenter();
            
            var mapCenter = new google.maps.LatLng( boundCenter.lat(), boundCenter.lng() );
            
            map.setCenter( mapCenter );
            map.setZoom( GMapLogic.defaultZoom );
        }
        else {
            map.fitBounds( bounds );  
        }      
    }

    GMapLogic.addMarker = function( $marker, map ) {
        var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
        var marker = new google.maps.Marker({
                position	: latlng,
                map         : map,
                icon        : $marker.attr('data-icon')
        });

        map.markers.push( marker );
        if( $marker.html() )
        {
            var infowindow = new google.maps.InfoWindow({
                    content		: $marker.html()
            });
            google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open( map, marker );
            });
        }        
    }

    GMapLogic.initialize = function( key ) {
        if( key && $(GMapLogic.MapClass).length !== 0 ) {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://maps.googleapis.com/maps/api/js?key='+key+'&ver=4.2.5&callback=gmap_draw';
            window.gmap_draw = function() {
                GMapLogic.load();
            }
            document.body.appendChild(script);            
        }
    }

    GMapLogic.defaultZoom = 12;
    GMapLogic.styles = [
        {
            "featureType": "all",
            "elementType": "all",
            "stylers": [
                {
                    "saturation": -100
                },
                {
                    "gamma": 0.5
                }
            ]
        }
    ];
    GMapLogic.MapClass = ".gmap";
    GMapLogic.MarkerClass = ".marker";
})(jQuery, window, document);