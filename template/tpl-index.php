<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map.Pro</title>
    <link href="assets/favicon.png" rel="shortcut icon" type="image/png">
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/leaflet.css"/>
    <script src="assets/js/leaflet.js" ></script>
</head>

<body>
    <div class="main">
        <div class="head">
            <input type="text" id="search" placeholder="دنبال کجا می گردی؟">
        </div>
        <div class="mapContainer">
            <div id="map"></div>
        </div>
    </div>
    <script>

const map = L.map('map').setView([35.7181638,51.3498455], 11.75);

const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.linkedin.com/in/mohammadreza-salehi-5681a2339/">Create BY Mohammadreza-Salehi</a>'
}).addTo(map);ht

const marker = L.marker([51.5, -0.09]).addTo(map)
    .bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();



map.on('click', onMapClick);

</script>
</body>

</html>