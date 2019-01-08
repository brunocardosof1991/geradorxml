$(document).ready(function(){ 
    //Verificar na pasta /Enviado/Autorizado da UniNFe se foi autorizado a NF
    function getNF() 
    {
        let chaveDeAcesso = true;
        $.ajax({
            url: "http://localhost/geradorXml/App/public/api/autorizarXml/true",
            method: 'post',
            dataType: 'json',
            data: {chaveDeAcesso:chaveDeAcesso}
        }).done(function (data){         
            console.log(data);  
            if(data == 'success')
            {
                $("#apiModal .modal-body p").slideUp(850);
                $("#apiModal .modal-body p").text('NFC-e enviada com sucesso!   ').slideDown(850);
                $("#apiModal .modal-body").append('<i class="fas fa-thumbs-up fa-2x " style="color:#0fe206"></i>').slideDown(700);
                $('.chart').data('easyPieChart').update(100).options.barColor = '#0fe206';
                $("#apiModal .modal-footer .action").text('Imprimir NFC-e').show();
            } 
            if(data == 'error')
            {
                setTimeout( function () { getNF(); }, 1500);
            }
        });     
    }
    // This method iterates over an object and removes all keys with falsy values.
    const removeEmpty = function (obj) {
        let newObj = {};
        Object.keys(obj).forEach(function (prop) {
          if (obj[prop]) { newObj[prop] = obj[prop]; }
        });
        return newObj;
    };
    function convertTableToJson ()
    {
        const rows = [];
        $('table#tableListarProduto_XmlGerar tr').each(function(i, n){
            let $row = $(n);
            rows.push({
                NCM: $row.find('td:eq(0)').text(),
                CFOP: $row.find('td:eq(1)').text(),
                id: $row.find('td:eq(2)').text(),
                produto:   $row.find('td:eq(3)').text(),
                preco:    $row.find('td:eq(4)').text(),
                quantidade:       $row.find('input').val()
            });
        });
        rows.splice(0,2);
        return JSON.stringify(rows);
    }
    function calcularValorTotal () 
    {
        let produto = JSON.parse(convertTableToJson());
        let size = Object.keys(produto).length;
        //Coletar a coluna dos precos
        let preco = '';
        let i = '';
        for(i=0; i< size; i++)
        {
            preco += produto[i]['preco']+'-';
        }
        //Coletar a coluna das quantidades
        let quantidade = '';
        let j = '';
        for(j=0; j< size; j++)
        {
            quantidade += produto[j]['quantidade']+'-';
        }
        let arrayQuantidade = quantidade.split("-");
        let arrayPreco = preco.split("-");
        //Multiplicar 2 arrays
        return arrayQuantidade.reduce(function(r,a,i){return r+a*arrayPreco[i]},0);
    }
    //Ao clicar em Forma de Pagamento, a tabela HTML será convertida em json &&
    //Será feito o calculo do valor total dos produtos com as funções:
    //convertTableToJson() calcularValorTotal()
    $("#btnCollapseFormaPagamento_GerarXML").on('click',function(){
        convertTableToJson();
        let spanText = $("#jumbotronProdutos #divValorTotal_GerarXml").find("#spanTextTotal").text();
        let spanValorTotal = $("#jumbotronProdutos #divValorTotal_GerarXml").find("#spanValorTotal").text(calcularValorTotal());
    });
    function excluirProdutoTabela()        
    {
        let $confirm = confirm("Tem certeza que deseja excluir o produto?");
        if($confirm)         
        {
            $(this).closest('tr').detach();
            
        }
    }
    $("#inputSearchProduto_XmlGerar").on('keyup', function (e){
        e.preventDefault();       
        if (e.keyCode === 13) 
        {
            let produto = $("#inputSearchProduto_XmlGerar").val();
            if(produto == '')
            {
                alert("Produto não existe");
            } else 
            {
                $.ajax({
                    method: 'get',
                    url: 'http://localhost/geradorXml/App/public/api/produto/'+produto,
                    dataType: 'json'
                }).done(function(data) {
                    if(data === false || data == '') 
                    {
                        alert("Produto não existe");
                    } else {
                        $("<tr>").append(
                            $("<td>").text(data.ncm).hide(),
                            $("<td>").text(data.CFOP).hide(),
                            $("<td>").text(data.id),
                            $("<td>").text(data.descricao),
                            $("<td>").text(data.preco_custo),
                            $('<td>').append("<input type='number' class='form-control' id='inputQuantidadeProduto_XmlGerar' placeholder='Quantidade'/>"),
                            $('<td>').append('<i class="fas fa-trash fa-2x"></i>').css({'cursor':'pointer', 'color':'#FF0516'}).click(excluirProdutoTabela)
                        ).appendTo('#tableListarProduto_XmlGerar tbody').html();
                    }
                });
            }
        }
    });    
    //#rowFormaPagamento
    $("#payment").change(function () {
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
            $('#inputDinheiro').focusout(function () {                    
                let val1 = calcularValorTotal();
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
    $('#inputName').on('keyup',function(e) {
        if (e.keyCode === 13) 
        {    
            var user_id = $('#container').find('input[name="inputName"]').val();
            if(user_id == '')
            {
                alert("Cliente não existe");
            } else 
            {
                $.ajax({
                    method: 'get',
                    url: 'http://localhost/geradorXml/App/public/api/cliente/'+user_id,
                    dataType: 'json'
                }).done(function(data) {
                    $('#container').find('input[name="clientID"]').val(data.id);
                    $('#container').find('input[name="inputName"]').val(data.nome);
                    $('#container').find('input[name="inputRegistro"]').val(data.CNPJ);
                    $('#container').find('input[name="inputEndereco"]').val(data.endereco);
                    $('#container').find('input[name="inputNumero"]').val(data.numero);
                    $('#container').find('input[name="inputComplemento"]').val(data.complemento);
                    $('#container').find('input[name="inputBairro"]').val(data.bairro);
                    $('#container').find('input[name="inputCEP"]').val(data.CEP);
                    $('#container').find('input[name="inputFone"]').val(data.fone);
                });
            }     
        } 
    });
    $("#buttonFinalizarVenda").click(function(){
        //Coletar todos inpts        
        var input = {};
        $("input").each(function() {
            input[$(this).attr("name")] = $(this).val();
        });
        //Coletar todos selects    
        if($("#payment").val() != 1 || $("#payment").val() != 2 )
        {
            var select = {};
            $("select").each(function() {
                select[$(this).attr("name")] = $(this).val();
            });
        }
        //Tabela HTML dos produtos convertida em JSON
        let produto = convertTableToJson();
        let valorTotal = calcularValorTotal();
        //Text Area com as informações adicionais da NFC-e
        let textArea = $("#textAreaAdicional").val();
        // Array para ser transforma em JSON
        let array = [];
        array[0] = removeEmpty(input);
        array[1] = removeEmpty(select);
        array[2] = textArea;
        array[3] = valorTotal;
        let json = JSON.stringify(array);
        // Alimentar o XML para autorização
        $.ajax({
            method:'post',
            url:'http://localhost/geradorXml/App/public/api/autorizarXml',
            dataType: 'json',
            data:{json:json, produto:produto}
        }).done(function (data)
        {
            $("#apiModal").modal('show');
            $("#apiModal .modal-title").text('Autorização NFC-e');
            $("#apiModal").on('shown.bs.modal', function() {    
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
                    animate: 22000,
                    // Callback function that is called at the start of any animation (only if animate is not false).
                    onStart: $.noop,
                    // Callback function that is called at the end of any animation (only if animate is not false).
                    onStop: $.noop
                  });               
            }); 
            getNF();
        });
    });
    //Botao fechar modalNFC-e, redirecionar para vendas.php
    $(".modalApi_fechar").on('click',function() {
        location = location;
    });     
});