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

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h2>Lista de médicos</h2>
        </div>
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Sobrenome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Endereço</th>
            <th scope="col">Telefone</th>
            <th scope="col">Especialidade</th>
            <th scope="col">CRM</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $xml = simplexml_load_file("medicos.xml");

            for ($i = 0; $i < sizeof($xml); $i++) {
              echo "<tr>
                      <th scope='row'>".($i + 1)."</th>
                      <td>".$xml->medico[$i]->Name."</td>
                      <td>".$xml->medico[$i]->LastName."</td>
                      <td>".$xml->medico[$i]->Email."</td>
                      <td>".$xml->medico[$i]->Address."</td>
                      <td>".$xml->medico[$i]->Phone."</td>
                      <td>".$xml->medico[$i]->Expertise."</td>
                      <td>".$xml->medico[$i]->CRM."</td>
                      <td>
                        <form action='edit_md.php' method='GET'>
                          <input class='form-control' name='crm' type='hidden' value='".$xml->medico[$i]->CRM."' />
                          <input class='form-control' name='email' type='hidden' value='".$xml->medico[$i]->Email."' />
                          <button type='submit' class='btn btn-primary' name='submit'><b>Editar</b></button>  
                        </form>
                      
                      
                      </td>
                    </tr>";

            }



        ?>
        </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="form-validation.js"></script>
      </body>
</html>
