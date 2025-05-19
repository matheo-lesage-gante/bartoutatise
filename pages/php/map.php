<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Barathon optimisé</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../leaflet/dist/leaflet.css">
  <style>
    body { margin: 0; font-family: sans-serif; }
    #map { height: 90vh; width: 100%; }
    #controls {
      padding: 10px;
      background: #f8f8f8;
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
    }
  </style>
</head>
<body>
<?php include 'header.php'; ?>

<div id="controls">
  <select id="barType">
    <option value="all">Tous les bars</option>
    <option value="wine">Bars à vin</option>
    <option value="pub">Pubs</option>
    <option value="cocktail">Bars à cocktails</option>
  </select>
  <button onclick="startBarathon()">Lancer la tournée 🍻</button>
  <button onclick="resetMap()">Réinitialiser la carte 🔄</button>
</div>

<div id="map"></div>

<script src="../leaflet/dist/leaflet.js"></script>
<script>
const OPENTRIPMAP_KEY = "5ae2e3f221c38a28845f05b6fb714a08acd29d6cf08b7c04cb69cda6";
const ORS_KEY = "5b3ce3597851110001cf624818b5e7b668b04c75bde31960cef1b853";

let map, userPos, routeLayer;
let barMarkers = [];

// Icône des bars
const barIcon = new L.Icon({
  iconUrl: '../leaflet/dist/images/marker-icon.png',
  iconSize: [32, 32],
  iconAnchor: [16, 32],
  popupAnchor: [0, -30]
});

const barIconmoi = new L.Icon({
  iconUrl: '../leaflet/dist/images/Design sans titre (10).png',
  iconSize: [32, 32],
  iconAnchor: [16, 32],
  popupAnchor: [0, -30]
});

function initMap(lat, lon) {
  map = L.map('map').setView([lat, lon], 15);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19
  }).addTo(map);
  L.marker([lat, lon]).addTo(map).bindPopup("Toi").openPopup();
}

navigator.geolocation.getCurrentPosition(position => {
  userPos = [position.coords.latitude, position.coords.longitude];
  initMap(...userPos);
}, () => alert("Impossible d’accéder à la position."));

function startBarathon() {
  clearBarsAndRoute();

  const type = document.getElementById('barType').value;
  const radius = 2000;

  const url = `https://api.opentripmap.com/0.1/en/places/radius?radius=${radius}&lon=${userPos[1]}&lat=${userPos[0]}&kinds=bars&limit=20&apikey=${OPENTRIPMAP_KEY}`;

  fetch(url)
    .then(res => res.json())
    .then(data => {
      const filtered = data.features
        .filter(f => {
          const name = (f.properties.name || "").toLowerCase();
          if (type === "wine") return name.includes("vin") || name.includes("wine");
          if (type === "pub") return name.includes("pub");
          if (type === "cocktail") return name.includes("cocktail");
          return true;
        })
        .slice(0, 6);

      if (filtered.length === 0) {
        alert("Aucun bar trouvé pour ce type.");
        return;
      }

      const points = [[userPos[1], userPos[0]], ...filtered.map(f => f.geometry.coordinates)];

      fetch('https://api.openrouteservice.org/v2/directions/foot-walking/geojson', {
        method: 'POST',
        headers: {
          'Authorization': ORS_KEY,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ coordinates: points })
      })
      .then(res => res.json())
      .then(route => {
        const coords = route.features[0].geometry.coordinates.map(c => [c[1], c[0]]);
        routeLayer = L.polyline(coords, { color: 'blue' }).addTo(map);
        map.fitBounds(routeLayer.getBounds());

        // Marqueurs des bars
        filtered.forEach((bar, i) => {
          const [lon, lat] = bar.geometry.coordinates;
          const name = bar.properties.name || "Bar";
          const marker = L.marker([lat, lon], { icon: barIcon })
            .addTo(map)
            .bindPopup(`Étape ${i + 1} : ${name}`);
          barMarkers.push(marker);
        });
      });
    });
}

function resetMap() {
  clearBarsAndRoute();

  const radius = 2000;
  const url = `https://api.opentripmap.com/0.1/en/places/radius?radius=${radius}&lon=${userPos[1]}&lat=${userPos[0]}&kinds=bars&apikey=${OPENTRIPMAP_KEY}`;

  fetch(url)
    .then(res => res.json())
    .then(data => {
      if (!data.features || data.features.length === 0) {
        alert("Aucun bar trouvé autour de toi.");
        return;
      }

      data.features.forEach(bar => {
        const [lon, lat] = bar.geometry.coordinates;
        const name = bar.properties.name || "Bar";
        const marker = L.marker([lat, lon], { icon: barIconmoi })
          .addTo(map)
          .bindPopup(name);
        barMarkers.push(marker);
      });
    });
}

function clearBarsAndRoute() {
  if (routeLayer) {
    map.removeLayer(routeLayer);
    routeLayer = null;
  }
  barMarkers.forEach(marker => map.removeLayer(marker));
  barMarkers = [];
}
</script>

</body>
</html>
