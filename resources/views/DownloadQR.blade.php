<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download QR Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="DownloadQR.css">
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

                                <div class="judul">
                                    <h4 class="textJudul">Antri Bakso Pak Kumis</h4>
                                </div>

                                <div class="card shadow border" style="border-radius: 50px;">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <img src="{{ URL::to('/') }}/assets/qrcode.png" class="img-fluid" />
                                    </div>
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <h3 class="card-text">SCAN UNTUK ANTRI</h3>
                                    </div>
                                    <div class="logocard d-flex flex-column align-items-center" style="margin-top: 1%">
                                        <div class="logocarded"></div>
                                        <br>
                                        <br>
                                    </div>
                                </div>

                                <div class="content2">
                                    <div class="text1">
                                        <p>QR Code ini akan digunakan pelanggan untuk masuk kedalam antrian</p>
                                    </div>

                                    <div class="text2">
                                        <p>Download, print dan tempel pada tembok/etalase</p>
                                    </div>
                                    <div class="buton">
                                        <div class="button-dwqr">
                                            <button type="button" class="btn-dwqr btn-lg"><a href="">Donwload
                                                    QR</a></button>
                                        </div>

                                        <div class="button-selesai">
                                            <button type="button" class="btn-selesai btn-lg"><a
                                                    href="">Selesai</a></button>
                                        </div>
                                    </div>
                                </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <!-- <section>
        <div class="container">
            <div class="row align-items-center vh-100">
                <div class="col-6 mx-auto">
                    <div class="card shadow border">
                        <div class="card-body d-flex flex-column align-items-center">
                            <img src="{{ URL::to('/') }}/assets/qrcode.png" class="img-fluid" />
                        </div>
                        <div class="card-body d-flex flex-column align-items-center">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content2">
                <div class="text1">
                    <p>QR Code ini akan digunakan pelanggan untuk masuk kedalam antrian</p>
                </div>

                <div class="text2">
                    <p>Download, print dan tempel pada tembok/etalase</p>
                </div>
                <div class="buton">
                    <div class="button-dwqr">
                        <button type="button" class="btn-dwqr btn-lg"><a href="">Donwload QR</a></button>
                    </div>

                    <div class="button-selesai">
                        <button type="button" class="btn-selesai btn-lg"><a href="">Selesai</a></button>
                    </div>
                </div>
            </div>
        </div>

    </section> -->

</body>

</html>
