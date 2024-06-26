<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="15">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Info Antrian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('InfoAntrian.css')}}">
    <link rel="shortcut icon" href="{{ asset('assets/logo-tab.png') }}">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    @foreach ($semua_pesanan as $items)
    @if ($items->id == $pesanan->id && $items->SudahDilayani == true && $pesanan_saatini_id == $pesanan->noantrian)

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('8438970b24259103393c', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('my-channel');
        channel.bind('form-submitted', function(data) {
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    console.log(data[key]);
                }
                alert(JSON.stringify(data[key]))
            }
        });
    </script>
    @elseif($items->id == $pesanan->id && $items->SudahDilayani == false && $pesanan_teratas == $pesanan->noantrian)
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('8438970b24259103393c', {
            cluster: 'ap1'
        });
        var channel = pusher.subscribe('my-channel');
        channel.bind('form-submitted', function(data) {
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    console.log(data[key]);
                }
                alert(JSON.stringify(data[key]))
            }
            // alert(JSON.stringify(data));
        });
    </script>
    @endif
    @endforeach
</head>

<body>

    <body>
        <nav class="navbar">
            <div class="logoNavbar">
            </div>
        </nav>
    </body>

    <section class="section-up h-100 gradient-form">
        @if (session()->has('keluar_failed'))
        <div class="alert alert-danger">
            {{ session()->get('keluar_failed') }}
        </div>
        @endif
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
                                        <h3 class="txt-numantrian">No. Antrean Anda: {{$pesanan->noantrian}}</h3>
                                        <div>{{$pesanan->CreatedDateTime}}</div>
                                        <?php $i = 0 ?>
                                        <?php $flag = 0 ?>
                                        <div>Est. Waktu Tunggu:
                                            @foreach ($semua_pesanan as $items)
                                            @if ($items->id == $pesanan->id && $items->SudahDilayani == true)
                                            <?php $flag = 1 ?>
                                            <?php break; ?>
                                            @endif
                                            @if ($items->SudahDilayani == false)
                                            <?php $i++ ?>
                                            @if ($items->id == $pesanan->id)
                                            <?php break; ?>
                                            @endif
                                            @endif
                                            @endforeach
                                            @if ($i == 0 && $flag == 1)
                                            Sekarang Giliran Anda
                                            @else
                                            <?= $i * $antrian_usaha->time ?> Menit
                                            @endif
                                        </div>
                                        <div>No Antrean Saat ini: {{$pesanan_saatini_id}}</div>
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
                    <label class="form-label" for="">Nama</label>
                    <div class="space-Text-Check">
                        {{$pesanan->nama_pembeli}}
                    </div>
                </div>

                <div class="form-pesanan">
                    <label class="form-label" for="">{{$antrian_usaha->pertanyaan1}}</label>
                    <div class="space-Text-Check">
                        {{$pesanan->Jawaban1}}
                    </div>
                </div>
                <div class="form-pesanan">
                    <label class="form-label" for="">{{$antrian_usaha->pertanyaan2}}</label>
                    <div class="space-Text-Check">
                        {{$pesanan->Jawaban2}}
                    </div>
                </div>
                <div class="form-pesanan">
                    <label class="form-label" for="">{{$antrian_usaha->pertanyaan3}}</label>
                    <div class="space-Text-Check">
                        {{$pesanan->Jawaban3}}
                    </div>
                </div>
            </div>
        </form>
        <div class="button-keluar">
            <button type="button" class="btn-keluar btn-lg"><a href="/keluarAntrian/{{$antrian_usaha->id}}/{{$pesanan->id}}">Keluar Antrean</a></button>
        </div>
        <div class="pesan-penting">
            <p style="text-decoration: underline">PENTING:</p>
            <p style="color: #C52828;">JANGAN TUTUP halaman ini selama Anda berada dalam antrean.</p>
            <p>Aplikasi AntreKuy merupakan perantara yang membantu komunikasi anatara pemilik usaha dengan pelanggan.
            </p>
            <p>Pastikan Anda hadir sesaat nomor antrean Anda dipanggil. Kelalaian dari sisi pelanggan yang mengggangu
                hak pelanggan lain sehingga dikeluarkan dari antrean bukanlah tanggung jawab AntreKuy.</p>
        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');
    </style>
</body>

</html>