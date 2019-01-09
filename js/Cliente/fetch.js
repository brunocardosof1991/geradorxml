$(document).ready(function () {             
    var table = $("#tableListarClientes").DataTable({
    pagingType: "full_numbers",
    responsive: true,
    ajax: {
        url: 'http://localhost/geradorXml/App/public/api/cliente/',
        method: "get",
        dataSrc: ""
    },
    columns: 
    [
        { data: "id" },
        { data: "nome" },
        { data: "CNPJ" },
        { data: "endereco" },
        { data: "numero" },
        { data: "complemento" },
        { data: "bairro" },
        { data: "CEP" },
        { data: "fone" },
        { data: "Editar" },
        { data: "Excluir" }
    ],
    columnDefs: 
    [ 
        {
            targets: [-1],
            data: null,
            defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-user-edit fa-2x' id='editarProduto' style='cursor:pointer;color:orange'></i></a></div>"
        },
        {
            targets: [-2],
            data: null,
            defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-trash fa-2x' id='excluirProduto' style='cursor:pointer;color:red'></i></a></div>"
        }
    ]
    }); 
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