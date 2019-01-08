<nav class="navbar navbar-expand-lg navbar-light bg-dark mb-2" id="navbar">
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
                <a class="dropdown-item" href="http://localhost/geradorXml/App/View/NF/inutilizar.php">Inutilizar Números</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Produto                
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                <a class="dropdown-item" href="http://localhost/geradorXml/App/View/Produto/fetch.php">Listar Produtos</a>
                <a class="dropdown-item" href="http://localhost/geradorXml/App/View/Produto/cadastrar.php">Cadastar Produto</a>
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
    </ul>
    <ul class="navbar-nav" id="navConfig">
        <li class="nav-item dropdown my-auto">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Configurações
                </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                <a class="dropdown-item" href="/geradorXml/App/View/Emissor/fetch.php" id="navbarCadastrarEmpresa">Cadastrar Empresa</a>
            </div>
       </li>    
    </ul>
  </div>
</nav>