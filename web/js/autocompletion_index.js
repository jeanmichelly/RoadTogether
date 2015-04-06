var initialize;

initialize = function(){
  var origin = document.getElementById('cv_platformbundle_ride_search_departure');
        var destination = document.getElementById('cv_platformbundle_ride_search_arrival');
        var options = {
          types: ['geocode'],
          componentRestrictions: {country: 'fr'}
  }; 
  autocompleteOrigin = new google.maps.places.Autocomplete(origin, options);
  autocompleteDestination = new google.maps.places.Autocomplete(destination, options);
 };

initialize();
