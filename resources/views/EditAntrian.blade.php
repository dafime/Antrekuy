<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settings Antrian Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('editAntrian.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/logo-tab.png') }}">

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuRq7PLwzPEh-o7gDy7yqLSXNZD5reSds&callback=initMap" async defer></script>
    <script>
        let map, marker, geocoder;

        function initMap() {
            const defaultLocation = { lat: -34.397, lng: 150.644 };
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 6,
            });
            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
            });

            geocoder = new google.maps.Geocoder();
            getUserLocation();
        }

        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;

            document.getElementById('latitudeInput').value = lat;
            document.getElementById('longitudeInput').value = lon;

            const userLocation = { lat: lat, lng: lon };
            map.setCenter(userLocation);
            marker.setPosition(userLocation);
            map.setZoom(14);

            geocodeLatLng(geocoder, map, userLocation);
        }

        function geocodeLatLng(geocoder, map, location) {
            geocoder.geocode({ location: location }, (results, status) => {
                if (status === "OK") {
                    if (results[0]) {
                        document.getElementById('street').textContent = results[0].formatted_address;
                        document.getElementById('streetInput').value = results[0].formatted_address;
                    } else {
                        console.log("No results found");
                    }
                } else {
                    console.log("Geocoder failed due to: " + status);
                }
            });
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("Akses lokasi ditolak. Butuh akses lokasi/GPS.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Gagal memperoleh informasi lokasi.");
                    break;
                case error.TIMEOUT:
                    alert("Gagal: Request Timeout.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>


</head>

<body>

    <body>
        <nav class="navbar">
            <div class="logoNavbar">
            </div>
        </nav>
    </body>

    <section class="h-100 gradient-form" style="background-color: #FFFDF4;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="text-black">
                        <div class="row g-0">
                            <div class="card-body p-md-5 mx-md-4">
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif

                                <div class="daftar">
                                    <h4 class="textDaftar">Pengaturan Antrian</h4>
                                    <a class="textMoreDaftar">Pengaturan sistem antrian digital</a>
                                </div>

                                <form action="/editAntrian/{{$antrian_usaha->id}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    {{method_field('PUT')}}
                                    <div class="form3">
                                        <label class="form-label" for="form2Example11">Nama Antrian</label>
                                        <div class="space-Text-Check">
                                            <input name="nama_antrian" type="text" id="nama_antrian" class="form-control-questOld" placeholder="" value="{{$antrian_usaha->namaantrian}}" />
                                        </div>
                                    </div>

                                    <div class="form4">
                                        <label class="form-label" for="form2Example22">Alokasi Waktu Antrian per Orang
                                            (Menit)</label>
                                        <a class="pesan">*untuk est.lama antrian</a>
                                        <!-- <input type="" id="form2Example22" class="form-control" /> -->
                                    </div>

                                    <div class="pick-time">
                                        <div class="radius">
                                            <!-- <span class="minus">-</span> -->
                                            <input name="alokasi_waktu" class="number" type="number" id="alokasi_waktu" value="{{$antrian_usaha->time}}" min="1">
                                            <!-- <span class="plus">+</span> -->
                                        </div>
                                    </div>

                                    <div class="form5">
                                        <label class="form-label" for="form2Example22">Formulir Pertanyaan (untuk diisi
                                            pelanggan)</label>
                                        <a class="pesan">*pilih yang perlu saja</a>
                                        <!-- <input type="" id="form2Example22" class="form-control" /> -->
                                    </div>

                                    <div class="form6">
                                        <label class="form-label">Pertanyaan 1</label>
                                        <div class="space-Text-Check">
                                            <input name="pertanyaan1" type="text" id="pertanyaan1" class="form-control-quest" value="{{$antrian_usaha->pertanyaan1}}"/>
                                            <!-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"></label>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="form7">
                                        <label class="form-label">Pertanyaan 2</label>
                                        <div class="space-Text-Check">
                                            <input name="pertanyaan2" type="text" id="pertanyaan2" class="form-control-quest" value="{{$antrian_usaha->pertanyaan2}}" />
                                            <!-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"></label>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="form8">
                                        <label class="form-label">Pertanyaan 3</label>
                                        <div class="space-Text-Check">
                                            <input name="pertanyaan3" type="text" id="pertanyaan3" class="form-control-quest" value="{{$antrian_usaha->pertanyaan3}}" />
                                            <!-- <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"></label>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="form4">
                                        <label class="form-label" for="form2Example22">Lokasi Usaha</label>
                                        <a class="pesan">Anda harus berada pada lokasi usaha.</a>
                                        <!-- <input type="" id="form2Example22" class="form-control" /> -->
                                    </div>

                                    {{-- <div class="form9">
                                        <label class="form-label" for="form2Example22">Pinpoint Lokasi Usaha</label>
                                        <!-- <input type="" id="form2Example22" class="form-control" /> -->
                                    </div> --}}

                                    <div class="card map-card">
                                        <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 400px;">
                                            <div id="map" style="height: 400px; width: 100%;"></div>
                                        </div>
                                    </div>

                                    <div class="form10">
                                        <label class="form-label" for="form2Example22">Lokasi Usaha terekam secara otomatis.</label>

                                        <div class="space-Text-Check">
                                            <div type="hidden" id="map"></div>
                                            <input type="hidden" id="latitudeInput" name="latitudeInput" value="latitude">
                                            <input type="hidden" id="longitudeInput" name="longitudeInput" value="longitude">
                                        </div>
                                    </div>

                                    <div class="button-masuk">
                                        <input type="submit" class="btn-masuk btn-lg" style="color: white;" value="Simpan">
                                    </div>

                                    <div class="button-batal">
                                        <button type="button" class="btn-batal btn-lg"><a href="/daftarantrian/{{$antrian_usaha->id}}">Batal</a></button>
                                    </div>

                                    <div class="button-qr">
                                        <button type="button" class="btn-qr btn-lg"><a href="/downloadQR/{{$antrian_usaha->id}}">Lihat QR Code</a></button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
