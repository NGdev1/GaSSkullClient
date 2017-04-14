/**
 * Created by Михаил on 01.12.2016.
 */

var marker;
var infoWindow;

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}

function initMap() {
    latLng = {lat: 55.90710733249874, lng: 49.30347561836243};

    // Create a map object and specify the DOM element for display.
    var map = new google.maps.Map(document.getElementById('map'), {
        center: latLng,
        scrollwheel: true,
        zoom: 16,
        mapTypeControlOptions: {
            mapTypeIds: [
                google.maps.MapTypeId.ROADMAP,
                google.maps.MapTypeId.SATELLITE
            ],
            position: google.maps.ControlPosition.BOTTOM_LEFT
        }
    });


    marker = new google.maps.Marker({
        map: map,
        // Define the place with a location, and a query string.
        position:  latLng,
        // Attributions help users find your site again.
        attribution: {
            source: 'Google Maps JavaScript API',
            webUrl: 'https://developers.google.com/maps/'
        },
        draggable: true
    });

    // Construct a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
        content: 'Автосервис GasSkull. <br/> Координаты:' +
        '<br/>' + latLng.lat + ', ' + latLng.lng
    });

    // Opens the InfoWindow when marker is clicked.
    marker.addListener('click', function () {
        map.panTo(latLng);
        infoWindow.open(map, marker);
    });
}






