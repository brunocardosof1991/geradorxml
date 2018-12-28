$(document).ready(function(){
    function convertTableToJson ()
    {
        const rows = [];
        $('table#tableListarProduto_XmlGerar tr').each(function(i, n){
            var $row = $(n);
            rows.push({
                id: $row.find('td:eq(0)').text(),
                produto:   $row.find('td:eq(1)').text(),
                preco:    $row.find('td:eq(2)').text(),
                quantidade:       $row.find('input').val()
            });
        });
        rows.splice(0,2);
        return JSON.stringify(rows);
    };
    function calcularValorTotal () 
    {
        const table = convertTableToJson();
        let produto = JSON.parse(table);
        var size = Object.keys(produto).length;
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
        var arrayQuantidade = quantidade.split("-");
        var arrayPreco = preco.split("-");
        let precoTotal = '';
        let k = '';
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
    $("#inputSearchProduto_XmlGerar").on('keyup', (e)=>{
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
                    url: 'http://localhost/geradorXml/public/api/produto/'+produto,
                    dataType: 'json'
                }).done((data) => {
                    if(data === false || data == '') 
                    {
                        alert("Produto não existe");
                    } else {
                        $("<tr>").append(
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
});