
// MAPS
const map = L.map('map').setView([-8.6327874, 117.6065781], 9);
const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {maxZoom: 19,
attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
            

// COSTUM ICONS
let pantaiIcon = L.icon({
  iconUrl: '/icons/beach.png',
  iconSize: [25, 30]
});

let gunungIcon = L.icon({
  iconUrl: '/icons/gunung.png',
  iconSize: [25, 30]
});


// MENGAMBIL DATA DARI DATABASE MENGGUNAKAN AJAX
$(document).ready(function() {
  $.getJSON('/titik', function(data) {
      // Parsing semua data
      $.each(data, function(index, value) {

        L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
                icon: pantaiIcon
            }).addTo(map)
            .bindPopup("test pop up.");
      })
  })
});