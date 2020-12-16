<?php include "./header_md.php" ?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h2>Cadastrar consulta</h2>
  </div>
    <div class="py-5 text-center">
      <form class="needs-validation" novalidate  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="pac">E-mail do paciente</label>
            <input type="email" class="form-control" id="pac" name="pac" placeholder="E-mail do paciente" value="" required>
            <div class="invalid-feedback">
              Insira um e-mail válido.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="cnpj">Receita</label>
            <input type="text" class="form-control" id="presc" name="presc" placeholder="Receita" value="" required>
            <div class="invalid-feedback">
              Insira uma receita.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Observações</label>
          <input type="text" class="form-control" id="notes" name="notes" placeholder="Observações" required>
          <div class="invalid-feedback">
            Insira suas observações.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Data</label>
          <input type="date" class="form-control" id="data" name="data" placeholder="Data" required>
          <div class="invalid-feedback">
            Insira a data.
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
    $id = 0;

    $xml = simplexml_load_file("consultas.xml");

    for ($i = 0; $i < sizeof($xml); $i++) {
        if ($xml->medico[$i]->Email == $_SESSION["user"]) {
            for ($j = 0; $j < sizeof($xml->medico[$i]->Email); $j++) {
                $id += 1;

            }

        }

    }

    $node = $xml->addChild("medico");
    $node->addChild("Email", $_SESSION["user"]);
    $node2 = $node->addChild("consulta");
    $node2->addChild("ID", $id);
    $node2->addChild("Pac", $_POST["pac"]);
    $node2->addChild("Data", $_POST["data"]);
    $node2->addChild("Presc", $_POST["presc"]);
    $node2->addChild("Notes", $_POST["notes"]);
    
    if (!empty($_POST["pac"])) {
        $s = simplexml_import_dom($xml);
        $s->saveXML("consultas.xml");
    
    }

  }
  ?>      
  </body>
</html>
