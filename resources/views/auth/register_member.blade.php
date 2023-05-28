<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register Member</title>

    <!-- Custom fonts for this template-->
    <link href="/sbadmin2/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background-color: #E8E8CC">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="card o-hidden border-0 shadow-lg my-5" style="border-radius:30px">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="fas fa-fw fa-user" style="color:#FFCC1D; font-size:60px" ></h1>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                    </div>
                                    <br>
                                    @if (Session::has('errors'))
                                        <ul>
                                            @foreach (Session::get('errors') as $error)
                                                <li style="color:red">{{ $error[0] }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    
                                    <form class="form-login user" method="POST" action="/register_member">
                                        @csrf
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="nama_member">Nama Member :</label>
                                            <input required type="text" id="nama_member" placeholder="Nama Member" name="nama_member"
                                                class="form-control">  
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="no_hp">No. HP :</label>
                                            <input required type="text" id="no_hp" placeholder="No. HP" name="no_hp"
                                                class="form-control">  
                                        </div>   
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="email">E-mail :</label>
                                            <input required type="text" id="email" placeholder="youremail@example.com" name="email"
                                                class="form-control">  
                                        </div>              
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="password">Password :</label>
                                            <input required type="password" id="password" placeholder="Password" name="password"
                                                class="form-control">  
                                        </div>   
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="konfirmasi_password">Konfirmasi Password :</label>
                                            <input required type="password" id="konfirmasi_password" placeholder="Konfirmasi Password" name="konfirmasi_password"
                                                class="form-control">  
                                        </div>   
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg mt-2 col-lg-4" style="background-color: #FFCC1D; color:#0B4619">
                                            Register
                                            </button>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <span>Sudah Punya Akun? <a href="/login_member" class="text-blue-400 hover:text-blue-600">Login Disini</a></span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <footer style="background-color: #0B4619; position: absolute; bottom:0; width: 100%; ">
        <div class="text-center" style="color:#FFCC1D">ig: @mh.fdhlarhb</div>
    </footer>

    <!-- Bootstrap core JavaScript-->
    <script src="/sbadmin2/vendor/jquery/jquery.min.js"></script>
    <script src="/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/sbadmin2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/sbadmin2/js/sb-admin-2.min.js"></script>