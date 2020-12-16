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
      session_start();
      $user = "";

      if (!isset($_SESSION["user"]) || !isset($_SESSION["pass"])) {
        header("Location: index.php?error=access_denied");

      } else {
        $user = $_SESSION["user"];

      }

      if(!empty($_POST["logout"])) { 
        logout(); 
      
      }

      function test_input ($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;

      }

      function logout() {
        session_unset();
        //unset($_SESSION["user"]);
        //unset($_SESSION["password"]);
        
        session_destroy();
        header('Location: index.php');
      }


    ?>
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand disabled" id="greeting"><?php echo ("Você está logado como Médico. Olá, ".$user); ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarsExample01">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="self_edit_md.php#" id="nav-link">Alterar cadastro</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register_app.php#" id="nav-link">Cadastrar consulta</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="list_apps.php#" id="nav-link">Listar consultas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="list_pac_md.php#" id="nav-link">Listar pacientes</a>
          </li>
          <li class="nav-item">
            <form id="logoutForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
              <input type="hidden" name="logout" value="error"/>
              <a class="nav-link" href="#" id="nav-link" onclick="this.closest('form').submit(); return false;"><b>Logout</b></a>
            </form>
          </li>
        </ul>
      </div>
    </nav>