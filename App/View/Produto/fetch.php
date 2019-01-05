<!DOCTYPE html>
<html>
    <head> 
        <!-- ======================== META TAGS OBRIGATÓRIAS ================================================== -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">       

        <!-- JQUERY-->
        <script src="../../../js/external/jquery/jquery.js"></script>       

        <!-- ************** -->
        <script type="module" src="../../../js/Produto/fetch.js"></script>
        <script type="text/javascript" src="../../../js/tableResponsive.js"></script>

        <!-- Folha de estilo da página -->
        <link href="../../../css/style.css" type="text/css" rel="stylesheet">

        <!-- Fontes do google -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet"> 

        <!-- Icones fonte awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <!-- ================================================================================================ -->
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
            <div class="row" id="rowProduto">
                <div class="col-md-12 mx-auto">
                    <div class="table-responsive-xl">
                        <table class="table table-hover table-bordered mt-3 mx-auto text-center" id="tableListarProdutos">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Produto</th>
                                    <th scope="col">NCM</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">CFOP</th>
                                    <th scope="col">Excluir</th>
                                    <th scope="col">Editar</th>
                                </tr>
                            </thead>
                            <tbody><tr></tr></tbody>
                        </table>
                    </div> <!-- END #table-responsive -->
                </div>
            </div> <!-- END .row -->
        </div> <!-- END .container --> 
        <?php require_once '../../Components/Modal.html'; ?> 
        <?php require_once '../../Components/FormProduto.html'; ?> 
    </body>
</html>