<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="EditProfileantrekuy.css">
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
        <div class="container py-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="text-black">
                        <div class="row g-0">
                            <div class="card-body p-md-5 mx-md-4">

                                <div style="color: #C9AF97; font-weight:bold; font-size:30px;">Edit Profile</div>
                                <div style="color:#A9A9A9;">Ubah Profil Pemilik Usaha</div>
                                <br><br><br>

                                <form>
                                    <div class="form3">
                                        <img class="img-profile" src="assets/Profile.svg">&ensp;&ensp;<label class="form-label" for="form2Example11">Nama</label>
                                        <input type="email" id="form2Example11" class="form-control" placeholder="" />
                                    </div><br>

                                    <div class="form4">
                                        <img class="img-business" src="assets/Business.svg">&ensp;&ensp;<label class="form-label" for="form2Example22">Nama Usaha</label>
                                        <input type="text" id="form2Example22" class="form-control" />
                                    </div><br>

                                    <div class="form5">
                                        <img class="img-email" src="assets/Email.svg">&ensp;&ensp;<label class="form-label" for="form2Example22">Email</label>
                                        <input type="email" id="form2Example22" class="form-control" />
                                    </div><br><br>

                                    <div class="button-masuk">
                                        <button type="button" class="btn-masuk btn-lg"><a href="">Simpan</a></button>
                                    </div><br>

                                    <div class="button-batal">
                                        <button type="button" class="btn-batal btn-lg"><a href="">Batal</a></button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>