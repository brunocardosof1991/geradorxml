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
            <div class="row" id="rowNF">
                <div class="col-md-12 mx-auto">
                    <div class="table-responsive-xl">
                    <table class="table table-hover table-bordered mx-auto text-center js-table-data display" id="tableListarNF">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Chave De Acesso</th>
                                    <th>Data de Emissão</th>
                                    <th>Protocolo</th>
                                    <th>Visualizar NCF-e</th>
                                    <th>Excluir</th>
                                    <th>Cancelar</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div> <!-- END #table-responsive -->
                </div>
            </div> <!-- END .row -->
        </div> <!-- END .container --> 
        <?php require_once '../../Components/Modal/Modal.html'; ?> 
        <?php require_once '../../Components/Modal/ModalQRCode.html'; ?> 

        <!-- JQUERY-->
        <script src="../../../js/external/jquery/jquery.js"></script>     
        <script src="../../../js/external/jquery/jquery-ui.js"></script>     
        <!-- CustomJS -->
        <script type="module" src="../../../js/NF/index.js"></script>
        <script type="text/javascript" src="../../../js/external/tableResponsive.js"></script>
        <script src="../../../js/logout.js"></script>
        <!-- QRCode -->
        <script type="text/javascript" src="../../../js/external/jquery/jquery.qrcode.js"></script>
        <script type="text/javascript" src="../../../js/external/qrcode.js"></script>
        <!-- DataTable-->   
        <script src="../../../js/external/datatables.js"></script> 
        <!-- Bootstrap-->
        <script src="../../../js/bootstrap/bootstrap.min.js"></script> 
        <!-- Barra de progresso -->
        <script src="../../../easy-pie-chart-master/dist/jquery.easypiechart.js"></script>
               
        <?php require_once '../../View/Footer.php'; ?>
    </body>
</html>