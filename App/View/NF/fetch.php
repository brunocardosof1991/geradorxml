<!DOCTYPE html>
<html>
    <head> 
        <!-- ======================== META TAGS OBRIGATÓRIAS ================================================== -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- JQUERY-->
        <script src="../../../js/external/jquery/jquery.js"></script>
        <script type="module" src="../../../js/NF/NF.js"></script>
        <script type="text/javascript" src="../../../js/tableResponsive.js"></script>

        <!-- Folha de estilo da página -->
        <link href="../../../css/style.css" type="text/css" rel="stylesheet">

        <!-- Fontes do google -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet"> 

        <!-- Icones fonte awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <!-- TABLE -->       

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <!-- ================================================================================================ -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.js"></script>
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
        <div class="container" id="container">
            <div class="row" id="rowNF">
                <div class="col-md-12 col-lg-12 col-xl-12" id="colNF">
                <div class="table-responsive-md">
                    <table class="table table-hover table-bordered mt-3 mx-auto text-center js-table-data" id="tableListarNF">
                        <thead class="bg-dark">
                            <tr>
                                <th style="display:none;">ID</th>
                                <th>Chave De Acesso</th>
                                <th>Data de Emissão</th>
                                <th data-label='CPF/CNPJ'>CPF/CNPJ Destinatário</th>
                                <th>Protocolo</th>
                                <th>Excluir</th>
                                <th>Cancelar</th>
                            </tr>
                        </thead>
                        <tbody><tr data-expanded="true"></tr></tbody>
                    </table>
                </div>
                </div> <!-- END #colNF -->
            </div> <!-- END .row -->
        </div> <!-- END .container -->
    </body>
</html>
