<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('Homeantrekuy.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/logo-tab.png') }}">
</head>

<body>

    <body>
        <nav class="navbar">
            <div class="logoNavbar">
            </div>
        </nav>
    </body>
    @if (is_null(Auth::user()->nama_usaha))
    <div class="popup">
        <div class="card-popup" style="width: 23rem; height: 15rem">
            <div class="card-body">
                <h5 class="card-popup-title">Mari Isi Nama Usaha Kamu</h5>
                <form action="/updateProfileNamaUsaha/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-popup">
                        <img class="img-business" src="assets/Business.svg">&ensp;&ensp;<label class="form-label" for="nama_usaha">Nama Usaha</label>
                        <input name="nama_usaha" type="text" id="nama_usaha" class="form-control" />
                        @error('nama_usaha')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="button-masuk-popup">
                        <input class="btn-masuk-popup btn-lg" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
    <section class="h-100 gradient-form">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="text-black">
                        <div class="row g-0">
                            <div class="card-body p-md-5 mx-md-4">
                                <div class="nama-profile">
                                    {{ Auth::user()->name }}
                                    <!-- <div>
                                        <a href="/editprofile/{{ Auth::user()->id }}" style="text-decoration: none; color:#303030; padding-right:7px;"><u>Profile</u></a>
                                        <a href="/logout" style="text-decoration: none; color:#f25050;"><u>Keluar</u></a>
                                    </div> -->
                                </div>

                                <h2 class="nama-usaha" style="text-transform:uppercase;">
                                    {{ Auth::user()->nama_usaha }}
                                </h2>

                                <br>

                                <div class="container-home">
                                    <div class="container-home-header" style="text-transform:uppercase;">ANTRE
                                        {{ Auth::user()->nama_usaha }}
                                    </div>
                                    <div class="ket-antri">
                                        @foreach($pesanan as $item)
                                        @if(is_null($item->noantrian))
                                        <h2 style="color: #303030;">
                                            Belum Ada Antrean
                                        </h2>
                                        Klik "Lihat Antrean" untuk Setup Antrean terlebih dahulu.
                                        @else
                                        <div class="txt-numantrian">No. Antrean:
                                            {{$item->noantrian}}
                                        </div>
                                        <div>Status:
                                            @if ($antrian_usaha->antrianaktif==1)
                                            Aktif
                                            @else
                                            Tidak Aktif
                                            @endif
                                        </div>
                                        <?php $i = 0 ?>
                                        <div>Jumlah Antrean Sekarang: @foreach ( $semua_pesanan as $items )
                                            <?php $i++ ?>
                                            @endforeach
                                            <?= $i ?>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="button-profile">
            <button type="button" class="btn-profile btn-lg"><a href="/editprofile/{{ Auth::user()->id }}">Profile</a></button>
        </div>

        <br>

        <div class="button-antrian">
            <button type="button" class="btn-antrian btn-lg"><a href="/setupAntrian/{{Auth::user()->id}}">Lihat Antrean</a></button>
        </div>

        <br>

        <div class="button-report">
            <button type="button" class="btn-report btn-lg"><a href="/laporan">Report Harian Antrean</a></button>
        </div>

        <br>
        <br>
        <br>

        <div class="button-logout">
            <button type="button" class="btn-logout btn-lg"><a href="/logout">Logout</a></button>
        </div>
        <br>
    </section>
    @endif

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');
    </style>

</body>

</html>
