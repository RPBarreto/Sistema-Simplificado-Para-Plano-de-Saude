<?php include "./header_admin.php" ?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h2>Cadastrar laboratório</h2>
  </div>
    <div class="py-5 text-center">
      <form class="needs-validation" novalidate  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
      <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nome</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Nome" value="" required>
            <div class="invalid-feedback">
              Insira um nome válido.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Sobrenome</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Sobrenome" value="" required>
            <div class="invalid-feedback">
              Insira um sobrenome válido.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
          <div class="invalid-feedback">
            Insira um endereço de e-mail válido.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Endereço</label>
          <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" required>
          <div class="invalid-feedback">
            Insira um endereço.
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-2">
            <label for="phone">Telefone</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefone" required>
            <div class="invalid-feedback">
              Insira um número de telefone válido.
            </div>
          </div>
          <div class="col-md-4 mb-2">
            <label for="cpf">CPF</label>
              <input type="number" class="form-control" id="cpf" name="cpf" placeholder="Cpf" required>
              <div class="invalid-feedback">
                Insira uma especialidade.
              </div>
          </div>
          <div class="col-md-4 mb-2">
            <label for="Genero">Genero</label>
              <select id="genero" class="form-control" name="genero">
                <option value="feminino">Feminino</option>
                <option value="masculino">Masculino</option>
                <option value="outro">Outro</option>
              </select>
              <div class="invalid-feedback">
                Escolha um genero.
              </div>
          </div>
        </div>

        <hr class="mb-4">

        <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
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
          console_log($xml->paciente[$i]->email);

          if ($_POST["cpf"] == $xml->paciente[$i]->CPF || $_POST["email"] == $xml->paciente[$i]->Email) {
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

    if (!$exists) {
      $xml = simplexml_load_file("pacientes.xml");
      $node = $xml->addChild("paciente");

      $node->addChild("Name", $_POST["firstName"]);
      $node->addChild("LastName", $_POST["lastName"]);
      $node->addChild("CPF", $_POST["cpf"]);
      $node->addChild("Email", $_POST["email"]);
      $node->addChild("Address", $_POST["address"]);
      $node->addChild("Phone", $_POST["phone"]);
      $node->addChild("Genero", $_POST["genero"]);

      $s = simplexml_import_dom($xml);
      $s->saveXML("pacientes.xml");

    }

  }
  ?>     
  </body>
</html>
