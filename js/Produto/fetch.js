$(document).ready(function(){            
    var table = $("#tableListarProdutos").DataTable({
    pagingType: "full_numbers",
    responsive: true,
    ajax: {
        url: 'http://localhost/geradorXml/App/public/api/produto/',
        method: "get",
        dataSrc: ""
    },
    columns: 
    [
        { data: "id" },
        { data: "descricao" },
        { data: "ncm" },
        { data: "preco_custo" },
        { data: "CFOP" },
        { data: "Editar" },
        { data: "Excluir" }
    ],
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
    $(document).on('click', '#excluirProduto',function() {       
        var id = $(this).closest('tr').children('td:eq(0)').text();
        var produto = $(this).closest('tr').children('td:eq(1)').text();
        let $confirm = confirm("Tem certeza que deseja excluir o produto "+produto);
        if($confirm)         
        {    
            $.ajax({
                method:'delete',
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
    $(document).on('click', '#editarProduto',function() {   
        var id = $(this).closest('tr').children('td:eq(0)').text();
        var descricaoTable = $(this).closest('tr').children('td:eq(1)').text();
        var NCMTable = $(this).closest('tr').children('td:eq(2)').text();
        var preco_custoTable = $(this).closest('tr').children('td:eq(3)').text();
        var CFOPTable = $(this).closest('tr').children('td:eq(4)').text();
        $("#apiModal .modal-body .chart").remove(); 
        $("#apiModal .modal-body p").remove(); 
        $("h1").remove(); 
        $("#apiModal .modal-title").text('Editar Produto');
        $("#apiModal").modal('show');
        $("#apiModal .modal-body").append($('#formProduto').show());
        $("#apiModal .modal-footer .action").text('Editar').show(); 
        $('#inputDescricaoProduto').val(descricaoTable);
        $('#inputNCMProduto').val(NCMTable);
        $('#inputPrecoProduto').val(preco_custoTable);
        $('#inputCFOPProduto').val(CFOPTable);        
        $("#apiModal .modal-footer .action").on('click',function(){
            let descricao = $('#inputDescricaoProduto').val();
            let NCM = $('#inputNCMProduto').val();
            let preco_custo = $('#inputPrecoProduto').val();
            let CFOP = $('#inputCFOPProduto').val();
            $.ajax({
                method:'put',
                url: 'http://localhost/geradorXml/App/public/api/produto/update/'+id,
                dataType: 'json',
                data:{id:id, descricao:descricao, NCM:NCM, preco_custo:preco_custo, CFOP:CFOP}
            }).done(function(data){
                if(data == '{"success": "Produto Atualizado"}')
                {
                    alert('Produto Atualizado');
                    location = location;             
                }
            });
        });
    });
    $(document).on('click','#addProduto',function(){
    $("#apiModal .modal-body .chart").remove(); 
    $("#apiModal .modal-body p").remove(); 
    $("h1").remove(); 
    $("#apiModal .modal-title").text('Cadastrar Produto');
    $("#apiModal").modal('show');
    $('#apiModal').on('shown.bs.modal', function (e) {
        $(this)
          .find("input,textarea,select")
             .val('')
             .end()
          .find("input[type=checkbox], input[type=radio]")
             .prop("checked", "")
             .end();
    });
    $("#apiModal .modal-body").append($('#formProduto').show());
    $("#apiModal .modal-footer .action").text('Cadastrar').show();        
    $("#apiModal .modal-footer .action").on('click', function (e){
        let descricao = $('#inputDescricaoProduto').val();
        let NCM = $('#inputNCMProduto').val();
        let preco_custo = $('#inputPrecoProduto').val();
        let CFOP = $('#inputCFOPProduto').val();
        $.ajax({
            method:'post',
            url: 'http://localhost/geradorXml/App/public/api/produto/add',
            dataType: 'json',
            data:{descricao:descricao, ncm:NCM, preco_custo:preco_custo, CFOP:CFOP}
            }).done(function(data){
                if(data == '{"success": "Produto Adicionado"}')
                {
                    alert('Produto Adicionado com Sucesso'); 
                    location = location;
                }
            });
        });
    });
    //Botao fechar modalNFC-e, redirecionar para vendas.php
    $(".modalApi_fechar").on('click',function() {
        location = location;
    });    
});