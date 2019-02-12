<?php
session_start();
if(!isset($_SESSION['usuario'])){
   header("Location:http://localhost/geradorXml/App/View/Login/Login.php");
}
?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
        <!-- JQUERY-->
        <script src="js/external/jquery/jquery.js"></script>       
        <script src="js/external/jquery/jquery-ui.js"></script>   
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <!-- ================================================================================================ -->

    <!-- ======================== META TAGS OBRIGATÓRIAS ================================================== -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Folha de estilo da página -->
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <!--CustomJS -->
    <script type="module" src="js/main.js"></script>
    <!-- Icones fonte awesome -->
    <link href="fontawesome-free-5.6.3/css/all.css" rel="stylesheet">
    <!-- Bootstrap-->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    
    <script src="js/login.js"></script>
    <script src="js/logout.js"></script>
    <script>
    $(function(){
        $("#navbar #navbarCadastrarUsuario").click(function(e){   
        $("#modalUsuario").modal('show');
        $("#apiModal .modal-body").append($('#formUsuario').show());
        });
    });
    </script>
    <!-- =============================================================== -->
    <script> </script>
    <title>Gerador XML</title>
    </head>
    <body>        
        <?php require_once 'App/View/Menu.php'; ?>
            <div class="container" id="container">
                <div class="row"> 
                <img class="mx-auto" src="App/Icons/nfce1.jpg" alt="" width="500px" height="500px">
                </div> <!-- .row -->
            </div><!-- .container -->
        <?php require_once 'App/View/Footer.php'; ?>
    </body>
</html>