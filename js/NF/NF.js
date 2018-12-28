$(document).ready(function () {
    fetchAll();
    function fetchAll() 
    {        
        $.ajax({
            method: 'get',
            url: 'http://localhost/geradorXml/public/api/nf/'
        }).done((data) => {
			$("#container").find('table tbody').html(data);            
        });
    }
    function compartilharNF() 
    {
        let id = ($(this).closest('tr').children(":first").text());
        let chave = $("#tableListarNF").find("td:eq(1)").text();
        let $confirm = confirm("Nota com a chave de acesso "+chave+".\nEnviar por email?facebook?twitter");
        if($confirm)         
        {
            alert('Enviado');         
        }
    }
    $(document).on('click', '.excluir',function excluirNF() 
    {
        let id = ($(this).closest('tr').children(":first").text());
        let chave = $("#tableListarNF").find("td:eq(1)").text();
        let $confirm = confirm("Nota com a chave de acesso "+chave+".\nTem certeza que deseja excluir do banco de dados?");
        if($confirm)         
        {    
            $.ajax({
                method:'delete',
                url: 'http://localhost/geradorXml/public/api/nf/delete/'+id
            }).done((data) =>{
                fetchAll();
                if(data == '{"Aviso": {"text": "NF Deletada"}')
                {
                    alert(chave+' Deleteda Com Sucesso!!');   
                }             
            });          
        }
    });
    function duplicarNF() 
    {
        let id = ($(this).closest('tr').children(":first").text());
        let chave = $("#tableListarNF").find("td:eq(1)").text();
        let $confirm = confirm("Nota com a chave de acesso "+chave+".\nTem certeza que deseja duplicar?");
        if($confirm)         
        {
            $.ajax({
                method:'get',
                url:'http://localhost/geradorXml/public/api/nf/'+id,
                dataType:'json'                
            }).done((data)=>{
                    $('#inputFetchNF_ID').val(data.id).prop('readonly', false);
                    $('#inputFetchNF_CNPJ').val(data.CNPJDestinatario).prop('readonly', false);
                    $('#inputFetchNF_Nome').val(data.xNomeDestinatario).prop('readonly', false);
                    $('#inputFetchNF_Chave').val(data.chave).prop('readonly', false);
                    $('#inputFetchNF_cNF').val(data.cNF).prop('readonly', false);
                    $('#inputFetchNF_nNF').val(data.nNF).prop('readonly', false);
                    $('#inputFetchNF_Hora').val(data.dhEmi).prop('readonly', true);
                    $('#apiModal .modal-body #api_form .col').addClass('mt-3');
                    $('#button_action').val('Editar');
                    $('#apiModal').modal('show');
                    $('#apiModal').on('hidden.bs.modal', function (e) {
                        $(".modal-body").html("");
                    });            
            });
        }
    }
});