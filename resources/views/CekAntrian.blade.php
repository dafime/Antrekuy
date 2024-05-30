<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cek Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('CekAntrian.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/logo-tab.png') }}">
</head>

<body>

    <body>
        <nav class="navbar">
            <div class="logoNavbar">
            </div>
        </nav>
    </body>

    <section class="section-up h-100 gradient-form">
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
                                        <h3 class="txt-numantrian">No. Antrian Saat Ini: 017</h3>
                                        <div>Est. Waktu Tunggu: 18 Menit</div>
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
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');
    </style>

</body>

</html>