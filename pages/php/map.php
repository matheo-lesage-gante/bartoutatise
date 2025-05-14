<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Bars autour de moi</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../leaflet/dist/leaflet.css">
  <style>
    body { margin: 0; font-family: sans-serif; }
    #map { height: 100vh; width: 100%; }
  </style>
</head>
<body>

<div id="map"></div>

<script src="../leaflet/dist/leaflet.js"></script>
<script>
const OPENTRIPMAP_KEY = "5ae2e3f221c38a28845f05b6fb714a08acd29d6cf08b7c04cb69cda6";

let map;

// Icônes normales et agrandies
const smallIcon = new L.Icon({
  iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
  shadowSize: [41, 41]
});

const largeIcon = new L.Icon({
  iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
  iconSize: [40, 65],
  iconAnchor: [20, 65],
  popupAnchor: [1, -34],
  shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
  shadowSize: [65, 65]
});

// moi 
const smallIconmoi = new L.Icon({
  iconUrl: 'https://chart.googleapis.com/chart?chst=d_map_pin_icon&chld=home|FF0000',
  iconSize: [32, 48],
  iconAnchor: [16, 48],
  popupAnchor: [0, -45]
});

// Initialiser la carte
function initMap(lat, lon) {
  map = L.map('map').setView([lat, lon], 15);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  // Ta position
  L.marker([lat, lon], { icon: smallIconmoi }).addTo(map).bindPopup("Tu es ici").openPopup();
}

// Obtenir ta position
navigator.geolocation.getCurrentPosition(position => {
  const userLat = position.coords.latitude;
  const userLon = position.coords.longitude;

  initMap(userLat, userLon);

  // Récupère UNIQUEMENT les bars
  fetch(`https://api.opentripmap.com/0.1/en/places/radius?radius=1000&lon=${userLon}&lat=${userLat}&kinds=bars&apikey=${OPENTRIPMAP_KEY}`)
    .then(res => res.json())
    .then(data => {
      if (!data.features || data.features.length === 0) {
        alert("Aucun bar trouvé autour de toi 😢");
        return;
      }

      data.features.forEach(bar => {
        const [lon, lat] = bar.geometry.coordinates;
        const name = bar.properties.name || "Bar sans nom";

        const marker = L.marker([lat, lon], { icon: smallIcon }).addTo(map);

        // Agrandir au survol
        marker.on('mouseover', () => marker.setIcon(largeIcon));
        marker.on('mouseout', () => marker.setIcon(smallIcon));

        // Affiche le nom au clic
     marker.bindPopup(name);
    marker.on('click', () => {
      marker.openPopup();
    });
      });
    });
}, err => {
  alert("Impossible d’accéder à ta position.");
});
</script>

</body>
</html>
