<?php include "./header_md.php" ?>

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
            <h2>Lista de consultas</h2>
        </div>
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Paciente</th>
            <th scope="col">Data</th>
            <th scope="col">Receita</th>
            <th scope="col">Observações</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root");
            $mail = $_SESSION["user"];
            $sql = "SELECT * FROM consultas WHERE medico = '$mail'";
                    
            $res = $conn->query($sql);

            $_SESSION["unique1"] = 0;
            $_SESSION["unique2"] = 0;
        
            if ($res->rowCount() > 0) {
              $rows = $res->fetchAll(PDO::FETCH_ASSOC);
              
              for ($i = 0; $i < sizeof($rows); $i++) {
                echo "<tr>
                        <th scope='row'>".$rows[$i]["id"]."</th>
                        <td>".$rows[$i]["paciente"]."</td>
                        <td>".$rows[$i]["data"]."</td>
                        <td>".$rows[$i]["presc"]."</td>
                        <td>".$rows[$i]["notes"]."</td>

                        <td>
                          <form action='edit_app.php' method='GET'>
                            <input class='form-control' name='id' type='hidden' value='".$rows[$i]["id"]."' />
                            <button type='submit' class='btn btn-primary' name='submit'><b>Editar</b></button>  
                          </form>
                        
                        
                        </td>
                      </tr>";

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
