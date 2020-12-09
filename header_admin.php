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
    <!-- Custom styles for this template -->
    <link href="css.css" rel="stylesheet">
  </head>

  <body class="bg-light">
    <?php 
      $user = "";
      
      if (!empty($_POST["user"])) {
        $user = test_input($_POST["user"]);
      
      }


      function test_input ($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;

      }
    ?>
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand disabled" id="greeting"><?php if (!empty($_POST["user"])) echo ("Você está logado como Admin. Olá, ".$user); ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarsExample01">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="register_md.php" id="nav-link">Cadastrar médico</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register_lab.php#" id="nav-link">Cadastrar laboratório</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register_pac.php#" id="nav-link">Cadastrar paciente</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="list_md.php#" id="nav-link">Listar médicos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php" id="nav-link"><b>Logout</b></a>
          </li>
        </ul>
      </div>
    </nav>
