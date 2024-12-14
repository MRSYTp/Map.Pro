<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map.Pro</title>
    <link href="assets/favicon.png" rel="shortcut icon" type="image/png">
    <link rel="stylesheet" href="assets/css/styles.css<?="?v=" . rand(1010,100000) ?>" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" ></script>
</head>

<body>
    <div class="main">
    <div class="head">
        <div class="search-box">
        <input type="text" id="search" placeholder="دنبال کجا می گردی؟">
        <div class="clear"></div>
        <div class="search-results" style="display: none;">
            <!-- result -->
        </div>
        </div>
        </div>
        <div class="mapContainer">
            <div id="map"></div>
        </div>
        <img src="assets/img/nearLocation.png" id="find-locations" class="nearUserLoc">
        <img src="assets/img/finder.png" id="showAllLocations" class="showAllLoc">
        <img src="assets/img/current.png" class="currentLoc">
    </div>



    <div class="modal-overlay" style="display: none;">
        <div class="modal">
            <span class="close">x</span>
            <h3 class="modal-title">ثبت لوکیشن</h3>
            <div class="modal-content">
                <form id='addLocationForm' action="<?= site_url("process/locationAjaxHandler.php")?>" method="post">
                <div class="field-row">
                            <div class="field-title">مختصات:</div>
                            <div class="field-content">
                                <input type="text" name='lat' id="lat-display" readonly style="width: 160px;text-align: center;">
                                <input type="text" name='lng' id="lng-display" readonly style="width: 160px;text-align: center;">
                            </div>
                    </div>
                    <div class="field-row">
                            <div class="field-title">نام مکان:</div>
                            <div class="field-content">
                                <input type="text" name="title" id='l-title' placeholder="مثلا: دفتر مرکزی سون لرن">
                            </div>
                    </div>
                    <div class="field-row">
                            <div class="field-title"> نام و نام خانوادگی:</div>
                            <div class="field-content">
                                <input type="text" name="name" placeholder="نام و نام خانوادگی">
                            </div>
                    </div>
                    <div class="field-row">
                            <div class="field-title">ایمیل:</div>
                            <div class="field-content">
                                <input type="email" name="email" placeholder="ایمیل">
                            </div>
                    </div>
                    <div class="field-row">
                        <div class="field-title">نوع:</div>
                        <div class="field-content">
                            <select name="type" id='l-type'>
                            <?php foreach(locationTypes as $key=>$value): ?>
                            <option value="<?= $key ?>"><?= $value?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="field-row">
                        <div class="field-title">ذخیره نهایی</div>
                        <div class="field-content">
                            <input type="submit" value=" ثبت ">
                        </div>
                    </div>
                    <div class="ajax-result"></div>
                </form>
            </div>
        </div>
    </div>


    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/main.js<?="?v=" . rand(1010,100000) ?>"></script>
    <script>
        document.getElementById('showAllLocations').addEventListener('click', () => {
            // Function to fetch and display markers
            function fetchMarkers(bounds) {
                // Convert bounds to a format suitable for the server
                const bbox = {
                    north: bounds.getNorth(),
                    south: bounds.getSouth(),
                    east: bounds.getEast(),
                    west: bounds.getWest()
                };

                // AJAX request to send bounds to the server
                    fetch('<?= MAP_URL . 'process/server_endpoint.php' ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(bbox)
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Clear existing markers (if needed)
                        map.eachLayer(layer => {
                            if (layer instanceof L.Marker) {
                                map.removeLayer(layer);
                            }
                        });

                        // Add markers to the map
                        data.forEach(location => {
                            L.marker([location.lat, location.lng])
                                .addTo(map)
                                .bindPopup(location.title || 'No name provided');
                        });
                    })
                    .catch(error => console.error('Error fetching markers:', error));
                }

                // Event listener for when map movement ends
                map.on('moveend', () => {
                    const bounds = map.getBounds(); // Get the current visible map bounds
                    fetchMarkers(bounds); // Fetch and display markers for these bounds
                });
        });
        

        <?php if($location): ?>
            L.marker([<?= $location->lat; ?>,<?= $location->lng; ?>]).addTo(map)
            .bindPopup("<?=$location->title; ?>").openPopup();
        <?php endif; ?>
        $(document).ready(function(){

            
            // اتصال فانکشن به کلیک روی دکمه یا تصویر
            $('#find-locations').on('click', function () {
                // مکان‌یابی کاربر
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        const userLat = position.coords.latitude; // عرض جغرافیایی کاربر
                        const userLng = position.coords.longitude; // طول جغرافیایی کاربر
                        
                        // شعاع جستجو (10 کیلومتر)
                        const radius = 10;

                        // نمایش مکان فعلی کاربر روی نقشه
                        const userLocationMarker = L.marker([userLat, userLng]).addTo(map);
                        userLocationMarker.bindPopup('Your Location').openPopup();

                        // ارسال مختصات و شعاع به سرور با jQuery AJAX
                        $.ajax({
                            url: '<?= MAP_URL . 'process/get_locations.php' ?>', // فایل سرور برای دریافت مکان‌های نزدیک
                            method: 'POST',
                            dataType: 'json',
                            contentType: 'application/json',
                            data: JSON.stringify({
                                latitude: userLat,
                                longitude: userLng,
                                radius: radius
                            }),
                            success: function (locations) {
                                console.log('Nearby Locations:', locations);
                                // نمایش مکان‌های نزدیک روی نقشه
                                locations.forEach(function (location) {
                                    const marker = L.marker([location.lat, location.lng]).addTo(map);
                                    marker.bindPopup(location.title);
                                });
                            },
                            error: function (xhr, status, error) {
                                console.error('Error fetching locations:', error);
                            }
                        });
                    });
                } else {
                    alert('Geolocation is not supported by this browser.');
                }
            });

            $("#search").keyup(function(e){
                const input = $(this);
                const titleSearch = input.val();

                    $('.search-results').slideDown();
                    $.ajax({
                        url: "<?= MAP_URL . 'process/search.php' ?>",
                        method: "POST",
                        data: { TitleSearch: titleSearch },
                        success: function(response) {
                            $('.search-results').html(response);
                        },
                        error: function() {
                            alert("مشکلی در ارتباط با سرور وجود دارد.");
                        }
                    });
            });

            $("img.currentLoc").click(function(){
                locate();
            });




        });
    </script>
</body>

</html>