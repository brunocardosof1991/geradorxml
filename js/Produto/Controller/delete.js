export const excluirProduto = $(document).on('click', '#excluirProduto',function() {       
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
                alert('Produto '+produto+' Foi Deletedo Com Sucesso!!');   
            }   
            location = location;        
        });          
    }
});