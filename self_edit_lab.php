<?php include "./header_lab.php" ?>

<?php
$getemail = $_SESSION["user"];


$conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root");

if (!$conn) {
    echo ("Falha ao conectar ao banco: ");
    
    foreach(libxml_get_errors() as $error) {
        echo ("<br>". $error->message);

    }

} else if (!empty($_POST["getemail"])) {
  $name = $_POST["firstname"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $phone = $_POST["phone"];
  $expertise = $_POST["expertise"];
  $cnpj = $_POST["cnpj"];

  if ($_SESSION["unique"] != "") {
    $getcnpj = $_SESSION["unique"];

  } else {
    $getcnpj = $_POST["getcnpj"];

  }

} else {
  $sql = "SELECT * FROM laboratorios WHERE email = '$getemail'";
  $res = $conn->query($sql);
  $rows = $res->fetchAll(PDO::FETCH_ASSOC);

  $name = $rows[0]["name"];
  $cnpj = $rows[0]["cnpj"];
  $email = $rows[0]["email"];
  $address = $rows[0]["address"];
  $phone = $rows[0]["phone"];
  $expertise = $rows[0]["expertise"];

  $getcnpj = $cnpj;
  

}


?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
    <h2>Editar laboratório</h2>
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
            <label for="cnpj">CNPJ</label>
            <input type="number" class="form-control" id="cnpj" name="cnpj" placeholder="Cnpj" value="<?php echo ($cnpj);?>" required>
            <div class="invalid-feedback">
              Insira um cnpj válido.
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
          <label for="email">Senha</label>
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Senha" required>
          <div class="invalid-feedback">
            Insira uma senha.
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
          <div class="col-md-6 mb-3">
            <label for="phone">Telefone</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefone" value="<?php echo ($phone);?>" required>
            <div class="invalid-feedback">
              Insira um número de telefone válido.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="expertise">Especialidade</label>
              <input type="text" class="form-control" id="expertise" name="expertise" placeholder="Especialidade" value="<?php echo ($expertise);?>" required>
              <div class="invalid-feedback">
                Insira uma especialidade.
              </div>
          </div>
        </div>

        <input type="hidden" class="form-control" name="getemail" value="<?php echo ($getemail);?>" required>
        <input type="hidden" class="form-control" name="getcnpj" value="<?php echo ($getcnpj);?>" required>

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
            <p>E-mail ou CNPJ já estão em uso</p>
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

  $xml = simplexml_load_file("laboratorios.xml");

  if ($xml === false) {
      echo ("Falha ao carregar o código XML: ");
      
      foreach(libxml_get_errors() as $error) {
          echo ("<br>". $error->message);

      }
  
  } else {
      for ($i = 0; $i < sizeof($xml); $i++) {

        if ($_POST["email"] == $xml->laboratorio[$i]->Email || $_POST["cnpj"] == $xml->laboratorio[$i]->CNPJ) {
          if (!($getemail == $xml->laboratorio[$i]->Email) || !($getcnpj == $xml->laboratorio[$i]->CNPJ)) {
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
    $_SESSION["unique"] = $_POST["cnpj"];

    
    $xml = simplexml_load_file("laboratorios.xml");

    $xml2 = simplexml_load_file("users.xml");

    if ($xml === false) {
      echo ("Falha ao carregar o código XML: ");
      
      foreach(libxml_get_errors() as $error) {
          echo ("<br>". $error->message);

      }

    } else {
        for ($i = 0; $i < sizeof($xml); $i++) {
          
          if ($getemail == $xml->laboratorio[$i]->Email) {
            $xml->laboratorio[$i]->Name = $_POST["firstname"];
            $xml->laboratorio[$i]->CNPJ = $_POST["cnpj"];
            $xml->laboratorio[$i]->Email = $_POST["email"];
            $xml->laboratorio[$i]->Address = $_POST["address"];
            $xml->laboratorio[$i]->Phone = $_POST["phone"];
            $xml->laboratorio[$i]->Expertise = $_POST["expertise"];
         
            if ($getemail != $_POST["email"]) {
              $xml->laboratorio[$i]->Email = $_POST["email"];

                for ($j = 0; $j < sizeof($xml2); $j++) {

                  if ($getemail == $xml2->user[$j]->Email) {
                    $xml2->user[$j]->Email = $_POST["email"];
                    $xml2->user[$j]->Pass = $_POST["pass"];

                    session_unset();
                
                    session_destroy();
                    
                    break;

                  }
                  

                }

            } else {
              for ($j = 0; $j < sizeof($xml2); $j++) {
                if ($xml2->user[$j]->Email == $getemail) {
                  $xml2->user[$j]->Pass = $_POST["pass"];
                
                }
              
              }
            }

            $getemail = $_POST["email"];

            if (!empty($_SESSION["pass"]) && $_POST["pass"] != $_SESSION["pass"]) {
              session_unset();
                
              session_destroy();

            }

          }

      }

  }

    //Resolve o problema de campos em branco na edição
    if (!empty($_POST["email"])) {
      $s = simplexml_import_dom($xml);
      $s->saveXML("laboratorios.xml");

      $sv = simplexml_import_dom($xml2);
      $sv->saveXML("users.xml");
    }
    
  }

}
?>
      </body>
</html>
