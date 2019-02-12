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

        <!-- JQUERY-->
        <script src="../../../js/external/jquery/jquery.js"></script>       
        <script src="../../../js/external/jquery/jquery-ui.js"></script>  
        <!-- CustomJS -->
        <script type="module" src="../../../js/Venda/fetch.js"></script>
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
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </head>
    <body>     
    <?php require_once '../Menu.php'; ?> 
        <div class="container mb-5" id="container">
            <div class="row" id="rowVendas">
                <div class="col-md-12 mx-auto">
                        <table class="table table-hover table-bordered mt-3 mx-auto text-center js-table-data display" id="tableListarVendas" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th >ID</th>
                                    <th >Vendedor</th>
                                    <th >Produto(s)</th>
                                    <th >Quantidade(s)</th>
                                    <th >Valor Total</th>
                                    <th >Forma de Pagamento</th>
                                    <th >NFC-e</th>
                                    <th >Data</th>
                                    <th >Excluir</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                </div>
            </div> <!-- END .row -->
        </div> <!-- END .container --> 
        <?php require_once '../../View/Footer.php'; ?>
    </body>
</html>