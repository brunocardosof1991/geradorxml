export const datatable = $("#tableListarProdutos").DataTable({       
    language: {
        "url": "http://localhost/geradorXml/datatablePortugues.json"
    },
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
        { data: "cEAN" },
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