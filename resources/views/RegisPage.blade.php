<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Registantrekuy.css">
    <link rel="shortcut icon" href="{{ asset('assets/logo-tab.png') }}">
</head>

<body>

    <body>
        <div class="navbar">
            <a href="/"><img src="assets/back-icon.png" alt=""></a>
            <div class="logoNavbar">
            </div>
        </div>
    </body>

    <section class="h-100 gradient-form">
        <div class="container py-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="text-black">
                        <div class="row g-0">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="logoSection">
                                    <!-- <h4 class="mt-1 mb-5 pb-1">We are AntreKuy</h4> -->
                                </div>

                                <form action="{{ url('/Register') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form3">
                                        <img class="img-profile" src="assets/Profile.svg">&ensp;&ensp;<label
                                            class="form-label" for="name">Nama</label>
                                        <input name="name" type="text" id="name" class="form-control"
                                            placeholder="" />
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="form4">
                                        <img class="img-business" src="assets/Business.svg">&ensp;&ensp;<label
                                            class="form-label" for="nama_usaha">Nama Usaha</label>
                                        <input name="nama_usaha" type="text" id="nama_usaha" class="form-control" />
                                        @error('nama_usaha')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="form5">
                                        <img class="img-email" src="assets/Email.svg">&ensp;&ensp;<label
                                            class="form-label" for="email">Email</label>
                                        <input name="email" type="email" id="email" class="form-control" />
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="form6">
                                        <img class="img-password" src="assets/Password.svg">&ensp;&ensp;<label
                                            class="form-label" for="password">Password</label>
                                        <input name="password" type="password" id="password" class="form-control"
                                            required />
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="form7">
                                        <img class="img-password" src="assets/Password.svg">&ensp;&ensp;<label
                                            class="form-label" for="confirm_password">Konfirmasi Password</label>
                                        <input name="password_confirmation" type="password" id="password"
                                            class="form-control" required />
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </div>

                                    <div class="button-masuk">
                                        <input class="btn-masuk btn-lg" type="submit" value="Daftar">
                                    </div>

                                    <div class="button-google">
                                        <!-- <button type="button" class="btn-masuk btn-lg"><a
                                                href="">Masuk</a></button> -->
                                        <button class="btn-google btn btn-lg">
                                            <img class="img-google" src="assets/img-google-.png">
                                            <a href="auth/redirect">Login With Google </a></button>

                                    </div>

                                    <div class="textCheckAkun">
                                        <a class="textCheckAkun1" href="/loginPage">Sudah punya akun?</a>
                                    </div>

                                    <br>
                                    <br>
                                    <br>
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
