<?php include "./header_md.php" ?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
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
            <label for="presc">Receita</label>
            <input type="text" class="form-control" id="presc" name="presc" placeholder="Receita" value="" required>
            <div class="invalid-feedback">
              Insira uma receita.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="notes">Observações</label>
          <input type="text" class="form-control" id="notes" name="notes" placeholder="Observações" required>
          <div class="invalid-feedback">
            Insira suas observações.
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
    function console_log( $data ){
      echo '<script>';
      echo 'console.log('. json_encode( $data ) .')';
      echo '</script>';
    }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root") or die('Unable to Connect');
  
   
    $email = $_SESSION["user"];
    $pac = $_POST["pac"];
    $data = $_POST["data"];
    $presc = $_POST["presc"];
    $notes = $_POST["notes"];
    $sql = "INSERT INTO `consultas`(`medico`, `paciente`, `data`, `presc`, `notes`)
            VALUES ('$email','$pac','$data','$presc','$notes')";
    $res = $conn->query($sql);


  }
  ?>      
  </body>
</html>
