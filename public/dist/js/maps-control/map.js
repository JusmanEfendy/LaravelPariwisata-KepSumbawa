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
  iconUrl: '/icons/taman.png',
  iconSize: [25, 30]
});


// MENGAMBIL DATA DARI DATABASE MENGGUNAKAN AJAX
// MARKER DAN DETAIL WISATA MODAL
let pantaiMarker = [];
let pulauMarker = [];
let tamanMarker = [];
let gunungMarker = [];
let bawahLautMarker = [];
$(document).ready(function() {
  $.getJSON('/titik', function(data) {
      // Parsing semua data
      $.each(data, function(index, value) {
        // console.log('fungsi ini berjalan', value)
        if (value.nama_kategori == 'Pantai') {
          let marker = new L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
            icon: pantaiIcon
          }).on('click', markerOnClick).addTo(map)
          pantaiMarker.push({
            marker : marker,
            koordinat : [parseFloat(value.lat), parseFloat(value.lng)]
          })
        }else if (value.nama_kategori == 'Gunung') {
          let marker = new L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
            icon: gunungIcon
        }).on('click', markerOnClick).addTo(map)
        gunungMarker.push({
          marker : marker,
          koordinat : [parseFloat(value.lat), parseFloat(value.lng)]
        })
        }else if(value.nama_kategori == 'Pulau') {
          let marker = new L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
            icon: pulauIcon
        }).on('click', markerOnClick).addTo(map)
        pulauMarker.push({
          marker : marker,
          koordinat : [parseFloat(value.lat), parseFloat(value.lng)]
        })
        }else if(value.nama_kategori == 'Taman') {
          let marker = new L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
            icon: tamanIcon
        }).on('click', markerOnClick).addTo(map)
        tamanMarker.push({
          marker : marker,
          koordinat : [parseFloat(value.lat), parseFloat(value.lng)]
        })
        }else if (value.nama_kategori == 'Bawah Laut') {
          let marker = new L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
            icon: bawahLautIcon
        }).on('click', markerOnClick).addTo(map)
        bawahLautMarker.push({
          marker : marker,
          koordinat : [parseFloat(value.lat), parseFloat(value.lng)]
        })
        }      
            function markerOnClick() {
              $('#detailModal').modal('show')
              function wisataDetail() {
                return `<div class="container-fluid">
                          <div class="row">
                              <div class="col-md-3">
                                  <img src="storage/wisata_images/${value.gambar}" class="img-fluid">
                              </div>
                                  <div class="col-md">
                                      <ul class="list-group">
                                          <li class="list-group-item"><h4>${value.nama_wisata} (${value.nama_kategori})</h4></li>
                                          <li class="list-group-item"><strong>Lokasi    : </strong>${value.nama_kelurahan}, ${value.nama_kecamatan} - ${value.nama_kabupaten}</li>
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


// POLYGON KEPULAUAN SUMBAWA
let geoLayer;
$.getJSON('/geojson/perbatasan-antar-kabupaten.geojson', function(data) {
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
          color:'#046604',
        }
      }else if (feature.properties.nama == 'Dompu' || feature.properties.nama == 'pulau dmp') {
        return {
          fillOpacity: 0,
          weight: 2,
          opacity: 1,
          color:'#ad053a',
        }
      }else if (feature.properties.nama == 'Bima' || feature.properties.nama == 'pulau bima') {
        return {
          fillOpacity: 0,
          weight: 2,
          opacity: 1,
          color:'#212833',
        }
      }else {"Kabupaten tidak ditemukan."}
    },  
    onEachFeature: function(feature, layer) {
      if(feature.properties.nama !== 'Sumbawa' && feature.properties.nama !== 'Sumbawa Barat' && feature.properties.nama !== 'Dompu' && feature.properties.nama !== 'Bima') {
        let divIcon = L.divIcon({
          className : 'bidang-label',
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

// PENCARIAN FEATURE (KABUPATEN)
function searchKab (nama) {
  geoLayer.eachLayer(function(feature){
    if(feature.feature.properties.nama == nama ) {
      map.flyTo(feature.getBounds().getCenter(), 11)
    }
  })
}

// PENCARIAN FEATURE (KATEGORI)
function searchKat(nama) {
  for (let i = 0 ; i < gunungMarker.length ; i++) {
    map.addLayer(gunungMarker[i].marker)
  } 
  for (let i = 0 ; i < tamanMarker.length ; i++) {
    map.addLayer(tamanMarker[i].marker)
  } 
  for (let i = 0 ; i < bawahLautMarker.length ; i++) {
    map.addLayer(bawahLautMarker[i].marker)
  } 
  for (let i = 0 ; i < pantaiMarker.length ; i++) {
    map.addLayer(pantaiMarker[i].marker)
  }
  for (let i = 0 ; i < pulauMarker.length ; i++) {
    map.addLayer(pulauMarker[i].marker)
  }
  
  if(nama == 'Pulau') {
    for (let i = 0 ; i < gunungMarker.length ; i++) {
      map.removeLayer(gunungMarker[i].marker)
    } 
    for (let i = 0 ; i < tamanMarker.length ; i++) {
      map.removeLayer(tamanMarker[i].marker)
    } 
    for (let i = 0 ; i < bawahLautMarker.length ; i++) {
      map.removeLayer(bawahLautMarker[i].marker)
    } 
    for (let i = 0 ; i < pantaiMarker.length ; i++) {
      map.removeLayer(pantaiMarker[i].marker)
    } 
  }

  if(nama == 'Gunung') {
    for (let i = 0 ; i < pantaiMarker.length ; i++) {
      map.removeLayer(pantaiMarker[i].marker)
    } 
    for (let i = 0 ; i < tamanMarker.length ; i++) {
      map.removeLayer(tamanMarker[i].marker)
    } 
    for (let i = 0 ; i < bawahLautMarker.length ; i++) {
      map.removeLayer(bawahLautMarker[i].marker)
    } 
    for (let i = 0 ; i < pulauMarker.length ; i++) {
      map.removeLayer(pulauMarker[i].marker)
    } 
  }

  if(nama == 'Taman') {
    for (let i = 0 ; i < pantaiMarker.length ; i++) {
      map.removeLayer(pantaiMarker[i].marker)
    } 
    for (let i = 0 ; i < gunungMarker.length ; i++) {
      map.removeLayer(gunungMarker[i].marker)
    } 
    for (let i = 0 ; i < bawahLautMarker.length ; i++) {
      map.removeLayer(bawahLautMarker[i].marker)
    } 
    for (let i = 0 ; i < pulauMarker.length ; i++) {
      map.removeLayer(pulauMarker[i].marker)
    } 
  }

  if(nama == 'Bawah Laut') {
    for (let i = 0 ; i < pantaiMarker.length ; i++) {
      map.removeLayer(pantaiMarker[i].marker)
    } 
    for (let i = 0 ; i < tamanMarker.length ; i++) {
      map.removeLayer(tamanMarker[i].marker)
    } 
    for (let i = 0 ; i < gunungMarker.length ; i++) {
      map.removeLayer(gunungMarker[i].marker)
    } 
    for (let i = 0 ; i < pulauMarker.length ; i++) {
      map.removeLayer(pulauMarker[i].marker)
    } 
  }

  if(nama == 'Pantai') {
    for (let i = 0 ; i < bawahLautMarker.length ; i++) {
      map.removeLayer(bawahLautMarker[i].marker)
    } 
    for (let i = 0 ; i < tamanMarker.length ; i++) {
      map.removeLayer(tamanMarker[i].marker)
    } 
    for (let i = 0 ; i < gunungMarker.length ; i++) {
      map.removeLayer(gunungMarker[i].marker)
    } 
    for (let i = 0 ; i < pulauMarker.length ; i++) {
      map.removeLayer(pulauMarker[i].marker)
    } 
  }
}

// LAGEND
 