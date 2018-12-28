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
        <script type="module" src="../../../js/NF/NF.js"></script>

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
                <div class="table-responsive-xl">
                    <table class="table table-hover table-bordered mt-3 mx-auto text-center" id="tableListarNF">
                        <thead class="thead-dark">
                            <tr>
                                <th style="display:none;" scope="col">ID</th>
                                <th scope="col">Chave De Acesso</th>
                                <th scope="col">Data de Emissão</th>
                                <th scope="col">CPF/CNPJ Destinatário</th>
                                <th scope="col">Compartilhar</th>
                                <th scope="col">Excluir</th>
                                <th scope="col">Duplicar</th>
                                <th scope="col">Cancelar</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div> <!-- END #table-responsive -->
                </div> <!-- END #colNF -->
            </div> <!-- END .row -->
        </div> <!-- END .container -->
    </body>
</html>
<div id="apiModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">NFC-e</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post" id="api_form">
                <div class="modal-body">
                    <div class="col text-left">
                        <label>ID</label>
                            <input type="number" class="form-control" id="inputFetchNF_ID" name="inputFetchNF_ID" placeholder="ID">
                    </div>
                    <div class="col text-left">
                        <label>CNPJ/CPF Destinatário</label>
                            <input type="text" class="form-control" id="inputFetchNF_CNPJ" name="inputFetchNF_CNPJ" placeholder="CNPJ/CPF">
                    </div>
                    <div class="col text-left">
                        <label>Nome</label>
                            <input type="text" class="form-control" id="inputFetchNF_Nome" name="inputFetchNF_Nome" placeholder="Nome">
                    </div>
                    <div class="col text-left">
                        <label>Chave de Acesso</label>
                            <input type="text" class="form-control" id="inputFetchNF_Chave" name="inputFetchNF_Chave" placeholder="Chave de Acesso">
                    </div>
                    <div class="col text-left">
                        <label>cNF</label>
                            <input type="text" class="form-control" id="inputFetchNF_cNF" name="inputFetchNF_cNF" placeholder="cNF">
                    </div>
                    <div class="col text-left">
                        <label>nNF</label>
                            <input type="text" class="form-control" id="inputFetchNF_nNF" name="inputFetchNF_nNF" placeholder="nNF">
                    </div>
                    <div class="col text-left">
                        <label>Horario da Autorização</label>                       
                        <input type="text" class="form-control" id="inputFetchNF_Hora" name="inputFetchNF_Hora" placeholder="Hora">
                    </div>        
                </div><!-- END .modal-body --> 
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id"/>
                    <input type="hidden" name="action" id="action" value="insert"/>
                    <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert"/>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                </div>                      
            </form>       
        </div><!-- END .modal-content -->
    </div><!-- END .modal-dialog -->
</div> <!--#apicrudModal-->