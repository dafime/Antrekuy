<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cek Antrian</title>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('CekAntrian.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/logo-tab.png') }}">

    <script>
        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            var usahaLat = {{$AntrianUsaha->latitude}};
            var usahaLon = {{$AntrianUsaha->longitude}};
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            // //Display the coordinates in the view
            // document.getElementById('latitude').textContent = lat;
            // document.getElementById('longitude').textContent = lon;
            // document.getElementById('latitude1').textContent = usahaLat;
            // document.getElementById('longitude1').textContent = usahaLon;

            var jarak = hitungJarak(usahaLat, usahaLon, lat, lon);

            if(jarak > 10){
                $(document).ready(function() {
                    $('#popupLokasi').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    $('#popupLokasi').modal('show');
                });
            }



        }

        function hitungJarak(lat1, lon1, lat2, lon2){
            var hasilJarak = Math.acos(Math.sin(lat1)*Math.sin(lat2)+Math.cos(lat1)*Math.cos(lat2)*Math.cos(lon2-lon1))*637;
            return hasilJarak;
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }


        window.onload = getUserLocation;


    </script>


</head>

<body>

    <body>
        <nav class="navbar">
            <div class="logoNavbar">
            </div>
        </nav>
    </body>

    {{-- popup box kalau pelanggan gak di lokasi --}}
    <div class="modal fade" id="popupLokasi" role="dialog" aria-labelledby="popupLokasiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    Anda <b>TIDAK</b> berada di lokasi {{$AntrianUsaha->namaantrian}}.
                    <br><br><br>
                    Silahkan menuju lokasi {{$AntrianUsaha->namaantrian}} dan refresh halaman ini.
                </div>

            </div>
        </div>
    </div>
{{--abis--}}


    <section class="section-up h-100 gradient-form">
        {{-- <div>
            <p id="latitude"></p>
            <p id="longitude"></p>
            <p id="latitude1"></p>
            <p id="longitude1"></p>
        </div> --}}
            @if (session()->has('message'))
                <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
            @endif
        @if ($AntrianUsaha->antrianaktif == true)
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="text-black">
                        <div class="row g-0">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="nama-profile" style="color: #303030;">
                                    <h2 class="nama-usaha">
                                        {{$AntrianUsaha->namaantrian}}
                                    </h2>
                                </div>

                                <br>

                                <div class="container-home">
                                    <div class="ket-antri">
                                        <h3 class="txt-numantrian">@if(is_null($pesanan_id))
                                            Saat ini Tidak Ada Antrian
                                            @else
                                            No. Antrian Saat Ini:
                                            {{$pesanan_id}}
                                            @endif
                                        </h3>
                                        <?php $i = 1 ?>
                                        <div>Est. Waktu Tunggu: @foreach ($pesanan as $items)
                                            <?php $i++ ?>
                                            @endforeach
                                            <?= $i * $AntrianUsaha->time ?> Menit
                                        </div>
                                        <br>
                                        <div>Anda berada di lokasi {{$user->nama_usaha}}</div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="/CekAntrian/{{$AntrianUsaha->id}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form">
                <div class="form-nama">
                    <label class="form-label" for="">Nama</label>
                    <div class="space-Text-Check">
                        <input name="nama" type="text" id="nama" class="form-control-nama" placeholder="" />
                    </div>
                </div>

                @if (!is_null($AntrianUsaha->pertanyaan1))
                <div class="form-pesanan">
                    <label class="form-label" for="">{{$AntrianUsaha->pertanyaan1}}</label>
                    <div class="space-Text-Check">
                        <input name="jawaban1" type="jawaban1" id="jawaban1" class="form-control-nama" placeholder="" />
                    </div>
                </div>
                @endif

                @if(!is_null($AntrianUsaha->pertanyaan2))
                <div class="form-pesanan">
                    <label class="form-label" for="">{{$AntrianUsaha->pertanyaan2}}</label>
                    <div class="space-Text-Check">
                        <input name="jawaban2" type="jawaban2" id="jawaban2" class="form-control-nama" placeholder="" />
                    </div>
                </div>
                @endif

                @if(!is_null($AntrianUsaha->pertanyaan3))
                <div class="form-pesanan">
                    <label class="form-label" for="">{{$AntrianUsaha->pertanyaan3}}</label>
                    <div class="space-Text-Check">
                        <input name="jawaban3" type="jawaban3" id="jawaban3" class="form-control-nama" placeholder="" />
                    </div>
                </div>
                @endif

            </div>
            <div class="button-masuk">
                <input class="btn-masuk btn-lg" type="submit" value="Masuk Antrian" style="color:white;">
            </div>
        </form>
        <div class="pesan-penting">
            <p style="text-decoration: underline">PENTING:</p>
            <p>Aplikasi AntreKuy merupakan perantara yang membantu komunikasi anatara pemilik usaha dengan pelanggan.
            </p>
            <p>Pastikan Anda hadir sesaat nomor antrian Anda dipanggil. Kelalaian dari sisi pelanggan yang mengggangu
                hak pelanggan lain sehingga dikeluarkan dari antrian bukanlah tanggung jawab AntreKuy.</p>
        </div>

        @else

        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="text-black">
                        <div class="row g-0">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="nama-profile" style="color: #303030;">
                                    <h2 class="nama-usaha">
                                        {{$AntrianUsaha->namaantrian}}
                                    </h2>
                                </div>

                                <br>

                                <div class="container-home">
                                    <div class="ket-antri">
                                        <h3 class="txt-numantrian">No. Antrian Saat Ini: {{$pesanan_id}}</h3>
                                        <?php $i = 1 ?>
                                        <div>Est. Waktu Tunggu: @foreach ($pesanan as $items)
                                            <?php $i++ ?>
                                            @endforeach
                                            <?= $i * $AntrianUsaha->time ?> Menit
                                        </div>
                                        <br>
                                        <div>Anda berada di lokasi {{$user->nama_usaha}}</div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <h1 style="color: #d8604e; text-align: center;">Antrian Sedang Dihentikan</h1>
        <br>
        <div class="pesan-penting">
            <p style="text-decoration: underline">PENTING:</p>
            <p>Aplikasi AntreKuy merupakan perantara yang membantu komunikasi anatara pemilik usaha dengan pelanggan.
            </p>
            <p>Pastikan Anda hadir sesaat nomor antrian Anda dipanggil. Kelalaian dari sisi pelanggan yang mengggangu
                hak pelanggan lain sehingga dikeluarkan dari antrian bukanlah tanggung jawab AntreKuy.</p>
        </div>
        @endif
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');
    </style>

</body>

</html>
