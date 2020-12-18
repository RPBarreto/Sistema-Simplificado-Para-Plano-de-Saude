<?php include "./header_pac.php" ?>

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
            <h2>Lista de exames</h2>
        </div>
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Laboratório</th>
            <th scope="col">Data</th>
            <th scope="col">Tipo</th>
            <th scope="col">Resultado</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $xml = simplexml_load_file("exames.xml");

            for ($i = 0; $i < sizeof($xml); $i++) {

              if ($xml->laboratorio[$i]->exame->Pac == $_SESSION["user"]) {
            
                  echo "<tr>
                  <th scope='row'>".($xml->laboratorio[$i]->exame->ID)."</th>
                  <td>".$xml->laboratorio[$i]->Email."</td>
                  <td>".$xml->laboratorio[$i]->exame->Data."</td>
                  <td>".$xml->laboratorio[$i]->exame->Type."</td>
                  <td>".$xml->laboratorio[$i]->exame->Result."</td>

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
