<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O'zbekistonda Manzilni Izlash</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfhB0kIiMlyJuAuWsh0Sr10C7SxYHaiv4&libraries=places"></script>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        #search-box {
            margin-top: 10px;
            width: 300px;
            height: 30px;
            padding: 5px;
        }
    </style>
</head>
<body>

<h3>O'zbekistonda Manzilni Izlash</h3>
<input id="search-box" type="text" placeholder="Manzilni kiriting...">
<div id="map"></div>

<script>
    let map, searchBox;

    function initMap() {
        // Xaritani O'zbekiston markaziga joylash
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 41.2995, lng: 69.2401 }, // Toshkent shahrini markazlash
            zoom: 6, // O'zbekistonni ko'rish uchun
        });

        const input = document.getElementById("search-box");
        searchBox = new google.maps.places.SearchBox(input);

        // Izlash natijalarini qayta ishlash
        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length === 0) return;

            // Xaritada ko'rsatilgan markerni tozalash
            const bounds = new google.maps.LatLngBounds();
            places.forEach(place => {
                if (!place.geometry || !place.geometry.location) return;

                // Yangi marker yaratish
                new google.maps.Marker({
                    map,
                    position: place.geometry.location,
                });

                if (place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }

    window.onload = initMap;
</script>

</body>
</html>
