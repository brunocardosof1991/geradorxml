<?php
session_start();
if(!isset($_SESSION['usuario'])){
   header("Location:http://localhost/geradorXml/App/View/Login/Login.php");
}
?>
<!DOCTYPE html>
<html>
    <head> 
        <!-- ======================== META TAGS OBRIGATÓRIAS ================================================== -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">      
        <link href="../../../css/datatables.css" type="text/css" rel="stylesheet">    
        <!-- Folha de estilo da página -->
        <link href="../../../css/style.css" type="text/css" rel="stylesheet">
        <!-- fonte awesome -->
        <link href="../../../fontawesome-free-5.6.3/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="../../../css/bootstrap/bootstrap.min.css">
    </head>
    <body>     
    <?php require_once '../Menu.php'; ?> 
        <div class="container mb-5" id="container">
            <div class="row" id="rowProduto">
                <div class="col-md-12 mx-auto">
                        <table class="table table-hover table-bordered mt-3 mx-auto text-center js-table-data display" id="tableListarProdutos" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th >ID</th>
                                    <th >Produto</th>
                                    <th >NCM</th>
                                    <th >Preço</th>
                                    <th >CFOP</th>
                                    <th >cEAN</th>
                                    <th >Excluir</th>
                                    <th >Editar</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                </div>
                <div class="col-md-12" id="colAddButton">
                    <button id="addProduto">Cadastrar Produto</button>
                </div>
            </div> <!-- END .row -->
        </div> <!-- END .container -->  
        <!-- JQUERY-->
        <script src="../../../js/external/jquery/jquery.js"></script>    
        <script src="../../../js/external/jquery/jquery-ui.js"></script>    
        <!-- CustomJS -->
        <script type="module" src="../../../js/Produto/index.js"></script>
        <script type="text/javascript" src="../../../js/external/tableResponsive.js"></script>
        <script src="../../../js/mask/jquery.mask.js"></script>
        <script src="../../../js/logout.js"></script>
        <!-- DataTable-->   
        <script src="../../../js/external/datatables.js"></script> 
        <!-- Bootstrap-->
        <script src="../../../js/bootstrap/bootstrap.min.js"></script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <?php require_once '../../Components/Modal/Modal.html'; ?> 
        <?php require_once '../../Components/FormProduto.html'; ?> 
        <?php require_once '../../View/Footer.php'; ?>
    </body>
</html>