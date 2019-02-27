export const autDatatable = $("#tableListarNF").DataTable({
    responsive: true,
    pagingType: "full_numbers",
    ajax: {
        url: 'http://localhost/geradorXml/App/public/api/nf/',
        method: "get",
        dataSrc: ""
    },
    columns: 
    [
        { data: "chave" },
        { data: "dhEmi" },
        { data: "protocolo" },
        { data: "Visualizar" },
        { data: "Excluir" },
        { data: "Cancelar" }
    ],
    columnDefs: 
    [ 
        {
            targets: [-1],
            data: null,
            defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-ban fa-2x' id='cancelarNF' style='cursor:pointer;color:red' title='Cancelar'></i></a></div>"
        },
        {
            targets: [-2],
            data: null,
            defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-trash fa-2x' id='excluirNF' style='cursor:pointer;color:red' title='Excluir'></i></a></div>"
        },
        {
            targets: [-3],
            data: null,
            defaultContent: "<div style='text-align:center'><a class='btn btn-default'><i class='fas fa-eye fa-2x' id='visualizarNF' style='cursor:pointer' title='Visualizar'></i></a></div>"
        }
    ]
});