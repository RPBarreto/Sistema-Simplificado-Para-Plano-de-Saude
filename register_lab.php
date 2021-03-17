<?php include "./header_admin.php" ?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
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
            <label for="cnpj">CNPJ</label>
            <input type="number" class="form-control" id="cnpj" name="cnpj" placeholder="Cnpj" value="" required>
            <div class="invalid-feedback">
              Insira um cnpj válido.
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
          <div class="col-md-6 mb-3">
            <label for="phone">Telefone</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefone" required>
            <div class="invalid-feedback">
              Insira um número de telefone válido.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="expertise">Especialidade</label>
              <input type="text" class="form-control" id="expertise" name="expertise" placeholder="Especialidade" required>
              <div class="invalid-feedback">
                Insira uma especialidade.
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

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $exists = false;

    $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root") or die('Unable to Connect');
  
    $cnpj = $_POST["cnpj"];
    $email = $_POST["email"];
    $name = $_POST["firstname"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $expertise = $_POST["expertise"];
    $sql = "SELECT cnpj, email FROM medicos WHERE cnpj = '$cnpj' OR email = '$email'";
    $res = $conn->query($sql);
    $row = $res->fetchAll(PDO::FETCH_ASSOC);
    console_log($row);
    if ($row) {
      echo "<script type='text/javascript'>
      $(document).ready(function(){
        $('#Modal').modal('show');
      });
      </script>";
      $exists = true;
    }
  
        
  
    
  
    if (!$exists) {
      $sql = "INSERT INTO `laboratorios`(`name`, `cnpj`, `email`, `address`, `phone`, `expertise`)
              VALUES ('$firstname','$cnpj','$email','$address','$phone','$expertise')";
      $res = $conn->query($sql);

      $sql = "INSERT INTO `users`(`email`, `pass`, `type`)
              VALUES ('$email','$cnpj','3')";
      $res = $conn->query($sql);
  
    }

  }
  ?>      
  </body>
</html>
