<!DOCTYPE html>
<html>
    <head> 
        <!-- ======================== META TAGS OBRIGATÓRIAS ================================================== -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">       

        <!-- JQUERY-->
        <script src="../../../js/external/jquery/jquery.js"></script>       

        <!-- ************** -->
        <script type="module" src="../../../js/Emissor/fetch.js"></script>
        <script type="text/javascript" src="../../../js/tableResponsive.js"></script>

        <!-- Folha de estilo da página -->
        <link href="../../../css/style.css" type="text/css" rel="stylesheet">

        <!-- Fontes do google -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet"> 

        <!-- Icones fonte awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <!-- ================================================================================================ -->
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <!-- ======================== LINK BOOTSTRAP CSS 4.1 ================================================== -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <!-- ================================================================================================== -->
    </head>
    <body>     
    <?php require_once '../Menu.php'; ?> 
        <div class="container mb-5" id="container">
            <div class="row" id="rowEmissor">
                <div class="col-md-12">
                    <div class="card mx-auto text-center" style="max-width: 35rem;">
                        <div class="card-header" style="background-color: #FFF;">
                            <img src="../../Icons/logoEmissor2.png" alt="">
                        </div>
                        <div class="card-body">
                            <div class="row" id="rowEmissor">
                                <div class="col-md-6">
                                    <p style="display:none;" id="pID">ID</p>
                                    <p id="pCNPJ">CNPJ: <span id="spanCNPJ" class="badge badge-primary"> </span></p>
                                    <p id="pNomeFantasia">Nome Fantasia: <span id="spanNomeFantasia" class="badge badge-primary">></span></p>
                                    <p id="pRazaoSocial">Razão Social: <span id="spanRazaoSocial" class="badge badge-primary">></span></p>
                                    <p id="pEndereco">Endereço: <span id="spanEndereco" class="badge badge-primary">></span></p>
                                </div>                                
                                <div class="col-md-6">
                                    <p id="pNumero">Número: <span id="spanNumero" class="badge badge-primary">></span></p>
                                    <p id="pBairro">Bairro: <span id="spanBairro" class="badge badge-primary">></span></p>
                                    <p id="pTelefone">Telefone: <span id="spanTelefone" class="badge badge-primary">></span></p>
                                    <p id="pCEP">CEP: <span id="spanCEP" class="badge badge-primary">></span></p>
                                    <p id="pCidade">Cidade: <span id="spanCidade" class="badge badge-primary">></span></p>
                                    <p id="pUF">UF: <span id="spanUF" class="badge badge-primary">></span></p>
                                    <p id="pPais">Pais: <span id="spanPais" class="badge badge-primary">></span></p>
                                </div>
                                <div class="col-md-6 mt-5">
                                    <p id="pCPais">Código Pais: <span id="spanCPais" class="badge badge-primary">></span></p>
                                    <p id="pCodigoMunicipio">Código Município: <span id="spanCodigoMunicipio" class="badge badge-primary">></span></p>
                                    <p id="pCNAE">CNAE: <span id="spanCNAE" class="badge badge-primary">></span></p>
                                </div>
                                <div class="col-md-6 mt-5">
                                    <p id="pCRT">CRT: <span id="spanCRT" class="badge badge-primary">></span></p>
                                    <p id="pIM">IM: <span id="spanIM" class="badge badge-primary">></span></p>
                                    <p id="pIE">IE: <span id="spanIE" class="badge badge-primary">></span></p>
                                </div>
                            </div>
                            <div class="card-footer bg-dark">
                                <div class="row" id="rowButtons">
                                    <i class="fas fa-plus-circle fa-3x ml-auto mr-2" id="addEmissor" title="Cadastrar" style="cursor:pointer;color:green"></i>
                                    <i class="fas fa-user-edit fa-3x mr-auto" id="editarEmissor" title="Editar" style="cursor:pointer;color:orange"></i>                                
                                </div>
                            </div>
                        </div>
                    </div><!-- END .card -->
                </div><!-- END .col-12 -->
            </div> <!-- END .row -->
        </div> <!-- END .container --> 
        <?php require_once '../../Components/Modal.html'; ?> 
        <?php require_once '../../Components/FormEmissor.html'; ?>         
        <?php require_once '../../View/Footer.php'; ?>
    </body>
</html>