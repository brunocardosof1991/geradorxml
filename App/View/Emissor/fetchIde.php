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
        <script type="module" src="../../../js/Emissor/ide.js"></script>
        <script type="text/javascript" src="../../../js/tableResponsive.js"></script>
        <script src="../../../js/logout.js"></script>

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
            <div class="row" id="rowEmissorAll">
                <div class="col-md-12">
                    <div class="card mx-auto text-center card-ide" style="max-width: 35rem;">
                        <div class="card-header" style="background-color: #FFF;">
                            <a href="http://localhost/geradorxml/index.php">
                                <img src="../../Icons/logoEmissor2.png" alt="">
                            </a>
                        </div>
                        <div class="card-body bg-light">
                            <?php require_once '../../Components/Modal/Modal.html'; ?>  
                            <?php require_once '../../Components/FormIde.html'; ?> 
                        </div>
                    </div><!-- END .card -->
                </div><!-- END .col-12 -->
            </div> <!-- END .row -->
        </div> <!-- END .container -->     
        <?php require_once '../../View/Footer.php'; ?>
    </body>
</html>