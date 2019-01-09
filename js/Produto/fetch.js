$(document).ready(function(){
    fetchAll();  
    function fetchAll() 
    {        
        $.ajax({
            method: 'get',
            url: 'http://localhost/geradorXml/App/public/api/produto/'
        }).done(function(data) {
			$("#container").find('table tbody').html(data);            
        });
    }
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
                if(data == '{"Aviso": {"text": "Produto Deletado"}')
                {
                    alert(produto+' Deletedo Com Sucesso!!');   
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
                if(data == '{\"Aviso\": {\"text\": \"Produto Atualizado\"}')
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
                if(data == '{"Aviso": {"text": "Produto Adicionado"}')
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