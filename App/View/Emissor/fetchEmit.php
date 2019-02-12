<?php
session_start();
if(!isset($_SESSION['usuario'])){
   header("Location:http://localhost/geradorXml/App/View/Login/Login.php");
}
?>
<?php require_once '../../Components/Modal/Modal.html'; ?> 
<?php require_once '../../Components/FormEmissor.html'; ?>   
<!DOCTYPE html>
<html>
    <head> 
        <!-- ======================== META TAGS OBRIGATÓRIAS ================================================== -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">       

        <!-- JQUERY-->
        <script src="../../../js/external/jquery/jquery.js"></script>    
        <script src="../../../js/external/jquery/jquery-ui.js"></script>    
        <!-- CustomJS -->
        <script type="module" src="../../../js/Emissor/fetch.js"></script>
        <script src="../../../js/validarCNPJ.js"></script>
        <script src="../../../js/mask/jquery.mask.js"></script>
        <script type="text/javascript" src="../../../js/tableResponsive.js"></script>
        <script src="../../../js/logout.js"></script>
        <!-- fonte awesome -->
        <link href="../../../fontawesome-free-5.6.3/css/all.css" rel="stylesheet">
        <!-- Bootstrap-->
        <script src="../../../js/bootstrap/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../../css/bootstrap/bootstrap.min.css">
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <style>
            .error { border-color: #FF0000 }
        </style>
        <style>
            .success { border-color: #00FF00 }
        </style>
    </head>
    <body>     
    <?php require_once '../Menu.php'; ?> 
        <div class="container mb-5" id="container">
                <div class="col-md-12">
                    <div class="card mx-auto text-center" style="max-width: 35rem;">
                        <div class="card-header" style="background-color: #FFF;">
                            <a href="http://localhost/geradorxml/index.php">
                                <img src="../../Icons/logoEmissor2.png" alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row" id="rowEmissorBody">
                                <div class="col-md-6 text-left">
                                    <p style="display:none;" id="pID"></p>
                                    <p id="pCNPJ">CNPJ: <span id="spanCNPJ" class="badge badge-primary"> </span></p>
                                    <p id="pNomeFantasia">Nome Fantasia: <span id="spanNomeFantasia" class="badge badge-primary">></span></p>
                                    <p id="pRazaoSocial">Razão Social: <span id="spanRazaoSocial" class="badge badge-primary">></span></p>
                                    <p id="pTelefone">Telefone: <span id="spanTelefone" class="badge badge-primary">></span></p>
                                </div>                                
                                <div class="col-md-6 text-right">
                                    <p id="pCEP">CEP: <span id="spanCEP" class="badge badge-primary">></span></p>
                                    <p id="pEndereco">Endereço: <span id="spanEndereco" class="badge badge-primary">></span></p>
                                    <p id="pNumero">Número: <span id="spanNumero" class="badge badge-primary">></span></p>
                                    <p id="pBairro">Bairro: <span id="spanBairro" class="badge badge-primary">></span></p>
                                    <p id="pCidade">Cidade: <span id="spanCidade" class="badge badge-primary">></span></p>
                                    <p id="pUF">UF: <span id="spanUF" class="badge badge-primary">></span></p>
                                    <p id="pPais">Pais: <span id="spanPais" class="badge badge-primary">></span></p>
                                </div>
                                <div class="col-md-6 mt-5 text-left">
                                    <p id="pCPais">Código Pais: <span id="spanCPais" class="badge badge-primary">></span></p>
                                    <p id="pCodigoMunicipio">Código Município: <span id="spanCodigoMunicipio" class="badge badge-primary">></span></p>
                                    <p id="pCNAE">CNAE: <span id="spanCNAE" class="badge badge-primary">></span></p>
                                </div>
                                <div class="col-md-6 mt-5 text-right">
                                    <p id="pCRT">CRT: <span id="spanCRT" class="badge badge-primary">></span></p>
                                    <p id="pIM">IM: <span id="spanIM" class="badge badge-primary">></span></p>
                                    <p id="pIE">IE: <span id="spanIE" class="badge badge-primary">></span></p>
                                </div>
                            </div>
                            <div class="card-footer bg-dark">
                                <div class="row" id="rowButtons">
                                    <i class="fas fa-plus-circle fa-3x ml-auto mr-2" id="addEmissor" title="Cadastrar" style="cursor:pointer;color:green"></i>
                                    <i class="fas fa-user-edit fa-3x mx-auto" id="editarEmissor" title="Editar" style="cursor:pointer;color:orange"></i>                                
                                    <i class="fas fa-trash fa-3x mr-auto" id="excluirEmissor" title="Excluir" style="cursor:pointer;color:red"></i>                                
                                </div>
                            </div>
                        </div>
                    </div><!-- END .card -->
                </div><!-- END .col-12 -->
        </div> <!-- END .container -->       
        <?php require_once '../../View/Footer.php'; ?>
    </body>
</html>