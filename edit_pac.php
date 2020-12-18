<?php include "./header_admin.php" ?>

<?php
if (!empty($_GET["cpf"])) {
  $getcpf = $_GET["cpf"];

} else if (!empty($_SESSION["unique1"])) {
  $getcpf = $_SESSION["unique1"];

} else {
  $getcpf = $_POST["getcpf"];

}

if (!empty($_GET["email"])) {
  $getemail = $_GET["email"];

} else if (!empty($_SESSION["unique2"])) {
  $getemail = $_SESSION["unique2"];

} else {
  $getemail = $_POST["getemail"];

}

libxml_use_internal_errors(true);

$xml = simplexml_load_file("pacientes.xml");

if ($xml === false) {
    echo ("Falha ao carregar o código XML: ");
    
    foreach(libxml_get_errors() as $error) {
        echo ("<br>". $error->message);

    }

} else if (!empty($_POST["getcpf"])) {
  $name = $_POST["firstname"];
  $last_name = $_POST["lastname"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $phone = $_POST["phone"];
  $cpf = $_POST["cpf"];
  $genero = $_POST["genero"];

} else {
    for ($i = 0; $i < sizeof($xml); $i++) {
      
      if ($getcpf == $xml->paciente[$i]->CPF) {
        $name = $xml->paciente[$i]->Name;
        $last_name = $xml->paciente[$i]->LastName;
        $email = $xml->paciente[$i]->Email;
        $address = $xml->paciente[$i]->Address;
        $phone = $xml->paciente[$i]->Phone;
        $cpf = $xml->paciente[$i]->CPF;
        $genero = $xml->paciente[$i]->Genero;

      }

    }

}

?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
    <h2>Editar paciente</h2>
  </div>
    <div class="py-5 text-center">
      <form class="needs-validation" novalidate  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nome</label>
            <input type="text" class="form-control" id="firstName" name="firstname" placeholder="Nome" value="<?php echo ($name);?>" required>
            <div class="invalid-feedback">
              Insira um nome válido.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Sobrenome</label>
            <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Sobrenome" value="<?php echo ($last_name);?>" required>
            <div class="invalid-feedback">
              Insira um sobrenome válido.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo ($email);?>" required>
          <div class="invalid-feedback">
            Insira um endereço de e-mail válido.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Endereço</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" value="<?php echo ($address);?>" required>
          <div class="invalid-feedback">
            Insira um endereço.
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-2">
            <label for="phone">Telefone</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefone" value="<?php echo ($phone);?>" required>
            <div class="invalid-feedback">
              Insira um número de telefone válido.
            </div>
          </div>
          <div class="col-md-4 mb-2">
            <label for="cpf">CPF</label>
              <input type="number" class="form-control" id="cpf" name="cpf" placeholder="Cpf" value="<?php echo ($cpf);?>" required>
              <div class="invalid-feedback">
                Insira uma especialidade.
              </div>
          </div>
          <div class="col-md-4 mb-2">
            <label for="Genero">Genero</label>
              <select id="genero" class="form-control" name="genero" value="<?php echo ($genero);?>">
                <option value="feminino">Feminino</option>
                <option value="masculino">Masculino</option>
                <option value="outro">Outro</option>
              </select>
              <div class="invalid-feedback">
                Escolha um genero.
              </div>
          </div>
        </div>

        <input type="hidden" class="form-control" name="getcpf" value="<?php echo ($getcpf);?>" required>
        <input type="hidden" class="form-control" name="getemail" value="<?php echo ($getemail);?>" required>

        <hr class="mb-4">

        <button class="btn btn-primary btn-lg btn-block" type="submit">Editar</button>
      </form>
    </div>
  </div>

</div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="form-validation.js"></script>

      <div class="modal" tabindex="-1" role="dialog" id="Modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Erro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>E-mail ou CPF já estão em uso</p>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>        

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $exists = false;
  libxml_use_internal_errors(true);

  $xml = simplexml_load_file("pacientes.xml");

  if ($xml === false) {
      echo ("Falha ao carregar o código XML: ");
      
      foreach(libxml_get_errors() as $error) {
          echo ("<br>". $error->message);

      }
  
  } else {
      for ($i = 0; $i < sizeof($xml); $i++) {

        if ($_POST["cpf"] == $xml->paciente[$i]->CPF || $_POST["email"] == $xml->paciente[$i]->Email) {
          if (!($getcpf == $xml->paciente[$i]->CPF) || !($getemail == $xml->paciente[$i]->Email)) {
            echo "<script type='text/javascript'>
            $(document).ready(function(){
              $('#Modal').modal('show');
            });
            </script>";

            $exists = true;
            break;
          
          }

        }

      }

  }

  if (!$exists) {
    $_SESSION["unique1"] = $_POST["cpf"];
    $_SESSION["unique2"] = $_POST["email"];
    
    $xml = simplexml_load_file("pacientes.xml");
    $xml2 = simplexml_load_file("users.xml");


    if ($xml === false) {
      echo ("Falha ao carregar o código XML: ");
      
      foreach(libxml_get_errors() as $error) {
          echo ("<br>". $error->message);

      }

    } else {
        for ($i = 0; $i < sizeof($xml); $i++) {
          
          if ($getcpf == $xml->paciente[$i]->CPF) {
            $xml->paciente[$i]->Name = $_POST["firstname"];
            $xml->paciente[$i]->LastName = $_POST["lastname"];
            $xml->paciente[$i]->Email = $_POST["email"];
            $xml->paciente[$i]->Address = $_POST["address"];
            $xml->paciente[$i]->Phone = $_POST["phone"];
            $xml->paciente[$i]->Genero = $_POST["genero"];

            $xml->paciente[$i]->CPF = $_POST["cpf"];
            
            for ($j = 0; $j < sizeof($xml2); $j++) {
              if ($xml2->user[$j]->Email == $getemail) {
                $xml2->user[$j]->Email = $_POST["email"];

              }
            }

          }

        }

    }

    $s = simplexml_import_dom($xml);
    $sv = simplexml_import_dom($xml2);

    $s->saveXML("pacientes.xml");
    $sv->saveXML("users.xml");

    
  }

}
?>
      </body>
</html>
