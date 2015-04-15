function initialize(idOrigin, idDestination){
    var origin = document.getElementById(idOrigin);
        var destination = document.getElementById(idDestination);
        var options = {
            types: ['geocode'],
            componentRestrictions: {country: 'fr'}
        }; 
    autocompleteOrigin = new google.maps.places.Autocomplete(origin, options);
    autocompleteDestination = new google.maps.places.Autocomplete(destination, options);
    google.maps.event.addListener(autocompleteOrigin, 'place_changed', function () {
        calculate();
    });
    google.maps.event.addListener(autocompleteDestination, 'place_changed', function () {
        calculate();
    });
}