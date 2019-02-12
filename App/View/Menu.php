
<script type="module" src="http://localhost/geradorxml/js/Usuario/usuario.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5" id="navbar">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto"> 
        <li class="nav-item dropdown mr-3">
            <a class="navbar-brand" href="/geradorXml/index.php">
                <i class="fas fa-home fa-2x"></i>
            </a>
        </li>    
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Cliente
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                <a class="dropdown-item" href="http://localhost/geradorXml/App/View/Cliente/fetch.php">Listar Clientes</a>
                <a class="dropdown-item" href="http://localhost/geradorXml/App/View/Cliente/cadastrar.php">Cadastrar Cliente</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                NFC-e
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                <a class="dropdown-item" href="http://localhost/geradorXml/App/View/NF/fetch.php">Listar NFC-e</a>
                <a class="dropdown-item" href="http://localhost/geradorXml/App/View/NF/eventos.php">Eventos NFC-e</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Produto                
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                <a class="dropdown-item" href="http://localhost/geradorXml/App/View/Produto/fetch.php">Listar Produtos</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Venda                
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                <a class="dropdown-item" href="http://localhost/geradorXml/App/View/Venda/vender.php">Vender</a>
                <a class="dropdown-item" href="http://localhost/geradorXml/App/View/Venda/fetch.php">Listar Vendas</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Configurações                
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                <a class="dropdown-item" href="/geradorXml/App/View/Emissor/fetchEmit.php" id="navbarCadastrarEmpresa">Cadastrar Empresa</a>
                <a class="dropdown-item" href="/geradorXml/App/View/Emissor/fetchIde.php" id="navbarCadastrarIdentificacao">Cadastrar Identificação da NFC-e</a>
                <a class="dropdown-item" id="navbarCadastrarUsuario" style='cursor:pointer'>Cadastrar Usuário</a>
            </div>
        </li>
    </ul>
    <ul class="navbar-nav" id="navConfig">
        <li class="nav-item dropdown ml-auto">
            <a class="navbar-brand" href="/geradorXml/index.php">
                <i class="fas fa-sign-out-alt fa-2x" title="Deslogar" id="logout" style="color:red"></i>
            </a>
        </li>    
    </ul>
  </div>
</nav>     
<div class="modal fade" data-keyboard="false" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h5 class="modal-title text-light" id="exampleModalLabel">Cadastrar Usuário</h5>
                        </div>
                        <div class="modal-body bg-light text-center">
                            <div class="form-group col-md-12" id="divUsuario">
                                <label for="exampleFormControlInput1">Usuario</label>
                                <input type="text" class="form-control" id="inputUsuario" placeholder="Usuario">
                            </div>                   
                            <div class="form-group col-md-12" id="divEmail">
                                <label for="exampleFormControlInput1">E-mail</label>
                                <input type="email" class="form-control" id="inputEmail2" placeholder="E-mail">
                            </div>                   
                            <div class="form-group col-md-12" id="divSenha">
                                <label for="exampleFormControlInput1">Senha</label>
                                <input type="password" class="form-control" id="inputSenha" placeholder="Senha">
                            </div>    
                            <div class="form-group col-md-12" id="divStatus">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select id="status" class="form-control">
                                        <option >...</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Usuario">Usuario</option>
                                </select>
                            </div>                   
                        </div>
                        <div class="modal-footer text-center bg-light">
                        <button class="btn btn-danger" data-dismiss="modal" id="btnFechar">Fechar</button>
                        <button class="btn btn-primary action">Cadastrar Usuario</button>
                        </div>
                    </div>
                </div>
            </div> <!-- END MODALNFCE -->