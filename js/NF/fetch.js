$(document).ready(function () {
    var table = $("#tableListarNF").DataTable({
        responsive: true,
        pagingType: "full_numbers",
        ajax: {
            url: 'http://localhost/geradorXml/App/public/api/nf/',
            method: "get",
            dataSrc: ""
        },
        columns: 
        [
            { data: "id" },
            { data: "chave" },
            { data: "dhEmi" },
            { data: "CNPJDestinatario" },
            { data: "protocolo" },
            { data: "Excluir" },
            { data: "Cancelar" }
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
                defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-ban fa-2x' id='excluirProduto' style='cursor:pointer;color:red'></i></a></div>"
            }
        ]
        });
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