<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settings Antrian Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="setupAntrian.css">
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

                                <div class="daftar">
                                    <h4 class="textDaftar">Edit Settings Antrian</h4>
                                    <a class="textMoreDaftar">Pengaturan sistem antrian digital</a>
                                </div>

                                <form>
                                    <div class="form3">
                                        <label class="form-label" for="form2Example11">Nama Antrian</label>
                                        <div class="space-Text-Check">
                                            <input type="" id="form2Example11" class="form-control-questOld"
                                                placeholder="" />
                                        </div>
                                    </div>

                                    <div class="form4">
                                        <label class="form-label" for="form2Example22">Alokasi Waktu Antrian per Orang
                                            (Menit)</label>
                                        <a class="pesan">*untuk est.lama antrian</a>
                                        <!-- <input type="" id="form2Example22" class="form-control" /> -->
                                    </div>

                                    <div class="pick-time">
                                        <div class="radius">
                                            <span class="minus">-</span>
                                            <span class="number">1</span>
                                            <span class="plus">+</span>
                                        </div>
                                    </div>

                                    <div class="form5">
                                        <label class="form-label" for="form2Example22">Formulir Pertanyaan (untuk diisi
                                            pelanggan)</label>
                                        <a class="pesan">*pilih yang perlu saja</a>
                                        <!-- <input type="" id="form2Example22" class="form-control" /> -->
                                    </div>

                                    <div class="form6">
                                        <label class="form-label">Pertanyaan 1</label>
                                        <div class="space-Text-Check">
                                            <input type="" class="form-control-quest" />
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form7">
                                        <label class="form-label">Pertanyaan 2</label>
                                        <div class="space-Text-Check">
                                            <input type="" class="form-control-quest" />
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form8">
                                        <label class="form-label">Pertanyaan 3</label>
                                        <div class="space-Text-Check">
                                            <input type="" class="form-control-quest" />
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form9">
                                        <label class="form-label" for="form2Example22">Pinpoint Lokasi Usaha</label>
                                        <!-- <input type="" id="form2Example22" class="form-control" /> -->
                                    </div>

                                    <div class="card map-card">
                                        <div id="map-container-google-1" class="z-depth-1-half map-container"
                                            style="height: 500px;">
                                            <iframe
                                                src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                                frameborder="0" style="border:0" allowfullscreen></iframe>
                                        </div>
                                    </div>

                                    <div class="form10">
                                        <label class="form-label" for="form2Example22">Lokasi</label>
                                        <div class="space-Text-Check">
                                            <input type="" id="form2Example11" class="form-control-questOld"
                                                placeholder="" />
                                        </div>
                                    </div>

                                    <div class="button-masuk">
                                        <button type="button" class="btn-masuk btn-lg"><a href="">Simpan</a></button>
                                    </div>

                                    <div class="button-batal">
                                        <button type="button" class="btn-batal btn-lg"><a href="">Batal</a></button>
                                    </div>

                                    <div class="button-qr">
                                        <button type="button" class="btn-qr btn-lg"><a href="">Lihat QR Code</a></button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const plus = document.querySelector(".plus"),
            minus = document.querySelector(".minus"),
            number = document.querySelector(".number");

        let a = 1;
        plus.addEventListener("click", () => {
            if (a <= 9) {
                a++;
                a = (a < 10) ? a : a;
                number.innerText = a;
                console.log(a);
            }
        });

        minus.addEventListener("click", () => {
            if (a > 1) {
                a--;
                a = (a < 10) ? a : a;
                number.innerText = a;
            }
        });
    </script>
</body>

</html>