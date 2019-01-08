$(document).ready(function () {
    fetchAll();
    function fetchAll() 
    {        
        $.ajax({
            method: 'get',
            url: 'http://localhost/geradorXml/App/public/api/nf/'
        }).done(function(data) {
			$("#container").find('table tbody').html(data);            
        });
    }    
    $(document).on('click', '.excluir', function () {
        let id = ($(this).closest('tr').children(":first").text());
        let chave = $("#tableListarNF").find("td:eq(1)").text();
        let $confirm = confirm("Nota com a chave de acesso "+chave+".\nTem certeza que deseja excluir do banco de dados?");
        if($confirm)         
        {    
            $.ajax({
                method:'delete',
                url: 'http://localhost/geradorXml/App/public/api/nf/delete/'+id
            }).done(function(data) {
                fetchAll();
                if(data == '{"Aviso": {"text": "NF Deletada"}')
                {
                    alert(chave+' Deleteda Com Sucesso!!');   
                }             
            });          
        }
    });
    $(document).on('click', '.cancelar', function() {
        console.log('abc');
    });

});