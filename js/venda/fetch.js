$(document).ready(function () {             
    var table = $("#tableListarVendas").DataTable({       
    language: {
        "url": "http://localhost/geradorXml/datatablePortugues.json"
    },
    pagingType: "full_numbers",
    responsive: true,
    ajax: {
        url: 'http://localhost/geradorXml/App/public/api/venda/',
        method: "get",
        dataSrc: ""
    },
    columns: 
    [
        { data: "id" },
        { data: "vendedor" },
        { data: "produtos" },
        { data: "quantidades" },
        { data: "valorTotal" },
        { data: "formaPagamento" },
        { 
            data: "NFCe",
            "render": function(data, type, row, meta){
               if(type === 'display'){
                data = '<a href="' + data + '"target="_blank"> <button class="btn btn-info">NFC-e</button></a>'
               }                   
               return data;
            }   
        },
        { data: "dataVenda" },        
        { data: "Excluir" },
    ],
    columnDefs: 
    [ 
        {
            targets: [-1],
            data: null,
            defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-trash fa-2x' id='excluirVenda' style='cursor:pointer;color:red' title='Excluir'></i></a></div>"
        }
    ]
    }); 
    $(document).on('click', '#excluirVenda',function() {       
        let id = $(this).closest('tr').children('td:eq(0)').text();
        let $confirm = confirm("Tem certeza que deseja excluir a venda com id "+id);
        if($confirm)         
        {    
            $.ajax({
                method:'delete',
                url: 'http://localhost/geradorXml/App/public/api/venda/delete/'+id
            }).done(function(data){
                // data == "{"Aviso": {"text": "Cliente Deletado"}" NÃO FUNFA?!?!?!
                if(typeof id !== "undefined")
                {
                    alert('Venda '+id+' Foi Deletedo Com Sucesso!!');   
                }   
                location = location;        
            });          
        }
    });
}); 