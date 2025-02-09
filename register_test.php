<?php include "./header_lab.php" ?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
    <h2>Cadastrar exame</h2>
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
            <label for="type">Tipo de exame</label>
            <input type="text" class="form-control" id="type" name="type" placeholder="Tipo de exame" value="" required>
            <div class="invalid-feedback">
              Insira o tipo do exame.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="result">Resultado</label>
          <input type="text" class="form-control" id="result" name="result" placeholder="Resultado" required>
          <div class="invalid-feedback">
            Insira o resultado.
          </div>
        </div>

        <div class="mb-3">
          <label for="data">Data</label>
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

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = 1;

    $xml = simplexml_load_file("exames.xml");

    for ($i = 0; $i < sizeof($xml); $i++) {
        if ($xml->laboratorio[$i]->Email == $_SESSION["user"]) {
            for ($j = 0; $j < sizeof($xml->laboratorio[$i]->Email); $j++) {
                $id += 1;

            }

        }

    }

    $node = $xml->addChild("laboratorio");
    $node->addChild("Email", $_SESSION["user"]);
    $node2 = $node->addChild("exame");
    $node2->addChild("ID", $id);
    $node2->addChild("Pac", $_POST["pac"]);
    $node2->addChild("Data", $_POST["data"]);
    $node2->addChild("Type", $_POST["type"]);
    $node2->addChild("Result", $_POST["result"]);
    
    if (!empty($_POST["pac"])) {
        $s = simplexml_import_dom($xml);
        $s->saveXML("exames.xml");
    
    }

  }
  ?>      
  </body>
</html>
