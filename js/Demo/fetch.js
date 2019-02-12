$(function () {
    //Datatable é uma plugin em jQuery para tabelas dinamicas
    //Está configurado como CDN no <head> de produto.php
    var table = $("#tableListarProdutos").DataTable({
        //Adicionar os botões Primeiro e Último da tabela
        pagingType: "full_numbers",
        ajax: {
            //URL da API para pegar todos os produtos
            url: 'http://localhost/geradorXml/App/public/api/produto/',
            // Método HTTP
            method: "get",
            // Sem essa config não aparece os dados
            dataSrc: ""
        },
        //Colunas da tabela
        columns:
            [
                { data: "id" },
                { data: "descricao" },
                { data: "ncm" },
                { data: "preco_custo" },
                { data: "CFOP" },
                { data: "cEAN" },
                { data: "Editar" },
                { data: "Excluir" }
            ],
        //Adicionar os botoes de excluir e edtiar na tabela
        columnDefs:
            [
                {
                    targets: [-1],
                    data: null,
                    defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-user-edit fa-2x' id='editarProduto' style='cursor:pointer;color:orange' title='Editar'></i></a></div>"
                },
                {
                    targets: [-2],
                    data: null,
                    defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-trash fa-2x' id='excluirProduto' style='cursor:pointer;color:red' title='Excluir'></i></a></div>"
                }
            ]
    });
    $(document).on('click', '#addProduto', function () {
        //Por padrão o modal ja vem com o .chart (Barra de Progresso da autorização da NFC-e)
        $("#apiModal .modal-body .chart").remove();
        //<p>Enviando NFC-e para o Sefaz, isso pode levar até 30s</p>
        $("#apiModal .modal-body p").remove();
        //Remove o <h1>
        $("h1").remove();
        //Modifica o Título do modal 
        $("#apiModal .modal-title").text('Cadastrar Produto');
        //Mostra o modal
        $("#apiModal").modal('show');
        //Quando o modal aparecer, será resetado o formProduto
        $('#apiModal').on('shown.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });
        //Acrescenta o formProduto no modal
        $("#apiModal .modal-body").append($('#formProduto').show());
        //Modifica o texto do botao submit para 'Cadastrar'
        $("#apiModal .modal-footer .action").text('Cadastrar').show();
        //Quando clicar no botao Cadastrar, será enviado um ajax para a API      
        $("#apiModal .modal-footer .action").on('click', function (e) {
            //Pegar os valores dos inputs
            let descricao = $('#inputDescricaoProduto').val();
            let NCM = $('#inputNCMProduto').val();
            let preco_custo = $('#inputPrecoProduto').val();
            let CFOP = $('#inputCFOPProduto').val();
            let cEAN = $('#inputcEANProduto').val();
            $.ajax({
                //Método HTTP
                method: 'post',
                //URL da Api
                url: 'http://localhost/geradorXml/App/public/api/produto/add',
                // Formato de envio dos dados
                dataType: 'json',
                //Dados a serem enviados
                data: { descricao: descricao, ncm: NCM, preco_custo: preco_custo, CFOP: CFOP, cEAN: cEAN }
                //Se tudo ocorrer bem, será retornado a mesangem success
            }).done(function (data) {
                //Retorno da função add da model Produto
                if (data == '{"success": "Produto Adicionado"}') {
                    alert('Produto Adicionado com Sucesso');
                    //Atualizar a pg 
                    location = location;
                }
            });
        });
    });
    $(document).on('click','#editarProduto',function(){
        //Pega as informações da row selecionada (TR da tabela)  
        var id = $(this).closest('tr').children('td:eq(0)').text();
        var descricaoTable = $(this).closest('tr').children('td:eq(1)').text();
        var NCMTable = $(this).closest('tr').children('td:eq(2)').text();
        var preco_custoTable = $(this).closest('tr').children('td:eq(3)').text();
        var CFOPTable = $(this).closest('tr').children('td:eq(4)').text();
        var cEANTable = $(this).closest('tr').children('td:eq(5)').text();
        $("#apiModal .modal-body .chart").remove(); 
        $("#apiModal .modal-body p").remove(); 
        $("h1").remove(); 
        $("#apiModal .modal-title").text('Editar Produto');
        $("#apiModal").modal('show');
        $("#apiModal .modal-body").append($('#formProduto').show());
        $("#apiModal .modal-footer .action").text('Editar').show(); 
        //Injetar no form  as informações da row selecionada (TR da tabela)
        $('#inputDescricaoProduto').val(descricaoTable);
        $('#inputNCMProduto').val(NCMTable);
        $('#inputPrecoProduto').val(preco_custoTable);
        $('#inputCFOPProduto').val(CFOPTable);        
        $('#inputcEANProduto').val(cEANTable);  
        //Ao clicar em editar, será enviado um ajax para a API      
        $("#apiModal .modal-footer .action").on('click',function(){
            // Pegar os valores dos inputs
            let descricao = $('#inputDescricaoProduto').val();
            let NCM = $('#inputNCMProduto').val();
            let preco_custo = $('#inputPrecoProduto').val();
            let CFOP = $('#inputCFOPProduto').val();
            let cEAN = $('#inputcEANProduto').val();
            $.ajax({
                //Método HTTP
                method:'put',
                //Rota para atualizar produto
                url: 'http://localhost/geradorXml/App/public/api/produto/update/'+id,
                //Formato de envio dos dados
                dataType: 'json',
                //Dados a serem enviado
                data:{id:id, descricao:descricao, NCM:NCM, preco_custo:preco_custo, CFOP:CFOP,cEAN:cEAN}
            }).done(function(data){
                //Retorno da função update da model Produto
                if(data == '{"success": "Produto Atualizado"}')
                {
                    alert('Produto Atualizado');
                    location = location;             
                }
            });
        });
    });    
    $(document).on('click', '#excluirProduto',function() {  
        //Pega o ID e o nome do produtoda row selecionada (TR da tabela)  
        var id = $(this).closest('tr').children('td:eq(0)').text();
        var produto = $(this).closest('tr').children('td:eq(1)').text();
        //Confirmação de exclusão
        let $confirm = confirm("Tem certeza que deseja excluir o produto "+produto);
        if($confirm)         
        {    
            $.ajax({
                //Método HTTP
                method:'delete',
                //Rota para exclusão do produto
                url: 'http://localhost/geradorXml/App/public/api/produto/delete/'+id
            }).done(function(data){
                if(data == '{"success": "Produto Deletado"}')
                {
                    alert(produto+' Foi Deletedo Com Sucesso!!');   
                }   
                location = location;        
            });          
        }
    });
});//END Document Ready