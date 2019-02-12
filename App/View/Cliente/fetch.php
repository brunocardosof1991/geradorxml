<?php
session_start();
if(!isset($_SESSION['usuario'])){
   header("Location:http://localhost/geradorXml/App/View/Login/Login.php");
}
?>
<?php require_once '../../Components/Modal/Modal.html'; ?> 
<?php require_once '../../Components/FormCliente.html'; ?> 
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
        <script type="module" src="../../../js/Cliente/fetch.js"></script>
        <script type="text/javascript" src="../../../js/tableResponsive.js"></script>
        <script src="../../../js/logout.js"></script>
        <!-- DataTable-->   
        <script src="../../../js/datatables.js"></script> 
        <link href="../../../css/datatables.css" type="text/css" rel="stylesheet">    
        <!-- Folha de estilo da página -->
        <link href="../../../css/style.css" type="text/css" rel="stylesheet">
        <!-- fonte awesome -->
        <link href="../../../fontawesome-free-5.6.3/css/all.css" rel="stylesheet">
        <!-- Bootstrap-->
        <script src="../../../js/bootstrap/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../../css/bootstrap/bootstrap.min.css">

        <!-- Folha de estilo da página -->
        <link href="../../../css/style.css" type="text/css" rel="stylesheet">
        <script src="../../../js/mask/jquery.mask.js"></script>
        <script src="../../../js/validarCNPJ.js"></script>
        <style>
            .error { border-color: #FF0000 }
        </style>
        <style>
            .success { border-color: #00FF00 }
        </style>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </head>
    <body>     
    <?php require_once '../Menu.php'; ?> 
        <div class="container mb-5" id="container">
            <div class="row" id="rowCliente">
                <div class="col-md-12 mx-auto">
                    <div class="table-responsive-xl">
                        <table class="table table-hover table-bordered mt-3 mx-auto text-center js-table-data display" id="tableListarClientes">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">CPF/CNPJ</th>
                                    <th scope="col">Endereço</th>
                                    <th scope="col">Número</th>
                                    <th scope="col">Bairro</th>
                                    <th scope="col">Município</th>
                                    <th scope="col">UF</th>
                                    <th scope="col">CEP</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Excluir</th>
                                    <th scope="col">Editar</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div> <!-- END #table-responsive -->
                </div>
            </div> <!-- END .row -->
        </div> <!-- END .container --> 
        <?php require_once '../../View/Footer.php'; ?>
    </body>
</html>