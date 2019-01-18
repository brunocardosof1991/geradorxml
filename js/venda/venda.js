$(document).ready(function(){ 
    //Verificar na pasta /Enviado/Autorizado da UniNFe se foi autorizado a NF
    //Função chamada na promise done do click no botao Finalizar Venda
    //Essa função contêm a criação da DANFE. Motivo: Só sera criado a DANFE se tudo ocorrer bem na autorização
    function confirmarAutorizacao() 
    {
        let chaveDeAcesso = true;
        $.ajax({
            url: "http://localhost/geradorXml/App/public/api/uninfe/autorizar/confirmar",
            method: 'post',
            dataType: 'json',
            data: {chaveDeAcesso:chaveDeAcesso}
        }).done(function (data){  
            if(data == 'success')
            {
                $("#apiModal .modal-body p").slideUp(850);
                $("#apiModal .modal-body p").text('NFC-e enviada com sucesso!   ').slideDown(850);
                $("#apiModal .modal-body").append('<i class="fas fa-thumbs-up fa-2x " style="color:#0fe206"></i>').slideDown(700);
                $('.chart').data('easyPieChart').update(100).options.barColor = '#0fe206';            
                $("#apiModal .modal-footer .action").text('Imprimir NFC-e').show();
                //DANFE
                let DANFE = true;
                $.ajax({
                    method: 'post',
                    url: 'http://localhost/geradorXml/App/public/api/DANFE',
                    dataType: 'json',
                    data:{DANFE:DANFE}
                }).done(function(data){
                });
            } 
            if(data == 'error')
            {
                setTimeout( function () { confirmarAutorizacao(); }, 1000);
                //MSG aparecendo mesmo data == 'success'
                // setTimeout( function () { alert('Erro ao autorizar NFC-e, VERIFICAR OS ARQUIVOS DE LOGS, MOSTRAR O ERRO NA TELA'); location = location;}, 30000);
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
                id: $row.find('td:eq(0)').text(),
                descricao: $row.find('td:eq(1)').text(),
                ncm: $row.find('td:eq(2)').text(),
                preco:   $row.find('td:eq(3)').text(),
                CFOP:    $row.find('td:eq(4)').text(),
                quantidade:       $row.find('input').val(),
                UN:       $row.find('#exampleFormControlSelect1').val(),
                total: parseFloat(($row.find('td:eq(3)').text() * $row.find('input').val()).toFixed(2))
            });
        });
        rows.splice(0,1);
        return JSON.stringify(rows);
    }
    function calcularValorTotal () 
    {
        let produto = JSON.parse(convertTableToJson());
        let size = Object.keys(produto).length;
        //Coletar a coluna dos preços
        let precoCol = '';
        let i = '';
        for(i=0; i< size; i++)
        {
            precoCol += produto[i]['preco']+'-';
        }
        //Coletar a coluna das quantidades
        let quantidadeCol = '';
        let j = '';
        for(j=0; j< size; j++)
        {
            quantidadeCol += produto[j]['quantidade']+'-';
        }
        let precoString = precoCol.slice(0,-1);
        let quantidadeString = quantidadeCol.slice(0,-1);
        var precoarray = precoString.split("-");
        var quantidadearray = quantidadeString.split("-");
        //Calcula a multiplicação de (precoarray[0]*quantidadearray[0])+(precoarray[1]*quantidadearray[1])+([2]*[2])+([3]*[3])...
        //Depois arrendonda o número com apenas duas casas decimais        
        let valorTotal = parseFloat((quantidadearray.reduce(function(r,a,i){return r+a*precoarray[i]},0)).toFixed(2));
        return valorTotal
    }
    //Ao clicar em Forma de Pagamento, a tabela HTML será convertida em json &&
    //Será feito o calculo do valor total dos produtos com as funções:
    //convertTableToJson() calcularValorTotal()
    $("#btnCollapseFormaPagamento_GerarXML").on('click',function(){ 
        convertTableToJson();
        $("#jumbotronProdutos #divValorTotal_GerarXml").find("#spanValorTotal").text(calcularValorTotal());
    });
    function excluirProdutoTabela()        
    {
        let $confirm = confirm("Tem certeza que deseja excluir o produto?");
        if($confirm)         
        {
            $(this).closest('tr').detach();
            
        }
    }
    $(document).on('click','.inputReset',function(){
        $("#inputSearchProduto_XmlGerar").val('');
    });
    $("#inputSearchProduto_XmlGerar").on('keyup', function (e){
        e.preventDefault();       
        if (e.keyCode === 13) 
        {
            let produto = $("#inputSearchProduto_XmlGerar").val();
            if (!isNaN(produto)) 
            {
                $.ajax({
                    method: 'get',
                    url: 'http://localhost/geradorXml/App/public/api/produto/'+produto,
                    dataType: 'json'
                }).done(function(data) {
                    if(data == '') 
                    {
                        alert("Produto não existe");
                    } else 
                    {
                        $("<tr>").append(
                        $("<td>").text(data[0].id),
                        $("<td>").text(data[0].descricao),
                        $("<td>").text(data[0].ncm).hide(),
                        $("<td>").text(data[0].preco_custo),
                        $("<td>").text(data[0].CFOP).hide(),
                        $('<td>').append("<input type='number' class='form-control' id='inputQuantidadeProduto_XmlGerar'/>"),
                        $('<td>').append('<div class="form-group">        <select class="form-control" id="exampleFormControlSelect1">        <option value="AMPOLA">AMPOLA</option>        <option value="BALDE">BALDE</option>        <option value="BANDEJ">BANDEJ</option>        <option value="BARRA">BARRA</option>        <option value="BISNAG">BISNAGA</option>        <option value="BLOCO">BLOCO</option>        <option value="BOBINA">BOBINA</option>        <option value="BOMBEAR">BOMBONA</option>        <option value="CAPSULAS">CÁPSULAS</option>        <option value="CARRINHO">CARTELA</option>        <option value="CENTO">CENTO</option>        <option value="CJ">CONJUNTO</option>        <option value="CM">CM</option>        <option value="CM2">CENTIMETRO QUADRADO</option>        <option value="CX">CAIXA</option>        <option value="CX2">CAIXA COM 2 UNIDADES</option>        <option value="CX5">CAIXA COM 5 UNIDADES</option>        <option value="CX10">CAIXA COM 10 UNIDADES</option>        <option value="CX15">CAIXA COM 15 UNIDADES</option>        <option value="CX20">CAIXA COM 20 UNIDADES</option>        <option value="CX25">CAIXA COM 25 UNIDADES</option>        <option value="CX50">CAIXA COM 50 UNIDADES</option>        <option value="CX100">CAIXA COM 100 UNIDADES</option>        <option value="DISP">EXIBIÇÃO</option>        <option value="DUZIA">DUZIA</option>        <option value="EMBAL">EMBALAGEM</option>        <option value="FARDO">FARDO</option>        <option value="FOLHA">FOLHA</option>        <option value="FRASCO">FRASCO</option>        <option value="GALAO">GALÃO</option>        <option value="GF">GARRAFA</option>        <option value="GRAMAS">GRAMAS</option>        <option value="JOGO">JOGO</option>        <option value="KG">QUILOGRAMA</option>        <option value="KIT">KIT</option>        <option value="LATA">LATA</option>        <option value="LITRO">LITRO</option>        <option value="M">M</option>        <option value="M2">M2</option>        <option value="M3">M3</option>        <option value="MILHEI">MILHEIRO</option>        <option value="ML">MILILITRO</option>        <option value="MWH">MEGAWATT HORA</option>        <option value="PACOTE">PACOTE</option>        <option value="PALETE">PALETE</option>        <option value="PARES">PARES</option>        <option value="PC">PEÇA</option>        <option value="AMIGO">AMIGO</option>        <option value="K">QUILATE</option>        <option value="RESMA">RESMA</option>        <option value="ROLO">ROLO</option>        <option value="SACO">SACO</option>        <option value="SACOLA">SACOLA</option>        <option value="TAMBOR">TAMBOR</option>        <option value="TANQUE">TANQUE</option>        <option value="TON">TONELADA</option>        <option value="TUBO">TUBO</option>        <option value="UN">UNIDADE</option>        <option value="VASIL">VASILHAME</option>        <option value="VIDRO">VIDRO</option>        </select>        </div>'),
                        $('<td>').append('<i class="fas fa-trash fa-2x"></i>').css({'cursor':'pointer', 'color':'#FF0516'}).click(excluirProdutoTabela)
                    ).appendTo('#tableListarProduto_XmlGerar tbody').html();                        
                    }
                });
            }else if (isNaN(produto))
            {
                $.ajax({
                    method: 'get',
                    url: 'http://localhost/geradorXml/App/public/api/produto/descricao/'+produto,
                    dataType: 'json'
                }).done(function(data) {
                    console.log(data);
                    if(data == '') 
                    {
                        alert("Produto não existe");
                    } else 
                    {
                        $("<tr>").append(
                        $("<td>").text(data[0].id),
                        $("<td>").text(data[0].descricao),
                        $("<td>").text(data[0].ncm).hide(),
                        $("<td>").text(data[0].preco_custo),
                        $("<td>").text(data[0].CFOP).hide(),
                        $('<td>').append("<input type='number' class='form-control' id='inputQuantidadeProduto_XmlGerar'/>"),
                        $('<td>').append('<div class="form-group">        <select class="form-control" id="exampleFormControlSelect1">        <option value="AMPOLA">AMPOLA</option>        <option value="BALDE">BALDE</option>        <option value="BANDEJ">BANDEJ</option>        <option value="BARRA">BARRA</option>        <option value="BISNAG">BISNAGA</option>        <option value="BLOCO">BLOCO</option>        <option value="BOBINA">BOBINA</option>        <option value="BOMBEAR">BOMBONA</option>        <option value="CAPSULAS">CÁPSULAS</option>        <option value="CARRINHO">CARTELA</option>        <option value="CENTO">CENTO</option>        <option value="CJ">CONJUNTO</option>        <option value="CM">CM</option>        <option value="CM2">CENTIMETRO QUADRADO</option>        <option value="CX">CAIXA</option>        <option value="CX2">CAIXA COM 2 UNIDADES</option>        <option value="CX5">CAIXA COM 5 UNIDADES</option>        <option value="CX10">CAIXA COM 10 UNIDADES</option>        <option value="CX15">CAIXA COM 15 UNIDADES</option>        <option value="CX20">CAIXA COM 20 UNIDADES</option>        <option value="CX25">CAIXA COM 25 UNIDADES</option>        <option value="CX50">CAIXA COM 50 UNIDADES</option>        <option value="CX100">CAIXA COM 100 UNIDADES</option>        <option value="DISP">EXIBIÇÃO</option>        <option value="DUZIA">DUZIA</option>        <option value="EMBAL">EMBALAGEM</option>        <option value="FARDO">FARDO</option>        <option value="FOLHA">FOLHA</option>        <option value="FRASCO">FRASCO</option>        <option value="GALAO">GALÃO</option>        <option value="GF">GARRAFA</option>        <option value="GRAMAS">GRAMAS</option>        <option value="JOGO">JOGO</option>        <option value="KG">QUILOGRAMA</option>        <option value="KIT">KIT</option>        <option value="LATA">LATA</option>        <option value="LITRO">LITRO</option>        <option value="M">M</option>        <option value="M2">M2</option>        <option value="M3">M3</option>        <option value="MILHEI">MILHEIRO</option>        <option value="ML">MILILITRO</option>        <option value="MWH">MEGAWATT HORA</option>        <option value="PACOTE">PACOTE</option>        <option value="PALETE">PALETE</option>        <option value="PARES">PARES</option>        <option value="PC">PEÇA</option>        <option value="AMIGO">AMIGO</option>        <option value="K">QUILATE</option>        <option value="RESMA">RESMA</option>        <option value="ROLO">ROLO</option>        <option value="SACO">SACO</option>        <option value="SACOLA">SACOLA</option>        <option value="TAMBOR">TAMBOR</option>        <option value="TANQUE">TANQUE</option>        <option value="TON">TONELADA</option>        <option value="TUBO">TUBO</option>        <option value="UN">UNIDADE</option>        <option value="VASIL">VASILHAME</option>        <option value="VIDRO">VIDRO</option>        </select>        </div>'),
                        $('<td>').append('<i class="fas fa-trash fa-2x"></i>').css({'cursor':'pointer', 'color':'#FF0516'}).click(excluirProdutoTabela)
                    ).appendTo('#tableListarProduto_XmlGerar tbody').html();                        
                    }
                });
            }            
            $("#inputSearchProduto_XmlGerar").val('');
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
                    $('#container').find('input[name="clientID"]').val(data[0].id);
                    $('#container').find('input[name="inputName"]').val(data[0].nome);
                    $('#container').find('input[name="inputRegistro"]').val(data[0].CNPJ);
                    $('#container').find('input[name="inputEndereco"]').val(data[0].endereco);
                    $('#container').find('input[name="inputNumero"]').val(data[0].numero);
                    $('#container').find('input[name="inputComplemento"]').val(data[0].complemento);
                    $('#container').find('input[name="inputBairro"]').val(data[0].bairro);
                    $('#container').find('input[name="inputCEP"]').val(data[0].CEP);
                    $('#container').find('input[name="inputFone"]').val(data[0].fone);
                    $('#container').find('input[name="inputMunicipio"]').val(data[0].municipio);
                    $('#container').find('input[name="inputUF"]').val(data[0].UF);
                });
            }     
        } 
    });
    //Coletar Emissor para ser enviado por JSON na rota autorizarNFCe, alimentar arrays emit enderEmit
    var emissor = [];
    let ajax = $.ajax({
        method:'get',
        url:'http://localhost/geradorXml/App/public/api/emissor/',
        dataType: 'json',            
    }).done(function(data){
        emissor = ajax.responseJSON;
    });
    $("#buttonFinalizarVenda").click(function(){//Coletar todos inpts        
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
        var produto = convertTableToJson();
        var valorTotal = calcularValorTotal();
        //Text Area com as informações adicionais da NFC-e
        var textArea = $("#textAreaAdicional").val();
        // Array para ser transformado em JSON
        var array = [];
        array[0] = removeEmpty(input);
        delete array[0].undefined
        array[1] = removeEmpty(select);
        delete array[1].undefined
        array[2] = textArea;
        array[3] = valorTotal;
        array[4] = emissor[0];
        var json = JSON.stringify(array);
        //Enviar JSON para rota de criação da DANFE
        // Alimentar o XML para autorização
        $.ajax({
            method:'post',
            url:'http://localhost/geradorXml/App/public/api/uninfe/autorizar',
            dataType: 'json',
            data:{json:json, produto:produto}
        }).done(function (data)
        {
            if(data == '{"success": "XML Autorizado"}')
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
                        animate: 30000,
                        // Callback function that is called at the start of any animation (only if animate is not false).
                        onStart: $.noop,
                        // Callback function that is called at the end of any animation (only if animate is not false).
                        onStop: $.noop
                    });               
                }); 
                confirmarAutorizacao();
            }
        });
    });
    //Botao fechar modalNFC-e, redirecionar para vendas.php
    $(".modalApi_fechar").on('click',function() {
        location = location;
    });     
});