$(document).ready(function(){
    fetchAll();  
    function fetchAll() 
    {        
        $.ajax({
            method: 'get',
            url: 'http://localhost/geradorXml/App/public/api/produto/'
        }).done((data) => {
			$("#container").find('table tbody').html(data);            
        });
    }
    $(document).on('click', '#excluirProduto',() => {       
        var id = $(this).closest('tr').children('td:eq(0)').text();
        var produto = $(this).closest('tr').children('td:eq(1)').text();
        let $confirm = confirm("Tem certeza que deseja excluir o produto "+produto);
        if($confirm)         
        {    
            $.ajax({
                method:'delete',
                url: 'http://localhost/geradorXml/App/public/api/produto/delete/'+id
            }).done((data) =>{
                if(data == '{"Aviso": {"text": "Produto Deletado"}')
                {
                    alert(produto+' Deletedo Com Sucesso!!');   
                }   
                location = location;        
            });          
        }
    });
    $(document).on('click', '#editarProduto',() => {   
        let id = $("#tableListarProdutos").find("td:eq(0)").text();
        let descricaoTable = $("#tableListarProdutos").find("td:eq(1)").text();
        let NCMTable = $("#tableListarProdutos").find("td:eq(2)").text();
        let preco_custoTable = $("#tableListarProdutos").find("td:eq(3)").text();
        let CFOPTable = $("#tableListarProdutos").find("td:eq(4)").text();
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
        $("#apiModal .modal-footer .action").on('click',()=>{
            let descricao = $('#inputDescricaoProduto').val();
            let NCM = $('#inputNCMProduto').val();
            let preco_custo = $('#inputPrecoProduto').val();
            let CFOP = $('#inputCFOPProduto').val();
            $.ajax({
                method:'put',
                url: 'http://localhost/geradorXml/App/public/api/produto/update/'+id,
                dataType: 'json',
                data:{id:id, descricao:descricao, NCM:NCM, preco_custo:preco_custo, CFOP:CFOP}
            }).done((data)=>{
                if(data == '{\"Aviso\": {\"text\": \"Produto Atualizado\"}')
                {
                    alert('Produto Atualizado');
                    location = location;  
                }
            });
        });
    });
});