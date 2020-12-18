<?php include "./header_admin.php" ?>

    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="assets/brand/logo.svg" alt="" width="72" height="72">
            <h2>Lista de médicos</h2>
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
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $xml = simplexml_load_file("medicos.xml");

            for ($i = 0; $i < sizeof($xml); $i++) {
              echo "<tr>
                      <th scope='row'>".($i + 1)."</th>
                      <td>".$xml->medico[$i]->Name."</td>
                      <td>".$xml->medico[$i]->LastName."</td>
                      <td>".$xml->medico[$i]->Email."</td>
                      <td>".$xml->medico[$i]->Address."</td>
                      <td>".$xml->medico[$i]->Phone."</td>
                      <td>".$xml->medico[$i]->Expertise."</td>
                      <td>".$xml->medico[$i]->CRM."</td>
                      <td>
                        <form action='edit_md.php' method='GET'>
                          <input class='form-control' name='crm' type='hidden' value='".$xml->medico[$i]->CRM."' />
                          <input class='form-control' name='email' type='hidden' value='".$xml->medico[$i]->Email."' />
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
