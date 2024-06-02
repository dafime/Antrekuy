<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('DaftarAntrianantrekuy.css')}}">
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
                                        Antrian Sekarang
                                    </h2>
                                    <a href="" style="text-decoration: none; color:#303030;"><img src="assets/material-symbols_settings.svg" alt=""></a>
                                </div>

                                <br>
                                @foreach ( $pesanan_sudahdilayani as $items)
                                <div class="container-home">
                                    <div class="ket-antri">
                                        <h3 class="txt-numantrian">No. Antrian: {{$items->id}}</h3>
                                        <div>{{$items->CreatedDateTime}}</div>
                                        <div>Nama: {{$items->nama_pembeli}}</div>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-antrian">
            <button type="button" class="btn-antrian btn-lg"><a href="/panggilAntrian/{{$antrian_usaha_id}}/{{$pesanan_id}}">Panggil Antrian Berikutnya</a></button>
        </div>

        <br>

        <div class="button-pause">
            <button type="button" class="btn-pause btn-lg"><a href="">Pause Terima Antrian</a></button>
        </div>

    </section>

    <section>
        <br>
        <hr>
        <br>
        <div class="container-antrian">
            <h3 style="color:#C9AF97;">Daftar Antrian</h3>
            <br>

            @foreach ($listantrian as $items)
            <div class="container-daf-antrian">
                <div class="daf-antrian">
                    <h3 class="txt-numantrian" style="color: black;">No. Antrian: <?php echo $items->id ?></h3>
                    <div><?= $items->CreatedDateTime ?></div>
                    <div><?= $items->nama_pembeli ?></div>
                    <br>
                    <a href="/delete/{{$items->id}}" style="color: #d8604e;">Hapus dari Antrian</a>
                    &ensp; &ensp; &ensp; &ensp; &ensp;
                    <a href="/detailPesanan/{{$antrian_usaha_id}}/{{$items->id}}" style="color: black;">Detail Pesanan</a>
                </div>
            </div>
            <br>
            @endforeach
        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');
    </style>

</body>

</html>