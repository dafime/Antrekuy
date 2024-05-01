<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Loginantrekuy.css">
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

                                <div class="logoSection">
                                    <!-- <h4 class="mt-1 mb-5 pb-1">We are AntreKuy</h4> -->
                                </div>

                                <form>
                                    <div class="form1">
                                        <img class="img-email" src="assets/Email.svg">&ensp;&ensp;<label class="form-label" for="form2Example11">Email</label>
                                        <input type="email" id="form2Example11" class="form-control" placeholder="" />

                                    </div>

                                    <br>

                                    <div class="form2">
                                        <img class="img-password" src="assets/Password.svg">&ensp;&ensp;<label class="form-label" for="form2Example22">Password</label>
                                        <input type="password" id="form2Example22" class="form-control" />
                                    </div>
                                    
                                    <div class="textFP">
                                        <a class="textfp1" href="#!">Lupa password?</a>
                                    </div>

                                    <!-- <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                            type="button">Log
                                            in</button>
                                        <a class="text-muted" href="#!">Forgot password?</a>
                                    </div> -->
                                    <br><br>
                                    <div class="button-masuk">
                                        <button type="button" class="btn-masuk btn-lg"><a
                                                href="">Masuk</a></button>
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
