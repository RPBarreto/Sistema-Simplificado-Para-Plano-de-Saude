<?php include "./header_md.php" ?>

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
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
            $xml = simplexml_load_file("consultas.xml");

            for ($i = 0; $i < sizeof($xml); $i++) {

              if ($xml->medico[$i]->Email == $_SESSION["user"]) {
            
                  echo "<tr>
                  <th scope='row'>".($xml->medico[$i]->consulta->ID)."</th>
                  <td>".$xml->medico[$i]->consulta->Pac."</td>
                  <td>".$xml->medico[$i]->consulta->Data."</td>
                  <td>".$xml->medico[$i]->consulta->Presc."</td>
                  <td>".$xml->medico[$i]->consulta->Notes."</td>
                  <td>
                    <form action='edit_app.php' method='POST'>
                      <input class='form-control' name='id' type='hidden' value='".$xml->medico[$i]->consulta->ID."' />
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
