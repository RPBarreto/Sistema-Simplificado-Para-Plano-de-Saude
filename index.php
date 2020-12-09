<!doctype html>
<html lang>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
   
    <link href="floating-labels.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css.css" rel="stylesheet">
  </head>

  <body class="bg-light">
    <form class="needs-validation" novalidate method="post" action="home_admin.php">
      <div class="text-center mb-4">
        <img class="mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal"></h1>
        
      </div>

      <div class="form-label-group">
        <input type="email" id="inputUser" name="user" class="form-control" placeholder="E-mail" required autofocus>
        <label for="inputUser">Usuário</label>
        <div class="invalid-feedback">
          Insira um endereço de e-mail válido
        </div>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Senha" required>
        <label for="inputPassword">Senha</label>
        <div class="invalid-feedback">
          Insira uma senha
        </div>
      </div>

      <input class="btn btn-lg btn-primary btn-block" type="submit" value="Entrar" role="button" />
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2020-2020</p>
    </form>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="form-validation.js"></script></body>
</html>

<!--
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
   
    <link href="floating-labels.css" rel="stylesheet">
</head>
  <body>
    <form class="form-signin" method="post" action="header_admin.php">
      <div class="text-center mb-4">
        <img class="mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal"></h1>
      </div>

      <div class="form-label-group">
        <input type="email" id="inputUser" name="user" class="form-control" placeholder="Usuário" required autofocus>
        <label for="inputUser">Usuário</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Usuário" required>
        <label for="inputPassword">Senha</label>
      </div>

      <input class="btn btn-lg btn-primary btn-block" type="submit" value="Entrar" role="button" />
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2020-2020</p>
    </form>
  </body>
</html>
-->