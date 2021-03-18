<?php include "./header_admin.php" ?>

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
            <h2>Lista de pacientes</h2>
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
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $conn = new PDO("mysql:host=localhost;dbname=medicos", "root", "root");

            $sql = "SELECT * FROM pacientes";
                    
            $res = $conn->query($sql);

            $_SESSION["unique1"] = 0;
            $_SESSION["unique2"] = 0;
        
            if ($res->rowCount() > 0) {
              $rows = $res->fetchAll(PDO::FETCH_ASSOC);

              for ($i = 0; $i < sizeof($rows); $i++) {
                echo "<tr>
                        <th scope='row'>".($i + 1)."</th>
                        <td>".$rows[$i]["name"]."</td>
                        <td>".$rows[$i]["lastname"]."</td>
                        <td>".$rows[$i]["email"]."</td>
                        <td>".$rows[$i]["address"]."</td>
                        <td>".$rows[$i]["phone"]."</td>
                        <td>".$rows[$i]["cpf"]."</td>
                        <td>".$rows[$i]["genero"]."</td>

                        <td>
                          <form action='edit_pac.php' method='GET'>
                            <input class='form-control' name='cpf' type='hidden' value='".$rows[$i]["cpf"]."' />
                            <input class='form-control' name='email' type='hidden' value='".$rows[$i]["email"]."' />
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