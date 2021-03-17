<?php include "./header_admin.php" ?>

    <div class="container">
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
            <a type="button" href="" class="btn btn-primary">Fechar</a>
          </div>
        </div>
      </div>
    </div>   

  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
    <h2>Cadastrar médico</h2>
  </div>
  <div class="alert" role="alert" id="Alert" style="display:none;">
  E-mail ou CRM já estão em uso
  </div>
    <div class="py-5 text-center">
      <form class="needs-validation" novalidate  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nome</label>
            <input type="text" class="form-control" id="firstName" name="firstname" placeholder="Nome" value="" required>
            <div class="invalid-feedback">
              Insira um nome válido.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Sobrenome</label>
            <input type="text" class="form-control" id="lastName" name="lastname" placeholder="Sobrenome" value="" required>
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
          <div class="col-md-5 mb-3">
            <label for="phone">Telefone</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefone" required>
            <div class="invalid-feedback">
              Insira um número de telefone válido.
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="expertise">Especialidade</label>
              <input type="text" class="form-control" id="expertise" name="expertise" placeholder="Especialidade" required>
              <div class="invalid-feedback">
                Insira uma especialidade.
              </div>
          </div>
          <div class="col-md-3 mb-3">
          <label for="crm">CRM</label>
              <input type="number" class="form-control" id="crm" name="crm" min="0" placeholder="" required>
              <div class="invalid-feedback">
                Insira um CRM válido.
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

  $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root") or die('Unable to Connect');

  $crm = $_POST["crm"];
  $email = $_POST["email"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $address = $_POST["address"];
  $phone = $_POST["phone"];
  $expertise = $_POST["expertise"];
  $sql = "SELECT crm, email FROM medicos WHERE crm = '$crm' OR email = '$email'";
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
    $sql = "INSERT INTO `medicos`(`name`, `lastname`, `crm`, `email`, `address`, `phone`, `expertise`) 
            VALUES ('$firstname','$lastname','$crm','$email','$address','$phone','$expertise')";
    $res = $conn->query($sql);
    $sql = "INSERT INTO `users`(`email`, `pass`, `type`)
            VALUES ('$email','$crm','2')";
    $res = $conn->query($sql);
  }

}
?>
      </body>
</html>
