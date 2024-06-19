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
                <form id="dateForm" action="/pdf/{{ Auth::user()->id }}" method="GET" enctype="multipart/form-data">
                    @csrf
                    <div class="form-popup">
                        <input name="date" type="date" id="date" class="form-control" />
                        @error('date')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="button-masuk-popup">
                        <button id="submitButton" class="btn-masuk-popup btn-lg" type="button">Unduh</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('submitButton').addEventListener('click', function() {
            var date = document.getElementById('date').value;
            var userId = "{{ Auth::user()->id }}";
            var url = "/pdf/" + userId + "/" + date;
            window.location.href = url;
        });
    });
</script>

</html>
