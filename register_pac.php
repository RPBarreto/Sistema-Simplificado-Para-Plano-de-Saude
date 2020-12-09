<?php include "./header_admin.php" ?>

    <div class="container">
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h2>Cadastrar laboratório</h2>
  </div>
    <div class="py-5 text-center">
      <form class="needs-validation" novalidate>
      <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Nome</label>
            <input type="text" class="form-control" id="firstName" placeholder="Nome" value="" required>
            <div class="invalid-feedback">
              Insira um nome válido.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Sobrenome</label>
            <input type="text" class="form-control" id="lastName" placeholder="Sobrenome" value="" required>
            <div class="invalid-feedback">
              Insira um sobrenome válido.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">E-mail</label>
          <input type="email" class="form-control" id="email" placeholder="E-mail" required>
          <div class="invalid-feedback">
            Insira um endereço de e-mail válido.
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Endereço</label>
          <input type="text" class="form-control" id="address" placeholder="Endereço" required>
          <div class="invalid-feedback">
            Insira um endereço.
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-2">
            <label for="phone">Telefone</label>
            <input type="tel" class="form-control" id="phone" placeholder="Telefone" required>
            <div class="invalid-feedback">
              Insira um número de telefone válido.
            </div>
          </div>
          <div class="col-md-4 mb-2">
            <label for="cpf">CPF</label>
              <input type="number" class="form-control" id="cpf" placeholder="Cpf" required>
              <div class="invalid-feedback">
                Insira uma especialidade.
              </div>
          </div>
          <div class="col-md-4 mb-2">
            <label for="Genero">Genero</label>
              <select id="genero" class="form-control" name="Genero">
                <option value="feminino">Feminino</option>
                <option value="masculino">Masculino</option>
                <option value="outro">Outro</option>
              </select>
              <div class="invalid-feedback">
                Escolha um genero.
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
        <script src="form-validation.js"></script></body>
</html>
