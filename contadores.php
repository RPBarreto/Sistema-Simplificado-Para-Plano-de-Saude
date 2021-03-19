<?php include "./header_admin.php" ?>

<div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72"/>
    <h2>Pesquisar data</h2>
  </div>
  <div class="py-1 text-center">
    <form class="needs-validation" novalidate  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
      <input type="date" class="form-control" id="data" name="data" placeholder="Data" required>
      <div class="invalid-feedback">
        Insira a data.
      </div>


      <hr class="mb-4">

      <button class="btn btn-primary btn-lg btn-block" type="submit">Pesquisar</button>
    </form>
  </div>
              
  <div class="py-3 text-center">
    <?php 
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data_formatada = strtotime($_POST["data"]);
        echo "<h2>Dados para "; 
        echo date('m/Y  ', $data_formatada  );
        echo "</h2>";
      }
    ?>
  </div>
  <hr class="mb-4 ">
  <div class="py-4         text-center">
    <h2>Médicos</h2>
  </div>

  <table class="table table-striped">
  <thead>
      <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Sobrenome</th>
      <th scope="col">E-mail</th>
      <th scope="col">Endereço</th>
      <th scope="col">Telefone</th>
      <th scope="col">Especialidade</th>
      <th scope="col">CRM</th>
      <th scope="col">Nº de consultas</th>
      <th scope="col"></th>
      </tr>
  </thead>
  <tbody>
        
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root");

      $sql = "SELECT * FROM medicos";
              
      $res = $conn->query($sql);
  
      if ($res->rowCount() > 0) {
        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $time = strtotime($_POST["data"]);
        $month = date("n", $time);
        $year = date("Y", $time);
          
        for ($i = 0; $i < sizeof($rows); $i++) {
          $sql = "SELECT COUNT(*) FROM consultas WHERE medico = '".$rows[$i]["email"]."' AND (MONTH(data) = '".$month."' AND YEAR(data) = '".$year."');";
          
          $res = $conn->query($sql);
  
          if ($res->rowCount() > 0) {
            $rows2 = $res->fetchAll(PDO::FETCH_ASSOC);
            $n_times = $rows2[0]['COUNT(*)'];
            

          }

          echo "<tr>
                  <th scope='row'>".($i + 1)."</th>
                  <td>".$rows[$i]["name"]."</td>
                  <td>".$rows[$i]["lastname"]."</td>
                  <td>".$rows[$i]["email"]."</td>
                  <td>".$rows[$i]["address"]."</td>
                  <td>".$rows[$i]["phone"]."</td>
                  <td>".$rows[$i]["expertise"]."</td>
                  <td>".$rows[$i]["crm"]."</td>
                  <td>".$n_times."</td>
                </tr>";

        }
      }
    }

  ?>
  </tbody>
  </table>
</div>

<div class="container">         
  <div class="py-4         text-center">
    <h2>Laboratórios</h2>
  </div>

  <table class="table table-striped">
  <thead>
      <tr>
      <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">CNPJ</th>
        <th scope="col">E-mail</th>
        <th scope="col">Endereço</th>
        <th scope="col">Telefone</th>
        <th scope="col">Especialidade</th>
        <th scope="col">Nº de exames</th>
        <th scope="col"></th>
      </tr>
  </thead>
  <tbody>
        
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root");

      $sql = "SELECT * FROM laboratorios";
              
      $res = $conn->query($sql);
  
      if ($res->rowCount() > 0) {
        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $time = strtotime($_POST["data"]);
        $month = date("n", $time);
        $year = date("Y", $time);
          
        for ($i = 0; $i < sizeof($rows); $i++) {
          $sql = "SELECT COUNT(*) FROM exames WHERE laboratorio = '".$rows[$i]["email"]."' AND (MONTH(data) = '".$month."' AND YEAR(data) = '".$year."');";
          
          $res = $conn->query($sql);
  
          if ($res->rowCount() > 0) {
            $rows2 = $res->fetchAll(PDO::FETCH_ASSOC);
            $n_times = $rows2[0]['COUNT(*)'];
            

          }

          echo "<tr>
                  <th scope='row'>".($i + 1)."</th>
                  <td>".$rows[$i]["name"]."</td>
                  <td>".$rows[$i]["cnpj"]."</td>
                  <td>".$rows[$i]["email"]."</td>
                  <td>".$rows[$i]["address"]."</td>
                  <td>".$rows[$i]["phone"]."</td>
                  <td>".$rows[$i]["expertise"]."</td>
                  <td>".$n_times."</td>
                </tr>";

        }
      }
    }

  ?>
  </tbody>
  </table>
</div>

<div class="container">         
  <div class="py-4         text-center">
    <h2>Pacientes</h2>
  </div>

  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Sobrenome</th>
      <th scope="col">E-mail</th>
      <th scope="col">Endereço</th>
      <th scope="col">Telefone</th>
      <th scope="col">CPF</th>
      <th scope="col">Genero</th>
      <th scope="col">Nº de consultas</th>
      <th scope="col">Nº de exames</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
        
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root");

      $sql = "SELECT * FROM pacientes";
              
      $res = $conn->query($sql);
  
      if ($res->rowCount() > 0) {
        $rows = $res->fetchAll(PDO::FETCH_ASSOC);

        $time = strtotime($_POST["data"]);
        $month = date("n", $time);
        $year = date("Y", $time);
          
        for ($i = 0; $i < sizeof($rows); $i++) {
          $sql = "SELECT COUNT(*) FROM exames WHERE paciente = '".$rows[$i]["email"]."' AND (MONTH(data) = '".$month."' AND YEAR(data) = '".$year."');";
          
          $res = $conn->query($sql);
  
          if ($res->rowCount() > 0) {
            $rows2 = $res->fetchAll(PDO::FETCH_ASSOC);
            $n_times_exames = $rows2[0]['COUNT(*)'];
            

          }

          $sql = "SELECT * FROM pacientes";
              
          $res = $conn->query($sql);
      
          if ($res->rowCount() > 0) {
            $rows = $res->fetchAll(PDO::FETCH_ASSOC);
    
            $time = strtotime($_POST["data"]);
            $month = date("n", $time);
            $year = date("Y", $time);
              
            $sql = "SELECT COUNT(*) FROM consultas WHERE paciente = '".$rows[$i]["email"]."' AND (MONTH(data) = '".$month."' AND YEAR(data) = '".$year."');";
              
            $res = $conn->query($sql);
      
            if ($res->rowCount() > 0) {
                $rows2 = $res->fetchAll(PDO::FETCH_ASSOC);
                $n_times_consultas = $rows2[0]['COUNT(*)'];
                
            }
          }

          echo "<tr>
                  <th scope='row'>".($i + 1)."</th>
                  <td>".$rows[$i]["name"]."</td>
                  <td>".$rows[$i]["lastname"]."</td>
                  <td>".$rows[$i]["email"]."</td>
                  <td>".$rows[$i]["address"]."</td>
                  <td>".$rows[$i]["phone"]."</td>
                  <td>".$rows[$i]["cpf"]."</td>
                  <td>".$rows[$i]["genero"]."</td>
                  <td>".$n_times_consultas."</td>
                  <td>".$n_times_exames."</td>
                </tr>";

        }
      }
    }

  ?>
  </tbody>
  </table>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="form-validation.js"></script>
</body>
</html>
