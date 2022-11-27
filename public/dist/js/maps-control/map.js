// MAPS
const map = L.map('map').setView([-8.6327874, 117.6065781], 9);
const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {maxZoom: 19,
attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);


            

// MARKER COSTUM ICONS
let pantaiIcon = L.icon({
  iconUrl: '/icons/beach.png',
  iconSize: [25, 30]
});

let gunungIcon = L.icon({
  iconUrl: '/icons/gunung.png',
  iconSize: [25, 30]
});

let bawahLautIcon = L.icon({
  iconUrl: '/icons/fish.png',
  iconSize: [25, 30]
});

let pulauIcon = L.icon({
  iconUrl: '/icons/jangkar.png',
  iconSize: [25, 30]
});

let tamanIcon = L.icon({
  iconUrl: '/icons/fish.png',
  iconSize: [25, 30]
});


// MENGAMBIL DATA DARI DATABASE MENGGUNAKAN AJAX
// MARKER DAN DETAIL WISATA MODAL
$(document).ready(function() {
  // let datas = ''
  $.getJSON('/titik', function(data) {
    // console.log(data)
      // Parsing semua data
      $.each(data, function(index, value) {
        // console.log('fungsi ini berjalan', value)
        if (value.nama_kategori == 'Pantai') {
          new L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
            icon: pantaiIcon
        }).on('click', markerOnClick).addTo(map)
        }else if (value.nama_kategori == 'Gunung') {
          new L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
            icon: gunungIcon
        }).on('click', markerOnClick).addTo(map)
        }else if(value.nama_kategori == 'Pulau') {
          new L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
            icon: pulauIcon
        }).on('click', markerOnClick).addTo(map)
        }else if(value.nama_kategori == 'Taman') {
          new L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
            icon: tamanIcon
        }).on('click', markerOnClick).addTo(map)
        }else if (value.nama_kategori == 'Bawah Laut') {
          new L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
            icon: bawahLautIcon
        }).on('click', markerOnClick).addTo(map)
        }      
            function markerOnClick() {
              $('#detailModal').modal('show')
              function wisataDetail() {
                return `<div class="container-fluid">
                          <div class="row">
                              <div class="col-md-3">
                                  <img src="https://source.unsplash.com/360x500?beach" class="img-fluid">
                              </div>
                                  <div class="col-md">
                                      <ul class="list-group">
                                          <li class="list-group-item"><h4>${value.nama_wisata} (${value.nama_kategori})</h4></li>
                                          <li class="list-group-item"><strong>Lokasi    : </strong>${value.nama_kelurahan} - ${value.nama_kabupaten}</li>
                                          <li class="list-group-item"><strong>Koordinat : </strong>${value.lat}, ${value.lng}</li>
                                          <li class="list-group-item"><strong>Jam Buka  : </strong>00:00 - 00-00</li>
                                          <li class="list-group-item"><br> ${value.deskripsi}</li>
                                      </ul>
                                  </div>
                          </div>
                      </div>`
              }
              $('#detailModal').find('.modal-body').html(wisataDetail)
            }      
      })   
  })
});

// POLYGON
// $.getJSON('/geojson/kabupaten.geojson', function(data) {

//   geoLayer = L.geoJson(data, {
//     style: function(feature) {
//       if (feature.properties.nama == "Bima") {
//         return {
//           fillOpacity: 0,
//           weight: 4,
//           opacity: 1,
//           color:'yellow',
//           dashArray: '10 7',
//           lineCap: 'square'
//         };
//       }else if (feature.properties.nama == "Dompu") {
//         return {
//           fillOpacity: 0,
//           weight: 4,
//           opacity: 1,
//           color:'red',
//           dashArray: '10 7',
//           lineCap: 'square'
//         };
//       }else if (feature.properties.nama == "Sumbawa") {
//         return {
//           fillOpacity: 0,
//           weight: 4,
//           opacity: 1,
//           color:'blue',
//           dashArray: '10 7',
//           lineCap: 'square'
//         };
//       }else if (feature.properties.nama == "Sumbawa Barat") {
//         return {
//           fillOpacity: 0,
//           weight: 4,
//           opacity: 1,
//           color:'purple',
//           dashArray: '10 7',
//           lineCap: 'square'
//         };
//       }else {"Kabupaten Tidak Di Temukan"}
//     },  
//     onEachFeature: function(feature, layer) {
//       // console.log(feature)
//       // console.log(layer)
//       let divIcon = L.divIcon({
//         className : 'bidang-label',
//         html: `<b>${feature.properties.nama}</b>`,
//         iconSize : [100,20],
//       })
//       L.marker(layer.getBounds().getCenter(),{icon: divIcon}).addTo(map)
//       layer.addTo(map)
//     }
//   })
// })


// Polyline
// $.getJSON('/geojson/polyline.geojson', function(value) {
//   // console.log(value)
// })

// POLYGON PULAU SUMBAWA
let geoLayer;
$.getJSON('/geojson/kab-ksb.geojson', function(data) {
  geoLayer = L.geoJson(data, {
    style: function(feature) {
      if (feature.properties.nama == 'Sumbawa' || feature.properties.nama == 'pulau sbw') {
        return {
          fillOpacity: 0,
          weight: 2,
          opacity: 1,
          color:'blue',
          // dashArray: '10 7',
          // lineCap: 'square'
        };
      }else if (feature.properties.nama == 'Sumbawa Barat' || feature.properties.nama == 'pulau ksb') {
        return {
          fillOpacity: 0,
          weight: 2,
          opacity: 1,
          color:'red',
          // dashArray: '10 5',
          // lineCap: 'square'
        }
      }
    },  
    onEachFeature: function(feature, layer) {
      // console.log(feature)
      // console.log(layer)
      if(feature.properties.nama !== 'Sumbawa' && feature.properties.nama !== 'Sumbawa Barat') {
        let divIcon = L.divIcon({
          className : 'bidang-label',
          // html: `<b>${feature.properties.nama}</b>`,
          iconSize : [100,20],
        })
        L.marker(layer.getBounds().getCenter(),{icon: divIcon}).addTo(map)
        layer.addTo(map)
      }else {
        let divIcon = L.divIcon({
        className : 'bidang-label',
        html: `<b>${feature.properties.nama}</b>`,
        iconSize : [100,20],
      })
      L.marker(layer.getBounds().getCenter(),{icon: divIcon}).addTo(map)
      layer.addTo(map)
      }     
    }
  })
})

// HASH
var hash = new L.Hash(map);

// MOUSE POSITION
L.control.mousePosition().addTo(map);

// event klik mendapatkan latlng
const koordinat = () => map.on('click', function (e) {
  alert(e.latlng)
})

// DISTANCE / RULER
var options = {
  position: 'topleft',
  lengthUnit: {
    factor: null,    //  from km to nm
    display: 'km',
    decimal: 2,
    label: 'jarak/km:'
  }
};
L.control.ruler(options).addTo(map);

// PENCARIAN FEATURE
function searchKab (nama) {
  geoLayer.eachLayer(function(feature){
    if(feature.feature.properties.nama == nama ) {
      map.flyTo(feature.getBounds().getCenter(), 10)
    }
  })
}

// LAGEND
