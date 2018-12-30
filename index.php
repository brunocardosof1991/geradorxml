<?php
?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
    <!-- ======================================= SCRIPTS BOOTSTRAP 4.1 JS =============================== -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <!-- ================================================================================================ -->

    <!-- ========================== SCRIPT TOOLTIP BOOTSTRAP ============================================ -->
    <!-- Este script é necessário para o correto funcionamento dos tooltips do bootstrap. -->
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <!-- ================================================================================================ -->

    <!-- ======================== META TAGS OBRIGATÓRIAS ================================================== -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- ================================================================================================== -->

    <!-- ======================== LINK BOOTSTRAP CSS 4.1 ================================================== -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- ================================================================================================== -->

    <!-- =============================================================== -->
    <!-- ======================== LINKS DIVERSOS ======================= -->
    <!-- =============================================================== -->
    <!-- Folha de estilo da página -->
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <!-- Fontes do google -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet"> 
    <!-- Icones fonte awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!-- =============================================================== -->

        <title>Gerador XML</title>
    </head>
    <body>        
        <?php require_once 'App/View/Menu.php'; ?>
            <div class="container-fluid">
                <div class="row">
                <h1>Opa</h1>
                </div> <!-- .row -->
            </div><!-- .container -->
        <?php require_once 'App/View/Footer.php'; ?>
    </body>
</html>