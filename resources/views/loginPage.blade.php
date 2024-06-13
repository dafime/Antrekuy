<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Loginantrekuy.css">
    <link rel="shortcut icon" href="{{ asset('assets/logo-tab.png') }}">
</head>

<body>

    <body>
        <nav class="navbar">
            <a href="/"><img src="assets/back-icon.png" alt=""></a>
            <div class="logoNavbar">
            </div>
        </nav>
    </body>

    <section class="h-100 gradient-form">
        @if (session()->has('login_failed'))
        <div class="alert alert-danger">
            {{ session()->get('login_failed') }}
        </div>
        @endif
        <div class="container py-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="text-black">
                        <div class="row g-0">
                            <div class="card-body p-md-5 mx-md-4">

                                <div class="logoSection">
                                    <!-- <h4 class="mt-1 mb-5 pb-1">We are AntreKuy</h4> -->
                                </div>

                                <form action="{{ url('/loginPage') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form1">
                                        <img class="img-email" src="assets/Email.svg">&ensp;&ensp;<label class="form-label" for="form2Example11">Email</label>
                                        <input name="email" type="email" id="email" class="form-control" placeholder="" />
                                        @error('email')
                                        {{ $message }}
                                        @enderror
                                    </div>

                                    <br>

                                    <div class="form2">
                                        <img class="img-password" src="assets/Password.svg">&ensp;&ensp;<label class="form-label" for="Password">Password</label>
                                        <input name="password" type="password" id="password" class="form-control" />
                                        @error('password')
                                        {{ $message }}
                                        @enderror
                                    </div>

                                    <!-- <div class="textFP">
                                        <a class="textfp1" href="#!">Lupa password?</a>
                                    </div> -->

                                    <!-- <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                            type="button">Log
                                            in</button>
                                        <a class="text-muted" href="#!">Forgot password?</a>
                                    </div> -->
                                    <br><br>
                                    <div class="button-masuk">
                                        <!-- <button type="button" class="btn-masuk btn-lg"><a
                                                href="">Masuk</a></button> -->
                                        <input class="btn-masuk btn btn-lg" type="submit" value="Masuk" />
                                    </div>

                                    <div class="button-google">
                                        <!-- <button type="button" class="btn-masuk btn-lg"><a
                                                href="">Masuk</a></button> -->
                                        <button class="btn-google btn btn-lg">
                                            <img class="img-google" src="assets/img-google-.png">
                                            <a href="auth/redirect">Login With Google </a></button>

                                    </div>

                                    <div class="textCheckAkun">
                                        <a class="textCheckAkun1" href="/Register">Belum punya akun?</a>
                                    </div>

                                    {{-- <div class="row mb-3">
                                        <div class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            <a href="auth/redirect" class="btn btn-google btn-user btn-block" >
                                                <i class="fab fa-google fa-fw"></i> Login with Google
                                            </a>
                                    </div> --}}

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