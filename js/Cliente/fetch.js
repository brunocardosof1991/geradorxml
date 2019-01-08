$(document).ready(function () {   
    fetchAll();
    function fetchAll() 
    {        
        $.ajax({
            method: 'get',
            url: 'http://localhost/geradorXml/App/public/api/cliente/'
        }).done(function(data) {
			$("#container").find('table tbody').html(data);            
        });
    }        
    $(document).on('click', '#excluirCliente',function() {       
        var id = $(this).closest('tr').children('td:eq(0)').text();
        var nome = $(this).closest('tr').children('td:eq(1)').text();
        let $confirm = confirm("Tem certeza que deseja excluir o/a cliente "+nome);
        if($confirm)         
        {    
            $.ajax({
                method:'delete',
                url: 'http://localhost/geradorXml/App/public/api/cliente/delete/'+id
            }).done(function(data){
                if(data == '{"Aviso": {"text": "Produto Deletado"}')
                {
                    alert(nome+' Deletedo Com Sucesso!!');   
                }   
                location = location;        
            });          
        }
    });
    $(document).on('click', '#editarCliente',function() {   
        var id = $(this).closest('tr').children('td:eq(0)').text();
        var nomeTable = $(this).closest('tr').children('td:eq(1)').text();
        var CNPJTable = $(this).closest('tr').children('td:eq(2)').text();
        var enderecoTable = $(this).closest('tr').children('td:eq(3)').text();
        var numeroTable = $(this).closest('tr').children('td:eq(4)').text();
        var complementoTable = $(this).closest('tr').children('td:eq(5)').text();
        var bairroTable = $(this).closest('tr').children('td:eq(6)').text();
        var CEPTable = $(this).closest('tr').children('td:eq(7)').text();
        var foneTable = $(this).closest('tr').children('td:eq(8)').text();
        console.log((nomeTable));
        $("#apiModal .modal-body .chart").remove(); 
        $("#apiModal .modal-body p").remove(); 
        $("h1").remove(); 
        $("#apiModal .modal-title").text('Editar Cliente');
        $("#apiModal").modal('show');
        $("#apiModal .modal-body").append($('#formCliente').show());
        $("#apiModal .modal-footer .action").text('Editar').show(); 
        $('#inputNomeCliente').val(nomeTable);
        $('#inputCNPJCliente').val(CNPJTable);
        $('#inputEnderecoCliente').val(enderecoTable);
        $('#inputNumeroCliente').val(numeroTable);
        $('#inputComplementoCliente').val(complementoTable);
        $('#inputBairroCliente').val(bairroTable);
        $('#inputCEPCliente').val(CEPTable);
        $('#inputTelefoneCliente').val(foneTable);           
        $("#apiModal .modal-footer .action").on('click',function(){
            let nome = $('#inputNomeCliente').val();
            let CNPJ = $('#inputCNPJCliente').val();
            let endereco = $('#inputEnderecoCliente').val();
            let numero = $('#inputNumeroCliente').val();
            let complemento = $('#inputComplementoCliente').val();
            let bairro = $('#inputBairroCliente').val();
            let CEP = $('#inputCEPCliente').val();
            let fone = $('#inputTelefoneCliente').val();
            $.ajax({
                method:'put',
                url: 'http://localhost/geradorXml/App/public/api/cliente/update/'+id,
                dataType: 'json',
                data:{id:id, nome:nome, CNPJ:CNPJ, endereco:endereco, numero:numero, 
                    complemento:complemento, bairro:bairro, CEP:CEP, fone:fone }
            }).done(function(data){
                if(data == '{\"Aviso\": {\"text\": \"Cliente Atualizado\"}')
                {
                    alert('Cliente Atualizado');
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