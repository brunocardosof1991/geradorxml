<!DOCTYPE html>
<html>
    <head> 
        <!-- ======================== META TAGS OBRIGATÓRIAS ================================================== -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">       

        <!-- JQUERY-->
        <script src="../../../js/external/jquery/jquery.js"></script>       

        <!-- ************** -->
        <script type="module" src="../../../js/NF/fetch.js"></script>
        <script type="text/javascript" src="../../../js/tableResponsive.js"></script>

        <!-- Folha de estilo da página -->
        <link href="../../../css/style.css" type="text/css" rel="stylesheet">

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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
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
                                    <th>ID</th>
                                    <th>Chave De Acesso</th>
                                    <th>Data de Emissão</th>
                                    <th>CPF/CNPJ Destinatário</th>
                                    <th>Protocolo</th>
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
        <?php require_once '../../Components/Modal.html'; ?> 
        <?php require_once '../../Components/FormNF.html'; ?>         
        <?php require_once '../../View/Footer.php'; ?>
    </body>
</html>