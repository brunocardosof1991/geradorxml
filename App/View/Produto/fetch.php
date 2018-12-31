<!DOCTYPE html>
<html>
    <head> 
        <!-- ======================== META TAGS OBRIGATÓRIAS ================================================== -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- JQUERY-->
        <script src="../../../js/external/jquery/jquery.js"></script>

        <!-- table-to-json LIB-->
        <script src="//lightswitch05.github.io/table-to-json/javascripts/jquery.tabletojson.min.js"></script>  
        <script type="module" src="../../../js/cliente/cliente.js"></script>

        <!-- Folha de estilo da página -->
        <link href="../../../css/style.css" type="text/css" rel="stylesheet">

        <!-- Fontes do google -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet"> 

        <!-- Icones fonte awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

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
                <div class="col-md-12" id="colNF">
                    <table class="text-center table table-hover table-bordered mt-3" id="tableListarNF">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">CNPJ/CPF</th>
                                    <th scope="col">Endereço</th>
                                    <th scope="col">Número</th>
                                    <th scope="col">Complemento</th>
                                    <th scope="col">Bairro</th>
                                    <th scope="col">CEP</th>
                                    <th scope="col">Celular</th>
                                    <th scope="col">Selecionar</th>
                                </tr>
                            </thead>
                            <tbody id="tbody"></tbody>
                        </table>
                </div>
            </div>
        </div>
    </body>
</html>