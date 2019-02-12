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

        <!-- Custom JS -->
        <script type="module" src="../../../js/venda/venda.js"></script>
        <script type="module" src="../../../js/DANFE.js"></script>
        <script type="module" src="../../../js/pagamento.js"></script>
        <script type="module" src="../../../js/main.js"></script>
        <script src="../../../js/logout.js"></script>

        <!-- Folha de estilo da página -->
        <link href="../../../css/style.css" type="text/css" rel="stylesheet">

        <!-- Icones fonte awesome -->
        <link href="../../../fontawesome-free-5.6.3/css/all.css" rel="stylesheet">
        <!-- Bootstrap-->
        <script src="../../../js/bootstrap/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../../css/bootstrap/bootstrap.min.css">
        <!-- ================================================================================================ --> 
        <script src="../../../easy-pie-chart-master/dist/jquery.easypiechart.js"></script>
        <script src="../../../pdfmake-master/build/pdfmake.js"></script>
        <script src="../../../pdfmake-master/build/vfs_fonts.js"></script>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <script>$(function(){localStorage.clear();});</script>
    </head>
    <body>   
    <?php require_once '../Menu.php'; ?> 
        <div class="container mb-5" id="container"> 
            <div id="accordion" class="col-md-12 mx-auto mt-5 mb-5">
                <div class="card text-center bg-light" id="cardCadastrarProduto">
                    <div class="card-header bg-dark" id="headingOne">
                        <h5 class="mb-0 text-center">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" id="collapseProduto">
                                <span class="badge badge-danger">Produto</span>                        
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" id="inputBuscarProduto" placeholder="Nome do produto, ID ou código de barras" class="form-control input-lg">
                                </div>
                                <div class="col-md-2">
                                    <i class="fas fa-broom fa-3x inputReset" title="Apagar" style='cursor:pointer;color:red'></i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive-xl">
                                    <table class="table table-hover table-bordered mt-3 mx-auto text-center" id="tableListarProduto_XmlGerar">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Código</th>
                                                <th>Descrição</th>
                                                <th style="display: none;">ncm</th>
                                                <th>Vl Unit</th>
                                                <th style="display: none;">CFOP</th>
                                                <th>Quantidade</th>
                                                <th>Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div> <!-- END #table-responsive -->
                            </div>
                            <div class="col-md-12" id="colDesconto">                                    
                                <label class="form-check-label" for="inlineCheckbox1">Desconto?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="checkboxDesconto" value="descontoSim">
                                </div>  
                            </div>
                        </div><!-- END .card-body -->
                    </div><!-- END #collapseOne -->
                </div><!-- END .card-->            
                <div class="card text-center bg-light" id="cardCadastrarFormaPagamento_XmlGerar">
                    <div class="card-header bg-dark" id="headingTwo">
                        <h5 class="mb-0 text-center">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" id="collapseFormaPagamento">
                                <span class="badge badge-success">Forma de Pagamento</span>                        
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">  
                            <div class="jumbotron bg-light" id="jumbotronProdutos">
                            <div class="col-md-12" id="divValorTotal_GerarXml">
                                <span id="spanTextTotal">Total a Pagar: R$ </span><span id="spanValorTotal"></span>
                            </div>
                            <div class="col-md-12" id="divValorTotalDesconto" style="display: none;">
                                <span id="spanTextDesconto">Total a Pagar Com Desconto: R$ </span><span id="spanValorTotalDesconto"></span>
                            </div>
                            <div class="col-md-12" id="divTroco" style="display: none;">
                                <span id="spanTextTroco">Troco: R$ </span><span id="spanTroco"></span>
                            </div>
                            <div class="col-md-12" id="divValorRestante" style="display: none;">
                                <span id="spanTextRestante">Restante a Pagar: R$ </span><span id="spanRestante"></span>
                            </div>
                                <hr class="my-4 bg-dark" >
                                <div class="row" id="rowCardFormaPagamento">
                                    <?php require_once '../../Components/CardsFormaPagamento.html'; ?>    
                                    <?php require_once '../../Components/FormPagamento.html'; ?>
                                    <div class="col-md-1 mx-auto mt-2" id="colVisualizar">
                                        <i class="fas fa-eye fa-3x" id="visualizarFormaPagamento" title="Visualizar Formas de Pagamento" style='cursor:pointer'></i>
                                    </div>  
                                </div><!-- END #rowFormaPagamento -->  
                                <!--
                                <div class="w-100"></div>
                                <div class="row" id="rowPlusFormaPagamento">
                                    <div class="col-md-1" id="colAdicionar">
                                        <i class="fas fa-plus fa-2x" id="adicionarFormaPagamento" title="Adicionar Forma de Pagamento" style='cursor:pointer;color:green'></i>
                                    </div>
                                    <div class="col-md-1" id="colVisualizar">
                                        <i class="fas fa-eye fa-2x" id="visualizarFormaPagamento" title="Visualizar Forma de Pagamento" style='cursor:pointer'></i>
                                    </div>  
                                </div>  
                                -->
                            </div><!-- END #jumbotronProdutos -->
                        </div>
                    </div><!-- END #collapseTwo -->
                </div><!-- END .card-->            
                <div class="card text-center bg-light" id="cardCadastrarFormaPagamento">
                    <div class="card-header bg-dark" id="headingThree">
                        <h5 class="mb-0 text-center">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" id="collapseDestinatario">
                                <span class="badge badge-warning">Destinatário</span>                        
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">      
                            <div id="divinputNomeCliente" class="form-group col-md-7">
                                <h6>Nome</h6>
                                <input id="inputName" type="text" class="form-control" name="inputName" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-5">
                                <h6>CPF / CNPJ</h6>
                                <input id="inputRegistro" type="number" class="form-control" name="inputRegistro" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-4" >
                                <h6>Logradouro</h6>
                                <input id="inputEndereco" type="text" class="form-control" name="inputEndereco" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-4" >
                                <h6>Número</h6>
                                <input id="inputNumero" type="number" class="form-control" name="inputNumero" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-4" >
                                <h6>Bairro</h6>
                                <input id="inputBairro" type="text" class="form-control" name="inputBairro" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-4" >
                                <h6>Municipio</h6>
                                <input id="inputMunicipio" type="text" class="form-control" name="inputMunicipio" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-4" >
                                <h6>UF</h6>
                                <input id="inputUF" type="text" class="form-control" name="inputUF" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-4" >
                                <h6>Complemento</h6>
                                <input id="inputComplemento" type="text" class="form-control" name="inputComplemento" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-6" >
                                <h6>CEP</h6>
                                <input id="inputCEP" type="number" class="form-control" name="inputCEP" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-6" >
                                <h6>Telefone</h6>
                                <input id="inputFone" type="number" class="form-control" name="inputFone" placeholder="..."/>
                            </div>
                            <!-- ID CLIENTE -->
                            <div id="divinputID" class="form-group col-md-4" style="display: none;">
                                <h6>ID</h6>
                                <input id="clientID" type="number" class="form-control" name="clientID" placeholder="..."/>
                            </div>
                            <!-- ID CLIENTE -->
                            <div class="w-100"></div>
                            <div id="divTextAreaInformacaoAdicional" class="form-group col-md-12">
                                <h6>Informações Adicionais NFC-e</h6>
                                <textarea rows="4" cols="50" id="textAreaAdicional"></textarea>
                            </div>
                            <div class="col-md-12" id="divButtonFinalizarVenda">
                                <input type="button" class="btn btn-outline-success btn-lg btn-block" value="Finalizar Venda" id="buttonFinalizarVenda">
                            </div>
                            </div>
                        </div>
                    </div><!-- END #collapseThree -->
                </div><!-- END .card-->            
            </div><!-- END .accordion  -->
        </div> <!-- END .container -->   
        <?php require_once '../../Components/Modal/Modal.html'; ?>                
        <?php require_once '../../Components/Modal/ModalDinheiro.html'; ?>                
        <?php require_once '../../Components/Modal/ModalCheque.html'; ?>                
        <?php require_once '../../Components/Modal/modalRefeicao.html'; ?>                
        <?php require_once '../../Components/Modal/ModalAlimentacao.html'; ?>                
        <?php require_once '../../Components/Modal/ModalCredito.html'; ?>                
        <?php require_once '../../Components/Modal/ModalDebito.html'; ?>                
        <?php require_once '../../Components/Modal/ModalVisualizarPagamentos.html'; ?>                
        <?php require_once '../../Components/TableFormaPagamento.html'; ?>                
        <?php require_once '../../View/Footer.php'; ?>
    </div>
    </body>
</html>