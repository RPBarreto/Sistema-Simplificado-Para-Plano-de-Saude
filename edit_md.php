<?php include "./header_admin.php" ?>

<?php
$edit_id = "";
//$getcrm = $_GET["crm"];

if (!empty($_GET["crm"])) {
  $getcrm = $_GET["crm"];

} else {
  $getcrm = "";

}

//$md_crm = $_GET["crm"];

libxml_use_internal_errors(true);

$xml = simplexml_load_file("medicos.xml");

if ($xml === false) {
    echo ("Falha ao carregar o código XML: ");
    
    foreach(libxml_get_errors() as $error) {
        echo ("<br>". $error->message);

    }

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
        $edit_id = $i;


      }

    }

}

?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h2>Cadastrar médico</h2>
  </div>
  <div class="alert" role="alert" style="display:none;">
  E-mail ou CRM já estão em uso
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

        <hr class="mb-4">

        <button class="btn btn-primary btn-lg btn-block" type="submit">Editar</button>
      </form>
    </div>
  </div>

</div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="form-validation.js"></script>
      
<?php
  function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  libxml_use_internal_errors(true);

  $xml = simplexml_load_file("medicos.xml");

  //Nao esta recuperando o medico pelo id
  $dom = dom_import_simplexml($xml->medico[$edit_id]);
  $dom->parentNode->removeChild($dom);

  if ($xml === false) {
      echo ("Falha ao carregar o código XML: ");
      
      foreach(libxml_get_errors() as $error) {
          echo ("<br>". $error->message);

      }
  
  } else {
      for ($i = 0; $i < sizeof($xml); $i++) {
        console_log($xml->medico[$i]->email);

        if ($_POST["crm"] == $xml->medico[$i]->CRM || $_POST["email"] == $xml->medico[$i]->Email) {
            //Nao esta aparecendo por algum motivo
            echo '<style type="text/css">
            .alert {
                display: block;
            }
            </style>';
            $exists = true;
            break;

          }

      }

  }

  if (!$exists) {
    $xml = simplexml_load_file("medicos.xml");
    $node = $xml->addChild("medico");

    $node->addChild("Name", $_POST["firstname"]);
    $node->addChild("LastName", $_POST["lastname"]);
    $node->addChild("Email", $_POST["email"]);
    $node->addChild("Address", $_POST["address"]);
    $node->addChild("Phone", $_POST["phone"]);
    $node->addChild("Expertise", $_POST["expertise"]);
    $node->addChild("CRM", $_POST["crm"]);

    $s = simplexml_import_dom($xml);
    $s->saveXML("medicos.xml");

  }

}
?>
      </body>
</html>
