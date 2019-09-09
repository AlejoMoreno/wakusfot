<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Parkapp
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body style="background-image: url(https://actualicese.com/_ig/img/fotos/parqueaderocarros.jpg);background-size: cover;">
  <div class="wrapper ">
    <div class="">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <h1>ParkApp</h1>
                  </div>
                </div>
                @if(session()->has('message')) 
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <i class="material-icons">close</i>
                    </button>
                    <span>
                      {{ session()->get('message') }} </span>
                  </div>
                @endif 
                <div class="card-body">
                    <form class="row" action="usuarios/loguin"  method="POST">
                      {{ csrf_field() }}
                        <div class="col-lg-12"><br>
                            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
                        </div>
                        <div class="col-lg-12"><br>
                            <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contraseña">
                        </div>
                        <div class="col-lg-12"><br>
                            <center>
                                <input type="submit" id="entrar" name="entrar" class="btn btn-success" value="Ingresar">
                            </center>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="#pablo">Olvido Contraseña</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
            </div>
          </div>
        </div>
      </div><br><br><br>
      <footer class="footer" style="background-color: white;">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="interconsis">
                  Interconsis / Wakusoft
                </a>
              </li>
              <li>
                <a href="acerca">
                  Nosotros
                </a>
              </li>
              <li>
                <a href="Licencia">
                  Licencia
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, hecho con <i class="material-icons">favorite</i> por
            <a href="https://wakusoft.com/" target="_blank">Interconsis / wakusoft</a>
          </div>
        </div>
      </footer>
    </div>
  </div>
</body>

</html>
