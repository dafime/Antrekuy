<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('Laporanantrekuy.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/logo-tab.png') }}">
</head>

<body>

    <body>
        <nav class="navbar">
        <a href="/home"><img src="{{ asset('assets/back-icon.png')}}" alt=""></a>
            <div class="logoNavbar">
            </div>
        </nav>
    </body>

    <div class="popup">
        <div class="card-popup" style="width: 23rem; height: 15rem">
            <div class="card-body">
                <h5 class="card-popup-title">Pilih Tanggal Laporan Yang Ingin Dilihat</h5>
                <form action="/updateProfileNamaUsaha/{{ Auth::user()->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-popup">
                        <!-- <img class="img-business" src="assets/Business.svg">&ensp;&ensp;<label class="form-label" for="nama_usaha">Nama Usaha</label> -->
                        <input name="date" type="date" id="date" class="form-control" />
                        @error('nama_usaha')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="button-masuk-popup">
                        <input class="btn-masuk-popup btn-lg" type="submit" value="Unduh">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>