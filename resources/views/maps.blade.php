<!DOCTYPE html>
<html>
<head>
  <title>OpenStreetMap - Garis Putus-Putus Tanjung Perak - Chennai</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
  <style>
    #map {
      width: 1024px;
      height: 840px;
    }
  </style>
</head>
<body>
  <div id="map"></div>
  <script>
    // Inisialisasi peta Leaflet
    const map = L.map('map').setView([-7.25, 112.75], 5); // Koordinat awal (Surabaya)

    // OpenStreetMap tiles
    const tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">Lintas Tech Teams</a> contributors'
    });

    tiles.addTo(map);

    // Koordinat pelabuhan
    const tanjungPerak = [-7.225556, 112.716667]; // Tanjung Perak, Surabaya
    const belokanMadura = [-7.1855,112.7304];
    const belokanMadura2 = [-7.1683,112.6854];
    const belokanMadura3 = [-7.0870,112.6610];
    const belokanMadura4 = [-6.6977,112.6772];
    const belokanBangka = [-2.615,108.787];
    const singapore = [1.341,103.282]; // Singapura
    const kualaLumpur = [4.160,99.174]; // Kuala Lumpur
    const aceh = [9.536,93.560]; // Aceh
    const chennai = [13.082611, 80.216044]; // Chennai, India

    // Menghubungkan koordinat dengan garis putus-putus halus
    const dashedLine = L.polyline([tanjungPerak, belokanMadura, belokanMadura2, belokanMadura3, belokanMadura4, belokanBangka, singapore, kualaLumpur, aceh, chennai], {
      color: 'blue',
      dashArray: [5, 10], // Pola putus-putus
      smoothFactor: 3 // Menghaluskan garis
    }).addTo(map);

    // Menambahkan marker di setiap pelabuhan
    const tanjungPerakMarker = L.marker(tanjungPerak).addTo(map).bindPopup("Pelabuhan Tanjung Perak Surabaya").openPopup();
    const singaporeMarker = L.marker(singapore).addTo(map).bindPopup("Pelabuhan Singapura").openPopup();
    const kualaLumpurMarker = L.marker(kualaLumpur).addTo(map).bindPopup("Pelabuhan Kuala Lumpur").openPopup();
    const acehMarker = L.marker(aceh).addTo(map).bindPopup("Pelabuhan Aceh").openPopup();
    const chennaiMarker = L.marker(chennai).addTo(map).bindPopup("Pelabuhan Chennai India").openPopup();
  </script>
</body>
</html>
