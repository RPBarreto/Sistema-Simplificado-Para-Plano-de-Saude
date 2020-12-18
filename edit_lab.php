<?php include "./header_admin.php" ?>

<?php
if (!empty($_GET["cnpj"])) {
  $getcnpj = $_GET["cnpj"];

} else {
  $getcnpj = $_POST["cnpj"];

}

libxml_use_internal_errors(true);

$xml = simplexml_load_file("laboratorios.xml");

if ($xml === false) {
    echo ("Falha ao carregar o código XML: ");
    
    foreach(libxml_get_errors() as $error) {
        echo ("<br>". $error->message);

    }

} else if (!empty($_POST["getcnpj"])) {
  $name = $_POST["firstname"];
  $cnpj = $_POST["cnpj"];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $phone = $_POST["phone"];
  $expertise = $_POST["expertise"];

} else {
    for ($i = 0; $i < sizeof($xml); $i++) {
      
      if ($getcnpj == $xml->laboratorio[$i]->CNPJ) {
        $name = $xml->laboratorio[$i]->Name;
        $cnpj = $xml->laboratorio[$i]->CNPJ;
        $email = $xml->laboratorio[$i]->Email;
        $address = $xml->laboratorio[$i]->Address;
        $phone = $xml->laboratorio[$i]->Phone;
        $expertise = $xml->laboratorio[$i]->Expertise;

      }

    }

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
  function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

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
        console_log($xml->laboratorio[$i]->Email);

        if ($_POST["cnpj"] == $xml->laboratorio[$i]->CNPJ || $_POST["email"] == $xml->laboratorio[$i]->Email) {
          if (!($getcnpj == $xml->laboratorio[$i]->CNPJ)) {
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
    
    $xml = simplexml_load_file("laboratorios.xml");

    if ($xml === false) {
      echo ("Falha ao carregar o código XML: ");
      
      foreach(libxml_get_errors() as $error) {
          echo ("<br>". $error->message);

      }

    } else {
        for ($i = 0; $i < sizeof($xml); $i++) {
          
          if ($getcnpj == $xml->laboratorio[$i]->CNPJ) {
            $xml->laboratorio[$i]->Name = $_POST["firstname"];
            $xml->laboratorio[$i]->Email = $_POST["email"];
            $xml->laboratorio[$i]->Address = $_POST["address"];
            $xml->laboratorio[$i]->Phone = $_POST["phone"];
            $xml->laboratorio[$i]->Expertise = $_POST["expertise"];
          
            if ($getcnpj != $_POST["cnpj"]) {
              $xml->laboratorio[$i]->CNPJ = $_POST["cnpj"];
              $getcnpj = $_POST["cnpj"];

            }

          }

        }

    }

    $s = simplexml_import_dom($xml);
    $s->saveXML("laboratorios.xml");
    
  }

}
?>
      </body>
</html>
