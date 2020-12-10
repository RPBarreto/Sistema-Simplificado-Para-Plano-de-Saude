<?php include "./header_admin.php" ?>

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
            <h2>Lista de médicos</h2>
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
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $xml = simplexml_load_file("laboratorios.xml");

            for ($i = 0; $i < sizeof($xml); $i++) {
              echo "<tr>
                      <th scope='row'>".($i + 1)."</th>
                      <td>".$xml->laboratorio[$i]->Name."</td>
                      <td>".$xml->laboratorio[$i]->LastName."</td>
                      <td>".$xml->laboratorio[$i]->Email."</td>
                      <td>".$xml->laboratorio[$i]->Address."</td>
                      <td>".$xml->laboratorio[$i]->Phone."</td>
                      <td>".$xml->laboratorio[$i]->Expertise."</td>
                      <td>".$xml->laboratorio[$i]->CRM."</td>
                      <td>
                        <form action='edit_md.php' method='GET'>
                          <input class='form-control' name='crm' type='hidden' value='".$xml->laboratorio[$i]->CRM."' />
                          <input class='form-control' name='email' type='hidden' value='".$xml->laboratorio[$i]->Email."' />
                          <button type='submit' class='btn btn-primary' name='submit'><b>Editar</b></button>  
                        </form>
                      
                      
                      </td>
                    </tr>";

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