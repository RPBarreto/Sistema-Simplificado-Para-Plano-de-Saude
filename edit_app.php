<?php include "./header_md.php" ?>

<?php
  if (!empty($_POST["id"])) {
    $getid = $_POST["id"];

  } else {
    $getid = $_POST["getid"];
    
  }

  $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root");

  } if (!empty($_POST["getid"])) {
    $pac = $_POST["pac"];
    $data = $_POST["data"];
    $presc = $_POST["presc"];
    $notes = $_POST["notes"];

  } else {
    $sql = "SELECT * FROM consultas WHERE id = '".$getID."' AND medico = '".$_SESSION['user']."';";

    $res = $conn->query($sql);

    if ($res->rowCount() > 0) {
      $rows = $res->fetchAll(PDO::FETCH_ASSOC);
        
    }
        
    $pac = $rows[0]["paciente"];
    $data = $rows[0]["data"];
    $presc = $rows[0]["presc"];
    $notes = $rows[0]["notes"];

  }

?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
    <h2>Editar consulta</h2>
  </div>
    <div class="py-5 text-center">
      <form class="needs-validation" novalidate  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="pac">E-mail do paciente</label>
            <input type="email" class="form-control" id="pac" name="pac" placeholder="E-mail do paciente" value="<?php echo ($pac);?>" required>
            <div class="invalid-feedback">
              Insira um e-mail válido.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="data">Data</label>
            <input type="date" class="form-control" id="data" name="data" placeholder="Data" value="<?php echo ($data);?>" required>
            <div class="invalid-feedback">
              Insira uma data válida.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="presc">Receita</label>
          <input type="text" class="form-control" id="presc" name="presc" placeholder="Receita" value="<?php echo ($presc);?>" required>
          <div class="invalid-feedback">
            Insira uma receita.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Observações</label>
          <input type="text" class="form-control" id="notes" name="notes" placeholder="Observações" value="<?php echo ($notes);?>" required>
          <div class="invalid-feedback">
            Insira suas observações.
          </div>
        </div>

        <input type="hidden" class="form-control" name="getid" value="<?php echo ($getid);?>" required>

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

  if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["pac"])) {

    $sql = "UPDATE consultas SET paciente = :paciente, data = :data, presc = :presc, notes = :notes WHERE id = '".$getID."' AND medico = '".$_SESSION['user']."';";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":paciente", $_POST["pac"]);
    $stmt->bindParam(":data", $_POST["data"]);
    $stmt->bindParam(":presc", $_POST["presc"]);
    $stmt->bindParam(":notes", $_POST["notes"]);


    $stmt->execute();

    $conn->exec($sql);

  }
?>
      </body>
</html>
