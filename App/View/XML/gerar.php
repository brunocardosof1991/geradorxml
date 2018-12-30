<!DOCTYPE html>
<html>
    <head> 
        <!-- ======================== META TAGS OBRIGATÓRIAS ================================================== -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- JQUERY-->
        <script src="../../../js/external/jquery/jquery.js"></script>

        <!-- table-to-json LIB-->
        <script type="module" src="../../../js/venda/venda.js"></script>

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
            <div id="accordion" class="col-md-8 mx-auto mt-3">
                <div class="card text-center bg-light" id="cardCadastrarProduto">
                    <div class="card-header bg-dark" id="headingOne">
                        <h5 class="mb-0 text-center">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <span class="badge badge-danger">Produto</span>                        
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="col-md-12">
                                <input type="text" id="inputSearchProduto_XmlGerar" placeholder="Nome do produto, ID ou código de barras" class="form-control input-lg">
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive-xl">
                                    <table class="table table-hover table-bordered mt-3 mx-auto text-center" id="tableListarProduto_XmlGerar">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col" style="display: none;">NCM</th>
                                                <th scope="col" style="display: none;">CFOP</th>
                                                <th scope="col">ID</th>
                                                <th scope="col">Produto</th>
                                                <th scope="col">Preço</th>
                                                <th scope="col">Quantidade</th>
                                                <th scope="col">Excluir</th>
                                            </tr>
                                        </thead>
                                        <tbody><tr></tr></tbody>
                                    </table>
                                </div> <!-- END #table-responsive -->
                            </div>
                        </div>
                    </div><!-- END #collapseOne -->
                </div><!-- END .card-->            
                <div class="card text-center bg-light" id="cardCadastrarFormaPagamento_XmlGerar">
                    <div class="card-header bg-dark" id="headingTwo">
                        <h5 class="mb-0 text-center">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" id="btnCollapseFormaPagamento_GerarXML">
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
                                <hr class="my-4 bg-dark" >
                                <div class="row" id="rowFormaPagamento_XmlGerar">
                                    <div id="divFormaPagamento" class="form-group col-md-4">
                                        <h6>Forma de Pagamento</h6>
                                        <select id="payment" class="custom-select form-control payment" name="payment">
                                            <option value="">...</option>
                                            <option value="01">Dinheiro</option>
                                            <option value="02">Cheque</option>
                                            <option value="03">Cartão de Crédito</option>
                                            <option value="04">Cartão de Débito</option>
                                            <option value="05">Crédito Loja</option>
                                            <option value="10">Vale Alimentção</option>  
                                            <option value="11">Vale Refeição</option>
                                            <option value="12">Vale Presente</option>
                                            <option value="13">Vale Combustível</option>
                                            <option value="99">Outros</option>
                                        </select>
                                    </div>
                                    <div id="divBandeira" class="form-group col-md-4">
                                        <h6>Bandeira do Cartão</h6>
                                        <select id="selectBandeira" class="custom-select form-control" name="bandeira">
                                            <option value="">...</option>
                                            <option value="01">Visa</option>
                                            <option value="02">Mastercard</option>
                                            <option value="03">American Express</option>
                                            <option value="04">Sorocred</option>
                                            <option value="05">Diners Club</option>
                                            <option value="06">Elo</option>
                                            <option value="07">Hipercard</option>
                                            <option value="08">Aura</option>
                                            <option value="09">Cabal</option>
                                            <option value="99">Outros</option>
                                        </select>
                                    </div>
                                    <div id="divCredCartao" class="form-group col-md-4">
                                        <h6>Credenciadora do Cartão</h6>
                                        <select id="credCartao" class="custom-select form-control" name="credCartao">
                                            <option value="">...</option>
                                            <option value="03106213000271">Administradora de Cartões Sicredi Ltda.(RS)</option>
                                            <option value="59438325000101">BANCO BRADESCO CARTÔES S/A - AMERICAM EXPRESS</option>
                                            <option value="62421979000129">BANCO GE-CAPITAL</option>
                                            <option value="58160789000128">BANCO SAFRA S/A</option>
                                            <option value="61071387000161">Unicard Banco Múltiplo S/A - TRICARD</option>
                                            <option value="00604122000197">TRIVALE Administração Ltda</option>
                                            <option value="01027058000191">Cielo</option>
                                            <option value="33479023000180">Diners</option>
                                            <option value="07965479000140">Amex</option>
                                            <option value="01425787000104">RedeCard</option>
                                        </select>
                                    </div>
                                    <div id="divTEFPOS" class="form-group col-md-4">
                                        <h6>Integração de Pagamento</h6>
                                        <select id="intPagamento" class="custom-select form-control" name="intPagamento">
                                            <option value="">...</option>
                                            <option value="1">TEF</option>
                                            <option value="2">POS</option>
                                        </select>
                                    </div> 
                                    <div id="divAutorizacaoCartao" class="form-group col-md-4">
                                        <h6>Código de Segurança</h6>
                                        <input id="inputCodigoSeguranca" type="number" class="form-control" name="codigoSeguranca" placeholder="..."/>
                                    </div>
                                    <div id="divinputDinheiro" class="form-group col-md-4" style="display: none;">
                                        <h6>Dinheiro</h6>
                                        <input id="inputDinheiro" type="number" class="form-control" name="inputDinheiro" placeholder="..."/>
                                    </div>
                                    <div id="divinputDesconto" class="form-group col-md-4" style="display: none;">
                                        <h6>Desconto</h6>
                                        <input id="inputDesconto" type="number" class="form-control" name="inputDesconto" placeholder="..."/>
                                    </div>
                                    <div id="divinputTroco" class="form-group col-md-4 mr-auto" style="display: none;">
                                        <h6>Troco</h6>
                                        <input id="inputTroco" type="number" class="form-control" name="inputTroco" placeholder="..." readonly step="any"/>
                                    </div>
                                </div><!-- END #divFormaPagamento_XmlGerar -->    
                            </div><!-- END #jumbotronProdutos -->
                        </div>
                    </div><!-- END #collapseTwo -->
                </div><!-- END .card-->            
                <div class="card text-center bg-light" id="cardCadastrarFormaPagamento">
                    <div class="card-header bg-dark" id="headingTwo">
                        <h5 class="mb-0 text-center">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
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
                            <div id="divinputNumero" class="form-group col-md-4" >
                                <h6>Número</h6>
                                <input id="inputNumero" type="number" class="form-control" name="inputNumero" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-4" >
                                <h6>Bairro</h6>
                                <input id="inputBairro" type="text" class="form-control" name="inputBairro" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-4" >
                                <h6>Complemento</h6>
                                <input id="inputComplemento" type="text" class="form-control" name="inputComplemento" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-4" >
                                <h6>CEP</h6>
                                <input id="inputCEP" type="number" class="form-control" name="inputCEP" placeholder="..."/>
                            </div>
                            <div id="divinputRegistro" class="form-group col-md-4" >
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
                                <textarea rows="4" cols="50" id="textAreaAdicional">Colocar aqui algum text padrão, exemplo nome da empresa, endereço, etc...</textarea>
                            </div>
                            <div class="col-md-12" id="divButtonFinalizarVenda">
                                <input type="button" class="btn btn-outline-success btn-lg btn-block" value="Finalizar Venda" id="buttonFinalizarVenda">
                            </div>
                            </div>
                        </div>
                    </div><!-- END #collapseThree -->
                </div><!-- END .card-->            
            </div><!-- END .accordion  -->
            </div> <!-- END .row -->
        </div> <!-- END .container -->
    </body>
</html>