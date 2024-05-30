<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="downloadQrCodeantrekuy.css">
    <link rel="shortcut icon" href="{{ asset('assets/logo-tab.png') }}">
</head>

<body>

    <body>
        <nav class="navbar">
            <div class="logoNavbar">
            </div>
        </nav>
    </body>

    <section class="h-100 gradient-form">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="text-black">
                        <div class="row g-0">
                            <div class="card-body p-md-5 mx-md-4">
                                <h2 class="nama-usaha">
                                    ANTRI BAKSO PAK KUMIS
                                </h2>

                                <div class="container-home">
                                    <div class="ket-antri">
                                        <br><br>
                                        {{ \SimpleSoftwareIO\QrCode\Facades\QrCode::size(250)->generate('http://127.0.0.1:8000/CekAntrian/'.Auth::user()->id) }}
                                        <h2 class="txt-numantrian">SCAN UNTUK ANTRI</h2>
                                        <br>
                                        <img class="logo-antrekuy" src="/assets/antrekuy_logodark.png" alt="">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="txt-download-qr-1">QR Code ini akan digunakan pelanggan untuk
            masuk ke dalam antrian</div>
        <br>
        <div class="txt-download-qr-2">Download, print, dan tempel di tembok/etalase</div>
        <div class="button-antrian">
            <button type="button" class="btn-antrian btn-lg"><a href="">Download QR Code</a></button>
        </div>

        <br>

        <div class="button-report">
            <button type="button" class="btn-report btn-lg"><a href="">Report Harian Antrian</a></button>
        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap');
    </style>

</body>

</html>
