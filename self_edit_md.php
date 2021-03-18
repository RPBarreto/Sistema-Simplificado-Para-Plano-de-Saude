<?php include "./header_md.php" ?>

<?php
    $getemail = $_SESSION["user"];


    $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root");

    if (!empty($_POST["getemail"])) {
        $name = $_POST["firstname"];
        $last_name = $_POST["lastname"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $expertise = $_POST["expertise"];
        $crm = $_POST["crm"];

        if ($_SESSION["unique"] != "") {
            $getcrm = $_SESSION["unique"];

        } else {
            $getcrm = $_POST["getcrm"];

        }

    } else {
        $sql = "SELECT * FROM medicos WHERE email = '$getemail'";
        $res = $conn->query($sql);
        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $name = $rows[0]["name"];
        $last_name = $rows[0]["lastname"];
        $email = $rows[0]["email"];
        $address = $rows[0]["address"];
        $phone = $rows[0]["phone"];
        $expertise = $rows[0]["expertise"];
        $crm = $rows[0]["crm"];

        $getcrm = $crm;
    

    }

?>

<div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
    <h2>Editar médico</h2>
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
          <label for="email">Senha</label>
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Senha" required>
          <div class="invalid-feedback">
            Insira uma senha.
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

        <input type="hidden" class="form-control" name="getemail" value="<?php echo ($getemail);?>" required>
        <input type="hidden" class="form-control" name="getcrm" value="<?php echo ($getcrm);?>" required>

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
            <p>E-mail ou CRM já estão em uso</p>
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

    $sql = "SELECT * FROM medicos WHERE (crm = '".$_POST["crm"]."' OR email = '".$_POST["email"]."') AND NOT (crm = '".$getcrm."' OR email = '".$getemail."');";

    $res = $conn->query($sql);

    if ($res->rowCount() > 0) {
      echo "<script type='text/javascript'>
      $(document).ready(function(){
        $('#Modal').modal('show');
      });
      </script>";

    } else {
      $_SESSION["unique"] = $_POST["crm"];

      $sql = "UPDATE medicos SET name = :name, lastname = :lastname, crm = :crm, email = :email, address = :address, phone = :phone, expertise = :expertise WHERE crm = '".$getcrm."';";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":name", $_POST["firstname"]);
      $stmt->bindParam(":lastname", $_POST["lastname"]);
      $stmt->bindParam(":crm", $_POST["crm"]);
      $stmt->bindParam(":address", $_POST["address"]);
      $stmt->bindParam(":phone", $_POST["phone"]);
      $stmt->bindParam(":expertise", $_POST["expertise"]);
      $stmt->bindParam(":email", $_POST["email"]);

      $stmt->execute();
    
      $conn->exec($sql);

      if ($getemail != $_POST["email"]) {
        $sql = "UPDATE medicos SET email = :email WHERE crm = '".$getcrm."';";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $_POST["email"]);
    
        $stmt->execute();
      
        $conn->exec($sql);

        $sql = "SELECT * FROM users WHERE email = '".$getemail."';";

        $res = $conn->query($sql);

        if ($res->rowCount() > 0) {
          $sql = "UPDATE users SET email = :email, pass = :pass WHERE email = '".$getemail."';";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(":email", $_POST["email"]);
          $stmt->bindParam(":pass", $_POST["pass"]);

          $stmt->execute();

          $conn->exec($sql);

          session_unset();
                  
          session_destroy();

        }

      } else {
        $sql = "SELECT * FROM users WHERE email = '".$getemail."';";

        $res = $conn->query($sql);

        if ($res->rowCount() > 0) {
          $sql = "UPDATE users SET pass = :pass WHERE email = '".$getemail."';";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(":pass", $_POST["pass"]);

          $stmt->execute();

          $conn->exec($sql);

        }

        $getemail = $_POST["email"];

        if (!empty($_SESSION["pass"]) && $_POST["pass"] != $_SESSION["pass"]) {
          session_unset();
            
          session_destroy();

        }

      }
    
    }
  }
?>
      </body>
</html>
