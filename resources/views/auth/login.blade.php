<!doctype html>
<html lang="en">

<head>
    <title>Iniciar Sesión</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="resources/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #ececec;
        }

        .box-area {
            width: 930px;
        }

        .right-box {
            padding: 40px 30px 40px 40px;
        }

        ::placeholder {
            font-size: 16px;
        }

        @media only screen and (max-width: 768px) {
            .box-area {
                margin: 0 10px;
            }

            .left-box {
                height: 100px;
                overflow: hidden;
            }

            .right-box {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background: #fff">
                <div class="featured-image mb-3">
                    <!-- Reemplaza 'ruta_de_la_imagen' con la ruta correcta de tu imagen -->
                    <img src="{{ asset('img/geotournicalogo.jpg') }}" class="img-fluid" alt="Logo">

                </div>
                <p class="text-white fs-2"
                    style="font-family: courier new, courier, monospace; font-weight: 600;">SMARTNET</p>
                <small class="text-white text-wrap text-center"
                    style="width: 17rem; font-family: courier new, courier, monospace;"></small>
            </div>
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h5>Inicio de Sesión | GeoTourNica</h5>
                    </div>
                    <form action="{{ route('login') }}" method="post" class="w-100">
                        @csrf
                        @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            Las credenciales ingresadas no son válidas.
                        </div>
                        @endif
                    
                        @if ($errors->has('password'))
                        <div class="alert alert-danger">
                            La contraseña ingresada no es válida.
                        </div>
                        @endif
                    
                        @if ($errors->has('Inactivo'))
                        <div class="alert alert-danger">
                            {{ $errors->first('Inactivo') }}
                        </div>
                        @endif
                    
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6"
                                placeholder="Correo Electrónico" name="email">
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control form-control-lg bg-light fs-6"
                                placeholder="password" name="password" id="password">
                        </div>
                        <div class="input-group mb-5 d-flex align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="togglePassword()">
                                <label class="form-check-label text-secondary" for="exampleCheck1"><small>Ver</small></label>
                            </div>
                            <div class="forgot ms-auto">
                                <small><a href="#">¿Olvidaste la Contraseña?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Iniciar Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</body>

</html>
