<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('EditProfileantrekuy.css')}}">
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
                                @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                @endif

                                <div style="color: #C9AF97; font-weight:bold; font-size:30px;">Edit Profile</div>
                                <div style="color:#A9A9A9;">Ubah Profil Pemilik Usaha</div>
                                <br><br><br>

                                <form action="/updateProfile/{{$user->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    {{method_field('PUT')}}
                                    <div class="form3">
                                        <img class="img-profile" src="{{asset('assets/Profile.svg')}}">&ensp;&ensp;<label class="form-label" for="name">Nama</label>
                                        <input name="name" type="text" id="name" class="form-control" placeholder="" />
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                    </div><br>

                                    <div class="form4">
                                        <img class="img-business" src="{{asset('assets/Business.svg')}}">&ensp;&ensp;<label class="form-label" for="nama_usaha">Nama Usaha</label>
                                        <input name="nama_usaha" type="text" id="nama_usaha" class="form-control" />
                                        @error('nama_usaha')
                                        {{ $message }}
                                        @enderror
                                    </div><br>

                                    <div class="button-masuk">
                                        <input class="btn-masuk btn-lg" type="submit" value="Simpan"></input>
                                    </div><br>

                                    <div class="button-batal">
                                        <button type="button" class="btn-batal btn-lg"><a href="/home">Batal</a></button>
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
