var map;
$(document).ready(function(){
      map = new GMaps({
        el: '#map',
        lat: $('#input-lat').val(),
        lng: $('#input-lng').val(),
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

      map.addMarker({
              lat: $('#input-lat').val(),
              lng: $('#input-lng').val(),
              title: 'posisi kamu!',
        });

  // when the 'start travel' button is clicked
  $("#start-travel").click(function() {
    $(this).fadeOut();
    $("#instructions").before("<div class='section-title'>Instructions</div>");
    map.travelRoute({
      origin: [-3.3367972, 114.6061456],
      destination: [$('#input-lat').val(), $('#input-lng').val()],
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