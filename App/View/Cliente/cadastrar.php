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

        <!-- ************** -->
        <script type="module" src="../../../js/Cliente/cadastrar.js"></script>
        <script src="../../../js/validarCNPJ.js"></script>
        <script src="../../../js/logout.js"></script>

        <!-- Folha de estilo da página -->
        <link href="../../../css/style.css" type="text/css" rel="stylesheet">
        <script src="../../../js/mask/jquery.mask.js"></script>
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
        <style>
            .error { border-color: #FF0000 }
        </style>
        <style>
            .success { border-color: #00FF00 }
        </style>
    </head>
    <body>   
        <?php require_once '../Menu.php'; ?>
        <div class="container" id="container">
            <div class="row" id="row">
                <div class="col-md-8 mx-auto">                             
                    <?php require_once '../../Components/FormCliente.html'; ?> 
                </div>      
            </div>
        </div>
        <?php require_once '../../View/Footer.php'; ?>
    </body>
</html>