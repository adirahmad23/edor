<!DOCTYPE html>
<html lang="en">

<?php include_once "template/headers.php" ?>
<?php include_once "template/extension.php" ?>

<body>
    <!--=============== Bottom Bar ===============-->
    <?php include_once "template/bottombar.php" ?>
    <main>
        <!--=============== HOME ===============-->
        <section class="container-app section__height" id="home">
            <div class="container mt-">
                <div class="row">
                    <div class="container">
                        <div id="map" class="mt-4"></div>
                        <div id="results" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="assets/js/main.js"></script>

    <!-- Google Maps API -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIFRZvvoxoqjqI6ITl6L6ao94gKjQ48DA&libraries=places,geometry"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        let map;
        let service;
        let infowindow;

        function initMap(position) {
            const userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            map = new google.maps.Map(document.getElementById("map"), {
                center: userLocation,
                zoom: 14,
            });

            infowindow = new google.maps.InfoWindow();

            const request = {
                location: userLocation,
                radius: '5000',
                query: 'rumah sakit kulit',
            };

            service = new google.maps.places.PlacesService(map);
            service.textSearch(request, (results, status) => handleSearchResults(results, status, userLocation));
        }

        function handleSearchResults(results, status, userLocation) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                // Hitung jarak untuk setiap tempat
                const placesWithDistance = results.map(place => {
                    const placeLocation = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
                    const distance = google.maps.geometry.spherical.computeDistanceBetween(
                        new google.maps.LatLng(userLocation.lat, userLocation.lng),
                        placeLocation
                    ) / 1000; // Jarak dalam kilometer
                    return { ...place, distance };
                });

                // Urutkan berdasarkan jarak terdekat
                placesWithDistance.sort((a, b) => a.distance - b.distance);

                // Tampilkan hasil
                for (let place of placesWithDistance) {
                    createMarker(place);
                    displayResult(place); // Menampilkan hasil
                }
            }
        }

        function createMarker(place) {
            const marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location,
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }

        function displayResult(place) {
            const resultsDiv = document.getElementById("results");
            const placeElement = document.createElement("div");
            placeElement.classList.add("card", "mb-3");
            placeElement.innerHTML = `
                <div class="card-body">
                    <h5 class="card-title">${place.name}</h5>
                    <p class="card-text">${place.formatted_address}</p>
                    <p class="card-text">Jarak: ${place.distance.toFixed(2)} km</p>
                    <a href="https://www.google.com/maps/search/?api=1&query=${place.name}&query_place_id=${place.place_id}" target="_blank" class="btn btn-primarys">Lihat di Google Maps</a>
                </div>
            `;
            resultsDiv.appendChild(placeElement);
        }

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(initMap, showError);
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("Pengguna menolak permintaan lokasi.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Informasi lokasi tidak tersedia.");
                    break;
                case error.TIMEOUT:
                    alert("Permintaan untuk mendapatkan lokasi pengguna telah habis waktu.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Terjadi kesalahan yang tidak diketahui.");
                    break;
            }
        }

        window.onload = getLocation;
    </script>

    <style>
        #map {
            height: 180px; /* Tinggi peta */
            width: 100%;
        }

        #results {
            max-height: 400px; /* Batas tinggi untuk area hasil */
            overflow-y: auto; /* Mengaktifkan scroll vertikal */
            margin-top: 20px; /* Jarak atas */
            border: 1px solid #ccc; /* Tambahkan batas */
            border-radius: 5px; /* Membulatkan sudut */
            padding: 10px; /* Ruang di dalam area hasil */
        }

        .btn-primarys {
            background-color: #FFE0B5; /* Warna latar belakang */
            color: #0E2473; /* Warna teks */
            border: none; /* Hapus batas tombol default */
        }
    </style>
</body>

</html>
