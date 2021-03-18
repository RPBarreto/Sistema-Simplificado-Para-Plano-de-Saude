<?php include "./header_admin.php" ?>

<?php
  if (!empty($_GET["cpf"])) {
    $getcpf = $_GET["cpf"];

  } else if (!empty($_SESSION["unique1"])) {
    $getcpf = $_SESSION["unique1"];

  } else {
    $getcpf = $_POST["getcpf"];

  }

  if (!empty($_GET["email"])) {
    $getemail = $_GET["email"];

  } else if (!empty($_SESSION["unique2"])) {
    $getemail = $_SESSION["unique2"];

  } else {
    $getemail = $_POST["getemail"];

  }

  $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root");

  if (!empty($_POST["getcpf"])) {
    $name = $_POST["firstname"];
    $last_name = $_POST["lastname"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $cpf = $_POST["cpf"];
    $genero = $_POST["genero"];

  } else {
    $sql = "SELECT * FROM pacientes WHERE cpf = '".$getcpf."';";

    $res = $conn->query($sql);

    if ($res->rowCount() > 0) {
      $rows = $res->fetchAll(PDO::FETCH_ASSOC);
        
    }
        
    $name = $rows[0]["name"];
    $last_name = $rows[0]["lastname"];
    $email = $rows[0]["email"];
    $address = $rows[0]["address"];
    $phone = $rows[0]["phone"];
    $cpf = $rows[0]["cpf"];
    $genero = $rows[0]["genero"];

  }

?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
    <h2>Editar paciente</h2>
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
          <div class="col-md-4 mb-2">
            <label for="phone">Telefone</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefone" value="<?php echo ($phone);?>" required>
            <div class="invalid-feedback">
              Insira um número de telefone válido.
            </div>
          </div>
          <div class="col-md-4 mb-2">
            <label for="cpf">CPF</label>
              <input type="number" class="form-control" id="cpf" name="cpf" placeholder="Cpf" value="<?php echo ($cpf);?>" required>
              <div class="invalid-feedback">
                Insira uma especialidade.
              </div>
          </div>
          <div class="col-md-4 mb-2">
            <label for="Genero">Genero</label>
              <select id="genero" class="form-control" name="genero" value="<?php echo ($genero);?>">
                <option value="feminino">Feminino</option>
                <option value="masculino">Masculino</option>
                <option value="outro">Outro</option>
              </select>
              <div class="invalid-feedback">
                Escolha um genero.
              </div>
          </div>
        </div>

        <input type="hidden" class="form-control" name="getcpf" value="<?php echo ($getcpf);?>" required>
        <input type="hidden" class="form-control" name="getemail" value="<?php echo ($getemail);?>" required>

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
            <p>E-mail ou CPF já estão em uso</p>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>        

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root");

    $sql = "SELECT * FROM pacientes WHERE (cpf = '".$_POST["cpf"]."' OR email = '".$_POST["email"]."') AND NOT (cpf = '".$getcpf."' OR email = '".$getemail."');";

    $res = $conn->query($sql);

    if ($res->rowCount() > 0) {
      echo "<script type='text/javascript'>
      $(document).ready(function(){
        $('#Modal').modal('show');
      });
      </script>";

    } else {
      $_SESSION["unique1"] = $_POST["cpf"];
      $_SESSION["unique2"] = $_POST["email"];

      $sql = "UPDATE pacientes SET name = :name, lastname = :lastname, cpf = :cpf, email = :email, address = :address, phone = :phone, genero = :genero WHERE cpf = '".$getcpf."';";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":name", $_POST["firstname"]);
      $stmt->bindParam(":lastname", $_POST["lastname"]);
      $stmt->bindParam(":cpf", $_POST["cpf"]);
      $stmt->bindParam(":email", $_POST["email"]);
      $stmt->bindParam(":address", $_POST["address"]);
      $stmt->bindParam(":phone", $_POST["phone"]);
      $stmt->bindParam(":genero", $_POST["genero"]);

      $stmt->execute();

      $conn->exec($sql);

      $sql = "UPDATE users SET email = :email, pass = :pass WHERE email = '".$getemail."';";
      $stmt = $conn->prepare($sql);

      $stmt->bindParam(":email", $_POST["email"]);
      $stmt->bindParam(":pass", $_POST["cpf"]);

      $stmt->execute();

      $conn->exec($sql);
    }

  }
  ?>

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
          <p>Este e-mail ou CPF já foi cadastrado</p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
  
  </body>
</html>