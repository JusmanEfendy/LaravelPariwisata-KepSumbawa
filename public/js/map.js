
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

let bawahLautIcon = L.icon({
  iconUrl: '/icons/dolphins.png',
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
        let marker = new L.marker([parseFloat(value.lat), parseFloat(value.lng)], {
                icon: pantaiIcon
            // }).on('click', function () {
            //   alert('fnaj')
            // }).addTo(map)
            }).on('click', markerOnClick).addTo(map)
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
                                          <li class="list-group-item"><h4>${value.nama} (${value.id_kategori})</h4></li>
                                          <li class="list-group-item"><strong>Kelurahan : </strong>${value.id_kelurahan}</li>
                                          <li class="list-group-item"><strong>Kecamatan : </strong>${value.id_kecamatan}</li>
                                          <li class="list-group-item"><strong>Kabupaten : </strong>${value.id_kabupaten}</li>
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
$.getJSON('/geojson/kabupaten.geojson', function(data) {
  console.log(data)
  geoLayer = L.geoJson(data, {
    style: function(feature) {
      return {
        fillOpacity: .5,
        weight: 4,
        opacity: 1,
        color:"red"
      };
    },  
    onEachFeature: function(feature, layer) {
      layer.addTo(map)
    }
  })
})


// LEGEND
// let legend = L.control({position: 'bottomright'})

// legend.onAdd = function(map) {
//   let div = L.DomUtil.create('div', 'legend')
//   labels = [<strong>Keterangan : </strong>], categories = ['Pantai', 'Gunung', 'Bawah Laut', 'Pulau', 'Taman']
//   for (let i = 0; i<= categori.length; i++) {
//     if(i==0) {
//       div.innerHTML += labels.push('<img width="20" height="20" src="/icon/beach.png"><i class="circle" style="background: #000"></i></img>' + (categories[i] ? categories[i] : '+'))
//     }else if (i==1) {
//       div.innerHTML += labels.push('<img width="20" height="20" src="/icon/gunung.png"><i class="circle" style="background: #000"></i></img>' + (categories[i] ? categories[i] : '+'))
//     }
//   }
// }

