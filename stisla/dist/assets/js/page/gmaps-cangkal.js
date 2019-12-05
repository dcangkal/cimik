var map;
$(document).ready(function(){
      map = new GMaps({
        el: '#map',
        lat: 0,
        lng: 0,
        zoomControl : true,
        zoomControlOpt: {
            style : 'SMALL',
            position: 'TOP_LEFT'
        },
        panControl : false,
        streetViewControl : false,
        mapTypeControl: false,
        overviewMapControl: false
      });

  // Define user location
  GMaps.geolocate({
      success: function(position) {
        map.setCenter(position.coords.latitude, position.coords.longitude);
        document.getElementById('input-lat').value = position.coords.latitude;
        document.getElementById('input-lng').value = position.coords.longitude;


    // Creating marker of user location
          map.addMarker({
              lat: position.coords.latitude,
              lng: position.coords.longitude,
              title: 'Lima',
              click: function(e) {
                document.getElementById('input-lat').value = position.coords.latitude;
                document.getElementById('input-lng').value = position.coords.longitude;
                alert('You clicked in this marker'+ position.coords.latitude + ',' + position.coords.longitude);
              },
              infoWindow: {
                  content: '<p>You are here!</p>'
                }
        });
      },
      error: function(error) {
        alert('Geolocation failed: '+error.message);
      },
      not_supported: function() {
        alert("Your browser does not support geolocation");
      }
  });

  // when the 'start travel' button is clicked
  $("#start-travel").click(function() {
    $(this).fadeOut();
    $("#instructions").before("<div class='section-title'>Instructions</div>");
    map.travelRoute({
      origin: [-3.3367972, 114.6061456],
      destination: [document.getElementById('input-lat').value = position.coords.latitude, 106.788236],
      travelMode: 'driving',
      step: function(e) {
        $('#instructions').append('<li class="media"><div class="media-icon"><i class="far fa-circle"></i></div><div class="media-body">'+e.instructions+'</div></li>');
        $('#instructions li:eq(' + e.step_number + ')').delay(450 * e.step_number).fadeIn(200, function() {
          map.setCenter(e.end_location.lat(), e.end_location.lng());
          map.drawPolyline({
            path: e.path,
            strokeColor: '#131540',
            strokeOpacity: 0.6,
            strokeWeight: 6
          });
        });
      }
    });
  });

}); 