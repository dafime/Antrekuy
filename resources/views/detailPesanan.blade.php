<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Info Antrean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('InfoAntrian.css')}}">
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
                                        Antre {{$antrian_usaha->namaantrian}}
                                    </h2>
                                </div>

                                <br>

                                <div class="container-home">
                                    <div class="ket-antri">
                                        <br><br>
                                        <h3 class="txt-numantrian">No. Antrean ke : {{$pesanan->noantrian}}</h3>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form>
            <div class="form">
                <div class="form-nama">
                    <label class="form-label" for=""><b>Nama</b></label>
                    <div class="space-Text-Check">
                        {{$pesanan->nama_pembeli}}
                    </div>
                </div>

                <div class="form-pesanan">
                    <label class="form-label" for=""><b>{{$antrian_usaha->pertanyaan1}}</b></label>
                    <div class="space-Text-Check">
                        {{$pesanan->Jawaban1}}
                    </div>
                </div>
                <div class="form-pesanan">
                    <label class="form-label" for=""><b>{{$antrian_usaha->pertanyaan2}}</b></label>
                    <div class="space-Text-Check">
                        {{$pesanan->Jawaban2}}
                    </div>
                </div>
                <div class="form-pesanan">
                    <label class="form-label" for=""><b>{{$antrian_usaha->pertanyaan3}}</b></label>
                    <div class="space-Text-Check">
                        {{$pesanan->Jawaban3}}
                    </div>
                </div>
            </div>
        </form>
        <br>
        <br>
        <div class="button-keluar">
            <button type="button" class="btn-keluar btn-lg"><a href="/daftarantrian/{{$antrian_usaha->id}}">Kembali</a></button>
        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');
    </style>

</body>

</html>
