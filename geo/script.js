Mmap = L.map('Modalmap').setView([43.6,1.45],9);

L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright"></a>',
    subdomains: ['a','b','c']
}).addTo(Mmap);

var geocoderNominatim = new L.Control.Geocoder.Nominatim();
var geocoderControl = L.Control.geocoder({
    geocoder: geocoderNominatim,
    defaultMarkGeocode: false,
    draggable:true
})
.on('markgeocode', function(e) {
    var box = e.geocode.center;
    var name=e.geocode.name;
    document.getElementById("Latitude").value = box.lat;
    document.getElementById("Longitude").value = box.lng;
    MarkLayer=L.marker([box.lat,box.lng],{draggable:true})
      .addTo(Mmap)
      .on('dragend', onDragEnd)
      .bindPopup(e.geocode.name)
      .openPopup();
    displayLatLng(box); 

    group = new L.featureGroup([MarkLayer]);

    Mmap.fitBounds(group.getBounds());
}).addTo(Mmap); 

function onDragEnd(event) {
    var latlng = event.target.getLatLng();

    geocoderNominatim.reverse(latlng, Mmap.options.crs.scale(Mmap.getZoom()), function(reverseGeocoded){
      event.target.setPopupContent(reverseGeocoded[0].name).openPopup();
    }, this)

    displayLatLng(latlng);
}

function displayLatLng(latlng) {
    document.getElementById("Latitude").value = latlng.lat;
    document.getElementById("Longitude").value = latlng.lng;
}
