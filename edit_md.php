<?php include "./header_admin.php" ?>

<?php
if (!empty($_GET["crm"])) {
  $getcrm = $_GET["crm"];

} else if (!empty($_SESSION["unique1"])) {
  $getcrm = $_SESSION["unique1"];

} else {
  $getcrm = $_POST["getcrm"];

}

if (!empty($_GET["email"])) {
  $getemail = $_GET["email"];

} else if (!empty($_SESSION["unique2"])) {
  $getemail = $_SESSION["unique2"];

} else {
  $getemail = $_POST["getemail"];

}

libxml_use_internal_errors(true);

$xml = simplexml_load_file("medicos.xml");

if ($xml === false) {
    echo ("Falha ao carregar o código XML: ");
    
    foreach(libxml_get_errors() as $error) {
        echo ("<br>". $error->message);

    }

} else if (!empty($_POST["getcrm"])) {
  $name = $_POST["firstname"];
  $last_name = $_POST["lastname"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $phone = $_POST["phone"];
  $expertise = $_POST["expertise"];
  $crm = $_POST["crm"];

} else {
    for ($i = 0; $i < sizeof($xml); $i++) {
      
      if ($getcrm == $xml->medico[$i]->CRM) {
        $name = $xml->medico[$i]->Name;
        $last_name = $xml->medico[$i]->LastName;
        $email = $xml->medico[$i]->Email;
        $address = $xml->medico[$i]->Address;
        $phone = $xml->medico[$i]->Phone;
        $expertise = $xml->medico[$i]->Expertise;
        $crm = $xml->medico[$i]->CRM;

      }

    }

}

?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
    <h2>Editar médico</h2>
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
          <div class="col-md-5 mb-3">
            <label for="phone">Telefone</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefone" value="<?php echo ($phone);?>" required>
            <div class="invalid-feedback">
              Insira um número de telefone válido.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="expertise">Especialidade</label>
              <input type="text" class="form-control" id="expertise" name="expertise" placeholder="Especialidade" value="<?php echo ($expertise);?>" required>
              <div class="invalid-feedback">
                Insira uma especialidade.
              </div>
          </div>
          <div class="col-md-3 mb-3">
          <label for="crm">CRM</label>
              <input type="number" class="form-control" id="crm" name="crm" min="0" placeholder="" value="<?php echo ($crm);?>" required>
              <div class="invalid-feedback">
                Insira um CRM válido.
              </div>
          </div>
        </div>

        <input type="hidden" class="form-control" name="getcrm" value="<?php echo ($getcrm);?>" required>
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
            <p>E-mail ou CRM já estão em uso</p>
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

  $xml = simplexml_load_file("medicos.xml");

  if ($xml === false) {
      echo ("Falha ao carregar o código XML: ");
      
      foreach(libxml_get_errors() as $error) {
          echo ("<br>". $error->message);

      }
  
  } else {
      for ($i = 0; $i < sizeof($xml); $i++) {

        if ($_POST["crm"] == $xml->medico[$i]->CRM || $_POST["email"] == $xml->medico[$i]->Email) {
          if (!($getcrm == $xml->medico[$i]->CRM) || !($getemail == $xml->medico[$i]->Email)) {
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
    $_SESSION["unique1"] = $_POST["crm"];
    $_SESSION["unique2"] = $_POST["email"];
    
    $xml = simplexml_load_file("medicos.xml");
    $xml2 = simplexml_load_file("users.xml");

    if ($xml === false) {
      echo ("Falha ao carregar o código XML: ");
      
      foreach(libxml_get_errors() as $error) {
          echo ("<br>". $error->message);

      }

    } else {
        for ($i = 0; $i < sizeof($xml); $i++) {
          
          if ($getcrm == $xml->medico[$i]->CRM) {
            $xml->medico[$i]->Name = $_POST["firstname"];
            $xml->medico[$i]->LastName = $_POST["lastname"];
            $xml->medico[$i]->Email = $_POST["email"];
            $xml->medico[$i]->Address = $_POST["address"];
            $xml->medico[$i]->Phone = $_POST["phone"];
            $xml->medico[$i]->Expertise = $_POST["expertise"];

            $xml->medico[$i]->CRM = $_POST["crm"];

            for ($j = 0; $j < sizeof($xml2); $j++) {
              if ($xml2->user[$j]->Email == $getemail) {
                $xml2->user[$j]->Email = $_POST["email"];

              }

            }


          }

        }

    }

    //Precisa ser testado
    if (!empty($_POST["email"])) {
      $s = simplexml_import_dom($xml);
      $sv = simplexml_import_dom($xml2);
      $s->saveXML("medicos.xml");
      $sv->saveXML("users.xml");

      //$_SESSION["unique1"] = 0;
      //$_SESSION["unique2"] = 0;
    
    }
  }

}
?>
      </body>
</html>
