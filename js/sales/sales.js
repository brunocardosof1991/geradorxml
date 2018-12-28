$(document).ready(function () {
    //Excluir Produto da tabela; Excluir linha da tabela; (Icone Lixeira)
    function excluirProdutoTabela()        
    {
        let $confirm = confirm("Tem certeza que deseja excluir o produto?");
        if($confirm)         
        {
            $(this).closest('tr').detach();
            
        }
    }
    //Verificar na pasta /Enviado/Autorizado da UniNFe se foi autorizado a NF
    function getFile() 
    {
        let chaveDeAcesso = true;
        $(() => {
            $.ajax({
                url: "http://localhost/erpsys/App/Controller/api.php",
                method: 'post',
                dataType: 'json',
                data: {chaveDeAcesso:chaveDeAcesso}
            }).done((data)=>{           
                if(data.status == 'success')
                {
                        $("#modalNFCeBody #p2").slideUp(700);
                        $('.chart').data('easyPieChart').update(100).options.barColor = '#0fe206';
                        $("#modalNFCeBody #p3").text('NFC-e enviada com sucesso!    ').append('<i class="fas fa-thumbs-up fa-2x " style="color:#0fe206"></i>').slideDown(700);

                } 
                if(data.status == 'error')
                {
                    setTimeout( () => { getFile(); }, 1500);
                }
            });
            
        });
    }
    //Deletar o arquivo produto_*.json que foi criado anteriormente
    function deleteFileProduto() 
    {
        let deleteFileProduto = true;
        $.ajax({
        type: 'post',
        url: 'http://localhost/erpsys/App/Controller/api.php',
        dataType: 'json',
        data: {
            deleteFileProduto:deleteFileProduto
        }
        });
    }    
    // Criar algo quando o usuários estiver logado/deslogado
    $('#botaoLogado').hover(() =>{
        alert('Logado');
    });
    $('#botaoDeslogado').hover(() =>{
        alert('Deslogado');
    });
    //Input que alimenta a tabela dos produtos
    // Ao apertar enter no input, manda o ajax para o server
    $('#inputBuscarProdutos').on('keyup',(e) => {    
    //Contador para cada linha da tabela
    var numeroLinha = 0;   
        if (e.keyCode === 13) 
        {
            numeroLinha++;
            e.preventDefault();      
            let produto = $('#inputBuscarProdutos').val();
            $.ajax({
                type: 'post',
                url: 'http://localhost/erpsys/App/Controller/api.php',
                dataType: 'json',
                data: {
                    produto:produto
                }
            }).done((data) => {
                // Verificar se o produto Existe
                if(data.status !== 'ok') 
                {
                    alert('Produto Não existe!');
                } else
                {
                    $.each(data,(index, value) =>
                    {
                        if(value.cProd && value.xProd && value.vProd)
                        {
                            var tr = 
                                $('<tr>').attr('id',numeroLinha)
                                .append(
                                $('<td>').text(value.cProd).attr('id','colunaId'+numeroLinha),
                                $('<td>').text(value.xProd).attr('id','colunaProduto'+numeroLinha),
                                $('<td>').text(value.vProd).attr('id','colunaPreco'+numeroLinha),
                                $('<td>').append("<input type='number' class='form-control' id='tableInputQuantidade' placeholder='Quantidade'/>")
                                .attr('id','colunaQuantidade'+numeroLinha),
                                $('<td>').append('<i class="fas fa-trash fa-2x"></i>').css({'cursor':'pointer', 'color':'#FF0516'}).click(excluirProdutoTabela))
                                .appendTo('#tableListarProdutos').html();
                        }
                    });
                }
            }); // END .done()
        }// END if (e.keyCode === 13) - ENTER
    }); //END keyup function
    //Botao (Forma de Pagamento)
    //Transforma a tabela em JSON
    $('#buttonFormaPagamento').on('click',() => {
        let table = $('#tableListarProdutos').tableToJSON({
            ignoreColumns: [3,4]
        });
        let quantidade = [];
        //Pegar o input quantidade dos produtos de cada linha
        $('#tableListarProdutos tr').each((i, n) =>
        {
            var $row = $(n);
            quantidade.push({
                Quantidade: $row.find('input').val()
            });
        });
        let sendTable = [];
        sendTable[0] = table;
        sendTable[1] = quantidade;
        //Verificar se tem algum input vazio das quantidades
        $.each(quantidade,(k,v) => {           
            if (Object.values(quantidade[k]).indexOf('') > -1) 
            {
                alert('Preencha as quantidades dos produtos corretamente');
                deleteFileProduto();
            }
        });
            $.ajax({
                type: 'post',
                url: 'http://localhost/erpsys/App/Controller/api.php',
                dataType: 'json',
                data: {
                    sendTable:sendTable
                }                
            }).done((data) => {                
            let $confirm = confirm("Produtos adicionados, deseja continuar?");
            if($confirm) //Botao Ok      
            {
                // será criado um arquivo com a data/hora atual com as informações do produto
                //Esconder jumbotron dos produtos
                $('#jumbotronProdutos').slideUp(1500);
                // Mostrar jumbotron das formas de pagamento
                $('#jumbotronFormaPagamento').slideDown(2100);
                let valorTotal = parseFloat((data).toFixed(2));
                $("#h5CardValorTotal").text(valorTotal).css("font-weight","Bold");
            } else //Botao Cancel
            {
                deleteFileProduto();
            }
            });
    });
    //#rowFormaPagamento
    // Colocar o resultado dessa função dentro de uma variavel, para resgatar essa valor no envio para o xml 
    let payment = $("#payment").change(() => {
        let formaPagamento = $("#payment").val();
        if(formaPagamento == 1 || formaPagamento == 2 ) 
        {
            $("#divTEFPOS").hide();
            $("#divCredCartao").hide();
            $("#divBandeira").hide();
            $("#divAutorizacaoCartao").hide();
            $("#rowFormaPagamento").addClass("w-100");

            $("#divFormaPagamento").addClass("mx-auto");
            $("#divinputDinheiro").show().addClass("mx-auto");
            $("#divinputDesconto").show().addClass("mx-auto");
            $("#divinputTroco").show().addClass("mr-auto");
            $("#divinputRegistro").show().addClass("mx-auto");
            $("#divinputNomeCliente").show().addClass("mx-auto");
            //Calcular Troco
            $('#inputDinheiro').focusout(() => {                    
                let val1 = $("#h5CardValorTotal").text();
                let val2 = $("#inputDinheiro").val();
                let result = val2 - val1;
                let resultParsed = parseFloat((result).toFixed(2));      
                $("#inputTroco").val(resultParsed).css({"color":"#ff1a1a", "font-weight":"Bold"});
            });
        } else {
            $("#divTEFPOS").show();
            $("#divCredCartao").show();
            $("#divBandeira").show();
            $("#divAutorizacaoCartao").show();
            $("#divinputDinheiro").hide();
            $("#divinputDesconto").hide();
            $("#divinputTroco").hide();
            $("#divinputRegistro").show();
            $("#divinputNomeCliente").show();
        }
    });
    //Enviar ID/NOME do cliente
    $('#inputName').on('keyup',(e) => {
        if (e.keyCode === 13) 
        {    
            var user_id = $('#container').find('input[name="inputName"]').val();
            $.ajax({
                type: 'POST',
                url: 'http://localhost/erpsys/App/Controller/api.php',
                dataType: "json",
                data: {user_id: user_id}
            }).done((data) =>{                
                if (data.status == 'ok') {
                    $('#container').find('input[name="clientID"]').val(data.result.id);
                    $('#container').find('input[name="inputName"]').val(data.result.name).slideDown();
                    $('#container').find('input[name="clientRegister"]').val(data.result.register).slideDown();
                    $('#container').find('input[name="clientCobAddress"]').val(data.result.cob_address).slideDown();
                    $('#container').find('input[name="clientCobAddressNumber"]').val(data.result.cob_address_number).slideDown();
                    $('#container').find('input[name="clientCobComplement"]').val(data.result.cob_complement).slideDown();
                    $('#container').find('input[name="clientCobNeighborhood"]').val(data.result.cob_neighborhood).slideDown();
                    $('#container').find('input[name="clientCobPostalCode"]').val(data.result.cob_postal_code).slideDown();
                    $('#container').find('input[name="clientPhoneCell"]').val(data.result.phone_cell).slideDown();
                } else {
                    alert("Cliente não existe no banco de dados");
                }
            });            
        } 
    });
    //Enviar inputs preenchidos para api
    $("#buttonFinalizarVenda").on('click',() => {
        let valorTotal = $("#h5CardValorTotal").text();
        let cliente = new Object();
        cliente.ID = $("#clientID").val();
        cliente.nome = $("#inputName").val();
        cliente.registro = $("#clientRegister").val();
        cliente.endereco = $("#clientCobAddress").val();
        cliente.numero = $("#clientCobAddressNumber").val();
        cliente.bairro = $("#clientCobNeighborhood").val();
        cliente.complemento = $("#clientCobComplement").val();
        cliente.CEP = $("#clientCobPostalCode").val();
        cliente.telefone = $("#clientPhoneCell").val();
        let formaDePagamento = new Object();
        if(payment.val() == 1 || payment.val() == 2 ) {
            formaDePagamento.formaPagamento = $("#payment").val();
            formaDePagamento.dinheiro = $("#inputDinheiro").val();
            formaDePagamento.desconto = $("#inputDesconto").val();
            formaDePagamento.troco = $("#inputTroco").val();
        } else {
            formaDePagamento.formaPagamento = $("#payment").val();
            formaDePagamento.bandeira = $("#selectBandeira").val();
            formaDePagamento.credCartao = $("#credCartao").val();
            formaDePagamento.integracaoPagamento = $("#intPagamento").val();
            formaDePagamento.codSeguranca = $("#inputCodigoSeguranca").val();
            formaDePagamento.formaPagamento = $("#payment").val();
        }
        //Enviar para o server um array com os objetos cliente e forma de pagamento
        // Valor total e informações adicionais da NFC-e
        let xml = [];
        xml[0] = cliente;
        xml[1] = formaDePagamento;
        xml[2] = valorTotal;
        // Texto do text area Informações Adicionais NFC-e
        xml[3] = $("#textAreaAdicional").val();
        $.ajax({
            type: 'post',
            url: 'http://localhost/erpsys/App/Controller/api.php',
            dataType: 'json',
            data: {
                xml:xml
            }
        }).done((chaveDeAcessoCriarJson) => {
            //Salvar a chave de acesso em um arquivo            
            $.ajax({
                type: 'post',
                url: 'http://localhost/erpsys/App/Controller/api.php',
                dataType: 'json',
                data: {chaveDeAcessoCriarJson:chaveDeAcessoCriarJson}
            });
            $("#modalNFCe").modal('show');
            $("#modalNFCe").on('shown.bs.modal', () => {
                $('.chart').easyPieChart({
                    // The color of the curcular bar. You can pass either a css valid color string like rgb, rgba hex or string colors. But you can also pass a function that accepts the current percentage as a value to return a dynamically generated color.
                    barColor: '#e60000',
                    // The color of the track for the bar, false to disable rendering.
                    trackColor: '#f2f2f2',
                    // The color of the scale lines, false to disable rendering.
                    scaleColor: '#dfe0e0',
                    // Defines how the ending of the bar line looks like. Possible values are: butt, round and square.
                    lineCap: 'round',
                    // Width of the bar line in px.
                    lineWidth: 3,
                    // Size of the pie chart in px. It will always be a square.
                    size: 110,
                    // Time in milliseconds for a eased animation of the bar growing, or false to deactivate.
                    animate: 13000,
                    // Callback function that is called at the start of any animation (only if animate is not false).
                    onStart: $.noop,
                    // Callback function that is called at the end of any animation (only if animate is not false).
                    onStop: $.noop
                  });
                $("#modalNFCeBody #p2").text('Enviando NFC-e para Sefaz,\n isso pode levar até 30s....');                
            });            
            getFile();
            }); // END of first .done ** Contem a chave de acesso**
        }); // END Click on buttonFinalizarVenda
    //Botao fechar modalNFC-e, redirecionar para vendas.php
    $("#buttonModalNFCefechar").on('click',() => {
        location = location;
    });         
});